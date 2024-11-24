<?php

require_once 'includes/connection.php';
$eid = $_GET['eid'];

$delete = "DELETE FROM expenses WHERE eid='$eid'";
if (mysqli_query($conn, $delete)) {
    echo "<script>alert('Product deleted Successfully');</script>";
}
Header("Location: index.php?page=dashboard");
?>