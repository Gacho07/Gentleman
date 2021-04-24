<?php
session_start();

if (isset($_POST["btnUpdateArticle"])) {
    require_once "../../config/connection.php";
    require_once "functions.php";

    define("SIZE", 3000000);

    $article_id = $_POST["hiddenArticleId"];
    $article_name = $_POST["articleName"];
    $price = $_POST["articlePrice"];
    $description = $_POST["articleDescription"];
    $category = $_POST["ddlCategory"];

    $date_posted = $_POST["updateDate"];
    $date_array = explode("-", $date_posted);
    $timestamp = mktime(0, 0, 0, $date_array[1], $date_array[2], $date_array[0]);
    $date_update = date("Y-m-d H:i:s", $timestamp);

    $file = $_FILES["articleImage"];

    $errors = [];

    $reg_article_name = "/^[\w\d\s]+$/";
    $reg_price = "/^\d+$/";

    if (!preg_match($reg_article_name, $article_name)) {
        array_push($errors, "Article name is not in good format.");
    }
    if (!preg_match($reg_price, $price)) {
        array_push($errors, "Price is not in good format.");
    }
    if ($category == "0") {
        array_push($errors, "You must choose category.");
    }
    if ($description == "") {
        array_push($errors, "You must enter description.");
    }

    if ($file["name"] == "") {
        if (count($errors)) {
            $_SESSION["update-article-msg"] = "Data is not properly entered";
            header("Location: ../../index.php?page=admin_articles");
        } else {
            if (updateArticleWithoutImage($article_name, $description, $price, $date_update, $category, $article_id)) {
                $_SESSION["update-article-msg"] = "Article is successfully updated.";
            } else {
                $_SESSION["update-article-msg"] = "Error, article isn't updated.";
            }
            header("Location: ../../index.php?page=admin_articles");
        }
    } else {
        $allowed_formats = ["image/jpeg", "image/jpg", "image/png", "image/gif"];

        $size = $file["size"];
        $type = $file["type"];
        $tmp = $file["tmp_name"];
        $name = $file["name"];

        $file_name = time() . "_" . $name;

        $path = "../../assets/img/" . $file_name;
        $path_database = "assets/img/" . $file_name;

        $path_database_new = $path_database . "-new";
        $path_new = "../../" . $path_database_new;

        if (!in_array($type, $allowed_formats)) {
            array_push($errors, "File type is not valid.");
        }
        if ($size > SIZE) {
            array_push($errors, "File size is not valid.");
        }

        if (count($errors)) {
            $_SESSION["update-article-msg"] = "Data is not properly entered";
            header("Location: ../../index.php?page=admin_articles");
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

            if (updateArticleWithImage($article_name, $description, $price, $path_database, $path_database_new, $date_update, $category, $article_id)) {
                $_SESSION["update-article-msg"] = "Article is successfully updated.";
                
                imagedestroy($existing_image);
                imagedestroy($new_image);
            } else {
                $_SESSION["update-article-msg"] = "Error, article isn't updated.";
            }

            header("Location: ../../index.php?page=admin_articles");
        }
    }
}
