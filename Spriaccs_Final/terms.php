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
            <h1 style="color: #8CC63F;">Terms of Service</h1>
            <p style="color: #003B95;"><strong>Last Updated: July 18, 2026</strong></p>

            <p>Welcome to Spriaccs Design. These Terms and Conditions govern your use of the website operated by Spriaccs Design. By accessing or using the Service, you agree to be bound by these Terms.</p>

            <h2 style="color: #003B95;">1. Use of the Website</h2>
            <p>The content on this website is for your general information and use only. It is subject to change without notice. Neither we nor any third parties provide any warranty or guarantee as to the accuracy, completeness, or suitability of the information found or offered on this website for any particular purpose.</p>

            <h2 style="color: #003B95;">2. Intellectual Property</h2>
            <p>The website and its original content, features, and functionality are and will remain the exclusive property of Spriaccs Design and its licensors. Our trademarks and trade dress may not be used in connection with any product or service without the prior written consent of Spriaccs Design.</p>
            
            <h2 style="color: #003B95;">3. Project Engagement & Scope of Work</h2>
            <p>Any project or services agreed upon with Spriaccs Design will be governed by a separate, formal Service Agreement or contract, which will outline the scope of work, fees, payment schedule, and intellectual property rights specific to that project. The submission of a contact form does not constitute a formal agreement for service.</p>

            <h2 style="color: #003B95;">4. Links to Other Websites</h2>
            <p>Our website may contain links to third-party web sites or services that are not owned or controlled by Spriaccs Design. We have no control over, and assume no responsibility for, the content, privacy policies, or practices of any third-party web sites or services.</p>

            <h2 style="color: #003B95;">5. Limitation of Liability</h2>
            <p>In no event shall Spriaccs Design, nor its directors, employees, partners, agents, suppliers, or affiliates, be liable for any indirect, incidental, special, consequential or punitive damages, including without limitation, loss of profits, data, use, goodwill, or other intangible losses, resulting from (i) your access to or use of or inability to access or use the Service; (ii) any conduct or content of any third party on the Service.</p>

           
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