<?php
session_start();
require_once '../config/db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $mood = $_POST['mood'];
    $user_id = $_SESSION['user_id'];

    if (empty($title) || empty($content)) {
        header("Location: ../create_entry.php?error=Title and content are required");
        exit();
    }

    // Insert into Database
    $sql = "INSERT INTO entries (user_id, title, content, mood) VALUES (:user_id, :title, :content, :mood)";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute(['user_id' => $user_id, 'title' => $title, 'content' => $content, 'mood' => $mood])) {
        header("Location: ../dashboard.php?msg=created");
        exit();
    } else {
        header("Location: ../create_entry.php?error=Failed to create entry");
        exit();
    }
} else {
    header("Location: ../create_entry.php");
    exit();
}
?>