<?php
session_start();
include("db_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM admins WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION["admin"] = $username;
        header("Location: ../admin_dashboard.php");
    } else {
        echo "<script>alert('Invalid admin credentials'); window.location.href = '../admin_login.php';</script>";
    }
}
?>
