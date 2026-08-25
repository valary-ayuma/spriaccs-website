<?php

require_once "includes/auth.php";
require_once "includes/connection.php";

$message = "";
$messageType = "";

if(isset($_POST['save'])){

    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $icon = trim($_POST['icon']);
    $status = $_POST['status'];

    if($title == "" || $description == "" || $icon == ""){

        $message = "Please fill in all required fields.";
        $messageType = "error";

    }else{

        $stmt = $conn->prepare("INSERT INTO services(title,description,icon,status) VALUES(?,?,?,?)");
        $stmt->bind_param("ssss",$title,$description,$icon,$status);

        if($stmt->execute()){

            header("Location: services.php?success=1");
            exit();

        }else{

            $message = "Unable to save service.";
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

<title>Add Service | Spriaccs CMS</title>

<link rel="stylesheet" href="assets/css/admin.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<style>
/* Custom style to make icon preview and gallery items match the rounded pastel style */
.selected-icon {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 15px;
}

.selected-preview {
    width: 60px;
    height: 60px;
    background: #f0f4ec; /* Soft pastel tint matching screenshot 2 */
    border-radius: 50%;   /* Fully rounded circle */
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
    background: #f0f4ec; /* Soft rounded background for each picker option */
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

<div class="page-header">

<div>

<h1>Add Service</h1>

<p>Create a new service that will appear on your website.</p>

</div>

<a href="services.php" class="add-btn">

<i class="fas fa-arrow-left"></i>

Back to Services

</a>

</div>

<?php if($message!=""){ ?>

<div class="alert <?php echo $messageType; ?>">

<?php echo $message; ?>

</div>

<?php } ?>

<form class="admin-form" method="POST">

<div class="form-grid">

<div>

<label>Service Title</label>

<input
type="text"
name="title"
placeholder="Website Design"
required>

</div>

<div>

<label>Status</label>

<select name="status">

<option value="Active">Active</option>

<option value="Inactive">Inactive</option>

</select>

</div>

</div>

<label>Description</label>

<textarea
name="description"
rows="6"
maxlength="250"
id="description"
required></textarea>

<small id="counter">0 / 250 characters</small>

<label>Selected Icon</label>

<div class="selected-icon">

    <div class="selected-preview">

        <i id="previewIcon" class="fas fa-pen-ruler"></i>

    </div>

    <span id="selectedText">

        Pen Ruler

    </span>

</div>

<input
type="hidden"
id="icon"
name="icon"
value="fas fa-pen-ruler">

<label>Choose an Icon</label>

<div class="icon-gallery">

<i class="fas fa-pen-ruler active" data-name="Pen Ruler"></i>

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

<button type="submit" class="save-btn" name="save">

<i class="fas fa-save"></i>

Save Service

</button>

<a href="services.php" class="cancel-btn">

Cancel

</a>

</div>

</form>

</div>

</div>

<script src="assets/js/admin.js"></script>
<script src="assets/js/service.js"></script>

</body>

</html>