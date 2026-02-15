<?php
include 'db.php';

$success = "";

if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['contact_submit'])){
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    if($name && $email && $message){
        $stmt = $conn->prepare("INSERT INTO contact_messages (name,email,message) VALUES (:name,:email,:message)");
        $stmt->execute([
            ':name'=>$name,
            ':email'=>$email,
            ':message'=>$message
        ]);
        $success = "Mesazhi u ruajt me sukses!";
    }
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
* { box-sizing: border-box; margin:0; padding:0; font-family: 'Poppins', sans-serif; }
body {
    background: linear-gradient(135deg, #1e1e1e, #283e51);
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    padding: 20px;
}
.contact-container {
    background: #fff;
    padding: 40px 35px;
    border-radius: 15px;
    width: 100%;
    max-width: 450px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    position: relative;
    transition: transform 0.3s;
}
.contact-container:hover { transform: translateY(-5px); }
.contact-container h2 {
    text-align: center;
    margin-bottom: 25px;
    color: #2c3e50;
}
.contact-container input,
.contact-container textarea {
    width: 100%;
    padding: 15px;
    margin-bottom: 15px;
    border-radius: 10px;
    border: 1px solid #ccc;
    font-size: 14px;
    transition: all 0.3s;
}
.contact-container input:focus,
.contact-container textarea:focus {
    border-color: #f44336;
    box-shadow: 0 0 8px rgba(244,67,54,0.4);
    outline: none;
}
.contact-container textarea { min-height: 120px; resize: vertical; }
.contact-container button {
    width: 100%;
    padding: 15px;
    background: #f44336;
    color: #fff;
    border: none;
    font-size: 16px;
    border-radius: 10px;
    cursor: pointer;
    transition: background 0.3s, transform 0.2s;
}
.contact-container button:hover {
    background: #e78c47;
    transform: scale(1.03);
}
.alert {
    background: #d4edda;
    color: #155724;
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 20px;
    text-align: center;
    font-weight: 500;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}
</style>
</head>
<body>

<div class="contact-container">
    <h2>Contact Us</h2>

    <?php if($success): ?>
        <div class="alert"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="email" name="email" placeholder="Your Email" required>
        <textarea name="message" placeholder="Your Message" required></textarea>
        <button type="submit" name="contact_submit">Send Message</button>
    </form>
</div>

</body>
</html>

