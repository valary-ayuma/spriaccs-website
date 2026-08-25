<?php
require_once "includes/settings.php";

require_once "admin/includes/connection.php";

// Fetch the 6 latest blog blocks from the admin database
$stmt = $conn->prepare("SELECT * FROM blog ORDER BY blog_id DESC LIMIT 6");
$stmt->execute();
$result = $stmt->get_result();

$blogs = [];
while($row = $result->fetch_assoc()){
    $blogs[] = $row;
}
$totalBlogs = count($blogs);
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
    
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="css/style.css">


    <link rel="stylesheet" href="css/animations.css">
    <link rel="stylesheet" href="css/blog.css">
    <link rel="stylesheet" href="css/responsive.css">

</head>

<body>

    <!--========================
        NAVIGATION
    =========================-->

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

                    <li><a href="services.php">What we do</a></li>

                    <li><a href="portfolio.php">Case studies</a></li>

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

<!-- =====================================
        FEATURED ARTICLE STARTS HERE
====================================== -->

<main>

<section id="featured" class="featured-section">

    <div class="container">

        <?php if($totalBlogs > 0): 
            // ==========================================
            // BLOCK 1: Featured Article (Image Left)
            // ==========================================
            $b1 = $blogs[0];
        ?>
        <div class="featured-grid">
            <!-- Left Side -->
            <div class="featured-image">
                <?php if(!empty($b1['image'])): ?>
                    <img src="uploads/blog/<?php echo htmlspecialchars($b1['image']); ?>" alt="<?php echo htmlspecialchars($b1['title']); ?>">
                <?php else: ?>
                    <img src="png/brand.jpg" alt="Featured Blog Article">
                <?php endif; ?>
            </div>

            <!-- Right Side -->
            <div class="featured-content">
                <span class="featured-label">
                    FEATURED ARTICLE
                </span>
                <h2>
                    <?php echo htmlspecialchars($b1['title']); ?>
                </h2>
                <div>
                    <?php echo nl2br(htmlspecialchars($b1['content'])); ?>
                </div>
            </div>
        </div>
        <?php endif; ?>


        <?php if($totalBlogs >= 5): 
            // ==========================================
            // BLOCKS 2 & 3: Dual Column Grid
            // ==========================================
            $b2 = $blogs[1];
            $b3 = $blogs[2];
        ?>
        <div class="featured-grid">
            <!-- Left Side -->
            <div class="featured-content">
                <h2><?php echo htmlspecialchars($b2['title']); ?></h2>
                <div><?php echo nl2br(htmlspecialchars($b2['content'])); ?></div>
            </div>

            <!-- Right Side -->
            <div class="featured-content">
                <h2><?php echo htmlspecialchars($b3['title']); ?></h2>
                <div><?php echo nl2br(htmlspecialchars($b3['content'])); ?></div>
            </div>
        </div>


        <?php 
            // ==========================================
            // BLOCKS 4 & 5: Dual Column Grid
            // ==========================================
            $b4 = $blogs[3];
            $b5 = $blogs[4];
        ?>
        <div class="featured-grid">
            <!-- Left Side -->
            <div class="featured-content">
                <h2><?php echo htmlspecialchars($b4['title']); ?></h2>
                <div><?php echo nl2br(htmlspecialchars($b4['content'])); ?></div>
            </div>

            <!-- Right Side -->
            <div class="featured-content">
                <h2><?php echo htmlspecialchars($b5['title']); ?></h2>
                <div><?php echo nl2br(htmlspecialchars($b5['content'])); ?></div>
            </div>
        </div>
        <?php endif; ?>


        <?php if($totalBlogs >= 6): 
            // ==========================================
            // BLOCK 6: Final Article (Image Left)
            // ==========================================
            $b6 = $blogs[5];
        ?>
        <div class="featured-grid">
            <!-- Left Side -->
            <div class="featured-image">
                <?php if(!empty($b6['image'])): ?>
                    <img src="uploads/blog/<?php echo htmlspecialchars($b6['image']); ?>" alt="<?php echo htmlspecialchars($b6['title']); ?>">
                <?php else: ?>
                    <img src="png/path.jpg" alt="Featured Blog Article">
                <?php endif; ?>
            </div>

            <!-- Right Side -->
            <div class="featured-content">
                <h2>
                    <?php echo htmlspecialchars($b6['title']); ?>
                </h2>
                <div>
                    <?php echo nl2br(htmlspecialchars($b6['content'])); ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if($totalBlogs == 0): ?>
            <div style="text-align: center; padding: 40px;">
                <h2>No articles found.</h2>
                <p>Please populate your 6 blocks via the admin dashboard.</p>
            </div>
        <?php endif; ?>

    </div>

</section>
<script src="assets/js/main.js"></script>
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