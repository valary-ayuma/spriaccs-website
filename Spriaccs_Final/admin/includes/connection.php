<?php

$conn = new mysqli(
    "YOUR_HOST",
    "YOUR_USERNAME",
    "YOUR_PASSWORD",
    "YOUR_DATABASE"
);

if ($conn->connect_error) {
    die("Database connection failed.");
}