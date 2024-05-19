<?php
require 'protected/dbconfig.in.php';

try { 
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
} catch (PDOException $e){
    die( $e->getMessage() );
}

$id = $_GET['id'] ?? '';

$query = "DELETE FROM product WHERE id = :id";

$stmt = $pdo->prepare($query);
$stmt->execute(['id' => $id]);

header('Location: products.php');
exit;
?>