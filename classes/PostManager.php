<?php

    // Manages Post objects and how they interact with the database

    require_once("../library/Constants.php");
    require_once("Database.php");
    require_once("Post.php");

    class PostManager {

        private static $ID_COL        = "id";
        private static $USERID_COL    = "user_id";
        private static $TITLE_COL     = "title";
        private static $BODY_COL      = "body";
        private static $TIMESTAMP_COL = "timestamp";

        // Makes a post object from a single mysqli query row.
        private static function makePostFromRow($row) {
            $r = $row->fetch_assoc();
            return new Post($r[self::$ID_COL], $r[self::$USERID_COL], $r[self::$TITLE_COL],
                    $r[self::$BODY_COL], $r[self::$TIMESTAMP_COL]);
        }

        private static function makePostFromArray($arr) {
            return new Post($arr[0], $arr[1], $arr[2], $arr[3], $arr[4]);
        }

        // Makes an array of post objects from mysqli query result
        // NOT FUNCTIONAL YET
        private static function makePostArray($result) {
            $posts = [];

            if (!$result) return $posts;

            while ($row = $result->fetch_row()) {
                $currentPost = self::makePostFromArray($row);
                $posts[] = $currentPost;
            }

            return $posts;
        }

        // Creates a post in the database.  Returns the post in a post object.
        public static function createPost($user, $title, $body) {
            // TODO do more checking here to make sure the parameters are all valid to make a post
            // TODO also probably find a better way to format this query statement
            $query = "INSERT INTO " . Constants::$POST_TABLE . " (" .
                    self::$USERID_COL . ", " . self::$TITLE_COL . ", " .
                    self::$BODY_COL . ") VALUES (\"" . $user->getId() . "\", \"" .
                    sqlEscape($title) . "\", \"" . sqlEscape($body) . "\")";

            // Query database
            $result = Database::queryDb($query);

            // Return false if post can't be inserted
            if ($result == false) return false;

            // Fetch and return new post
            $id = mysqli_insert_id(Database::getConnection());
            $post = self::getPostById($id);

            return $post;
        }

        public static function getPostById($id) {

            // Create query
            $query = "SELECT * FROM " . Constants::$POST_TABLE . " WHERE " .
                    self::$ID_COL . " = '" . $id . "'";

            // Check database
            $result = Database::queryDbRow($query);

            // Return false if post is not found
            if ($result == false) return false;

            // Turn result row into a post object
            $post = self::makePostFromRow($result);

            // Return the post object
            return $post;
        }

        public static function getPostsByUser($user) {

            // Create query
            // Note - orders them newest to oldest
            $query = "SELECT * FROM " . Constants::$POST_TABLE . " WHERE " .
                    self::$USERID_COL . " = '" . $user->getId() . "' ORDER BY " .
                    self::$TIMESTAMP_COL . " DESC";

            // Search database
            $result = Database::queryDb($query);

            return self::makePostArray($result);
        }

        public static function getAllPosts() {

            $query = "SELECT * FROM " . Constants::$POST_TABLE . " ORDER BY " .
                    self::$TIMESTAMP_COL . " DESC";

            $result = Database::queryDb($query);

            return self::makePostArray($result);
        }

    }

 ?>
