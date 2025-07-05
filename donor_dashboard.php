<?php
session_start();
if (!isset($_SESSION['donor_id'])) {
    header("Location: donor_login.php");
    exit();
}

include("php/db_connect.php");

$donor_name = $_SESSION['donor_name'];
$blood_group = $_SESSION['blood_group'];
$location = $_SESSION['location'];

$sql = "SELECT * FROM recipients WHERE blood_group_needed = '$blood_group' AND location = '$location' AND status = 'Pending'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Donor Dashboard - LifeSaver</title>
  <link href="https://fonts.googleapis.com/css2?family=Segoe+UI&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #fdfbfb, #ebedee);
      margin: 0;
      padding: 20px;
    }

    .container {
      max-width: 1000px;
      margin: auto;
      padding: 20px;
      background-color: white;
      border-radius: 12px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.15);
    }

    .logout {
      text-align: right;
    }

    .logout a {
      color: #c82333;
      font-weight: bold;
      text-decoration: none;
    }

    h2 {
      color: #c82333;
      margin-bottom: 5px;
    }

    h3 {
      color: #333;
      margin-top: 5px;
    }

    .message {
      background-color: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
      padding: 15px;
      border-radius: 8px;
      margin-bottom: 20px;
      font-size: 16px;
      animation: fadeIn 1s ease-in-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: #fff;
      margin-top: 20px;
    }

    th, td {
      padding: 14px 12px;
      border-bottom: 1px solid #e0e0e0;
      text-align: left;
    }

    th {
      background-color: #c82333;
      color: white;
    }

    tr:hover {
      background-color: #f9f9f9;
    }

    .donate-btn {
      background-color: #28a745;
      color: white;
      padding: 8px 18px;
      border: none;
      border-radius: 5px;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s;
    }

    .donate-btn:hover {
      background-color: #218838;
    }

    .certificate-link {
      text-align: center;
      margin-top: 30px;
    }

    .certificate-link a {
      background-color: #007bff;
      color: white;
      padding: 12px 25px;
      border-radius: 5px;
      text-decoration: none;
      font-weight: bold;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .certificate-link a:hover {
      background-color: #0056b3;
    }

    .no-requests {
      margin-top: 20px;
      font-style: italic;
      color: #777;
    }
  </style>
</head>
<body>

<div class="container">

  <div class="logout">
    <a href="php/logout_donor.php">Logout</a>
  </div>

  <?php if (isset($_GET['thankyou']) && $_GET['thankyou'] == '1'): ?>
    <div class="message">
      ✅ <strong>Thank you for your life-saving donation, <?php echo $donor_name; ?>!</strong> Your kindness is someone’s hope. ❤️
    </div>
  <?php endif; ?>

  <h2>Welcome, <?php echo $donor_name; ?>!</h2>
  <h3>Matching Blood Requests</h3>

  <?php if ($result->num_rows > 0): ?>
    <table>
      <tr>
        <th>Recipient</th>
        <th>Hospital</th>
        <th>Reason</th>
        <th>Phone</th>
        <th>Action</th>
      </tr>
      <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?php echo $row['name']; ?></td>
          <td><?php echo $row['hospital']; ?></td>
          <td><?php echo $row['reason']; ?></td>
          <td><?php echo $row['phone']; ?></td>
          <td>
            <form action="php/process_donation.php" method="POST">
              <input type="hidden" name="recipient_id" value="<?php echo $row['id']; ?>">
              <input type="submit" value="Donate" class="donate-btn">
            </form>
          </td>
        </tr>
      <?php endwhile; ?>
    </table>
  <?php else: ?>
    <p class="no-requests">No matching blood requests found.</p>
  <?php endif; ?>

  <div class="certificate-link">
    <a href="php/certificate.php">📄 Download Donation Certificate</a>
  </div>
</div>

</body>
</html>
