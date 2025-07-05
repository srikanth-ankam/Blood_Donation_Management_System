<?php
$host = "sql212.infinityfree.com";        // Change if you're on InfinityFree
$user = "if0_39392236";             // Change to your DB user
$pass = "hRHmhTsp7VG";                 // Change to your DB password
$db = "if0_39392236_blood_donation";     // Change to your DB name

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
