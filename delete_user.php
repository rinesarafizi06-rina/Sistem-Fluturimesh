<?php
session_start();
include "db.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

if ($id) {
    $stmt = $conn->prepare("DELETE FROM users WHERE id=:id");
    $stmt->execute([":id" => $id]);
}

header("Location: users.php");
exit;

