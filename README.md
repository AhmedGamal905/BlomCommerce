﻿# Blom Commerce

Welcome to blomCommerce, a powerful and user-friendly e-commerce platform. This project provides a comprehensive solution for managing products, orders, and users through an admin dashboard. Users can easily register, browse products, and make purchases.

## Features

- **Admin Dashboard**: A centralized interface for admins to upload products, manage orders, and view user accounts.
- **User Registration**: Simple and secure user registration and authentication.
- **Product Management**: Admins can add, update, and delete products, including handling product images.
- **Order Management**: Admins can view, update, and manage customer orders.
- **Image Handling**: Uses the Spatie library to manage product images efficiently.

## Installation

### Prerequisites

Before you begin the installation, ensure you have the following prerequisites installed:

- **PHP**: Make sure you have PHP installed on your server. Laravel requires PHP version 8.3 or higher.
- **Composer**: Composer is a dependency manager for PHP. Laravel utilizes Composer to manage its dependencies, so you'll need to have it installed.
- **Laravel**: This project is built using the Laravel framework. If you haven't already, install Laravel by following the instructions on the official Laravel website.
- **Database**: Laravel supports several database systems. Ensure you have one of the supported databases installed, such as MySQL.

Once you have these prerequisites, you can proceed with the installation steps.

### Steps

1. **Clone the repository:**

   ```bash
   git clone https://github.com/AhmedGamal905/BlomCommerce
   cd BlomCommerce
   ```

2. **Install backend dependencies:**

   ```bash
   composer require install
   ```

3. **Set up environment variables:**

   Create a `.env` file in the root directory and add the necessary configuration values:

   ```plaintext
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=blom_commerce
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Run database migrations:**

   ```bash
   php artisan migrate
   ```

5. **Start the development server:**

   ```bash
   php artisan serve
   npm start
   ```

6. **Access the application:**

   Open your browser and navigate to `http://localhost:8000` (or the specified port).

## Usage

- **Admin Dashboard:**

  - Log in with your admin credentials.
  - Navigate to the Products section to add, update, or delete products.
  - Go to the Orders section to manage customer orders.
  - Use the Users section to handle user accounts.

- **User Interface:**

  - Register or log in to your account.
  - Browse products and add them to your cart.
  - Proceed to checkout to place an order.

## Acknowledgements

- [Spatie](https://spatie.be/) for the excellent image handling library.
