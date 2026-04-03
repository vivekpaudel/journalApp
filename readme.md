# 📘 Journal Application College Project

A secure web-based journaling application built using PHP, MySQL, HTML, CSS, and JavaScript.

## Features
- **User Authentication:** Secure Login & Registration (Password Hashing).
- **CRUD Operations:** Create, Read, Update, and Delete journal entries.
- **Security:** SQL Injection prevention (Prepared Statements), XSS protection (htmlspecialchars), Session Management.
- **User Experience:** 
  - Real-time search filtering (JavaScript).
  - Random writing prompts to overcome writer's block.
  - Mood tracking with emojis.
  - Responsive design (Mobile-friendly).

## Installation Instructions
1. **Database:**
   - Open phpMyAdmin.
   - Import the `journal_db.sql` file provided in the root folder.
2. **Configuration:**
   - Open `config/db.php`.
   - Ensure the database username and password match your local server (default is root/empty for XAMPP).
3. **Run:**
   - Start Apache and MySQL in XAMPP/WAMP.
   - Open your browser and go to `http://localhost/your_project_folder/`.

## Technologies Used
- **Frontend:** HTML5, CSS3, JavaScript (ES6)
- **Backend:** PHP 8+
- **Database:** MySQL (PDO)
