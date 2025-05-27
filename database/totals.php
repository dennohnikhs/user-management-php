<?php

$totalCustomers = 0;
$totalProducts = 0;
$totalOrders = 0;
$totalRevenue = 0;
$totalEmployees = 0;


//count the total number of customers, products, orders, revenue, and employees

$sql = "SELECT COUNT(*) AS total FROM customers";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalCustomers = $row['total'];
} else {
    echo "Error fetching total customers: " . mysqli_error($conn);
}

$sql = "SELECT COUNT(*) AS total FROM products";
$result = mysqli_query($conn, $sql);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalProducts = $row['total'];
} else {
    echo "Error fetching total products: " . mysqli_error($conn);
}

$sql = "SELECT COUNT(*) AS total FROM orders";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalOrders = $row['total'];
} else {
    echo "Error fetching total orders: " . mysqli_error($conn);
}

$sql = "SELECT SUM(amount) AS total FROM payments";
$result = mysqli_query($conn, $sql);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalRevenue = $row['total'];
} else {
    echo "Error fetching total revenue: " . mysqli_error($conn);
}

$sql = "SELECT COUNT(*) AS total FROM employees";
$result = mysqli_query($conn, $sql);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalEmployees = $row['total'];
} else {
    echo "Error fetching total employees: " . mysqli_error($conn);
}