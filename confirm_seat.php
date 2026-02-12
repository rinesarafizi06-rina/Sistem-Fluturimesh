<?php
include "db.php";

if (isset($_POST['seat'])) {
    $seatName = $_POST['seat'];

    $stmt = $conn->prepare(
        "UPDATE seats SET eshte_zgjedhur = 1 WHERE emri_vendi = :seat"
    );
    $stmt->execute([":seat" => $seatName]);
}
