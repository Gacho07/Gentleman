<?php
header("Content-Type: application/json");

require_once "../../config/connection.php";
require_once "functions.php";

$code = 404;
$data = null;

try {
    $data = getAllUsers();
    $code = 200;
} catch (PDOException $ex) {
    recoredErrors($ex->getMessage());
    $code = 500;
}

http_response_code($code);
echo json_encode($data);