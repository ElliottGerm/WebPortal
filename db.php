<?php
$host = "localhost";
$dbusername = "root";
$dbpassword = "passsword";
$dbname = "webportal_db";
// $port = "3306";  //this should probably be 3306 (mysql default) for most of you
echo $host;
echo $dbusername;
echo $dbpassword;
echo $dbname;

$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);
if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
}

function register()
{
    global $conn;

    $eid = filter_input(INPUT_POST, 'eid');
    $password = filter_input(INPUT_POST, 'password');
    $fname = filter_input(INPUT_POST, 'fname');
    $lname = filter_input(INPUT_POST, 'lname');

    if (!empty($eid)) {
        if (!empty($password)) {

            if (mysqli_connect_error()) {
                die('Connect Error (' . mysqli_connect_errno() . ') '
                    . mysqli_connect_error());
            } else {
                $sql = "INSERT INTO user (eid, password, fname, lname, role)
            values ('$eid','$password', '$fname', '$lname', 3)";

                if ($conn->query($sql)) {
                    // echo "New record is inserted sucessfully";
                    echo "New record is checked sucessfully";
                } else {
                    echo "Error: " . $sql . " " . $conn->error;
                }
                $conn->close();
            }
        } else {
            echo "Password should not be empty";
            die();
        }
    } else {
        echo "eid should not be empty";
        die();
    }
}

function newQuestion($question, $author)
{
    global $connection;
    $newQuestionQuery = "insert into questions (content, author) values (?, ?)";
    // printf("%s %d", $question, $author);
    if ($connection->connect_errno) {
        printf("Connect failed: %s\n", $connection->connect_error);
        exit();
    }

    $stmt = $connection->prepare($newQuestionQuery);
    $stmt->bind_param("sd", $question, $author);
    $stmt->execute();

    $newId = $connection->insert_id;
    if (!is_null($newId)) {
        echo "New record created successfully. Last inserted ID is: " . $newId;
        // questionsToday();
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

?>
