<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}
include("php/db_connect.php");

// Set defaults
$type = $_GET['type'] ?? 'donors';
$keyword = $_GET['keyword'] ?? '';
$blood = $_GET['blood'] ?? '';
$location = $_GET['location'] ?? '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

// Build base query
$table = $type == 'donors' ? 'donors' : 'recipients';
$where = "WHERE 1=1";
if ($keyword)  $where .= " AND name LIKE '%$keyword%'";
if ($blood)    $where .= " AND " . ($type == 'donors' ? 'blood_group' : 'blood_group_needed') . " = '$blood'";
if ($location) $where .= " AND location LIKE '%$location%'";

// Get total rows for pagination
$countQuery = $conn->query("SELECT COUNT(*) AS total FROM $table $where");
$totalRows = $countQuery->fetch_assoc()['total'];
$totalPages = ceil($totalRows / $limit);

// Fetch paginated records
$sql = "SELECT * FROM $table $where LIMIT $limit OFFSET $offset";
$data = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin | Manage Users</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f8f8f8;
      padding: 30px;
    }
    h2 {
      color: #c82333;
    }
    .filter-box {
      background: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 5px rgba(0,0,0,0.1);
      margin-bottom: 20px;
    }
    input, select, button {
      padding: 8px;
      margin-right: 10px;
      margin-bottom: 10px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      box-shadow: 0 0 5px rgba(0,0,0,0.05);
    }
    th, td {
      padding: 10px;
      border: 1px solid #ddd;
      text-align: center;
    }
    th {
      background-color: #c82333;
      color: white;
    }
    .pagination {
      margin-top: 20px;
      text-align: center;
    }
    .pagination a {
      padding: 8px 12px;
      margin: 2px;
      background-color: #eee;
      color: #000;
      text-decoration: none;
      border-radius: 4px;
    }
    .pagination a.active {
      background-color: #c82333;
      color: white;
    }
    .status-btn {
      background: none;
      border: none;
      font-weight: bold;
      cursor: pointer;
      color: #007bff;
    }
  </style>
</head>
<body>

<h2>🔍 Admin Search & Filter - <?php echo ucfirst($type); ?></h2>

<div class="filter-box">
  <form method="GET">
    <input type="hidden" name="type" value="<?php echo $type; ?>">
    <input type="text" name="keyword" placeholder="Search by name..." value="<?php echo $keyword; ?>">
    <input type="text" name="location" placeholder="Search by location..." value="<?php echo $location; ?>">
    <select name="blood">
      <option value="">All Blood Groups</option>
      <?php
      $groups = ['A+', 'B+', 'O+', 'AB+', 'A-', 'B-', 'O-', 'AB-'];
      foreach ($groups as $g) {
          $selected = ($blood == $g) ? 'selected' : '';
          echo "<option value='$g' $selected>$g</option>";
      }
      ?>
    </select>
    <button type="submit">🔎 Search</button>
    <a href="admin_manage.php?type=donors">View Donors</a> |
    <a href="admin_manage.php?type=recipients">View Recipients</a>
  </form>
</div>

<table>
  <tr>
    <?php if ($type == 'donors'): ?>
      <th>ID</th><th>Name</th><th>Blood Group</th><th>Email</th><th>Location</th><th>Phone</th><th>Action</th>
    <?php else: ?>
      <th>ID</th><th>Name</th><th>Blood Group Needed</th><th>Email</th><th>Location</th><th>Hospital</th><th>Status</th><th>Action</th>
    <?php endif; ?>
  </tr>

  <?php if ($data->num_rows > 0): ?>
    <?php while ($row = $data->fetch_assoc()): ?>
      <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $type == 'donors' ? $row['blood_group'] : $row['blood_group_needed']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td><?php echo $row['location']; ?></td>
        <?php if ($type == 'donors'): ?>
          <td><?php echo $row['phone']; ?></td>
        <?php else: ?>
          <td><?php echo $row['hospital']; ?></td>
          <td>
            <form action="php/toggle_status.php" method="POST" style="margin: 0;">
              <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
              <input type="hidden" name="current_status" value="<?php echo $row['status']; ?>">
              <button class="status-btn" type="submit" style="color: <?php echo $row['status'] === 'Donated' ? 'green' : 'orange'; ?>">
                <?php echo $row['status']; ?>
              </button>
            </form>
          </td>
        <?php endif; ?>
        <td>
          <a href="admin_edit_user.php?id=<?php echo $row['id']; ?>&type=<?php echo $type; ?>">✏️ Edit</a> |
          <a href="php/delete_user.php?id=<?php echo $row['id']; ?>&type=<?php echo $type; ?>" onclick="return confirm('Are you sure to delete?')">❌ Delete</a>
        </td>
      </tr>
    <?php endwhile; ?>
  <?php else: ?>
    <tr><td colspan="<?php echo $type == 'donors' ? 7 : 8; ?>">No records found</td></tr>
  <?php endif; ?>
</table>

<?php if ($totalPages > 1): ?>
  <div class="pagination">
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
      <a href="?type=<?php echo $type; ?>&keyword=<?php echo $keyword; ?>&blood=<?php echo $blood; ?>&location=<?php echo $location; ?>&page=<?php echo $i; ?>"
         class="<?php echo ($i == $page) ? 'active' : ''; ?>">
         <?php echo $i; ?>
      </a>
    <?php endfor; ?>
  </div>
<?php endif; ?>

</body>
</html>
