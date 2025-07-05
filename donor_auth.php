<?php
include("db_connect.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM donors WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $donor = $result->fetch_assoc();
        $_SESSION['donor_id'] = $donor['id'];
        $_SESSION['donor_name'] = $donor['name'];
        $_SESSION['blood_group'] = $donor['blood_group'];
        $_SESSION['location'] = $donor['location'];
        header("Location: ../donor_dashboard.php");
        exit();
    } else {
        echo "<script>alert('Invalid email or password'); window.location.href = '../donor_login.php';</script>";
    }
}
?>
