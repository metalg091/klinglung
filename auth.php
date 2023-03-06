<?php
    session_start();
    if(!isset($_POST["email"], $_POST["passwd"])){
        die("Email, password not given");
    }
    $pass = $_POST["passwd"];
    $dbaddress = "localhost:3307";
    $username = "root";
    $passwd = '';
    $db = 'account';
    $conn = mysqli_connect($dbaddress, $username, $passwd, $db);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $mail = mysqli_real_escape_string($conn, $_POST["email"]);
    if(isset($_POST["username"])){
        $userin = mysqli_real_escape_string($conn, $_POST["username"]);
    }
    if(isset($_POST["reg"])){
        $sql = "SELECT MAX(id) FROM `profiles`";
        $result = mysqli_query($conn, $sql);
        $n = mysqli_fetch_assoc($result);
        $n = $n["MAX(id)"];
        $n++;
        $sql = "INSERT INTO `profiles` (`id`, `username`, `email`, `passwd`) VALUES ('" . $n . "', '" . $userin . "', '" . $mail . "', '" . password_hash($pass, PASSWORD_DEFAULT) . "')";
        if (mysqli_query($conn, $sql)) {
            header("Location: index.php");
        } else {
            header("Location: login.php");
        }
        $_SESSION["name"] = $userin;
        setcookie("login", true, 0);
    } else{
        $sql = "SELECT username, passwd FROM `profiles` WHERE `email` = '" . $mail ."'";
        $result = mysqli_query($conn, $sql);
        if(!$result){
            header("Location: login.php");
            die("error"); 
        }
        $row = mysqli_fetch_assoc($result);
        $hash = $row["passwd"];
        $uname = $row["username"];
        if(password_verify($pass, $hash)){
            $_SESSION["name"] = $uname;
            setcookie("login", true, 0);
            header("Location: index.php");
        }else{
            header("Location: login.php");
        }
    }
    mysqli_close($conn);
?>