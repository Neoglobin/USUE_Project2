<?php
session_start();

setcookie('access_token', $token, time() - (60 * 60 * 24), '/', '', false, true);
setcookie('user_id', $decoded->data->id, time() - (60 * 60 * 24 * 30), '/', '', false, true);

$_SESSION['auth_succsess'] = false;
$_SESSION['auth_error'] = false;
$_SESSION['wrong_password'] = false;
$_SESSION['access_accepted'] = false;
$_SESSION['user_id'] = false;
$_SESSION['username'] = false;
$_SESSION['captcha_succsess'] = false;
$_SESSION['captcha_failed'] = false;
$_SESSION['captcha_state'] = false;

$_SESSION['access_denied'] = true;
header('Location: ../views/login.php');
die;
