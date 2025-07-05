<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}
include("php/db_connect.php");

// Fetch stats
$donors = $conn->query("SELECT COUNT(*) AS total FROM donors")->fetch_assoc()['total'];
$recipients = $conn->query("SELECT COUNT(*) AS total FROM recipients")->fetch_assoc()['total'];
$pending = $conn->query("SELECT COUNT(*) AS total FROM recipients WHERE status='Pending'")->fetch_assoc()['total'];
$donated = $conn->query("SELECT COUNT(*) AS total FROM requests")->fetch_assoc()['total'];

// Fetch donor count by blood group
$groupStats = $conn->query("SELECT blood_group, COUNT(*) AS total FROM donors GROUP BY blood_group");
$dataRows = [];
while ($row = $groupStats->fetch_assoc()) {
    $dataRows[] = "['{$row['blood_group']}', {$row['total']}]";
}
$chartData = implode(",", $dataRows);

// Fetch monthly donation chart data
$monthlyQuery = "
  SELECT DATE_FORMAT(donation_date, '%Y-%m') AS month, COUNT(*) AS total
  FROM requests
  GROUP BY month
  ORDER BY month ASC
";
$monthlyData = $conn->query($monthlyQuery);
$barChartData = "";
while ($row = $monthlyData->fetch_assoc()) {
    $monthLabel = date('M Y', strtotime($row['month']));
    $barChartData .= "['$monthLabel', {$row['total']}],";
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard - LifeSaver</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f0f0f0;
      padding: 40px;
    }
    h2 {
      color: #c82333;
    }
    .card {
      background: white;
      padding: 20px;
      margin: 20px 0;
      border-radius: 10px;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
    }
    .stats {
      display: flex;
      gap: 20px;
      flex-wrap: wrap;
    }
    .stat-box {
      flex: 1;
      min-width: 200px;
      background-color: #fff;
      border-left: 5px solid #c82333;
      padding: 20px;
      border-radius: 6px;
      box-shadow: 0 0 5px rgba(0,0,0,0.1);
    }
    .stat-box span {
      display: block;
      font-size: 28px;
      font-weight: bold;
      color: #c82333;
    }
    a {
      color: #c82333;
      text-decoration: none;
      font-weight: bold;
    }
    #piechart, #monthly_chart {
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      margin-top: 30px;
      box-shadow: 0 0 5px rgba(0,0,0,0.1);
    }
  </style>

  <!-- Google Chart Script -->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

  <script>
    // Load Pie Chart
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawPieChart);

    function drawPieChart() {
      var data = google.visualization.arrayToDataTable([
        ['Blood Group', 'Number of Donors'],
        <?php echo $chartData; ?>
      ]);

      var options = {
        title: 'Blood Group Distribution among Donors',
        is3D: true,
        width: '100%',
        height: 400
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechart'));
      chart.draw(data, options);
    }

    // Load Bar Chart
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawBarChart);

    function drawBarChart() {
      var data = google.visualization.arrayToDataTable([
        ['Month', 'Donations'],
        <?php echo $barChartData; ?>
      ]);

      var options = {
        chart: {
          title: 'Monthly Blood Donations',
          subtitle: 'Total donations per month',
        },
        bars: 'vertical',
        height: 400,
        colors: ['#c82333']
      };

      var chart = new google.charts.Bar(document.getElementById('monthly_chart'));
      chart.draw(data, google.charts.Bar.convertOptions(options));
    }
  </script>
</head>
<body>

  <p style="text-align:right;">
    <a href="php/logout_admin.php">Logout</a>
  </p>

  <h2>Welcome, Admin!</h2>

  <div class="stats">
    <div class="stat-box">
      <h3>Total Donors</h3>
      <span><?php echo $donors; ?></span>
    </div>
    <div class="stat-box">
      <h3>Total Recipients</h3>
      <span><?php echo $recipients; ?></span>
    </div>
    <div class="stat-box">
      <h3>Pending Requests</h3>
      <span><?php echo $pending; ?></span>
    </div>
    <div class="stat-box">
      <h3>Donations Made</h3>
      <span><?php echo $donated; ?></span>
    </div>
  </div>

  <p><a href="admin_manage.php?type=donors">🔍 Manage Donors & Recipients</a></p>
  <p><a href="admin_donations.php">📅 View Donations by Date</a></p>
  <p><a href="php/export_donations.php">📥 Export Donations to Excel</a></p>
  <p><a href="admin_change_password.php" style="color:#c82333;">🔐 Change Password</a></p>


  <div id="piechart"></div>
  <div id="monthly_chart"></div>

</body>
</html>
