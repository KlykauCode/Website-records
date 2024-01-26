<?php
session_start();
include "mysql/mysql.php";
Connection();

$username = $_SESSION['username'];
$user = GetUsername($username);
$newUsername = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $currentPassword = $_POST['current_password'];
    $newUsername = $_POST['new_username'];
    $newPassword = $_POST['new_password'];

    $errors = [];

    if (strlen($newUsername) < 5 || strlen($newUsername) > 20) {
        $errors[] = "Username must be between 5 and 20 characters.";
    }

    if (!password_verify($currentPassword, $user['password'])) {
        $errors[] = "Current password is incorrect.";
    }

    if (!empty($newPassword) && !isPasswordValid($newPassword)) {
        $errors[] = "The password must be at least 8 characters long and must contain at least one number.";
    }

    if ($newUsername != $username && CheckUser($newUsername)) {
        $errors[] = "Username already taken.";
    }
    if (empty($errors)) {
        if (!empty($newPassword)) {
            $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        } else {
            $hashedNewPassword = $user['password'];
            header("Location: myprofile.php");
        }
        if (updateUserProfile($username, $newUsername, $hashedNewPassword)) {
            $_SESSION['username'] = $newUsername; 
            echo "Profile updated successfully.";
            header("Location: myprofile.php");
        } else {
            echo "Error updating profile.";
        }
    } else {
        foreach ($errors as $error) {
            echo "<div class='error-php'>{$error}</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reservation</title>
    <link rel="stylesheet" href="CSS/forms.css">
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form action="editprofile.php" method="post">
        <h3>Edit Profile</h3>

        <label for="new_username">New Username</label>
        <input type="text" name="new_username" placeholder="New Username" value="<?php echo htmlspecialchars($newUsername); ?>">
        
        <label for="current_password">Current Password</label>
        <input type="password" placeholder="Password" name="current_password" required>

        <label for="new_password">New Password</label>
        <input type="password" placeholder="New Password" name="new_password">

        <button type="submit" name="submit">Update Profile</button>
        <p><a href="myprofile.php">Back to home</a></p>
    </form>
</body>
</html>