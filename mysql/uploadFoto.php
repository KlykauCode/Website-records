<?php
session_start();
include "mysql.php";
Connection();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["avatar"])) {
    $username = $_SESSION['username'];
    $avatar = $_FILES["avatar"];
    $uploadDir = "../Fotos/"; 

    $Types = ['image/jpeg', 'image/png', 'image/gif'];

    $avatarName = uniqid() . "-" . basename($avatar["name"]);
    $uploadFile = $uploadDir . $avatarName;

    if (in_array($avatar['type'], $Types)) {
        if (move_uploaded_file($avatar["tmp_name"], $uploadFile)) {
       
            $query = "UPDATE users SET avatar = ? WHERE username = ?";
            $stmt = mysqli_prepare($connection, $query);
            mysqli_stmt_bind_param($stmt, "ss", $avatarName, $username);
            mysqli_stmt_execute($stmt);
            echo "Avatar uploaded successfully.";
        } else {
            echo "Error uploading avatar.";
        }
    } else {
        echo "Invalid file type. Only JPG, PNG and GIF are allowed.";
    }
} else {
    echo "Invalid request.";
}
?>