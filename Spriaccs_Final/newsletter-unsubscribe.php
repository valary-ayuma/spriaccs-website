<?php

require_once "includes/connection.php";

header("Content-Type: application/json");

/*==================================
        VALIDATE REQUEST
==================================*/

if($_SERVER['REQUEST_METHOD'] != "POST"){

    echo json_encode([
        "success" => false,
        "message" => "Invalid request."
    ]);

    exit();

}

/*==================================
        GET EMAIL
==================================*/

$email = trim($_POST['email'] ?? '');

if(empty($email)){

    echo json_encode([
        "success" => false,
        "message" => "Email address is required."
    ]);

    exit();

}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){

    echo json_encode([
        "success" => false,
        "message" => "Invalid email address."
    ]);

    exit();

}

/*==================================
        CHECK IF EXISTS
==================================*/

$stmt = $conn->prepare("
    SELECT subscriber_id, status
    FROM newsletter
    WHERE email=?
");

$stmt->bind_param("s", $email);

$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows == 0){

    echo json_encode([
        "success" => false,
        "message" => "This email is not subscribed."
    ]);

    exit();

}

$subscriber = $result->fetch_assoc();

/*==================================
        ALREADY UNSUBSCRIBED
==================================*/

if($subscriber['status'] == "Unsubscribed"){

    echo json_encode([
        "success" => true,
        "status" => "unsubscribed",
        "message" => "You are already unsubscribed."
    ]);

    exit();

}

/*==================================
        UPDATE STATUS
==================================*/

$stmt = $conn->prepare("
    UPDATE newsletter
    SET status='Unsubscribed'
    WHERE subscriber_id=?
");

$stmt->bind_param("i", $subscriber['subscriber_id']);

if($stmt->execute()){

    echo json_encode([
        "success" => true,
        "status" => "unsubscribed",
        "message" => "You have been unsubscribed successfully."
    ]);

}else{

    echo json_encode([
        "success" => false,
        "message" => "Unable to unsubscribe. Please try again."
    ]);

}

?>