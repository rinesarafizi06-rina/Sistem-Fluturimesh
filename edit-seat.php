<?php
session_start();
include "db.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: firstpage.php");
    exit;
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM seats WHERE id=:id");
$stmt->execute([':id'=>$id]);
$seat = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$seat) die("Seat not found");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare(
        "UPDATE seats SET emri_vendi=:seat, eshte_zgjedhur=:taken, user_id=:user WHERE id=:id"
    );
    $stmt->execute([
        ':seat' => $_POST['seat'],
        ':taken' => isset($_POST['taken']) ? 1 : 0,
        ':user' => $_POST['user'] ?: NULL,
        ':id' => $id
    ]);

    header("Location: admin_seats.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Seat</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Edit Seat</h1>
<form method="POST">
    <label>Seat Name:</label>
    <input type="text" name="seat" value="<?= $seat['emri_vendi'] ?>" required><br><br>

    <label>Is Taken:</label>
    <input type="checkbox" name="taken" <?= $seat['eshte_zgjedhur'] ? 'checked' : '' ?>><br><br>

    <label>User ID:</label>
    <input type="number" name="user" value="<?= $seat['user_id'] ?>"><br><br>

    <button type="submit">Save Changes</button>
</form>

<a href="admin_seats.php">Back to Seats</a>

</body>
</html>