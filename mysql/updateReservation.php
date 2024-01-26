<?php
require_once "mysql.php";
session_start();

Connection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newDate = $_POST['date'];
    $username = $_SESSION['username'] ?? null;

    if ($username && !empty($newDate)) {
        if (!isReservationDateAvailable($newDate)) {
            echo "This date is already reserved by another user.";
        } elseif (reserveDateForUser($username, $newDate)) {
            echo "Reservation date successfully updated.";
        } else {
            echo "Error updating reservation date.";
        }
    } else {
        echo "Invalid request.";
    }
}
?>