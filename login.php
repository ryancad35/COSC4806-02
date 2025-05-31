<?php
session_start();
require_once('user.php');

// If user is logged in, redirect to index.php
if (!empty($_SESSION['authenticated'])) {
    header('Location: index.php');
    exit();
}

$loginError = '';
if (isset($_SESSION['failedAttempts'])) {
    $loginError =
        'This is unsuccessful attempt number ' . $_SESSION['failedAttempts'];
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
</head>

<body>
    <h1>Login Form</h1>

    <main>
        <form action="validate.php" method="post">
                        <p><?php echo $loginError; ?></p>
            <label>Username:</label>
            <br>
            <input type="text" id="username" name="username">
            <br>
            <label>Password:</label>
            <br>
            <input type="password" id="password" name="password">
            <br><br>
            <input type="submit" name="action" value="Login">
        </form>
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </main>
</body>

    

</html>