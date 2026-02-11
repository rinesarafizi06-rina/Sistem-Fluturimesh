<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Book Your Flight</title>
<style>
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg,#1e1e1e, #283e51);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}
.container { width: 100%; max-width: 400px; }
.phone {
    background: #fff;
    border-radius: 25px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    padding: 30px;
    position: relative;
}
h2 { text-align: center; margin-bottom: 20px; }
.tabs { display: flex; justify-content: space-around; margin-bottom: 20px; }
.tabs button {
    flex: 1; padding: 10px; border: none; background: #f0f0f0;
    cursor: pointer; border-radius: 10px; margin: 0 5px;
}
.tabs button.active { background: #f44336; color: white; }
.card { display: flex; flex-direction: column; gap: 12px; }
.card input {
    padding: 10px; border-radius: 10px; border: 1px solid #ddd;
}
button.primary {
    margin-top: 10px; padding: 12px;
    background: #f44336; color: white; border: none;
    border-radius: 12px; cursor: pointer;
}
</style>
</head>
<body>

<div class="container">
<div class="phone">
<h2>Book Your Flight</h2>

<div class="tabs">
    <button class="active" id="roundTripBtn" type="button">Round Trip</button>
    <button id="oneWayBtn" type="button">One Way</button>
</div>

<form class="card" id="flightForm" method="GET" action="select-flights.php">
    <input type="hidden" id="tripType" name="tripType" value="round">

    <label>From</label>
    <input type="text" id="from" name="from" list="cities" placeholder="Select your city" required>

    <label>To</label>
    <input type="text" id="to" name="to" list="cities" placeholder="Select your city" required>

    <datalist id="cities">
        <option value="Paris"><option value="London"><option value="Berlin"><option value="Rome">
        <option value="Madrid"><option value="Barcelona"><option value="Amsterdam"><option value="Vienna">
        <option value="Zurich"><option value="Prague"><option value="Athens"><option value="Istanbul">
        <option value="Tirana"><option value="Pristina"><option value="Skopje"><option value="Belgrade">
        <option value="Sarajevo"><option value="Zagreb"><option value="New York"><option value="Los Angeles">
        <option value="Chicago"><option value="Miami"><option value="Toronto"><option value="Vancouver">
        <option value="Dubai"><option value="Doha"><option value="Tokyo"><option value="Seoul">
        <option value="Bangkok"><option value="Singapore"><option value="Sydney">
    </datalist>

    <label>Depart</label>
    <input type="date" id="depart" name="depart" required>

    <label id="returnLabel">Return</label>
    <input type="date" id="returnInput" name="return">

    <button class="primary" type="submit">Search Flights</button>
</form>

</div>
</div>

<script>
const roundTripBtn = document.getElementById('roundTripBtn');
const oneWayBtn = document.getElementById('oneWayBtn');
const returnLabel = document.getElementById('returnLabel');
const returnInput = document.getElementById('returnInput');
const tripTypeInput = document.getElementById('tripType');

roundTripBtn.onclick = () => {
    roundTripBtn.classList.add('active');
    oneWayBtn.classList.remove('active');
    returnLabel.style.display = 'block';
    returnInput.style.display = 'block';
    tripTypeInput.value = "round";
};

oneWayBtn.onclick = () => {
    oneWayBtn.classList.add('active');
    roundTripBtn.classList.remove('active');
    returnLabel.style.display = 'none';
    returnInput.style.display = 'none';
    tripTypeInput.value = "oneway";
};
</script>

</body>
</html>
