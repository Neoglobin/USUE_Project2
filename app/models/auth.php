<?php
session_start();
require 'C:/xampp/htdocs/database/db_connect.php';

$_SESSION['wrong_password'] = null;
$_SESSION['access_accepted'] = null;
$_SESSION['username'] = null;
$_SESSION['access_denied'] = true;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$login = $_POST['login'];
$password = $_POST['password'];

$stmt = $pdo->prepare("SELECT * FROM credentials WHERE login = :login");
$stmt->bindParam(':login', $login);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {
    $accessTokenPayload = [
        'iss' => "http://localhost",
        'iat' => time(),
        'exp' => time() + 1800,
        'data' => [
            'id' => $user['id'],
            'login' => $user['login'],
        ],
    ];

    $refreshToken = bin2hex(random_bytes(64));
    $refreshTokenExpiry = time() + (60 * 60 * 24 * 30);

    $stmt = $pdo->prepare("INSERT INTO refresh_tokens (user_id, token, expires_at) VALUES (:user_id, :token, FROM_UNIXTIME(:expires_at))");
    $stmt->bindParam(':user_id', $user['id']);
    $stmt->bindParam(':token', $refreshToken);
    $stmt->bindParam(':expires_at', $refreshTokenExpiry);
    $stmt->execute();

    $jwt = JWT::encode($accessTokenPayload, $_ENV['JWT_SECRET_KEY'], 'HS256');

    $url = "http://localhost:8081/app/models/middleware.php";

    $options = [
        'http' => [
            'header' => "Authorization: Bearer $jwt"
        ],
    ];

    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);

    if ($response === FALSE) {
        $_SESSION['auth_failed'] = json_encode(['error' => 'Invalod token']);
        header('Location: ../views/login.php');
        die;
    } else {
        $_SESSION['access_accepted'] = true;
        $_SESSION['access_denied'] = false;
        $_SESSION['username'] = $login;

        echo '<form id="hiddenForm" method="post" action="../views/dashboard.php" style="display:none;">';
        echo '<input type="hidden" name="response" value="' . htmlspecialchars($response) . '">';
        echo '</form>';
        echo '<script type="text/javascript">document.getElementById("hiddenForm").submit();</script>';
        die;
    }
} else {
    $_SESSION['wrong_password'] = 'Неверный пароль';
    header('Location: ../views/login.php');
    die;
}
