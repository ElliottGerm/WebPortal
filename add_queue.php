<?php

$_SESSION["eid"] = "";
$_SESSION["fname"] = "";
$_SESSION["lname"] = "";
session_start();
require_once "config.php";


$_SESSION["eid"] = filter_input(INPUT_POST, "eid");
$_SESSION["fname"] = filter_input(INPUT_POST, "fname");
$_SESSION["lname"] = filter_input(INPUT_POST, "lname");
$classnum = filter_input(INPUT_POST, "numClass");

$newQueue = "insert into webportal_db.existing_queue (eid, fname, lname, numClass) values (?, ?, ?, ?)";
if ($link->connect_errno) {
    printf("Connect failed: %s\n", $link->connect_error);
    exit();
}

$stmt = $link->prepare($newQueue);
$stmt->bind_param("ssss", $_SESSION["eid"], $_SESSION["fname"], $_SESSION["lname"], $classnum);
$stmt->execute();

$newId = $link->insert_id;
if (!is_null($newId)) {
    echo "New record created successfully. Last inserted ID is: " . $newId;
} else {
    echo "Error: " . $sql . "<br>" . $link->error;
}

header('Location: index.php');
