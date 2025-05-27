<?php
session_start();
include './database/connection.php';

if(isset($_POST['email'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    echo "Name: $name, Email: $email, Password: $password";

    // check that email is not already registered
    $checkEmailQuery = "SELECT * FROM users WHERE email='$email'";
    $checkEmailQuery = $conn->query($checkEmailQuery);
    if($checkEmailQuery->num_rows > 0){
        echo "<script>alert('Email already registered. Please use a different email.');</script>";
    } else {
        $insertQuery = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
        if($conn->query($insertQuery) === TRUE){
          $_SESSION['email'] = $email;
          $_SESSION['name'] = $name;
            echo "<script>alert('Registration successful! You can now login.');</script>";
            header('Location: login.php');
            exit();
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <div class="form-container">
        <h2>Create Account</h2>
        <form action="register.php" method="POST">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>
            <p>Already have an account? <a href="login.php">Login</a></p>
        </form>
    </div>

</body>

</html>