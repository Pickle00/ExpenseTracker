<?php
session_start();
require_once 'connection.php';

$email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $uid = $row['uid'];
    $_SESSION['id'] = $row['uid'];
    $_SESSION['user'] = $row['username'];

    $income = "SELECT SUM(amount) AS total_income FROM income WHERE uid = $uid AND MONTH(date) = MONTH(CURDATE()) AND YEAR(date) = YEAR(CURDATE());";
    $res = mysqli_query($conn, $income);
    if (mysqli_num_rows($res) > 0) {
        $income_row = mysqli_fetch_assoc($res);
        $_SESSION['income'] = $income_row['total_income'];
        $_SESSION['date'] = 'Day';
    } else {
        $_SESSION['income'] = 0;
    }

    header("Location: ../index.php");
    exit();
} else {
    echo "<script>alert('Login Failed');</script>";
    header("Location: ../login.php");
    exit();
}
