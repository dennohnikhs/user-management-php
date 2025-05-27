<?php
session_start();
include './database/connection.php';

if(!isset($_SESSION['email'])){
    header("Location: /management-system/login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: customers.php");
    exit();
}

$customerId = $_GET['id'];

// If form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "UPDATE customers SET 
            customerName = ?,
            contactLastName = ?,
            contactFirstName = ?,
            phone = ?,
            addressLine1 = ?,
            addressLine2 = ?,
            city = ?,
            state = ?,
            postalCode = ?,
            country = ?,
            salesRepEmployeeNumber = ?,
            creditLimit = ?
            WHERE customerNumber = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssisd",
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
        $_POST['creditLimit'],
        $customerId
    );

    if ($stmt->execute()) {
        header("Location: customers.php");
        exit();
    } else {
        $error = "Error updating customer: " . $conn->error;
    }
}

// Get customer data
$sql = "SELECT * FROM customers WHERE customerNumber = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $customerId);
$stmt->execute();
$result = $stmt->get_result();
$customer = $result->fetch_assoc();

if (!$customer) {
    header("Location: customers.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <?php include './includes/header.php'; ?>

    <main>
        <h1>Edit Customer</h1>
        <?php if (isset($error)): ?>
        <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" class="customer-form">
            <div class="form-group">
                <label>Customer Name:</label>
                <input type="text" name="customerName"
                    value="<?php echo htmlspecialchars($customer['customerName']); ?>" required>
            </div>

            <div class="form-group">
                <label>Contact Last Name:</label>
                <input type="text" name="contactLastName"
                    value="<?php echo htmlspecialchars($customer['contactLastName']); ?>" required>
            </div>

            <div class="form-group">
                <label>Contact First Name:</label>
                <input type="text" name="contactFirstName"
                    value="<?php echo htmlspecialchars($customer['contactFirstName']); ?>" required>
            </div>

            <div class="form-group">
                <label>Phone:</label>
                <input type="text" name="phone" value="<?php echo htmlspecialchars($customer['phone']); ?>" required>
            </div>

            <div class="form-group">
                <label>Address Line 1:</label>
                <input type="text" name="addressLine1"
                    value="<?php echo htmlspecialchars($customer['addressLine1']); ?>" required>
            </div>

            <div class="form-group">
                <label>Address Line 2:</label>
                <input type="text" name="addressLine2"
                    value="<?php echo htmlspecialchars($customer['addressLine2']); ?>">
            </div>

            <div class="form-group">
                <label>City:</label>
                <input type="text" name="city" value="<?php echo htmlspecialchars($customer['city']); ?>" required>
            </div>

            <div class="form-group">
                <label>State:</label>
                <input type="text" name="state" value="<?php echo htmlspecialchars($customer['state']); ?>">
            </div>

            <div class="form-group">
                <label>Postal Code:</label>
                <input type="text" name="postalCode" value="<?php echo htmlspecialchars($customer['postalCode']); ?>">
            </div>

            <div class="form-group">
                <label>Country:</label>
                <input type="text" name="country" value="<?php echo htmlspecialchars($customer['country']); ?>"
                    required>
            </div>

            <div class="form-group">
                <label>Sales Rep Employee Number:</label>
                <input type="number" name="salesRepEmployeeNumber"
                    value="<?php echo htmlspecialchars($customer['salesRepEmployeeNumber']); ?>">
            </div>

            <div class="form-group">
                <label>Credit Limit:</label>
                <input type="number" step="0.01" name="creditLimit"
                    value="<?php echo htmlspecialchars($customer['creditLimit']); ?>" required>
            </div>

            <div class="form-actions">
                <button type="submit">Update Customer</button>
                <button type="button" onclick="window.location.href='customers.php'">Cancel</button>
            </div>
        </form>
    </main>

    <?php include './includes/footer.php'; ?>
</body>

</html>