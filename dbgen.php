<?php
    $myfile = fopen("negligent.txt", "r") or die("Unable to open file!");
    
    $db = new SQLite3('words.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
    $db->query('CREATE TABLE IF NOT EXISTS "words" (
        "id" INTEGER UNIQUE NOT NULL,
        "en" TEXT,
        "hu" TEXT)');
    // Output one line until end-of-file
    $i = 0;
    while(!feof($myfile)) {
        $a = (fgets($myfile));
        $b = (fgets($myfile));
        $db->exec('BEGIN');
        $db->query('INSERT INTO words (id, en, hu) VALUES (' . $i . ', "' . $a . '", "' . $b . '")');
        $db->exec('COMMIT');
        $i++;
    }
    fclose($myfile);
?>