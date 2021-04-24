<?php
header("Content-Type: application/json");

$data = null;
$code = 404;

if (isset($_POST['send'])) {
    require_once "../../config/connection.php";

    $page = ($_POST['pagination_id'] - 1) * 4;
    $category_id = $_POST['category_id'];
    $sort_id = $_POST['sort_id'];
  
    $query = "SELECT * FROM article ";

    if ($category_id != '0') {
        $query .= "WHERE category_id=:category_id ORDER BY ";
    } else {
        $query .= "ORDER BY ";
    }

    if ($sort_id == '1') {
        $query .= "price,";
    } elseif ($sort_id == '2') {
        $query .= "price DESC,";
    }

    $query .= "date_posted DESC LIMIT 6 OFFSET $page";
    
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":category_id", $category_id);

    try {
        if ($stmt->execute()) {
            $data = $stmt->fetchAll();
            $code = 200;
        } else {
            $code = 500;
        }
    } catch (PDOException $ex) {
        recoredErrors($ex->getMessage());
        $code = 500;
    }
} else {
    $code = 400;
}
http_response_code($code);
echo json_encode($data);
