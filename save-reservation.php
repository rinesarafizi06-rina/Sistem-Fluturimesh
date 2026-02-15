<?php
include "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $departure_city = trim($_POST['departure_city'] ?? '');
    $arrival_city = trim($_POST['arrival_city'] ?? '');
    $depart_date = trim($_POST['depart_date'] ?? '');
    $return_date = trim($_POST['return_date'] ?? '');
    $trip_type = trim($_POST['trip_type'] ?? '');

    if(!$departure_city || !$arrival_city || !$depart_date || !$trip_type){
        echo json_encode(['success'=>false, 'error'=>'Missing required fields!']);
        exit;
    }

    $return_date = $return_date ?: null;

    try {
        
        $stmt = $conn->prepare("
            INSERT INTO destinations 
            (departure_city, arrival_city, depart_date, return_date, trip_type, created_at)
            VALUES (:departure_city, :arrival_city, :depart_date, :return_date, :trip_type, NOW())
        ");

        $stmt->bindParam(':departure_city', $departure_city);
        $stmt->bindParam(':arrival_city', $arrival_city);
        $stmt->bindParam(':depart_date', $depart_date);
        $stmt->bindParam(':return_date', $return_date);
        $stmt->bindParam(':trip_type', $trip_type);

        $stmt->execute();

        echo json_encode(['success'=>true]);

    } catch(PDOException $e){
        echo json_encode(['success'=>false,'error'=>$e->getMessage()]);
    }
}
?>



