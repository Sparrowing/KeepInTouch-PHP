<?php

    require_once("functions.php");
    require_once("../Properties.php");

    // Start/resume session
    // TODO Handle error in case of failed session Start
    //      (session_start() returns true if it's successful and false if not)
    session_start();

    $u = getLogin();

 ?>
