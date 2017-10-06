<?php

    require_once("../library/config.php");

    require_once("../classes/Post.php");
    require_once("../classes/PostManager.php");
    require_once("../classes/User.php");

    // Redirect unregistered users
    if (!$u) {
        redirect("index.php");
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $postId = $_POST["id"];

        // Check this post is owned by the logged in user
        // If post id isn't valid this if statement won't go through anyway
        if (PostManager::getPostById($postId)->getUserId() == $u->getId()) {

            // Attempt to delete the post
            $result = PostManager::deletePost($postId);

            // Display error if post couldn't be deleted
            if (!$result) redirect("error.php");
        }

        // If it worked, redirect back to user's page
        redirect("userhome.php?u=" . $u->getId());
    }

 ?>
