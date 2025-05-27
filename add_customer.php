<?php
session_start();
include './database/connection.php';

if(!isset($_SESSION['email'])){
    header("Location: /management-system/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the next available customer number
    $sql = "SELECT MAX(customerNumber) as maxNum FROM customers";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $nextCustomerNumber = $row['maxNum'] + 1;

    // Prepare the SQL query
    $sql = "INSERT INTO customers (
        customerNumber, customerName, contactLastName, contactFirstName,
        phone, addressLine1, addressLine2, city, state, postalCode,
        country, salesRepEmployeeNumber, creditLimit
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssssssssis",
        $nextCustomerNumber,
        $_POST['customerName'],
        $_POST['contactLastName'],
        $_POST['contactFirstName'],
        $_POST['phone'],
        $_POST['addressLine1'],
        $_POST['addressLine2'],
        $_POST['city'],
        $_POST['state'],
        $_POST['postalCode'],
        $_POST['country'],
        $_POST['salesRepEmployeeNumber'],
        $_POST['creditLimit']
    );

    if ($stmt->execute()) {
        header("Location: customers.php");
        exit();
    } else {
        $error = "Error adding customer: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Customer</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <?php include './includes/header.php'; ?>
    
    <main>
        <h1>Add New Customer</h1>
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form method="POST" class="customer-form">
            <div class="form-group">
                <label>Customer Name:</label>
                <input type="text" name="customerName" required>
            </div>
            
            <div class="form-group">
                <label>Contact Last Name:</label>
                <input type="text" name="contactLastName" required>
            </div>
            
            <div class="form-group">
                <label>Contact First Name:</label>
                <input type="text" name="contactFirstName" required>
            </div>
            
            <div class="form-group">
                <label>Phone:</label>
                <input type="text" name="phone" required>
            </div>
            
            <div class="form-group">
                <label>Address Line 1:</label>
                <input type="text" name="addressLine1" required>
            </div>
            
            <div class="form-group">
                <label>Address Line 2:</label>
                <input type="text" name="addressLine2">
            </div>
            
            <div class="form-group">
                <label>City:</label>
                <input type="text" name="city" required>
            </div>
            
            <div class="form-group">
                <label>State:</label>
                <input type="text" name="state">
            </div>
            
            <div class="form-group">
                <label>Postal Code:</label>
                <input type="text" name="postalCode">
            </div>
            
            <div class="form-group">
                <label>Country:</label>
                <input type="text" name="country" required>
            </div>
            
            <div class="form-group">
                <label>Sales Rep Employee Number:</label>
                <input type="number" name="salesRepEmployeeNumber">
            </div>
            
            <div class="form-group">
                <label>Credit Limit:</label>
                <input type="number" step="0.01" name="creditLimit" required>
            </div>
            
            <div class="form-actions">
                <button type="submit">Add Customer</button>
                <button type="button" onclick="window.location.href='customers.php'">Cancel</button>
            </div>
        </form>
    </main>
    
    <?php include './includes/footer.php'; ?>
</body>
</html>
