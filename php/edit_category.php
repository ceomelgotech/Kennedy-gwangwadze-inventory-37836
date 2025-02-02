<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include("db.php");

if (!isset($_GET['id'])) {
    echo "<script>alert('Invalid request!'); window.location.href='categories.php';</script>";
    exit();
}

$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM categories WHERE id = $id");
if ($result->num_rows == 0) {
    echo "<script>alert('Category not found!'); window.location.href='categories.php';</script>";
    exit();
}
$category = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_name = $_POST['category_name'];

    $stmt = $conn->prepare("UPDATE categories SET category_name=? WHERE id=?");
    $stmt->bind_param("si", $category_name, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Category updated successfully!'); window.location.href='categories.php';</script>";
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
    <title>Edit Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include "header.php" ?>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow" style="width: 24rem;">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Edit Category</h2>
                <form method="POST">
                    <div class="mb-3">
                        <label for="category_name" class="form-label">Category Name</label>
                        <input type="text" name="category_name" class="form-control" id="category_name" value="<?= $category['category_name'] ?>" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Update Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
