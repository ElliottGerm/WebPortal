<?php
require_once "config.php";

// Create connection
function get_requests()
{
    global $link;
    $items = array();

    $sql = "select * from scheduler_requests order by request_date DESC limit 10";
    if ($link->connect_errno) {
        printf("Connect failed: %s\n", $link->connect_error);
        exit();
    }
    if ($result = $link->query($sql)) {
        // printf("Select returned %d rows.\n", $result->num_rows);
        while($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
        /* free result set */
        $result->close();
        return $items;
    }
}