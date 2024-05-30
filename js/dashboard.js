function OnViewClicked(userName) {
    fetch("./selected.php", {
        method: "POST",
        headers: {
            "content-Type" : "application/json; charset=utf-8"
        },
        body: JSON.stringify({mode: "view", username: userName})
    }).then(
        window.location = "./viewUser.php"
    )
}

function OnDeleteClicked(userName) {
    console.log(userName)
    fetch("./deleteUser.php", {
        method: "POST",
        headers: {
            "content-Type" : "application/json; charset=utf-8"
        },
        body: JSON.stringify({username: userName})
    }).then(
        responsePromise => responsePromise.json()
    ).then(
        response => {
            if(response.isValid === "true") {
                window.location.reload();
            }
        }
    )
}

function OnEditClicked(userName) {
    fetch("./selected.php", {
        method: "POST",
        headers: {
            "content-Type" : "application/json; charset=utf-8"
        },
        body: JSON.stringify({mode: "edit", username: userName})
    }).then(
        window.location = "./viewUser.php"
    )
}