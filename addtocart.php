<?php
// add_to_cart.php

header('Content-Type: application/json');

// Database connection
$host = 'localhost';
$dbname = 'shopping_cart';
$username = 'root';
$password = '';

// Check if product_id is received
if (isset($_POST['product_id'])) {
    $productId = intval($_POST['product_id']);

    // Insert the product into the cart table
    try {
        $stmt = $pdo->prepare("INSERT INTO cart (product_id, quantity) VALUES (:product_id, 1) ON DUPLICATE KEY UPDATE quantity = quantity + 1");
        $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $stmt->execute();

        echo json_encode(['success' => true, 'message' => 'Product added to cart.']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Failed to add product to cart.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No product ID provided.']);
}
?>