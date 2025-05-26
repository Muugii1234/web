<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Store - Register</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f7f2e9;
      color: #333;
    }
    nav {
      background-color: #c6b4f0;
      padding: 1rem 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    nav .logo {
      font-weight: bold;
      font-size: 1.2rem;
    }
    nav a {
      text-decoration: none;
      margin-left: 15px;
      font-weight: bold;
      color: #222;
    }
    nav a:hover {
      color: #000;
      text-decoration: underline;
    }
    .container {
      max-width: 600px;
      margin: 50px auto;
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    h2 {
      text-align: center;
      color: #292064;
    }
    form {
      display: flex;
      flex-direction: column;
    }
    input[type="text"], input[type="email"], input[type="password"] {
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      border: none;
      padding: 10px;
      border-radius: 4px;
      cursor: pointer;
    }
    input[type="submit"]:hover {
      background-color: #45a049;
    }
    .message {
      text-align: center;
      margin-bottom: 15px;
    }
  </style>
</head>
<body>
<nav>
  <div class="logo">📚 BookNest</div>
  <div class="links">
    <a href="index.php">Home</a>
    <a href="register.php">Register</a>
    <a href="login.php">Login</a>
    <a href="books.php">Browse Books</a>
    <a href="wishlist.php">Wishlist</a>
    <a href="logout.php">Logout</a>
  </div>
</nav>

<div class="container">
  <h2>User Registration</h2>
  <?php
  include('db.php');
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $name = $_POST['fullname'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $confirm = $_POST['confirm'];

      if (empty($name) || empty($email) || empty($password) || empty($confirm)) {
          echo '<p class="message" style="color:red">All fields are required.</p>';
      } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          echo '<p class="message" style="color:red">Invalid email format.</p>';
      } elseif ($password !== $confirm) {
          echo '<p class="message" style="color:red">Passwords do not match.</p>';
      } else {
          $hashed = password_hash($password, PASSWORD_DEFAULT);
          $stmt = $conn->prepare("INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)");
          $stmt->bind_param("sss", $name, $email, $hashed);
          $stmt->execute();
          echo '<p class="message" style="color:green">Registered successfully!</p>';
      }
  }
  ?>
  <form method="post">
    <input type="text" name="fullname" placeholder="Full Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="password" name="confirm" placeholder="Confirm Password" required>
    <input type="submit" value="Register">
  </form>
</div>
</body>
</html>