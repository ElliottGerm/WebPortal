<?php
require_once "config.php";

// Create connection
function get_events()
{
    global $link;
    $items = array();

    $sql = "select * from events";
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