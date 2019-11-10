<?php
// $host = "localhost";
// $dbusername = "root";
// $dbpassword = "password";
// $dbname = "webportal_db";
// // Create connection
// $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

// if (mysqli_connect_error()) {
//     die('Connect Error (' . mysqli_connect_errno() . ') '
//         . mysqli_connect_error());
// }

require_once "config.php";

$isEmpty;
$eventId = 0;
$title = filter_input(INPUT_POST, 'title');
$start_date = filter_input(INPUT_POST, 'start_date');
$start_time = filter_input(INPUT_POST, 'start_time');
$end_date = filter_input(INPUT_POST, 'end_date');
$end_time = filter_input(INPUT_POST, 'end_time');

echo $title;
echo $start_date;
echo $start_time;
echo $end_date;
echo $end_time;

$start = $start_date . 'T' . $start_time;

echo $start;

$end = $end_date . 'T' . $end_time;

echo $end;

$sql = "SELECT EXISTS (SELECT 1 FROM webportal_db.events)";

if ($link->connect_errno) {
    printf("Connect failed: %s\n", $conn->connect_error);
    exit();
}
if ($result = $link->query($sql)) {
    // printf("Select returned %d rows.\n", $result->num_rows);
    while ($row = $result->fetch_assoc()) {
        $isEmpty = array_pop(array_reverse($row));
    }
    /* free result set */
    $result->close();
}

if ($isEmpty != 0) {
    $sql = "SELECT MAX(eventid) FROM webportal_db.events;";

    if ($result = $link->query($sql)) {
        // printf("Select returned %d rows.\n", $result->num_rows);
        while ($row = $result->fetch_assoc()) {
            $eventId = array_pop(array_reverse($row)) + 1;
        }
        /* free result set */
        $result->close();
    }
}

// $sql = "INSERT INTO webportal_db.events (eventid, title, start, end)
//     VALUES ('.$eventId.','".$title."','".$start."','".$end."')";

//     $result = mysqli_query($link,$sql);

$newEvent = "insert into webportal_db.events (eventid, title, start, end) values (?, ?, ?, ?)";
// printf("%s %d", $question, $author);
if ($link->connect_errno) {
    printf("Connect failed: %s\n", $link->connect_error);
    exit();
}

$stmt = $link->prepare($newEvent);
$stmt->bind_param("isss", $eventId, $title, $start, $end);
$stmt->execute();

$newId = $link->insert_id;
if (!is_null($newId)) {
    echo "New record created successfully. Last inserted ID is: " . $newId;
} else {
    echo "Error: " . $sql . "<br>" . $link->error;
}

header('Location: manager_scheduler.php');

