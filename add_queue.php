<?php


//$_SESSION["eid"] = "";
//$_SESSION["fname"] = "";
//$_SESSION["lname"] = "";
session_start();
require_once "config.php";


$eid = $_SESSION["eid"];
$fname = $_SESSION["fname"];
$lname = $_SESSION["lname"];
$classnum = filter_input(INPUT_POST, "numClass");

$sql = "INSERT INTO existing_queue (eid, fname, lname, classnum) values (?, ?, ?, ?)";
if ($link->connect_errno) {
    printf("Connect failed: %s\n", $link->connect_error);
    exit();
}

$stmt = $link->prepare($sql);
$stmt->bind_param("ssss", $eid, $fname, $lname, $classnum);
$stmt->execute();

$newId = $link->insert_id;
if (!is_null($newId)) {
    echo "New record created successfully. Last inserted ID is: " . $newId;
} else {
    echo "Error: " . $sql . "<br>" . $link->error;
}

header('Location: index.php');