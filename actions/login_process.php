<?php
session_start();
require_once '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        header("Location: ../index.php?error=All fields are required");
        exit();
    }

    // Prepare Statement to prevent SQL Injection
    $sql = "SELECT id, username, password FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Verify Password
        if (password_verify($password, $user['password'])) {
            // Password correct, start session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: ../dashboard.php");
            exit();
        } else {
            header("Location: ../index.php?error=Invalid password");
            exit();
        }
    } else {
        header("Location: ../index.php?error=No account found with this email");
        exit();
    }
} else {
    header("Location: ../index.php");
    exit();
}
?>