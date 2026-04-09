<?php
session_start();

// If user is NOT logged in, kick them to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>