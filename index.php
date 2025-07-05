<?php
if (isset($_GET['request']) && $_GET['request'] == 'success') {
    echo "<p style='color: green; font-weight: bold; text-align: center;'>✅ Blood request submitted successfully!</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>LifeSaver | Blood Donation Management System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #f8f9fa;
      color: #333;
    }
    header {
      background-color: #c82333;
      color: white;
      padding: 20px 0;
      text-align: center;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    header h1 {
      margin: 0;
      font-size: 2rem;
    }
    .container {
      max-width: 800px;
      margin: 40px auto;
      text-align: center;
    }
    .container h2 {
      color: #c82333;
      margin-bottom: 20px;
    }
    .buttons a {
      display: inline-block;
      padding: 15px 25px;
      margin: 10px;
      background-color: #c82333;
      color: white;
      text-decoration: none;
      font-weight: bold;
      border-radius: 8px;
      transition: background-color 0.3s ease;
    }
    .buttons a:hover {
      background-color: #a71929;
    }
    footer {
      margin-top: 60px;
      padding: 20px;
      background: #f1f1f1;
      text-align: center;
      font-size: 0.9rem;
    }
  </style>
</head>
<body>

  <header>
    <h1>LifeSaver</h1>
    <p>Blood Donation Management System</p>
  </header>

  <div class="container">
    <h2>Welcome to LifeSaver</h2>
    <p>Give the gift of life. Become a donor or request blood today.</p>

    <div class="buttons">
      <a href="register_donor.php">🩸 Register as Donor</a>
      <a href="donor_login.php">🔐 Donor Login</a>
      <a href="request_blood.php">📋 Request Blood</a>
      <a href="admin_login.php">🛠 Admin Login</a>
    </div>
  </div>

  <footer>
    &copy; <?php echo date("Y"); ?> LifeSaver | Designed for a better tomorrow ❤️
  </footer>

</body>
</html>
