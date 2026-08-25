<?php

require_once "includes/auth.php";
require_once "includes/connection.php";

// Check if ID exists
if(!isset($_GET['id']) || !is_numeric($_GET['id'])){

    header("Location: portfolio.php");
    exit();

}

$id = (int)$_GET['id'];

// Get the image before deleting
$stmt = $conn->prepare("SELECT image FROM portfolio WHERE project_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows == 0){

    header("Location: portfolio.php");
    exit();

}

$project = $result->fetch_assoc();

$imagePath = "../uploads/portfolio/" . $project['image'];

// Delete project from database
$stmt = $conn->prepare("DELETE FROM portfolio WHERE project_id = ?");
$stmt->bind_param("i", $id);

if($stmt->execute()){

    // Delete image from server
    if(file_exists($imagePath)){

        unlink($imagePath);

    }

    header("Location: portfolio.php?deleted=1");
    exit();

}else{

    die("Failed to delete project.");

}

?>