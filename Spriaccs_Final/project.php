<?php
require_once "includes/settings.php";
require_once "admin/includes/connection.php";

/*==================================
        WEBSITE SETTINGS
==================================*/

$settingsQuery = $conn->query("SELECT * FROM settings LIMIT 1");
$settings = $settingsQuery->fetch_assoc();


/*==================================
        GET PROJECT
==================================*/

if(
    !isset($_GET['slug']) ||
    empty($_GET['slug'])
){

    header("Location: portfolio.php");
    exit();

}

$slug = trim($_GET['slug']);

$stmt = $conn->prepare("

SELECT *

FROM portfolio

WHERE slug=?

LIMIT 1

");

$stmt->bind_param("s",$slug);

$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows==0){

    include("404.php");

    exit();

}

$project = $result->fetch_assoc();

?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo htmlspecialchars($settings['seo_title']); ?></title>

<meta
    name="description"
    content="<?php echo htmlspecialchars($settings['seo_description']); ?>">

<meta
    name="keywords"
    content="<?php echo htmlspecialchars($settings['seo_keywords']); ?>">

<link
    rel="icon"
    type="image/x-icon"
    href="uploads/<?php echo htmlspecialchars($settings['favicon']); ?>">
    

    <!-- Main CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/project.css">
    <link rel="stylesheet" href="css/animations.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Open+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

</head>

<body>

<!-- =====================================
                HEADER
====================================== -->

<header id="header">

    <div class="container nav-container">

        <a href="index.php" class="logo">

                <img
                    src="uploads/<?php echo htmlspecialchars($settings['logo']); ?>"
                  alt="<?php echo htmlspecialchars($settings['company_name']); ?>">

            </a>

        <nav>

            <ul class="nav-links">

                <li><a href="index.php">Home</a></li>

                <li><a href="about.php">About Us</a></li>

                <li><a href="services.php">What We Do</a></li>

                <li><a href="portfolio.php">Case Studies</a></li>

                <li><a href="blog.php">Blog</a></li>

            </ul>

        </nav>

        <a href="quote.php" class="btn btn-primary">

            Get a Quote

        </a>

        <div class="menu-btn">

            ☰

        </div>

    </div>

</header>



<!--==================================
        HERO
===================================-->

<section
class="project-hero"

style="background-image:url('uploads/portfolio/<?php echo htmlspecialchars($project['image']); ?>');">

<div class="hero-overlay">

<div class="container">


<span class="project-category">

<?php echo htmlspecialchars($project['category']); ?>

</span>

<div class="project-description">

        <?php echo nl2br(htmlspecialchars($project['description'])); ?>

    



</div>
<?php
if(
    $project['category']=="Website Design" &&
    !empty($project['project_link'])
){
?>

<a
    href="<?php echo htmlspecialchars($project['project_link']); ?>"
    target="_blank"
        class="btn btn-primary">

        <i class="fas fa-arrow-up-right-from-square"></i>

            Visit Website

</a>
<?php } ?>


</div>
</div>

</section>

    <!--==================================
        RESULTS SHOWCASE
===================================-->

<section class="results-showcase">

    <div class="container">

        <div class="results-header">
     
            <h2>

                The <span>Results.</span>

            </h2>

        </div>

        <div class="results-image">

            <img
            src="uploads/portfolio/<?php echo htmlspecialchars($project['image']); ?>"
            alt="<?php echo htmlspecialchars($project['title']); ?>">

        </div>

    </div>

</section>



<!--==================================
        RELATED PROJECTS
===================================-->

<?php

$stmt = $conn->prepare("

SELECT
project_id,
title,
slug,
category,
image

FROM portfolio

WHERE project_id != ?

ORDER BY RAND()

LIMIT 3

");

$stmt->bind_param("i",$project['project_id']);

$stmt->execute();

$related = $stmt->get_result();

?>

<section class="related-projects">

    <div class="section-heading">

        <span>More Work</span>

        <h2>Explore More Case Studies</h2>

    </div>

    <div class="projects-grid">

<?php

while($row = $related->fetch_assoc()){

?>

        <article class="project-card">

            <div class="project-card-image">

                <img
                src="uploads/portfolio/<?php echo htmlspecialchars($row['image']); ?>"
                alt="<?php echo htmlspecialchars($row['title']); ?>">

            </div>

            <div class="project-card-content">

                <span>

                    <?php echo htmlspecialchars($row['category']); ?>

                </span>

                <h3>

                    <?php echo htmlspecialchars($row['title']); ?>

                </h3>

                <a
                href="project.php?slug=<?php echo urlencode($row['slug']); ?>"
                class="read-more">

                    View Project

                    <i class="fas fa-arrow-right"></i>

                </a>

            </div>

        </article>

<?php

}

?>

    </div>

</section>

</div>

</main>



<!--========================
            FOOTER
    =========================-->
    <footer>

    <div class="container footer-grid">

        <!-- Let's Connect -->
        <div>

            <h4>Let's Connect</h4>

            <p class="social-text">
                Follow us on.
            </p>

            <div class="social-links">

                <a
                    href="<?php echo htmlspecialchars($settings['facebook']); ?>"
                    target="_blank"
                    aria-label="Facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>

                <a
                    href="<?php echo htmlspecialchars($settings['instagram']); ?>"
                    target="_blank"
                    aria-label="Instagram">
                    <i class="fab fa-instagram"></i>
                </a>
                <a
                    href="<?php echo htmlspecialchars($settings['tiktok']); ?>"
                    target="_blank"
                    aria-label="TikTok">
                    <i class="fab fa-tiktok"></i>
                </a>
                <a 
                    href="<?php echo htmlspecialchars($settings['whatsapp']); ?>" 
                    target="_blank" 
                    aria-label="WhatsApp">
                    <i class="fab fa-whatsapp"></i>
                </a>

            </div>

        </div>

        <!-- Company -->
        <div>

            <h4>Company</h4>

            <a href="about.php">About</a>

            <a href="services.php">What We Do</a>

            <a href="portfolio.php">Case Studies</a>

        </div>

        <!-- Resources -->
        <div>

            <h4>Resources</h4>

            <a href="blog.php">Blog</a>

            <a href="privacy.php">Privacy</a>

            <a href="terms.php">Terms</a>

        </div>

        <!-- Contact -->
        <div>

            <h4>Contact</h4>

            <div class="contact-info">

                <p>
                    <span>📞</span>
                    <a href="tel:<?php echo htmlspecialchars($settings['phone']); ?>">

                        <?php echo htmlspecialchars($settings['phone']); ?>

                    </a>

                </p>

                <p>
                    <span>📧</span>
                    <a href="mailto:<?php echo htmlspecialchars($settings['email']); ?>">
                        <?php echo htmlspecialchars($settings['email']); ?>
                    </a>
                </p>

                <p>
                    <span>📍</span>
                    <?php echo htmlspecialchars($settings['location']); ?>
                </p>

            </div>

        </div>

    </div>

    <div class="copyright">

        &copy;
        <span id="currentYearFooter"></span>

        <?php echo htmlspecialchars($settings['copyright']); ?>
    </div>

</footer>
    
    <script>
        // Update year in footer
        document.getElementById('currentYearFooter').textContent = new Date().getFullYear();
        
        // This is necessary because fixed headers require main content to be pushed down
        const headerHeight = document.querySelector('header').offsetHeight;
        document.querySelector('.contact-page-main').style.paddingTop = `${headerHeight + 20}px`;
    </script>
    <!-- FOOTER END -->
    <script src="js/main.js"></script>

</body>

</html