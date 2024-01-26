<?php
    include "mysql/mysql.php";
    Connection();

    $username = '';
    
    if(isset($_POST["submis"])){
        $username = Login();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/forms.css"> 
    <title>Log In</title>
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>  
    <form class="loginform" id="loginform" action="login.php" method="post">
        <h3>Login Here</h3>

        <label for="username">Username</label>
        <input type="text" name="username" placeholder="Email or Username" id="username" value="<?php echo htmlspecialchars($username); ?>" required>
        <span id="user-error" class="error_user"></span>

        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Password" id="password" required>
        <span id="pass-error" class="error_user"></span>

        <button type="submit" name="submis">Login</button>
        <p>Do you not have an account? <a href="signup.php">Sign Up</a></p>
    </form>
    <script src="JS/login.js"></script>
</body>
</html>