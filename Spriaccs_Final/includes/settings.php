<?php

require_once __DIR__ . "/connection.php";

$settings = $conn->query("
SELECT *
FROM settings
LIMIT 1
")->fetch_assoc();

?>