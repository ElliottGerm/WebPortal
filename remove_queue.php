<?php

session_start();
require_once "config.php";


$eid = $_SESSION["eid"];
$fname = $_SESSION["fname"];
$lname = $_SESSION["lname"];
$curr_user = filter_input(INPUT_POST, "user");

$sql = "DELETE FROM existing_queue WHERE eid = ?";
if ($link->connect_errno) {
    printf("Connect failed: %s\n", $link->connect_error);
    exit();
}

$stmt = $link->prepare($sql);
$stmt->bind_param("s", $curr_user);
$stmt->execute();

header('Location: index.php');
