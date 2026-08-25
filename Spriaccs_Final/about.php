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
    

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="css/style.css">
    
    <link rel="stylesheet" href="css/animations.css">
    <link rel="stylesheet" href="css/about.css">
    <link rel="stylesheet" href="css/responsive.css">

</head>

<body>

    <!-- =========================
            HEADER
    ========================== -->

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

                    <li><a class="active" href="about.php">About Us</a></li>

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

    <!-- =========================
            HERO
    ========================== -->

    <section class="about-hero">

        <div class="container">

            <span class="section-tag">ABOUT SPRIACCS</span>

            <h1>
                We create brands<br>
                people remember.
            </h1>

            <p>
                Spriaccs is a creative agency passionate about helping businesses
                build memorable brands, beautiful digital experiences and marketing
                that inspires confidence and drives growth.
            </p>

        </div>

    </section>


    <!-- =========================
            MISSION & VISION
    ========================== -->

    <section class="mission">

        <div class="container mission-grid">

            <div class="mission-card">

                <h3>Our Mission</h3>

                <p>
                    To empower businesses with strategic branding,
                    creative design and digital experiences that
                    accelerate growth.
                </p>

            </div>

            <div class="mission-card">

                <h3>Our Vision</h3>

                <p>
                    To become one of Africa's most trusted creative
                    agencies known for innovation, quality and
                    measurable results.
                </p>

            </div>

        </div>

    </section>

    <!-- =========================
            VALUES
    ========================== -->

    <section class="values">

        <div class="container">

            <div class="section-heading">

                <span>OUR VALUES</span>

                <h2>
                    The principles that guide everything we create.
                </h2>

            </div>

            <div class="services-grid">

                <!-- Creativity -->

                <div class="service-card">

                    <div class="service-icon">
                        <i class="fa-solid fa-wand-magic-sparkles"></i>
                    </div>

                    <h3>Creativity</h3>

                    <p>
                        Fresh ideas that help brands stand out.
                    </p>

                </div>

                <!-- Quality -->

                <div class="service-card">

                    <div class="service-icon">
                        <i class="fa-solid fa-gem"></i>
                    </div>

                    <h3>Quality</h3>

                    <p>
                        Attention to detail in every project.
                    </p>

                </div>

                <!-- Integrity -->

                <div class="service-card">

                    <div class="service-icon">
                        <i class="fa-solid fa-handshake"></i>
                    </div>

                    <h3>Integrity</h3>

                    <p>
                        Honest partnerships built on trust.
                    </p>

                </div>

                <!-- Innovation -->

                <div class="service-card">

                    <div class="service-icon">
                        <i class="fa-solid fa-lightbulb"></i>
                    </div>

                    <h3>Innovation</h3>

                    <p>
                        Modern solutions for evolving businesses.
                    </p>

                </div>

            </div>

        </div>

    </section>
    <!--========================
        WHY US
    =========================-->

    <section class="why">

        <div class="container why-grid">

            <div class="section-heading">

                <span>WHY SPRIACCS</span>

                <h2 style="color: #003B95;">

                    Design with purpose.
                    Strategy with results.

                </h2>

            </div>

            <div class="stats">

                <div>

                    <h3>50+</h3>

                    <p>Projects</p>

                </div>

                <div>

                    <h3>98%</h3>

                    <p>Satisfied Clients</p>

                </div>

                <div>

                    <h3>2+</h3>

                    <p>Years Experience</p>

                </div>

                <div>

                    <h3>24/7</h3>

                    <p>Support</p>

                </div>

            </div>

        </div>

    </section>

    <!-- =========================
            CTA
    ========================== -->

    <section class="cta">

        <div class="container">

            <h2>
                Let's create something remarkable.
            </h2>

            <p>
                We'd love to help bring your vision to life.
            </p>

            <a href="quote.php" class="btn btn-primary">
                 Let's talk 🤓
            </a>

        </div>

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