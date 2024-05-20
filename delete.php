<?php
require 'protected/dbconfig.in.php';

try { 
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
} catch (PDOException $e){
    die( $e->getMessage() );
}

$id = $_GET['id'] ?? '';

// Fetch the image filename before deleting the entry
$query = "SELECT image FROM product WHERE id = :id";
$stmt = $pdo->prepare($query);
$stmt->execute(['id' => $id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$image = $row['image'];

// Delete the entry from the database
$query = "DELETE FROM product WHERE id = :id";
$stmt = $pdo->prepare($query);
$stmt->execute(['id' => $id]);

// Delete the image file
if ($image) {
    $imagePath = "images/" . $image;
    if (file_exists($imagePath)) {
        unlink($imagePath);
    }
}

header('Location: products.php');
exit;
?>