<?php

require_once "includes/auth.php";
require_once "includes/connection.php";

/*==================================
        CHECK SELECTION
==================================*/

if(
    !isset($_POST['selected']) ||
    !is_array($_POST['selected']) ||
    count($_POST['selected']) == 0
){

    header("Location: quote.php");

    exit();

}

$selected = array_map('intval', $_POST['selected']);

/*==================================
        BUILD PLACEHOLDERS
==================================*/

$placeholders = implode(",", array_fill(0, count($selected), "?"));

$types = str_repeat("i", count($selected));

$sql = "DELETE FROM quote WHERE message_id IN ($placeholders)";

$stmt = $conn->prepare($sql);

$stmt->bind_param($types, ...$selected);

$stmt->execute();

header("Location: quote.php?bulkdeleted=1");

exit();

?>