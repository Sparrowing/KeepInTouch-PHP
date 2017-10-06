<?php

    // Include config file
    require_once("../library/config.php");

    require_once("../classes/PostManager.php");

    if (!$u) {
        render("empty_page.php",
               ["title" => "Home",
                "user" => $u]
        );
        exit;
    }

    render("all_posts_page.php",
           ["title" => "Home",
            "user" => $u,
            "posts" => PostManager::getAllPosts()]
    );

 ?>
