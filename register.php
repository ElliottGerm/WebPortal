<?php

echo "made it \n";
// $eid = filter_input(INPUT_POST, 'eid');
// $password = filter_input(INPUT_POST, 'password');
// $fname= filter_input(INPUT_POST, 'fname');
// $lname = filter_input(INPUT_POST, 'lname');

$eid = filter_input(INPUT_GET, 'eid');
$password = filter_input(INPUT_GET, 'password');
// $fname= filter_input(INPUT_GET, 'fname');
// $lname = filter_input(INPUT_GET, 'lname');

// $username = filter_input(INPUT_GET, 'username');
// $password = filter_input(INPUT_GET, 'password');

if (!empty($eid)){
    if (!empty($password)){
        $host = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "webportal_db";
        // Create connection
        $conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);


        if (mysqli_connect_error()){
            die('Connect Error ('. mysqli_connect_errno() .') '
            . mysqli_connect_error());
        }
        else{

            $sql = "SELECT eid FROM user WHERE eid='$eid'";
            
            // $result = mysql_query("SELECT name FROM users WHERE joined='$username'");
            // $result = mysql_query("SELECT username FROM users WHERE username='$username'");
            $result = $conn->query($sql) or die($conn->error);
            
            if($result){
                // output data of each row
                $row = $result->fetch_assoc();
                echo $row["eid"] . "<br>";
            } else {
                echo "no results";
            }


            
            
            $conn->close();

            // $row = mysql_fetch_array($result);

            // echo $row['username'];

            // $sql = "INSERT INTO user (eid, password, fname, lname, role)
            // values ('$eid','$password', '$fname', '$lname', 3)";

            // if ($conn->query($sql)){
            //     // echo "New record is inserted sucessfully";
            //     echo "New record is checked sucessfully";

            // }
            // else{
            //     echo "Error: ". $sql ." ". $conn->error;
            // }
            // $conn->close();
        }
    }
    else{
        echo "Password should not be empty";
        die();
    }
}
else{
    echo "eid should not be empty";
    die();
}

?>
