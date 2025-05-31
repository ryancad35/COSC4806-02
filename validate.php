<?php
session_start();
require_once('user.php');

$username = trim($_POST['username']  ?? '');
$password = trim($_POST['password']  ?? '');

$userObj = new User();

// Treat it as failed login attempt if either field is empty
if ($userObj->notEmptyAccount($username, $password) == false) {
    // Count failed attempts
    if (isset($_SESSION['failedAttempts'])) {
        $_SESSION['failedAttempts']++;
    } else {
        $_SESSION['failedAttempts'] = 1;
    }
    header('Location: login.php');
    exit;
}

// Verify username and password
$user = $userObj->processLogin($username, $password);

if ($user !== null) {
    // Login successful, perform the following steps:
    $_SESSION['authenticated'] = true;
    $_SESSION['username'] = $user['username'];

    if (isset($_SESSION['loginSuccess'])) {
        $_SESSION['loginSuccess']++;
    } else {
        $_SESSION['loginSuccess'] = 1;
    }
    header('Location: index.php');
    exit;
} else {
    // Login failed, track failed attempts
    if (isset($_SESSION['failedAttempts'])) {
        $_SESSION['failedAttempts']++;
    } else {
        $_SESSION['failedAttempts'] = 1;
    }
    header('Location: login.php');
    exit;
}