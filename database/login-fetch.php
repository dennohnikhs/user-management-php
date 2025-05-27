<?php

if(isset($_POST['email'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='".$email."' AND password='".$password."'";
    
    $result = mysqli_query($conn,$query);

    $row = mysqli_fetch_assoc($result);

    if($row){
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $row['name'];
        header('Location: index.php');
    }
}