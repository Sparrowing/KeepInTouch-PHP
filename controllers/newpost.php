<?php

    require_once("../library/config.php");

    require_once("../classes/User.php");
    require_once("../classes/PostManager.php");
    require_once("../classes/Post.php");

    // Redirect unregistered users
    if (!$u) redirect("index.php");

    if ($_SERVER["REQUEST_METHOD"] == "GET") {

        // Render blank form
        render("newpost_form.php",
               ["title" => "New Post",
                "user" => $u,
                "error" => "",
                "titleValue" => "",
                "bodyValue" => ""]
        );

    } else if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Render with error if either field is empty
        if (empty($_POST["title"]) || empty($_POST["body"])) {
            render("newpost_form.php",
                   ["title" => "New Post",
                    "user" => $u,
                    "error" => "Must have a title and a body.",
                    "titleValue" => htmlEscape($_POST["title"]),
                    "bodyValue" => htmlEscape($_POST["body"])]
            );
            exit;
        }

        $postTitle = $_POST["title"];
        $postBody  = $_POST["body"];

        // Assure post title isn't longer than the database setup can handle
        if (strlen($postTitle) > 255) {
            render("newpost_form.php",
                   ["title" => "New Post",
                    "user" => $u,
                    "error" => "Post title too long.",
                    "titleValue" => htmlEscape($postTitle),
                    "bodyValue" => htmlEscape($postBody)]
            );
            exit;
        }

        // Attempt to create post in the database
        $newPost = PostManager::createPost($u, $postTitle, $postBody);

        // Display error if post somehow couldn't be created
        if ($newPost) redirect("error.php");

        redirect("userhome.php?u=" . $u->getId());
    }

 ?>
