<?php
    session_start();
    unset($_SESSION);
    $_SESSION = array();// This line is optional
    session_destroy();
    session_regenerate_id(true);
    header("Location: login.php");
    exit();
    ?>
