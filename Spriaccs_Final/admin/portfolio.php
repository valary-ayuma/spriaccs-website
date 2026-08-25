<?php

require_once "includes/auth.php";
require_once "includes/connection.php";

/*==================================
        SEARCH
==================================*/

$search = "";

if (isset($_GET['search']) && trim($_GET['search']) != "") {

    $search = trim($_GET['search']);

    $stmt = $conn->prepare("
        SELECT *
        FROM portfolio
        WHERE
            title LIKE CONCAT('%', ?, '%')
            OR client LIKE CONCAT('%', ?, '%')
            OR category LIKE CONCAT('%', ?, '%')
        ORDER BY project_id DESC
    ");

    $stmt->bind_param(
        "sss",
        $search,
        $search,
        $search
    );

} else {

    $stmt = $conn->prepare("
        SELECT *
        FROM portfolio
        ORDER BY project_id DESC
    ");

}

$stmt->execute();
$result = $stmt->get_result();


/*==================================
        STATISTICS
==================================*/

$totalProjects = $conn
->query("SELECT COUNT(*) AS total FROM portfolio")
->fetch_assoc()['total'];

$websiteProjects = $conn
->query("
SELECT COUNT(*) AS total
FROM portfolio
WHERE category='Website Design'
")
->fetch_assoc()['total'];

$otherProjects = $totalProjects - $websiteProjects;

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Portfolio | Spriaccs CMS</title>

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

    <!--==========================
            PAGE HEADER
    ===========================-->

    <div class="page-header">

        <div>

            <h1>Portfolio</h1>

            <p>

                Manage all portfolio projects showcased on your website.

            </p>

        </div>

        <a href="add-portfolio.php" class="add-btn">

            <i class="fas fa-plus"></i>

            Add Project

        </a>

    </div>


    <!--==========================
            SEARCH
    ===========================-->

    <form class="search-bar" method="GET">

        <input
        type="text"
        name="search"
        placeholder="Search projects..."
        value="<?php echo htmlspecialchars($search); ?>">

        <button type="submit">

            <i class="fas fa-search"></i>

        </button>

    </form>


    <!--==========================
            SUCCESS MESSAGES
    ===========================-->

    <?php if(isset($_GET['success'])){ ?>

    <div class="success-message">

        <i class="fas fa-circle-check"></i>

        Project added successfully.

    </div>

    <?php } ?>


    <?php if(isset($_GET['updated'])){ ?>

    <div class="success-message">

        <i class="fas fa-circle-check"></i>

        Project updated successfully.

    </div>

    <?php } ?>


    <?php if(isset($_GET['deleted'])){ ?>

    <div class="success-message">

        <i class="fas fa-circle-check"></i>

        Project deleted successfully.

    </div>

    <?php } ?>


    <!--==========================
            STATISTICS
    ===========================-->

    <div class="stats-grid">

        <div class="stat-card">

            <div class="stat-icon">

                <i class="fas fa-briefcase"></i>

            </div>

            <div>

                <h2>

                    <?php echo $totalProjects; ?>

                </h2>

                <p>Total Projects</p>

            </div>

        </div>


        <div class="stat-card">

            <div class="stat-icon">

                <i class="fas fa-laptop-code"></i>

            </div>

            <div>

                <h2>

                    <?php echo $websiteProjects; ?>

                </h2>

                <p>Website Design</p>

            </div>

        </div>


        <div class="stat-card">

            <div class="stat-icon">

                <i class="fas fa-palette"></i>

            </div>

            <div>

                <h2>

                    <?php echo $otherProjects; ?>

                </h2>

                <p>Other Projects</p>

            </div>

        </div>

    </div>


    <!--==========================
        PORTFOLIO PROJECTS
    ===========================-->

    <div class="portfolio-grid">
        <?php

if($result->num_rows > 0){

while($row = $result->fetch_assoc()){

?>

<div class="portfolio-card">

    <div class="portfolio-image">

        <img
        src="../uploads/portfolio/<?php echo htmlspecialchars($row['image']); ?>"
        alt="<?php echo htmlspecialchars($row['title']); ?>">

    </div>

    <div class="portfolio-content">

        <div class="portfolio-top">

            <h3>

                <?php echo htmlspecialchars($row['title']); ?>

            </h3>

            <span class="category-badge">

                <?php echo htmlspecialchars($row['category']); ?>

            </span>

        </div>

        <div class="portfolio-details">

            <div class="detail-row">

                <span class="detail-title">

                    Client

                </span>

                <span>

                    <?php
                    echo !empty($row['client'])
                    ? htmlspecialchars($row['client'])
                    : "Not Specified";
                    ?>

                </span>

            </div>

            <div class="detail-row">

                <span class="detail-title">

                    Slug

                </span>

                <span>

                    <?php
                    echo !empty($row['slug'])
                    ? htmlspecialchars($row['slug'])
                    : "-";
                    ?>

                </span>

            </div>

            <div class="detail-row">

                <span class="detail-title">

                    Created

                </span>

                <span>

                    <?php
                    echo date(
                        "d M Y",
                        strtotime($row['created_at'])
                    );
                    ?>

                </span>

            </div>

        </div>

        <div class="portfolio-actions">

            <a
            href="view-project.php?id=<?php echo $row['project_id']; ?>"
            class="view-btn">

                <i class="fas fa-eye"></i>

                View

            </a>

            <a
            href="edit-portfolio.php?id=<?php echo $row['project_id']; ?>"
            class="edit-btn">

                <i class="fas fa-pen"></i>

                Edit

            </a>

            <a
            href="delete-portfolio.php?id=<?php echo $row['project_id']; ?>"
            class="delete-btn"
            onclick="return confirm('Delete this project?')">

                <i class="fas fa-trash"></i>

                Delete

            </a>

        </div>

    </div>

</div>

<?php

}

}else{

?>

<div class="empty-state">

    <i class="fas fa-folder-open"></i>

    <h3>

        No Portfolio Projects Found

    </h3>

    <p>

        Start building your portfolio by adding your first project.

    </p>

    <a
    href="add-portfolio.php"
    class="add-btn">

        <i class="fas fa-plus"></i>

        Add First Project

    </a>

</div>

<?php } ?>

</div>

</div>

</div>

<script src="assets/js/admin.js"></script>

</body>

</html>