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
      
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    
    <link rel="stylesheet" href="css/blog.css">
    <link rel="stylesheet" href="css/animations.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
     <style>
        /* Specific styling for the legal content area */
        .legal-content {
            max-width: 900px;
            margin: 0 auto;
            /* CRITICAL CHANGE: Removed top padding here. Only bottom padding remains. */
            padding: 0 0 40px 0; 
            line-height: 1.7;
            color: var(--color-text);
        }
        .legal-content h1 {
            text-align: center;
            font-size: 3em;
            /* CRITICAL CHANGE: Removed default top margin from H1 */
            margin-top: 0; 
            margin-bottom: 20px;
            color: var(--color-primary);
        }
        .legal-content h2 {
            font-size: 1.8em;
            margin-top: 40px;
            margin-bottom: 15px;
            color: var(--color-dark);
            border-bottom: 2px solid #eee;
            padding-bottom: 5px;
        }
        .legal-content p, .legal-content ul, .legal-content ol {
            margin-bottom: 20px;
        }
        .legal-content ul, .legal-content ol {
            padding-left: 25px;
        }
    </style>
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
    <main class="legal-page-main">
        <div class="legal-content">
            <h1 style="color: #8CC63F;">Privacy Policy</h1>
            <p style="color: #003B95;"><strong>Last Updated: July 18, 2026</strong></p>

            <p>Spriaccs Design is committed to protecting the privacy of those who visit our website and use our services. This Privacy Policy describes how we collect, use, and disclose your information when you use our website.</p>

            <h2 style="color: #003B95;">1. Information We Collect</h2>
            <p>We only collect information that you voluntarily provide to us via our contact form on the Service:</p>
            <ul>
                <li><strong>Personal Identification Information:</strong> Name, email address, and phone number.</li>
                <li><strong>Project Details:</strong> Information you provide regarding your design needs or project requirements.</li>
            </ul>

            <h2 style="color: #003B95;">2. How We Use Your Information</h2>
            <p>The information we collect is used solely for the following purposes:</p>
            <ul class="blog-list">
                <li>To respond to your inquiries and provide customer support.</li>
                <li>To communicate with you about your project or potential services.</li>
                <li>To improve our website and services based on user feedback.</li>
            </ul>

            <h2 style="color: #003B95;">3. Disclosure of Your Information</h2>
            <p>We do not sell, trade, or otherwise transfer your personally identifiable information to outside parties. This does not include trusted third parties, such as our email service provider (FormSubmit.co, as used in the contact form), who assist us in operating our website, conducting our business, or serving our users, so long as those parties agree to keep this information confidential.</p>

            <h2 style="color: #003B95;">4. Security of Data</h2>
            <p>The security of your data is important to us. While we strive to use commercially acceptable means to protect your Personal Data, we cannot guarantee its absolute security.</p>

            
               
           
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