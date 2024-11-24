<?php
require_once 'includes/connection.php';
session_start();


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="style/style.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
    rel="stylesheet" />
</head>

<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <h2>Welcome <?php echo $_SESSION['user']?></h2>
    <ul>
      <a href="index.php?page=dashboard" style="text-decoration: none">
        <li><i class="fas fa-tachometer-alt"></i>&nbsp;Dashboard</li>
      </a>
      <a href="index.php?page=income" style="text-decoration: none">
        <li><i class="fas fa-check-circle"></i>&nbsp;Income</li>
      </a>
      <a href="index.php?page=report" style="text-decoration: none">
        <li>
          <i class="fa-regular fa-file-lines"></i>&nbsp;Report
        </li>
      </a>

      <li>
        <a href="logout.php" style="text-decoration: none"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a>
      </li>
    </ul>
  </div>

  <!-- Content Area -->
  <div class="content">


    <?php
    // Handle page selection and load the appropriate content
    if (isset($_GET['page'])) {
      $page = $_GET['page'];

      // Load corresponding page based on the query parameter
      switch ($page) {
        case 'dashboard':

          include 'dashboard.php';
          break;
        case 'income':
          include 'income.php';
          break;
        case 'report':
          include 'report.php';
          break;
        case 'logout':
          include 'logout.php';
          break;
        default:
          include 'dashboard.php';
      }
    } else {
      include 'dashboard.php';
    }
    ?>
  </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  function toggleSubList(icon) {
    const subList = icon.nextElementSibling; // Get the next sibling (sub-list)

    // Toggle the display property
    if (subList.style.display === "block") {
      subList.style.display = "none";
      icon.classList.remove("fa-chevron-up"); // Change icon if needed
      icon.classList.add("fa-chevron-down");
    } else {
      subList.style.display = "block";
      icon.classList.remove("fa-chevron-down"); // Change icon if needed
      icon.classList.add("fa-chevron-up");
    }
  }
</script>

</html>