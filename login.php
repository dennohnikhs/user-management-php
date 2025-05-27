<?php
session_start();
include './database/connection.php';

if(isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    echo $query; // Debugging line to check the query
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['email'] = $user['email'];
        $_SESSION['name'] = $user['name'];
        header('Location: index.php'); 
        exit();
    } else {
        echo "<script>alert('Invalid email or password. Please try again.');</script>";
    }
}
?>
<!-- login.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <div class="form-container">
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
            <p>Don't have an account? <a href="register.php">Register</a></p>
        </form>
    </div>

</body>

</html>