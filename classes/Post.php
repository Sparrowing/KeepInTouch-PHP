<?php

    require_once("UserManager.php");

    class Post {

        private $id;
        private $userId;
        private $title;
        private $body;
        private $timestamp;

        public function __construct($id, $userId, $title, $body, $timestamp) {
            $this->id = $id;
            $this->userId = $userId;
            $this->title = $title;
            $this->body = $body;
            $this->timestamp = self::formatTimestamp($timestamp);
        }

        // Formats the raw timestamp saved in the database to a more optimal
        //    date string.
        public static function formatTimestamp($rawTimestamp) {
            $timeString = date("h:i a | F j, o", strtotime($rawTimestamp));
            return $timeString;
        }

        // Returns an object of the user that authored this post
        public function getPostUser() {
            // Match and map the id of the author ($userId) to a user object
            return UserManager::getUserById($this->userId);
        }

        public function getUrl() {
            return "posts.php?p=" . $this->id . "&u=" . $this->userId;
        }

        public function getId() {
            return $this->id;
        }

        public function getUserId() {
            return $this->userId;
        }

        public function getTitle() {
            return $this->title;
        }

        public function getBody() {
            return $this->body;
        }

        public function getTimestamp() {
            return $this->timestamp;
        }

    }

 ?>
