<?php

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
            // TODO
            return $rawTimestamp;
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
