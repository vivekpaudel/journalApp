<?php
// config/db.php

$host = "localhost";
$db_name = "journal_db";
$username = "root";      
$password = "";          

try {
    // Create PDO Connection
    $pdo = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8mb4", $username, $password);
    
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Optional: Uncomment below for debugging (disable in production)
    // $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
} catch(PDOException $e) {
    // If connection fails, stop script and show error
    die("ERROR: Could not connect. " . $e->getMessage());
}
?>