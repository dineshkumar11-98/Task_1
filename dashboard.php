<?php
    include "includes/database.php";
    session_start();

    $selectQuery = "select * from users;";
    $execQuery = $connect->prepare($selectQuery);
    $execQuery->execute();

    $users = $execQuery->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <div class="main_container">
        <ul class="page_list">
            <?php
                while($user = $users->fetch_assoc()) {
                    echo "<li><span class=\"username\">".$user['user_name']."</span><span class=\"options\"><button class=\"btn\" onClick=\"OnEditClicked('".$user['user_name']."')\">Edit</button><button class=\"btn\" onClick=\"OnDeleteClicked('".$user['user_name']."')\">Delete</button><button class=\"btn\" onClick=\"OnViewClicked('".$user['user_name']."')\">View</button></span></li>";
                }
            ?>
        </ul>
    </div>
    <script src="js/dashboard.js"></script>
</body>
</html>