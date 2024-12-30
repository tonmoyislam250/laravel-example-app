# Basic Project Structure

---

## **Step 1: Create a Project Folder**
1. Create a directory for your project, e.g., `php-project`.
2. Inside this folder, create the following structure:
   ```
   php-project/
   ├── index.php
   ├── db.php
   ├── styles/
   │   └── style.css
   ├── scripts/
   │   └── script.js
   └── templates/
       └── header.php
   ```

---

## **Step 2: Use a Template System**
Split your layout into reusable components like headers, footers, etc.:

1. **Create `templates/header.php`:**
   ```php
   <!DOCTYPE html>
   <html lang="en">
   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>My PHP App</title>
   </head>
   <body>
   <header>
       <h1>Welcome to My PHP App</h1>
   </header>
   ```

2. **Create `templates/footer.php`:**
   ```php
   <footer>
       <p>&copy; 2024 My PHP App</p>
   </footer>
   </body>
   </html>
   ```

3. **Include in `index.php`:**
   ```php
   <?php include 'templates/header.php'; ?>

   <h2>Dynamic Content Here</h2>

   <?php include 'templates/footer.php'; ?>
   ```

---

## **Step 3: Connect to a Database**
To use databases (e.g., MySQL), follow these steps:

1. **Create a Database using `mysql command line`**:
   - Login to `mysql`
      ```bash
      mysql -u root -p
      ```
   - Create a database and use that datab
      ```bash
      create database test_db;
      ```
   - Use that database
      ```bash
      use test_db;
      ```
   - Create table user
      ```bash
      CREATE TABLE user (
         id INT AUTO_INCREMENT,
         name VARCHAR(50) NOT NULL,
         PRIMARY KEY(id)
      );
      ```
   - Confirm the table is created with the DESCRIBE statement:
      ```bash
      DESCRIBE user;
      ```
   - Insert data to `user` table
      ```bash
      INSERT INTO user (name) 
      VALUES 
      ('John'), 
      ('Mark'); 
      ```
   - Check table data
      ```bash
      SELECT * FROM user;
      ```

2. **Create a Database using `phpMyAdmin`**:
   - Open phpMyAdmin (`http://localhost/phpmyadmin`).
   - Create a new database (e.g., `test_db`).

3. **Setup Database Connection in `db.php`**:
   ```php
   <?php
   $servername = "localhost";
   $username = "root"; // Default username for local servers
   $password = ""; // Default password for XAMPP/WAMP
   $dbname = "test_db";

   // Create connection
   $conn = new mysqli($servername, $username, $password, $dbname);

   // Check connection
   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   }
   echo "Connected successfully";
   ?>
   ```

---

## **Step 4: Start Development Server**

1. If PHP is already installed, navigate to your project folder and run:
   ```bash
   php -S localhost:8000
   ```
   This starts a development server on `http://localhost:8000`.

2. Otherwise, Run your script using `XAMPP` or `WAMP`:
   - If using XAMPP or WAMP, place the folder inside the `htdocs` or `www` directory, respectively.
   - Access your project at `http://localhost/php-project`.

---
