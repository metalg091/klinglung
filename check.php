<html>
    <head>
        <style>
            body{
                font-size: 2em;
                text-align: center;
                font-weight: bolder;
            }
            th, td {
                font-size: 2em;
                padding: 15px;
                border: solid;
                font-weight: bolder;
            }
            button{
                width: 200px;
                padding: 20px;
                border-radius: 50px;
                font-size: 1em;
            }
            button:hover{
                background-color: lightgray;
            }
        </style>
    </head>
<?php
session_start();
$db = new SQLite3('words.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
$en = $db->querySingle('SELECT en FROM words WHERE id = ' . $_GET["id"]);
$hu = $db->querySingle('SELECT hu FROM words WHERE id = ' . $_GET["id"]);
$_SESSION["seen"][$_GET["id"]] = "b";
$ans;
$en = rtrim($en);
$_GET["en"] = rtrim($_GET["en"]);
if(strcmp($_GET["en"], $en) == 0){
    $ans = true;
    $_SESSION["correct"][$_GET["id"]] = "b";
}else{
    $ans = false;
}
?>
<body style="background-color: <?php if($ans){echo "green";}else{echo "red";}?>;">
<?php
if($ans){
    echo "Helyes Válasz!";
}else{
    echo "Rossz Válasz!";
}
?>
<table>
    <tr>
        <td>Magyarul</td>
        <td><?php echo $hu;?></td>
    </tr>
    <tr>
        <td>Helyes Válasz</td>
        <td><?php echo $en;?></td>
    </tr>
    <tr>
        <td>Te Válszod</td>
        <td><?php echo $_GET["en"];?></td>
    </tr>
</table>
<a href="write.php"><button>Kövi</button></a>