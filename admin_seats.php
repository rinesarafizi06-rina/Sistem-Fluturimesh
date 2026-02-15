<?php
session_start();
include "db.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: firstpage.php");
    exit();
}

$stmt = $conn->query("SELECT * FROM seats");
$seats = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h1>Admin - Menaxho Seat-et</h1>
<table border="1">
<tr><th>Seat</th><th>Status</th><th>User ID</th></tr>
<?php foreach($seats as $s): ?>
<tr>
  <td><?= $s['emri_vendi'] ?></td>
  <td><?= $s['eshte_zgjedhur'] ? "I zënë" : "I lirë" ?></td>
  <td><?= $s['user_id'] ?></td>
</tr>
<?php endforeach; ?>
</table>
