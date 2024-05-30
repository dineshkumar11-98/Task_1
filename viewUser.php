<?php
    include "includes/database.php";
    session_start();

    $selectQuery = "select * from users;";
    $execQuery = $connect->prepare($selectQuery);
    $execQuery->execute();

    $users = $execQuery->get_result();

    $userMatch = "false";
    $data = [];

    while($user = $users->fetch_assoc()) {
        if($user['user_name'] == $_SESSION['user']){
            $data = $user;
            break;
        }
    }
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
        <div class="form">
            <div class="inputBox">
                <label for="userName">userName</label>
                <input type="text" id="userName" value="<?php echo $data["user_name"]; ?>" <?php if($_SESSION["mode"] == "view"){echo "disabled";} ?>>
            </div>
            <div class="inputBox">
                <label for="phNo">Phone No</label>
                <input type="text" id="phNo" value="<?php echo $data["phNo"]; ?>" <?php if($_SESSION["mode"] == "view"){echo "disabled";} ?>>
            </div>
            <div class="radioBox">
                <label for="gender">Gender</label>
                <input type="radio" value="male" name="gender" <?php if($data["gender"] == "male") {echo "checked";} ?>>Male
                <input type="radio" value="female" name="gender" <?php if($data["gender"] == "female") {echo "checked";} ?>>Female
            </div>
            <div class="inputBox">
                <label for="address">Address</label>
                <textarea id="address" rows="5" <?php if($_SESSION["mode"] == "view"){echo "disabled";} ?>><?php echo $data["address"]; ?></textarea>
            </div>
            <div class="inputBox">
                <label for="password">Password</label>
                <input type="text" id="password"  value="<?php echo $data["password"]; ?>" <?php if($_SESSION["mode"] == "view"){echo "disabled";} ?>>
            </div>
            <?php
                if($_SESSION["mode"] == "edit") {
                    echo "<div class=\"btns\"><button class=\"btn\" id=\"update\">Update</button></div>";
                }
            ?>
            <script>
                let updateBtn = document.getElementById("update");
                let onClickUpdate = ()=>{
                    let username = document.querySelector("#userName").value;
                    let phno = document.querySelector("#phNo").value;
                    let gender = document.querySelector('input[name="gender"]:checked').value;
                    let address = document.querySelector("#address").value;
                    let password = document.querySelector("#password").value;

                    fetch("./updateUser.php", {
                        method: "POST",
                        headers: {
                            "content-Type" : "application/json; charset=utf-8"
                        },
                        body: JSON.stringify({username: username, password: password, phno: phno, gender: gender, address: address})
                    }).then(
                        responsePromise => responsePromise.json()
                    ).then(
                        response => {
                            if(response.isValid === "true") {
                                window.location = "./dashboard.php"
                            }
                        }
                    )
                }
                if(updateBtn != null) {
                    updateBtn.addEventListener("click", onClickUpdate);
                }
            </script>
        </div>
    </div>
</body>
</html>