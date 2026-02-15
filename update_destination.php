<?php
session_start(); 

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: FirstPage.php"); 
    exit();
}

include 'db.php';

$id = $_GET['id'] ?? 0;
if($id <= 0){
    die("ID e pavlefshme!");
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $departure_city = trim($_POST['from']);
    $arrival_city = trim($_POST['to']);
    $depart_date = $_POST['depart'];
    $return_date = $_POST['return'] ?? NULL;
    $trip_type = $_POST['tripType'];

    $allowed_cities = ["Paris","London","Berlin","Rome","Madrid","Barcelona","Amsterdam","Vienna","Zurich","Prague","Athens","Istanbul","Tirana","Pristina","Skopje","Belgrade","Sarajevo","Zagreb","New York","Los Angeles","Chicago","Miami","Toronto","Vancouver","Dubai","Doha","Tokyo","Seoul","Bangkok","Singapore","Sydney"];
    if(!in_array($departure_city, $allowed_cities) || !in_array($arrival_city, $allowed_cities)){
        die("Qytet i pavlefshëm!");
    }

    $stmt = $conn->prepare("UPDATE destinations SET departure_city=?, arrival_city=?, depart_date=?, return_date=?, trip_type=? WHERE id=?");
    $stmt->bind_param("sssssi", $departure_city, $arrival_city, $depart_date, $return_date, $trip_type, $id);

    if($stmt->execute()){
        $_SESSION['success'] = "Rezervimi u përditësua me sukses!";
        header("Location: viewBookings.php");
        exit();
    } else {
        echo "Gabim: " . $stmt->error;
    }
}

$stmt = $conn->prepare("SELECT * FROM destinations WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>

<h2>Edit Booking</h2>
<form method="POST">
    <input type="text" name="from" value="<?= htmlspecialchars($row['departure_city']) ?>" required>
    <input type="text" name="to" value="<?= htmlspecialchars($row['arrival_city']) ?>" required>
    <input type="date" name="depart" value="<?= $row['depart_date'] ?>" required>
    <input type="date" name="return" value="<?= $row['return_date'] ?>">
    <select name="tripType">
        <option value="round" <?= $row['trip_type']=='round'?'selected':'' ?>>Round Trip</option>
        <option value="oneway" <?= $row['trip_type']=='oneway'?'selected':'' ?>>Oneway</option>
    </select>
    <button type="submit">Save</button>
</form>

