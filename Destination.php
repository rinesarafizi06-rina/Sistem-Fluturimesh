<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Flight App UI</title>
<link rel="stylesheet" href="destination.css">
</head>
<body>

<div class="container">
<div class="phone">
<a href="FirstPage.html" class="back-arrow">&#8592;</a>
<h2>Book Your Flight </h2>

<div class="tabs">
    <button class="active" id="roundTripBtn">Round Trip</button>
    <button id="oneWayBtn">Oneway</button>
</div>

   <form class="card" id="flightForm">
  <label>From</label>
  <input type="text" id="from" placeholder="Select your city" list="cities">

  <label>To</label>
  <input type="text" id="to" placeholder="Select your city" list="cities">

    <datalist id="cities">
    <option value="Paris">
    <option value="London">
    <option value="New York">
    <option value="Tokyo">
    <option value="Berlin">
    <option value="Rome">
    <option value="Madrid">
    <option value="Amsterdam">
    <option value="Sydney">
    <option value="Toronto">
    <option value="Dubai">
    <option value="Singapore">
    <option value="Hong Kong">
    <option value="Bangkok">
    <option value="Los Angeles">
    <option value="Chicago">
    <option value="San Francisco">
    <option value="Barcelona">
    <option value="Moscow">
    <option value="Istanbul">
</datalist>

<label>Depart</label>
<input type="date" id="depart">

<label id="returnLabel">Return</label>
<input type="date" id="returnInput">

    
     <button class="primary" type="submit">Search Flights</button>
    </form>
</div>

<script>
    const roundTripBtn = document.getElementById('roundTripBtn');
    const oneWayBtn = document.getElementById('oneWayBtn');
    const returnLabel = document.getElementById('returnLabel');
    const returnInput = document.getElementById('returnInput');
    const form = document.getElementById("flightForm"); 

    roundTripBtn.addEventListener('click', () => {
        roundTripBtn.classList.add('active');
        oneWayBtn.classList.remove('active');
        returnLabel.style.display = 'block';
        returnInput.style.display = 'block';
    });

    oneWayBtn.addEventListener('click', () => {
        oneWayBtn.classList.add('active');
        roundTripBtn.classList.remove('active');
        returnLabel.style.display = 'none';
        returnInput.style.display = 'none';
    });

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const from = document.getElementById("from").value.trim();
        const to = document.getElementById("to").value.trim();
        const depart = document.getElementById("depart").value;
        const isRoundTrip = roundTripBtn.classList.contains("active");
        const returnDate = returnInput.value;

        if (from === "" || to === "" || depart === "") {
            alert("Please fill in all required fields before searching for flights.");
            return;
        }

        if (isRoundTrip && returnDate === "") {
            alert("Please select a return date for a round trip.");
            return;
        }

        const params = new URLSearchParams();
        params.set("from", from);
        params.set("to", to);
        params.set("depart", depart);
        if (isRoundTrip) {
            params.set("return", returnDate);
        }

        window.location.href = "select-flights.html?" + params.toString();
    });
</script>

