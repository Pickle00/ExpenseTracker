<?php
require_once 'includes/connection.php';
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
}
$income = $_SESSION['income'];
?>

<head>
    <link rel="stylesheet" href="style/income.css" />
</head>
<h1 class="top">Current Income: Rs.<?php echo $income ?></h1>
<main class="income">
    <form action="update_income.php" method="POST" class="add-income">
        <label for="adjustment-amount">Adjustment Amount:</label>
        <input type="number" id="adjustment-amount" name="adjustment_amount" placeholder="Enter amount" required>
        <div class="press">
               <input type="submit" name="operation" class="add" value="Add">
        <input type="submit" name="operation" class="subtract" value="Subtract">
        </div>
     

    </form>


</main>