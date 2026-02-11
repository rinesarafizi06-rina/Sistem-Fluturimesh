<?php
include 'db.php';

$sql = "SELECT * FROM destinations ORDER BY created_at DESC";
$result = $conn->query($sql);

echo "<h2>Lista e Rezervimeve</h2>";
echo "<table border='1' cellpadding='10'>
<tr>
<th>ID</th><th>From</th><th>To</th><th>Depart</th><th>Return</th><th>Trip Type</th><th>Actions</th>
</tr>";

while($row = $result->fetch_assoc()){
    echo "<tr>
    <td>{$row['id']}</td>
    <td>{$row['departure_city']}</td>
    <td>{$row['arrival_city']}</td>
    <td>{$row['depart_date']}</td>
    <td>" . ($row['return_date'] ?? 'N/A') . "</td>
    <td>{$row['trip_type']}</td>
    <td>
        <a href='editBooking.php?id={$row['id']}'>Edit</a> | 
        <a href='deleteBooking.php?id={$row['id']}'>Delete</a>
    </td>
    </tr>";
}
echo "</table>";
?>
