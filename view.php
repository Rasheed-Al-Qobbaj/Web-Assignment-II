<?php
require 'protected/dbconfig.in.php';
require 'Product.php';

try { 
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
} catch (PDOException $e){
    die( $e->getMessage() );
}

$id = $_GET['id'] ?? '';

$query = "SELECT * FROM product WHERE id = :id";

$stmt = $pdo->prepare($query);
$stmt->execute(['id' => $id]);

$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row === false) {
    $error = "Sorry, the product with ID $id was not found.";
} else {
    $product = new Product(
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    if (isset($error)) {
        echo "<h1>$error</h1>";
    } else {
        echo $product->displayProductPage();
    }
    ?>

    <a href="products.php">Back to products</a>
</body>
</html>