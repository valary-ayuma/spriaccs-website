<?php
require_once "includes/settings.php";


require_once "admin/includes/connection.php";

// Fetch the featured article (the latest/most recent blog post)
$stmt = $conn->prepare("SELECT * FROM blog ORDER BY blog_id DESC LIMIT 1");
$stmt->execute();
$result = $stmt->get_result();
$featured = $result->fetch_assoc();
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

    <link rel="stylesheet" href="css/animations.css">
    <link rel="stylesheet" href="css/blog.css">
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

                <li><a class="active" href="blog.php">Blog</a></li>

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

        <div class="featured-grid">

            <!-- Left Side -->
            <div class="featured-image">

                <?php if($featured && !empty($featured['image'])): ?>
                    <img src="uploads/blog/<?php echo htmlspecialchars($featured['image']); ?>" alt="<?php echo htmlspecialchars($featured['title']); ?>">
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
                    <?php echo $featured ? htmlspecialchars($featured['title']) : "Building Brands That Customers Never Forget"; ?>
                </h2>

                <p>
                    <?php 
                    if($featured){
                        echo nl2br(htmlspecialchars($featured['content']));
                    } else {
                        echo "Every memorable business shares one thing in common: consistency. From your logo and website to your social media presence and customer experience, every interaction shapes how people remember your brand.";
                    }
                    ?>
                </p>

                <div class="featured-meta">
                    <span><?php echo $featured ? htmlspecialchars($featured['category']) : "Brand Strategy"; ?></span>
                    <span>•</span>
                    <span><?php echo $featured ? date("M d, Y", strtotime($featured['created_at'])) : "5 min read"; ?></span>
                </div>

                <?php if($featured && !empty($featured['slug'])): ?>
                    <a href="article.php?slug=<?php echo urlencode($featured['slug']); ?>" class="read-featured">
                        Read Full Article →
                    </a>
                <?php else: ?>
                    <a href="article.php" class="read-featured">
                        Read Full Article →
                    </a>
                <?php endif; ?>

            </div>

        </div>

    </div>

</section>
<script src="assets/js/main.js"></script>
 <!-- =====================================
            BLOG CATEGORIES
====================================== -->



<!-- =====================================
                BLOG POSTS
====================================== -->

<section class="blog-posts">

    <div class="container">

        <div class="posts-grid">

            <!-- =========================
                    CARD 1
            ========================== -->

            <article class="post-card">

                <div class="post-image">

                    <img src="png/gdesign.jpg"
                         alt="Graphic Design Trends">

                </div>

                <div class="post-content">

                    <span class="post-category">

                        Graphic Design

                    </span>

                    <h3>

                        The Future of Minimalism in Graphic Design

                    </h3>

                    <p>

                        Minimalism has evolved from removing elements to using
                        only what truly matters. Today's successful brands are
                        embracing spacious layouts, elegant typography and
                        meaningful visuals that communicate more with less. By prioritizing intentional whitespace and purpose, you ensure your core message resonates deeply with your audience.

                    </p>

                </div>

            </article>

            <!-- =========================
                    CARD 2
            ========================== -->

            <article class="post-card">

                <div class="post-image">

                    <img src="png/branding.jpg"
                         alt="Branding">

                </div>

                <div class="post-content">

                    <span class="post-category">

                        Branding

                    </span>

                    <h3>

                        5 Signs Your Business Needs a Rebrand

                    </h3>

                    <p>

                        Your brand should evolve as your business grows.
                        If your visuals feel outdated, your audience has
                        changed or your message is inconsistent, it may
                        be time to refresh your identity.

                    </p>

                    <ul class="blog-list">

                        <li>Outdated visual identity</li>

                        <li>Inconsistent branding</li>

                        <li>Changing target audience</li>

                        <li>Business expansion</li>

                        <li>Increased competition</li>

                    </ul>

                </div>

            </article>

            <!-- =========================
                    CARD 3
            ========================== -->

            <article class="post-card">

                <div class="post-image">

                    <img src="png/ux.jpg"
                         alt="User Experience">

                </div>

                <div class="post-content">

                    <span class="post-category">

                        UX Design

                    </span>

                    <h3>

                        Why Great User Experience Delivers Real Business Value

                    </h3>

                    <p>

                        A well-designed website isn't just attractive—it
                        improves customer satisfaction, increases conversions
                        and builds trust. Great UX helps businesses reduce
                        bounce rates while encouraging visitors to take action. Ultimately, an intuitive interface bridges the gap between your brand’s vision and the user's needs.

                    </p>

                </div>

            </article>

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