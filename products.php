<?php
require 'protected/dbconfig.in.php';
require 'Product.php';
try { 
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
} catch (PDOException $e){
    die( $e->getMessage() );
}

// Prepare the query
$query = "SELECT * FROM product";

$categories = ['Blazer', 'Suit', 'Shirt', 'Footware', 'Accessory'];

// Check if the user has searched for a product
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $search = $_POST['search'] ?? '';
    $field = $_POST['field'] ?? 'name';
    $category = $_POST['category'] ?? '';

    $params = [];

    if ($field === 'name') {
        $query .= " WHERE name LIKE :search";
        $params['search'] = "%$search%";
    } elseif ($field === 'price') {
        $query .= " WHERE price <= :search";
        $params['search'] = $search;
    } elseif ($field === 'category') {
        $query .= " WHERE category = :category";
        $params['category'] = $_POST['categorySelect'];
    }

    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
} else {
    $stmt = $pdo->query($query);
}

// Fetch all products as objects and store them in an array
$products = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $products[] = new Product(
        $row['id'],
        $row['name'],
        $row['category'],
        $row['description'],
        $row['price'],
        $row['quantity'],
        $row['rating'],
        $row['image']
    );
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
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

    <fieldset>
        <legend>Filter Products</legend>
        <form action="products.php" method="POST">
            <label for="search">Search:</label>
            <input type="text" id="search" name="search" placeholder="Search for something...">

            <label for="field">Search by:</label>
            <input type="radio" id="name" name="field" value="name" checked>
            <label for="name">Name</label>
            <input type="radio" id="price" name="field" value="price">
            <label for="price">Price</label>
            <input type="radio" id="category" name="field" value="category">
            <label for="category">Category</label>

            
            <select id="categorySelect" name="categorySelect">
                <option value="">All</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category; ?>"><?php echo $category; ?></option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Filter</button>
        </form>

    <table border="1">
        <thead>
            <tr>
                <th>Product Image</th>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <?php echo $product->displayInTable(); ?>
            <?php endforeach; ?>
        </tbody>
    </table>
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
