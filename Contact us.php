<?php
include 'db.php'; 

$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (:name, :email, :message)");
    $stmt->execute([
        ':name' => $name,
        ':email' => $email,
        ':message' => $message
    ]);

    $success = "Mesazhi u ruajt me sukses!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact Us</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
* {
    font-family: 'Poppins', sans-serif;
    box-sizing: border-box;
}

body {
    margin: 0;
    padding: 0;
    background: linear-gradient(135deg, #1e1e1e, #283e51);
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

.contact-container {
    background-color: #fff;
    padding: 40px 35px;
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    width: 420px;
}

.back-arrow {
    text-decoration: none;
    font-size: 28px;
    color: #2b3437;
    display: inline-block;
    margin-bottom: 20px;
}

.back-arrow:hover {
    color: #607d8b;
}

.contact-container h2 {
    text-align: center;
    margin-bottom: 25px;
    font-weight: 600;
    color: #2c3e50;
}

.contact-container input,
.contact-container textarea {
    width: 100%;
    padding: 14px;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 14px;
    margin-bottom: 15px;
}

.contact-container input:focus,
.contact-container textarea:focus {
    outline: none;
    border-color: #f44336;
    box-shadow: 0 0 5px rgba(255, 60, 0, 0.5);
}

.contact-container textarea {
    min-height: 120px;
    resize: vertical;
}

.contact-container button {
    width: 100%;
    padding: 14px;
    background-color: #f44336;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
    transition: 0.3s;
}

.contact-container button:hover {
    background-color: #e78c47;
}

.alert {
    background: #d4edda;
    color: #155724;
    padding: 10px;
    border-radius: 6px;
    margin-bottom: 15px;
    text-align: center;
}
</style>
</head>
<body>

<div class="contact-container">
    <a href="FirstPage.php" class="back-arrow">&#8592;</a>
    <h2>Contact Us</h2>

    <?php if($success): ?>
        <div class="alert"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <form method="POST" action="contact-us.php">
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="email" name="email" placeholder="Your Email" required>
        <textarea name="message" placeholder="Your Message" required></textarea>
        <button type="submit" name="contact_submit">Send Message</button>
    </form>
</div>

</body>
</html>
