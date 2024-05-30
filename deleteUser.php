<?php
    include "includes/database.php";

    $postString = file_get_contents("php://input");
    $postArray  = json_decode($postString, true);

    $deleteQuery = "DELETE FROM users WHERE user_name=?;";
    $execQuery = $connect->prepare($deleteQuery);
    $execQuery->bind_param("s",$postArray['username']);
    $execQuery->execute();

    echo "{\"isValid\":\"true\"}";
?>