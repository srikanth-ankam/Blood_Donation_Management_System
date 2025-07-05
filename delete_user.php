<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../admin_login.php");
    exit();
}
include("db_connect.php");

$id = $_GET['id'];
$type = $_GET['type'];

$table = ($type == 'donors') ? 'donors' : 'recipients';
$conn->query("DELETE FROM $table WHERE id=$id");

header("Location: ../admin_manage.php?type=$type");
exit();
?>
