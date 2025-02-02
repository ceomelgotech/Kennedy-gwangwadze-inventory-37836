        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Inventory Management</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav me-auto">
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="inventoryDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Inventory
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="inventoryDropdown">
                            <li><a class="dropdown-item" href="inventory.php">View Inventory</a></li>
                            <li><a class="dropdown-item" href="add_inventory.php">Add Inventory</a></li>
                        </ul>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="categoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Categories
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="categoriesDropdown">
                            <li><a class="dropdown-item" href="categories.php">View Categories</a></li>
                            <li><a class="dropdown-item" href="add_category.php">Add Category</a></li>
                        </ul>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="usersDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Users
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="usersDropdown">
                            <li><a class="dropdown-item" href="users.php">View Users</a></li>
                            <li><a class="dropdown-item" href="add_user.php">Add User</a></li>
                        </ul>
                    </li>
                </ul>
                <a href="logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </nav>