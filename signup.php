<?php
    include "mysql/mysql.php";
    Connection();
    
    $username = '';
    
    if(isset($_POST["submit"])){
        $username = AddFun();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/forms.css"> 
    <title>Sign Up</title>
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
        <form class="signupform" action="signup.php" method="post">
            <h3>Registration</h3>

            <label for="username"><span class="required-star">*</span>Username</label>
            <input type="text" name="username" placeholder="Email or Username" id="username" value="<?php echo htmlspecialchars($username); ?>" required>
            <span id="error1" class="error_user"></span>
            <label for="password"><span class="required-star">*</span>Password</label>
            <input type="password" name="password" placeholder="Password" id="password" required>
            <span id="error2" class="error_user"></span>
            <label for="confirm_password"><span class="required-star">*</span>Confirm password</label>
            <input type="password" name="confirm_password" placeholder="Сonfirm password" id="confirm_password" required>
            <span id="error3" class="error_user"></span>

            <button type="submit" name="submit">Sign Up</button>
            <p>Do you already have an account? <a href="login.php">Sign In</a></p>
        </form>
        <script src="JS/signup.js"></script>
</body>
</html>