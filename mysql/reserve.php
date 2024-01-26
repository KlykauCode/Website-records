<?php
session_start(); 
require_once "mysql.php";
Connection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'];

    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];

        if (!empty($date)) {
            if (hasUserAlreadyReserved($username)) {
                echo "You have already reserved a date.";
            } elseif (!isReservationDateAvailable($date)) {
                echo "This date is already reserved by another user.";
            } else {
                if (reserveDateForUser($username, $date)) {
                    echo "Date successfully reserved for " . $username;
                } else {
                    echo "Error reserving date.";
                }
            }
        } else {
            echo "No date provided.";
        }
    } else {
        echo "You must be logged in to reserve a date.";
    }
}

?>