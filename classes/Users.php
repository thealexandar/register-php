<?php
require 'User.php';

class Users {
    private $user;

    public function __construct(){
        $this->user = new User;
    }

    public function register(){
        // Chech for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Process form

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'name'                  => trim($_POST['name']),
                'email'                 => trim($_POST['email']),
                'password'              => trim($_POST['password']),
                'confirm_password'      => trim($_POST['confirm_password']),
                'number'                => trim($_POST['number']),
                'cv'                    => isset($_FILES['cv']),
                'fileName'              => $_FILES['cv']['name'],
                'fileTmpName'           => $_FILES['cv']['tmp_name'],
                'fileSize'              => $_FILES['cv']['size'],
                'fileError'             => $_FILES['cv']['error'],
                'name_err'              => '',
                'email_err'             => '',
                'password_err'          => '',
                'confirm_password_err'  => '',
                'number_err'            => '',
                'cv_err'                => '',
                'register_succ'         => ''
            ];

            // Validate file
            $fileExt = explode('.', $data['fileName']);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('pdf');

            if(in_array($fileActualExt, $allowed)) {
                if($data['fileError'] === 0) {
                    if($data['fileError'] < 10000000) {
                        $fileNameNew = uniqid('', true).".".$fileActualExt;
                        $fileDestination = 'assets/files/'. $fileNameNew;
                        move_uploaded_file($data['fileTmpName'], $fileDestination);
                    } else {
                        $data['cv_err'] = 'Your file is too big!';
                    }
                } else {
                    $data['cv_err'] = 'There was an error uploading your file!';
                }
            } else {
                $data['cv_err'] = 'Invalid file type, only pdf files is allowed!';
            }



            // Validite Name
            if(empty($data['name'])){
                $data['name_err'] = 'Please Enter Name';
            }

            // Validite Email
            if(empty($data['email'])){
                $data['email_err'] = 'Please Enter Email';
            } else {
                // Check Email
                if($this->user->findUserByEmail($data['email'])){
                    $data['email_err'] = 'Email is already taken';
                }
            }

            // Validite Password
            if(empty($data['password'])){
                $data['password_err'] = 'Please Enter Password';
            } elseif(strlen($data['password']) < 6){
                $data['password_err'] = 'Password must be at least 6 characters';
            }

            // Validite Confirm Password
            if(empty($data['confirm_password'])){
                $data['confirm_password_err'] = 'Please Confirm Password';
            } elseif($data['password'] != $data['confirm_password']){
                $data['confirm_password_err'] = 'Passwords do not match';
            }

            // Validate number
            if(empty($data['number'])){
                $data['number_err'] = 'Please Enter number';
            } elseif(strlen($data['number']) < 6) {
                $data['number_err'] = 'Number must be at least 6 numbers long!';
            }

            // Make sure errors are empty
            if(empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err']) && empty($data['number_err']) && empty($data['cv_err'])){
                // Validated

                // Hash Password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // validate file


                // Register User
                if($this->user->regis($data)){
                    //die("SUCCESS!");
                    header('Location: home.php');
                    //$data['register_succ'] = "Success! You can now login.";
                } else {
                    die('Something went wrong');
                }

            } else {
                // Load view with errors
                return $data;

            }


        } else {
            // Init data
            $data = [
                'name'                  => '',
                'email'                 => '',
                'password'              => '',
                'confirm_password'      => '',
                'number'                => '',
                'cv'                    => '',
                'name_err'              => '',
                'email_err'             => '',
                'password_err'          => '',
                'confirm_password_err'  => '',
                'number_err'            => '',
                'cv_err'                => '',
                'register_succ'         => ''
            ];

            // Load view
            //$this->view('register', $data);
            return $data;
        }
    }

}