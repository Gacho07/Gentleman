<?php
require_once "config.php";

try {
    $conn = new PDO("mysql:host=".SERVER.";dbname=".DBNAME.";charset=utf8", USERNAME, PASSWORD);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    echo "Error with database connection! " . $ex->getMessage();
}   

function executeQuery($query) {
    global $conn;
    return $conn->query($query)->fetchAll();
}

function recordAccessToPages() {
    $open = fopen(LOG_ACCESS_FILE, "a");
    $write = basename($_SERVER["REQUEST_URI"]) . "\t" . date("d.m.Y H:i:s") . "\t" . $_SERVER["REMOTE_ADDR"] . "\n";
    fwrite($open, $write);
    fclose($open);
}

function recoredErrors($error) {
    $open = fopen(ERRORS_FILE, "a");
    $write = $error . "\t" . date("d.m.Y H:i:s") . "\n";
    fwrite($open, $write);
    fclose($open);
}