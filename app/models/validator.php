<?php
session_start();
$_SESSION['auth_failed'] = null;
$_SESSION['auth_error'] = null;

require 'C:/xampp/htdocs/vendor/autoload.php';

use Valitron\Validator;

Validator::langDir('C:/xampp/htdocs/lang');
Validator::lang('ru');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $labels = [
        'login' => 'Логин',
        'password' => 'Пароль',
        'password_confirm' => 'Пароли',
    ];

    $rules = [
        'required' => ['login', 'password'],
        'lengthMin' => [
            ['password', 8],
        ],
        'regex' => [
            ['password', '/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[_*$]).+$/'],
        ],
        'equals' => [
            ['password_confirm', 'password'],
        ],
        'alphaNum' => [
            ['login']
        ]
    ];

    $r = new Valitron\Validator($_POST);

    $r->labels($labels);
    $r->rules($rules);

    if ($r->validate()) {
        $login = $_POST['login'];
        $password = $_POST['password'];

        if (isset($_COOKIE['register'])) {
            // Генерация скрытой формы
            echo '<form id="hiddenForm" method="post" action="reg.php" style="display:none;">';
            echo '<input type="hidden" name="login" value="' . htmlspecialchars($login) . '">';
            echo '<input type="hidden" name="password" value="' . htmlspecialchars($password) . '">';
            echo '</form>';

            // Автоматическая отправка формы с помощью JavaScript
            echo '<script type="text/javascript">document.getElementById("hiddenForm").submit();</script>';
            die;
        } elseif (isset($_COOKIE['login'])) {
            echo '<form id="hiddenForm" method="post" action="auth.php" style="display:none;">';
            echo '<input type="hidden" name="login" value="' . htmlspecialchars($login) . '">';
            echo '<input type="hidden" name="password" value="' . htmlspecialchars($password) . '">';
            echo '</form>';

            echo '<script type="text/javascript">document.getElementById("hiddenForm").submit();</script>';
            die;
        }
    } else {
        $errors = '<ul>';
        foreach ($r->errors() as $error) {
            foreach ($error as $item) {
                $errors .= "<li>{$item}</li>";
            }
        }
        $errors .= '</ul>';
        $_SESSION['auth_failed'] = $errors;
        echo '<script type="text/javascript">window.history.back();</script>';
        die;
    }
} else {
    $_SESSION['auth_error'] = 'error';
    echo '<script type="text/javascript">window.history.back();</script>';
    die;
}
