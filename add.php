<?php
require 'protected/dbconfig.in.php';
require 'Product.php';

try { 
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
} catch (PDOException $e){
    die( $e->getMessage() );
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $rating = $_POST['rating'];

    $image = $_FILES['image'];
    $imageType = exif_imagetype($image['tmp_name']);

    if ($imageType !== IMAGETYPE_JPEG) {
        die('Please upload a JPEG image.');
    }

    $query = "INSERT INTO product (name, category, description, price, quantity, rating, image) VALUES (:name, :category, :description, :price, :quantity, :rating, :image)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'name' => $name,
        'category' => $category,
        'description' => $description,
        'price' => $price,
        'quantity' => $quantity,
        'rating' => $rating,
        'image' => $image['name']
    ]);

    $id = $pdo->lastInsertId();
    $imageName = $id . '.jpeg';
    move_uploaded_file($image['tmp_name'], 'images/' . $imageName);

    $query = "UPDATE product SET image = :image WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'image' => $imageName,
        'id' => $id
    ]);

    header('Location: products.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>
<body>
    <header>
        <h1>Gentleman's Reserve</h1>
        <a href="index.html">
            <img src="images/logo.png" alt="Store Logo" width="50px">
        </a>
        <nav>
            <a href="index.html">Home</a>
            <a href="products.php">Products</a>
            <a href="contact.html">Contact Us</a>
            <a href="register.html">Register</a>
        </nav>
    </header>
    <h1>Add Product</h1>
    <fieldset>
        <legend>Product Record</legend>
        <form action="add.php" method="post" enctype="multipart/form-data">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br><br>

            <label for="category">Category:</label>
            <select id="category" name="category" required>
                <option value="">Select a category</option>
                <option value="Blazer">Blazer</option>
                <option value="Suit">Suit</option>
                <option value="Shirt">Shirt</option>
                <option value="Footware">Footware</option>
                <option value="Accessory">Accessory</option>
            </select><br><br>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" required><br><br>
            
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" required><br><br>
            
            <label for="rating">Rating:</label>
            <input type="number" id="rating" name="rating" required><br><br>
            
            <label for="description">Description:</label><br>
            <textarea id="description" name="description" required></textarea><br><br>

            <label for="image">Product Photo:</label>
            <input type="file" id="image" name="image" accept="image/jpeg" required><br><br>

            <input type="submit" value="Add Product">
        </form>
    </fieldset>
    <footer>
        Last updated: May 15, 2024
        <address>
            <p>Store address: Al-Wakalat St. Ramallah, Palestine</p>
        </address>
        Customer Support: <a href="contact.html">Contact Us</a>
    </footer>
</body>
</html>