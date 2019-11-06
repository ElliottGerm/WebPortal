<?php

echo "made it";
$username = filter_input(INPUT_POST, 'username');
$password = filter_input(INPUT_POST, 'password');

// $username = filter_input(INPUT_GET, 'username');
// $password = filter_input(INPUT_GET, 'password');

if (!empty($username)){
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

            // $sql = "SELECT username, password FROM user WHERE username='$username'";
            //
            // // $result = mysql_query("SELECT name FROM users WHERE joined='$username'");
            // // $result = mysql_query("SELECT username FROM users WHERE username='$username'");
            // $result = $conn->query($sql) or die($conn->error);
            //
            //
            //     // output data of each row
            // $row = $result->fetch_assoc();
            // echo $row["username"] . "<br>" . $row["password"] . "<br>";
            //
            //
            // $conn->close();

            // $row = mysql_fetch_array($result);

            // echo $row['username'];

            $sql = "INSERT INTO user (username, password)
            values ('$username','$password')";

            if ($conn->query($sql)){
                // echo "New record is inserted sucessfully";
                echo "New record is checked sucessfully";

            }
            else{
                echo "Error: ". $sql ." ". $conn->error;
            }
            $conn->close();
        }
    }
    else{
        echo "Password should not be empty";
        die();
    }
}
else{
    echo "Username should not be empty";
    die();
}

?>
