<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include("db.php");

if (!isset($_GET['id'])) {
    echo "<script>alert('Invalid request!'); window.location.href='users.php';</script>";
    exit();
}

$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM users WHERE id = $id");
if ($result->num_rows == 0) {
    echo "<script>alert('User not found!'); window.location.href='users.php';</script>";
    exit();
}
$user = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Use MD5 hashing for password
    $hashed_password = md5($password);

    $stmt = $conn->prepare("UPDATE users SET username=?, password=? WHERE id=?");
    $stmt->bind_param("ssi", $username, $hashed_password, $id);

    if ($stmt->execute()) {
        echo "<script>alert('User updated successfully!'); window.location.href='users.php';</script>";
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
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include "header.php" ?>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow" style="width: 24rem;">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Edit User</h2>
                <form method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" id="username" value="<?= $user['username'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Update User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
