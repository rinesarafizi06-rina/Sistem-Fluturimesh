<?php
include "db.php";
$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM offers WHERE id=:id");
$stmt->execute([":id" => $id]);

header("Location: offers.php");
