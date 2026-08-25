<?php

require_once "includes/auth.php";
require_once "includes/connection.php";

/*=========================
    CHECK SERVICE ID
=========================*/

if(!isset($_GET['id']) || !is_numeric($_GET['id'])){

    header("Location: services.php");
    exit();

}

$id = (int)$_GET['id'];

/*=========================
    FETCH SERVICE
=========================*/

$stmt = $conn->prepare("SELECT * FROM services WHERE service_id = ?");
$stmt->bind_param("i",$id);
$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows == 0){

    header("Location: services.php");
    exit();

}

$service = $result->fetch_assoc();

$message = "";
$messageType = "";

/*=========================
    UPDATE SERVICE
=========================*/

if(isset($_POST['update'])){

    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $icon = trim($_POST['icon']);
    $status = $_POST['status'];

    if($title=="" || $description=="" || $icon==""){

        $message = "Please fill in all required fields.";
        $messageType = "error";

    }else{

        $update = $conn->prepare("
            UPDATE services
            SET
                title=?,
                description=?,
                icon=?,
                status=?
            WHERE service_id=?
        ");

        $update->bind_param(
            "ssssi",
            $title,
            $description,
            $icon,
            $status,
            $id
        );

        if($update->execute()){

            header("Location: services.php?updated=1");
            exit();

        }else{

            $message = "Unable to update service.";
            $messageType = "error";

        }

    }

}

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Edit Service | Spriaccs CMS</title>

<link rel="stylesheet" href="assets/css/admin.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<style>
/* Custom rounded pastel icon styles matching add-service page */
.selected-icon {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 15px;
}

.selected-preview {
    width: 60px;
    height: 60px;
    background: #f0f4ec;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #003B95;
    font-size: 1.4rem;
}

.icon-gallery {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(50px, 1fr));
    gap: 15px;
    background: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    border: 1px solid #ddd;
    margin-bottom: 25px;
}

.icon-gallery i {
    width: 45px;
    height: 45px;
    background: #f0f4ec;
    color: #2c3e50;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
    cursor: pointer;
    transition: all 0.2s ease;
}

.icon-gallery i:hover, 
.icon-gallery i.active {
    background: #d8e6d1;
    color: #003B95;
    transform: scale(1.1);
    box-shadow: 0 4px 8px rgba(0,0,0,0.05);
}
</style>

</head>

<body>

<?php include "includes/sidebar.php"; ?>

<div class="main-content">

<?php include "includes/topbar.php"; ?>

<div class="dashboard">

<!--=========================
    PAGE HEADER
==========================-->

<div class="page-header">

<div>

<h1>Edit Service</h1>

<p>Update an existing service on your website.</p>

</div>

<a href="services.php" class="add-btn">

<i class="fas fa-arrow-left"></i>

Back to Services

</a>

</div>

<!--=========================
    ALERT
==========================-->

<?php if($message!=""){ ?>

<div class="alert <?php echo $messageType; ?>">

<?php echo $message; ?>

</div>

<?php } ?>

<!--=========================
    FORM
==========================-->

<form class="admin-form" method="POST">

<div class="form-grid">

<div>

<label>Service Title</label>

<input
type="text"
name="title"
value="<?php echo htmlspecialchars($service['title']); ?>"
required>

</div>

<div>

<label>Status</label>

<select name="status">

<option
value="Active"
<?php if($service['status']=="Active") echo "selected"; ?>>

Active

</option>

<option
value="Inactive"
<?php if($service['status']=="Inactive") echo "selected"; ?>>

Inactive

</option>

</select>

</div>

</div>

<label>Description</label>

<textarea
name="description"
rows="6"
maxlength="250"
id="description"
required><?php echo htmlspecialchars($service['description']); ?></textarea>

<small id="counter">

<?php echo strlen($service['description']); ?> / 250 characters

</small>

<label>Selected Icon</label>

<div class="selected-icon">

    <div class="selected-preview">

        <img id="previewIconImg" src="" alt="" style="display:none;">
        <i id="previewIcon" class="<?php echo htmlspecialchars($service['icon']); ?>"></i>

    </div>

    <span id="selectedText">

        <?php 
            // Convert icon class to human-readable text for initial load
            $iconNameClean = ucwords(str_replace(['fas fa-', '-'], ['', ' '], $service['icon']));
            echo $iconNameClean;
        ?>

    </span>

</div>

<input
type="hidden"
id="icon"
name="icon"
value="<?php echo htmlspecialchars($service['icon']); ?>">

<label>Choose an Icon</label>

<div class="icon-gallery">

<i class="fas fa-pen-ruler" data-name="Pen Ruler"></i>

<i class="fas fa-palette" data-name="Palette"></i>

<i class="fas fa-laptop-code" data-name="Laptop Code"></i>

<i class="fas fa-mobile-screen-button" data-name="Mobile"></i>

<i class="fas fa-chart-line" data-name="Analytics"></i>

<i class="fas fa-lightbulb" data-name="Ideas"></i>

<i class="fas fa-bullhorn" data-name="Marketing"></i>

<i class="fas fa-code" data-name="Development"></i>

<i class="fas fa-print" data-name="Printing"></i>

<i class="fas fa-camera" data-name="Photography"></i>

<i class="fas fa-globe" data-name="Website"></i>

<i class="fas fa-layer-group" data-name="Branding"></i>

</div>

<div class="form-buttons">

<button
type="submit"
class="save-btn"
name="update">

<i class="fas fa-save"></i>

Update Service

</button>

<a
href="services.php"
class="cancel-btn">

Cancel

</a>

</div>

</form>

</div>

</div>

<script src="assets/js/admin.js"></script>

<script>

/*==================================
    DESCRIPTION COUNTER
==================================*/

const description = document.getElementById("description");
const counter = document.getElementById("counter");

description.addEventListener("input",function(){

    counter.innerHTML = this.value.length + " / 250 characters";

});

/*==================================
    ICON PICKER
==================================*/

const icons = document.querySelectorAll(".icon-gallery i");
const iconInput = document.getElementById("icon");
const preview = document.getElementById("previewIcon");
const selectedText = document.getElementById("selectedText");

// Highlight active icon on load based on database value
icons.forEach(function(icon){
    if(icon.className === iconInput.value){
        icon.classList.add("active");
    }

    icon.addEventListener("click",function(){
        icons.forEach(i=>i.classList.remove("active"));
        this.classList.add("active");

        const className = this.getAttribute("class").replace(" active", "").trim();
        iconInput.value = className;
        preview.className = className;
        selectedText.textContent = this.getAttribute("data-name");
    });
});

</script>

</body>

</html>