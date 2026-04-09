-- Create the Database
CREATE DATABASE IF NOT EXISTS journal_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE journal_db;

-- 1. Users Table (Stores login info)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2. Entries Table (Stores journal posts)
-- utf8mb4 is important for Emoji support in moods!
CREATE TABLE IF NOT EXISTS entries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(100) NOT NULL,
    content TEXT NOT NULL,
    mood VARCHAR(20) DEFAULT 'neutral',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- 3. Prompts Table (For the "Writer's Block" feature)
CREATE TABLE IF NOT EXISTS prompts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    prompt_text TEXT NOT NULL
);

-- Insert some sample prompts
INSERT INTO prompts (prompt_text) VALUES 
('What made you smile today?'),
('What was the biggest challenge you faced today?'),
('What is one thing you learned new?'),
('Describe your perfect day.'),
('What are you grateful for right now?'),
('What is a goal you want to achieve this month?');