<html>
<head>
    <?php
        session_start();
        $_SESSION["seen"] = "";
        $_SESSION["correct"] = "";
        include "dbconn.php";
        $id = 0;
        if(is_numeric($_GET["id"])){
            $id = $_GET["id"];
        } else{
            $id = 0;
        }
        $result = mysqli_query($conn, "SELECT `name`, `desc` FROM `info` WHERE id = " . $id . " LIMIT 1");
        $row = mysqli_fetch_assoc($result);
        $title = $row["name"];
        $desc = $row["desc"];
        $sql = "SELECT * FROM `" . $id . "`";
        $result = mysqli_query($conn, $sql);
        $wid = array();
        $fore = array();
        $nat = array();
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                array_push($wid, $row["id"]);
                array_push($fore, $row["fore"]);
                array_push($nat, $row["nat"]);
            }
        } else{
            echo "no result";
        }
        mysqli_close($conn);
    ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Klinglung - <?php echo $title; ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="script/login.js"></script>
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
                    <a class="nav-link" aria-current="page" href="index.php">Home</a>
                </li>
            </ul>
            <div class="d-flex">
                <button type="button" class="btn btn-info" id ="navbtn" onclick="change();">Login</button>
            </div>
        </div>
    </div>
</nav>
<div class="container" id="ah">
    <div class="row">
        <h1><?php echo $title;?></h1>
    </div>
    <div class="row mb-5 me-2">
        <h5 class="col-10 col-lg-11"><?php echo $desc;?></h5>
        <button class="col-2 col-lg-1 btn btn-outline-primary" onclick="location.href='write.php?table=<?php echo $id;?>'">Write</button>
    </div>
</div>
<!-- Bootstrap JS Bundle with Popper -->
<script>
    var foreign = <?php echo json_encode($fore); ?>;
    var native = <?php echo json_encode($nat); ?>;
    for(var i = 0; i < foreign.length; i++){
        var wrap = document.createElement("ul");
        wrap.className = "list-group list-group-horizontal";
        var fore = document.createElement("li");
        fore.className = "col list-group-item border-end-0 mb-1";
        fore.innerText = foreign[i]; 
        wrap.appendChild(fore);
        var nat = document.createElement("li");
        nat.className = "col list-group-item border-start-0 mb-1";
        nat.innerText = native[i];
        wrap.appendChild(nat);
        document.getElementById("ah").appendChild(wrap);
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>

