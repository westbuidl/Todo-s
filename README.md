# Todo-s
A simple, responsive task management web application built with PHP 8+, MySQL 8+, jQuery, and AJAX
A simple, responsive task management web application built with PHP 8+, MySQL 8+, jQuery, and AJAX. Features include adding tasks with descriptions, marking tasks as done, removing tasks with confirmation, and viewing task details via a modal - all without page reloads.

## Prerequisites

Before you begin, ensure you have the following installed on your computer:

- PHP 8+ (e.g., PHP 8.1, 8.2, or 8.3)
- MySQL 8+
- Web Server (e.g., Apache, Nginx, or PHP's built-in server)
- Git (optional, for cloning the repository)
- A modern web browser (Chrome, Firefox, Edge, etc.)

## Installation Steps

Follow these steps to download and run the Todo's app on your PC:

### 1. Download the Files
- Option 1: Git Clone
- Option 2: Manual Download
  - Download the zip file containing the two main files (`index.php` and `task_handler.php`) from the source.
  - Extract the zip to a folder (e.g., `Todo's`).

### 2. Set Up Your Web Server
- Using a Web Server (e.g., Apache/XAMPP)
  - Place the `Todo's` folder in your web server's root directory:
    - XAMPP: `C:\xampp\htdocs\`
    - WAMP: `C:\wamp\www\`
    - Linux Apache: `/var/www/html/`
- Using PHP's Built-in Server
  - Open a terminal, navigate to the `Todo's` folder, and run:
    bash
    php -S localhost:8000


### 3. Configure MySQL Database
- Start MySQL
- Create Database
  - Open your MySQL client (e.g., phpMyAdmin, MySQL Workbench, or command line) and create a database named `Todo-app`:
    sql
    CREATE DATABASE Todo-app;

- Update Database Credentials (if needed)
  - Open the includes folder and modify the **dbconn.php**  file to see the and modify the database settings if different.
  - Modify the database connection constants if your setup differs from the defaults:
    php
    const DB_HOST = 'localhost';
    const DB_USERNAME = 'root';      // Change if your MySQL username is different
    const DB_PASSWORD = 'root';      // Change if your MySQL password is different
    const DB_NAME = 'Todo-app';

  - The app will automatically create the `tasks` table when you first use it.

### 4. Run the Application
- Via Web Server
  - Open your browser and navigate to:
    - Apache: `http://localhost/Todo's/`
    - PHP Server: `http://localhost:8000/`
- The Todo's interface should load.

## Usage

- Add a Task
  - Click "Add task" to open the modal.
  - Enter a task name and optional description.
  - Click "Save Task" to add it to the list.
- View Task Details
  - Click any task name (underlined) to see its details in a modal.
- Mark as Done
  - Click "Mark as done" on a task to update its status.
- Remove a Task
  - Click "Remove task" and confirm the deletion in the popup.
- All actions update in real-time without page reloads thanks to AJAX.

## File Structure


Todo's/
├── index.php          # Main application file with HTML and frontend logic
└── task_handler.php   # Backend PHP script for database operations