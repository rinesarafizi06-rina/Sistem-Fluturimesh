<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=:email");
    $stmt->execute([":email" => $_POST['email']]);
    $user = $stmt->fetch();

    if ($user && password_verify($_POST['password'], $user['password'])) {

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['emri'] = $user['emri'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] === 'admin') {
            header("Location: admin/dashboard.php");
        } else {
            header("Location: users.php"); 
        }
        exit;

    } else {
        $error = "Email ose password gabim!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<link rel="stylesheet" href="login.css">
</head>
<body>

<section>
    <div class="login-box">
        <form method="POST">
            <h2>Login</h2>

            <?php if (isset($error)) echo "<p style='color:red; text-align:center; margin-bottom:10px;'>$error</p>"; ?>

            <div class="input-box">
                <input type="email" name="email" required>
                <label>Email</label>
                <span class="icon"><ion-icon name="mail"></ion-icon></span>
            </div>

            <div class="input-box">
                <input type="password" name="password" required>
                <label>Password</label>
                <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
            </div>

            <div class="remember-forgot">
                <label><input type="checkbox"> Remember me</label>
                <a href="#">Forgot Password?</a>
            </div>

            <button type="submit">Login</button>

            <div class="register-link">
                <p>Don't have an account? <a href="register.php">Register</a></p>
            </div>
        </form>
    </div>
</section>

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src ="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>
</html>
