<?php

require_once "includes/auth.php";
require_once "includes/connection.php";

/*==================================
        SEARCH
==================================*/

$search = "";

if(isset($_GET['search']) && trim($_GET['search']) != ""){

    $search = trim($_GET['search']);

    $stmt = $conn->prepare("
        SELECT *
        FROM newsletter
        WHERE email LIKE CONCAT('%', ?, '%')
        ORDER BY created_at DESC
    ");

    $stmt->bind_param("s",$search);

}else{

    $stmt = $conn->prepare("
        SELECT *
        FROM newsletter
        ORDER BY created_at DESC
    ");

}

$stmt->execute();

$result = $stmt->get_result();

/*==================================
        TOTAL SUBSCRIBERS
==================================*/

$totalSubscribers = $conn
->query("SELECT COUNT(*) AS total FROM newsletter")
->fetch_assoc()['total'];

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Newsletter | Spriaccs CMS</title>

<link rel="stylesheet" href="assets/css/admin.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

</head>

<body>

<?php include "includes/sidebar.php"; ?>

<div class="main-content">

<?php include "includes/topbar.php"; ?>

<div class="dashboard">

<!-- =========================
        PAGE HEADER
========================= -->

<div class="page-header">

<div>

<h1>Newsletter</h1>

<p>

Manage your newsletter subscribers.

</p>

</div>

<div style="display:flex;gap:12px;">

<a href="export-newsletter.php" class="add-btn">

<i class="fas fa-download"></i>

Export CSV

</a>

</div>

</div>

<!-- =========================
        SEARCH
========================= -->

<form class="search-bar" method="GET">

<input
type="text"
name="search"
placeholder="Search subscribers..."
value="<?php echo htmlspecialchars($search); ?>">

<button type="submit">

<i class="fas fa-search"></i>

</button>

</form>

<!-- =========================
        STATS
========================= -->

<div class="stats-grid">

<div class="stat-card">

<div class="stat-icon">

<i class="fas fa-envelope-open-text"></i>

</div>

<div>

<h2><?php echo $totalSubscribers; ?></h2>

<p>Total Subscribers</p>

</div>

</div>

</div>

<!-- SUCCESS -->

<?php if(isset($_GET['deleted'])){ ?>

<div class="success-message">

<i class="fas fa-circle-check"></i>

Subscriber deleted successfully.

</div>

<?php } ?>

<?php if(isset($_GET['bulkdeleted'])){ ?>

<div class="success-message">

<i class="fas fa-circle-check"></i>

Selected subscribers deleted successfully.

</div>

<?php } ?>

<!-- =========================
        BULK DELETE FORM
========================= -->

<form
method="POST"
action="bulk-delete-newsletter.php"
id="bulkForm">

<div style="margin-bottom:15px;display:flex;justify-content:flex-end;">

<button
type="submit"
class="bulk-delete-btn"
onclick="return confirm('Delete selected subscribers?')">

<i class="fas fa-trash"></i>

Delete Selected

</button>

</div>

<div class="table-container">

<table>

<thead>

<tr>

<th width="50">

<input type="checkbox" id="selectAll">

</th>

<th>Email Address</th>

<th>Status</th>

<th>Date Joined</th>

<th width="110">

Actions

</th>

</tr>

</thead>

<tbody>

<?php

if($result->num_rows > 0){

while($row = $result->fetch_assoc()){

?>

<tr>

<td>

<input

type="checkbox"

class="subscriber-check"

name="selected[]"

value="<?php echo $row['subscriber_id']; ?>">

</td>

<td>

<strong>

<?php echo htmlspecialchars($row['email']); ?>

</strong>

</td>

<td>

<?php if($row['status']=="Active"){ ?>

<span class="status-badge active">

<i class="fas fa-circle"></i>

Active

</span>

<?php }else{ ?>

<span class="status-badge inactive">

<i class="fas fa-circle"></i>

Unsubscribed

</span>

<?php } ?>

</td>

<td>

<?php echo date("d M Y",strtotime($row['created_at'])); ?>

</td>

<td>

<a

href="delete-newsletter.php?id=<?php echo $row['subscriber_id']; ?>"

class="delete-btn"

onclick="return confirm('Delete this subscriber?')">

<i class="fas fa-trash"></i>

</a>

</td>

</tr>

<?php

}

}else{

?>

<tr>

<td colspan="5" style="padding:60px;text-align:center;">

<i

class="fas fa-envelope-open-text"

style="font-size:65px;color:#d8d8d8;"></i>

<br><br>

No subscribers found.

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</form>

</div>

</div>

<script src="assets/js/admin.js"></script>

<script>

const selectAll=document.getElementById("selectAll");

if(selectAll){

selectAll.addEventListener("change",function(){

document.querySelectorAll(".subscriber-check").forEach(function(box){

box.checked=selectAll.checked;

});

});

}

</script>

</body>

</html>