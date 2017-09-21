<?php

    require_once("../library/config.php");

    require_once("../classes/User.php");
    require_once("../classes/UserManager.php");

    $u = isset($_SESSION["id"]) ? UserManager::getUserById($_SESSION["id"]) : false;

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // If GET request
        render("login_form.php",
               ["title" => "Login",
                "user" => $u,
                "error" => "",
                "usernameValue" => ""]
        );

    } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // If POST request
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

        if ($user == false) {
            render("login_form.php",
                   ["title" => "Login",
                    "user" => $u,
                    "error" => "User not found.",
                    "usernameValue" => htmlEscape($_POST["username"])]
            );
            exit;
        }

        if (!($user->isPasswordMatch($password))) {
            render("login_form.php",
                   ["title" => "Login",
                    "user" => $u,
                    "error" => "Incorrect password.",
                    "usernameValue" => htmlEscape($_POST["username"])]
            );
            exit;
        }

        login($user->getId());

        redirect("index.php");
    }

 ?>
