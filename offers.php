<?php
session_start();
include "db.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="sq">
<head>
  <meta charset="UTF-8">
  <title>Top Flight Deals</title>
  <link rel="stylesheet" href="login.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">



</head>
<body class="body1">

 <h1 class="title">
   Top Flight Deals
</h1>

<div class="cards-container">

  <div class="card">
     
    <img src="https://images.unsplash.com/photo-1528909514045-2fa4ac7a08ba">
    <div class="card-content">
      <span class="date">Tue 30 Dec - Sun 4 Jan</span>
      <h2>Manchester ↔ Amsterdam</h2>
      <p class="price"><span class="old">80€</span> 60€</p>
      <small>Prime price per passenger</small>
    </div>
  </div>

  <div class="card">
    <img src="Images/Belfast Castle – the jewel at the centre of Cave Hill Country Park 💎🏰.jpg">
    <div class="card-content">
      <span class="date">Sun 16 Jan - Mon 20 Jan</span>
      <h2>Manchester ↔ Belfast</h2>
      <p class="price"><span class="old">103€</span> 101€</p>
      <small>Prime price per passenger</small>
    </div>
  </div>

  <div class="card">
    <img src="Images/sunset view at london street _ Luxora-Hub.jpg">
    <div class="card-content">
      <span class="date">Wed 24 Dec - Fri 26 Dec</span>
      <h2>Berlin ↔ London</h2>
      <p class="price"><span class="old">56€</span> 55€</p>
      <small>Prime price per passenger</small>
    </div>
  </div>

  <div class="card">
    <img src="Images/September in Switzerland_ Top Attractions.jpg">
    <div class="card-content">
      <span class="date">Mon 4 Dec - Fri 12 Dec</span>
      <h2>Sofia ↔ Zurich</h2>
      <p class="price"><span class="old">100€</span> 50€</p>
      <small>Prime price per passenger</small>
    </div>
  </div>

  <div class="card">
    <img src="Images/download.jpg">
    <div class="card-content">
      <span class="date">Wed 30 Mar - Fri 36 Mar</span>
      <h2>Rome ↔ Paris</h2>
      <p class="price"><span class="old">112€</span> 97€</p>
      <small>Prime price per passenger</small>
    </div>
  </div>

  <div class="card">
    <img src="Images/Explore Barcelona’s Iconic Sagrada Familia.jpg">
    <div class="card-content">
      <span class="date">Tue 15 Jan - Fri 26 Jan</span>
      <h2>Basel ↔ Barcelona</h2>
      <p class="price"><span class="old">68€</span> 76€</p>
      <small>Prime price per passenger</small>
    </div>
  </div>

  <div class="card">
    <img src="Images/City of Priština.jpg">
    <div class="card-content">
      <span class="date">Fri 2 Dec - Mon 11 Dec</span>
      <h2>Geneve ↔ Pristina</h2>
      <p class="price"><span class="old">45€</span> 80€</p>
      <small>Prime price per passenger</small>
    </div>
  </div>

  <div class="card">
    <img src="Images/Москва.jpg">
    <div class="card-content">
      <span class="date">Wed 25 Nov - Fri 2 Dec</span>
      <h2>Oslo ↔ Moscow</h2>
      <p class="price"><span class="old">156€</span> 123€</p>
      <small>Prime price per passenger</small>
    </div>
  </div>

  <div class="card">
    <img src="Images/WORLD 2024 🌊 (@W0rld2K24) on X.jpg">
    <div class="card-content">
      <span class="date">Tue 5 Oct - Fri 13 Sep</span>
      <h2>Tirana ↔ Rome</h2>
      <p class="price"><span class="old">77€</span> 65€</p>
      <small>Prime price per passenger</small>
    </div>
  </div>

  <div class="card">
    <img src="Images/The amazing Charles Bridge in Prague.jpg">
    <div class="card-content">
      <span class="date">Mon 10 Jan - Fri 14 Jan</span>
      <h2>Vienna ↔ Prague</h2>
      <p class="price"><span class="old">90€</span> 70€</p>
      <small>Prime price per passenger</small>
    </div>
  </div>

  <div class="card">
    <img src="Images/Lisboa, Portugal_ - Awesome.jpg">
    <div class="card-content">
      <span class="date">Thu 20 Feb - Sun 23 Feb</span>
      <h2>Madrid ↔ Lisbon</h2>
      <p class="price"><span class="old">85€</span> 62€</p>
      <small>Prime price per passenger</small>
    </div>
  </div>

  <div class="card">
    <img src="Images/Cara Milano ti scrivo, così mi distraggo un attimo.jpg">
    <div class="card-content">
      <span class="date">Sat 5 Mar - Tue 8 Mar</span>
      <h2>Paris ↔ Milan</h2>
      <p class="price"><span class="old">95€</span> 72€</p>
      <small>Prime price per passenger</small>
    </div>
  </div>

</div>

 

  <script>
  document.addEventListener("DOMContentLoaded", () => {

  document.querySelectorAll(".card").forEach(card => {

    card.addEventListener("click", () => {

      const title = card.querySelector("h2").innerText;
      const price = card.querySelector(".price").innerText;
      const image = card.querySelector("img").getAttribute("src");

      fetch("save_offer.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded"
        },
        body: `title=${encodeURIComponent(title)}&price=${encodeURIComponent(price)}&image=${encodeURIComponent(image)}`
      })
      .then(res => res.text())
      .then(() => {
        alert("The offer has been successfully selected!");
      });

    });

  });

});
</script>
</body>
</html>
