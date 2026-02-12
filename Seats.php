<?php
include "db.php";

$stmt = $conn->query("SELECT * FROM seats");
$seats = [];

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $seats[$row['emri_vendi']] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Choose Your Seat</title>
  <link rel="stylesheet" href="seats.css">
</head>
<body>

<a href="FirstPage.php" class="back-arrow">&#8592;</a>
<h1>Choose Your Seat</h1>

<div class="seat-map">
<?php
$allSeats = [
  "1A","1B","1C","1D","1E","1F",
  "2A","2B","2C","2D","2E","2F",
  "3A","3B","3C","3D","3E","3F",
  "4A","4B","4C","4D","4E","4F",
  "5A","5B","5C","5D","5E","5F"
];

foreach ($allSeats as $seatName) {
  $taken = isset($seats[$seatName]) && $seats[$seatName]['eshte_zgjedhur'];
?>
  <div class="seat <?php if($taken) echo 'taken'; ?>"
       <?php if(!$taken) { ?> onclick="selectSeat(this)" <?php } ?>>
    <?= $seatName ?>
  </div>
<?php } ?>
</div>

<div id="selected-seat">You have chosen the seat: None</div>

<input type="hidden" id="seatInput">

<button id="confirm-btn" disabled onclick="confirmSeat()">
  Confirm Seat
</button>

<script src="script.js"></script>
</body>
</html>
