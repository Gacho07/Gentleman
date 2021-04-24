<?php
session_start();

if (isset($_POST["btnUpdateUser"])) {
    require_once "../../config/connection.php";
    require_once "functions.php";

    $user_id = $_POST["tbHiddenID"];
    $first_name = $_POST["tbFirstName"];
    $last_name = $_POST["tbLastName"];
    $email = $_POST["tbEmail"];
    $password = $_POST["tbPassword"];
    $date = $_POST["tbRegDate"];
    $role = $_POST["ddlRole"];

    $reg_first_last_name = "/^[A-ZŠĐČĆŽ][a-zšđčćž]{2,14}(\s[A-ZŠĐČĆŽ][a-zšđčćž]{2,14})*$/";
    $reg_password = "/^(?=.*[a-zšđčćž])(?=.*[A-ZŠĐČĆŽ])(?=.*\d).{8,32}$/";

    $errors = [];

    if (!preg_match($reg_first_last_name, $first_name)) {
        array_push($errors, "First name is not in good format.");
    }
    if (!preg_match($reg_first_last_name, $last_name)) {
        array_push($errors, "Last name is not in good format.");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is not valid.");
    }


    if (count($errors)) {
        $_SESSION["update-message"] = "Cannot update user, please check your data again.";
        header("Location: ../../index.php?page=users");
    } else {
        if ($password == "") {
            if (updateUserWithoutPassword($user_id, $first_name, $last_name, $email, $date, $role)) {
                $_SESSION["update-message"] = "User is successfully updated.";
                header("Location: ../../index.php?page=users");
            } else {
                $_SESSION["update-message"] = "Error, user isn't updated.";
                header("Location: ../../index.php?page=users");
            }
        } else {
            if (!preg_match($reg_password, $password)) {
                $_SESSION["update-message"] = "You didn't enter correctly all data, and check again password, please.";
            } else {
                if (updateUserWithPassword($user_id, $first_name, $last_name, $email, $password, $date, $role)) {
                    $_SESSION["update-message"] = "User is successfully updated.";
                    header("Location: ../../index.php?page=users");
                } else {
                    $_SESSION["update-message"] = "Error, user isn't updated.";
                    header("Location: ../../index.php?page=users");
                }
            }
        }
    }
}