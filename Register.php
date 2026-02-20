<?php
include "db.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $emri = trim($_POST['emri']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $check = $conn->prepare("SELECT id FROM users WHERE email = :email");
    $check->execute([":email" => $email]);

    if ($check->fetch()) {
        $error = "Ky email ekziston!";
    } else {

        $stmt = $conn->prepare(
            "INSERT INTO users (emri, email, password, role)
             VALUES (:emri, :email, :password, 'user')"
        );

        $stmt->execute([
            ":emri" => $emri,
            ":email" => $email,
            ":password" => password_hash($password, PASSWORD_DEFAULT)
        ]);

        header("Location: login.php");
        exit;
    }
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

            <?php if (!empty($error)) echo "<p style='color:red;text-align:center;'>$error</p>"; ?>

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