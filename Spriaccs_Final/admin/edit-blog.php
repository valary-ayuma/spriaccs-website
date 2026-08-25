<?php

require_once "includes/auth.php";
require_once "includes/connection.php";

if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
    header("Location: blog.php");
    exit();
}

$id = (int)$_GET['id'];

$stmt = $conn->prepare("SELECT * FROM blog WHERE blog_id=?");
$stmt->bind_param("i",$id);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows==0){
    header("Location: blog.php");
    exit();
}

$blog = $result->fetch_assoc();

$message="";
$messageType="";

if(isset($_POST['update'])){

    $title = trim($_POST['title']);
    $category = trim($_POST['category']);
    $content = trim($_POST['content']);
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));

    $image = $blog['image'];

    if(isset($_FILES['image']) && $_FILES['image']['error']==0){
        $allowed=['jpg','jpeg','png','webp'];
        $extension=strtolower(pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION));

        if(in_array($extension,$allowed)){
            if(!is_dir("../uploads/blog")){
                mkdir("../uploads/blog",0777,true);
            }

            $filename=time()."_".uniqid().".".$extension;
            $destination="../uploads/blog/".$filename;

            if(move_uploaded_file($_FILES['image']['tmp_name'],$destination)){
                if(!empty($blog['image']) && file_exists("../uploads/blog/".$blog['image'])){
                    unlink("../uploads/blog/".$blog['image']);
                }
                $image=$filename;
            }
        }
    }

    $stmt=$conn->prepare("UPDATE blog SET title=?, slug=?, category=?, content=?, image=? WHERE blog_id=?");
    $stmt->bind_param("sssssi", $title, $slug, $category, $content, $image, $id);

    if($stmt->execute()){
        header("Location: blog.php?updated=1");
        exit();
    }

    $message="Failed to update blog.";
    $messageType="error";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Edit Blog | Spriaccs CMS</title>
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
<h1>Edit Blog</h1>
<p>Update your blog article layout content.</p>
</div>
<a href="blog.php" class="add-btn"><i class="fas fa-arrow-left"></i> Back</a>
</div>

<?php if($message!=""){ ?>
<div class="alert <?php echo $messageType; ?>"><?php echo $message; ?></div>
<?php } ?>

<form class="admin-form" method="POST" enctype="multipart/form-data">

<label>Blog Title</label>
<input type="text" name="title" required value="<?php echo htmlspecialchars($blog['title']); ?>">

<label>Category</label>
<select name="category" required>
<?php
$categories=["Brand Identity", "Website Design", "Graphic Design", "Marketing Design"];
foreach($categories as $cat){
    $selected = ($blog['category'] == $cat) ? "selected" : "";
    echo "<option value=\"$cat\" $selected>$cat</option>";
}
?>
</select>

<label>Blog Content</label>
<textarea name="content" rows="10" required><?php echo htmlspecialchars($blog['content']); ?></textarea>

<label>Current Image</label>
<?php if(!empty($blog['image'])){ ?>
<img src="../uploads/blog/<?php echo htmlspecialchars($blog['image']); ?>" class="portfolio-thumb" style="margin-bottom:20px; max-width: 200px; display: block;">
<?php } else { ?>
<p style="color: #777; margin-bottom: 20px;">No image uploaded for this block item.</p>
<?php } ?>

<label>Replace/Add Image (Optional)</label>
<input type="file" name="image" accept=".jpg,.jpeg,.png,.webp">
<p class="upload-note">Leave empty to keep current status.</p>

<button class="save-btn" type="submit" name="update">
<i class="fas fa-save"></i> Update Blog
</button>

</form>

</div>
</div>

</body>
</html>