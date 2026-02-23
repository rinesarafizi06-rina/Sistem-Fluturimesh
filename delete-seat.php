<?php
session_start();
include "db.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: firstpage.php");
    exit;
}

$id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM seats WHERE id=:id");
$stmt->execute([':id'=>$id]);

header("Location: admin_seats.php");
exit();
?>