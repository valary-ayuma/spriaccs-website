<?php

require_once "includes/auth.php";
require_once "includes/connection.php";

$search = "";

if(isset($_GET['search'])){
    $search = trim($_GET['search']);
    $stmt = $conn->prepare("
        SELECT * FROM blog
        WHERE title LIKE CONCAT('%', ?, '%')
        OR category LIKE CONCAT('%', ?, '%')
        ORDER BY blog_id DESC
        LIMIT 6
    ");
    $stmt->bind_param("ss",$search,$search);
}else{
    $stmt = $conn->prepare("
        SELECT * FROM blog
        ORDER BY blog_id DESC
        LIMIT 6
    ");
}

$stmt->execute();
$result = $stmt->get_result();

$blogs = [];
while($row = $result->fetch_assoc()){
    $blogs[] = $row;
}
$totalBlogs = count($blogs);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Blog Management | Spriaccs CMS</title>
<link rel="stylesheet" href="assets/css/admin.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
<style>
/* Admin Preview Layout Styles */
.admin-blog-preview {
    max-width: 1000px;
    margin: 0 auto;
    padding: 20px 0;
}
.preview-card {
    background: #fff;
    padding: 20px 25px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.04);
    margin-bottom: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-left: 5px solid #003B95;
}
.preview-card.featured {
    border-left-color: #28a745;
}
.preview-info span {
    font-size: 0.8rem;
    color: #6c757d;
    text-transform: uppercase;
    font-weight: 600;
}
.preview-info h3 {
    color: #333;
    font-size: 1.2rem;
    margin: 5px 0;
}
.preview-info p {
    color: #666;
    font-size: 0.9rem;
    margin: 0;
}
.preview-meta {
    display: flex;
    align-items: center;
    gap: 15px;
}
.block-badge {
    background: #e9ecef;
    padding: 5px 10px;
    border-radius: 4px;
    font-size: 0.8rem;
    font-weight: 600;
    color: #495057;
}
.admin-actions a {
    color: #555;
    background: #f8f9fa;
    padding: 8px 12px;
    border-radius: 4px;
    margin-left: 5px;
    text-decoration: none;
    font-size: 0.9rem;
    border: 1px solid #ddd;
}
.admin-actions a.edit-btn:hover { background: #003B95; color: #fff; border-color: #003B95; }
.admin-actions a.delete-btn:hover { background: #dc3545; color: #fff; border-color: #dc3545; }
</style>
</head>
<body>

<?php include "includes/sidebar.php"; ?>

<div class="main-content">

<?php include "includes/topbar.php"; ?>

<div class="dashboard">

<div class="page-header">
    <div>
        <h1>Blog Layout Manager</h1>
        <p>Manage the 6 designated slots for your frontend website structure.</p>
    </div>
    <a href="add-blog.php" class="add-btn">
        <i class="fas fa-plus"></i> Add Blog Post
    </a>
</div>

<?php if(isset($_GET['success'])){ ?><div class="success-message"><i class="fas fa-circle-check"></i> Blog created successfully.</div><?php } ?>
<?php if(isset($_GET['updated'])){ ?><div class="success-message"><i class="fas fa-circle-check"></i> Blog updated successfully.</div><?php } ?>
<?php if(isset($_GET['deleted'])){ ?><div class="success-message"><i class="fas fa-circle-check"></i> Blog deleted successfully.</div><?php } ?>

<div class="admin-blog-preview">

<?php if($totalBlogs > 0){ ?>
    <?php foreach($blogs as $index => $blog){ 
        $blockNum = $index + 1;
        $isFeatured = ($blockNum == 1 || $blockNum == 6);
    ?>
        <div class="preview-card <?php echo $isFeatured ? 'featured' : ''; ?>">
            <div class="preview-info">
                <span><?php echo htmlspecialchars($blog['category']); ?></span>
                <h3><?php echo htmlspecialchars($blog['title']); ?></h3>
                <p><?php echo substr(strip_tags($blog['content'] ?? ''), 0, 90); ?>...</p>
            </div>
            <div class="preview-meta">
                <span class="block-badge">Block #<?php echo $blockNum; ?> <?php echo $isFeatured ? '(With Image)' : '(Text Only)'; ?></span>
                <div class="admin-actions">
                    <a href="edit-blog.php?id=<?php echo $blog['blog_id']; ?>" class="edit-btn" title="Edit Post"><i class="fas fa-pen"></i></a>
                    <a href="delete-blog.php?id=<?php echo $blog['blog_id']; ?>" class="delete-btn" title="Delete Post" onclick="return confirm('Are you sure you want to delete this blog post?')"><i class="fas fa-trash"></i></a>
                </div>
            </div>
        </div>
    <?php } ?>
<?php } else { ?>
    <div style="text-align:center;padding:60px; background:#fff; border-radius:12px;">
        <i class="fas fa-newspaper" style="font-size:3rem;color:#ccc;"></i>
        <br><br>
        <h3>No blog slots filled yet.</h3>
        <p>Click "Add Blog Post" to start populating your 6-block layout.</p>
    </div>
<?php } ?>

</div>

</div>

</div>

<script src="assets/js/admin.js"></script>

</body>
</html>