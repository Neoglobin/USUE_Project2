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

        $accessTokenPayload = [
            'iss' => "http://localhost",
            'iat' => time(),
            'exp' => time() + 1800,
            'data' => [
                'id' => $userId,
                'login' => $login,
            ],
        ];

        $refreshToken = bin2hex(random_bytes(64));
        $refreshTokenExpiry = time() + (60 * 60 * 24 * 30);
        $is_registration = 1;

        $stmt = $pdo->prepare("INSERT INTO refresh_tokens (user_id, token, expires_at, is_registration) VALUES (:user_id, :token, FROM_UNIXTIME(:expires_at), :is_registration)");
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':token', $refreshToken);
        $stmt->bindParam(':expires_at', $refreshTokenExpiry);
        $stmt->bindParam('is_registration', $is_registration);
        $stmt->execute();

        $jwt = JWT::encode($accessTokenPayload, $_ENV['JWT_SECRET_KEY'], 'HS256');

        $_SESSION['auth_succsess'] = 'Регистрация завершена успешно. Пожалуйста авторизуйтесь.';
        $_SESSION['catch_succsess'] = false;
        header('Location: ../views/login.php');
        die;
    } else {
        $_SESSION['auth_failed'] = 'Ошибка регистрации данных на сервере. Попробуйте ещё раз.';
        header('Location: ../views/register.php');
        die;
    }
} else {
    $_SESSION['auth_failed'] = 'Учётная запись с таким именем уже существует. Попробуйте другое имя.';
    header('Location: ../views/register.php');
    die;
}
