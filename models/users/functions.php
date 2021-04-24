<?php

function registerUser($first_name, $last_name, $email, $password)
{
    global $conn;
    $query = "INSERT INTO user (first_name, last_name, email, password, role_id) VALUES(?,?,?,MD5(?),?)";
    $stmt = $conn->prepare($query);
    $stmt->execute([$first_name, $last_name, $email, $password, 2]);
    return $stmt;
}

function loginUser($email, $password)
{
    global $conn;
    $query = "SELECT u.*, r.role_name FROM user u INNER JOIN role r ON u.role_id = r.role_id WHERE u.email = ? AND u.password = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$email, $password]);
    return $stmt;
}

function loginAttempt($email)
{
    global $conn;
    $query = "SELECT * FROM user WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$email]);
    return $stmt;
}

function recordLogin($id)
{
    $open = fopen(LOGIN_FILE, "a");
    $data = $id . "\n";
    fwrite($open, $data);
    fclose($open);
}

function deleteLogin($id)
{
    $id = (int) $id;
    $string = "";
    $file = file(LOGIN_FILE);
    if (count($file)) {
        foreach ($file as $row) {
            $row = trim((int) $row);
            if ($row != $id) {
                $string .= $row . "\n";
            }
        }
    }
    $open = fopen(LOGIN_FILE, "w");
    fwrite($open, $string);
    fclose($open);
}

function countLoggedUsers()
{
    return count(file(LOGIN_FILE));
}

function getLatestUsers()
{
    return executeQuery("SELECT * FROM user ORDER BY registration_date DESC LIMIT 0,5");
}

function countUsers()
{
    global $conn;
    return $conn->query("SELECT COUNT(*) AS users FROM user")->fetch();
}

function getAllUsers()
{
    return executeQuery("SELECT * FROM user u INNER JOIN role r ON u.role_id = r.role_id");
}

function getOneUser($id)
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM user u INNER JOIN role r ON u.role_id = r.role_id WHERE u.user_id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function getAllRoles()
{
    return executeQuery("SELECT * FROM role");
}

function updateUserWithoutPassword($user_id, $first_name, $last_name, $email, $date, $role)
{
    global $conn;
    $query = "UPDATE user SET first_name = ?, last_name = ?, email = ?, registration_date = ?, role_id = ? WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$first_name, $last_name, $email, $date, $role, $user_id]);
    return $stmt;
}

function updateUserWithPassword($user_id, $first_name, $last_name, $email, $password, $date, $role)
{
    global $conn;
    $password = md5($password);
    $query = "UPDATE user SET first_name = ?, last_name = ?, email = ?, password = ?, registration_date = ?, role_id = ? WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$first_name, $last_name, $email, $password, $date, $role, $user_id]);
    return $stmt;
}

function deleteUser($id)
{
    global $conn;
    $query = "DELETE FROM user WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$id]);
    return $stmt;
}
