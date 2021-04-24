<?php

function addMessage($first_name, $last_name, $email, $message)
{
    global $conn;
    $posting_date = date("Y.m.d H:i:s");
    $query = "INSERT INTO mail (first_name, last_name, email, message, posting_date) VALUES (?,?,?,?,?)";
    $stmt = $conn->prepare($query);
    $stmt->execute([$first_name, $last_name, $email, $message, $posting_date]);
    return $stmt;
}

function getMenuForAllUsers()
{
    return executeQuery("SELECT * FROM menu WHERE menu_group_id = 1");
}

function getMenuForAuthorizedUsers()
{
    return executeQuery("SELECT * FROM menu WHERE menu_group_id = 2");
}

function getMenuForAdmin()
{
    return executeQuery("SELECT * FROM menu WHERE menu_group_id = 3");
}

function getAllPages()
{
    return ["Home", "Articles", "Contact", "Author", "Login_Register", "Article", "Cart"];
}

function getPageTrafficDate()
{
    $array = [];
    $sum = 0;

    $home = 0;
    $articles = 0;
    $contact = 0;
    $author = 0;
    $login_register = 0;
    $article = 0;
    $cart = 0;

    $last_day = strtotime("1 day ago");

    $file = file(LOG_ACCESS_FILE);
    if (count($file)) {
        foreach ($file as $row) {
            $parts = explode("\t", $row);
            #var_dump($parts[0]); //    index.php?page=home
            #var_dump($parts[1]); //     '26.04.2020 17:42:38'
            $url = explode(".php", $parts[0]);
            #var_dump($url); //     [0]index   [1]?page=home
            $page = explode("&", $url[1]);
            #var_dump($page[0]); //     ?page=home

            if (strtotime($parts[1]) >= $last_day) {
                switch ($page[0]) {
                    case "?page=home":
                        $home++;
                        $sum++;
                        break;
                    case "?page=articles":
                        $articles++;
                        $sum++;
                        break;
                    case "?page=contact":
                        $contact++;
                        $sum++;
                        break;
                    case "?page=author":
                        $author++;
                        $sum++;
                        break;
                    case "?page=login_register":
                        $login_register++;
                        $sum++;
                        break;
                    case "?page=article":
                        $article++;
                        $sum++;
                        break;
                    case "?page=cart":
                        $cart++;
                        $sum++;
                        break;
                    default:
                        $home++;
                        $sum++;
                        break;
                }
            }
        }

        if ($sum > 0) {
            $array["home"] = round($home * 100 / $sum, 2);
            $array["articles"] = round($articles * 100 / $sum, 2);
            $array["contact"] = round($contact * 100 / $sum, 2);
            $array["author"] = round($author * 100 / $sum, 2);
            $array["login_register"] = round($login_register * 100 / $sum, 2);
            $array["article"] = round($article * 100 / $sum, 2);
            $array["cart"] = round($cart * 100 / $sum, 2);
        }
    }

    return $array;
}

function getAuthor()
{
    return executeQuery("SELECT * FROM author");
}

function getSlider()
{
    return executeQuery("SELECT * FROM slider");
}
