<?php

    // Manages user objects and how they interact with the database

    require_once("../library/Constants.php");
    require_once("Database.php");
    require_once("User.php");

    // TODO Make a TableManager parent class for the different tables to share

    class UserManager {

        private static $ID_COL       = "id";
        private static $USERNAME_COL = "username";
        private static $PW_HASH_COL  = "pw_hash";

        // Makes a user object from a single mysqli query result row.
        private static function makeUserFromRow($row) {
            $r = $row->fetch_assoc();
            return new User($r[self::$ID_COL], $r[self::$USERNAME_COL], $r[self::$PW_HASH_COL]);
        }

        // Creates a user in the database.  Returns the user in a user object.
        public static function createUser($username, $password) {

            // Confirm values are valid
            if (!User::isValidUsername($username) || !User::isValidPassword($password))
                return false;

            // Create password hash
            $pwHash = User::hashPassword($password);

            // Create query
            $query = sprintf("INSERT INTO `%s` (%s, %s) VALUES (?, ?)",
                    Properties::USER_TABLE, self::$USERNAME_COL, self::$PW_HASH_COL);
            $params = [$username, $pwHash];
            $pattern = "ss";

            // Query database
            $result = Database::queryDb($query, $params, $pattern);

            // TODO Add back in some checking to make sure a new user was actually able to be inserted before proceeding
            // // Return false if user can't be inserted
            // if ($result == false) return false;

            // Fetch and return new user
            $id = Database::getConnection()->insert_id;
            $user = self::getUserById($id);
            return $user;
        }

        // Gets user from user table by id.
        public static function getUserById($id) {

            // Create query
            $query = sprintf("SELECT * FROM `%s` WHERE %s = ?",
                    Properties::USER_TABLE, self::$ID_COL);
            $params = [$id];
            $pattern = "i";

            // Check database
            $result = Database::queryDbRow($query, $params, $pattern);

            // Return false if user is not found
            if ($result == false) return false;

            // Turn result row into a user object
            $user = self::makeUserFromRow($result);

            // Return the user object
            return $user;
        }

        // Gets user from user table by username.
        public static function getUserByName($username) {

            // Create query
            $query = sprintf("SELECT * FROM `%s` WHERE %s = ?",
                    Properties::USER_TABLE, self::$USERNAME_COL);
            $params = [$username];
            $pattern = "s";

            // Check database
            $result = Database::queryDbRow($query, $params, $pattern);

            // Return false if user is not found
            if ($result == false) return false;

            // Turn result row into a user object
            $user = self::makeUserFromRow($result);

            // Return the user object
            return $user;
        }

    }

 ?>
