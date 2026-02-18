<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin'){
    header("Location: no_access.php");
    exit();
}

$stmt = $conn->query("SELECT * FROM contact_messages ORDER BY id DESC");
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Mesazhet e Kontaktit</title>
<style>
body { font-family: 'Poppins', sans-serif; padding: 20px; background:#f4f4f4;}
table { border-collapse: collapse; width: 100%; background: #fff; box-shadow: 0 5px 15px rgba(0,0,0,0.1);}
th, td { border: 1px solid #ccc; padding: 12px; text-align: left;}
th { background: #f44336; color: #fff;}
</style>
</head>
<body>
<h2>Mesazhet e Kontaktit</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Emri</th>
        <th>Email</th>
        <th>Mesazhi</th>
        <th>Data</th>
    </tr>
    <?php foreach($messages as $msg): ?>
    <tr>
        <td><?= htmlspecialchars($msg['id']) ?></td>
        <td><?= htmlspecialchars($msg['name']) ?></td>
        <td><?= htmlspecialchars($msg['email']) ?></td>
        <td><?= htmlspecialchars($msg['message']) ?></td>
        <td><?= htmlspecialchars($msg['created_at']) ?></td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
