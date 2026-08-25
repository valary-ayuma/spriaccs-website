<?php

require_once "includes/auth.php";
require_once "includes/connection.php";

/*==================================
    VALIDATE ID
==================================*/

if(!isset($_GET['id']) || !is_numeric($_GET['id'])){

    header("Location: services.php");
    exit();

}

$id = (int)$_GET['id'];

/*==================================
    CHECK IF SERVICE EXISTS
==================================*/

$check = $conn->prepare("SELECT service_id FROM services WHERE service_id = ?");
$check->bind_param("i", $id);
$check->execute();

$result = $check->get_result();

if($result->num_rows == 0){

    header("Location: services.php");
    exit();

}

/*==================================
    DELETE SERVICE
==================================*/

$delete = $conn->prepare("DELETE FROM services WHERE service_id = ?");
$delete->bind_param("i", $id);

if($delete->execute()){

    header("Location: services.php?deleted=1");
    exit();

}else{

    header("Location: services.php?error=1");
    exit();

}

?>