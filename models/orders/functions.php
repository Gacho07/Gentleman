<?php

function insertOrder($user_id)
{
    global $conn;
    $order_date = date("Y.m.d H:i:s");
    $query = "INSERT INTO purchase VALUES (NULL, ?, ?)";
    $order = $conn->prepare($query);
    return $order->execute([$user_id, $order_date]);
}

function insertOrdersDetails($obj, $order_id)
{
    global $conn;
    $values = [];
    $parameters = [];
    foreach ($obj as $i) {
        $parameters[] = "(?,?,?)";
        $values[] = $i["id"];
        $values[] = $order_id;
        $values[] = $i["quantity"];
    }
    $details = $conn->prepare("INSERT INTO purchase_details (article_id, purchase_id, quantity) VALUES " . implode(",", $parameters));
    return $details->execute($values);
}

function getAllOrders()
{
    return executeQuery("SELECT * FROM purchase p INNER JOIN user u ON p.user_id = u.user_id");
}

function getDetailsOfOneOrder($id)
{
    global $conn;
    $stmt = $conn->prepare("SELECT pd.*, a.article_name, a.original_image, u.first_name, u.last_name, p.purchase_date FROM purchase_details pd JOIN article a ON pd.article_id = a.article_id JOIN purchase p ON p.purchase_id = pd.purchase_id JOIN user u ON u.user_id = p.user_id WHERE pd.purchase_id = ?");
    $stmt->execute([$id]);
    return $stmt->fetchAll();
}

function deleteOrderDetails($id)
{
    global $conn;
    $stmt = $conn->prepare("DELETE FROM purchase_details WHERE purchase_id = ?");
    return $stmt->execute([$id]);
}

function deleteOrder($id)
{
    global $conn;
    $stmt = $conn->prepare("DELETE FROM purchase WHERE purchase_id = ?");
    return $stmt->execute([$id]);
}

function countOrders()
{
    global $conn;
    return $conn->query("SELECT COUNT(*) AS orders FROM purchase")->fetch();
}
