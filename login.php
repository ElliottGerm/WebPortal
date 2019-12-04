<?php


// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit;
} else {
    $_SESSION["loggedin"] = "";
    $_SESSION["eid"] = "";
    $_SESSION["role"] = "";
}

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

function log_sign_in($eid){

    global $link;
    $isEmpty = 0;
    
    // Creates unique ID
    $sql = "SELECT EXISTS (SELECT 1 FROM webportal_db.signInLogger)";
    
    if ($link->connect_errno) {
        printf("Connect failed: %s\n", $link->connect_error);
        exit();
    }
    
    if ($result = $link->query($sql)) {
        while ($row = $result->fetch_assoc()) {
            $tmp = array_reverse($row);
            $isEmpty = array_pop($tmp);
        }
        /* free result set */
        $result->close();
    }
    
    if ($isEmpty != 0) {
        $sql = "SELECT MAX(signinId) FROM webportal_db.signInLogger;";
    
        if ($result = $link->query($sql)) {
            while ($row = $result->fetch_assoc()) {
                $tmp = array_reverse($row);
                $uniqueId = array_pop($tmp) + 1;
            }
            /* free result set */
            $result->close();
        }
    } else {
        $uniqueId = 0;
    }
    

    date_default_timezone_set('America/New_York');
    $signInTime = date("Y-m-d H:i:s");

    $logSignIn = "INSERT into signInLogger (signinId, eid, signInTime) values (?, ?, ?)";

    echo $uniqueId;
    echo $eid;
    echo $signInTime;

    if ($link->connect_errno) {
        printf("Connect failed: %s\n", $link->connect_error);
        exit();
    }

    $stmt = $link->prepare($logSignIn);
    $stmt->bind_param("iss", $uniqueId, $eid, $signInTime);
    $stmt->execute();

    $newId = $link->insert_id;
    if (!is_null($newId)) {
        echo "New record created successfully. Last inserted ID is: " . $newId;
    } else {
        echo "Error: " . $logSignIn . "<br>" . $link->error;
    }

}

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username is empty
    if (empty(trim($_POST["eid"]))) {
        $username_err = "Please enter eid.";
    } else {
        $username = trim($_POST["eid"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT eid, password, role, fname, lname FROM users WHERE eid = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $username, $hashed_password, $role, $fname, $lname);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {

                            log_sign_in($username); 
                            // header("createId.php");

                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["eid"] = $username;
                            $_SESSION["role"] = $role;
                            $_SESSION["fname"] = $fname;
                            $_SESSION["lname"] = $lname;

                            // Redirect user to welcome page
                            header("location: index.php");
                        } else {
                            // Display an error message if password is not valid
                            $password_err = "Invalid password. Please try again.";
                        }
                    }
                } else {
                    // Display an error message if username doesn't exist
                    $username_err = "Username not found";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <title>TAportal login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="./styles/login.css" type="text/css" rel="stylesheet">

</head>


<body>
    <!-- Navbar stuff starts -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">TAPortal</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <div>
                <a class="btn btn-outline-primary" href="#" role="button">Sign In | Register</a>
                <a class="btn btn-outline-secondary disabled" id="signOutButton" role="button" style="color: gray">Logout</a>
            </div>
        </div>
    </nav>
    <!-- navbar stuff ends -->

    <div style="margin-top: 100px;">
        <div class="wrapper fadeInDown">
            <div id="formContent">
                <!-- Tabs Titles -->

                <!-- Icon -->
                <div class="fadeIn first">
                    <img src="styles/cs_logo.png" id="Logo" alt="User Logo" />
                </div>

                <!-- Login Form -->
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                        <input type="text" name="eid" id="login" class="form-control fadeIn second" placeholder="eid" value="<?php echo $username; ?>">
                        <span class="help-block"><?php echo $username_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                        <input type="password" name="password" id="password" class="form-control fadeIn third" placeholder="password">
                        <span class="help-block"><?php echo $password_err; ?></span>
                    </div>

                    <input type="submit" class="fadeIn fourth" value="Login">
                </form>

                <form action="./register.php">
                    <input type="submit" class="fadeIn fourth" value="Register">
                </form>

                <!-- Remind Passowrd -->
                <div id="formFooter">
                    <a class="underlineHover" href="#">Forgot Password?</a>
                </div>

            </div>
        </div>
    </div>

    <!-- ALL THE STUFF WE NEED FOR BOOTSTRAP AND JQEURY -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js " integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo " crossorigin="anonymous "></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js " integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1 " crossorigin="anonymous "></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js " integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM " crossorigin="anonymous "></script>
    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- <script type="text/javascript" src="./scripts/queue_scripts.js"></script> -->
</body>

</html>