<?php
include("php/db_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name     = $_POST["name"];
    $email    = $_POST["email"];
    $password = $_POST["password"];
    $blood_group_needed = $_POST["blood_group"];
    $location = $_POST["location"];
    $phone    = $_POST["phone"];
    $hospital = $_POST["hospital"];
    $reason   = $_POST["reason"];

    // Hashing password (security)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO recipients 
            (name, email, password, blood_group_needed, location, phone, hospital, reason)
            VALUES 
            ('$name', '$email', '$hashed_password', '$blood_group_needed', '$location', '$phone', '$hospital', '$reason')";

    if ($conn->query($sql) === TRUE) {
        // Notify donors
        require_once("php/mailer.php");

        $donors = $conn->query("SELECT * FROM donors WHERE blood_group = '$blood_group_needed' AND location = '$location'");

        while ($donor = $donors->fetch_assoc()) {
            $to = $donor['email'];
            $subject = "🚨 Blood Request Alert - LifeSaver";
            $body = "
                <h3>New Blood Request Alert</h3>
                <p><strong>Recipient Name:</strong> $name</p>
                <p><strong>Blood Group Needed:</strong> $blood_group_needed</p>
                <p><strong>Hospital:</strong> $hospital</p>
                <p><strong>Reason:</strong> $reason</p>
                <p><strong>Phone:</strong> $phone</p>
                <p><strong>Location:</strong> $location</p>
                <hr>
                <p>Please consider responding in your LifeSaver donor dashboard.</p>
            ";
            sendMail($to, $subject, $body);
        }

        // Redirect to home after request
        header("Location: index.php?request=success");
        exit();
    } else {
        $msg = "❌ Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Request Blood - LifeSaver</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f2f2f2;
      padding: 30px;
    }
    .container {
      max-width: 600px;
      margin: auto;
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      color: #c82333;
    }
    input, select, textarea {
      width: 100%;
      padding: 10px;
      margin: 10px 0 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    textarea {
      resize: vertical;
    }
    input[type="submit"] {
      background-color: #c82333;
      color: white;
      cursor: pointer;
      border: none;
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
    <h2>Blood Request Form</h2>
    <?php if (isset($msg)): ?><p class="msg"><?php echo $msg; ?></p><?php endif; ?>

    <form method="post">
      <label>Full Name:</label>
      <input type="text" name="name" required>

      <label>Email:</label>
      <input type="email" name="email" required>

      <label>Password:</label>
      <input type="password" name="password" required>

      <label>Blood Group Needed:</label>
      <select name="blood_group" required>
        <option value="">--Select--</option>
        <option>A+</option><option>B+</option><option>O+</option><option>AB+</option>
        <option>A-</option><option>B-</option><option>O-</option><option>AB-</option>
      </select>

      <label>Location:</label>
      <input type="text" name="location" required>

      <label>Phone:</label>
      <input type="text" name="phone" required>

      <label>Hospital Name:</label>
      <input type="text" name="hospital" required>

      <label>Reason for Request:</label>
      <textarea name="reason" rows="4" required></textarea>

      <input type="submit" value="Request Blood">
    </form>
  </div>
</body>
</html>
