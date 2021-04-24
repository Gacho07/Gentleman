<?php
header("Content-Type: application/json");

$code = 404;
$data = null;

if (isset($_POST["send"])) {
    require_once "../../config/connection.php";
    require_once "functions.php";

    $user_id = $_POST["user_id"];
    $obj = $_POST["obj"];

    try {
        $conn->beginTransaction();

        insertOrder($user_id);
        $order_id = $conn->lastInsertId();
        insertOrdersDetails($obj, $order_id);
        
        $conn->commit();
        $code = 201;
    } catch (PDOException $ex) {
        recoredErrors($ex->getMessage());
        $code = 500;
    }
} else {
    $code = 400;
}

echo json_encode($data);
http_response_code($code);
