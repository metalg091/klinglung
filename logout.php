<?php
session_start();
session_unset();
setcookie("login", true, time()-1);
header("Location: index.php");
?>