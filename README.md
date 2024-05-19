# Gentleman's Reserve

This is a PHP-based web application for a store named "Gentleman's Reserve". The application provides various functionalities such as viewing products, registering as a customer, and contacting the store. This project is part of the Web Application and Technologies (COMP 334) assignment.

## Project Structure

- [`add.php`](add.php): This script allows users to add new products to the store.
- [`contact.html`](contact.html): This page provides contact information for the store.
- [`delete.php`](delete.php): This script allows users to delete existing products from the store.
- [`edit.php`](edit.php): This script allows users to update the details of existing products.
- [`index.html`](index.html): The home page of the website.
- [`Product.php`](Product.php): This file contains the Product class, which holds the product information and methods for displaying product details.
- [`products.php`](products.php): This script generates an HTML page that displays the products and allows users to perform a filter search.
- [`protected/dbconfig.in.php`](protected/dbconfig.in.php): This file defines the database connection details.
- [`register.html`](register.html): This page provides a registration form for customers.
- [`view.php`](view.php): This script displays the details of a specific product.

## Setup

1. Clone the repository.
2. Set up a local server (e.g., XAMPP).
3. Import the database file into your MySQL database.
4. Update the database connection details in `protected/dbconfig.in.php`.
5. Open the project in your web browser.

## Usage

1. Navigate to the home page to view the products.
2. Use the search form to filter the products by name, price, or category.
3. Click on a product ID to view the details of a specific product.
4. Use the Add, Edit, and Delete buttons to manage the products.

## Contributing

Contributions are welcome. Please open an issue or submit a pull request.

## License

This project is licensed under the MIT License.