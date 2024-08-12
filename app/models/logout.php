<?php
session_start();

$_SESSION['auth_succsess'] = false;
$_SESSION['auth_error'] = false;
$_SESSION['wrong_password'] = false;
$_SESSION['access_accepted'] = false;
$_SESSION['username'] = false;
$_SESSION['captcha_succsess'] = false;
$_SESSION['captcha_failed'] = false;
$_SESSION['captcha_state'] = false;

$_SESSION['access_denied'] = true;
header('Location: ../views/login.php');
die;
