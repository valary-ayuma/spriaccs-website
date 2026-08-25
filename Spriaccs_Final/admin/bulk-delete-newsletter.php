<?php

require_once "includes/auth.php";
require_once "includes/connection.php";

if(!isset($_POST['selected'])){

    header("Location: newsletter.php");

    exit();

}

$selected = $_POST['selected'];

if(count($selected)==0){

    header("Location: newsletter.php");

    exit();

}

$placeholders = implode(",",array_fill(0,count($selected),"?"));

$types = str_repeat("i",count($selected));

$sql = "DELETE FROM newsletter WHERE subscriber_id IN ($placeholders)";

$stmt = $conn->prepare($sql);

$stmt->bind_param($types,...$selected);

$stmt->execute();

header("Location: newsletter.php?bulkdeleted=1");

exit();

?>