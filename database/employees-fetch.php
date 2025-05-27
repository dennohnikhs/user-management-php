<?php
$sql = "SELECT e.*, r.firstName as rFirstName, r.lastName as rLastName FROM employees e LEFT JOIN employees r ON r.employeeNumber = e.reportsTo";

$result = $conn->query($sql);

$employees = [];
if ($result->num_rows > 0) {
    // Fetch all employees
    while ($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }
} else {
    echo "No employees found.";
}