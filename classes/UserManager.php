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
            // "INSERT INTO [usertable] ([usernameCol], [pwHashCol]) VALUES ("[username]", "[pwHash]")"
            $query = "INSERT INTO " . Constants::$USER_TABLE . " (" . self::$USERNAME_COL .
                    ", " . self::$PW_HASH_COL . ") VALUES (\"" . $username .
                    "\", \"" . $pwHash . "\")";

            // Query database
            $result = Database::queryDb($query);

            // Return false if user can't be inserted
            if ($result == false) return false;

            // Fetch and return new user
            $id = mysqli_insert_id(Database::getConnection());
            $user = self::getUserById($id);
            return $user;
        }

        // Gets user from user table by id.
        public static function getUserById($id) {

            // Create query
            $query = "SELECT * FROM " . Constants::$USER_TABLE . " WHERE " .
                    self::$ID_COL . " = '" . $id . "'";

            // Check database
            $result = Database::queryDbRow($query);

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
            $query = "SELECT * FROM " . Constants::$USER_TABLE . " WHERE " .
                    self::$USERNAME_COL . " = '" . sqlEscape($username) . "'";

            // Check database
            $result = Database::queryDbRow($query);

            // Return false if user is not found
            if ($result == false) return false;

            // Turn result row into a user object
            $user = self::makeUserFromRow($result);

            // Return the user object
            return $user;
        }

    }

 ?>
