<?php

    // Include config file
    require_once("../library/config.php");

    require_once("../classes/PostManager.php");

    if (!$u) {
        render("main_page.php",
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

    // // Render front page
    // // TODO Find a less error-prone way to render pages
    // render("main_page.php",
    //        ["title" => "Home",
    //         "user" => getLogin()]
    // );

 ?>
