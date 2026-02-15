<?php
session_start();
include 'db.php';

if (!isset($_SESSION['role'])) {
    header("Location: login.php");
    exit;
}

$role = $_SESSION['role']; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $role === 'user') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $service = $_POST['service'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    $stmt = $conn->prepare("INSERT INTO feedback (name, email, service, rating, comment) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$name, $email, $service, $rating, $comment]);

    header("Location: about-us.php");
    exit;
}

if (isset($_GET['delete']) && $role === 'admin') {
    $id = intval($_GET['delete']);
    $stmt = $conn->prepare("DELETE FROM feedback WHERE id=?");
    $stmt->execute([$id]);
    header("Location: about-us.php");
    exit;
}

$stmt = $conn->query("SELECT * FROM feedback ORDER BY id DESC");
$feedbacks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>About Us</title>
<style>
body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: linear-gradient(135deg,#1e1e1e,#283e51);}
.container { max-width:1000px; margin:50px auto; padding:30px; background:#fff; border-radius:15px; box-shadow:0 8px 20px rgba(0,0,0,0.15);}
h1,h2 { text-align:center; color:#2c3e50; }
p { text-align: justify; color: #444; }
.back-arrow { font-size:26px; text-decoration:none; color:#2b3437; display:inline-block; margin-bottom:20px;}
.back-arrow:hover { color:#607d8b; }
.features-list { list-style:none; padding:0; margin:25px 0 40px 0; }
.features-list li { background:#fff0f0; padding:14px 15px 14px 40px; margin-bottom:12px; border-radius:10px; box-shadow:0 4px 8px rgba(0,0,0,0.06); position:relative; font-size:15px;}
.features-list li::before { content:"✔"; position:absolute; left:15px; color:#f44336; font-weight:bold; }
.feedback-form { margin-top:30px; display:flex; flex-direction:column; gap:18px; padding:25px; background:#fafafa; border-radius:12px; box-shadow:0 6px 15px rgba(0,0,0,0.1);}
.feedback-form label { font-weight:bold;}
.feedback-form input, .feedback-form textarea, .feedback-form select { padding:12px; border-radius:8px; border:1px solid #ccc; font-size:14px;}
.feedback-form textarea { min-height:120px; resize:vertical;}
.feedback-form button { padding:12px; background:#f44336; color:#fff; border:none; border-radius:8px; font-size:16px; cursor:pointer; transition:0.3s;}
.feedback-form button:hover { background:#e78c47;}
table { width:100%; border-collapse:collapse; margin-top:30px; border-radius:10px; overflow:hidden; box-shadow:0 4px 10px rgba(0,0,0,0.08);}
th,td { padding:14px; text-align:left;}
th { background:#2b3437; color:#fff;}
tr:nth-child(even) { background:#fff0f0; }
tr:hover { background:#ffd6d1; }
.delete-btn { color:red; text-decoration:none; font-weight:bold; }
</style>
</head>
<body>
<div class="container">

<a href="FirstPage.php" class="back-arrow">&#8592;</a>

<h1>About Us</h1>
<p>
Welcome to our page! We are a company dedicated to providing the best services to our clients.
Our goal is to create unique and satisfying experiences for every customer.
Our professionals work with passion and commitment to ensure high-quality service.
</p>

<h2>Why Choose Us</h2>
<ul class="features-list">
    <li>Professional and friendly staff</li>
    <li>Fast and secure booking process</li>
    <li>Affordable prices and special offers</li>
    <li>24/7 customer support</li>
</ul>

<h2>Client Feedback</h2>

<?php if($role === 'user'): ?>
<form class="feedback-form" method="POST">
    <label>Your Name:</label>
    <input type="text" name="name" pattern="[A-Za-z\s]+" title="Only letters and spaces allowed" required>

    <label>Email Address:</label>
    <input type="email" name="email" required>

    <label>Service Used:</label>
    <select name="service" required>
        <option value="">Select a service</option>
        <option>Flight Booking</option>
        <option>Vacation Package</option>
        <option>Customer Support</option>
    </select>

    <label>Rating:</label>
    <select name="rating" required>
        <option value="">Select rating</option>
        <option value="5">5 - Excellent</option>
        <option value="4">4 - Very Good</option>
        <option value="3">3 - Good</option>
        <option value="2">2 - Fair</option>
        <option value="1">1 - Poor</option>
    </select>

    <label>Comment:</label>
    <textarea name="comment" required></textarea>

    <button type="submit">Submit Feedback</button>
</form>
<?php endif; ?>

<table>
    <thead>
        <tr>
            <th>Client Name</th>
            <th>Service</th>
            <th>Rating</th>
            <th>Comment</th>
            <?php if($role === 'admin') echo "<th>Action</th>"; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach($feedbacks as $fb): ?>
        <tr>
            <td><?= htmlspecialchars($fb['name']) ?></td>
            <td><?= htmlspecialchars($fb['service']) ?></td>
            <td><?= $fb['rating'] ?>/5</td>
            <td><?= htmlspecialchars($fb['comment']) ?></td>
            <?php if($role === 'admin'): ?>
            <td><a class="delete-btn" href="about-us.php?delete=<?= $fb['id'] ?>" onclick="return confirm('Delete this feedback?')">Delete</a></td>
            <?php endif; ?>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</div>
</body>
</html>




