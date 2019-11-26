<?php

$_SESSION["eid"] = "";
session_start();
require_once "config.php";

$start_monday = filter_input(INPUT_POST, 'start_monday');
$start_tuesday = filter_input(INPUT_POST, 'start_tuesday');
$start_wednesday = filter_input(INPUT_POST, 'start_wednesday');
$start_thursday = filter_input(INPUT_POST, 'start_thursday');
$start_friday = filter_input(INPUT_POST, 'start_friday');
$start_saturday = filter_input(INPUT_POST, 'start_saturday');
$start_sunday = filter_input(INPUT_POST, 'start_sunday');
$start_meridiem =  filter_input(INPUT_POST, 'start_meridiem');

$end_monday = filter_input(INPUT_POST, 'end_monday');
$end_tuesday = filter_input(INPUT_POST, 'end_tuesday');
$end_wednesday = filter_input(INPUT_POST, 'end_wednesday');
$end_thursday = filter_input(INPUT_POST, 'end_thursday');
$end_friday = filter_input(INPUT_POST, 'end_friday');
$end_saturday = filter_input(INPUT_POST, 'end_saturday');
$end_sunday = filter_input(INPUT_POST, 'end_sunday');
$end_meridiem =  filter_input(INPUT_POST, 'end_meridiem');


echo $start_monday;
echo $start_tuesday;
echo $start_wednesday;
echo $start_thursday;
echo $start_friday;
echo $start_saturday;
echo $start_sunday;

echo $end_monday;
echo $end_tuesday;
echo $end_wednesday;
echo $end_thursday;
echo $end_friday;
echo $end_saturday;
echo $end_sunday;

echo $_SESSION["eid"];

// $newRequest = "insert into webportal_db.scheduler_requests (eventid, title, start, end, color) values (?, ?, ?, ?, ?)";
// if ($link->connect_errno) {
//     printf("Connect failed: %s\n", $link->connect_error);
//     exit();
// }

// $stmt = $link->prepare($newRequest);
// $stmt->bind_param("issss", $eventId, $title, $start, $end, $colorHash);
// $stmt->execute();

// $newId = $link->insert_id;
// if (!is_null($newId)) {
//     echo "New record created successfully. Last inserted ID is: " . $newId;
// } else {
//     echo "Error: " . $sql . "<br>" . $link->error;
// }