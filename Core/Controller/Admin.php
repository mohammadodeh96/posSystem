<?php

namespace Core\Controller;

use Core\Base\Controller;
use Core\Model\Item;
use Core\Model\Transaction;
use Core\Model\User;

class Admin extends Controller
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

        public function index()
        {
                $this->view = 'dashboard';

                $user = new User; //  pass user data to view
                $this->data['users'] = $user->get_all();
                $this->data['users_count'] = count($user->get_all());

                $item = new Item; 
                $this->data['items'] = $item->get_all(); //  pass item data to view
                $this->data['items_count'] = count($item->get_all());
                $this->data['item_qun'] = $item->get_column_sum2('available_quantity');
                $this->data['items_top'] = $item->get_top_items();
                $this->data['ava_quan']= $item->get_available_quantity();
                
                $transaction = new Transaction; //  pass transaction data to view
                $this->data['transactions'] = $transaction->get_all();
                $this->data['transactions_count'] = count($transaction->get_all());
                $this->data['qun'] = $transaction->get_column_sum('quantity');

        }
        public function selling_dashboard(){ 

                $this->view = 'sellingDashboard';
                $item = new Item; 
                $this->data['items'] = $item->get_all();
                $this->data['items_count'] = count($item->get_all());
                
                $user = new User;
                $this->data['users'] = $user->get_all();
                
                
        }
}
