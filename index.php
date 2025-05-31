<?php 

session_start();
require_once('user.php');

// $user = new User();
// $user_list = $user->get_all_users();
// print_r ($user_list);

// If user is not authenticated, redirect to login page
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header('Location: login.php');

    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>COSC4806</title>
</head>

<body>
    <h1>Assignment #2</h1>
        <p>Welcome, <?= $_SESSION['username'] ?? '' ?>!</p>
        <p><?php echo date('F j Y'); ?></p>
</body>

<footer>
    <p></p><a href='logout.php'>Click here to logout</a></p>
</footer>

</html>