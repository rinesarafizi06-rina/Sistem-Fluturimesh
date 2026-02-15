<?php
include "db.php";

if (
    isset($_POST['title']) &&
    isset($_POST['price']) &&
    isset($_POST['image'])
) {

    $stmt = $conn->prepare(
        "INSERT INTO clicked_offers (title, price, image)
         VALUES (?, ?, ?)"
    );

    $stmt->execute([
        $_POST['title'],
        $_POST['price'],
        $_POST['image']
    ]);

    echo "OK";
} else {
    echo "ERROR";
}




