<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include("db.php");

// Fetch all users records
$query = "SELECT id, username FROM users";
$result = $conn->query($query);

// Handle Delete Request
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $conn->query("DELETE FROM users WHERE id = $id");
    header("Location: users.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <?php include "header.php" ?>
  
    <div class="container mt-5">
        <h1 class="text-center mb-4">View Users</h1>

        
        <div class="mb-3">
            <input type="text" id="searchInput" class="form-control" placeholder="Search by username or role...">
        </div>

        
        <div class="mb-3">
            <a href="add_user.php" class="btn btn-primary">Add New User</a>
        </div>

      
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['username'] ?></td>
                        <td>
                            <a href="edit_user.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="users.php?action=delete&id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
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
                const username = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                const role = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                if (username.includes(searchValue) || role.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>
