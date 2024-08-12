<?php
session_start();
$_SESSION['captcha_state'] = null;

$command = escapeshellcmd("python c:/xampp/htdocs/app/views/captcha/generate.py");

if (empty($_SESSION['captcha_state'])) {
    exec($command);
    $_SESSION['captcha_state'] = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Captcha</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link rel="stylesheet" href="css/captcha.css" />

</head>

<body class="captcha-background">
    <?php if (!empty($_SESSION['captcha_succsess'])) {
        header('Location: register.php');
    }
    ?>
    <div class="captcha">
        <img class="popup_img_logo" src="img/captch_img.png" alt="error" />
        <h2 style="padding-bottom: 0;" class="features-headline bold">Captcha</h2>
        <h3 style="padding-bottom: 0;" class="features-headline light">Введите данные с картинки</h3>
        <br>
        <img class="captcha-image" src="captcha/CAPTCHA.png" alt="error"><br><br>
        <form action="/app/models/Captcha.php" method="POST">
            <div>
                <input class="captcha-input" name="captcha" type="text" />
                <input class="captcha-btn" type="submit" value="Отправить">
            </div>
        </form>
        <br><br>
        <?php

        if (!empty($_SESSION['captcha_failed'])) {
            echo $_SESSION['captcha_failed'];
            $_SESSION['captcha_failed'] = false;
        }
        ?>
    </div>

</body>

</html>