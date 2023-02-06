<html>
    <head>
        <style>
            #check:hover{
                background-color: lightgray;
            }
        </style>
    </head>
    <body style="background-color: gray;">
        <div style="margin: 50px;"><div style="margin: 50px; font-size: 10em; text-align: center;">
        <?php
            session_start();
            $db = new SQLite3('words.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
            $n = $db->querysingle('SELECT MAX(id) FROM words');
            $n++;
            if(empty($_SESSION["correct"]) || empty($_SESSION["seen"])){
                $_SESSION["correct"] = "a";
                $_SESSION["seen"] = "a";
                $f = $n - 1;
                for($i = 0; $i < $f; $i++){
                    $_SESSION["correct"] = $_SESSION["correct"] . "a";
                    $_SESSION["seen"] = $_SESSION["seen"] . "a";
                }
            }
            $c = random_int(0, $n);
            $first = true;
            while($_SESSION["seen"][$c] == "b"){
                if($c < $n){
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
                            if($comp){
                                header('Location: done.php');
                            }
                        }
                    }
                    $first = false;
                }
            }
            echo $db->querySingle('SELECT hu FROM words WHERE id = ' . $c);
        ?></div>
        <form id="form" action="check.php" method="get">
            <div style="width: auto;">
                <input type="text" autocomplete="off" id="en" name="en" style="width: 75%; border-radius: 50px; padding: 20px; position: relative; left: 13%; font-size: 1.5em"><br><br>
                <div>
                    <input id="id" type="text" name="id" value="<?php echo $c;?>" style="display: none;">
                    <input id="check" type="submit" value="Ellenőrzés" style="position: relative; left: 43.5%; padding: 1.5em; border-radius: 100px; width: 15%">
                </div>
            </div>
        </form>
        </div>
    </body>
</html>