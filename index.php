<?php
session_start();


use Core\Model\User;
use Core\Router;

require_once 'vendor/autoload.php';

spl_autoload_register(function ($class_name) {
    if (strpos($class_name, 'Core') === false)
        return;
    $class_name = str_replace("\\", '/', $class_name); 
    $file_path = __DIR__ . "/" . $class_name . ".php";
    require_once $file_path;
});

if (isset($_COOKIE['user_id']) && !isset($_SESSION['user'])) { 
    
    $user = new User(); // get the user model
    $logged_in_user = $user->get_by_id($_COOKIE['user_id']);
    
}



Router::get('/', 'admin.index'); 


Router::get('/login', "authentication.login"); 
Router::get('/logout', "authentication.logout"); 
Router::post('/authenticate', "authentication.validate");

Router::get('/dashboard', "admin.index"); 
Router::get('/selling-dashboard', "admin.selling_dashboard");




Router::get('/users', "users.index"); 
Router::get('/user', "users.single"); 
Router::get('/users/create', "users.create");
Router::post('/users/store', "users.store"); 
Router::get('/users/edit', "users.edit"); 
Router::post('/users/update', "users.update");
Router::post('/profile/update',"users.profile"); 
Router::get('/users/delete', "users.delete");

Router::get('/items', "items.index");  
Router::get('/items/create', "items.create");
Router::post('/items/store', "items.store"); 
Router::get('/items/edit', "items.edit"); 
Router::post('/items/update', "items.update"); 
Router::get('/items/delete', "items.delete");

Router::get('/transactions', "transactions.index");  
Router::get('/transactions/create', "transactions.create");
Router::post('/transactions/store', "transactions.store"); 
Router::get('/transactions/edit', "transactions.edit"); 
Router::post('/transactions/update', "transactions.update"); 
Router::get('/transactions/delete', "transactions.delete");


// api routes


Router::get('/api/transactions', "sellingapi.transactions_get");
Router::post('/api/sell/create', "sellingapi.transactions_create");
Router::post('/api/sell/update', "sellingapi.transactions_update");
Router::post('/api/transactions/delete', "sellingapi.transactions_delete");
Router::post('/api/sell', "sellingapi.items");
Router::post('/api/item','sellingapi.quantity_new');
Router::post('/api/item/edit', "sellingapi.item_edit");
Router::get('/api/transaction', "sellingapi.transaction_get_by_id");
Router::post('/api/user-transactions',"sellingapi.user_trans");


Router::redirect();
