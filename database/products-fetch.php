<?php
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

$products = [];

if ($result->num_rows > 0) {
    // Fetch all products
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
} else {
    echo "No products found.";
}