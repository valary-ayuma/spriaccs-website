<?php

require_once "includes/auth.php";
require_once "includes/connection.php";

/*==================================
        GET PROJECT
==================================*/

if(!isset($_GET['id']) || !is_numeric($_GET['id'])){

    header("Location: portfolio.php");
    exit();

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
    exit();

}

$project = $result->fetch_assoc();

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>

<?php echo htmlspecialchars($project['title']); ?>

| Portfolio Preview

</title>

<link rel="stylesheet"
href="assets/css/admin.css">

<link rel="stylesheet"
href="assets/css/portfolio.css">

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

            <?php echo htmlspecialchars($project['title']); ?>

        </h1>

        <p>

            Portfolio Project Preview

        </p>

    </div>

    <a
    href="portfolio.php"
    class="add-btn">

        <i class="fas fa-arrow-left"></i>

        Back to Portfolio

    </a>

</div>


<!--==================================
        PROJECT SUMMARY
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

                <?php echo htmlspecialchars($project['title']); ?>

            </td>

        </tr>

        <tr>

            <td class="setting-name">

                Client

            </td>

            <td>

                <?php

                echo !empty($project['client'])

                ? htmlspecialchars($project['client'])

                : "Not Specified";

                ?>

            </td>

        </tr>

        <tr>

            <td class="setting-name">

                Category

            </td>

            <td>

                <span class="category-badge">

                    <?php echo htmlspecialchars($project['category']); ?>

                </span>

            </td>

        </tr>

        <tr>

            <td class="setting-name">

                Slug

            </td>

            <td>

                <?php

                echo !empty($project['slug'])

                ? htmlspecialchars($project['slug'])

                : "-";

                ?>

            </td>

        </tr>

        <tr>

            <td class="setting-name">

                Created

            </td>

            <td>

                <?php

                echo date(

                    "d F Y",

                    strtotime($project['created_at'])

                );

                ?>

            </td>

        </tr>

    </table>

</div>

<!--==================================
        FEATURED IMAGE
===================================-->

<div class="settings-table">

    <div class="table-title">

        <i class="fas fa-image"></i>

        Featured Image

    </div>

    <div class="project-preview-image">

        <?php if(!empty($project['image'])){ ?>

            <img
            src="../uploads/portfolio/<?php echo htmlspecialchars($project['image']); ?>"
            alt="<?php echo htmlspecialchars($project['title']); ?>">

        <?php }else{ ?>

            <div class="no-image">

                <i class="fas fa-image"></i>

                <p>No featured image uploaded.</p>

            </div>

        <?php } ?>

    </div>

</div>



<!--==================================
        DESCRIPTION
===================================-->

<div class="settings-table">

    <div class="table-title">

        <i class="fas fa-align-left"></i>

        Project Description

    </div>

    <div class="project-content">

        <?php echo nl2br(htmlspecialchars($project['description'])); ?>

    </div>

</div>



<!--==================================
        SERVICES
===================================-->

<div class="settings-table">

    <div class="table-title">

        <i class="fas fa-briefcase"></i>

        Services Provided

    </div>

    <div class="project-content">

        <?php

        if(!empty($project['services'])){

            $services = explode("\n",$project['services']);

            echo "<ul class='project-list'>";

            foreach($services as $service){

                if(trim($service)!=""){

                    echo "<li>";

                    echo "<i class='fas fa-check-circle'></i>";

                    echo htmlspecialchars(trim($service));

                    echo "</li>";

                }

            }

            echo "</ul>";

        }else{

            echo "<p>No services specified.</p>";

        }

        ?>

    </div>

</div>



<!--==================================
        RESULTS
===================================-->

<div class="settings-table">

    <div class="table-title">

        <i class="fas fa-chart-line"></i>

        Results

    </div>

    <div class="project-content">

        <?php

        if(!empty($project['results'])){

            $results = explode("\n",$project['results']);

            echo "<ul class='project-list success-list'>";

            foreach($results as $result){

                if(trim($result)!=""){

                    echo "<li>";

                    echo "<i class='fas fa-circle-check'></i>";

                    echo htmlspecialchars(trim($result));

                    echo "</li>";

                }

            }

            echo "</ul>";

        }else{

            echo "<p>No results added.</p>";

        }

        ?>

    </div>

</div>



<!--==================================
        GALLERY IMAGE
===================================-->

<div class="settings-table">

    <div class="table-title">

        <i class="fas fa-images"></i>

        Gallery Image

    </div>

    <div class="project-preview-image">

        <?php if(!empty($project['gallery_image'])){ ?>

            <img
            src="../uploads/portfolio/<?php echo htmlspecialchars($project['gallery_image']); ?>"
            alt="Gallery Image">

        <?php }else{ ?>

            <div class="no-image">

                <i class="fas fa-images"></i>

                <p>No gallery image uploaded.</p>

            </div>

        <?php } ?>

    </div>

</div>

<!--==================================
        WEBSITE LINK
===================================-->

<?php
if(
    $project['category']=="Website Design" &&
    !empty($project['project_link'])
){
?>

<div class="settings-table">

    <div class="table-title">

        <i class="fas fa-globe"></i>

        Live Website

    </div>

    <div class="project-content" style="text-align:center;">

        <a
        href="<?php echo htmlspecialchars($project['project_link']); ?>"
        target="_blank"
        class="view-btn"
        style="padding:14px 30px;font-size:1rem;">

            <i class="fas fa-arrow-up-right-from-square"></i>

            Visit Website

        </a>

    </div>

</div>

<?php } ?>


<!--==================================
        RELATED PROJECTS
===================================-->

<?php

$related = $conn->prepare("

SELECT project_id,title,image,category

FROM portfolio

WHERE project_id != ?

ORDER BY created_at DESC

LIMIT 3

");

$related->bind_param("i",$id);

$related->execute();

$relatedResult = $related->get_result();

?>

<div class="settings-table">

    <div class="table-title">

        <i class="fas fa-layer-group"></i>

        More Portfolio Projects

    </div>

    <div class="portfolio-grid">

    <?php

    while($item = $relatedResult->fetch_assoc()){

    ?>

        <div class="portfolio-card">

            <div class="portfolio-image">

                <img
                src="../uploads/portfolio/<?php echo htmlspecialchars($item['image']); ?>"
                alt="<?php echo htmlspecialchars($item['title']); ?>">

            </div>

            <div class="portfolio-content">

                <h3>

                    <?php echo htmlspecialchars($item['title']); ?>

                </h3>

                <span class="category-badge">

                    <?php echo htmlspecialchars($item['category']); ?>

                </span>

                <div class="portfolio-actions"
                     style="margin-top:20px;">

                    <a
                    href="view-project.php?id=<?php echo $item['project_id']; ?>"
                    class="view-btn">

                        <i class="fas fa-eye"></i>

                        View Project

                    </a>

                </div>

            </div>

        </div>

    <?php } ?>

    </div>

</div>


<!--==================================
        PAGE ACTIONS
===================================-->

<div style="display:flex;
            justify-content:space-between;
            margin-top:35px;
            gap:20px;
            flex-wrap:wrap;">

    <a
    href="portfolio.php"
    class="edit-btn"
    style="text-decoration:none;
           padding:14px 25px;">

        <i class="fas fa-arrow-left"></i>

        Back to Portfolio

    </a>

    <a
    href="edit-portfolio.php?id=<?php echo $project['project_id']; ?>"
    class="view-btn"
    style="text-decoration:none;
           padding:14px 25px;">

        <i class="fas fa-pen"></i>

        Edit Project

    </a>

</div>

</div>

</div>

<script src="assets/js/admin.js"></script>

</body>

</html>