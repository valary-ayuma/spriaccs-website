<?php
require_once "includes/settings.php";
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
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">


    <link rel="stylesheet" href="css/animations.css">

    <link rel="stylesheet" href="css/portfolio.css">

    <link rel="stylesheet" href="css/responsive.css">

     <script src="js/portfolio.js"></script>
</head>
<body>
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

                    <li><a class="active" href="portfolio.php">Case studies</a></li>

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

    <!--========================
        FEATURED PROJECTS
=========================-->

<section class="portfolio">

    <div class="container">

        <div class="section-heading">

            <span>CASE STUDIES</span>

            <h2>

                Creative work that delivers measurable impact.

            </h2>

            <p>

                Explore a selection of our recent projects across brand identity,
                graphic design and website design. Every project reflects our
                commitment to creativity, strategy and helping businesses grow.

            </p>

        </div>

        <!--========================
            FILTER BUTTONS
        =========================-->

        <div class="portfolio-filters">

            <button class="filter-btn active"
                    data-filter="all">

                All

            </button>

            <button class="filter-btn"
                    data-filter="brand">

                Brand Identity

            </button>

            <button class="filter-btn"
                    data-filter="graphic">

                Graphic Design

            </button>

            <button class="filter-btn"
                    data-filter="web">

                Web Design

            </button>

        </div>

        <!--========================
            PROJECTS
        =========================-->

        <div class="portfolio-grid">

        <?php
        $query = $conn->query("
            SELECT *
            FROM portfolio
            ORDER BY project_id DESC
        ");

        if($query->num_rows > 0){
            while($project = $query->fetch_assoc()){
                
                // Map database category text to data-filter values (brand, graphic, web)
                $catLower = strtolower($project['category']);
                $dataFilter = 'all';
                if(strpos($catLower, 'brand') !== false){
                    $dataFilter = 'brand';
                } elseif(strpos($catLower, 'graphic') !== false){
                    $dataFilter = 'graphic';
                } elseif(strpos($catLower, 'web') !== false){
                    $dataFilter = 'web';
                }
        ?>

            <article class="project portfolio-card"
                     data-category="<?php echo $dataFilter; ?>"
                     style="background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); display: flex; flex-direction: column; margin: 0; padding: 0;">

                <a class="project-link"
                    href="project.php?slug=<?php echo urlencode($project['slug']); ?>"
                    style="display: block; width: 100%; margin: 0; padding: 0;">

                    <div class="project-image" style="width: 100%; height: 240px; overflow: hidden; margin: 0; padding: 0;">

                        <img
                        src="uploads/portfolio/<?php echo htmlspecialchars($project['image']); ?>"
                        alt="<?php echo htmlspecialchars($project['title']); ?>"
                        style="width: 100%; height: 100%; object-fit: cover; display: block; margin: 0; border: none;">

                    </div>

                </a>

                <div class="project-content card-content" style="padding: 20px; display: flex; flex-direction: column; flex-grow: 1; justify-content: space-between;">

                    <div>
                        <span class="project-category" style="display: inline-block; background-color: #eef2f9; color: #0056b3; font-size: 0.75rem; font-weight: 600; padding: 4px 10px; border-radius: 50px; margin-bottom: 10px; text-transform: uppercase;">

                            <?php echo htmlspecialchars($project['category']); ?>

                        </span>

                        <h3 style="margin: 0 0 15px 0; font-size: 1.2rem; color: #0b2545; line-height: 1.4;">

                            <?php echo htmlspecialchars($project['title']); ?>

                        </h3>
                    </div>

                    <a
                    class="view-project"
                    href="project.php?slug=<?php echo urlencode($project['slug']); ?>"
                    style="color: #0056b3; text-decoration: none; font-weight: 600; font-size: 0.95rem;">

                        View Project →

                    </a>

                </div>

            </article>

        <?php
            }
        } else {
        ?>

            <div class="no-projects" style="grid-column: 1 / -1; text-align: center; padding: 40px;">

                <i class="fas fa-folder-open"></i>

                <h3>No Portfolio Projects Yet</h3>

                <p>

                    Our latest creative projects will appear here soon.

                </p>

            </div>

        <?php } ?>

        </div>

    </div>

</section>
<!--========================
            CTA
    =========================-->

    <section class="cta">

        <div class="container">

            <h2>

                Let's build something remarkable.

            </h2>

            <p>

                Ready to elevate your brand?

            </p>

            <a href="quote.php" class="btn btn-primary">

                Let's talk 🤓

            </a>

        </div>
        <section class="connect">

    

</section>

    </section>

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