<?php

$code = 404;
$data = null;

if (isset($_POST["send"])) {
    require_once "../config/connection.php";
    require_once "functions.php";

    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    $reg_first_last_name = "/^[A-ZŠĐČĆŽ][a-zšđčćž]{2,14}(\s[A-ZŠĐČĆŽ][a-zšđčćž]{2,14})*$/";

    $errors = [];

    if (!preg_match($reg_first_last_name, $first_name)) {
        array_push($errors, "First name must start uppercase.");
    }
    if (!preg_match($reg_first_last_name, $last_name)) {
        array_push($errors, "Last name must start uppercase.");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email must me in valid format.");
    }
    if ($message == "") {
        array_push($errors, "You must enter message.");
    }

    $output = "";

    if (count($errors)) {
        for ($i = 0; $i < count($errors); $i++) {
            $output .= $errors[$i] . "<br/>";
        }
        $data = ["error" => $output];
        $code = 422;
    } else {
        try {
            if (addMessage($first_name, $last_name, $email, $message)) {
                $code = 201;
            } else {
                $code = 500;
            }
        } catch(PDOException $ex) {
            $code = 409;
            $data = ["error" => $ex->getMessage()];
            recoredErrors($ex->getMessage());
        }
    }
} else {
    $code = 400;
}

http_response_code($code);
echo json_encode($data);