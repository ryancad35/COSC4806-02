<?php 
require_once('user.php');
require_once('database.php');

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
                <input type="text" name="password"><br>
                <input type="submit" name ="action" value="Submit Registration"><br>
                <p>Already have an account? <a href="login.php">Login here</a></p>
        </form>
    </main>
    </body>
    
</html>