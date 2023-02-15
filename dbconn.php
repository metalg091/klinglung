<?php
    $dbaddress = "localhost:3307";
    $username = "root";
    $passwd = '';
    $db = 'wordlist';
    $conn = mysqli_connect($dbaddress, $username, $passwd, $db);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>