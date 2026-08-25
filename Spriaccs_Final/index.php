<?php

require_once "includes/connection.php";
require_once "includes/settings.php";
$newsletterSuccess = "";
$newsletterError = "";

if(isset($_POST['subscribe'])){

    $email = trim($_POST['email']);

    if(empty($email)){

        $newsletterError = "Please enter your email address.";

    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){

        $newsletterError = "Please enter a valid email address.";

    }else{

        /* Check if already subscribed */

        $stmt = $conn->prepare("
            SELECT subscriber_id
            FROM newsletter
            WHERE email=?
        ");

        $stmt->bind_param("s",$email);

        $stmt->execute();

        $stmt->store_result();

        if($stmt->num_rows > 0){

            $newsletterError = "You're already subscribed to our newsletter.";

        }else{

            $stmt = $conn->prepare("
                INSERT INTO newsletter
                (
                    email,
                    status
                )
                VALUES
                (
                    ?,
                    'Active'
                )
            ");

            $stmt->bind_param("s",$email);

            if($stmt->execute()){

                $newsletterSuccess = "Thank you for subscribing!";

            }else{

                $newsletterError = "Something went wrong. Please try again.";

            }

        }

    }

}

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
    <link rel="stylesheet" href="css/portfolio.css">
    <link rel="stylesheet" href="css/animations.css">

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

                    <li><a class="active" href="index.php">Home</a></li>

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

    <!--========================
            HERO
    =========================-->

    <section class="hero">
        <div class="hero-slider">

            <div class="slide active"
                style="background-image:url('png/slide1.jpg');"></div>

            <div class="slide"
                style="background-image:url('png/slide2.jpg');"></div>

            <div class="slide"
                style="background-image:url('png/slide3.jpg');"></div>

        </div>

        <div class="hero-overlay"></div>

        <div class="hero-fade"></div>


    <div class="container hero-grid">

        <!-- Left -->

        <div class="hero-left">

            <span class="hero-tag">
                CREATIVE AGENCY
            </span>

            <h1>
                <span class="blue">Creative Ideas.</span><br>

                <span class="green">Powerful Designs.</span><br>

                <span class="blue">Real Results.</span>
            </h1>

            <p>
                We help businesses stand out through strategic branding,
                premium websites, creative marketing and digital experiences
                that drive measurable growth.
            </p>

           

        </div>

       

    </div>

</section>
<!-- =====================================
        ABOUT US 
====================================== -->

<main>

<section id="featured" class="featured-section">

    <div class="container">

        <div class="featured-grid">

            <!-- Left Side -->

            <div class="featured-image">

                <!-- Replace this image -->
                <img src="png/about.jpg"
                     alt="Featured Blog Article">

            </div>

            <!-- Right Side -->

            <div class="featured-content">

                <span class="featured-label">

                    About Us

                </span>

                <h2>

                    We Create Brands That Inspires, Connect & Grow
                </h2>

                <p>
                    Spriaccs is a creative agency dedicated to building 
                    bold brands and meaningful digital experiences. 
                    We combine strategy, creativity, and technology 
                    to deliver branding, graphic design, website development, 
                    and marketing solutions that help businesses stand out, 
                    connect with their audience, and achieve sustainable growth. 
                    </p>

                

                <a href="about.php" class="read-featured">

                    Learn More

                </a>

            </div>

        </div>

    </div>

</section>



    
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
        FEATURED PROJECTS
=========================-->

<section class="portfolio">

    <div class="container">

        <div class="section-heading">

            <span>CASE STUDIES</span>

            <h2 style="color:#003B95;">

                Recent projects we've crafted.

            </h2>

        </div>

        <div class="portfolio-grid">

        <?php

        $query = $conn->query("
            SELECT *
            FROM portfolio
            ORDER BY project_id DESC
            LIMIT 5
        ");

        if($query->num_rows > 0){

            while($project = $query->fetch_assoc()){

        ?>

            <div class="project portfolio-card" style="background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); display: flex; flex-direction: column;">

                <!-- Image container with zero margins/padding so it touches every edge -->
                <a class="project-link" href="project.php?slug=<?php echo urlencode($project['slug']); ?>" style="display: block; width: 100%; margin: 0; padding: 0;">
                    <div class="project-image" style="width: 100%; height: 240px; overflow: hidden; margin: 0; padding: 0;">
                        <img src="uploads/portfolio/<?php echo htmlspecialchars($project['image']); ?>" alt="<?php echo htmlspecialchars($project['title']); ?>" style="width: 100%; height: 100%; object-fit: cover; display: block; margin: 0; border: none;">
                    </div>
                </a>

                <!-- Content container below the image -->
                <div class="card-content" style="padding: 20px; display: flex; flex-direction: column; flex-grow: 1; justify-content: space-between;">
                    
                    <div>
                        <!-- Category tag at the top -->
                        <span style="display: inline-block; background-color: #eef2f9; color: #0056b3; font-size: 0.75rem; font-weight: 600; padding: 4px 10px; border-radius: 50px; margin-bottom: 10px; text-transform: uppercase;">
                            <?php echo htmlspecialchars($project['category']); ?>
                        </span>

                        <!-- Project Title -->
                        <h3 style="margin: 0 0 15px 0; font-size: 1.2rem; color: #0b2545; line-height: 1.4;">
                            <?php echo htmlspecialchars($project['title']); ?>
                        </h3>
                    </div>

                    <!-- View Project Link -->
                    <a class="view-project" href="project.php?slug=<?php echo urlencode($project['slug']); ?>" style="color: #0056b3; text-decoration: none; font-weight: 600; font-size: 0.95rem;">
                        View Project →
                    </a>

                </div>

            </div>

        <?php

            }

        }else{

        ?>

            <div class="no-projects">

                <i class="fas fa-folder-open"></i>

                <h3>No Portfolio Projects Yet</h3>

                <p>

                    Our latest creative projects will appear here soon.

                </p>

            </div>

        <?php } ?>

         <div class="portfolio-button">

            <a href="portfolio.php" class="btn btn-primary">

                View Full Portfolio

            </a>

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
    <!--========================
        NEWSLETTER
=========================-->

<section class="newsletter">

    <div class="container newsletter-container">

        <div class="newsletter-content">

            <span class="newsletter-tag">
                STAY CONNECTED
            </span>

            <h2>
                Get Creative Insights Delivered to Your Inbox
            </h2>

            <p>
                Subscribe to receive branding tips, design inspiration,
                website trends, and exclusive updates from Spriaccs.
                No spam—just valuable creative content.
            </p>

        </div>

        <form class="newsletter-form" id="newsletterForm">

            <input
                type="email"
                name="email"
                id="newsletterEmail"
                placeholder="Enter your email address"
                autocomplete="email"
                required>

            <button
                type="submit"
                id="newsletterButton">

                Subscribe

            </button>

        </form>

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
     <script src="js/slider.js"></script>
     <script src="js/newsletter.js"></script>

</body>

</html