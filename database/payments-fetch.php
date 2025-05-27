<?php
$sql = "SELECT * FROM payments";

$result = $conn->query($sql);

$payments = [];

if ($result->num_rows > 0) {
    // Fetch all payments
    while ($row = $result->fetch_assoc()) {
        $payments[] = $row;
    }
} else {
    echo "No payments found.";
}