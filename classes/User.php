<?php
require "Database.php";
    class User {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function regis($data){
            $this->db->query('INSERT INTO users (name, email, password, number, cv) VALUES (:name, :email, :password, :number, :cv)');

            $this->db->bind(':name', $data['name']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', $data['password']);
            $this->db->bind(':number', $data['number']);
            $this->db->bind(':cv', $data['cv']);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function findUserByEmail($email){
            $this->db->query('SELECT * FROM users WHERE email = :email');
            $this->db->bind(':email', $email);

            $row = $this->db->single();

            return $row;

            //Check row
            if($this->db->rowCount() > 0){
                return true;
            } else {
                return false;
            }
        }
    }