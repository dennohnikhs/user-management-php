<?php
session_start();
include './database/connection.php';

if(!isset($_SESSION['email'])){
    header("Location: /management-system/login.php");
    exit();
}

// Fetch all employees for the sales rep dropdown
$employee_sql = "SELECT employeeNumber, CONCAT(firstName, ' ', lastName, ' - ', jobTitle) as employeeName FROM employees WHERE jobTitle LIKE '%Sales%'";
$employee_result = $conn->query($employee_sql);
$salesReps = [];
if ($employee_result) {
    while ($row = $employee_result->fetch_assoc()) {
        $salesReps[] = $row;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $conn->begin_transaction();

        // Validate required fields and field lengths
        $required_fields = ['customerName', 'contactLastName', 'contactFirstName', 'phone', 
                          'addressLine1', 'city', 'country', 'creditLimit'];
        foreach ($required_fields as $field) {
            if (empty($_POST[$field])) {
                throw new Exception("$field is required");
            }
        }

        // Validate field lengths
        $max_lengths = [
            'customerName' => 50,
            'contactLastName' => 50,
            'contactFirstName' => 50,
            'phone' => 50,
            'addressLine1' => 50,
            'addressLine2' => 50,
            'city' => 50,
            'state' => 50,
            'postalCode' => 15,
            'country' => 50
        ];

        foreach ($max_lengths as $field => $max_length) {
            if (!empty($_POST[$field]) && strlen($_POST[$field]) > $max_length) {
                throw new Exception("$field cannot be longer than $max_length characters");
            }
        }

        // Get the next available customer number
        $sql = "SELECT MAX(customerNumber) as maxNum FROM customers";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $nextCustomerNumber = $row['maxNum'] + 1;

        // Set default values for optional fields
        $salesRepEmployeeNumber = !empty($_POST['salesRepEmployeeNumber']) ? $_POST['salesRepEmployeeNumber'] : null;
        $addressLine2 = !empty($_POST['addressLine2']) ? $_POST['addressLine2'] : null;
        $state = !empty($_POST['state']) ? $_POST['state'] : null;
        $postalCode = !empty($_POST['postalCode']) ? $_POST['postalCode'] : null;

        // Prepare the SQL query
        $sql = "INSERT INTO customers (
            customerNumber, customerName, contactLastName, contactFirstName,
            phone, addressLine1, addressLine2, city, state, postalCode,
            country, salesRepEmployeeNumber, creditLimit
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("issssssssssis",
            $nextCustomerNumber,
            $_POST['customerName'],
            $_POST['contactLastName'],
            $_POST['contactFirstName'],
            $_POST['phone'],
            $_POST['addressLine1'],
            $addressLine2,
            $_POST['city'],
            $state,
            $postalCode,
            $_POST['country'],
            $salesRepEmployeeNumber,
            $_POST['creditLimit']
        );

        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        // Verify the customer was added
        $verify_sql = "SELECT customerNumber FROM customers WHERE customerNumber = ?";
        $verify_stmt = $conn->prepare($verify_sql);
        $verify_stmt->bind_param("i", $nextCustomerNumber);
        $verify_stmt->execute();
        $verify_result = $verify_stmt->get_result();
        
        if ($verify_result->num_rows === 0) {
            throw new Exception("Failed to add customer");
        }

        $conn->commit();
        $_SESSION['success_message'] = "Customer added successfully!";
        header("Location: customers.php");
        exit();
    } catch (Exception $e) {
        $conn->rollback();
        $error = "Error adding customer: " . $e->getMessage();
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
                <input type="text" name="customerName" maxlength="50" required>
            </div>

            <div class="form-group">
                <label>Contact Last Name:</label>
                <input type="text" name="contactLastName" maxlength="50" required>
            </div>

            <div class="form-group">
                <label>Contact First Name:</label>
                <input type="text" name="contactFirstName" maxlength="50" required>
            </div>

            <div class="form-group">
                <label>Phone:</label>
                <input type="text" name="phone" maxlength="50" required>
            </div>

            <div class="form-group">
                <label>Address Line 1:</label>
                <input type="text" name="addressLine1" maxlength="50" required>
            </div>

            <div class="form-group">
                <label>Address Line 2:</label>
                <input type="text" name="addressLine2" maxlength="50">
            </div>

            <div class="form-group">
                <label>City:</label>
                <input type="text" name="city" maxlength="50" required>
            </div>

            <div class="form-group">
                <label>State:</label>
                <input type="text" name="state" maxlength="50">
            </div>

            <div class="form-group">
                <label>Postal Code:</label>
                <input type="text" name="postalCode" maxlength="15">
            </div>

            <div class="form-group">
                <label>Country:</label>
                <input type="text" name="country" maxlength="50" required>
            </div>

            <div class="form-group">
                <label>Sales Representative:</label>
                <select name="salesRepEmployeeNumber">
                    <option value="">Select a Sales Representative</option>
                    <?php foreach ($salesReps as $rep): ?>
                    <option value="<?php echo htmlspecialchars($rep['employeeNumber']); ?>">
                        <?php echo htmlspecialchars($rep['employeeName']); ?>
                    </option>
                    <?php endforeach; ?>
                </select>
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