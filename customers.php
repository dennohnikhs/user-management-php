<?php
session_start();
include './database/connection.php';
include './database/customers-fetch.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>

    <?php
    // Include the header
    include './includes/header.php';
    ?>

    <main>
        <h1>Customers</h1>
        <p>Here is a list of all customers in the system.</p>
        <div class="table-wrapper">
            <table class="table-row">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>Address</th>
                        <th>State</th>
                        <th>Country</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                $counter = 1;   
                foreach ($customers as $customer): 
                ?>
                    <tr>
                        <td><?php echo $counter++; ?></td>
                        <td><?php echo htmlspecialchars($customer['customerName']); ?></td>
                        <td><?php echo htmlspecialchars($customer['phone']); ?></td>
                        <td><?php echo htmlspecialchars($customer['addressLine1']); ?></td>
                        <td><?php echo htmlspecialchars($customer['state']); ?></td>
                        <td><?php echo htmlspecialchars($customer['country']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </main>

    <?php
    include './includes/footer.php';
    ?>
    <script src="./assets/js/script.js"></script>
</body>

</html>