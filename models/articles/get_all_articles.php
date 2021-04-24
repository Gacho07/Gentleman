<?php
header("Content-Type: application/json");

require_once "../../config/connection.php";
require_once "functions.php";

$data = null;
$code = 404;

try {
    $data = getAllArticles();
    $code = 200;
} catch (PDOException $ex) {
    recoredErrors($ex->getMessage());
    $code = 500;
}

echo json_encode($data);
http_response_code($code);