<?php
session_start(); 

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: FirstPage.php"); 
    exit();
}

$host = "localhost";
$db = "sistem_fluturimesh";
$user = "root"; 
$pass = "";     

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$from = trim($_POST['from'] ?? '');
$to = trim($_POST['to'] ?? '');
$depart = $_POST['depart'] ?? '';
$return = $_POST['return'] ?? NULL;
$tripType = $_POST['tripType'] ?? '';

if($from && $to && $depart && $tripType){

    $allowed_cities = ["Paris","London","Berlin","Rome","Madrid","Barcelona","Amsterdam","Vienna","Zurich","Prague","Athens","Istanbul","Tirana","Pristina","Skopje","Belgrade","Sarajevo","Zagreb","New York","Los Angeles","Chicago","Miami","Toronto","Vancouver","Dubai","Doha","Tokyo","Seoul","Bangkok","Singapore","Sydney"];
    if(!in_array($from, $allowed_cities) || !in_array($to, $allowed_cities)){
        die("Qytet i pavlefshëm!");
    }

    $stmt = $conn->prepare("INSERT INTO bookings (from_city, to_city, depart_date, return_date, trip_type) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $from, $to, $depart, $return, $tripType);
    $stmt->execute();
    $stmt->close();

    $_SESSION['success'] = "Rezervimi u shtua me sukses!";
}

$conn->close();

header("Location: select-flights.php?from=$from&to=$to&depart=$depart&return=$return&tripType=$tripType");
exit();
?>
