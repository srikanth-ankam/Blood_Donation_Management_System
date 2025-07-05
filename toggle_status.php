<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../admin_login.php");
    exit();
}
include("db_connect.php");

$id = $_POST['id'];
$current = $_POST['current_status'];
$new = ($current === 'Pending') ? 'Donated' : 'Pending';

$conn->query("UPDATE recipients SET status='$new' WHERE id=$id");

header("Location: ../admin_manage.php?type=recipients");
exit();
?>
