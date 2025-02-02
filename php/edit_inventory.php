<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include("db.php");

if (!isset($_GET['id'])) {
    echo "<script>alert('Invalid request!'); window.location.href='inventory.php';</script>";
    exit();
}

$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM inventory WHERE id = $id");
if ($result->num_rows == 0) {
    echo "<script>alert('Item not found!'); window.location.href='inventory.php';</script>";
    exit();
}
$item = $result->fetch_assoc();
$categories_result = $conn->query("SELECT * FROM categories");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $category_id = $_POST['category_id'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    $stmt = $conn->prepare("UPDATE inventory SET name=?, category_id=?, quantity=?, price=? WHERE id=?");
    $stmt->bind_param("siidi", $name, $category_id, $quantity, $price, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Inventory updated successfully!'); window.location.href='inventory.php';</script>";
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
    <title>Edit Inventory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include "header.php" ?>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow" style="width: 24rem;">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Edit Inventory</h2>
                <form method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="name" value="<?= $item['name'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select name="category_id" class="form-select" id="category" required>
                            <option value="">Select a category</option>
                            <?php while ($category = $categories_result->fetch_assoc()): ?>
                                <option value="<?= $category['id'] ?>" <?= ($category['id'] == $item['category_id']) ? 'selected' : '' ?>><?= $category['category_name'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" name="quantity" class="form-control" id="quantity" value="<?= $item['quantity'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" step="0.01" name="price" class="form-control" id="price" value="<?= $item['price'] ?>" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Update Inventory</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
