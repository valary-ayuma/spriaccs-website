<?php

require_once "includes/auth.php";
require_once "includes/connection.php";

if(!isset($_GET['id']) || !is_numeric($_GET['id'])){

    header("Location: newsletter.php");
    exit();

}

$id = (int)$_GET['id'];

/*==================================
        CHECK SUBSCRIBER
==================================*/

$stmt = $conn->prepare("
    SELECT subscriber_id
    FROM newsletter
    WHERE subscriber_id=?
");

$stmt->bind_param("i",$id);

$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows == 0){

    header("Location: newsletter.php");
    exit();

}

/*==================================
        DELETE
==================================*/

$stmt = $conn->prepare("
    DELETE FROM newsletter
    WHERE subscriber_id=?
");

$stmt->bind_param("i",$id);

if($stmt->execute()){

    header("Location: newsletter.php?deleted=1");
    exit();

}

header("Location: newsletter.php");

exit();

?>