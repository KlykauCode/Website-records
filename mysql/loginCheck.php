<?php
    include "mysql.php";
    Connection();

    if(isset($_POST["username"]) && isset($_POST["password"])){
        $username = $_POST["username"];
        $password = $_POST["password"];

        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($result)){
            if(password_verify($password, $row["password"])){
                echo "valid";
            } else {
                echo "invalid password";
            }
        } else {
            echo "invalid user";
        }
    }
?>