<?php

require_once "includes/connection.php";

header("Content-Type: application/json");

if($_SERVER['REQUEST_METHOD'] != "POST"){

    echo json_encode([
        "success" => false
    ]);

    exit();

}

$email = trim($_POST['email'] ?? '');

if(empty($email)){

    echo json_encode([
        "success" => false
    ]);

    exit();

}

$stmt = $conn->prepare("
    SELECT status
    FROM newsletter
    WHERE email=?
");

$stmt->bind_param("s",$email);

$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows == 0){

    echo json_encode([
        "success"=>true,
        "status"=>"not_found"
    ]);

    exit();

}

$row = $result->fetch_assoc();

echo json_encode([
    "success"=>true,
    "status"=>$row['status']
]);

?>