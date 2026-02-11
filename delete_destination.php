<?php
$host = "localhost";
$db = "sistem_fluturimesh";
$user = "root";
$pass = "";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) die("Connection failed: ".$conn->connect_error);

$id = $_GET['id'] ?? 0;

$stmt = $conn->prepare("DELETE FROM bookings WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();

$conn->close();
header("Location: select-flights.php");
exit;
?>
