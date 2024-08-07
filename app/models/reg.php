<?php
session_start();
require 'C:/xampp/htdocs/database/db_connect.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$_SESSION['auth_succsess'] = null;
$_SESSION['auth_failed'] = null;

$login = $_POST['login'];
$hashed_password = password_hash($_POST['password'], PASSWORD_BCRYPT);

$query = "SELECT * FROM credentials WHERE login = :login";
$stmt = $pdo->prepare($query);
$stmt->execute([':login' => $login]);
$credential = $stmt->fetch(PDO::FETCH_ASSOC);


if (empty($credential)) {
    $stmt = $pdo->prepare("INSERT INTO credentials (login, password) VALUES (:login, :password)");
    $stmt->bindParam(':login', $login);
    $stmt->bindParam(':password', $hashed_password);

    if ($stmt->execute()) {
        $userId = $pdo->lastInsertId();

        $payload = [
            'exp' => time() + 1800,
            'data' => [
                'id' => $userId,
                'login' => $login,
            ],
        ];

        $jwt = JWT::encode($payload, $_ENV['JWT_SECRET_KEY'], 'HS256');
        $_SESSION['auth_succsess'] = json_encode(['token' => $jwt]);
        $_SESSION['catch_succsess'] = false;
        header('Location: ../views/login.php');
    } else {
        $_SESSION['auth_failed'] = json_encode(['message' => 'Ошибка регистрации. Повторите попытку.']);
        header('Location: ../views/register.php');
        die;
    }
} else {
    $_SESSION['auth_failed'] = 'Учётная запись с таким именем уже существует. Попробуйте другое имя.';
}
