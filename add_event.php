<?php

require_once "config.php";

$isEmpty;
$eventId = 0;
$title = filter_input(INPUT_POST, 'title');
$date = filter_input(INPUT_POST, 'date');
$start_time = filter_input(INPUT_POST, 'start_time');
// $end_date = filter_input(INPUT_POST, 'end_date');
$end_time = filter_input(INPUT_POST, 'end_time');
$color = filter_input(INPUT_POST, 'color');
$course = filter_input(INPUT_POST, 'course');

echo $title;
echo $date;
echo $start_time;
echo $end_time;
echo $color;

$start = $date . 'T' . $start_time;

echo $start;

$end = $date . 'T' . $end_time;

echo $end;

$title = $title. " " . $course;

echo $title;

const colors = [
    'Blue' => '',
    'Magenta' => '#ff00ff',
    'Light Green' => '#8eff45',
    'Pink' => '#ffc0cb',
    'Light Orange' => '#ffb347',
    'Light Purple' => '#b19cd9',
    'Cyan' => '#00ffff',
    'Light Yellow' => '#fdff87',
    'Light Red' => '#ff7f7f',
    'Light Brown' => '#c145ff'
];

$colorHash = colors[$color];

$sql = "SELECT EXISTS (SELECT 1 FROM events)";

if ($link->connect_errno) {
    printf("Connect failed: %s\n", $conn->connect_error);
    exit();
}

if ($result = $link->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        $isEmpty = array_pop(array_reverse($row));
    }
    /* free result set */
    $result->close();
}

if ($isEmpty != 0) {
    $sql = "SELECT MAX(eventid) FROM events;";

    if ($result = $link->query($sql)) {
        // printf("Select returned %d rows.\n", $result->num_rows);
        while ($row = $result->fetch_assoc()) {
            $eventId = array_pop(array_reverse($row)) + 1;
        }
        /* free result set */
        $result->close();
    }
}

$newEvent = "insert into events (eventid, title, start, end, color) values (?, ?, ?, ?, ?)";
if ($link->connect_errno) {
    printf("Connect failed: %s\n", $link->connect_error);
    exit();
}

$stmt = $link->prepare($newEvent);
$stmt->bind_param("issss", $eventId, $title, $start, $end, $colorHash);
$stmt->execute();

$newId = $link->insert_id;
if (!is_null($newId)) {
    echo "New record created successfully. Last inserted ID is: " . $newId;
} else {
    echo "Error: " . $sql . "<br>" . $link->error;
}

header('Location: manager_scheduler.php');

