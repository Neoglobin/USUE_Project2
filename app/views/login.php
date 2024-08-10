<?php
require_once '../models/validator.php';
require_once '../models/authentificator.php';
require '../models/checkpoint.php';

if (!empty($_SESSION['token'])) {
    $request = new CheckPoint\CheckToken($_SESSION['token']);
    $request->verify_token();
    if (!empty($_SESSION['access_accepted'])) {
        $_SESSION['token'] = false;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $prepared_data = new ValidationRules($_POST['login'], $_POST['password']);

    $v = new Valitron\Validator($_POST);

    $v->labels($prepared_data->labels);
    $v->rules($prepared_data->rules);

    if ($v->validate()) {
        $validated_data = new Auth($_POST['login'], $_POST['password'], $pdo);
        $token = $validated_data->auth_action();
        if (!empty($_SESSION['auth_succsess'])) {
            $_SESSION['token'] = $token;
            header('Location: dashboard.php');
            die;
        }
    } else {
        $errors = '<ul>';
        foreach ($v->errors() as $error) {
            foreach ($error as $item) {
                $errors .= "<li>{$item}</li>";
            }
        }
        $errors .= '</ul>';
        $_SESSION['auth_failed'] = $errors;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PVS Login</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Noto+Serif:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anta&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Noto+Serif:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script>
        window.history.replaceState(null, null, window.location.href);
    </script>
</head>

<body>
    <div class="container">
        <?php
        if (!empty($_SESSION['auth_error'])) {
            echo "<script>alert('Ошибка передачи данных, попробуйте ещё раз')</script>";
            $_SESSION['auth_error'] = false;
        }
        ?>
        <div class="loginHeader">
            <h1>PVS</h1>
            <h3>PRODUCT VERIFICATION SYSTEM</h3>
        </div>
        <?php if (!empty($_SESSION['auth_succsess'])) : ?>
            <div class="succsessAlert">
                <?php
                if (!empty($_SESSION['access_accepted'])) {
                    if (!empty($_SERVER['HTTP_REFERER'])) {
                        header('Location: ' . $_SERVER['HTTP_REFERER']);
                        die;
                    } else {
                        header('Location: dashboard.php');
                        die;
                    }
                }
                $_SESSION['auth_succsess'] = false;
                ?>
            </div>
        <?php elseif (!empty($_SESSION['auth_failed']) or !empty($_SESSION['wrong_password'])) : ?>
            <div class="failedAlert">
                <?php
                echo '<p>' . $_SESSION['auth_failed'] . '</p>';
                echo '<p>' . $_SESSION['wrong_password'] . '</p>';
                $_SESSION['auth_failed'] = false;
                $_SESSION['wrong_password'] = false;
                ?>
            </div>
        <?php endif; ?>
        <div class="loginBody">
            <form action="" method="POST">
                <div class="loginInputsContainer">
                    <label for="">Логин</label>
                    <input type="text" name="login" id="login">
                </div>
                <div class="loginInputsContainer">
                    <label for="">Пароль</label>
                    <input type="password" name="password" id="password">
                </div>
                <div class="loginButtonContainer">
                    <button type="submit">Войти</button><br><br>
                    <a href="captcha.php">Регистрация</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>