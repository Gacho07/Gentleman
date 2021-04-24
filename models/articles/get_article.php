<?php
header("Content-Type: application/json");

$data = null;
$code = 404;

if (isset($_POST["id"])) {
    require_once "../../config/connection.php";
    require_once "functions.php";

    $id = $_POST["id"];

    try {
        $data = getOneArticle($id);
        $code = 200;
    } catch (PDOException $ex) {
        recoredErrors($ex->getMessage());
        $code = 500;
    }
} else {
    $code = 400;
}

http_response_code($code);
echo json_encode($data);