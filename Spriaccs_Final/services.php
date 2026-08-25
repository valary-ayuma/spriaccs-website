<?php

require_once "includes/connection.php";
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
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="css/animations.css">

    <link rel="stylesheet" href="css/responsive.css">

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

                    <li><a class="active" href="services.php">What we do</a></li>

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

    <!--========================
        SERVICES
    =========================-->

    <section class="services">

        <div class="container">

            <div class="section-heading">

                <span>WHAT WE DO</span>

                <h2 style="color: #003B95;">

                    Design solutions built for business growth.

                </h2>
                <p>
                    
                    At Spriaccs, we combine creativity, strategy, and technology to
                </p>
                <p> 
                    help businesses build strong brands, engage their audiences, 
                </p>
                <p>
                    and achieve lasting growth. Every solution is tailored
                </p>
                <p>
                    to deliver meaningful results and leave a lasting impression.
                </p>

            </div>

           <div class="services-grid">

<?php

$query = $conn->query("SELECT * FROM services WHERE status='Active' ORDER BY service_id ASC");

while($service = $query->fetch_assoc()){

?>

<div class="service-card">

    <span class="service-icon">

        <i class="<?php echo htmlspecialchars($service['icon']); ?>"></i>

    </span>

    <h3>

        <?php echo htmlspecialchars($service['title']); ?>

    </h3>

    <p>

        <?php echo nl2br(htmlspecialchars($service['description'])); ?>

    </p>

</div>

<?php

}

?>

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