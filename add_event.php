<?php
$host = "localhost";
$dbusername = "root";
$dbpassword = "password";
$dbname = "webportal_db";
// Create connection
$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()) {
    die('Connect Error (' . mysqli_connect_errno() . ') '
        . mysqli_connect_error());
}

$start_date = filter_input(INPUT_POST, 'start_date');
$start_time = filter_input(INPUT_POST, 'start_time');

echo $start_date;
echo $start_time;

// function addEvents(){ //function parameters, two variables.
//     global $conn;

header('Location: ta_scheduler.php');
// }

// function newQuestion($event) {
//     echo $event;
// }

// header("Location: ./ta_scheduler.php");
// die();

// header("Location: {$_SERVER['HTTP_REFERER']}");
// exit;

// if(!isset($_SESSION['clientmacs']) ) {
//     $_SESSION['clientmacs'] = ""; // add this line if not added somewhere else
//     header('Location: ta_scheduler.php');
// }

?>