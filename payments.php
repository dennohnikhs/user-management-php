<?php
include './database/connection.php';
include './database/payments-fetch.php';

?>
<!DOCTYPE html>
<html lang="en">

</html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <?php include './includes/header.php'; ?>
    <main>
        <h1>Payments</h1>
        <p>Below is a list of all payments in the system:</p>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Customer Number</th>
                        <th>Check Number</th>
                        <th>Payment Date</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($payments as $payment): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($payment['customerNumber']); ?></td>
                        <td><?php echo htmlspecialchars($payment['checkNumber']); ?></td>
                        <td><?php echo htmlspecialchars($payment['paymentDate']); ?></td>
                        <td><?php echo htmlspecialchars($payment['amount']); ?></td>
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