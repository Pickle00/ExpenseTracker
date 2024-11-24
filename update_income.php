<?php
session_start();
require_once 'includes/connection.php';

if (!isset($_SESSION['income'])) {
    $_SESSION['income'] = 0;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $adjustmentAmount = $_POST['adjustment_amount'];
    $operation = $_POST['operation'];


    $currentIncome = $_SESSION['income'];

    if ($operation === 'Add') {
        $newIncome = $currentIncome + $adjustmentAmount;
    } elseif ($operation === 'Subtract') {
        $newIncome = $currentIncome - $adjustmentAmount;
        if ($newIncome < 0) {
            echo "Income cannot be negative.";
            exit;
        }
    } else {
        die("Invalid operation.");
    }

    // Update session income


    $uid = $_SESSION['id'];

    // Update the income in the database for the current month
    $sql = "UPDATE income 
            SET amount = $newIncome 
            WHERE uid = $uid 
            AND MONTH(date) = MONTH(CURDATE()) 
            AND YEAR(date) = YEAR(CURDATE())";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['income'] = $newIncome;
        Header("Location: index.php?page=income");
    }
}
