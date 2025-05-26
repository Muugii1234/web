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

// Fetch all books
$books = $conn->query("SELECT * FROM books");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Books</title>
  <style>
    body {
      background: #f7f2e9;
      font-family: Arial;
      padding: 30px;
    }
    h2 {
      text-align: center;
    }
    .book-form, .book-table {
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      max-width: 800px;
      margin: 20px auto;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    input, textarea {
      width: 100%;
      padding: 8px;
      margin-top: 8px;
      margin-bottom: 15px;
    }
    input[type="submit"] {
      background: #4CAF50;
      color: white;
      border: none;
      cursor: pointer;
      font-weight: bold;
    }
    input[type="submit"]:hover {
      background: #45a049;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    table th, table td {
      padding: 10px;
      border-bottom: 1px solid #ddd;
    }
    table td a {
      color: red;
      text-decoration: none;
      font-weight: bold;
    }
  </style>
</head>
<body>
<h2>📚 Manage Books</h2>

<div class="book-form">
  <h3>Add New Book</h3>
  <form method="POST">
    <input type="text" name="title" placeholder="Book Title" required>
    <input type="text" name="author" placeholder="Author Name" required>
    <textarea name="description" placeholder="Description" required></textarea>
    <input type="submit" name="add" value="Add Book">
  </form>
</div>

<div class="book-table">
  <h3>Existing Books</h3>
  <table>
    <tr>
      <th>Title</th>
      <th>Author</th>
      <th>Description</th>
      <th>Action</th>
    </tr>
    <?php while ($row = $books->fetch_assoc()): ?>
    <tr>
      <form method="POST">
        <td><input type="text" name="title" value="<?= htmlspecialchars($row['title']) ?>"></td>
        <td><input type="text" name="author" value="<?= htmlspecialchars($row['author']) ?>"></td>
        <td><textarea name="description"><?= htmlspecialchars($row['description']) ?></textarea></td>
        <td>
          <input type="hidden" name="id" value="<?= $row['id'] ?>">
          <input type="submit" name="update" value="Update">
          <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Delete this book?')">Delete</a>
        </td>
      </form>
    </tr>
    <?php endwhile; ?>
  </table>
</div>
</body>
</html>
