<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include("db.php");

// Fetch total records for each table
$inventory_count = $conn->query("SELECT COUNT(*) as total FROM inventory")->fetch_assoc()['total'];
$categories_count = $conn->query("SELECT COUNT(*) as total FROM categories")->fetch_assoc()['total'];
$users_count = $conn->query("SELECT COUNT(*) as total FROM users")->fetch_assoc()['total'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include "header.php" ?>
    <!-- Main Content -->
    <div class="container mt-5">
        <h1 class="text-center mb-4">Welcome to Kennedy's Inventory Management</h1>
        <div class="row">
           
            <div class="col-md-4">
                <div class="card text-center shadow">
                    <div class="card-body">
                        <h5 class="card-title">Inventory</h5>
                        <p class="card-text display-4"><?= $inventory_count ?></p>
                        <a href="inventory.php" class="btn btn-primary">View Inventory</a>
                    </div>
                </div>
            </div>
           
            <div class="col-md-4">
                <div class="card text-center shadow">
                    <div class="card-body">
                        <h5 class="card-title">Categories</h5>
                        <p class="card-text display-4"><?= $categories_count ?></p>
                        <a href="categories.php" class="btn btn-primary">View Categories</a>
                    </div>
                </div>
            </div>
           
            <div class="col-md-4">
                <div class="card text-center shadow">
                    <div class="card-body">
                        <h5 class="card-title">Users</h5>
                        <p class="card-text display-4"><?= $users_count ?></p>
                        <a href="users.php" class="btn btn-primary">View Users</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>