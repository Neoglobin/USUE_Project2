<?php
session_start();

require 'C:/xampp/htdocs/db_router.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$headers = apache_request_headers();

if (!isset($headers['Authorization'])) {
    $_SESSION['auth_failed'] = json_encode(['error' => 'Unauthorized']);
    header('Location: ../views/login.php');
    die;
}

$authHeader = $headers['Authorization'];
$token = str_replace('Bearer ', '', $authHeader);

try {
    $decoded = JWT::decode($token, new Key($_ENV['JWT_SECRET_KEY'], 'HS256'));

    $currentTime = time();
    if ($decoded->exp < $currentTime) {
        $_SESSION['auth_failed'] = json_encode(['error' => 'Token expired']);
        header('Location: ../views/login.php');
        die;
    }

    if ($decoded->iss !== 'http://localhost') {
        $_SESSION['auth_failed'] = json_encode(['error' => 'Invalid issuer']);
        header('Location: ../views/login.php');
        die;
    }

    $userId = $decoded->data->id;
    $login = $decoded->data->login;

    if ($userId && $login) {
        header('Location: ../views/dashboard.php');
        die;
    }
} catch (Exception $e) {
    $_SESSION['auth_failed'] = json_encode(['error' => 'Invalid token']);
    header('Location: ../views/login.php');
    die;
}
