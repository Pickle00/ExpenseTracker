<?php
require_once 'includes/connection.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (isset($_POST['add-expense'])) {
 
    $uid = "1"; /* Get user ID from session or other source */;
    $category = $_POST['category'];
    $amount = $_POST['amount'];
    $date = date("Y-m-d");
    $note = $_POST['note'];

    $query = "INSERT INTO expenses (uid, category, amount, date, note) VALUES ('$uid', '$category', '$amount', '$date', '$note')";

    if (mysqli_query($conn, $query)) {
        header("Location: index.php?page=dashboard");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
}