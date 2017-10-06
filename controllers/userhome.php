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

            $user = UserManager::getUserById($_GET["u"]);
            if ($user == false) {
                render("not_found.php",
                       ["title" => "Not Found",
                        "user" => $u]
                );
                exit;
            }

            render("user_page.php",
                   ["title" => $user->getUsername(),
                    "user" => $u,
                    "username" => $user->getUsername(),
                    "posts" => PostManager::getPostsByUser($user),
                    "isHomePage" => ($user->getId() == $u->getId())]
            );
            exit;
        }

        redirect("userhome.php?u=" . $u->getId());
    }

 ?>
