<?php

    class Database {

        private static $connection;

        private static function connectDb() {
            // TODO Probably more error checking
            
            // Connect to database with information from properties file constants
            self::$connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        }

        public static function queryDb($query) {
            // TODO Error if can't connect or if query fails
            $result = mysqli_query(self::getConnection(), $query);
            if (gettype($result) == "boolean") return $result;
            if ($result->num_rows == 0) return false;
            return $result;
        }

        // Queries database to confirm a one-row result.  Returns false if query
        //    fails or provides a result longer than one row.
        public static function queryDbRow($query) {
            // TODO ERROR CHECK IF IT'S NOT A SELECT QUERY - THIS MIGHT MAKE
            //    QUERYDB RETURN TRUE
            $result = self::queryDb($query);
            if ($result == false) return false;
            if ($result->num_rows > 1) return false;
            return $result;
        }

        public static function getConnection() {
            // TODO more error checking
            if (!isset(self::$connection)) self::connectDb();
            return self::$connection;
        }

    }

 ?>
