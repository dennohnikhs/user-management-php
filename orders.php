<?php
include './database/connection.php';
include './database/orders-fetch.php';

?>

<!DOCTYPE html>
<html lang="en">

</html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <?php include './includes/header.php'; ?>
    <main>
        <h1>Orders</h1>
        <p>Below is a list of all orders in the system:</p>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Order Number</th>
                        <th>Order Date</th>
                        <th>Required Date</th>
                        <th>Shipped Date</th>
                        <th>Status</th>
                        <th>Comments</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($order['orderNumber']); ?></td>
                        <td><?php echo htmlspecialchars($order['orderDate']); ?></td>
                        <td><?php echo htmlspecialchars($order['requiredDate']); ?></td>
                        <td><?php echo htmlspecialchars($order['shippedDate']); ?></td>
                        <td><?php echo htmlspecialchars($order['status']); ?></td>
                        <td><?php echo htmlspecialchars($order['comments']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </main>

    <?php include './includes/footer.php'; ?>
    <script src="./assets/js/script.js"></script>
</body>

</html>