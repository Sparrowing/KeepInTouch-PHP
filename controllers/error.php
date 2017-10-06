<?php

    require_once("../library/config.php");

    render("error_page.php",
           ["title" => "Error!",
            "user" => $u]
    );

 ?>
