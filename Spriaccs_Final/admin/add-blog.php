<?php

require_once "includes/auth.php";
require_once "includes/connection.php";

$message = "";
$messageType = "";

if(isset($_POST['add'])){

    $title = trim($_POST['title']);
    $category = trim($_POST['category']);
    $content = trim($_POST['content']);

    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));

    $image = "";

    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){

        $allowed = ['jpg','jpeg','png','webp'];
        $extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

        if(in_array($extension, $allowed)){

            if(!is_dir("../uploads/blog")){
                mkdir("../uploads/blog", 0777, true);
            }

            $filename = time() . "_" . uniqid() . "." . $extension;
            $destination = "../uploads/blog/" . $filename;

            if(move_uploaded_file($_FILES['image']['tmp_name'], $destination)){
                $image = $filename;
            }

        }

    }

    $stmt = $conn->prepare("INSERT INTO blog (title, slug, category, content, image, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("sssss", $title, $slug, $category, $content, $image);

    if($stmt->execute()){
        header("Location: blog.php?success=1");
        exit();
    }

    $message = "Failed to add blog post.";
    $messageType = "error";

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Add Blog | Spriaccs CMS</title>
<link rel="stylesheet" href="assets/css/admin.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>

<?php include "includes/sidebar.php"; ?>

<div class="main-content">

<?php include "includes/topbar.php"; ?>

<div class="dashboard">

<div class="page-header">
<div>
<h1>Add New Blog</h1>
<p>Create a new article for your website layout.</p>
</div>
<a href="blog.php" class="add-btn">
<i class="fas fa-arrow-left"></i> Back
</a>
</div>

<?php if($message != ""){ ?>
<div class="alert <?php echo $messageType; ?>"><?php echo $message; ?></div>
<?php } ?>

<form class="admin-form" method="POST" enctype="multipart/form-data">

<label>Blog Title</label>
<input type="text" name="title" required placeholder="Enter article title...">

<label>Category</label>
<select name="category" required>
<option value="" disabled selected>Select category</option>
<?php
$categories = ["Brand Identity", "Website Design", "Graphic Design", "Marketing Design"];
foreach($categories as $cat){
    echo "<option value=\"$cat\">$cat</option>";
}
?>
</select>

<label>Blog Content</label>
<textarea name="content" rows="10" required placeholder="Write your article content here..."></textarea>

<label>Featured Image (Optional for Sub-articles)</label>
<input type="file" name="image" accept=".jpg,.jpeg,.png,.webp">
<p class="upload-note">Only required if this post will be used as a Featured Block (1 or 6) with an image layout.</p>

<button class="save-btn" type="submit" name="add">
<i class="fas fa-plus"></i> Publish Blog
</button>

</form>

</div>
</div>

</body>
</html>