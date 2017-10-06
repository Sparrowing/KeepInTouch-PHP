<?php

    require_once("../library/config.php");

    require_once("../classes/User.php");
    require_once("../classes/UserManager.php");

    if ($_SERVER["REQUEST_METHOD"] == "GET") {

        render("login_form.php",
               ["title" => "Login",
                "user" => $u,
                "error" => "",
                "usernameValue" => ""]
        );

    } else if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // If any fields weren't filled out
        if (empty($_POST["username"]) || empty($_POST["password"])) {
            render("login_form.php",
                   ["title" => "Login",
                    "user" => $u,
                    "error" => "Must fill in all fields.",
                    "usernameValue" => htmlEscape($_POST["username"])]
            );
            exit;
        }

        $username = $_POST["username"];
        $password = $_POST["password"];

        $user = UserManager::getUserByName($username);

        // If user with that name doesn't exist/couldn't be found
        if ($user == false) {
            render("login_form.php",
                   ["title" => "Login",
                    "user" => $u,
                    "error" => "User not found.",
                    "usernameValue" => htmlEscape($_POST["username"])]
            );
            exit;
        }

        // If password is incorrect
        if (!($user->isPasswordMatch($password))) {
            render("login_form.php",
                   ["title" => "Login",
                    "user" => $u,
                    "error" => "Incorrect password.",
                    "usernameValue" => htmlEscape($_POST["username"])]
            );
            exit;
        }

        // Log the user in and take them to their home page

        login($user->getId());

        redirect("userhome.php?u=" . $user->getId());
        
    }

 ?>
