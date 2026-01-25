<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Select Flight</title>
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #1e1e1e, #283e51);
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;     
        align-items: center;         
        min-height: 100vh;  
    }

    .phone {
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        width: 400px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.1);
    }

    h2 {
        text-align: center;
        margin-bottom: 25px;
        font-weight: 600;
    }

    .flight {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        transition: transform 0.2s ease;
    }

    .flight:hover {
        transform: scale(1.02);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .flight-info strong {
        display: block;
        font-size: 16px;
        margin-bottom: 5px;
    }

    .price {
        font-weight: bold;
        color: #f44336;
    }

    .select-btn {
        padding: 8px 14px;
        background-color: #f44336;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .select-btn:hover {
        background-color: #e78c47;
    }

    .select-btn.selected {
        background-color:#48b731 ;
        cursor: default;
    }

    .popup-toast {
        display: none;
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #48b731 ;
        color: white;
        padding: 15px 25px;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        font-weight: 500;
        font-size: 14px;
        z-index: 1000;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.5s ease, top 0.5s ease;
        text-align: center;
        white-space: pre-line;
    }

    .popup-toast.show {
        display: block;
        opacity: 1;
        top: 50px;
    }
</style>
</head>
<body>

<div class="phone">
    <h2>Select Flight</h2>

    <div class="flight">
        <div class="flight-info">
             <strong class="route"></strong>
            <p>09:30 AM - 11:45 AM</p>
        </div>
        <span class="price">118€</span>
        <button class="select-btn">Select</button>
    </div>

    <div class="flight">
        <div class="flight-info">
            <strong class="route"></strong>
            <p class="time">02:00 PM - 04:15 PM</p>
        </div>
        <span class="price">696€</span>
        <button class="select-btn">Select</button>
    </div>

    <div class="flight">
        <div class="flight-info">
             <strong class="route"></strong>
            <p>20:00 PM - 22:15 PM</p>
        </div>
        <span class="price">850€</span>
        <button class="select-btn">Select</button>
    </div>

    <div id="popup" class="popup-toast"></div>
</div>

<script>
    const urlParams = new URLSearchParams(window.location.search);
    const from = urlParams.get("from") || "From";
    const to = urlParams.get("to") || "To";

    document.querySelectorAll(".route").forEach(routeEl => {
        routeEl.innerText = `${from} → ${to}`;
    });

    const buttons = document.querySelectorAll('.select-btn');
    const popup = document.getElementById('popup');

    buttons.forEach(btn => {
        btn.addEventListener('click', () => {
           
            buttons.forEach(b => {
                b.classList.remove('selected');
                b.innerText = "Select";
                b.disabled = false;
            });

            btn.classList.add('selected');
            btn.innerText = "Selected";
            btn.disabled = true;

            const flightDiv = btn.closest('.flight');
            const route = flightDiv.querySelector('.route').innerText;
            const time = flightDiv.querySelector('.flight-info p').innerText;
            const price = flightDiv.querySelector('.price').innerText;

            popup.innerText = `Your ticket has been successfully reserved!\nRoute: ${route}\nTime: ${time}\nPrice: ${price}`;
            popup.classList.add('show');

            setTimeout(() => {
                popup.classList.remove('show');
            }, 3000);
        });
    });
</script>

</body>
</html>


