<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$success = "";

if($_SERVER['REQUEST_METHOD'] === 'POST' 
    && isset($_POST['feedback_submit']) 
    && $_SESSION['role'] === 'user'){

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $service = $_POST['service'];
    $rating = $_POST['rating'];
    $comment = trim($_POST['comment']);

    if($name && $email && $service && $rating && $comment){

        $stmt = $conn->prepare("
            INSERT INTO feedback (user_id,name,email,service,rating,comment) 
            VALUES (:user_id,:name,:email,:service,:rating,:comment)
        ");

        $stmt->execute([
            ':user_id'=>$_SESSION['user_id'],
            ':name'=>$name,
            ':email'=>$email,
            ':service'=>$service,
            ':rating'=>$rating,
            ':comment'=>$comment
        ]);

        $success = "Your feedback has been successfully submitted!";
    }
}

if(isset($_GET['delete']) && $_SESSION['role'] === 'admin'){
    $stmt = $conn->prepare("DELETE FROM feedback WHERE id=:id");
    $stmt->execute([':id'=>$_GET['delete']]);
    header("Location: about.php");
    exit();
}

$feedbacks = $conn->query("
    SELECT * FROM feedback 
    ORDER BY id DESC
")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>About Us</title>
<style> * {box-sizing:border-box; margin:0; padding:0; font-family:'Poppins',sans-serif;} body {background: linear-gradient(135deg,#1e1e1e,#283e51); padding:20px; display:flex; justify-content:center;} 
.container {background:#fff; max-width:900px; width:100%; border-radius:15px; padding:30px; box-shadow:0 10px 25px rgba(0,0,0,0.2);} 
h1,h2 {text-align:center; margin-bottom:20px; color:#2c3e50;} 
p {color:#444; text-align:justify; margin-bottom:30px;} 
form input, form select, form textarea, form button { width:100%; padding:12px; margin-bottom:15px; border-radius:8px; border:1px solid #ccc; font-size:14px; } 
form input:focus, form select:focus, form textarea:focus {border-color:#f44336; outline:none; box-shadow:0 0 8px rgba(244,67,54,0.4);} 
form textarea {min-height:120px; resize:vertical;} 
form button {background:#f44336;color:#fff;border:none; font-size:16px; border-radius:8px; cursor:pointer; transition:0.3s;} 
form button:hover {background:#e78c47;} .alert {background:#d4edda;color:#155724;padding:12px;border-radius:8px;margin-bottom:15px;text-align:center; box-shadow:0 4px 10px rgba(0,0,0,0.1);} table {width:100%; border-collapse:collapse; margin-top:25px; border-radius:10px; overflow:hidden; box-shadow:0 4px 10px rgba(0,0,0,0.08);} th,td {padding:14px; text-align:left;} th {background:#2b3437;color:#fff;} 
tr:nth-child(even){background:#fff0f0;}
 tr:hover{background:#ffd6d1;} 
 </style>



</head>
<body>

<div class="container">

<h1>About Us</h1>
<p>We are committed to providing high-quality travel services.</p>

<h2>Submit Feedback</h2>

<?php if($success): ?>
<div class="alert"><?= htmlspecialchars($success) ?></div>
<?php endif; ?>

<?php if($_SESSION['role'] === 'user'): ?>
<form method="POST">
<input type="text" name="name" placeholder="Your Name" required>
<input type="email" name="email" placeholder="Your Email" required>

<select name="service" required>
<option value="">Select Service</option>
<option>Flight Booking</option>
<option>Vacation Package</option>
<option>Customer Support</option>
</select>

<select name="rating" required>
<option value="">Select Rating</option>
<option value="5">5 - Excellent</option>
<option value="4">4 - Very Good</option>
<option value="3">3 - Good</option>
<option value="2">2 - Fair</option>
<option value="1">1 - Poor</option>
</select>

<textarea name="comment" placeholder="Your Comment" required></textarea>

<button type="submit" name="feedback_submit">
Submit Feedback
</button>
</form>
<?php endif; ?>

<h2>Client Feedback</h2>

<table>
<thead>
<tr>
<th>Name</th>
<th>Service</th>
<th>Rating</th>
<th>Comment</th>
<?php if($_SESSION['role'] === 'admin'): ?>
<th>Action</th>
<?php endif; ?>
</tr>
</thead>

<tbody>
<?php foreach($feedbacks as $f): ?>
<tr>
<td><?= htmlspecialchars($f['name']) ?></td>
<td><?= htmlspecialchars($f['service']) ?></td>
<td><?= htmlspecialchars($f['rating']) ?></td>
<td><?= htmlspecialchars($f['comment']) ?></td>

<?php if($_SESSION['role'] === 'admin'): ?>
<td>
<a href="about-us.php?delete=<?= $f['id'] ?>" 
   onclick="return confirm('Delete this feedback?')">
   <button>Delete</button>
</a>
</td>
<?php endif; ?>

</tr>
<?php endforeach; ?>
</tbody>
</table>

</div>
</body>
</html>  