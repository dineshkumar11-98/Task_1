<?php
    session_start();

    $postString = file_get_contents("php://input");
    $postArray  = json_decode($postString, true);

    $_SESSION['user'] = $postArray["username"];
    $_SESSION['mode'] = $postArray["mode"];
?>