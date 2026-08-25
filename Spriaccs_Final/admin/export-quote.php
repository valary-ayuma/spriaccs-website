<?php

require_once "includes/auth.php";
require_once "includes/connection.php";

/*==================================
        CSV HEADERS
==================================*/

$filename = "customer_enquiries_" . date("Y-m-d_H-i-s") . ".csv";

header("Content-Type: text/csv; charset=UTF-8");
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Pragma: no-cache");
header("Expires: 0");

/*==================================
        OPEN OUTPUT
==================================*/

$output = fopen("php://output","w");

/*==================================
        COLUMN HEADINGS
==================================*/

fputcsv($output,[
    "ID",
    "Full Name",
    "Email",
    "Phone",
    "Status",
    "Date Submitted",
    "Message"
]);

/*==================================
        FETCH DATA
==================================*/

$result = $conn->query("
    SELECT
    message_id,
    full_name,
    email,
    phone,
    status,
    created_at,
    message
    FROM quote
    ORDER BY created_at DESC
");

/*==================================
        WRITE ROWS
==================================*/

while($row = $result->fetch_assoc()){

    fputcsv($output,[

        $row['message_id'],

        $row['full_name'],

        $row['email'],

        $row['phone'],

        $row['status'],

        date("d M Y H:i",strtotime($row['created_at'])),

        str_replace(
            ["\r","\n"],
            " ",
            $row['message']
        )

    ]);

}

/*==================================
        CLOSE
==================================*/

fclose($output);

exit();

?>