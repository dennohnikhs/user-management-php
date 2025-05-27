<?php
session_start();

if(!isset($_SESSION['email'])){
    header("Location: /management-system/login.php");
    exit();
}
?>

<nav class="navbar">
    <button class="hamburger" onclick="toggleMenu()">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
    </button>
    <ul class="nav-menu">
        <li><a href="index.php">Home</a></li>
        <li><a href="customers.php">Customers</a></li>
        <li><a href="products.php">Products</a></li>
        <li><a href="orders.php">Orders</a></li>
        <li><a href="payments.php">Payments</a></li>
        <li><a href="employees.php">Employees</a></li>
    </ul>
</nav>