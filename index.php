<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Klinglung</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-dark navbar-expand-lg text-bg-primary mb-5"> <!-- Supposed to use some "data-bs-theme="dark"" stuff, doesn't work -->
    <div class="container-fluid mx-3">
        <a class="navbar-brand" href="#">Klinglung</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item" style="display: none;" id="mset">
                    <a class="nav-link" href="mysets.php">My sets</a>
                </li>
            </ul>
            <div class="d-flex">
                <button type="button" class="btn btn-info" id ="navbtn" onclick="change();">Login</button>
            </div>
        </div>
    </div>
</nav>
<div class="container">
    <!--Row with three equal columns-->
    <div class="row" id="list">
    </div>
</div>
<script>
    <?php
        include "dbconn.php";
        $sql = "SELECT * FROM info";
        $result = mysqli_query($conn, $sql);
        $nameArray = array();
        $descArray = array();
        while($row = mysqli_fetch_array($result)){
            array_push($nameArray, $row["name"]);
            array_push($descArray, $row["desc"]);
        }
        mysqli_close($conn);
    ?>
    var title = <?php echo json_encode($nameArray);?>;
    var desc = <?php echo json_encode($descArray);?>;
    for(var i = 0; i < title.length; i++){
        var wrap = document.createElement("div");
            wrap.className = "col";
            var card = document.createElement("div");
                card.className = "shadow card my-3";
                card.style = "width: 20rem;";
                wrap.appendChild(card);
            var bd = document.createElement("div");
                bd.className = "card-body";
                card.appendChild(bd);
            var ctitle = document.createElement("h5");
                ctitle.className = "card-title";
                ctitle.innerText = title[i];
                bd.appendChild(ctitle);
            var ctext = document.createElement("p");
                ctext.className = "card-text";
                ctext.innerText = desc[i];
                bd.appendChild(ctext);
            var button = document.createElement("a");
                button.className = "btn btn-primary";
                button.href = "wordlist.php?id=" + i;
                button.innerText = "Practice";
                bd.appendChild(button);
        document.getElementById("list").appendChild(wrap);
    }
</script>
<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="script/login.js"></script>
</body>
</html>