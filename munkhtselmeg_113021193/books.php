<?php
include('db.php');
session_start();

// Insert
if (isset($_POST['add'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $desc = $_POST['description'];
    $stmt = $conn->prepare("INSERT INTO books (title, author, description) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $author, $desc);
    $stmt->execute();
}

// Update
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $desc = $_POST['description'];
    $stmt = $conn->prepare("UPDATE books SET title=?, author=?, description=? WHERE id=?");
    $stmt->bind_param("sssi", $title, $author, $desc, $id);
    $stmt->execute();
}

// Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM books WHERE id = $id");
}

// Add to wishlist
if (isset($_GET['add_wishlist']) && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $book_id = $_GET['add_wishlist'];
    $conn->query("INSERT INTO wishlist (user_id, book_id) VALUES ($user_id, $book_id)");
}

$books = $conn->query("SELECT * FROM books");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Book Store - Browse & Manage</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f7f2e9;
      margin: 0;
      padding: 0;
    }
    nav {
      background: #c6b4f0;
      padding: 1rem 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    nav .logo {
      font-weight: bold;
    }
    nav a {
      margin-left: 15px;
      text-decoration: none;
      font-weight: bold;
      color: #222;
    }
    .container {
      max-width: 1000px;
      margin: 30px auto;
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      color: #292064;
    }
    form {
      margin-bottom: 20px;
    }
    input, textarea {
      width: 100%;
      padding: 8px;
      margin: 5px 0 10px;
    }
    input[type="submit"] {
      background: #4CAF50;
      color: white;
      border: none;
      padding: 10px;
      border-radius: 5px;
      cursor: pointer;
    }
    input[type="submit"]:hover {
      background: #388e3c;
    }
    .book-card {
      border: 1px solid #ccc;
      padding: 15px;
      margin-bottom: 15px;
      border-radius: 8px;
    }
    .book-card a {
      color: #e53935;
      text-decoration: none;
      font-weight: bold;
      margin-left: 10px;
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
  <h2>📖 Browse & Manage Books</h2>

  <!-- Add New Book Form -->
  <form method="POST">
    <input type="text" name="title" placeholder="Book Title" required>
    <input type="text" name="author" placeholder="Author Name" required>
    <textarea name="description" placeholder="Book Description" required></textarea>
    <input type="submit" name="add" value="➕ Add Book">
  </form>

  <!-- Display Books -->
  <?php while ($row = $books->fetch_assoc()): ?>
    <div class="book-card">
      <form method="POST">
        <input type="hidden" name="id" value="<?= $row['id'] ?>">
        <input type="text" name="title" value="<?= htmlspecialchars($row['title']) ?>" required>
        <input type="text" name="author" value="<?= htmlspecialchars($row['author']) ?>" required>
        <textarea name="description" required><?= htmlspecialchars($row['description']) ?></textarea>
        <input type="submit" name="update" value="✏️ Update">
        <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Are you sure to delete?')">🗑️ Delete</a>
        <a href="?add_wishlist=<?= $row['id'] ?>">💚 Add to Wishlist</a>
      </form>
    </div>
  <?php endwhile; ?>
</div>
</body>
</html>
