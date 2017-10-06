<?php

    require_once("../Properties.php");

    // Manages access to database and database connection
    class Database {

        private static $connection;

        private static function connectDb() {
            // Connect to database with information from properties file constants
            $host     = Properties::DB_HOST;
            $username = Properties::DB_USERNAME;
            $password = Properties::DB_PASSWORD;
            $dbName   = Properties::DB_NAME;
            self::$connection = mysqli_connect($host, $username, $password, $dbName);
        }

        // Queries the database with provided query.  Returns false if anything went wrong,
        //    otherwise SELECT queries return their result, and INSERT and DELETE queries will
        //    return true.
        public static function queryDb($query, $params = false, $pattern = "") {

            // Prepare and run query
            $statement = mysqli_prepare(self::getConnection(), $query);
            if ($params) $statement->bind_param($pattern, ...$params);
            $statement->execute();

            // Fetch query result to return
            $result = $statement->get_result();

            // Return false if nothing happened
            if ($statement->affected_rows == 0) return false;

            // Return result, or false if anything went wrong
            if (startsWith($query, "SELECT")) {

                // Select returns false if it failed and that's then returned here,
                //    else returns the query result
                return $result;

            } else if (startsWith($query, "INSERT")) {

                // Also returns false if it failed
                return $result;

            } else if (startsWith($query, "DELETE")) {

                // If affected rows isn't zero then this worked
                return true;
            }
        }

        // Queries database to confirm a one-row result.  Returns false if query
        //    fails or provides a result longer than one row.
        public static function queryDbRow($query, $params, $pattern) {

            $result = self::queryDb($query, $params, $pattern);

            if ($result == false) return false;
            if ($result->num_rows > 1) return false;

            return $result;
        }

        public static function getConnection() {

            // If not connected, connect
            if (!isset(self::$connection)) self::connectDb();

            return self::$connection;
        }

    }

 ?>
