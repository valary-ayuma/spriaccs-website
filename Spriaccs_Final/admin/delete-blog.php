<?php

require_once "includes/auth.php";
require_once "includes/connection.php";

/*==================================
    VALIDATE ID
==================================*/

if(!isset($_GET['id']) || !is_numeric($_GET['id'])){

    header("Location: blog.php");
    exit();

}

$id = (int)$_GET['id'];

/*==================================
    CHECK IF BLOG EXISTS
==================================*/

$check = $conn->prepare("SELECT blog_id FROM blog WHERE blog_id = ?");
$check->bind_param("i", $id);
$check->execute();

$result = $check->get_result();

if($result->num_rows == 0){

    header("Location: blog.php");
    exit();

}

/*==================================
    DELETE BLOG
==================================*/

$delete = $conn->prepare("DELETE FROM blog WHERE blog_id = ?");
$delete->bind_param("i", $id);

if($delete->execute()){

    header("Location: blog.php?deleted=1");
    exit();

}else{

    header("Location: blog.php?error=1");
    exit();

}

?>