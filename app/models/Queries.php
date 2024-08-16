<?php

function content_query()
{
    require 'C:/xampp/htdocs/db_connect.php';

    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $limit = 7;
    $offset = ($page - 1) * $limit;

    $stmt = $pdo->prepare("SELECT * FROM data_table WHERE id = :user_id ORDER BY expires_at LIMIT $limit OFFSET $offset");
    $stmt->bindParam(':user_id', $_COOKIE['user_id']);
    $stmt->execute();


    for ($i = []; $row = $stmt->fetch(PDO::FETCH_ASSOC); $i[] = $row);

    return $i;
}

function content_count()
{
    require 'C:/xampp/htdocs/db_connect.php';

    $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM data_table WHERE id = :user_id");
    $stmt->bindParam(':user_id', $_COOKIE['user_id']);
    $stmt->execute();

    $count = $stmt->fetch(PDO::FETCH_ASSOC);

    return $count;
}
