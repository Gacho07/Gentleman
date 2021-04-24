<?php

session_start();

require_once "config/connection.php";

require_once "models/articles/functions.php";
require_once "models/users/functions.php";
require_once "models/orders/functions.php";
require_once "models/functions.php";

include "views/fixed/head.php";
include "views/fixed/nav.php";

if (isset($_GET["page"])) {
    $page = $_GET["page"];

    switch ($page) {
        case "home": 
            include "views/pages/home.php";
            recordAccessToPages();
            break;
        case "articles":
            include "views/pages/articles.php";
            recordAccessToPages();
            break;
        case "contact":
            include "views/pages/contact.php";
            recordAccessToPages();
            break;
        case "login_register":
            include "views/pages/login_register.php";
            recordAccessToPages();
            break;
        case "author":
            include "views/pages/author.php";
            recordAccessToPages();
            break;
        case "article":
            if (isset($_GET["id"])) {
                $article = getOneArticle($_GET['id']);
                include "views/pages/article.php";
                recordAccessToPages();
            } else {
                include "views/pages/errors/400.php";
            }
            break;
        case "cart":
            if (isset($_SESSION["user"]) && $_SESSION["user"]->role_name == "user") {
                include "views/pages/cart.php";
                recordAccessToPages();
            } else {
                include "views/pages/errors/403.php";
            }
            break;
        case "admin_dashboard":
            if (isset($_SESSION["user"]) && $_SESSION["user"]->role_name == "admin") {
                include "views/pages/admin/admin_dashboard.php";
            } else {
                include "views/pages/errors/403.php";
            }
            break;
        case "users":
            if (isset($_SESSION["user"]) && $_SESSION["user"]->role_name == "admin") {
                include "views/pages/admin/users.php";
            } else {
                include "views/pages/errors/403.php";
            }
            break;
        case "admin_articles":
            if (isset($_SESSION["user"]) && $_SESSION["user"]->role_name == "admin") {
                include "views/pages/admin/admin_articles.php";
            } else {
                include "views/pages/errors/403.php";
            }
            break;
        case "statistics":
            if (isset($_SESSION["user"]) && $_SESSION["user"]->role_name == "admin") {
                include "views/pages/admin/statistics.php";
            } else {
                include "views/pages/errors/403.php";
            }
            break;
        case "orders":
            if (isset($_SESSION["user"]) && $_SESSION["user"]->role_name == "admin") {
                include "views/pages/admin/orders.php";
            } else {
                include "views/pages/errors/403.php";
            }
            break;
        case "400":
            include "views/pages/errors/400.php";
            break;
        case "403":
            include "views/pages/errors/403.php";
            break;
        default:
            include "views/pages/errors/404.php";
            break;
    }
} 
else {
    include "views/pages/home.php";
}

include "views/fixed/footer.php";