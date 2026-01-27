<?php
$host = 'localhost';
$dbname = 'sistem_fluturimesh';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    echo "Lidhja me databazën u realizua!";
} catch (PDOException $e) {
    echo "Gabim: " . $e->getMessage();
}

   
?>
