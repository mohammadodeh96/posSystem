<?php

namespace Core\Base;


class Model
{
    public $connection;
    protected $table;

    public function __construct()
    {
        $this->connection(); // connection is ready
        $this->relate_table();
    }

    public function __destruct()
    {
        $this->connection->close();
    }


    public function get_column_sum(){ // get summation of items selled quantity 
        
        $result = $this->connection->query('SELECT SUM(quantity) AS value_sum FROM transactions');
        $row = mysqli_fetch_assoc($result); 
        $data = $row['value_sum'];
        return $data;
      
    }


    public function get_top_items(){ // get top 5 expensive items
        
        $data = array();
        $result = $this->connection->query("SELECT * FROM items ORDER BY selling_price DESC LIMIT 5;");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                $data[] = $row;
            }
        }
        return $data;
    }



    public function get_last_id(){ // get last id inserted transaction info
        
        $data = array();
        $result = $this->connection->query("SELECT * FROM transactions ORDER BY id DESC LIMIT 1;");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                $data[] = $row;
            }
        }
        return $data;
    }


    public function get_last_id_insert(){ //  get last id inserted (only id) 
        
        $data = 0;
        $result = $this->connection->query("SELECT id FROM transactions ORDER BY id DESC LIMIT 1;");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                $data = $row;
            }
        }
        return $data;
    }


    public function get_available_quantity(){  // get available quantity of item with other columns
        
        $data = array();
        $result = $this->connection->query("SELECT * FROM items ORDER BY available_quantity DESC;");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                $data[] = $row;
            }
        }
        return $data;
    }



    public function get_column_sum2(){  // get count of items quantity in stock
        
        $result = $this->connection->query('SELECT SUM(available_quantity) AS value_sum FROM items');
        $row = mysqli_fetch_assoc($result); 
        $data = $row['value_sum'];
        return $data;
      
    }



    public function usertransaction($transaction_id, $user_id){  // handle user - transactions relation 

        $sql = "INSERT INTO user_transactions (transaction_id, user_id) VALUES ($transaction_id, $user_id)";
        $this->connection->query($sql);
    }





    public function get_all(): array  // get all data from table
    {
        $data = array();
        $result = $this->connection->query("SELECT * FROM $this->table");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                $data[] = $row;
            }
        }
        return $data;
    }

    public function get_by_id($id) // get selected row data by id
    {
        $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE id=?"); 
        $stmt->bind_param('i', $id); 
        $stmt->execute(); 
        $result = $stmt->get_result(); 
        $stmt->close();
        return $result->fetch_object();
    }



    public function delete($id)  // delete selected row data 
    {
        $stmt = $this->connection->prepare("DELETE FROM $this->table WHERE id=?"); 
        $stmt->bind_param('i', $id); 
        $stmt->execute(); 
        $result = $stmt->get_result(); 
        $stmt->close();
        return $result;
    }

   
    public function create($data)  // handle any create operation in the database
    {

        $keys = '';
        $values = '';
        $data_types = '';
        $value_arr = array();

        foreach ($data as $key => $value) {

            if ($key != \array_key_last($data)) {
                $keys .= $key . ', ';
                $values .= "?, ";
            } else {
                $keys .= $key;
                $values .= "?";
            }

            switch ($key) {
                case 'id':
                case 'user_id':
                case 'item_id':
                case 'transaction_id':
                case 'available_quantity':
                case 'quantity':
                    $data_types .= "i";
                    break;

                default:
                    $data_types .= "s";
                    break;
            }

            $value_arr[] = $value;
        }

        
        $sql = "INSERT INTO $this->table ($keys) VALUES ($values)"; 
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param($data_types, ...$value_arr);
        $stmt->execute();
        $stmt->close();
    }

    public function update($data) // handle update operation in database
    {
        $set_values = '';
        $id = 0;

        foreach ($data as $key => $value) {
            if ($key == 'id') {
                $id = $value;
                continue;
            }
            if ($key != \array_key_last($data)) {
                $set_values .= "$key='$value', ";
            } else {
                $set_values .= "$key='$value'";
            }
        }
        $sql = "UPDATE $this->table SET $set_values WHERE id=$id";
        $this->connection->query($sql);
    }

    protected function connection() // connection to database
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "pos_app";

       
        $this->connection = new \mysqli($servername, $username, $password, $database);

        
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
       
    }

    protected function relate_table() // get table name from class name
    {
        $table_name = \get_class($this);
        $table_name_arr = \explode('\\', $table_name);
        $class_name = $table_name_arr[\array_key_last($table_name_arr)]; 
        $final_clas_name = \strtolower($class_name) . "s";
        $this->table = $final_clas_name;
    }
}
