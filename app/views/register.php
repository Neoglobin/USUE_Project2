<?php
require_once '../models/Validator.php';
require_once '../models/Auth.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $prepared_data = new ValidationRules($_POST['login'], $_POST['password'], $_POST['password_confirm']);

    $v = new Valitron\Validator($_POST);

    $v->labels($prepared_data->labels);
    $v->rules($prepared_data->rules);

    if ($v->validate()) {
        $validated_data = new Auth($_POST['login'], password_hash($_POST['password'], PASSWORD_BCRYPT), $pdo);
        $token = $validated_data->reg_action();
        if (!empty($_SESSION['auth_succsess'])) {
            verify_token($token);
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
    <title>PVS Register</title>
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
    <?php if (empty($_SESSION['catch_succsess'])) {
        header('Location: captcha.php');
    } ?>
    <div class="container">
        <div class="loginHeader">
            <h1>PVS</h1>
            <h3>PRODUCT VERIFICATION SYSTEM</h3>
        </div>
        <?php if (!empty($_SESSION['auth_failed'])) : ?>
            <div class="failedAlert">
                <?php
                echo '<p>' . $_SESSION['auth_failed'] . '</p>';
                $_SESSION['auth_failed'] = false;
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
                <div class="loginInputsContainer">
                    <label for="">Подтверждение пароля</label>
                    <input type="password" name="password_confirm" id="password_confirm">
                </div>
                <div class="loginButtonContainer">
                    <button type="submit">Зарегестрироваться</button><br><br>
                    <a href="login.php">Авторизация</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>