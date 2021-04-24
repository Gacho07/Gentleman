<?php
header("Content-type:application/json");

$data = null;
$code = 404;

if (isset($_POST['id'])) {
    require_once "../../config/connection.php";
    require_once "functions.php";

    try {
        $id = $_POST['id'];
        if ($id != 0) {
            $data = getArticlesPerCategory($id);
        } else {
            $data = getNumberOfArticles();
        }
        $code = 200;
    } catch (PDOException $ex) {
        $code = 500;
        recoredErrors($ex->getMessage());
    }
} else {
    $code = 400;
}
echo json_encode($data);
http_response_code($code);