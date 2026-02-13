<?php
session_start();
include "db.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

if ($_POST) {
    $stmt = $conn->prepare(
        "UPDATE users SET emri=:emri, email=:email WHERE id=:id"
    );
    $stmt->execute([
        ":emri" => $_POST['emri'],
        ":email" => $_POST['email'],
        ":id" => $id
    ]);
    header("Location: users.php");
    exit;
}

$user = $conn->prepare("SELECT * FROM users WHERE id=:id");
$user->execute([":id" => $id]);
$user = $user->fetch();
?>

<form method="POST">
    <input name="emri" value="<?= htmlspecialchars($user['emri']) ?>">
    <input name="email" value="<?= htmlspecialchars($user['email']) ?>">
    <button>Update</button>
</form>
