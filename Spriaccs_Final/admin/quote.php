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
        FROM quote
        WHERE
        full_name LIKE CONCAT('%', ?, '%')
        OR email LIKE CONCAT('%', ?, '%')
        OR phone LIKE CONCAT('%', ?, '%')
        ORDER BY created_at DESC
    ");

    $stmt->bind_param(
        "sss",
        $search,
        $search,
        $search
    );

}else{

    $stmt = $conn->prepare("
        SELECT *
        FROM quote
        ORDER BY created_at DESC
    ");

}

$stmt->execute();

$result = $stmt->get_result();

/*==================================
        STATISTICS
==================================*/

$totalEnquiries = $conn
->query("SELECT COUNT(*) AS total FROM quote")
->fetch_assoc()['total'];

$unreadEnquiries = $conn
->query("
SELECT COUNT(*) AS total
FROM quote
WHERE status='Unread'
")
->fetch_assoc()['total'];

$readEnquiries = $conn
->query("
SELECT COUNT(*) AS total
FROM quote
WHERE status='Read'
")
->fetch_assoc()['total'];

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Customer Enquiries | Spriaccs CMS</title>

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

<!--==================================
        PAGE HEADER
===================================-->

<div class="page-header">

    <div>

        <h1>Customer Enquiries</h1>

        <p>

            Manage customer enquiries submitted through your Spriaccs website.

        </p>

    </div>

    <a href="export-quote.php" class="add-btn">

        <i class="fas fa-download"></i>

        Export CSV

    </a>

</div>

<!--==================================
        SEARCH
===================================-->

<form
class="search-bar"
method="GET">

<input

type="text"

name="search"

placeholder="Search enquiries..."

value="<?php echo htmlspecialchars($search); ?>">

<button type="submit">

<i class="fas fa-search"></i>

</button>

</form>

<!--==================================
        STATISTICS
===================================-->

<div class="stats-grid">

<div class="stat-card">

<div class="stat-icon">

<i class="fas fa-envelope-open-text"></i>

</div>

<div>

<h2>

<?php echo $totalEnquiries; ?>

</h2>

<p>Total Enquiries</p>

</div>

</div>

<div class="stat-card">

<div class="stat-icon">

<i class="fas fa-envelope"></i>

</div>

<div>

<h2>

<?php echo $unreadEnquiries; ?>

</h2>

<p>Unread</p>

</div>

</div>

<div class="stat-card">

<div class="stat-icon">

<i class="fas fa-envelope-open"></i>

</div>

<div>

<h2>

<?php echo $readEnquiries; ?>

</h2>

<p>Read</p>

</div>

</div>

</div>

<!--==================================
        SUCCESS MESSAGES
===================================-->

<?php if(isset($_GET['deleted'])){ ?>

<div class="success-message">

<i class="fas fa-circle-check"></i>

Enquiry deleted successfully.

</div>

<?php } ?>

<?php if(isset($_GET['bulkdeleted'])){ ?>

<div class="success-message">

<i class="fas fa-circle-check"></i>

Selected enquiries deleted successfully.

</div>

<?php } ?>

<!--==================================
        BULK DELETE FORM
===================================-->

<form
method="POST"
action="bulk-delete-quote.php"
id="bulkForm">

<div
style="display:flex;
justify-content:flex-end;
margin-bottom:20px;">

<button

type="submit"

class="bulk-delete-btn"

onclick="return confirm('Delete selected enquiries?')">

<i class="fas fa-trash"></i>

Delete Selected

</button>

</div>

<div class="table-container">

<table>

<thead>

<tr>

<th width="45">

<input
type="checkbox"
id="selectAll">

</th>

<th>Name</th>

<th>Email</th>

<th>Phone</th>

<th>Status</th>

<th>Date</th>

<th width="130">

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

class="quote-check"

name="selected[]"

value="<?php echo $row['message_id']; ?>">

</td>

<td>

<strong>

<?php echo htmlspecialchars($row['full_name']); ?>

</strong>

</td>

<td>

<?php echo htmlspecialchars($row['email']); ?>

</td>

<td>

<?php echo htmlspecialchars($row['phone']); ?>

</td>

<td>

<?php if($row['status']=="Unread"){ ?>

<span class="status-badge unread">

<i class="fas fa-circle"></i>

Unread

</span>

<?php }else{ ?>

<span class="status-badge active">

<i class="fas fa-circle"></i>

Read

</span>

<?php } ?>

</td>

<td>

<?php echo date("d M Y",strtotime($row['created_at'])); ?>

</td>

<td>

<a

href="view-quote.php?id=<?php echo $row['message_id']; ?>"

class="edit-btn"

title="View Enquiry">

<i class="fas fa-eye"></i>

</a>

<a

href="delete-quote.php?id=<?php echo $row['message_id']; ?>"

class="delete-btn"

title="Delete Enquiry"

onclick="return confirm('Delete this enquiry?')">

<i class="fas fa-trash"></i>

</a>

</td>

</tr>

<?php

}

}else{

?>

<tr>

<td colspan="7" style="padding:60px;text-align:center;">

<i

class="fas fa-envelope-open-text"

style="font-size:60px;color:#d8d8d8;"></i>

<br><br>

No customer enquiries found.

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

/*=========================
SELECT ALL
=========================*/

const selectAll = document.getElementById("selectAll");

if(selectAll){

    selectAll.addEventListener("change",function(){

        document.querySelectorAll(".quote-check").forEach(function(box){

            box.checked = selectAll.checked;

        });

    });

}

/*=========================
LIVE SEARCH
=========================*/

const searchInput = document.querySelector('input[name="search"]');

if(searchInput){

    searchInput.addEventListener("keyup",function(){

        let value = this.value.toLowerCase();

        document.querySelectorAll("tbody tr").forEach(function(row){

            row.style.display = row.innerText.toLowerCase().includes(value)

            ? ""

            : "none";

        });

    });

}

</script>

</body>

</html>