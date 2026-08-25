<?php

require_once "includes/connection.php";

header("Content-Type: application/json");

if($_SERVER['REQUEST_METHOD']!="POST"){

    echo json_encode([
        "success"=>false,
        "message"=>"Invalid request."
    ]);

    exit();

}

$email = trim($_POST['email'] ?? '');

if(empty($email)){

    echo json_encode([
        "success"=>false,
        "message"=>"Please enter your email."
    ]);

    exit();

}

if(!filter_var($email,FILTER_VALIDATE_EMAIL)){

    echo json_encode([
        "success"=>false,
        "message"=>"Invalid email address."
    ]);

    exit();

}

/* Check if email exists */

$stmt = $conn->prepare("
SELECT subscriber_id,status
FROM newsletter
WHERE email=?
");

$stmt->bind_param("s",$email);

$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows){

    $subscriber = $result->fetch_assoc();

    if($subscriber['status']=="Active"){

        echo json_encode([
            "success"=>true,
            "status"=>"active",
            "email"=>$email,
            "message"=>"Already subscribed."
        ]);

        exit();

    }

    /* Reactivate */

    $stmt = $conn->prepare("
    UPDATE newsletter
    SET status='Active'
    WHERE subscriber_id=?
    ");

    $stmt->bind_param(
        "i",
        $subscriber['subscriber_id']
    );

    $stmt->execute();

    echo json_encode([
        "success"=>true,
        "status"=>"active",
        "email"=>$email,
        "message"=>"Subscription restored."
    ]);

    exit();

}

/* New subscriber */

$stmt = $conn->prepare("
INSERT INTO newsletter
(email,status)
VALUES
(?,'Active')
");

$stmt->bind_param("s",$email);

$stmt->execute();

echo json_encode([
    "success"=>true,
    "status"=>"active",
    "email"=>$email,
    "message"=>"Thank you for subscribing!"
]);

?>