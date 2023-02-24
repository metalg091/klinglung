<?php
    session_start();
    for($i = 0; $i < strlen($_SESSION["correct"]); $i++){
        $_SESSION["seen"][$i] = "b";
        $_SESSION["correct"][$i] = "b";
    }
?>