<?php
session_start();
include "db.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: firstpage.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare(
        "INSERT INTO seats (emri_vendi, eshte_zgjedhur, user_id) VALUES (:seat, 0, NULL)"
    );
    $stmt->execute([':seat' => $_POST['seat']]);

    header("Location: admin_seats.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Seat</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Add New Seat</h1>
<form method="POST">
    <label>Seat Name:</label>
    <input type="text" name="seat" required><br><br>
    <button type="submit">Add Seat</button>
</form>

<a href="admin_seats.php">Back to Seats</a>

</body>
</html>