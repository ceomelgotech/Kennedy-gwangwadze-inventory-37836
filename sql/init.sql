CREATE DATABASE IF NOT EXISTS inventory_db;
USE inventory_db;

-- Create the users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Create the categories table
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(100) NOT NULL UNIQUE
);

-- Create the inventory table
CREATE TABLE inventory (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    category_id INT,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

-- Insert sample data into the users table
INSERT INTO users (username, password) VALUES 
('admin', '0192023a7bbd73250516f069df18b500'),
('johndoe', '6e0b7076126a29d5dfcbd54835387b7b'),
('janesmith', '5570c0cd80d575f9db152f9cc8bf1c6a');

-- Insert sample data into the categories table
INSERT INTO categories (category_name) VALUES 
('Electronics'),
('Clothing'),
('Books'),
('Home & Kitchen');

-- Insert sample data into the inventory table
INSERT INTO inventory (name, category_id, quantity, price) VALUES 
('Laptop', 1, 10, 999.99),          
('Smartphone', 1, 25, 499.99),    
('T-Shirt', 2, 50, 19.99),        
('Jeans', 2, 30, 39.99),          
('Novel: The Great Gatsby', 3, 15, 9.99),  
('Cookbook: Italian Cuisine', 3, 20, 14.99), 
('Blender', 4, 12, 49.99),    
('Coffee Maker', 4, 8, 79.99);