<?php
session_start();
include "db.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit();
}

$stmt = $conn->query("SELECT * FROM seats");
$seats = [];
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $seats[$row['emri_vendi']] = $row;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['seat'])) {
    $seatName = $_POST['seat'];
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare(
        "UPDATE seats 
         SET eshte_zgjedhur = 1, user_id = :user_id 
         WHERE emri_vendi = :seat AND eshte_zgjedhur = 0"
    );
    $stmt->execute([':seat'=>$seatName, ':user_id'=>$user_id]);

    header("Location: seats.php");
    exit();
}

$allSeats = ["1A","1B","1C","1D","1E","1F","2A","2B","2C","2D","2E","2F","3A","3B","3C","3D","3E","3F","4A","4B","4C","4D","4E","4F","5A","5B","5C","5D","5E","5F"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Choose Your Seat</title>
<link rel="stylesheet" href="seats.css">
</head>
<body>

<a href="firstpage.php" class="back-arrow">&#8592;</a>
<h1>Choose Your Seat</h1>

<div class="seat-map">
<?php foreach($allSeats as $seatName):
    $taken = isset($seats[$seatName]) && $seats[$seatName]['eshte_zgjedhur'];
?>
    <div class="seat <?= $taken ? 'taken' : '' ?>" data-seat="<?= $seatName ?>">
        <?= $seatName ?>
    </div>
<?php endforeach; ?>
</div>

<div id="selected-seat">You have chosen the seat: None</div>
<form method="POST" id="seat-form">
    <input type="hidden" name="seat" id="seatInput">
    <button type="submit" id="confirm-btn" disabled>Confirm Seat</button>
</form>

<script>
const seats = document.querySelectorAll('.seat');
const seatInput = document.getElementById('seatInput');
const confirmBtn = document.getElementById('confirm-btn');
const selectedSeatText = document.getElementById('selected-seat');

let selectedSeat = null;

seats.forEach(seat => {
    if(!seat.classList.contains('taken')){
        seat.addEventListener('click', () => {
        
            if(selectedSeat) selectedSeat.classList.remove('selected');

            selectedSeat = seat;
            seat.classList.add('selected');

            seatInput.value = seat.dataset.seat;
            selectedSeatText.textContent = "You have chosen the seat: " + seat.dataset.seat;
            confirmBtn.disabled = false;
        });
    }
});
</script>
</body>
</html>
