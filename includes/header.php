<?php
require_once 'auth_check.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - My Journal</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <nav>
        <h1>📘 My Journal</h1>
        <div class="nav-links">
            <span>Hello, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
            <a href="dashboard.php">Home</a>
            <a href="create_entry.php">Write New</a>
            <a href="logout.php">Logout</a>
        </div>
    </nav>
    <div class="container">