<?php
session_start();
include './database/connection.php';

if(!isset($_SESSION['email'])){
    header("Location: /management-system/login.php");
    exit();
}

if (isset($_GET['id'])) {
    $customerId = $_GET['id'];
    
    // Delete the customer
    $sql = "DELETE FROM customers WHERE customerNumber = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $customerId);
    
    if ($stmt->execute()) {
        header("Location: customers.php");
        exit();
    } else {
        echo "Error deleting customer: " . $conn->error;
    }
} else {
    header("Location: customers.php");
    exit();
}
