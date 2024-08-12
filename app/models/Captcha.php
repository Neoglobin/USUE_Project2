<?php
session_start();

$_SESSION['captcha_succsess'] = null;
$_SESSION['captcha_failed'] = null;

$text_path = 'c:/xampp/htdocs/app/views/captcha/encode.txt';
$user_captcha = $_POST['captcha'];

if (file_exists($text_path)) {

    $lines = file($text_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    array_unshift($lines, $user_captcha);

    $lines = array_slice($lines, 0, 2);

    file_put_contents($text_path, implode(PHP_EOL, $lines) . PHP_EOL);
} else {
    die("Файл encode.txt не найден.");
}

if (!empty($_SESSION['captcha_state'])) {
    if ($lines[0] == $lines[1]) {
        $_SESSION['captcha_state'] = null;
        $_SESSION['captcha_succsess'] = true;
        header('Location: ../views/register.php');
    } else {
        $_SESSION['captcha_failed'] = 'Неверно, попробуйте ещё раз!';
        header('Location: ../views/captcha.php');
    }
}
