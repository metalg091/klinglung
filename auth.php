<?php
    session_start();
    if(!isset($_POST["email"], $_POST["passwd"])){
        die("Email, password not given");
    }
    $pass = $_POST["passwd"];
    $dbaddress = "localhost:3306";
    $username = "test";
    $passwd = '1234';
    $db = 'account';
    $conn = mysqli_connect($dbaddress, $username, $passwd, $db);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $mail = mysqli_real_escape_string($conn, $_POST["email"]);
    $userin = mysqli_real_escape_string($conn, $_POST["username"]);
    if(isset($_POST["reg"])){
        $sql = "SELECT MAX(id) FROM `profiles`";
        $result = mysqli_query($conn, $sql);
        $n = mysqli_fetch_assoc($result);
        $n = $n["MAX(id)"];
        $n++;
        $sql = "INSERT INTO `profiles` (`id`, `username`, `email`, `passwd`) VALUES ('" . $n . "', '" . $userin . "', '" . $mail . "', '" . password_hash($pass, PASSWORD_DEFAULT) . "')";
        if (mysqli_query($conn, $sql)) {
            echo "Inserted data successfully<br>";
        } else {
            echo "<br>Error: ". $sql . "<br>" . mysqli_error($conn);
        }
        $_SESSION["name"] = $userin;
        $_COOKIE["login"] = true;
    } else{
        $sql = "SELECT username, passwd FROM `profiles` WHERE `email` = '" . $mail ."'";
        $result = mysqli_query($conn, $sql);
        if(!$result){
            die("error"); 
        }
        $row = mysqli_fetch_assoc($result);
        $hash = $row["passwd"];
        $username = $row["username"];
        if(password_verify($pass, $hash)){
            $_SESSION["name"] = $username;
            $_COOKIE["login"] = true;
            header("Location: index.php");
        }else{
            echo "wrong password";
        }
    }
    mysqli_close($conn);
?>