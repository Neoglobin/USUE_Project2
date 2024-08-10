<?php

require_once 'C:/xampp/htdocs/database/db_connect.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Auth
{
    public $login;
    public $password;
    public $pdo;

    public function __construct($login, $password, $pdo)
    {
        $this->login = $login;
        $this->password = $password;
        $this->pdo = $pdo;
    }
    // Запуск цикла регистрации
    public function reg_action()
    {
        $query = "SELECT * FROM credentials WHERE login = :login";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':login' => $this->login]);
        $credential = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($credential)) {
            $this->execute_data();
            $userId = $this->pdo->lastInsertId();
            return $this->generate_token($userId);
        } else {
            return $_SESSION['auth_failed'] = 'Учётная запись с таким именем уже существует. Попробуйте другое имя.';
        }
    }
    // Запуск цикла аутентификации
    public function auth_action()
    {
        $query = "SELECT * FROM credentials WHERE login = :login";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':login' => $this->login]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return $_SESSION['auth_failed'] = 'Пользователь не найден';
        }

        if (password_verify($this->password, $user['password'])) {
            $userId = $user['id'];
            return $this->generate_token($userId);
        } else {
            return $_SESSION['auth_failed'] = 'Неверный пароль';
        }
    }
    // Сохранение данных пользователя в базу
    private function execute_data()
    {
        $stmt = $this->pdo->prepare("INSERT INTO credentials (login, password) VALUES (:login, :password)");
        $stmt->bindParam(':login', $this->login);
        $stmt->bindParam(':password', $this->password);
        if (!$stmt->execute()) {
            return $_SESSION['auth_failed'] = 'Ошибка регистрации данных на сервере. Попробуйте ещё раз.';
        }
    }
    // Генерация токена
    private function generate_token($userId)
    {
        try {
            //Токен доступа
            $accessTokenPayload = [
                'iss' => "http://localhost",
                'iat' => time(),
                'exp' => time() + 1800,
                'data' => [
                    'id' => $userId,
                    'login' => $this->login,
                ],
            ];
            //Токен обновления
            $refreshToken = bin2hex(random_bytes(64));
            $refreshTokenExpiry = time() + (60 * 60 * 24 * 30);
            if ($userId == $this->pdo->lastInsertId()) {
                $is_registration = 1;
            }

            $stmt = $this->pdo->prepare("INSERT INTO refresh_tokens (user_id, token, expires_at, is_registration) VALUES (:user_id, :token, FROM_UNIXTIME(:expires_at), :is_registration)");
            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':token', $refreshToken);
            $stmt->bindParam(':expires_at', $refreshTokenExpiry);
            $stmt->bindParam('is_registration', $is_registration);
            $stmt->execute();

            $_SESSION['auth_succsess'] = 'Регистрация завершена успешно. Пожалуйста авторизуйтесь.';
            $_SESSION['catch_succsess'] = false;
            $_SESSION['username'] = $this->login;

            return JWT::encode($accessTokenPayload, $_ENV['JWT_SECRET_KEY'], 'HS256');
        } catch (Exception $e) {
            return $_SESSION['auth_failed'] = 'Invalid Token';
        }
    }
}
