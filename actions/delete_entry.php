<?php
session_start();
require_once '../config/db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

// Check if ID is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    // Prepare Delete Statement
    // SECURITY: The WHERE clause ensures you only delete YOUR own entries
    $sql = "DELETE FROM entries WHERE id = :id AND user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute(['id' => $id, 'user_id' => $user_id])) {
        // Check if a row was actually deleted
        if ($stmt->rowCount() > 0) {
            header("Location: ../dashboard.php?msg=deleted");
        } else {
            // If rowCount is 0, either ID didn't exist or it belonged to someone else
            header("Location: ../dashboard.php?msg=error");
        }
        exit();
    } else {
        header("Location: ../dashboard.php?msg=error");
        exit();
    }
} else {
    header("Location: ../dashboard.php");
    exit();
}
?>