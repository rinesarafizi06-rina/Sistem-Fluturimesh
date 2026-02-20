<?php
session_start();
include 'db.php';

echo "<h2>Lista e Rezervimeve</h2>";
echo "<table border='1' cellpadding='10'>
<tr>
<th>ID</th><th>From</th><th>To</th><th>Depart</th><th>Return</th><th>Trip Type</th>";

if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
    echo "<th>Actions</th>";
}
echo "</tr>";

$sql = "SELECT * FROM destinations ORDER BY created_at DESC";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()){
    echo "<tr>
    <td>{$row['id']}</td>
    <td>{$row['departure_city']}</td>
    <td>{$row['arrival_city']}</td>
    <td>{$row['depart_date']}</td>
    <td>" . ($row['return_date'] ?? 'N/A') . "</td>
    <td>{$row['trip_type']}</td>";

    if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
        echo "<td>
            <a href='edit_destination.php?id={$row['id']}'>Edit</a> | 
            <a href='delete_destination.php?id={$row['id']}'>Delete</a>
        </td>";
    }
    echo "</tr>";
}
echo "</table>";
?>
