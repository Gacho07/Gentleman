<?php
use PHPMailer\PHPMailer\PHPMailer;

session_start();
ob_start();

header("Content-Type: application/json");

if (isset($_POST["btnLogin"])) {
    $email = $_POST["tbEmail"];
    $password = $_POST["tbPassword"];

    $reg_password = "/^(?=.*[a-zšđčćž])(?=.*[A-ZŠĐČĆŽ])(?=.*\d).{8,32}$/";

    $errors = [];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is not in good format.");
    }
    if (!preg_match($reg_password, $password)) {
        array_push($errors, "Password is not valid.");
    }

    if (count($errors) > 0) {
        $_SESSION["login_errors"] = "Wrong email or password.";
        header("Location: ../index.php?page=login_register");
    } else {
        require "../assets/vendor/PHPMailer/src/PHPMailer.php";
        require "../assets/vendor/PHPMailer/src/SMTP.php";
        require "../assets/vendor/PHPMailer/src/Exception.php";

        require_once "../config/connection.php";
        require_once "users/functions.php";

        $password = md5($password);

        $login = loginUser($email, $password);

        if ($login->rowCount() == 1) {
            $user = $login->fetch();

            $_SESSION["user"] = $user;
            $_SESSION["user_id"] = $user->user_id;

            echo json_encode($user);

            recordLogin($user->user_id);

            if (isset($_SESSION["user"]) && $_SESSION["user"]->role_name == "admin") :
                header("Location: ../index.php?page=admin_dashboard");
            else :
                header("Location: ../index.php?page=home");
            endif;
        } else {
            $attempt_login = loginAttempt($email);

            if ($attempt_login->rowCount() == 1) {
                $mail = new PHPMailer(true);
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );

                try {
                    $mail->SMTPDebug = 0;
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = "auditorne.php@gmail.com";
                    $mail->Password = "Sifra123";
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;
                    $mail->setFrom("auditorne.php@gmail.com", '');
                    $mail->addAddress($email);
                    $mail->isHTML(true);
                    $mail->Subject = "Message from 'Gentleman' web shop";
                    $mail->Body = "Someone attempted to login with your email.";
                    $mail->send();
                } catch (PDOException $ex) {
                    recoredErrors($ex->getMessage());
                }

                $_SESSION["login_errors"] = "Wrong password.";
                header("Location: ../index.php?page=login_register");
            } else {
                $_SESSION["login_errors"] = "You must create account first.";
                header("Location: ../index.php?page=login_register");
            }
        }
    }
} 
