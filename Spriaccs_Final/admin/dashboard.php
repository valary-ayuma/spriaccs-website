<?php

require_once "includes/auth.php";
require_once "includes/connection.php";

$services = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM services"));

$portfolio = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM portfolio"));

$blog = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM blog"));

$quote = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM quote"));
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard | Spriaccs CMS</title>

<link rel="stylesheet" href="assets/css/admin.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

</head>

<body>

<?php include "includes/sidebar.php"; ?>

<div class="main-content">

<?php include "includes/topbar.php"; ?>

<div class="dashboard">

    <div class="welcome-banner">

        <div>

            <h1>
                Welcome back,
                <?php echo $_SESSION['admin_name']; ?> 👋
            </h1>

            <p>
                Here's what's happening with your Spriaccs website today.
            </p>

        </div>

        <a href="../index.php" target="_blank" class="visit-site">

            <i class="fas fa-globe"></i>

            View Website

        </a>

    </div>

    <div class="cards">

        <div class="card">

            <i class="fas fa-layer-group"></i>

            <h2><?php echo $services; ?></h2>

            <span>What We Do</span>

        </div>

        <div class="card">

            <i class="fas fa-images"></i>

            <h2><?php echo $portfolio; ?></h2>

            <span>Case Studies</span>

        </div>

        <div class="card">

            <i class="fas fa-newspaper"></i>

            <h2><?php echo $blog; ?></h2>

            <span>Blog</span>

        </div>

        <div class="card">

            <i class="fas fa-envelope"></i>

            <h2><?php echo $quote; ?></h2>

            <span>Quote Requests</span>

        </div>

    </div>

    <div class="dashboard-grid">

        <!-- Activity -->

        <div class="activity">

            <h3>

                Recent Activity

            </h3>

            <ul>

                <li>
                    <i class="fas fa-check-circle"></i>
                    Case Study updated
                </li>

                <li>
                    <i class="fas fa-check-circle"></i>
                    Blog published
                </li>

                <li>
                    <i class="fas fa-check-circle"></i>
                    Newsletter subscriber added
                </li>

                <li>
                    <i class="fas fa-check-circle"></i>
                    New quote request received
                </li>

            </ul>

        </div>

        <!-- Quick Actions -->

        <div class="quick-actions">

            <h3>

                Quick Actions

            </h3>

            <a href="services.php">

                <i class="fas fa-plus"></i>

                Add Service

            </a>

            <a href="portfolio.php">

                <i class="fas fa-plus"></i>

                Add Case Study

            </a>

            <a href="blog.php">

                <i class="fas fa-plus"></i>

                Write Blog

            </a>

            <a href="../index.php" target="_blank">

                <i class="fas fa-eye"></i>

                Visit Website

            </a>

        </div>

    </div>

</div>

<script src="assets/js/admin.js"></script>

</body>

</html>