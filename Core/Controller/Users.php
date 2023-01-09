<?php

namespace Core\Controller;

use Core\Base\Controller;
use Core\Helpers\Helper;
use Core\Model\User;

class Users extends Controller
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
         * Gets all users
         *
         * @return array
         */
        public function index()  // pass data to view 
        {
                $this->permissions(['user:read']);
                $this->view = 'users.index';
                $user = new User; // new model user.
                $this->data['users'] = $user->get_all();
                $this->data['users_count'] = count($user->get_all());
        }

        public function single()  // show the profile page to user
        {
                $this->view = 'profile';
                $user = new User();
                $this->data['user'] = $user->get_by_id($_GET['id']);
        }

        /**
         * Display the HTML form for user creation
         *
         * @return void
         */
        public function create() // show user cration form for user view
        {
                $this->permissions(['user:create']);
                $this->view = 'users.create';
        }

        /**
         * Creates new user
         *
         * @return void
         */
        public function store() //create a new user in database
        {
                $this->permissions(['user:create']);
                $user = new User();
                $_POST['password'] = \password_hash($_POST['password'], \PASSWORD_DEFAULT); // password hashing algorithm
                $new_user = array_map ( 'htmlspecialchars' , $_POST ); //escaping XSS attacks
                $user->create($new_user);
                Helper::redirect('/users');
        }

        /**
         * Display the HTML form for user update
         *
         * @return void
         */
        public function edit() //get selected user data and pass it to user edit form 
        {
                $this->permissions(['user:read', 'user:update']);
                $this->view = 'users.edit';
                $user = new User();
                $this->data['user'] = $user->get_by_id($_GET['id']);
        }

        /**
         * Updates the user
         *
         * @return void
         */
        public function update() // update user columns in database 
        {
                $this->permissions(['user:read', 'user:update']);
                $user = new User();
                // process role
                $permissions = null;
                switch ($_POST['role']) { // assign role to user from permissions set 
                        case 'admin':
                                $permissions = User::ADMIN;
                                break;
                        case 'seller':
                                $permissions = User::seller;
                                break;
                        case 'procurement':
                                $permissions = User::procurement;
                                break;
                        case 'accountant':
                                $permissions = User::accountant;
                                break;
                }
                unset($_POST['role']);
                $_POST['permissions'] = \serialize($permissions);
                $_POST['password'] = \password_hash($_POST['password'], \PASSWORD_DEFAULT);
                $new_user = array_map ( 'htmlspecialchars' , $_POST ); //escaping XSS attacks
                $user->update($new_user);

                Helper::redirect('/users');
        }

        /**
         * Delete the user
         *
         * @return void
         */
        public function delete() // delete the selected user id row
        {
                $this->permissions(['user:read', 'user:delete']);
                $user = new User();
                $user->delete($_GET['id']);
                Helper::redirect('/users');
        }

        public function profile() // pass data to profile view  and update profile picture, disply name and email
        {

                $user = new User();
                $file_name = '';
                $id = $_POST['id'];
                if (!empty($_FILES)) {
                        
                        $file_ext = substr(
                                $_FILES['profile_picture']['type'], 
                                strpos($_FILES['profile_picture']['type'], '/') + 1 
                        );
                        $file_name = "pf-$id.$file_ext";
                        move_uploaded_file($_FILES['profile_picture']['tmp_name'], "./resources/assets/$file_name");
                        $_POST['profile_picture'] = $file_name;
                }
                $new_user = array_map ( 'htmlspecialchars' , $_POST ); //escaping XSS attacks
                $user->update($new_user);
                Helper::redirect('/user?id=' . $_POST['id']);
        }
}
