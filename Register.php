<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $conn->prepare(
        "INSERT INTO users (emri, email, password)
         VALUES (:emri, :email, :password)"
    );

    $stmt->execute([
        ":emri" => $_POST['emri'],
        ":email" => $_POST['email'],
        ":password" => password_hash($_POST['password'], PASSWORD_DEFAULT)
    ]);

    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>

<section>
    <div class="login-box">
        <form method="POST">
            <h2>Register</h2>

            <div class="input-box">
                <input type="text" name="emri" required>
                <label>Name</label>
            </div>

            <div class="input-box">
                <input type="email" name="email" required>
                <label>Email</label>
            </div>

            <div class="input-box">
                <input type="password" name="password" required>
                <label>Password</label>
            </div>

            <button type="submit">Register</button>

            <div class="register-link">
                <p>Already have account? <a href="login.php">Login</a></p>
            </div>
        </form>
    </div>
</section>

</body>
</html>
