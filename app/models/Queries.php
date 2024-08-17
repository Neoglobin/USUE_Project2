<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (!empty($_POST['id'])) {
        content_edit();
    } else {
        content_add();
    }

    header('Location: ../views/dashboard.php');
}


function content_query()
{
    require 'C:/xampp/htdocs/db_connect.php';

    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $limit = 7;
    $offset = ($page - 1) * $limit;

    $stmt = $pdo->prepare("SELECT * FROM data_table WHERE user_id = :user_id ORDER BY expires_at LIMIT $limit OFFSET $offset");
    $stmt->bindParam(':user_id', $_COOKIE['user_id']);
    $stmt->execute();


    for ($i = []; $row = $stmt->fetch(PDO::FETCH_ASSOC); $i[] = $row);

    return $i;
}


function element_query($id)
{
    require 'C:/xampp/htdocs/db_connect.php';

    $stmt = $pdo->prepare("SELECT * FROM data_table WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $element = $stmt->fetch(PDO::FETCH_ASSOC);

    return $element;
}

function content_count()
{
    require 'C:/xampp/htdocs/db_connect.php';

    $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM data_table WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $_COOKIE['user_id']);
    $stmt->execute();

    $count = $stmt->fetch(PDO::FETCH_ASSOC);

    return $count;
}

function content_edit()
{
    require 'C:/xampp/htdocs/db_connect.php';
    require_once 'Auth.php';

    if (!empty($_COOKIE['access_token'])) {
        verify_token($_COOKIE['access_token']);
    } else {
        $_SESSION['access_denied'] = true;
    }

    if (!empty($_SESSION['access_denied'])) {
        $_SESSION['auth_failed'] = 'Отказано в доступе';
        header('Location: ../models/logout.php');
        die;
    }

    $created_at  = date('Y-m-d H:i:s', strtotime(trim($_POST['created_at'])));
    $expires_at  = date('Y-m-d H:i:s', strtotime(trim($_POST['expires_at'])));

    $stmt = $pdo->prepare("UPDATE data_table SET article = :article, barcode = :barcode, percentage = :percentage, name = :name, created_at = :created_at, expires_at = :expires_at WHERE id = :id");

    $stmt->bindParam(':id', $_POST['id']);
    $stmt->bindParam(':article', trim($_POST['article']));
    $stmt->bindParam(':barcode', trim($_POST['barcode']));
    $stmt->bindParam(':percentage', trim($_POST['percentage']));
    $stmt->bindParam(':name', trim($_POST['name']));
    $stmt->bindParam(':created_at', $created_at);
    $stmt->bindParam(':expires_at', $expires_at);

    if ($stmt->execute()) {
        setcookie('edited', 'edited', time() + 1, '/');
    }
}

function content_delete($id)
{
    require 'C:/xampp/htdocs/db_connect.php';

    $stmt = $pdo->prepare("DELETE FROM data_table WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $delete = $stmt->execute();

    return $delete;
}

function content_add()
{
    require 'C:/xampp/htdocs/db_connect.php';
    require_once 'Auth.php';

    if (!empty($_COOKIE['access_token'])) {
        verify_token($_COOKIE['access_token']);
    } else {
        $_SESSION['access_denied'] = true;
    }

    if (!empty($_SESSION['access_denied'])) {
        $_SESSION['auth_failed'] = 'Отказано в доступе';
        header('Location: ../models/logout.php');
        die;
    }

    $expires_at  = date('Y-m-d H:i:s', strtotime(trim($_POST['expires_at'])));

    $stmt = $pdo->prepare("INSERT INTO data_table (user_id, article, barcode, name, expires_at) VALUES (:user_id, :article, :barcode, :name, :expires_at)");

    $stmt->bindParam(':user_id', $_COOKIE['user_id']);
    $stmt->bindParam(':article', trim($_POST['article']));
    $stmt->bindParam(':barcode', trim($_POST['barcode']));
    $stmt->bindParam(':name', trim($_POST['name']));
    $stmt->bindParam(':expires_at', $expires_at);

    if ($stmt->execute()) {
        setcookie('created', 'created', time() + 1, '/');
    }
}
