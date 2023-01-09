<?php

namespace Core\Controller;

use Core\Base\Controller;
use Core\Base\View;
use Core\Helpers\Helper;
use Core\Model\transaction;

class transactions extends Controller
{

    public function render()
    {
        if (!empty($this->view))
            $this->view();
    }

    function __construct()
    {
        $this->auth();
        
    }

    /**
     * Gets all transactions
     *
     * @return array
     */
    public function index()  // pass data to transaction view
    {
        $this->permissions(['transaction:read']);
        $this->view = 'transactions.index';
        $transaction = new transaction; // new model transaction.
        $this->data['transactions'] = $transaction->get_all();
        $this->data['transactions_count'] = count($transaction->get_all());
    }

    /**
     * Display the HTML form for transaction creation
     *
     * @return void
     */
    public function create() // for api using
    {
        $this->permissions(['transaction:create']);
        $this->view = 'transactions.create';
    }

    /**
     * Creates new transaction
     *
     * @return void
     */
    public function store() // create new transacion row in database
    {
        $this->permissions(['transaction:create']);
        $transaction = new transaction();
        $new_transaction = array_map ( 'htmlspecialchars' , $_POST ); //escaping XSS attacks
        $transaction->create($new_transaction);
        Helper::redirect('/transactions');

        
    }

    /**
     * Display the HTML form for transaction update
     *
     * @return void
     */
    public function edit() // show transaction edit form to user
    {
        $this->permissions(['transaction:read', 'transaction:update']);
        $this->view = 'transactions.edit';
        $transaction = new transaction();
        $this->data['transaction'] = $transaction->get_by_id($_GET['id']);
    }

    /**
     * Updates the transaction
     *
     * @return void
     */
    public function update()  // edit selected transaction row in database
    {
        $this->permissions(['transaction:read', 'transaction:update']);
        $transaction = new transaction();
        $new_transaction = array_map ( 'htmlspecialchars' , $_POST ); //escaping XSS attacks
        $transaction->update($new_transaction);


        if ($this->permissions(['transaction:create'])){ // check if user are accountant or seller
        Helper::redirect('/selling-dashboard');
        }else{
            helper::redirect('/transactions');
        }
    }

    /**
     * Delete the transaction
     *
     * @return void
     */
    public function delete() // delete selected transaction row in database
    {
        $this->permissions(['transaction:read', 'transaction:delete']);
        $transaction = new transaction();
        $transaction->delete($_GET['id']);
        Helper::redirect('/transactions');
    }
}
