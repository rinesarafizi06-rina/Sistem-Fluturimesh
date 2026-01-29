<?php
include "db.php";
$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM offers WHERE id=:id");
$stmt->execute([":id" => $id]);
$offer = $stmt->fetch();

if ($_POST) {
    $stmt = $conn->prepare("UPDATE offers SET emri=:emri, cmimi=:cmimi, pershkrimi=:pershkrimi, data_fillimit=:data_fillimit, data_mbarimit=:data_mbarimit, imazhi=:imazhi WHERE id=:id");
    $stmt->execute([
        ":emri" => $_POST['emri'],
        ":cmimi" => $_POST['cmimi'],
        ":pershkrimi" => $_POST['pershkrimi'],
        ":data_fillimit" => $_POST['data_fillimit'],
        ":data_mbarimit" => $_POST['data_mbarimit'],
        ":imazhi" => $_POST['imazhi'],
        ":id" => $id
    ]);
    header("Location: offers.php");
}
?>

<form method="POST">
<h2>Ndrysho Ofertë</h2>
<input type="text" name="emri" value="<?= htmlspecialchars($offer['emri']) ?>" required><br>
<input type="number" name="cmimi" value="<?= $offer['cmimi'] ?>" required><br>
<textarea name="pershkrimi"><?= htmlspecialchars($offer['pershkrimi']) ?></textarea><br>
<input type="date" name="data_fillimit" value="<?= $offer['data_fillimit'] ?>" required><br>
<input type="date" name="data_mbarimit" value="<?= $offer['data_mbarimit'] ?>" required><br>
<input type="text" name="imazhi" value="<?= $offer['imazhi'] ?>" required><br>
<button type="submit">Përditeso</button>
</form>
