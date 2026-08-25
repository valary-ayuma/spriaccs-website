<?php

require_once "includes/connection.php";
require_once "includes/settings.php";
$success = "";
$error = "";

if(isset($_POST['submit'])){

    $full_name = trim($_POST['full_name']);
    $email     = trim($_POST['email']);
    $phone     = trim($_POST['phone']);
    $message   = trim($_POST['message']);

    if(
        empty($full_name) ||
        empty($email) ||
        empty($phone) ||
        empty($message)
    ){

        $error = "Please fill in all required fields.";

    }else{

        $stmt = $conn->prepare("
            INSERT INTO quote
            (
                full_name,
                email,
                phone,
                message,
                status
            )
            VALUES
            (
                ?,?,?,?,
                'Unread'
            )
        ");

        $stmt->bind_param(
            "ssss",
            $full_name,
            $email,
            $phone,
            $message
        );

        if($stmt->execute()){

            $success = "Thank you! Your enquiry has been submitted successfully.";

            $full_name = "";
            $email = "";
            $phone = "";
            $message = "";

        }else{

            $error = "Something went wrong. Please try again.";

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
    

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<link rel="stylesheet"
href="css/style.css">

<link rel="stylesheet"
href="css/animations.css">

<link rel="stylesheet"
href="css/quote.css">

<link rel="stylesheet"
href="css/responsive.css">

<link
href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Open+Sans:wght@400;600&display=swap"
rel="stylesheet">

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

<main class="contact-page-main">

<section class="contact-form-section">

<div class="contact-header">

<h1>

Let's Create Something Amazing

</h1>

<p>

Have a project in mind?

We'd love to hear about it.

Fill out the form below and we'll get back to you.

</p>

</div>

<?php if($success!=""){ ?>

<div class="success-message">

<i class="fas fa-circle-check"></i>

<?php echo $success; ?>

</div>

<?php } ?>

<?php if($error!=""){ ?>

<div class="error-message">

<i class="fas fa-circle-exclamation"></i>

<?php echo $error; ?>

</div>

<?php } ?>

<form

class="contact-form"

method="POST"

action="">

<div class="form-row">

<input

type="text"

id="name"

name="full_name"

placeholder="Your Name"

value="<?php echo htmlspecialchars($full_name ?? ''); ?>"

required>

<input

type="email"

id="email"

name="email"

placeholder="Your Email"

value="<?php echo htmlspecialchars($email ?? ''); ?>"

required>

<input

type="tel"

id="phone"

name="phone"

placeholder="Your Phone Number e.g. 0712345678"

maxlength="10"

pattern="[0-9]{10}"

title="Please enter exactly 10 digits"

value="<?php echo htmlspecialchars($phone ?? ''); ?>"

required>

</div>

<textarea

id="message"

name="message"

rows="8"

placeholder="Tell us about your project..."

required><?php echo htmlspecialchars($message ?? ''); ?></textarea>

<button

type="submit"

name="submit"

class="submit-button">

Submit Request

</button>

</form>
</section>

</main>

<script>

document.addEventListener("DOMContentLoaded",function(){

    const phoneInput=document.getElementById("phone");

    const contactForm=document.querySelector(".contact-form");

    if(contactForm){

        contactForm.addEventListener("submit",function(e){

            const phonePattern=/^\d{10}$/;

            if(!phonePattern.test(phoneInput.value)){

                e.preventDefault();

                alert("The phone number must contain exactly 10 digits.");

                phoneInput.focus();

            }

        });

    }

});

</script>

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

document.getElementById("currentYearFooter").textContent=new Date().getFullYear();

const headerHeight=document.querySelector("header").offsetHeight;

document.querySelector(".contact-page-main").style.paddingTop=`${headerHeight+20}px`;

</script>

<script src="js/main.js"></script>

</body>

</html>