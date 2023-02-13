<?php
    function multiexplode ($delimiters,$string) {

        $ready = str_replace($delimiters, $delimiters[0], $string);
        $launch = explode($delimiters[0], $ready);
        return  $launch;
    }

    $dbaddress = "localhost:3307";
    $username = "test";
    $passwd = '1234';
    $db = 'wordlist';
    $conn = mysqli_connect($dbaddress, $username, $passwd, $db);
    $inp = array_values(array_filter(multiexplode(array(PHP_EOL,";",":","="), $_POST["words"])));
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "CREATE TABLE IF NOT EXISTS ite (`id` INT NOT NULL DEFAULT '0' ) AS SELECT 0 AS id";
    if (mysqli_query($conn, $sql)) {
        echo "Ite table created successfully<br>";
    } else {
        echo "<br>Error creating ite: " . mysqli_error($conn);
    }
    $sql = "SELECT id FROM `ite`";
    $result = mysqli_query($conn, $sql);
    $row   = mysqli_fetch_row($result); //row[0] (single variable)
    $sql = "CREATE TABLE `" . $row[0] . "` (
        `id` INT NOT NULL UNIQUE, 
        `fore` TINYTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL, 
        `nat` TINYTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL, 
        PRIMARY KEY (`id`)
        )";
    if (mysqli_query($conn, $sql)) {
        echo "Table " . $row[0] . " created successfully<br>";
    } else {
        echo "<br>Error creating table: " . mysqli_error($conn);
    }
    $id = 0;
    for($i = 0; $i < count($inp)-1; $i+=2){
        $inp[$i] = mysqli_real_escape_string($conn, $inp[$i]);
        $inp[$i+1] = mysqli_real_escape_string($conn, $inp[$i+1]);
        $sql = "INSERT INTO `" . $row[0] . "` (`id`, `fore`, `nat`) VALUES ('" . $id . "', '" . $inp[$i] . "', '" . $inp[$i+1] . "');";
        //Don't worry phpMyAdmin does NOT disply it as utf8 and thus the input seems corrupted, but it is NOT!!!
        if (mysqli_query($conn, $sql)) {
            echo "Inserted data successfully<br>";
        } else {
            echo "<br>Error: ". $sql . "<br>" . mysqli_error($conn);
        }
        $id++;
    }
    $sql = "UPDATE `ite` SET id='" . $row[0] + 1 . "' WHERE id=" . $row[0];
    if (mysqli_query($conn, $sql)) {
        echo "Record updated successfully<br>";
    } else {
        echo "<br>Error updating record: " . mysqli_error($conn);
    }
    //echo '<pre>'; print_r($inp); echo '</pre>';
    mysqli_close($conn);
?>