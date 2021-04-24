<?php
function getFeaturedArticles()
{
    return executeQuery("SELECT * FROM article ORDER BY price DESC LIMIT 0,3");
}

function getCategories()
{
    return executeQuery("SELECT * FROM category");
}

function getAllArticles()
{
    return executeQuery("SELECT * FROM article a INNER JOIN category c ON a.category_id = c.category_id");
}

function getArticlesForPagination()
{
    $page = ($_POST['id'] - 1) * 6;
    return executeQuery("SELECT * FROM article LIMIT $page, 6");
}

function getNumberOfArticles()
{
    global $conn;
    return $conn->query("SELECT COUNT(*) AS articlesCount FROM article")->fetch();
}

function getArticlesPerCategory($id)
{
    global $conn;
    $stmt = $conn->prepare("SELECT COUNT(*) AS articlesCount FROM article WHERE category_id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function searchArticles($text)
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM article WHERE article_name LIKE ?");
    $stmt->execute([$text]);
    return $stmt->fetchAll();
}

function getOneArticle($id)
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM article WHERE article_id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    return $stmt->fetch();
}

function insertArticle($article_name, $description, $price, $path_database, $path_database_new, $alt, $category)
{
    global $conn;
    $query = "INSERT INTO article (article_name, description, price, original_image, new_image, alt, category_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->execute([$article_name, $description, $price, $path_database, $path_database_new, $alt, $category]);
    return $stmt;
}

function updateArticleWithoutImage($article_name, $description, $price, $date_update, $category,  $article_id)
{
    global $conn;
    $query = "UPDATE article SET article_name = ?, description = ?, price = ?, date_posted = ?, category_id = ? WHERE article_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$article_name, $description, $price, $date_update, $category, $article_id]);
    return $stmt;
}

function updateArticleWithImage($article_name, $description, $price, $path_database, $path_database_new, $date_update, $category, $article_id)
{
    global $conn;
    $query = "UPDATE article SET article_name = ?, description = ?, price = ?, original_image = ?, new_image = ?, date_posted = ?, category_id = ? WHERE article_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$article_name, $description, $price, $path_database, $path_database_new, $date_update, $category, $article_id]);
    return $stmt;
}

function deleteArticle($id)
{
    global $conn;
    $query = "DELETE FROM article WHERE article_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$id]);
    return $stmt;
}
