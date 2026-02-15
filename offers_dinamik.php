<?php
session_start();
include "db.php";

$stmt = $conn->query("SELECT * FROM offers ORDER BY id DESC");
$offers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="sq">
<head>
<meta charset="UTF-8">
<title>Top Flight Deals</title>
<link rel="stylesheet" href="offers.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<a href="firstpage.php" class="back-arrow">&#8592;</a>
<h1 class="title">Top Flight Deals</h1>

<div class="cards-container">
<?php foreach($offers as $offer): ?>
  <div class="card" data-offer-id="<?= $offer['id'] ?>">
    <img src="<?= htmlspecialchars($offer['imazhi']) ?>" alt="Oferta">
    <div class="card-content">
      <h2><?= htmlspecialchars($offer['emri']) ?></h2>
      <p class="price"><?= $offer['cmimi'] ?>€</p>
      <small><?= htmlspecialchars($offer['pershkrimi']) ?></small>
    </div>
  </div>
<?php endforeach; ?>
</div>

<script>

const cards = document.querySelectorAll('.card');

cards.forEach(card => {
    card.addEventListener('click', () => {
        const offerId = card.dataset.offerId;

        fetch('save_offer.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'offer_id=' + offerId
        })
        .then(res => res.text())
        .then(msg => alert(msg));
    });
});
</script>

</body>
</html>


