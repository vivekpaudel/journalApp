<?php
session_start();

// Prevent caching of protected pages
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies

// If user is NOT logged in, kick them to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>