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
    $sql = "CREATE TABLE `0` (
        `id` INT NOT NULL UNIQUE, 
        `fore` TINYTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL, 
        `nat` TINYTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL, 
        PRIMARY KEY (`id`)
        )";

    if (mysqli_query($conn, $sql)) {
        echo "Table MyGuests created successfully";
    } else {
        echo "Error creating table: " . mysqli_error($conn);
    }
    $id = 0;
    for($i = 0; $i < count($inp)-1; $i+=2){
        $inp[$i] = mysqli_real_escape_string($conn, $inp[$i]);
        $inp[$i+1] = mysqli_real_escape_string($conn, $inp[$i+1]);
        $sql = "INSERT INTO `0` (`id`, `fore`, `nat`) VALUES ('" . $id . "', '" . $inp[$i] . "', '" . $inp[$i+1] . "');";
        //Don't worry phpMyAdmin does NOT disply it as utf8 and thus the input seems corrupted, but it is NOT!!!
        if (mysqli_query($conn, $sql)) {
            echo "Inserted data successfully";
        } else {
            echo "Error: ". $sql . "<br>" . mysqli_error($conn);
        }
        $id++;
    }

    echo '<pre>'; print_r($inp); echo '</pre>';
    mysqli_close($conn);
?>