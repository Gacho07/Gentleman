<?php
header("Content-Type: application/json");

$code = 404;
$data = null;

if (isset($_POST['send'])) {
    require_once "../../config/connection.php";
    require_once "functions.php";

    $text = $_POST['value_string'];
    $text = "%$text%";

    try {
        $data = searchArticles($text);
        $code = 200;
    } catch(PDOException $ex) {
        recoredErrors($ex->getMessage());
        $code = 500;
    }
} else {
    $code = 400;
}
http_response_code($code);
echo json_encode($data);