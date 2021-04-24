<?php
session_start();

if (isset($_POST["btnInsertArticle"])) {
    require_once "../../config/connection.php";
    require_once "functions.php";

    define("SIZE", 3000000);

    $file = $_FILES["fileArticleImage"];
    $size = $file["size"];
    $type = $file["type"];
    $tmp = $file["tmp_name"];
    $name = $file["name"];

    $file_name = time() . "_" . $name;

    $path = "../../assets/img/" . $file_name;
    $path_database = "assets/img/" . $file_name;

    $path_database_new = $path_database."-new";
    $path_new = "../../"  . $path_database_new;

    $article_name = $_POST["articleName"];
    $description = $_POST["articleDescription"];
    $price = $_POST["articlePrice"];
    $alt = $_POST["articleImageAlt"];
    $category = $_POST["ddlCategory"];

    $errors = [];

    $reg_article_name = "/^[\w\d\s]+$/";
    $reg_price = "/^\d+$/";

    $allowed_formats = ["image/jpeg", "image/jpg", "image/png", "image/gif"];

    if (!preg_match($reg_article_name, $article_name)) {
        array_push($errors, "Article name is not in good format.");
    }
    if (!preg_match($reg_price, $price)) {
        array_push($errors, "Price is not in good format.");
    }
    if ($description == "") {
        array_push($errors, "You must enter description.");
    }
    if ($alt == "") {
        array_push($errors, "You must enter alt attribute for image.");
    }
    if ($category == "0") {
        array_push($errors, "You must choose category.");
    }

    if (!in_array($type, $allowed_formats)) {
        array_push($errors, "File type is not valid.");
    }
    if ($size > SIZE) {
        array_push($errors, "File size is not valid.");
    }

    if (count($errors)) {
        $_SESSION["upload-error"] = $errors;
        header("Location: ../../index.php?page=admin_dashboard");
    } elseif (move_uploaded_file($tmp, $path)) {
        $x = 100;
        $y = 100;

        list($width, $height) = getimagesize($path);

        if ($type == "image/jpeg") {
            $existing_image = imagecreatefromjpeg($path);
        } elseif ($type == "image/png") {
            $existing_image = imagecreatefrompng($path);
        } elseif ($type == "image/gif") {
            $existing_image = imagecreatefromgif($path);
        }

        $new_width = $x;
        $new_height = $height / ($width / $new_width);

        $smaller_image = imagecreatetruecolor($new_width, $new_height);

        imagecopyresampled($smaller_image, $existing_image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

        if ($new_width > $x) {
            $move_existing = ($new_width - $x) / 2;
            $move_new = 0;
        } elseif ($new_width < $x) {
            $move_existing = 0;
            $move_new = ($x - $new_width) / 2;
        } else {
            $move_existing = 0;
            $move_new = 0;
        }

        $new_image = imagecreatetruecolor($x, $y);

        imagecopyresampled($new_image, $smaller_image, $move_new, 0, $move_existing, 0, $x, $y, $x, $y);

        if ($type == "image/jpeg") {
            imagejpeg($new_image, $path_new);
        } elseif ($type == "image/png") {
            imagepng($new_image, $path_new);
        } elseif ($type == "image/gif") {
            imagegif($new_image, $path_new);
        }

        $upload_article = insertArticle($article_name, $description, $price, $path_database, $path_database_new, $alt, $category);

        if ($upload_article) {
            imagedestroy($existing_image);
            imagedestroy($new_image);
            $url_message = "Successfull_upload";
            header("Location: ../../index.php?page=admin_dashboard&message=$url_message");
        }
    }
}
