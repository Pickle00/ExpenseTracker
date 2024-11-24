<?php
require_once 'includes/connection.php';
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
}
$uid = $_SESSION['id'];

$sql = "SELECT DATE_FORMAT(e.date, '%Y-%m') AS month, e.category, SUM(e.amount) AS total_amount 
        FROM expenses e
        WHERE e.uid = $uid 
        GROUP BY month, e.category 
        ORDER BY month DESC, total_amount DESC";

$result = $conn->query($sql);

$monthlyData = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $monthlyData[$row['month']]['categories'][$row['category']] = $row['total_amount'];
        if (!isset($monthlyData[$row['month']]['total_spent'])) {
            $monthlyData[$row['month']]['total_spent'] = 0;
        }
        $monthlyData[$row['month']]['total_spent'] += $row['total_amount'];
    }
}

$sql_income = "SELECT DATE_FORMAT(date, '%Y-%m') AS month, SUM(amount) AS total_income
               FROM income
               WHERE uid = $uid
               GROUP BY month";
$result_income = $conn->query($sql_income);

if ($result_income->num_rows > 0) {
    while ($row_income = $result_income->fetch_assoc()) {
        $monthlyData[$row_income['month']]['total_income'] = $row_income['total_income'];
    }
}

?>

<head>
    <link rel="stylesheet" href="style/report.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<?php foreach ($monthlyData as $month => $data):

    $total_income = isset($data['total_income']) ? $data['total_income'] : 0;
    $total_spent = isset($data['total_spent']) ? $data['total_spent'] : 0;
    $total_savings = $total_income - $total_spent;
?>
    <h2 class="report-title">Report for <?php echo $month ?></h2>
    <div class="report-card">
        <div class="info-data">
            <div class="data">
                <p>Date:</p><br>
                <h3><?= $month ?></h3>
            </div>
            <i class="fa-solid fa-calendar-days"></i>
        </div>
        <div class="info-data">
            <div class="data">
                <p>Total income:</p><br>
                <h3><?= number_format($total_income) ?></h3>
            </div>
            <i class="fa-solid fa-calendar-days"></i>
        </div>
        <div class="info-data">
            <div class="data">
                <p>Total Spent </p><br>
                <h3>Rs. <?= number_format($total_spent) ?></h3>
            </div>
            <i class="fa-solid fa-arrow-up"></i>
        </div>
        <div class="info-data">
            <div class="data">
                <p>Total Savings </p><br>
                <h3>Rs. <?= number_format($total_savings) ?></h3>
            </div>
            <i class="fa-solid fa-piggy-bank"></i>
        </div>

        <div class="history">
            <div class="data-header">
                <div class="name">Category</div>
                <div class="amount">Amount Spent</div>
                <div class="date">Date</div>
            </div>
            <?php foreach ($data['categories'] as $category => $amount): ?>
                <div class="datas">
                    <div class="name"><?= $category ?></div>
                    <div class="amount">Rs. <?= number_format($amount) ?></div>
                    <div class="date"><?= $month ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <hr>
<?php endforeach; ?>