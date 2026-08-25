<?php

require_once "includes/auth.php";
require_once "includes/connection.php";

header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=newsletter-subscribers.csv");

$output = fopen("php://output","w");

fputcsv($output,[
    "Subscriber ID",
    "Email",
    "Status",
    "Subscribed On"
]);

$result = $conn->query("
    SELECT *
    FROM newsletter
    ORDER BY created_at DESC
");

while($row = $result->fetch_assoc()){

    fputcsv($output,[
        $row['subscriber_id'],
        $row['email'],
        $row['status'],
        date("d M Y",strtotime($row['created_at']))
    ]);

}

fclose($output);

exit();

?>