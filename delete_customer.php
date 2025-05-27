<?php
session_start();
include './database/connection.php';

if(!isset($_SESSION['email'])){
    header("Location: /management-system/login.php");
    exit();
}

if (isset($_GET['id'])) {
    $customerId = $_GET['id'];
    
    // Start transaction
    $conn->begin_transaction();
    
    try {
        // Check if customer exists first
        $check_sql = "SELECT customerNumber FROM customers WHERE customerNumber = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param("i", $customerId);
        $check_stmt->execute();
        $result = $check_stmt->get_result();
        
        if ($result->num_rows === 0) {
            throw new Exception("Customer not found");
        }

        // First delete related records from orderdetails table
        $sql = "DELETE FROM orderdetails WHERE orderNumber IN (SELECT orderNumber FROM orders WHERE customerNumber = ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $customerId);
        $stmt->execute();

        // Then delete related records from payments table
        $sql = "DELETE FROM payments WHERE customerNumber = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $customerId);
        $stmt->execute();
        
        // Then delete related records from orders table
        $sql = "DELETE FROM orders WHERE customerNumber = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $customerId);
        $stmt->execute();
        
        // Finally delete the customer
        $sql = "DELETE FROM customers WHERE customerNumber = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $customerId);
        if (!$stmt->execute()) {
            throw new Exception($conn->error);
        }
        
        // Verify deletion
        $verify_sql = "SELECT customerNumber FROM customers WHERE customerNumber = ?";
        $verify_stmt = $conn->prepare($verify_sql);
        $verify_stmt->bind_param("i", $customerId);
        $verify_stmt->execute();
        $verify_result = $verify_stmt->get_result();
        
        if ($verify_result->num_rows > 0) {
            throw new Exception("Failed to delete customer");
        }
        
        // If we got here, commit the changes
        $conn->commit();
        
        $_SESSION['success_message'] = "Customer deleted successfully!";
        header("Location: customers.php");
        exit();
        
    } catch (Exception $e) {
        // An error occurred, rollback changes
        $conn->rollback();
        $_SESSION['error_message'] = "Error deleting customer: " . $e->getMessage();
        header("Location: customers.php");
        exit();
    }
} else {
    header("Location: customers.php");
    exit();
}