<?php
session_start();
include("db_connect.php");

if (!isset($_SESSION['donor_id']) || !isset($_POST['recipient_id'])) {
    die("Unauthorized access.");
}

$donor_id = $_SESSION['donor_id'];
$recipient_id = $_POST['recipient_id'];

// Insert into requests table
$sql = "INSERT INTO requests (recipient_id, donor_id, status) VALUES ('$recipient_id', '$donor_id', 'Donated')";
$conn->query($sql);

// Also update recipient request status
//$conn->query("UPDATE recipients SET status = 'Donated' WHERE id = '$recipient_id'");
// Update status
$conn->query("UPDATE recipients SET status = 'Fulfilled' WHERE id = $recipient_id");

// Redirect back to donor dashboard with thank-you flag
header("Location: ../donor_dashboard.php?thankyou=1");
exit();

// Redirect back
//header("Location: ../donor_dashboard.php?msg=donated");
//exit();
?>
