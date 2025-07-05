<?php
include("php/db_connect.php");

$msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $blood_group = $_POST['blood_group'];
    $location = $_POST['location'];
    $phone = $_POST['phone'];

    $sql = "INSERT INTO donors (name, email, password, blood_group, location, phone)
            VALUES ('$name', '$email', '$pass', '$blood_group', '$location', '$phone')";

    if ($conn->query($sql) === TRUE) {
        $msg = "✅ Donor registered successfully!";
    } else {
        $msg = "❌ Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Donor Registration - LifeSaver</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f8f9fa;
      padding: 30px;
    }
    .container {
      max-width: 500px;
      margin: auto;
      background: white;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      padding: 30px;
    }
    h2 {
      text-align: center;
      color: #c82333;
    }
    input, select {
      width: 100%;
      padding: 10px;
      margin: 8px 0 15px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    input[type="submit"] {
      background-color: #c82333;
      color: white;
      border: none;
      cursor: pointer;
    }
    input[type="submit"]:hover {
      background-color: #a71d2a;
    }
    .msg {
      text-align: center;
      font-weight: bold;
      color: green;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Donor Registration</h2>
    <?php if ($msg): ?><p class="msg"><?php echo $msg; ?></p><?php endif; ?>
    <form method="post">
      <label>Full Name:</label>
      <input type="text" name="name" required>

      <label>Email:</label>
      <input type="email" name="email" required>

      <label>Password:</label>
      <input type="password" name="password" required>

      <label>Blood Group:</label>
      <select name="blood_group" required>
        <option value="">--Select--</option>
        <option value="A+">A+</option>
        <option value="B+">B+</option>
        <option value="O+">O+</option>
        <option value="AB+">AB+</option>
      </select>

      <label>Location:</label>
      <input type="text" name="location" required>

      <label>Phone:</label>
      <input type="text" name="phone" required>

      <input type="submit" value="Register">
    </form>
  </div>
</body>
</html>
