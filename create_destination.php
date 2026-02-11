<?php
$host = "localhost";
$db = "sistem_fluturimesh";
$user = "root"; 
$pass = "";     

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$from = $_POST['from'] ?? '';
$to = $_POST['to'] ?? '';
$depart = $_POST['depart'] ?? '';
$return = $_POST['return'] ?? NULL;
$tripType = $_POST['tripType'] ?? '';

if($from && $to && $depart && $tripType){
    $stmt = $conn->prepare("INSERT INTO bookings (from_city, to_city, depart_date, return_date, trip_type) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $from, $to, $depart, $return, $tripType);
    $stmt->execute();
    $stmt->close();
}

$conn->close();

header("Location: select-flights.php?from=$from&to=$to&depart=$depart&return=$return&tripType=$tripType");
exit;
?>

