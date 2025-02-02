<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include("db.php");

// Fetch all inventory records
$query = "SELECT inventory.id, inventory.name, categories.category_name, inventory.quantity, inventory.price 
          FROM inventory 
          LEFT JOIN categories ON inventory.category_id = categories.id";
$result = $conn->query($query);

// Handle Delete Request
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $conn->query("DELETE FROM inventory WHERE id = $id");
    header("Location: inventory.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Inventory</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <?php include "header.php" ?>
    <!-- Main Content -->
    <div class="container mt-5">
        <h1 class="text-center mb-4">View Inventory</h1>

        
        <div class="mb-3">
            <input type="text" id="searchInput" class="form-control" placeholder="Search by name or category...">
        </div>

        
        <div class="mb-3">
            <a href="add_inventory.php" class="btn btn-primary">Add New Inventory</a>
        </div>

       
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['name'] ?></td>
                        <td><?= $row['category_name'] ?></td>
                        <td><?= $row['quantity'] ?></td>
                        <td>$<?= number_format($row['price'], 2) ?></td>
                        <td>
                            <a href="edit_inventory.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="inventory.php?action=delete&id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript for Search Functionality -->
    <script>
        document.getElementById('searchInput').addEventListener('input', function () {
            const searchValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                const category = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                if (name.includes(searchValue) || category.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>