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

        if (!empty($_GET["u"])) {

            $user = UserManager::getUserById(sqlEscape($_GET["u"]));
            if ($user == false) {
                renderError(["error" => "User not found."]);
                exit;
            }

            render("user_page.php",
                   ["title" => $user->getUsername(),
                    "user" => $u,
                    "username" => $user->getUsername(),
                    "posts" => PostManager::getPostsByUser($user)]
            );
            exit;
        }

        renderError(["error" => "User not found."]);
        exit;
    }

 ?>
