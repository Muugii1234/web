<?php
include('db.php');
session_start();

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if (isset($_GET['add'])) {
    $book_id = $_GET['add'];
    $conn->query("INSERT INTO wishlist (user_id, book_id) VALUES ($user_id, $book_id)");
}
if (isset($_GET['remove'])) {
    $book_id = $_GET['remove'];
    $conn->query("DELETE FROM wishlist WHERE user_id=$user_id AND book_id=$book_id");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Your Wishlist</title>
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
      text-decoration: underline;
    }
    .container {
      max-width: 1000px;
      margin: 50px auto;
      padding: 30px;
      background: white;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .book-card {
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 20px;
      margin-bottom: 20px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    .book-card h3 {
      margin: 0 0 8px;
      color: #292064;
    }
    .book-card p {
      margin: 0 0 10px;
    }
    .book-card a {
      color: #e53935;
      font-weight: bold;
      text-decoration: none;
    }
    .book-card a:hover {
      text-decoration: underline;
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
  <h2>Your Wishlist</h2>
  <?php
  $result = $conn->query("SELECT b.id, b.title, b.author, b.description FROM books b 
    JOIN wishlist w ON b.id = w.book_id WHERE w.user_id = $user_id");

  while ($row = $result->fetch_assoc()) {
      echo '<div class="book-card">';
      echo '<h3>' . htmlspecialchars($row['title']) . '</h3>';
      echo '<p><strong>Author:</strong> ' . htmlspecialchars($row['author']) . '</p>';
      echo '<p>' . htmlspecialchars($row['description']) . '</p>';
      echo '<a href="wishlist.php?remove=' . $row['id'] . '">❌ Remove from Wishlist</a>';
      echo '</div>';
  }
  ?>
</div>
</body>
</html>
