<?php

namespace Core\Base;

use Core\Helpers\Helper;
use Core\Model\User;

abstract class Controller
{
    abstract public function render();

    protected $view = null;
    protected $data = array();

    protected function view()
    {
        new View($this->view, $this->data);
    }

    protected function auth()
    {
        if (!isset($_SESSION['user'])) {
            Helper::redirect('/login');
        }
    }

    /**
     * Check if the user has the assigned permissions.
     *
     * @param array $permissions_set
     * @return void
     */
    protected function permissions(array $permissions_set)
    {
        $this->auth();
        
        $user = new User;
        $assigned_permissions = $user->get_permissions();
        foreach ($permissions_set as $permission) {
            if (!in_array($permission, $assigned_permissions)) {
                Helper::redirect('/dashboard');
            }
        }
        
    }

    /**
     * Change the header view. check View.php line 18
     *
     * @param boolean $switch
     * @return void
     */
    
}
