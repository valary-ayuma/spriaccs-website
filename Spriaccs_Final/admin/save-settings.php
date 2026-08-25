<?php

require_once "includes/auth.php";
require_once "includes/connection.php";

/*==================================
        GET CURRENT SETTINGS
==================================*/

$current = $conn->query("
SELECT logo,favicon
FROM settings
LIMIT 1
")->fetch_assoc();

$logo = $current['logo'];
$favicon = $current['favicon'];


/*==================================
        UPLOAD LOGO
==================================*/

if(isset($_FILES['logo']) && $_FILES['logo']['error'] == 0){

    $extension = strtolower(pathinfo(
        $_FILES['logo']['name'],
        PATHINFO_EXTENSION
    ));

    $logoName = "logo_" . time() . "." . $extension;

    move_uploaded_file(
        $_FILES['logo']['tmp_name'],
        "../uploads/" . $logoName
    );

    $logo = $logoName;
}


/*==================================
        UPLOAD FAVICON
==================================*/

if(isset($_FILES['favicon']) && $_FILES['favicon']['error'] == 0){

    $extension = strtolower(pathinfo(
        $_FILES['favicon']['name'],
        PATHINFO_EXTENSION
    ));

    $faviconName = "favicon_" . time() . "." . $extension;

    move_uploaded_file(
        $_FILES['favicon']['tmp_name'],
        "../uploads/" . $faviconName
    );

    $favicon = $faviconName;
}


/*==================================
        UPDATE SETTINGS
==================================*/

$stmt = $conn->prepare("

UPDATE settings SET

company_name=?,
tagline=?,
email=?,
phone=?,
location=?,

logo=?,
favicon=?,

facebook=?,
instagram=?,
tiktok=?,
whatsapp=?,

seo_title=?,
seo_description=?,
seo_keywords=?,

copyright=?

WHERE setting_id=1

");

$stmt->bind_param(

"sssssssssssssss",

$_POST['company_name'],
$_POST['tagline'],
$_POST['email'],
$_POST['phone'],
$_POST['location'],

$logo,
$favicon,

$_POST['facebook'],
$_POST['instagram'],
$_POST['tiktok'],
$_POST['whatsapp'],

$_POST['seo_title'],
$_POST['seo_description'],
$_POST['seo_keywords'],

$_POST['copyright']

);

$stmt->execute();

header("Location: settings.php?success=1");

exit;

?>