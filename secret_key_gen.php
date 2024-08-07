<?php
// Генерация секретного ключа
$secretKey = bin2hex(random_bytes(32));

// Путь к файлу .env
$envFilePath = __DIR__ . '/.env';

// Проверка существующего .env файла
if (file_exists($envFilePath)) {
    $envContent = file_get_contents($envFilePath);
} else {
    $envContent = '';
}

$pattern = '/^JWT_SECRET_KEY=.*/m';
if (preg_match($pattern, $envContent)) {
    $envContent = preg_replace($pattern, "JWT_SECRET_KEY={$secretKey}", $envContent);
} else {
    $envContent .= PHP_EOL . "JWT_SECRET_KEY={$secretKey}";
}

// Запись в .env файл
file_put_contents($envFilePath, $envContent);

echo "Секретный ключ успешно добавлен в .env файл: {$secretKey}";
