<?php
session_start();

$_SESSION['auth_succsess'] = false;
$_SESSION['auth_failed'] = false;
$_SESSION['auth_error'] = false;
$_SESSION['wrong_password'] = false;
$_SESSION['access_accepted'] = false;
$_SESSION['username'] = false;
$_SESSION['catch_succsess'] = false;
$_SESSION['catch_failed'] = false;

$_SESSION['access_denied'] = true;
header('Location: ../views/login.php');
die;
