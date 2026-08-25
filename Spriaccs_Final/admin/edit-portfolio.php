<?php

require_once "includes/auth.php";
require_once "includes/connection.php";

/*==================================
        GET PROJECT
==================================*/

if(!isset($_GET['id']) || !is_numeric($_GET['id'])){

    header("Location: portfolio.php");
    exit;

}

$id = (int)$_GET['id'];

$stmt = $conn->prepare("
    SELECT *
    FROM portfolio
    WHERE project_id=?
");

$stmt->bind_param("i",$id);

$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows==0){

    header("Location: portfolio.php");
    exit;

}

$project = $result->fetch_assoc();


/*==================================
        UPDATE PROJECT
==================================*/

if(isset($_POST['save'])){

    $title        = trim($_POST['title']);
    $slug         = trim($_POST['slug']);
    $client       = trim($_POST['client']);
    $category     = trim($_POST['category']);
    $projectLink  = trim($_POST['project_link']);
    $description  = trim($_POST['description']);
   

    $image = $project['image'];
   

    /*==============================
            FEATURED IMAGE
    ==============================*/

    if(isset($_FILES['image']) && $_FILES['image']['error']==0){

        $extension = strtolower(pathinfo(
            $_FILES['image']['name'],
            PATHINFO_EXTENSION
        ));

        $image = uniqid().".".$extension;

        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            "../uploads/portfolio/".$image
        );

    }


    $stmt = $conn->prepare("

    UPDATE portfolio SET

        title=?,
        slug=?,
        client=?,
        category=?,
        project_link=?,
        description=?,
        image=?

    WHERE project_id=?

    ");

    $stmt->bind_param(

        "sssssssi",

        $title,
        $slug,
        $client,
        $category,
        $projectLink,
        $description,
        $image,
        $id

    );

    $stmt->execute();

    header("Location: portfolio.php?updated=1");
    exit;

}

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Edit Portfolio Project</title>

<link rel="stylesheet" href="assets/css/admin.css">

<link rel="stylesheet" href="assets/css/settings.css">

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

        <h1>Edit Portfolio Project</h1>

        <p>

            Update your portfolio case study.

        </p>

    </div>

</div>

<form method="POST" enctype="multipart/form-data">
    <!--==================================
        PROJECT INFORMATION
===================================-->

<div class="settings-table">

    <div class="table-title">

        <i class="fas fa-folder-open"></i>

        Project Information

    </div>

    <table class="settings-table-content">

        <tr>

            <td class="setting-name">

                Project Title

            </td>

            <td>

                <input
                type="text"
                name="title"
                id="title"
                value="<?php echo htmlspecialchars($project['title']); ?>"
                required>

            </td>

        </tr>

        <tr>

            <td class="setting-name">

                Slug

            </td>

            <td>

                <input
                type="text"
                name="slug"
                id="slug"
                value="<?php echo htmlspecialchars($project['slug']); ?>"
                required>

            </td>

        </tr>

        <tr>

            <td class="setting-name">

                Client

            </td>

            <td>

                <input
                type="text"
                name="client"
                value="<?php echo htmlspecialchars($project['client']); ?>">

            </td>

        </tr>

        <tr>

            <td class="setting-name">

                Category

            </td>

            <td>

                <select
                name="category"
                id="category"
                required>

                    <option value="Website Design" <?php if($project['category']=="Website Design") echo "selected"; ?>>Website Design</option>

                    <option value="Brand Identity" <?php if($project['category']=="Brand Identity") echo "selected"; ?>>Brand Identity</option>

                    <option value="Graphic Design" <?php if($project['category']=="Graphic Design") echo "selected"; ?>>Graphic Design</option>

                    <option value="Marketing Design" <?php if($project['category']=="Marketing Design") echo "selected"; ?>>Marketing Design</option>

                </select>

            </td>

        </tr>

    </table>

</div>



<!--==================================
        WEBSITE INFORMATION
===================================-->

<div class="settings-table" id="website-section">

    <div class="table-title">

        <i class="fas fa-globe"></i>

        Website Information

    </div>

    <table class="settings-table-content">

        <tr>

            <td class="setting-name">

                Project Link

            </td>

            <td>

                <input
                type="url"
                id="project_link"
                name="project_link"
                value="<?php echo htmlspecialchars($project['project_link']); ?>">

                <small>

                    Only required for Website Design projects.

                </small>

            </td>

        </tr>

    </table>

</div>



<!--==================================
        PROJECT DETAILS
===================================-->

<div class="settings-table">

    <div class="table-title">

        <i class="fas fa-align-left"></i>

        Project Details

    </div>

    <table class="settings-table-content">

        <tr>

            <td class="setting-name">

                Description

            </td>

            <td>

                <textarea
                name="description"
                rows="6"
                required><?php echo htmlspecialchars($project['description']); ?></textarea>

            </td>

        </tr>

        

    </table>

</div>



<!--==================================
        PROJECT IMAGES
===================================-->

<div class="settings-table">

    <div class="table-title">

        <i class="fas fa-image"></i>

        Project Images

    </div>

    <table class="settings-table-content">

        <tr>

            <td class="setting-name">

                Featured Image

            </td>

            <td>

                <?php if(!empty($project['image'])){ ?>

                <img
                src="../uploads/portfolio/<?php echo htmlspecialchars($project['image']); ?>"
                style="width:220px;border-radius:10px;display:block;margin-bottom:15px;">

                <?php } ?>

                <input
                type="file"
                name="image"
                accept="image/*">

            </td>

        </tr>

        

    </table>

</div>



<div style="text-align:right;margin-top:35px;">

    <button
    type="submit"
    name="save"
    class="save-btn">

        <i class="fas fa-save"></i>

        Update Project

    </button>

</div>

</form>

</div>

</div>



<script>

/*==================================
        AUTO SLUG
==================================*/

const title = document.getElementById("title");
const slug = document.getElementById("slug");

title.addEventListener("keyup",function(){

    slug.value=this.value
    .toLowerCase()
    .trim()
    .replace(/[^a-z0-9]+/g,"-")
    .replace(/^-+|-+$/g,"");

});


/*==================================
    SHOW/HIDE WEBSITE SECTION
==================================*/

const category=document.getElementById("category");
const websiteSection=document.getElementById("website-section");
const projectLink=document.getElementById("project_link");

function toggleWebsiteSection(){

    if(category.value==="Website Design"){

        websiteSection.style.display="block";

        projectLink.required=true;

    }else{

        websiteSection.style.display="none";

        projectLink.required=false;

        projectLink.value="";

    }

}

category.addEventListener("change",toggleWebsiteSection);

toggleWebsiteSection();

</script>

<script src="assets/js/admin.js"></script>

</body>

</html>