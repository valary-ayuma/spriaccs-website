<?php

require_once "includes/auth.php";
require_once "includes/connection.php";

/*==================================
        VALIDATE ID
==================================*/

if(!isset($_GET['id']) || !is_numeric($_GET['id'])){

    header("Location: quote.php");
    exit();

}

$id = (int)$_GET['id'];

/*==================================
        CHECK IF RECORD EXISTS
==================================*/

$stmt = $conn->prepare("
    SELECT message_id
    FROM quote
    WHERE message_id=?
");

$stmt->bind_param("i",$id);

$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows==0){

    header("Location: quote.php");
    exit();

}

/*==================================
        DELETE RECORD
==================================*/

$stmt = $conn->prepare("
    DELETE
    FROM quote
    WHERE message_id=?
");

$stmt->bind_param("i",$id);

if($stmt->execute()){

    header("Location: quote.php?deleted=1");
    exit();

}

header("Location: quote.php");

exit();

?>