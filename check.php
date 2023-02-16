<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Klinglung</title>
    <?php
        session_start();
        include "dbconn.php"
        $table = 0;
        if(is_numeric($_GET["table"])){
            $table = $_GET["table"];
        } else{
            $table = 0;
        }
        $id = 0;
        if(is_numeric($_GET["id"])){
            $id = $_GET["id"];
        } else{
            $id = 0;
        }
        $sql = "SELECT fore, nat FROM " . $table . " WHERE id=" . $id;
        $result = mysqli_query($conn; $sql);
        $row = mysqli_fetch_assoc($result);
        $fore = $row["fore"];
        $nat = $row["nat"];
        $_SESSION["seen"][$id] = "b";
        $ans;
        $fore = rtrim($fore);
        $ans = rtrim($_GET["ans"]);
        $sol;
        if(strcmp($ans, $fore) == 0){
            $sol = true;
            $_SESSION["correct"][$id] = "b";
        }else{
            $sol = false;
        }
        mysqli_close($conn);
    ?>
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
                    <a class="nav-link" aria-current="page" href="index.php">Home</a>
                </li>
                <!--li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled">Disabled</a>
                </li-->
            </ul>
            <div class="d-flex">
                <button type="button" class="btn btn-info" onclick="location.href='newlist.php'">Create New</button>
            </div>
        </div>
    </div>
</nav>
<div class="container">
    <div class="card border border-2 border-success">
        <div class="card-header">
            <div class="row mx-2 my-1">
                <h5 class="card-title col mt-2 text-<?php if($sol){ echo "success";} else { echo "danger";} ?>"><?php if($sol){ echo "Correct!";} else { echo "Wrong!"} ?></h5>
                <a class="btn btn-primary col-2 col-sm-2 col-md-2 col-lg-1 col-1" href="write.php">Next</a>
            </div>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Definition</li>
                <li class="list-group-item border-0 ms-5 mb-3"><?php echo $nat;?></li>
                <li class="list-group-item">You said</li>
                <li class="list-group-item border-0 ms-5 mb-3"><?php echo $ans;?></li>
                <li class="list-group-item">Correct</li>
                <li class="list-group-item border-0 ms-5 mb-3"><?php echo $fore;?></li>
            
        </div>
    </div>
</div>
<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>