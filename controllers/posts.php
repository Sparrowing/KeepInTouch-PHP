<?php

    require_once("../library/config.php");

    require_once("../classes/User.php");
    require_once("../classes/UserManager.php");
    require_once("../classes/Post.php");
    require_once("../classes/PostManager.php");

    // Redirect unregistered users
    if (!$u) {
        redirect("index.php");
    }


    if ($_SERVER["REQUEST_METHOD"] == "GET") {

        // If only user is given, redirect to that user's page
        if (empty($_GET["p"]) && !empty($_GET["u"])) {
            redirect("userhome.php?u=" . htmlEscape($_GET["u"]));
        }

        // Else if post OR user is not provided, not found
        if (empty($_GET["p"]) || empty($_GET["u"])) {
            render("not_found.php",
                   ["title" => "Not Found",
                    "user" => $u]
            );
            exit;
        }

        $postId = $_GET["p"];
        $userId = $_GET["u"];

        $post = PostManager::getPostById($postId);
        $user = UserManager::getUserById($userId);

        // If post or user ids could not be found, not found
        if (!$post || !$user) {
            render("not_found.php",
                   ["title" => "Not Found",
                    "user" => $u]
            );
            exit;
        }

        // If post author doesn't match the user, not found
        if ($post->getUserId() != $user->getId()) {
            render("not_found.php",
                   ["title" => "Not Found",
                    "user" => $u]
            );
            exit;
        }

        // Else all is well, render post
        render("post_display.php",
               ["title" => $post->getTitle(),
                "user" => $u,
                "post" => $post]
        );

    }

 ?>
