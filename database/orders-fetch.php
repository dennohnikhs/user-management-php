<?php
$sql =  "SELECT * FROM orders";

$result = $conn->query($sql);

$orders = [];
if ($result->num_rows > 0) {
    // Fetch all orders
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
} else {
    echo "No orders found.";
}