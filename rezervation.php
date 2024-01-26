<?php
    session_start();
    
    if (!isset($_SESSION['logged']) || $_SESSION['logged'] !== true) {
        header('Location: login.php'); 
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reservation</title>
    <link rel="stylesheet" href="CSS/rezervation.css">
</head>
<body>
<header>
    <div class="nav_container">
        <div class="header_inner">
            <a href="/~klykadan/#home">
            <h2>OctoRec</h2>
            </a>
            <nav>
                <a href="/~klykadan/#about">About</a>
                <a href="/~klykadan/#contacts">Contacts</a>
                <a href="prices.php">Price</a>
                <a href="/~klykadan/#services">Services</a>
                <a href="/~klykadan/#portfolio">Portfolio</a>
                <?php if (isset($_SESSION['logged']) && $_SESSION['logged'] === true): ?>
                <a href="myprofile.php" class="profile">My Profile</a> 
                <a href="logout.php" class="sign_in">Logout</a> 
                <?php else: ?>
                    <a href="login.php" class="sign_in">Sign In</a>
                <?php endif; ?>
            </nav>
        </div>
    </div>
</header>
<div class="container">
    <h1>Create reservation</h1>
    <input type="date" id="date" min="<?php echo date("Y-m-d"); ?>">
    <button id="reserveButton">Reserve</button>
    <p id="message"></p>
</div>

<script src="JS/rezerv.js"></script>
<?php  include "footer.php"; ?>
</body>
</html>