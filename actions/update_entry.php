<?php
// actions/update_entry.php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $mood = $_POST['mood'];
    $user_id = $_SESSION['user_id'];

    if (empty($title) || empty($content)) {
        header("Location: ../edit_entry.php?id=$id&error=Fields cannot be empty");
        exit();
    }

    // Update Database (Verify ownership again in SQL)
    $sql = "UPDATE entries SET title = :title, content = :content, mood = :mood 
            WHERE id = :id AND user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute(['title' => $title, 'content' => $content, 'mood' => $mood, 'id' => $id, 'user_id' => $user_id])) {
        header("Location: ../dashboard.php?msg=updated");
        exit();
    } else {
        header("Location: ../edit_entry.php?id=$id&error=Failed to update");
        exit();
    }
} else {
    header("Location: ../dashboard.php");
    exit();
}
?>