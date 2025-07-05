<?php
session_start();
if (!isset($_SESSION['donor_name'])) {
    echo "Access denied.";
    exit();
}
$donor_name = $_SESSION['donor_name'];
$date = date("F j, Y");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Donation Certificate - LifeSaver</title>
  <style>
    body {
      font-family: 'Georgia', serif;
      background-color: #fdfdfd;
      padding: 30px;
      margin: 0;
    }

    .certificate {
      border: 10px solid #c82333;
      padding: 40px;
      width: 80%;
      margin: auto;
      background: white;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
      border-radius: 10px;
      text-align: center;
    }

    .certificate h1 {
      font-size: 32px;
      color: #c82333;
      margin-bottom: 5px;
    }

    .certificate h2 {
      font-size: 22px;
      color: #444;
      margin: 5px 0 25px;
    }

    .seal {
      width: 120px;
      height: 120px;
      margin: 10px auto 20px;
    }

    .seal img {
      width: 100%;
      height: 100%;
      object-fit: contain;
    }

    .donor-name {
      font-size: 26px;
      font-weight: bold;
      color: #000;
      margin-top: 20px;
      text-decoration: underline;
    }

    .footer {
      margin-top: 40px;
      display: flex;
      justify-content: space-between;
      padding: 0 40px;
      font-size: 16px;
      color: #555;
    }

    em {
      display: block;
      font-size: 18px;
      margin-top: 25px;
      color: #555;
    }

    .print-btn {
      text-align: center;
      margin-top: 30px;
    }

    .print-btn button {
      background-color: #c82333;
      color: white;
      padding: 10px 20px;
      font-size: 16px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .print-btn button:hover {
      background-color: #a71d2a;
    }

    @media print {
      .print-btn {
        display: none;
      }
    }
  </style>
</head>
<body>

<div class="certificate">
  <h1>Certificate of Appreciation</h1>
  <h2>Presented by LifeSaver</h2>

  <div class="seal">
    <!-- 🩸 Your Blood Image Here -->
    <img src="/blood.jpeg" alt=" ">
    <!-- Replace the above link with your image URL if needed -->
  </div>

  <p>This is to proudly certify that</p>

  <div class="donor-name"><?php echo htmlspecialchars($donor_name); ?></div>

  <p>has made a valuable and selfless blood donation,<br>
     saving lives and inspiring others through their noble act of humanity.</p>

  <em>"The gift of blood is the gift of life."</em>

  <div class="footer">
    <div>Date: <?php echo $date; ?></div>
    <div>Signature: _____________________</div>
  </div>
</div>

<div class="print-btn">
  <button onclick="window.print()">🖨️ Print / Download Certificate</button>
</div>

</body>
</html>
