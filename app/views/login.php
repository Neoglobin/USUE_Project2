<?php
session_start();
setcookie('login', 'connect', time() + 300, '/');

if (isset($_COOKIE['register'])) {
    setcookie('register', 'connect', time() - 300, '/');
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
                echo '<p>' . $_SESSION['auth_succsess'] . '</p>';
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
            <form action="../models/validator.php" method="POST">
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