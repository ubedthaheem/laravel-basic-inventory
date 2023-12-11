# Laravel Basic Inventory Management System

## Overview

Welcome to the Laravel Basic Inventory Management System! This project is designed to help you manage your inventory efficiently. It includes features such as product category management, supplier information, product details, stock tracking, and a user-friendly dashboard. The system is built on Laravel and uses the AdminLTE theme for a clean and professional admin panel.

## Features

### 1. Product Category Management

- **Add, Update, Delete:** Easily manage product categories.
- **Parent Category:** Assign parent categories for a hierarchical structure.
- **Slug:** Generate unique slugs for SEO-friendly URLs.

### 2. Suppliers

- **Basic Supplier Information:** Store supplier details, including Name, Phone, Email, and Address.

### 3. Products

- **Product Details:** Manage basic information about products, including Name, Unique Product Code, Cost, Photo, and Description.

### 4. Product Stock

- **Quantity Tracking:** Keep track of product quantities in stock.
- **Date of Added Stock:** Record the date when new stock is added.
- **Supplier Association:** Associate stock with a specific supplier.
- **Product Association:** Connect stock with a specific product.

### 5. Dashboard

- **Product Overview:** Display products on the dashboard with their prices and photos.
- **Buy Now Button:** Add a 'Buy Now' button for quick actions (currently without a click event).



## Getting Started

1. Clone the repository.
2. Run migrations to set up the database: `php artisan migrate` OR import database (The database file is located in the `/database/` folder) .
3. Populate the database with seed data if needed: `php artisan db:seed`.
4. Start the Laravel development server: `php artisan serve`.
5. Access the admin panel and start managing your inventory.

Feel free to explore the code and customize it according to your needs. Happy coding!
