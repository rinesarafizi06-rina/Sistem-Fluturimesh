<?php
session_start();
include "db.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: offers.php");
    exit();
}

if ($_POST) {
    $stmt = $conn->prepare("INSERT INTO offers (emri, cmimi, pershkrimi, data_fillimit, data_mbarimit, imazhi) 
      VALUES (:emri, :cmimi, :pershkrimi, :data_fillimit, :data_mbarimit, :imazhi)");

    $stmt->execute([
        ":emri" => $_POST['emri'],
        ":cmimi" => $_POST['cmimi'],
        ":pershkrimi" => $_POST['pershkrimi'],
        ":data_fillimit" => $_POST['data_fillimit'],
        ":data_mbarimit" => $_POST['data_mbarimit'],
        ":imazhi" => $_POST['imazhi'] 
    ]);

    header("Location: offers.php");
    exit();
}
?>

<form method="POST">
<h2>Shto Ofertë të Re</h2>
<input type="text" name="emri" placeholder="Emri" required><br>
<input type="number" name="cmimi" placeholder="Çmimi" required><br>
<textarea name="pershkrimi" placeholder="Përshkrimi"></textarea><br>
<input type="date" name="data_fillimit" required><br>
<input type="date" name="data_mbarimit" required><br>
<input type="text" name="imazhi" placeholder="Link i imazhit" required><br>
<button type="submit">Shto</button>
</form>
