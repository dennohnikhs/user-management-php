<?php
//customers fetch script
$sql = "SELECT * FROM customers";
$result = $conn->query($sql);
$customers = [];
if ($result->num_rows > 0) {
    // Fetch all customers
    while ($row = $result->fetch_assoc()) {
        $customers[] = $row;
    }
} else {
    echo "No customers found.";
}