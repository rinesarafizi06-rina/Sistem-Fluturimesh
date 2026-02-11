function selectSeat(seat) {
  document.querySelectorAll('.seat').forEach(s => {
    if (!s.classList.contains('taken')) {
      s.classList.remove('selected');
    }
  });

  seat.classList.add('selected');

  document.getElementById("selected-seat").innerText =
    "You have chosen the seat: " + seat.innerText;

  document.getElementById("seatInput").value = seat.innerText;
  document.getElementById("confirm-btn").disabled = false;
}

function confirmSeat() {
  const seat = document.querySelector('.seat.selected');
  if (!seat) return;

  alert('Successfully reserved seat: ' + seat.innerText);

  fetch('confirm_seat.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: 'seat=' + seat.innerText
  })
  .then(response => response.text()) 
  .catch(error => console.error(error));

  document.getElementById('confirm-btn').disabled = true;
}
