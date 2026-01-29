<?php
include "db.php";
$id = $_GET['id'];

$conn->prepare("DELETE FROM users WHERE id=:id")
     ->execute([":id" => $id]);

header("Location: users.php");
