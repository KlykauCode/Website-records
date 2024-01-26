<?php
include_once "mysql/mysql.php";
Connection();
session_start();

if (!isset($_SESSION['logged']) || $_SESSION['logged'] !== true) {
    header('Location: login.php'); 
    exit;
}

$username = $_SESSION['username'];
$user = GetUsername($username);

if ($user['username'] !== $username) {
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/myprofile.css">
    <title>My Profile</title>
</head>
<body>
    <header>
        <div class="container">
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
                    <a href="/~klykadan/#home">Home</a> 
                    <a href="logout.php" class="sign_in">Logout</a> 
                    <?php else: ?>
                        <a href="login.php" class="sign_in">Sign In</a>
                    <?php endif; ?>
                </nav>
            </div>
        </div>
    </header>
    <div class="myprofile">
        <div class="profile_background">
            <h1>My Profile</h1>
            <div class="avatar-frame">
                <?php if (!empty($user['avatar'])): ?>
                    <img src="https://zwa.toad.cz/~klykadan/Fotos/<?php echo htmlspecialchars($user['avatar']); ?>">
                <?php endif; ?>
            </div>
        </div>
            <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
            <p><strong>Date of Reservation:</strong> <?php echo htmlspecialchars($user['reservation']); ?></p>
            <div class="buttons">
                <a href="editprofile.php" class="edit-button">Edit Profile</a>
                <button id="editReservationButton">Edit Reservation Date</button>
            </div>
            <form id="editReservationForm">
                <input type="date" id="newDate" min="<?php echo date("Y-m-d"); ?>">
                <button type="button" id="updateReservationButton">Update Reservation</button>
                <p id="editMessage"></p>
            </form>
        <form id="uploadForm" enctype="multipart/form-data">
            <input type="file" name="avatar">
            <button type="submit" id="uploadButton">Upload Avatar</button>

            <p id="uploadStatus"></p>
        </form>
    </div>

    <script src="JS/uploadajax.js"></script> 
    <script src="JS/updateReserv.js"></script> 
    <?php  include "footer.php"; ?>
</body>
</html>