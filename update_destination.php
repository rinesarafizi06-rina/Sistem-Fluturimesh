<?php
include 'db.php';
$id = $_GET['id'];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $departure_city = $_POST['from'];
    $arrival_city = $_POST['to'];
    $depart_date = $_POST['depart'];
    $return_date = $_POST['return'] ?? NULL;
    $trip_type = $_POST['tripType'];

    $sql = "UPDATE destinations SET departure_city=?, arrival_city=?, depart_date=?, return_date=?, trip_type=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $departure_city, $arrival_city, $depart_date, $return_date, $trip_type, $id);

    if($stmt->execute()){
        header("Location: viewBookings.php");
        exit;
    } else {
        echo "Gabim: " . $stmt->error;
    }
}

$sql = "SELECT * FROM destinations WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>

<h2>Edit Booking</h2>
<form method="POST">
    <input type="text" name="from" value="<?= $row['departure_city'] ?>" required>
    <input type="text" name="to" value="<?= $row['arrival_city'] ?>" required>
    <input type="date" name="depart" value="<?= $row['depart_date'] ?>" required>
    <input type="date" name="return" value="<?= $row['return_date'] ?>">
    <select name="tripType">
        <option value="round" <?= $row['trip_type']=='round'?'selected':'' ?>>Round Trip</option>
        <option value="oneway" <?= $row['trip_type']=='oneway'?'selected':'' ?>>Oneway</option>
    </select>
    <button type="submit">Save</button>
</form>
