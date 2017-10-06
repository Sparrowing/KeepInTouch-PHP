<?php

    require_once("Database.php");
    require_once("Post.php");

    // Manages Post objects and how they interact with the database
    class PostManager {

        private static $ID_COL        = "id";
        private static $USERID_COL    = "user_id";
        private static $TITLE_COL     = "title";
        private static $BODY_COL      = "body";
        private static $TIMESTAMP_COL = "timestamp";

        // Makes a post object from a single MySQLi query row.
        private static function makePostFromRow($row) {
            $r = $row->fetch_assoc();
            return new Post($r[self::$ID_COL], $r[self::$USERID_COL], $r[self::$TITLE_COL],
                    $r[self::$BODY_COL], $r[self::$TIMESTAMP_COL]);
        }

        // Generates a Post object from an array of values
        private static function makePostFromArray($arr) {
            return new Post($arr[0], $arr[1], $arr[2], $arr[3], $arr[4]);
        }

        // Makes an array of post objects from MySQLi query result
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

            // Make sure inputs are valid and user exists
            if (empty($title) || empty($body)) return false;
            if (strlen($title) > 255) return false;
            if ($user == null) return false;

            // Create query
            $query = sprintf("INSERT INTO `%s` (%s, %s, %s) VALUES (?, ?, ?)",
                    Properties::POST_TABLE, self::$USERID_COL, self::$TITLE_COL, self::$BODY_COL);
            $params = [$user->getID(), $title, $body];
            $pattern = "iss";

            // Check database
            $result = Database::queryDb($query, $params, $pattern);

            // Return false if post can't be inserted
            if ($result == false) return false;

            // Fetch and return new post
            $id = mysqli_insert_id(Database::getConnection());
            $post = self::getPostById($id);

            return $post;
        }

        public static function deletePost($postId) {

            // Create query
            $query = sprintf("DELETE FROM `%s` WHERE %s = ?",
                    Properties::POST_TABLE, self::$ID_COL);
            $params = [$postId];
            $pattern = "i";

            // Run query
            $result = Database::queryDB($query, $params, $pattern);

            // $result returns false if the query failed and true otherwise
            return $result;
        }

        public static function getPostById($id) {

            // Create query
            $query = sprintf("SELECT * FROM `%s` WHERE %s = ?",
                    Properties::POST_TABLE, self::$ID_COL);
            $params = [$id];
            $pattern = "i";

            // Check database
            $result = Database::queryDbRow($query, $params, $pattern);

            // Return false if post is not found or anything went wrong
            if ($result == false) return false;

            // Turn result row into a post object
            $post = self::makePostFromRow($result);

            // Return the post object
            return $post;
        }

        public static function getPostsByUser($user) {

            // Create query
            // Note - orders them newest to oldest
            $query = sprintf("SELECT * FROM `%s` WHERE %s = ? ORDER BY %s DESC",
                    Properties::POST_TABLE, self::$USERID_COL, self::$TIMESTAMP_COL);
            $params = [$user->getId()];
            $pattern = "i";

            // Search database
            $result = Database::queryDb($query, $params, $pattern);

            return self::makePostArray($result);
        }

        public static function getAllPosts() {

            // Create query
            $query = sprintf("SELECT * FROM `%s` ORDER BY %s DESC",
                    Properties::POST_TABLE, self::$TIMESTAMP_COL);
            $params = false;
            $pattern = "";

            // Check database
            $result = Database::queryDb($query);

            return self::makePostArray($result);
        }

    }

 ?>
