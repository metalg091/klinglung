<?php
    $dbaddress = "localhost:3307";
    $username = "root";
    $passwd = '';
    $conn = mysqli_connect($dbaddress, $username, $passwd);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "CREATE DATABASE account";
    if(mysqli_query($conn, $sql)){
        echo "Created account database!<br>";
    } else{
        echo "ERROR creating account database: " . mysqli_error($conn) . "<br>";
    }
    $sql = "CREATE DATABASE wordlist";
    if(mysqli_query($conn, $sql)){
        echo "Created wordlist database!<br>";
    } else{
        echo "ERROR creating wordlist database: " . mysqli_error($conn) . "<br>";
    }
    $sql = "CREATE TABLE `account`.`profiles` (
        `id` INT NOT NULL , 
        `username` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
        `email` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
        `passwd` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
        PRIMARY KEY (`id`), UNIQUE (`username`), UNIQUE (`email`)) ENGINE = MyISAM;";
    if(mysqli_query($conn, $sql)){
        echo "Created profiles table!<br>";
    } else{
        echo "ERROR creating profiles table: " . mysqli_error($conn) . "<br>";
    }
    $sql = "CREATE TABLE `wordlist`.`ite` (`id` INT NOT NULL DEFAULT '0' ) AS SELECT 0 AS id";
    if (mysqli_query($conn, $sql)) {
        echo "Ite table created successfully<br>";
    } else {
        echo "ERROR creating ite table: " . mysqli_error($conn) . "<br>";
    }
    $sql = "CREATE TABLE `wordlist`.`info` (
        `id` INT NOT NULL, 
        `name` TINYTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL, 
        `desc` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL, 
        `creator` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci, 
        PRIMARY KEY (`id`))";
    if (mysqli_query($conn, $sql)) {
        echo "info table created successfully<br>";
    } else {
        echo "ERROR creating info table: " . mysqli_error($conn) . "<br>";
    }
    echo "DONE!!!"; 
    mysqli_close($conn);
?>