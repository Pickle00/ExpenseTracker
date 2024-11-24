<?php
session_start();
$_SESSION['date'];
if (isset($_POST['month'])) {
    $_SESSION['date'] = 'Month';
} elseif (isset($_POST['week'])) {
    $_SESSION['date'] = 'Week';
} elseif (isset($_POST['day']) ) {  // Ensure this is 'Day'
    $_SESSION['date'] = 'Day';
} else {
    $_SESSION['date'] = 'Day';  // Default to 'Day' if no valid input is given
}

Header("Location: index.php?page=dashboard");
