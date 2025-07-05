<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}
include("php/db_connect.php");

// Default: all records
$from = $_GET['from'] ?? '';
$to = $_GET['to'] ?? '';

$sql = "SELECT d.name AS donor_name, d.blood_group, r.name AS recipient_name, r.hospital, rq.donation_date
        FROM requests rq
        JOIN donors d ON rq.donor_id = d.id
        JOIN recipients r ON rq.recipient_id = r.id";

if ($from && $to) {
    $sql .= " WHERE DATE(rq.donation_date) BETWEEN '$from' AND '$to'";
}

$sql .= " ORDER BY rq.donation_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin | Donations by Date</title>
  <style>
    body { font-family: 'Segoe UI', sans-serif; background: #f8f8f8; padding: 30px; }
    h2 { color: #c82333; }
    form { margin-bottom: 20px; }
    input[type="date"] { padding: 8px; margin-right: 10px; }
    table {
      width: 100%; border-collapse: collapse; background: white;
      box-shadow: 0 0 5px rgba(0,0,0,0.05);
    }
    th, td { padding: 10px; border: 1px solid #ddd; text-align: center; }
    th { background-color: #c82333; color: white; }
  </style>
<p>
  <a href="php/export_donations.php" style="padding: 10px 20px; background: #28a745; color: white; text-decoration: none; border-radius: 5px;">
    📥 Export Donations to Excel
  </a>
</p>

</head>
<body>

<h2>📅 Filter Donations by Date</h2>

<form method="GET">
  From: <input type="date" name="from" value="<?php echo $from; ?>">
  To: <input type="date" name="to" value="<?php echo $to; ?>">
  <input type="submit" value="Filter">
</form>

<table>
  <tr>
    <th>Donor</th>
    <th>Blood Group</th>
    <th>Recipient</th>
    <th>Hospital</th>
    <th>Donation Date</th>
  </tr>
  <?php if ($result->num_rows > 0): ?>
    <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?php echo $row['donor_name']; ?></td>
        <td><?php echo $row['blood_group']; ?></td>
        <td><?php echo $row['recipient_name']; ?></td>
        <td><?php echo $row['hospital']; ?></td>
        <td><?php echo $row['donation_date']; ?></td>
      </tr>
    <?php endwhile; ?>
  <?php else: ?>
    <tr><td colspan="5">No donations found in selected range.</td></tr>
  <?php endif; ?>
</table>

</body>
</html>
