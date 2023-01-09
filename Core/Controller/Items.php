<?php

namespace Core\Controller;

use Core\Base\Controller;
use Core\Helpers\Helper;
use Core\Helpers\Tests;
use Core\Model\item;


class items extends Controller
{

    use Tests;

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
     * Gets all items
     *
     * @return array
     */
    public function index()  // pass items data to view
    {
        $this->permissions(['item:read']);
        $this->view = 'items.index';
        $item = new item; // new model item.
        $this->data['items'] = $item->get_all();
        $this->data['items_count'] = count($item->get_all());
    }



    /**
     * Display the HTML form for item creation
     *
     * @return void
     */
    public function create() // display creation form to user
    {
        $this->permissions(['item:create']);
        $this->view = 'items.create';
    }

    /**
     * Creates new item
     *
     * @return void
     */
    public function store() // create item in database
    {
        $this->permissions(['item:create']);
        $item = new item();
        $new_item = array_map ( 'htmlspecialchars' , $_POST ); //escaping XSS attacks
        $item->create($new_item);
        Helper::redirect('/items');
    }

    /**
     * Display the HTML form for item update
     *
     * @return void
     */
    public function edit() // get item by id and pass item data to edit form
    {
        $this->permissions(['item:read', 'item:update']);
        $this->view = 'items.edit';
        $item = new Item();
        $selected_Item = $item->get_by_id($_GET['id']);
        $this->data['item'] = $selected_Item;
    }

    /**
     * Updates the item
     *
     * @return void
     */
    public function update() // update the selected item with new data 
    {
        $this->permissions(['item:read', 'item:update']);
        $item = new Item();
        $new_item = array_map ( 'htmlspecialchars' , $_POST ); //escaping XSS attacks
        $item->update($new_item);
        Helper::redirect('/items');
    }

    /**
     * Delete the item
     *
     * @return void
     */
    public function delete() // delete selected item row in database
    {
        $this->permissions(['item:read', 'item:delete']);
        $item = new Item();
        $item->delete($_GET['id']);
        Helper::redirect('/items');
    }
}
