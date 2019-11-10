<?php
$host = "localhost";
$dbusername = "root";
$dbpassword = "password";
$dbname = "webportal_db";

$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
// Create connection
function get_users()
{
    global $conn;
    $items = array();

    $sql = "select * from webportal_db.user";
    if ($conn->connect_errno) {
        printf("Connect failed: %s\n", $conn->connect_error);
        exit();
    }
    if ($result = $conn->query($sql)) {
        // printf("Select returned %d rows.\n", $result->num_rows);
        while($row = $result->fetch_assoc()) {
            $items[] = $row["eid"];
        }
        /* free result set */
        $result->close();
        return $items;
    }
}
