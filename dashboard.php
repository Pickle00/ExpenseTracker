<?php
require_once 'includes/connection.php';
if (!isset($_SESSION['id'])) {
  header("Location: login.php");
}

$totalspend = 0;
$totalincome = $_SESSION['income'];
$savings = 0;
$sql;
$uid = $_SESSION['id'];

if (isset($_SESSION['date']) && $_SESSION['date'] == 'Month') {
  $sql = "SELECT * 
          FROM expenses 
          WHERE category IN (
              SELECT DISTINCT category 
              FROM expenses 
              WHERE MONTH(date) = MONTH(CURDATE()) 
              AND YEAR(date) = YEAR(CURDATE())
              AND uid = $uid
          ) 
          AND MONTH(date) = MONTH(CURDATE()) 
          AND YEAR(date) = YEAR(CURDATE())
          AND uid = $uid";
} elseif (isset($_SESSION['date']) && $_SESSION['date'] == 'Week') {
  $sql = "SELECT * 
          FROM expenses 
          WHERE category IN (
              SELECT DISTINCT category 
              FROM expenses 
              WHERE WEEK(date, 1) = WEEK(CURDATE(), 1) 
              AND YEAR(date) = YEAR(CURDATE())
              AND uid = $uid
          ) 
          AND WEEK(date, 1) = WEEK(CURDATE(), 1) 
          AND YEAR(date) = YEAR(CURDATE())
          AND uid = $uid";
} else {
  $sql = "SELECT * 
          FROM expenses 
          WHERE category IN (
              SELECT DISTINCT category 
              FROM expenses 
              WHERE date = CURDATE()
              AND uid = $uid
          ) 
          AND date = CURDATE()
          AND uid = $uid";
}



$result = $conn->query($sql);

$data = [];
$chartdata = [];

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $data[] = $row;
    $totalspend += $row['amount'];
  }
}

function bubbleSortDescending(&$array)
{
  $n = count($array);
  for ($i = 0; $i < $n; $i++) {
    for ($j = 0; $j < $n - $i - 1; $j++) {
      if ($array[$j]['amount'] < $array[$j + 1]['amount']) {
        $temp = $array[$j];
        $array[$j] = $array[$j + 1];
        $array[$j + 1] = $temp;
      }
    }
  }
}

bubbleSortDescending($data);

$groupedData = [];
$totals = [];
$categoryNames = [];

foreach ($data as $row) {
  $groupedData[$row['category']][] = $row;
  if (!isset($totals[$row['category']])) {
    $totals[$row['category']] = 0;
    $categoryNames[] = $row['category'];
  }
  $totals[$row['category']] += $row['amount'];
}
?>

<head>
  <link rel="stylesheet" href="style/dashboard.css" />
</head>
<div class="nav-bar">
  <form action="date.php" method="post">
    <ul>
      <li class="month"><input type="submit" value="Month" name="month"></li>
      <li class="month"><input type="submit" value="Week" name="week"></li>
      <li class="month"><input type="submit" value="Day" name="day"></li>
    </ul>
  </form>
</div>
<h3 class="top">Expenses of <?php echo $_SESSION['date'] ?></h3>
<main class="view-data">
  <div class="expense-card">
    <div class="data">
      <p>Total Income</p><br>
      <h3>Rs. <?php echo number_format($_SESSION['income']); ?></h3>
      <?php if ($_SESSION['income'] == 0): ?>
        <p><a href="income.php" style="text-decoration: none; color: black;">Add Income</a></p>
      <?php endif; ?>
    </div>

    <i class="fa-solid fa-arrow-down"></i>
  </div>
  <div class="expense-card">
    <div class="data">
      <p>Total Spent</p><br>
      <h3>Rs. <?php echo number_format($totalspend); ?></h3>
    </div>
    <i class="fa-solid fa-arrow-up"></i>
  </div>
  <div class="expense-card">
    <div class="data">
      <p>Total Savings</p><br>
      <h3><?php echo number_format($totalincome - $totalspend); ?></h3>
    </div>
    <i class="fa-solid fa-piggy-bank"></i>
  </div>
  <div class="chart">
    <p>Expense Piechart</p>
    <canvas id="expenseChart"></canvas>
  </div>

  <div class="listofCategory">
    <p>List of Categories</p>
    <ul class="categories">
      <?php foreach ($categoryNames as $categoryName): ?>
        <li><?php echo $categoryName; ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
</main>

<div class="expense-info">
  <div class="your-expenses">
    <p class="title">Your Expenses</p>
    <ul class="cata">
      <?php foreach ($groupedData as $category => $expenses): ?>
        <li class="cata-li">
          <div class="category">
            <div class="category-data"><label><?php echo ($category); ?></label><label>Rs:<?php echo ($totals[$category]); ?></label></div>
            <i class="fa-solid fa-chevron-down"></i>
          </div>
          <ul class="nested-list">
            <?php foreach ($expenses as $expense): ?>
              <li>
                <div class="note">
                  <div>
                    <label>
                      <?php echo $expense['note']; ?>
                    </label>
                    <label>
                      Rs:<?php echo $expense['amount']; ?>
                    </label>
                  </div>

                  <a href="deleteexpense.php?eid=<?php echo $expense['eid'] ?>"><i class="fa-solid fa-trash"></i></a>
                </div>
              </li>
            <?php endforeach; ?>
          </ul>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>

  <div class="add-expense">
    <form action="addexpense.php" method="POST">
      <label for="expense-category">Select Expense Category:</label>
      <select id="expense-category" name="category">
        <option value="Transport">Transport</option>
        <option value="Food">Food</option>
        <option value="Utilities">Utilities</option>
        <option value="Entertainment">Entertainment</option>
        <option value="Healthcare">Healthcare</option>
        <option value="Other">Other</option>
        <option value="Clothing">Clothing</option>
        <option value="Education">Education</option>
        <option value="Gifts">Gifts</option>
        <option value="Subscriptions">Subscriptions</option>

      </select>

      <label for="expense-amount">Amount:</label>
      <input type="number" id="expense-amount" name="amount" placeholder="eg: 5000" min="0" required />

      <label for="expense-note">Extra Note:</label>
      <input type="text" id="expense-note" name="note" placeholder="Add a note" required />

      <input type="submit" name="add-expense" class="add" id="submit-expense" value="Add Expense" />
    </form>
  </div>
</div>

<script>
  document.querySelectorAll('.your-expenses > ul > li').forEach(item => {
    item.addEventListener('click', (event) => {
      event.stopPropagation();
      const nestedList = item.querySelector('.nested-list');
      if (nestedList) {
        nestedList.style.display = nestedList.style.display === 'block' ? 'none' : 'block';
      }
    });
  });

  var categoryNames = <?php echo json_encode($categoryNames); ?>;
  var categoryTotals = <?php echo json_encode(array_values($totals)); ?>;

  console.log(categoryNames, categoryTotals);
  document.addEventListener("DOMContentLoaded", function() {
    var ctx = document.getElementById("expenseChart").getContext("2d");
    var expenseChart = new Chart(ctx, {
      type: "doughnut",
      data: {
        labels: categoryNames,
        datasets: [{
          label: 'Rs',
          data: categoryTotals,
          backgroundColor: [
            'rgb(255, 102, 102)',
            'rgb(102, 255, 102)',
            'rgb(102, 204, 255)',
            'rgb(255, 255, 102)',
            'rgb(102, 255, 255)',
            'rgb(255, 102, 255)',
            'rgb(255, 178, 102)',
            'rgb(255, 153, 204)',
            'rgb(178, 102, 255)',
            'rgb(102, 255, 204)',
            'rgb(255, 128, 128)',
            'rgb(178, 255, 178)',
            'rgb(255, 218, 185)',
            'rgb(230, 204, 255)',
            'rgb(255, 239, 102)'
          ],
          hoverOffset: 10
        }],
      },
      options: {
        maintainAspectRatio: false,
        responsive: true,
        plugins: {
          legend: {
            position: "left",
            onClick: function(event, legendItem) {

              event.stopPropagation();
            },
          },

        },
        // animation: {
        //   duration: 2000,
        //   easing: 'easeInQuad',
        // },
      },
    });
  });
</script>