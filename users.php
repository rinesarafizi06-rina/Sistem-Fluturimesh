<?php
include "db.php";
$users = $conn->query("SELECT * FROM users")->fetchAll();
?>

<h2>Users</h2>

<table border="1">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Action</th>
</tr>

<?php foreach ($users as $u): ?>
<tr>
    <td><?= $u['id'] ?></td>
    <td><?= $u['emri'] ?></td>
    <td><?= $u['email'] ?></td>
    <td>
        <a href="edit_user.php?id=<?= $u['id'] ?>">Edit</a>
        <a href="delete_user.php?id=<?= $u['id'] ?>">Delete</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
