<?php

require_once "includes/auth.php";
require_once "includes/connection.php";

/*==================================
        VALIDATE ID
==================================*/

if(!isset($_GET['id']) || !is_numeric($_GET['id'])){

    header("Location: quote.php");
    exit();

}

$id = (int)$_GET['id'];

/*==================================
        MARK AS READ
==================================*/

$stmt = $conn->prepare("
UPDATE quote
SET status='Read'
WHERE message_id=?
");

$stmt->bind_param("i",$id);

$stmt->execute();

/*==================================
        FETCH ENQUIRY
==================================*/

$stmt = $conn->prepare("
SELECT *
FROM quote
WHERE message_id=?
");

$stmt->bind_param("i",$id);

$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows==0){

    header("Location: quote.php");

    exit();

}

$quote = $result->fetch_assoc();

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>

View Enquiry

</title>

<link rel="stylesheet"
href="assets/css/admin.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

</head>

<body>

<?php include "includes/sidebar.php"; ?>

<div class="main-content">

<?php include "includes/topbar.php"; ?>

<div class="dashboard">

<div class="page-header">

<div>

<h1>

Customer Enquiry

</h1>

<p>

View enquiry details.

</p>

</div>

<a
href="quote.php"
class="add-btn">

<i class="fas fa-arrow-left"></i>

Back

</a>

</div>

<div class="details-card">

<div class="details-header">

<div class="details-avatar">

<i class="fas fa-user"></i>

</div>

<div>

<h2>

<?php echo htmlspecialchars($quote['full_name']); ?>

</h2>

<p>

Received

<?php echo date("d M Y",strtotime($quote['created_at'])); ?>

</p>

</div>

</div>

<hr>

<div class="details-grid">

<div>

<label>Email</label>

<p>

<?php echo htmlspecialchars($quote['email']); ?>

</p>

</div>

<div>

<label>Phone</label>

<p>

<?php echo htmlspecialchars($quote['phone']); ?>

</p>

</div>

<div>

<label>Status</label>

<p>

<span class="status-badge active">

<i class="fas fa-circle"></i>

<?php echo htmlspecialchars($quote['status']); ?>

</span>

</p>

</div>

<div>

<label>Date Submitted</label>

<p>

<?php echo date("d M Y H:i",strtotime($quote['created_at'])); ?>

</p>

</div>

</div>

<hr>

<h3>

Message

</h3>

<div class="message-box">

<?php echo nl2br(htmlspecialchars($quote['message'])); ?>

</div>

<div class="details-actions">

<a
href="quote.php"
class="add-btn">

<i class="fas fa-arrow-left"></i>

Back

</a>

<a
href="delete-quote.php?id=<?php echo $quote['message_id']; ?>"
class="delete-btn"
onclick="return confirm('Delete this enquiry?')">

<i class="fas fa-trash"></i>

Delete

</a>

</div>

</div>

</div>

</div>

<script src="assets/js/admin.js"></script>

</body>

</html>