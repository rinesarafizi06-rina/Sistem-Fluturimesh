<?php
include "db.php";

$stmt = $conn->query("SELECT * FROM seats ORDER BY id ASC");
$seats = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Choose Your Seat</title>
<link rel="stylesheet" href="seats.css">
</head>
<body>

<h1>Choose Your Seat</h1>

<div class="seat-map">
<?php foreach($seats as $seat): ?>
    <div 
        class="seat <?= $seat['eshte_zgjedhur'] ? 'taken' : '' ?>" 
        data-id="<?= $seat['id'] ?>"
    >
        <?= htmlspecialchars($seat['emri_vendi']) ?>
    </div>
<?php endforeach; ?>
</div>

<div id="selected-seat">You have chosen the seat: None</div>
<button id="confirm-btn" disabled>Confirm Seat</button>

<script>
let selectedSeat = null;

document.querySelectorAll('.seat').forEach(seat => {
    seat.addEventListener('click', () => {
        if(seat.classList.contains('taken')) return; 

        document.querySelectorAll('.seat').forEach(s => s.style.border = '');

        selectedSeat = seat.dataset.id;
        seat.style.border = "2px solid red";

        document.getElementById('selected-seat').innerText = "You have chosen the seat: " + seat.innerText;
        document.getElementById('confirm-btn').disabled = false;
    });
});

document.getElementById('confirm-btn').addEventListener('click', () => {
    if(!selectedSeat) return;

    fetch('confirm_seat.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'seat_id=' + selectedSeat
    })
    .then(res => res.text())
    .then(res => {
        alert(res);
        location.reload(); 
    });
});
</script>

</body>
</html>

