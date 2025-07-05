<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}
include("php/db_connect.php");

$success = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $current = $_POST['current'];
    $new = $_POST['new'];
    $confirm = $_POST['confirm'];

    $result = $conn->query("SELECT * FROM admins WHERE username='admin'");
    $admin = $result->fetch_assoc();

    if ($current !== $admin['password']) {
        $error = "❌ Current password is incorrect.";
    } elseif ($new !== $confirm) {
        $error = "❌ New passwords do not match.";
    } else {
        $conn->query("UPDATE admins SET password='$new' WHERE username='admin'");
        $success = "✅ Password updated successfully!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Change Admin Password</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f5f5f5;
      padding: 40px;
    }
    form {
      max-width: 400px;
      margin: auto;
      background: #fff;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
    }
    input {
      width: 100%;
      padding: 10px;
      margin-top: 12px;
      border: 1px solid #ccc;
      border-radius: 6px;
    }
    button {
      width: 100%;
      padding: 10px;
      margin-top: 20px;
      background-color: #c82333;
      color: #fff;
      border: none;
      border-radius: 6px;
      font-weight: bold;
    }
    .success {
      color: green;
      margin-top: 10px;
    }
    .error {
      color: red;
      margin-top: 10px;
    }
  </style>
</head>
<body>

  <h2 style="text-align:center; color:#c82333;">🔐 Change Admin Password</h2>

  <form method="POST">
    <input type="password" name="current" placeholder="Current Password" required>
    <input type="password" name="new" placeholder="New Password" required>
    <input type="password" name="confirm" placeholder="Confirm New Password" required>
    <button type="submit">Update Password</button>

    <?php if ($success) echo "<p class='success'>$success</p>"; ?>
    <?php if ($error) echo "<p class='error'>$error</p>"; ?>
  </form>

</body>
</html>
