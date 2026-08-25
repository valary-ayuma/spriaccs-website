<?php

require_once "includes/auth.php";
require_once "includes/connection.php";

/*==================================
        LOAD SETTINGS
==================================*/

$result = $conn->query("
SELECT *
FROM settings
LIMIT 1
");

$settings = $result->fetch_assoc();

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Settings | Spriaccs CMS</title>

<link
rel="stylesheet"
href="assets/css/admin.css">

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

</head>

<body>

<?php include "includes/sidebar.php"; ?>

<div class="main-content">

<?php include "includes/topbar.php"; ?>

<div class="dashboard">

    <!--========================
            PAGE HEADER
    =========================-->

    <div class="settings-header">

        <div class="settings-header-left">

            <h1>

                <i class="fas fa-cog"></i>

                Website Settings

            </h1>

            <p>

                Manage your company branding, website information and SEO preferences.

            </p>

        </div>

        

    </div>

    <?php if(isset($_GET['success'])){ ?>

        <div class="success-alert">

            <i class="fas fa-circle-check"></i>

            Settings updated successfully.

        </div>

    <?php } ?>

    <form
        id="settingsForm"
        action="save-settings.php"
        method="POST"
        enctype="multipart/form-data">

        <div class="settings-wrapper">

<!--==================================
        COMPANY INFORMATION
===================================-->

<div class="settings-table">

    <div class="table-title">

        <div>

            <h2>Company Information</h2>

            <p>Update your company details and contact information.</p>

        </div>

    </div>

    <table class="settings-table-content">

        <tr>

            <td class="setting-name">

                Company Name

            </td>

            <td>

                <input
                    type="text"
                    name="company_name"
                    value="<?php echo htmlspecialchars($settings['company_name']); ?>"
                    required>

            </td>

        </tr>

        <tr>

            <td class="setting-name">

                Tagline

            </td>

            <td>

                <input
                    type="text"
                    name="tagline"
                    value="<?php echo htmlspecialchars($settings['tagline']); ?>">

            </td>

        </tr>

        <tr>

            <td class="setting-name">

                Email Address

            </td>

            <td>

                <input
                    type="email"
                    name="email"
                    value="<?php echo htmlspecialchars($settings['email']); ?>">

            </td>

        </tr>

        <tr>

            <td class="setting-name">

                Phone Number

            </td>

            <td>

                <input
                    type="text"
                    name="phone"
                    value="<?php echo htmlspecialchars($settings['phone']); ?>">

            </td>

        </tr>

        <tr>

            <td class="setting-name">

                Location

            </td>

            <td>

                <input
                    type="text"
                    name="location"
                    value="<?php echo htmlspecialchars($settings['location']); ?>">

            </td>

        </tr>

    </table>

</div>

<!--=================================
        BRANDING + SOCIAL MEDIA
==================================-->

<div class="settings-row">

   <!--==================================
            BRANDING
===================================-->

<div class="settings-table">

    <div class="table-title">

        <div>

            <h2>Branding</h2>

            <p>

                Upload your website branding assets.

            </p>

        </div>

    </div>

    <table class="settings-table-content">

        <tr>

            <td class="setting-name">

                Website Logo

            </td>

            <td>

                <input
                    type="file"
                    name="logo"
                    accept="image/*">

                <small class="upload-note">

                    Leave empty to keep the current logo.

                </small>

            </td>

        </tr>

        <tr>

            <td class="setting-name">

                Favicon

            </td>

            <td>

                <input
                    type="file"
                    name="favicon"
                    accept=".ico,.png,.jpg,.jpeg,.svg,.webp">

                <small class="upload-note">

                    Leave empty to keep the current favicon.

                </small>

            </td>

        </tr>

    </table>

</div>
    <!--==================================
        SOCIAL MEDIA
===================================-->

<div class="settings-table">

    <div class="table-title">

        <div>

            <h2>Social Media</h2>

            <p>

                Manage your official social media accounts.

            </p>

        </div>

    </div>

    <table class="settings-table-content">

        <tr>

            <td class="setting-name">

                Facebook

            </td>

            <td>

                <input
                    type="url"
                    name="facebook"
                    value="<?php echo htmlspecialchars($settings['facebook']); ?>"
                    placeholder="https://facebook.com/yourpage">

            </td>

        </tr>

        <tr>

            <td class="setting-name">

                Instagram

            </td>

            <td>

                <input
                    type="url"
                    name="instagram"
                    value="<?php echo htmlspecialchars($settings['instagram']); ?>"
                    placeholder="https://instagram.com/yourpage">

            </td>

        </tr>

        <tr>

            <td class="setting-name">

                TikTok

            </td>

            <td>

                <input
                    type="url"
                    name="tiktok"
                    value="<?php echo htmlspecialchars($settings['tiktok']); ?>"
                    placeholder="https://tiktok.com/@yourpage">

            </td>

        </tr>

        <tr>

            <td class="setting-name">

                WhatsApp

            </td>

            <td>

                <input
                    type="url"
                    name="whatsapp"
                    value="<?php echo htmlspecialchars($settings['whatsapp']); ?>"
                    placeholder="https://wa.me/2547XXXXXXXX">

            </td>

        </tr>

    </table>

</div>
<!--==================================
        SEO SETTINGS
===================================-->

<div class="settings-table">

    <div class="table-title">

        <div>

            <h2>SEO Settings</h2>

            <p>

                Configure how your website appears on search engines.

            </p>

        </div>

    </div>

    <table class="settings-table-content">

        <tr>

            <td class="setting-name">

                Website Title

            </td>

            <td>

                <input
                    type="text"
                    name="seo_title"
                    value="<?php echo htmlspecialchars($settings['seo_title']); ?>"
                    placeholder="Spriaccs | Creative Agency">

            </td>

        </tr>

        <tr>

            <td class="setting-name">

                Meta Description

            </td>

            <td>

                <textarea
                    name="seo_description"
                    rows="5"
                    placeholder="Enter a short description of your website..."><?php echo htmlspecialchars($settings['seo_description']); ?></textarea>

            </td>

        </tr>

        <tr>

            <td class="setting-name">

                Meta Keywords

            </td>

            <td>

                <textarea
                    name="seo_keywords"
                    rows="4"
                    placeholder="branding, graphic design, web design, creative agency"><?php echo htmlspecialchars($settings['seo_keywords']); ?></textarea>

            </td>

        </tr>

    </table>

</div>
<!--==================================
            WEBSITE
===================================-->

<div class="settings-table">

    <div class="table-title">

        <div>

            <h2>Website</h2>

            <p>

                Manage your website preferences and footer information.

            </p>

        </div>

    </div>

    <table class="settings-table-content">

        <tr>

            <td class="setting-name">

                Copyright Text

            </td>

            <td>

                <input
                    type="text"
                    name="copyright"
                    value="<?php echo htmlspecialchars($settings['copyright']); ?>"
                    placeholder="© Spriaccs. All Rights Reserved.">

            </td>

        </tr>

        

    </table>

</div>
<!--========================
        SAVE BUTTON
=========================-->

<div class="settings-footer">

    <button
        type="submit"
        class="save-btn">

        <i class="fas fa-save"></i>

        Save Settings

    </button>

</div>

</form>

</div>

</div>

<script src="assets/js/admin.js"></script>

</body>

</html>