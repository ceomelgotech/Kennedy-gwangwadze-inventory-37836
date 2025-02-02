<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include("db.php");

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_name = $_POST['category_name'];

    $stmt = $conn->prepare("INSERT INTO categories (category_name) VALUES (?)");
    $stmt->bind_param("s", $category_name);

    if ($stmt->execute()) {
        echo "<script>alert('New category has been successfully added!'); window.location.href='categories.php';</script>";
        exit();
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include "header.php" ?>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow" style="width: 24rem;">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Add Category</h2>
                <form method="POST">
                    <div class="mb-3">
                        <label for="category_name" class="form-label">Category Name</label>
                        <input type="text" name="category_name" class="form-control" id="category_name" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Add Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>