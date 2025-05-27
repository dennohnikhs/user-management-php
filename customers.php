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
        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="success-message">
                <?php 
                    echo $_SESSION['success_message'];
                    unset($_SESSION['success_message']); 
                ?>
            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="error">
                <?php 
                    echo $_SESSION['error_message'];
                    unset($_SESSION['error_message']); 
                ?>
            </div>
        <?php endif; ?>
        <p>Here is a list of all customers in the system.</p>
        <div class="add-customer">
            <button onclick="window.location.href='add_customer.php'" class="add-btn">Add New Customer</button>
        </div>
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
                        <th>Actions</th>
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
                        <td class="actions">
                            <button onclick="window.location.href='edit_customer.php?id=<?php echo $customer['customerNumber']; ?>'" class="edit-btn">Edit</button>
                            <button onclick="if(confirm('Are you sure you want to delete this customer?')) window.location.href='delete_customer.php?id=<?php echo $customer['customerNumber']; ?>'" class="delete-btn">Delete</button>
                        </td>
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