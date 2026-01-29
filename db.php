<?php
$host = 'localhost';
$dbname = 'sistem_fluturimesh';
$user = 'root';
$pass = '';

try {
    $conn = new PDO("mysql:host=localhost;dbname=sistem_fluturimesh", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    die("Gabim ne lidhje: " . $e->getMessage());
}
?>
   

