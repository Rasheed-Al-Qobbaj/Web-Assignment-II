<?php
require 'protected/dbconfig.in.php';
require 'Product.php';

try { 
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
} catch (PDOException $e){
    die( $e->getMessage() );
}

$id = $_GET['id'] ?? '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $image = $_FILES['image'];
    $imageType = exif_imagetype($image['tmp_name']);

    if ($imageType !== IMAGETYPE_JPEG) {
        die('Please upload a JPEG image.');
    }

    $imageName = $id . '.jpeg';
    move_uploaded_file($image['tmp_name'], 'images/' . $imageName);

    $query = "UPDATE product SET description = :description, price = :price, quantity = :quantity, image = :image WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'description' => $description,
        'price' => $price,
        'quantity' => $quantity,
        'image' => $imageName,
        'id' => $id
    ]);

    header('Location: products.php');
    exit;
} else {
    $query = "SELECT * FROM product WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row === false) {
        die('Product not found.');
    }

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
    <title>Edit Product</title>
</head>
<body>
    <h1>Edit Product</h1>
    <fieldset>
        <legend>Product Record</legend>
        <form action="edit.php?id=<?php echo htmlspecialchars($id) ?>" method="post" enctype="multipart/form-data">
            
            <label for="id">ID:</label>
            <input type="text" id="id" name="id" value="<?php echo htmlspecialchars($product->getId()) ?>" disabled><br><br>

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product->getName()) ?>" required><br><br>

            <label for="category">Category:</label>
            <input type="text" id="category" name="category" value="<?php echo htmlspecialchars($product->getCategory()) ?>" disabled><br><br>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" value="<?php echo htmlspecialchars($product->getPrice()) ?>" required><br><br>
            
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" value="<?php echo htmlspecialchars($product->getQuantity()) ?>" required><br><br>
            
            <label for="rating">Rating:</label>
            <input type="number" id="rating" name="rating" value="<?php echo htmlspecialchars($product->getRating()) ?>" disabled><br><br>
            
            <label for="description">Description:</label><br>
            <textarea id="description" name="description" required><?php echo htmlspecialchars($product->getDescription()) ?></textarea><br><br>

            <label for="image">Product Photo:</label>
            <input type="file" id="image" name="image" accept="image/jpeg" ><br><br>

            <input type="submit" value="Update Product">
        </form>
        </fieldset>
</body>
</html>