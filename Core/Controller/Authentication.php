<?php

namespace Core\Controller;


use Core\Helpers\Helper;
use Core\Model\User;
use Core\Base\Controller;

class Authentication extends Controller
{
        protected $user = null;

        public function render()
        {
                if (!empty($this->view))
                        $this->view();
        }

        function __construct()
        {
                
                if (isset($_SESSION['user']))
                        Helper::redirect('/dashboard');
        }

        /**
         * Displays login form
         *
         * @return void
         */
        public function login()
        {
                $this->view = 'login';
        }

        /**
         * Login Validation
         *
         * @return void
         */
        public function validate()
        {

                
                $user = new User(); 
                $logged_in_user = $user->check_username($_POST['username']);

                if (!$logged_in_user) { // check if user dosenot exists, do not authenticate
                        $this->invalid_redirect(); 
                }

                if (!\password_verify($_POST['password'], $logged_in_user->password)) { // check if password match
                        $this->invalid_redirect();
                }




                if (isset($_POST['remember_me'])) {

                        \setcookie('user_id', $logged_in_user->id, time() + (86400 * 30)); // set user id in cookies
                }

                $_SESSION['user'] = array(
                        'username' => $logged_in_user->username,
                        'display_name' => $logged_in_user->display_name,
                        'user_id' => $logged_in_user->id,
                        'profile_picture' => $logged_in_user->profile_picture
                );


                Helper::redirect('/dashboard');
        }

        public function logout()  // destroy session and user info 
        {
                \session_destroy();
                \session_unset();
                \setcookie('user_id', '', time() - 3600); // destroy the cookie by setting a past expiry date
                Helper::redirect('/');
        }

        private function invalid_redirect()
        {
                $_SESSION['error'] = "Invalid Username or Password";
                Helper::redirect('/login');
                exit();
        }
}
