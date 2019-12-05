<?php

$host = "localhost";
$username = "root";
$password = "password";
$database = "webportal_db";

$filename = "./db/config_db.sql";

$db_exists = 0;

$items = array();

// Creating connection 
$conn = mysqli_connect($host, $username, $password);
$sql = "SELECT EXISTS (SELECT 1 FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = ?) as db_exists";

if ($conn->connect_errno) {
    printf("Connect failed: %s\n", $conn->connect_error);
    exit();
}

$query = $conn->prepare($sql);
$query->bind_param("s", $database);
$query->execute();

$query->bind_result($result);

while ($query->fetch()) {
    $db_exists = $result;
}

/* free result set */
$query->close();


if ($db_exists == 0) {
    // echo "The database does not exist!";

    $templine = '';
    // Read in entire file
    $lines = file($filename);
    // Loop through each line
    foreach ($lines as $line) {
        // Skip it if it's a comment
        if (substr($line, 0, 2) == '--' || $line == '')
            continue;

        // Add this line to the current segment
        $templine .= $line;
        // If it has a semicolon at the end, it's the end of the query
        if (substr(trim($line), -1, 1) == ';') {
            // Perform the query
            mysqli_query($conn, $templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
            // Reset temp variable to empty
            $templine = '';
        }
    }

    $db_exists = 1;
} else {
    // echo "The database exists";
    $db_exists = 1;
}

mysqli_close($conn);

if ($db_exists != 0) {
    // echo "\nconnected to db";
    /* Attempt to connect to MySQL database */
    $link = mysqli_connect($host, $username, $password, $database);

    // Check connection
    if ($link === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
} else {
    // echo "\ncould not connect ot db";
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
