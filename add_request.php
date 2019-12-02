<?php

$_SESSION["eid"] = "";
session_start();
date_default_timezone_set('US/Eastern');
require_once "config.php";

$days = [
    0 => "monday",
    1 => "tuesday",
    2 => "wednesday",
    3 => "thursday",
    4 => "friday",
    5 => "saturday",
    6 => "sunday"
];

$start_meridiems = array();
$end_meridiems = array();

foreach ($days as $day) {
    $start_meridiems[] = filter_input(INPUT_POST, 'start_meridiem_' . $day);
    $end_meridiems[] = filter_input(INPUT_POST, 'end_meridiem_' . $day);
}

$eid = $_SESSION["eid"];
$date = date('Y-m-d H:i:s');

$start_monday = filter_input(INPUT_POST, 'start_monday');
$start_tuesday = filter_input(INPUT_POST, 'start_tuesday');
$start_wednesday = filter_input(INPUT_POST, 'start_wednesday');
$start_thursday = filter_input(INPUT_POST, 'start_thursday');
$start_friday = filter_input(INPUT_POST, 'start_friday');
$start_saturday = filter_input(INPUT_POST, 'start_saturday');
$start_sunday = filter_input(INPUT_POST, 'start_sunday');

$end_monday = filter_input(INPUT_POST, 'end_monday');
$end_tuesday = filter_input(INPUT_POST, 'end_tuesday');
$end_wednesday = filter_input(INPUT_POST, 'end_wednesday');
$end_thursday = filter_input(INPUT_POST, 'end_thursday');
$end_friday = filter_input(INPUT_POST, 'end_friday');
$end_saturday = filter_input(INPUT_POST, 'end_saturday');
$end_sunday = filter_input(INPUT_POST, 'end_sunday');

if ($start_monday != "N/A" && $end_monday != "N/A") {
    $mo_times = $start_monday . ' '  . $start_meridiems[0] . ' to ' . $end_monday . ' '  . $end_meridiems[0];
} else {
    $mo_times = "NULL";
}

if ($start_tuesday != "N/A" && $end_tuesday != "N/A") {
    $tu_times = $start_tuesday . ' '  . $start_meridiems[1] . ' to ' . $end_tuesday . ' '  . $end_meridiems[1];
} else {
    $tu_times = "NULL";
}

if ($start_wednesday != "N/A" && $end_wednesday != "N/A") {
    $we_times = $start_wednesday . ' '  . $start_meridiems[2] . ' to ' . $end_wednesday . ' '  . $end_meridiems[2];
}else {
    $we_times = "NULL";
}

if ($start_thursday != "N/A" && $end_thursday != "N/A") {
    $th_times = $start_thursday . ' '  . $start_meridiems[3] . ' to ' . $end_thursday . ' '  . $end_meridiems[3];
} else {
    $th_times = "NULL";
}

if ($start_friday != "N/A" && $end_friday != "N/A") {
    $fr_times = $start_friday . ' '  . $start_meridiems[4] . ' to ' . $end_friday . ' '  . $end_meridiems[4];
} else {
    $fr_times = "NULL";
}

if ($start_saturday != "N/A" && $end_saturday != "N/A") {
    $sa_times = $start_saturday . ' '  . $start_meridiems[5] . ' to ' . $end_saturday . ' '  . $end_meridiems[5];
} else {
    $sa_times = "NULL";
}

if ($start_sunday != "N/A" && $end_sunday != "N/A") {
    $su_times = $start_sunday . ' '  . $start_meridiems[6] . ' to ' . $end_sunday . ' '  . $end_meridiems[6];
} else {
    $su_times = "NULL";
}

// echo $mo_times;
// echo $tu_times;
// echo $we_times;
// echo $th_times;
// echo $fr_times;
// echo $sa_times;
// echo $su_times;

// echo date_default_timezone_get();

$newRequest = "insert into webportal_db.scheduler_requests (eid, mo_times, tu_times, we_times, 
th_times, fr_times, sa_times, su_times, request_date) values (?, ?, ?, ?, ?, ?, ?, ?, ?)";
if ($link->connect_errno) {
    printf("Connect failed: %s\n", $link->connect_error);
    exit();
}

$stmt = $link->prepare($newRequest);
$stmt->bind_param("sssssssss", $eid, $mo_times, $tu_times, $we_times, $th_times, $fr_times, $sa_times, $su_times, $date);
$stmt->execute();

$newId = $link->insert_id;
if (!is_null($newId)) {
    echo "New record created successfully. Last inserted ID is: " . $newId;
} else {
    echo "Error: " . $sql . "<br>" . $link->error;
}

header('Location: ta_scheduler.php');