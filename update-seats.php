<?php
include "db.php";

if (!isset($_POST['seat'])) {
  header("Location: seats.php");
  exit;
}

$seat = $_POST['seat'];
$user_id = 1; 
$stmt = $conn->prepare(
  "UPDATE seats 
   SET eshte_zgjedhur = 1, user_id = ?
   WHERE emri_vendi = ? AND eshte_zgjedhur = 0"
);

$stmt->bind_param("is", $user_id, $seat);
$stmt->execute();

header("Location: seats.php");
exit;

