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

//$search = "SELECT * FROM existing_queue WHERE eid = '" . $eid . "'";
$sql = "DELETE FROM existing_queue WHERE eid = ?";
if ($link->connect_errno) {
    printf("Connect failed: %s\n", $link->connect_error);
    exit();
}

//$query = $link->prepare($search);
//$results = $query->execute();
//if($results->num_rows == 0) {
    $stmt = $link->prepare($sql);
    $stmt->bind_param("s", $eid);
    $stmt->execute();
//} else {
//    $message = "You are already in the queue.";
//    echo "<script type='text/javascript'>alert('$message');</script>";
//}

$newId = $link->insert_id;
if (!is_null($newId)) {
    echo "New record created successfully. Last inserted ID is: " . $newId;
} else {
    echo "Error: " . $sql . "<br>" . $link->error;
}

header('Location: index.php');