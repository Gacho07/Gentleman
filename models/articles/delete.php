<?php

$code = 404;

if (isset($_POST["id"])) {
    require_once "../../config/connection.php";
    require_once "functions.php";

    $id = $_POST["id"];

    $original_image = "../../" . $_POST["original_image"];
    $new_image = "../../" . $_POST["new_image"];

    try {
        $result = deleteArticle($id);
        $code = $result ? 204 : 500;
        
        unlink($original_image);
        unlink($new_image);
    } catch (PDOException $ex) {
        recoredErrors($ex->getMessage());
        $code = 500;
    }
} else {
    $code = 400;
}

http_response_code($code);