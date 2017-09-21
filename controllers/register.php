<?php

    // Include config file
    require_once("../library/config.php");

    require_once("../classes/User.php");
    require_once("../classes/UserManager.php");

    $title = "Register";
    $registerForm = "register_form.php";

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // If GET request

        // Render register page
        render($registerForm,
               ["title" => $title,
                "user" => $u,
                "error" => "",
                "usernameValue" => ""]
        );

    } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Else if POST request

        // Check for empty fields
        if (empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["confirm"])) {
            // If any empty fields

            // Re-render with error
            render($registerForm,
                    ["title" => $title,
                     "user" => $u,
                     "error" => "Must fill in all fields.",
                     "usernameValue" => $_POST["username"]]
            );

            // Exit script
            exit();
        }

        // Assign input values to variables
        $username = $_POST["username"];
        $password = $_POST["password"];
        $confirm  = $_POST["confirm"];

        // Make sure username is valid
        if (!User::isValidUsername($username)) {
            // If username is not valid
            render($registerForm,
                   ["title" => $title,
                    "user" => $u,
                    "error" => "Invalid username.",
                    "usernameValue" => $_POST["username"]]
            );
            exit;
        }

        // Make sure username isn't already in use
        if (UserManager::getUserByName($username)) {
            // If user already exists with name
            render($registerForm,
                   ["title" => $title,
                    "user" => $u,
                    "error" => "Username already in use.",
                    "usernameValue" => $_POST["username"]]
            );
            exit;
        }

        if (!User::isValidPassword($password)) {
            // If password is not valid
            render($registerForm,
                   ["title" => $title,
                    "user" => $u,
                    "error" => "Invalid password.",
                    "usernameValue" => $_POST["username"]]
            );
            exit;
        }

        // Check that password matches confirmation
        if ($password !== $confirm) {
            // If password and confirmation do not match
            render($registerForm,
                   ["title" => $title,
                    "user" => $u,
                    "error" => "Password and confirmation do not match.",
                    "usernameValue" => $_POST["username"]]
            );
            exit;
        }

        // If code reaches this point, all form information is valid.  Can
        //    proceed to create user.

        // Create user
        $newUser = UserManager::createUser($username, $password);

        // Log user in
        login($newUser->getId());

        // Redirect to index
        redirect("index.php");

    }

 ?>
