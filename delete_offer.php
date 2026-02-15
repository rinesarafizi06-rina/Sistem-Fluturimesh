<?php
<?php
session_start();
include "db.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: offers.php");
    exit();
}

$id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM offers WHERE id=:id");
$stmt->execute([":id" => $id]);

header("Location: offers.php");
exit();
?>

