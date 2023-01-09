<?php

namespace Core\Model;

use Core\Base\Model;

class User extends Model
{
        // admin permissions set for database
    const ADMIN = array( 
        "item:read", "item:create", "item:update", "item:delete",
        "user:read", "user:create", "user:update", "user:delete",
        "transaction:read", "transaction:create", "transaction:update","transaction:delete"
    );
        // seller permissions set for database
    const seller = array(
         
        "item:read","transaction:create","transaction:update","transaction:delete"
        
    );
        // procurement permissions set for database
    const procurement = array(
        "item:read","item:create","item:update","item:delete",
        
    );
        // accountant permissions set for database
    const accountant = array(
       
        "transaction:read","transaction:delete","transaction:update",
    );

    


    public function check_username(string $username) //get username from database in order to check user permissions
    {
        $result = $this->connection->query("SELECT * FROM $this->table WHERE username='$username'");
        if ($result) { 
            if ($result->num_rows > 0) {
                return $result->fetch_object();
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function get_permissions(): array // check user permissions set
    {
        $permissions = array();
        $user = $this->get_by_id($_SESSION['user']['user_id']);
        if ($user) {
              $permissions = \unserialize($user->permissions); 
        }
        return $permissions;
    }
}


// fillable variables ['username', 'display_name', 'email','password','permissions']