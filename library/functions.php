<?php

    require_once("../classes/User.php");
    require_once("../classes/UserManager.php");

    function getLogin() {
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
        }

        // If template doesn't exist, does nothing
        // TODO Handle render errors
    }

    function renderError($values = []) {
        extract($values);
        require("../templates/error_page.php");
    }

    function sqlEscape($escapeString) {
        return Database::getConnection()->escape_string($escapeString);
    }

 ?>
