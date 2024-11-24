<?php

require_once 'connection.php';

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    echo "User already exists";
} else {
    $insertquery = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

    if (mysqli_query($conn, $insertquery)) {
        echo '<script>alert("Account Successfully Created");</script>';
        header("Location: ../login.php");
    }
}
