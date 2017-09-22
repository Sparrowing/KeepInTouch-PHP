<?php

    class User {

        private $id;
        private $username;
        private $pwHash;

        public function __construct($id, $username, $pwHash) {
            $this->id = $id;
            $this->username = $username;
            $this->pwHash = $pwHash;
        }

        // Returns hashed version of a password.
        public static function hashPassword($password) {
            return password_hash($password, PASSWORD_DEFAULT);
        }

        // Validates username.  Returns true if value is valid as a username
        //    and false otherwise.
        public static function isValidUsername($username) {
            return preg_match("/^[a-zA-Z0-9_-]{3,15}$/", $username);
        }

        // Validates password.  Returns true if value is valid as a password
        //    and false otherwise.
        public static function isValidPassword($password) {
            return preg_match("/^([1-zA-Z0-1@.\s]{2,10})$/", $password);
        }

        // Returns true if supplied password matches the password of this user,
        //    else false.
        public function isPasswordMatch($password) {
            if (password_verify($password, $this->pwHash)) return true;
            return false;
        }

        public function getId() {
            return $this->id;
        }

        public function getUsername() {
            return $this->username;
        }

        public function getPwHash() {
            return $this->pwHash;
        }

    }

 ?>
