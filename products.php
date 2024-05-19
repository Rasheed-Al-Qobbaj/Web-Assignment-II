<?php
require 'protected/dbconfig.in.php';
require 'Product.php';
try { 
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
} catch (PDOException $e){
    die( $e->getMessage() );
}

$search = $_POST['search'] ?? '';
$filter = $_POST['filter'] ?? 'name';
$categoryFilter = $_POST['categoryFilter'] ?? '';

// Fetch unique categories for the dropdown
$categories = [];
$categoryQuery = "SELECT DISTINCT category FROM product";
$stmt = $pdo->query($categoryQuery);
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $categories[] = $row['category'];
}

// Construct the query based on search and filters
$query = "SELECT * FROM product";
$params = [];

if ($search) {
    switch ($filter) {
        case 'name':
            $query .= " WHERE name LIKE :search";
            $params[':search'] = "%$search%";
            break;
        case 'price':
            $query .= " WHERE price <= :search";
            $params[':search'] = $search;
            break;
        case 'category':
            $query .= " WHERE category LIKE :category";
            $params[':category'] = "%$categoryFilter%";
            break;
    }
}

$stmt = $pdo->prepare($query);
$stmt->execute($params);
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
        <h1>e-Clothing Store</h1>
        <nav>
            <a href="add.php">Add a new Product</a>
            <a href="products.php">View Products</a>
        </nav>
    </header>

    <form method="POST" action="products.php">
        <input type="text" name="search" placeholder="Search Product Name">
        <label><input type="radio" name="filter" value="name" checked> Name</label>
        <label><input type="radio" name="filter" value="price"> Price</label>
        <label><input type="radio" name="filter" value="category"> Category</label>
        <select name="categoryFilter">
            <option value="">Select Category</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo htmlspecialchars($category); ?>">
                    <?php echo htmlspecialchars($category); ?>
                </option>
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

    <footer>
        <p>Last updated: <?php echo date('Y-m-d'); ?></p>
        <p>Store Address: 123 Fashion Ave, New York, NY</p>
        <p>Customer Support: (555) 123-4567 | support@eclothingstore.com</p>
        <a href="contact.php">Contact Us</a>
    </footer>
</body>
</html>
