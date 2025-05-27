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
        <div class="dashboard">
            <div class="welcome-section">
                <h1>Welcome to the Management System</h1>
                <p class="welcome-description">
                    A comprehensive platform for managing your business operations efficiently.
                    Track customers, products, orders, and revenue all in one place.
                </p>
            </div>

            <div class="stats-grid">
                <div class="stat-card customers">
                    <div class="stat-icon">👥</div>
                    <div class="stat-content">
                        <h2>Total Customers</h2>
                        <p class="stat-number"><?php echo number_format($totalCustomers); ?></p>
                        <span class="stat-label">Registered Customers</span>
                    </div>
                </div>

                <div class="stat-card products">
                    <div class="stat-icon">📦</div>
                    <div class="stat-content">
                        <h2>Total Products</h2>
                        <p class="stat-number"><?php echo number_format($totalProducts); ?></p>
                        <span class="stat-label">Active Products</span>
                    </div>
                </div>

                <div class="stat-card orders">
                    <div class="stat-icon">🛍️</div>
                    <div class="stat-content">
                        <h2>Total Orders</h2>
                        <p class="stat-number"><?php echo number_format($totalOrders); ?></p>
                        <span class="stat-label">Processed Orders</span>
                    </div>
                </div>

                <div class="stat-card revenue">
                    <div class="stat-icon">💰</div>
                    <div class="stat-content">
                        <h2>Total Revenue</h2>
                        <p class="stat-number">$<?php echo number_format($totalRevenue, 2); ?></p>
                        <span class="stat-label">Generated Revenue</span>
                    </div>
                </div>

                <div class="stat-card employees">
                    <div class="stat-icon">👨‍💼</div>
                    <div class="stat-content">
                        <h2>Total Employees</h2>
                        <p class="stat-number"><?php echo number_format($totalEmployees); ?></p>
                        <span class="stat-label">Active Employees</span>
                    </div>
                </div>
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