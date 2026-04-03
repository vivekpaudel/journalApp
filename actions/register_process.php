<?php
require_once '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Basic Validation
    if (empty($username) || empty($email) || empty($password)) {
        header("Location: ../register.php?error=All fields are required");
        exit();
    }

    if ($password !== $confirm_password) {
        header("Location: ../register.php?error=Passwords do not match");
        exit();
    }

    // Check if email already exists
    $sql = "SELECT id FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    
    if ($stmt->rowCount() > 0) {
        header("Location: ../register.php?error=Email already registered");
        exit();
    }

    // Hash Password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert User
    $insertSql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
    $insertStmt = $pdo->prepare($insertSql);
    
    if ($insertStmt->execute(['username' => $username, 'email' => $email, 'password' => $hashed_password])) {
        header("Location: ../index.php?success=Registration successful! Please login.");
        exit();
    } else {
        header("Location: ../register.php?error=Something went wrong. Please try again.");
        exit();
    }
} else {
    header("Location: ../register.php");
    exit();
}
?>