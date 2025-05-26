<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Welcome to Bookchin</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-image: url('backround.jpg');
      background-size: cover;
      background-position: center;
      color: white;
    }
    nav {
      background-color: rgba(0, 0, 0, 0.6);
      padding: 1rem 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .logo {
      font-size: 1.5rem;
      font-weight: bold;
      color: #f0c040;
    }
    nav a {
      color: white;
      text-decoration: none;
      margin-left: 15px;
      font-weight: bold;
    }
    nav a:hover {
      text-decoration: underline;
    }
    .welcome {
      text-align: center;
      margin-top: 10%;
      background: rgba(0, 0, 0, 0.5);
      padding: 50px;
      border-radius: 10px;
      max-width: 700px;
      margin-left: auto;
      margin-right: auto;
    }
    h1 {
      font-size: 3rem;
      margin-bottom: 20px;
      color: #f5d76e;
    }
    p {
      font-size: 1.2rem;
      line-height: 1.6;
    }
  </style>
</head>
<body>
<nav>
  <div class="logo">📚 Bookchin</div>
  <div>
    <a href="index.php">Home</a>
    <a href="register.php">Register</a>
    <a href="login.php">Login</a>
    <a href="books.php">Browse Books</a>
    <a href="wishlist.php">Wishlist</a>
    <a href="logout.php">Logout</a>
  </div>
</nav>

<div class="welcome">
  <h1>Welcome to Bookchin</h1>
  <p>
    Explore a curated collection of your favorite titles.<br>
    Easily register, browse, and create your personal wishlist.<br>
    Designed for readers. Built with care.<br><br>
    <em>Expand your book visionary through this website.</em>
  </p>
</div>
</body>
</html>
