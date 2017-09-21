<?php

    // Include config file
    require_once("../library/config.php");

    require_once("../classes/User.php");
    require_once("../classes/UserManager.php");

    // Render front page
    // TODO Find a less error-prone way to render pages
    render("main_page.php",
           ["title" => "Home",
            "user" => getLogin()]
    );

 ?>
