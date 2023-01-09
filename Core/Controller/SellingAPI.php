<?php

namespace Core\Controller;

use Core\Base\Controller;
use Core\Helpers\Tests;
use Core\Model\Item;
use Core\Model\Transaction;


class SellingAPI extends Controller
{
        

        use Tests;
        protected $request_body;
        protected $http_code = 200;

        protected $response_schema = array(
                "success" => true, // to provide the response status.
                "message_code" => "", // to provide message code for the front-end developer for a better error handling
                "body" => []
        );

        function __construct()
        {
                $this->request_body = (array) json_decode(file_get_contents("php://input"));
        }

        public function render()
        {
                header("Content-Type: application/json"); // changes the header information
                http_response_code($this->http_code); // set the HTTP Code for the response
                echo json_encode($this->response_schema); // convert the data to json format
        }

       

       public function items() // get selected item data to show in view
       {
        try {
            $item = new Item;
            $items = $item->get_by_id($_POST['id']);
            if (empty($items)) {
                    throw new \Exception('No items were found!');
            }
            $this->response_schema['body'] = $items;
            $this->response_schema['message_code'] = "items_collected_successfuly";
            }

        catch (\Exception $error) {
            $this->response_schema['success'] = false;
            $this->response_schema['message_code'] = $error->getMessage();
            $this->http_code = 404;
           }
       }


       



       function transactions_create() // create new transiction 
        {
                self::check_if_empty($this->request_body);
                try {
                        $transaction = new Transaction;
                        $transaction->create($this->request_body);
                        $this->response_schema['message_code'] = "transaction_created_successfuly";
                } catch (\Exception $error) {
                        $this->response_schema['message_code'] = "transaction_was_not_created";
                        $this->http_code = 421;
                }
        }
        function transaction_get_by_id (){ // get last inserted transaction to append it on table
                try {
                        $transaction = new transaction;
                        $transactions = $transaction->get_last_id();
                        if (empty($transactions)) {
                                throw new \Exception('No transactions were found!');
                        }
                        $this->response_schema['body'] = $transactions;
                        $this->response_schema['message_code'] = "transactions_collected_successfuly";
                        }
            
                    catch (\Exception $error) {
                        $this->response_schema['success'] = false;
                        $this->response_schema['message_code'] = $error->getMessage();
                        $this->http_code = 404;
                       }
        }

        function transactions_update() // edit transiction quantity field on database
        {
                self::check_if_empty($this->request_body);
                try {
                        $transaction = new Transaction;
                        $transaction= $transaction->update($this->request_body);
                        $this->response_schema['message_code'] = "transaction_Updated_successfuly";
                } catch (\Exception $error) {
                        $this->response_schema['message_code'] = "transaction_was_not_Updated";
                        $this->http_code = 421;
                }
        }
        function user_trans(){  // handle user transaction relationship in database table
                
                try {
                        $transaction = new Transaction;
                        $transaction_id = $_POST['transaction_id'];
                        $user_id = $_POST['user_id'];
                        $transaction->usertransaction($transaction_id,$user_id);
                        $this->response_schema['message_code'] = "User_transaction_created_successfuly";
                } catch (\Exception $error) {
                        $this->response_schema['message_code'] = "User_transaction_was_not_created";
                        $this->http_code = 421;
                }
               
        }


        public function item_edit(){  // edit available quantity of item after transaction reducing them
                self::check_if_empty($this->request_body);
                try {
                        $item = new item;
                        $item->update($this->request_body);
                        $this->response_schema['message_code'] = "item_edited_successfuly";
                } catch (\Exception $error) {
                        $this->response_schema['message_code'] = "item_was_not_created";
                        $this->http_code = 421;
                }
        }
       

        function transactions_get(){  // get all transactions to append it in table (document ready function)
                try {
                        $transaction = new transaction;
                        $transactions = $transaction->get_all();
                        if (empty($transactions)) {
                                throw new \Exception('No transactions were found!');
                        }
                        $this->response_schema['body'] = $transactions;
                        $this->response_schema['message_code'] = "transactions_collected_successfuly";
                        }
            
                    catch (\Exception $error) {
                        $this->response_schema['success'] = false;
                        $this->response_schema['message_code'] = $error->getMessage();
                        $this->http_code = 404;
                       }
                   }
        
        function transactions_delete(){  // delete selected transaction row from table 
                try {
                        $transaction = new transaction;
                        $transactions = $transaction->delete($_POST['id']);
                        

                        if (!empty($transactions)) {
                                throw new \Exception('No transactions were found!');
                        }
                        $this->response_schema['body'] = $transactions;
                        $this->response_schema['message_code'] = "transactions_deleted_successfuly";
                        }
            
                    catch (\Exception $error) {
                        $this->response_schema['success'] = false;
                        $this->response_schema['message_code'] = $error->getMessage();
                        $this->http_code = 404;
                       }
        }
        
                function quantity_new (){ // store new available quantity in items table
                        try {
                                $item = new Item;
                                $items = $item->get_by_id($_POST['id']);
                                if (empty($items)) {
                                        throw new \Exception('No items were found!');
                                }
                                $this->response_schema['body'] = $items;
                                $this->response_schema['message_code'] = "items_collected_successfuly";
                                }
                    
                            catch (\Exception $error) {
                                $this->response_schema['success'] = false;
                                $this->response_schema['message_code'] = $error->getMessage();
                                $this->http_code = 404;
                               }
                }

        }

       

