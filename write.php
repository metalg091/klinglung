<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Klinglung - writing</title>
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
<div class="card m-5">
    <h4 class="card-header p-4"><div class="mx-3">
        <?php
                session_start();
                include "dbconn.php";
                $id = 0;
                if(is_numeric($_GET["table"])){
                    $id = $_GET["table"];
                } else{
                    $id = 0;
                }
                $sql = "SELECT MAX(id) FROM `". $id . "`";
                $result = mysqli_query($conn, $sql);
                $n = mysqli_fetch_assoc($result);
                $n = $n["MAX(id)"];
                $n++;
                if(empty($_SESSION["correct"]) || empty($_SESSION["seen"]) || strlen($_SESSION["correct"]) <> $n || strlen($_SESSION["seen"]) <> $n){
                    for($i = 0; $i < $n - 1; $i++){
                        $_SESSION["correct"] = $_SESSION["correct"] . "a";
                        $_SESSION["seen"] = $_SESSION["seen"] . "a";
                    }
                }
                $c = random_int(0, $n-1);
                $first = true;
                while($_SESSION["seen"][$c] == "b"){
                    if($c < $n - 1){
                        $c++;
                    } else{
                        $c = 0;
                        if(!$first){
                            $comp = true;
                            for($i = 0; $i<strlen($_SESSION["correct"]); $i++){
                                if($_SESSION["correct"][$i] == "a"){
                                    $comp = false;
                                    $_SESSION["seen"][$i] = "a";
                                }
                            }
                            if($comp){
                                header('Location: done.php');
                            }
                        }
                        $first = false;
                    }
                }
                $sql = "SELECT nat FROM `". $id . "` WHERE id = " . $c;
                $result = mysqli_query($conn, $sql);
                $nat = mysqli_fetch_assoc($result);
                echo $nat["nat"];
                mysqli_close($conn);
            ?>
    </div></h4>
    <div class="card-body">
        <form action="check.php" methode="get">
            <input id="id" type="text" name="id" value="<?php echo $c;?>" style="display: none;">
            <input name="table" value="<?php echo $id;?>" style="display: none;">
            <div class="container my-3"><div class="row">
                <div class="col"><input type="text" autocomplete="off" id="en" name="ans" class="form-control"></div>
                <div class="col-1"><input type="submit" class="form-control btn btn-outline-primary" value="check"></div>
            </div></div>
        </form>
    </div>
</div>
<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>