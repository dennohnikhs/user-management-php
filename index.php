<?php
session_start();


include './database/connection.php';
include './database/totals.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management System</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>


    <?php
    include './includes/header.php';
    ?>
    <main>
        <div class="welcome-text">
            <h1>Welcome to the Management System</h1>
            <p>
                This is a management system for managing customers, products, and orders. It provides an overview of the
                total number of customers, products, orders, and total revenue generated.
            </p>
        </div>

        <div class="totals">
            <div class="total-display">
                <h2>Total Customers</h2>
                <p><?php echo $totalCustomers; ?></p>
            </div>
            <div class="total-display">
                <h2>Total Products</h2>
                <p><?php echo $totalProducts; ?></p>
            </div>
            <div class="total-display">
                <h2>Total Orders</h2>
                <p><?php echo $totalOrders; ?></p>
            </div>
            <div class="total-display">
                <h2>Total Revenue</h2>
                <p><?php echo number_format($totalRevenue, 2); ?></p>
            </div>
            <div class="total-display">
                <h2>Total Employees</h2>
                <p><?php echo $totalEmployees; ?></p>
            </div>
        </div>
    </main>

    <?php
    // Include the footer
    include './includes/footer.php';
    ?>
    <script src="./assets/js/script.js"></script>
</body>

</html>