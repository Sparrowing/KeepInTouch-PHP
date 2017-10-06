<?php

    require_once("../classes/User.php");
    require_once("../classes/UserManager.php");

    // Fetch logged in user (or false if not logged in)
    function getLogin() {
        // If session is set, get the user with that ID
        return isset($_SESSION["id"]) ? UserManager::getUserById($_SESSION["id"]) : false;
    }

    function htmlEscape($escapeString) {
        return htmlspecialchars($escapeString);
    }

    // Logs in the user with the provided id.
    function login($userId) {
        $_SESSION["id"] = $userId;
    }

    // Logs current user out.
    function logout() {
        $_SESSION = [];
        if (!empty($_COOKIE[session_name()]))
            setcookie(session_name(), "", time() - 42000);
        session_destroy();
    }

    // Redirects to a new page.
    function redirect($location) {
        header("Location: /keepintouch/controllers/{$location}");
    }

    // Renders template with values.
    function render($view, $values = []) {
        if (file_exists("../templates/{$view}")) { // If template exists

            extract($values);

            require("../templates/header.php");
            require("../templates/{$view}");
            require("../templates/footer.php");

            exit;
        }

        // If template doesn't exist or fails to render
        echo "Something went wrong with rendering.";
    }

    // Returns true if string $str starts with substring $start, else false.
    function startsWith($str, $start) {
        $length = strlen($start);
        return (substr($str, 0, $length) == $start);
    }

 ?>
