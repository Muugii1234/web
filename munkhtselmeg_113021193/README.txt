
PHP Book Store Website - Munkhtselmeg Nymsuren (Student ID: 113021193)

Objective:
Build a simple PHP-based “Book Store website” using core PHP and MySQL. 
The website allows users to register, log in, browse books, and manage their personal book wishlist.

--------------------------------------------------------------------------------
Features Implemented:

1. Homepage (index.php)
- Navigation menu (Home, Register, Login, Browse Books, Wishlist, Logout)
- Map (placeholder), Calendar (placeholder), and a section for user visit count

2. User Registration (register.php)
- Fields: Full Name, Email, Password, Confirm Password
- Validation: checks for empty input, email format, and password match
- Data saved to `users` table

3. User Login (login.php)
- Authenticates using Email and Password
- Uses PHP sessions to manage login state

4. Book Browsing (books.php)
- Displays list of books from `books` table
- Shows title, author, description
- Each has “Add to Wishlist” button
- Admin insert/update/delete not included (can be added later)

5. Wishlist (wishlist.php)
- Displays all books the logged-in user added to their wishlist
- Allows user to remove books from wishlist

6. Logout (logout.php)
- Ends the session and redirects to login page

--------------------------------------------------------------------------------
Setup Instructions:

1. Open XAMPP and start both Apache and MySQL.
2. Place the folder `munkhtselmeg_113021193` into `C:/xampp/htdocs/`
3. Go to `http://localhost/phpmyadmin`, create a database called `bookstore`.
4. Run the following SQL to create necessary tables:

-- Users Table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255)
);

-- Books Table
CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100),
    author VARCHAR(100),
    description TEXT
);

-- Wishlist Table
CREATE TABLE wishlist (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    book_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (book_id) REFERENCES books(id)
);

5. Visit: http://localhost/munkhtselmeg_113021193/index.php

--------------------------------------------------------------------------------
Submitted By:
Munkhtselmeg Nymsuren
Student ID: 113021193
Date: May 27th
