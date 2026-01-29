<?php
include "db.php";

$stmt = $conn->query("SELECT * FROM offers ORDER BY id DESC");
$offers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="cards-container">
<?php foreach($offers as $offer): ?>
  <div class="card">
    <img src="<?= $offer['imazhi'] ?>" alt="Flight Image">
    <div class="card-content">
      <span class="date"><?= date("D d M", strtotime($offer['data_fillimit'])) ?> - <?= date("D d M", strtotime($offer['data_mbarimit'])) ?></span>
      <h2><?= htmlspecialchars($offer['emri']) ?></h2>
      <p class="price"><span class="old"><?= $offer['cmimi'] ?></span></p>
      <small><?= htmlspecialchars($offer['pershkrimi']) ?></small>
    </div>
  </div>
<?php endforeach; ?>
</div>
