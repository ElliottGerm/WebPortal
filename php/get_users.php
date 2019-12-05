<?php
require_once "config.php";

// Create connection
function get_users()
{
    global $link;
    $items = array();

    $sql = "select * from users where role=2";
    if ($link->connect_errno) {
        printf("Connect failed: %s\n", $link->connect_error);
        exit();
    }
    if ($result = $link->query($sql)) {
        // printf("Select returned %d rows.\n", $result->num_rows);
        while($row = $result->fetch_assoc()) {
            $items[] = $row["eid"];
        }
        /* free result set */
        $result->close();
        return $items;
    }
}
