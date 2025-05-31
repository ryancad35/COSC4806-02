<?php 
session_start();
require_once('user.php');

// Redirect to index.php if user is already logged in
if (!empty($_SESSION['authenticated'])) {
    header('Location: index.php');
    exit();
}

$error    = '';
$username = '';

$action = filter_input(INPUT_POST, 'action');
if ($action === null) {
    $action = filter_input(INPUT_GET, 'action');
}

// Check if user has clicked on the submit button
if ($action === 'Submit Registration') {
    $username = trim(filter_input(INPUT_POST, 'username'));
    $password = trim(filter_input(INPUT_POST, 'password'));

    // Check if fields are empty
    if (!notEmptyAccount($username, $password)) {
        $error = 'Username and password cannot be empty.';
    }
    // Check if password is at least 10 characters long
    elseif (strlen($password) < 10) {
        $error = 'Password must be at least 10 characters long.';
    }
    // At this point, both fields are not empty and password is at least 10 characters long
    else {
        $userObj = new User();

        // Check if username already exists
        if (! $userObj->checkUsername($username)) {
            $error = 'That username is already taken. Please choose another.';
        }
        else {
            // Username does not exist, create new user
            $newUserId = $userObj->create_user($username, $password);
            if ($newUserId) {
                header('Location: loginSuccess.php');
            }
        }  
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
    </head>

    <body>
    <main>
        <h1>Register Here</h1>
        <form action="validate.php" method="post">
    
            <!-- <p><?php echo $error ?></p> -->
                <label>Username:</label>
                <input type="text" name="username" value="<?php echo $username ?>">
                <br><br>
                <label>Password:</label>
                <input type="text" name="password">
                <br><br>
                <input type="submit" name ="action" value="Submit Registration"><br>
                <p>Already have an account? <a href="login.php">Login here</a></p>
        </form>
    </main>
    </body>
    
</html>