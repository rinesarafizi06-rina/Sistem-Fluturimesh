<?php
session_start();
include "db.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: firstpage.php");
    exit;
}

$stmt = $conn->query("SELECT * FROM seats");
$seats = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Manage Seats</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Seats Management</h1>

<a href="add_seat.php">Add New Seat</a>

<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Seat Name</th>
    <th>Status</th>
    <th>User ID</th>
    <th>Actions</th>
</tr>

<?php foreach($seats as $seat): ?>
<tr>
    <td><?= $seat['id'] ?></td>
    <td><?= $seat['emri_vendi'] ?></td>
    <td><?= $seat['eshte_zgjedhur'] ? 'Taken' : 'Free' ?></td>
    <td><?= $seat['user_id'] ?></td>
    <td>
        <a href="edit_seat.php?id=<?= $seat['id'] ?>">Edit</a> | 
        <a href="delete_seat.php?id=<?= $seat['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
    </td>
</tr>
<?php endforeach; ?>
</table>

</body>
</html>