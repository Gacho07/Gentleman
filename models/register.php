<?php
header("Content-Type: application/json");

$data = null;
$code = 404;

if (isset($_POST["send"])) {
    require_once "../config/connection.php";
    require_once "users/functions.php";

    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $errors = [];

    $reg_first_last_name = "/^[A-ZŠĐČĆŽ][a-zšđčćž]{2,14}(\s[A-ZŠĐČĆŽ][a-zšđčćž]{2,14})*$/";
    $reg_password = "/^(?=.*[a-zšđčćž])(?=.*[A-ZŠĐČĆŽ])(?=.*\d).{8,32}$/";

    if (!preg_match($reg_first_last_name, $first_name)) {
        array_push($errors, "First name isn't correct.");
    }
    if (!preg_match($reg_first_last_name, $last_name)) {
        array_push($errors, "Last name isn't correct.");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email isn't correct.");
    }
    if (!preg_match($reg_password, $password)) {
        array_push($errors, "Password isn't correct.");
    }

    if (count($errors)) {
        $data = $errors;
        $code = 422; #indicates that the server understands the content type of the request entity, and the syntax of the request entity is correct, but it was unable to process the contained instructions.
    } else {
        try {
            $user_register = registerUser($first_name, $last_name, $email, $password);
            $code = $user_register ? 201 : 500;
        } catch (PDOException $ex) {
            recoredErrors($ex->getMessage());
            $code = 409; #indicates a request conflict with current state of the server.
        }
    }
} else {
    $code = 400;
}

http_response_code($code);
echo json_encode($data);
