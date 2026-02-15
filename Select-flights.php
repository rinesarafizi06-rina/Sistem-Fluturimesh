<?php
include "db.php"; 

$from = $_GET['from'] ?? '';
$to = $_GET['to'] ?? '';
$depart = $_GET['depart'] ?? '';
$return = $_GET['return'] ?? '';
$tripType = $_GET['tripType'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Select Flight</title>
<style>
body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg,#1e1e1e, #283e51); margin:0; display:flex; justify-content:center; align-items:center; min-height:100vh;}
.phone { background:#fff; padding:30px; border-radius:12px; width:400px; box-shadow:0 6px 20px rgba(0,0,0,0.1); position:relative; }
h2 { text-align:center; margin-bottom:25px; font-weight:600; }
.flight { display:flex; justify-content:space-between; align-items:center; padding:15px; margin-bottom:15px; border:1px solid #ddd; border-radius:8px; transition: transform 0.2s ease; }
.flight:hover { transform:scale(1.02); box-shadow:0 4px 12px rgba(0,0,0,0.1);}
.flight-info strong { display:block; font-size:16px; margin-bottom:5px; }
.price { font-weight:bold; color:#f44336; }
.select-btn { padding:8px 14px; background-color:#f44336; color:white; border:none; border-radius:6px; cursor:pointer; transition: background 0.3s ease; }
.select-btn:hover { background-color:#e78c47; }
.select-btn.selected { background-color:#48b731; cursor:default; }
.popup-toast { display:none; position:fixed; top:20px; left:50%; transform:translateX(-50%); background-color:#48b731; color:white; padding:15px 25px; border-radius:8px; box-shadow:0 5px 15px rgba(0,0,0,0.3); font-weight:500; font-size:14px; z-index:1000; opacity:0; pointer-events:none; transition: opacity 0.5s ease, top 0.5s ease; text-align:center; white-space:pre-line; }
.popup-toast.show { display:block; opacity:1; top:50px; }
</style>
</head>
<body>

<div class="phone">
<h2>Select Flight</h2>

<?php
$flights = [
    ['time'=>'09:30 AM - 11:45 AM','price'=>'118€'],
    ['time'=>'02:00 PM - 04:15 PM','price'=>'696€'],
    ['time'=>'08:00 PM - 10:15 PM','price'=>'850€']
];

foreach($flights as $f):
?>
<div class="flight">
    <div class="flight-info">
        <strong class="route"><?= htmlspecialchars($from) ?> → <?= htmlspecialchars($to) ?></strong>
        <p><?= $f['time'] ?></p>
    </div>
    <span class="price"><?= $f['price'] ?></span>
    <button class="select-btn">Select</button>
</div>
<?php endforeach; ?>

<div id="popup" class="popup-toast"></div>
</div>

<script>
const buttons = document.querySelectorAll('.select-btn');
const popup = document.getElementById('popup');

buttons.forEach(btn => {
    btn.addEventListener('click', () => {
        buttons.forEach(b => { b.classList.remove('selected'); b.innerText="Select"; b.disabled=false; });
        btn.classList.add('selected'); btn.innerText="Selected"; btn.disabled=true;

        const flightDiv = btn.closest('.flight');
        const route = flightDiv.querySelector('.route').innerText;
        const time = flightDiv.querySelector('.flight-info p').innerText;
        const price = flightDiv.querySelector('.price').innerText;
        const [departure_city, arrival_city] = route.split(' → ').map(s=>s.trim());

        fetch('save-reservation.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({
                departure_city,
                arrival_city,
                depart_date: '<?= $depart ?>',
                return_date: '<?= $return ?>',
                trip_type: '<?= $tripType ?>'
            })
        })
        .then(res => res.json())
        .then(data => {
            if(data.success){
                popup.innerText = `Your ticket has been successfully reserved!\nRoute: ${route}\nTime: ${time}\nPrice: ${price}`;
            } else {
                popup.innerText = `Error: ${data.error}`;
            }
            popup.classList.add('show');
            setTimeout(()=>{popup.classList.remove('show');},3000);
        });
    });
});
</script>

</body>
</html>
