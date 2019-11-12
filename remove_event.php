<?php

require_once "config.php";

$eventId = filter_input(INPUT_POST, 'remove_event');

echo $eventId;

if ($link->connect_errno) {
    printf("Connect failed: %s\n", $conn->connect_error);
    exit();
}

$sql = "DELETE FROM webportal_db.events WHERE eventid = ?;";

$stmt = $link->prepare($sql);
$stmt->bind_param("i", $eventId);
$stmt->execute();

$newId = $link->insert_id;
if (!is_null($newId)) {
    echo "Record removed successfully. Last removed ID is: " . $newId;
} else {
    echo "Error: " . $sql . "<br>" . $link->error;
}

$sql = "UPDATE webportal_db.events SET eventid = eventid - 1 where eventid > ?";

$stmt = $link->prepare($sql);
$stmt->bind_param("i", $eventId);
$stmt->execute();

$newId = $link->insert_id;
if (!is_null($newId)) {
    echo "Record ids updated successfully. Last updated ID is: " . $newId;
} else {
    echo "Error: " . $sql . "<br>" . $link->error;
}

header('Location: manager_scheduler.php');
