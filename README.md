# Inventory Management System

This is a simple web-based **Inventory Management System** designed to manage inventory items, categories, and users. The application is built using **PHP** and **MySQL**, and the entire environment is containerized using **Docker**. The project has three containers which are phpmyadmin container, mysql database and also the container for the web app itself.w

---
# Project Structure
inventory-management-system/
├── php/                  # Directory for PHP application files
│   ...........
├── sql/                  # Directory with Database initialization files
│   └── init.sql          # SQL script to initialize the database
├── docker-compose.yml    # Docker Compose configuration
├── README.md             # Project documentation
└── Dockerfile            # Custom Dockerfile for PHP

## Team Members

- **Kennedy Gwangwadze** - Student Number: 37836
---

## Project Features

- **User Authentication**: Login and logout functionality to help restrict access.
- **Inventory Management**: Add, edit, delete, and view inventory items.
- **Category Management**: Add, edit, delete, and view categories.
- **User Management**: Add, edit, delete, and view users.
- **Search Functionality**: Search for inventory, category and users.
- **Responsive Design**: Built using Bootstrap for a modern and responsive UI.

---

## Prerequisites

Before running the project, ensure you have the following installed on your system:

1. **Docker**: [Install Docker](https://docs.docker.com/get-docker/)
2. **Docker Compose**: [Install Docker Compose](https://docs.docker.com/compose/install/)

---

## Steps to Run the Project

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/your-username/inventory-management-system.git
   cd inventory-management-system

