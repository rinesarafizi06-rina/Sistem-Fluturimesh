
document.querySelectorAll(".card").forEach(card => {
  card.addEventListener("click", () => {
    alert("The offer was selected!");
  });
});




let selectedSeat = null;

function selectSeat(seat) {
  if (selectedSeat) {
    selectedSeat.classList.remove('selected');
  }
  seat.classList.add('selected');
  selectedSeat = seat;

  document.getElementById('selected-seat').innerText =
    "You have chosen the seat: " + seat.innerText;
}

function confirmSeat() {
  if (!selectedSeat) {
    alert("Please select a seat before confirming.");
    return;
  }
  alert("Seat " + selectedSeat.innerText + " confirmed! Thank you.");
}


function selectSeat(seat) {
  if (selectedSeat) {
    selectedSeat.classList.remove('selected');
  }
  seat.classList.add('selected');
  selectedSeat = seat;

  document.getElementById('selected-seat').innerText =
    "You have chosen the seat: " + seat.innerText;

  
  document.getElementById('confirm-btn').disabled = false;
}



function validateForm() {
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    
    if (!email.includes("@")) {
        alert("Email must contain the '@' symbol.");
        return false;
    }

    
    
    const passwordRegex = /^(?=.*[0-9])(?=.*[!@#$%^&*]).{8,}$/;

    if (!passwordRegex.test(password)) {
        alert("Password must be at least 8 characters long and include at least one number and one special character (!@#$%^&*).");
        return false;
    }

    
    alert("Login successful!");
    return true;
}
