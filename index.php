<?php
$_SESSION["eid"] = "";
$_SESSION["loggedin"] = "";
$_SESSION["role"] = "";
$_SESSION["fname"] = "";
$_SESSION["lname"] = "";
session_start();
require_once "config.php";

include("./php/get_events.php");

$events = get_events();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TAPortal</title>
    <link href="./styles/index.css" type="text/css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script type="text/javascript" src="./lib/jquery-3.3.1.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Calander stuff -->
    <link href='packages/core/main.css' rel='stylesheet' />
    <link href='packages/daygrid/main.css' rel='stylesheet' />
    <link href='packages/timegrid/main.css' rel='stylesheet' />
    <link href='packages/list/main.css' rel='stylesheet' />
    <script src='packages/core/main.js'></script>
    <script src='packages/interaction/main.js'></script>
    <script src='packages/daygrid/main.js'></script>
    <script src='packages/timegrid/main.js'></script>
    <script src='packages/list/main.js'></script>

    <style>
        body {
            margin: 40px 10px;
            padding: 0;
            font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
            font-size: 14px;
        }

        #ta_cal {
            max-width: 900px;
            margin: 0 auto;
        }
    </style>
</head>

<body onload='showView("<?php echo $_SESSION["role"] ?>", "<?php echo $_SESSION["eid"] ?>")'>

    <!-- Navbar stuff starts -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">TAPortal</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item" id="manager_view">
                    <a class="nav-link" href="./manager_scheduler.php">Manager</a>
                </li>
                <li class="nav-item" id="stu_feedback_view">
                    <a class="nav-link" href="./student-feedback.php">Student Feedback</a>
                </li>
                <li class="nav-item" id="ta_view">
                    <a class="nav-link" href="./ta_scheduler.php">My Schedule</a>
                </li>
                <li class="nav-item" id="stu_view">
                    <a class="nav-link" href="./give-feedback.php">Give Feedback</a>
                </li>
            </ul>
            <div id="current_user" style="color: white; margin-right: 8px;">
                <?php
                if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
                    echo "Welcome " . $_SESSION["eid"];
                }
                ?>
            </div>
            <div>
                <a class="btn btn-outline-primary" id="signInButton" href="./login.php" role="button">Sign In | Register</a>
                <a class="btn btn-outline-secondary disabled" id="signOutButton" href="./logout.php" role="button">Logout</a>
            </div>
        </div>
    </nav>
    <!-- navbar stuff ends -->

    <div class="container">
        <div class="row" style="margin-top: 100px;">
            <div class="col-8 ">
                <h2 class="sem_title">Semester Schedule</h2>
                <div>
                    <div id='ta_cal'></div>
                </div>
            </div>
            <div class="col-4 queue">
                <h2 class="sem_title">Help Queue</h2>
                <div id="help-queue">

                    <table id="queue-table" class="row justify-content-center">
                        <!-- onload="populateQueue()"-->

                        <?php

                        $sql = "SELECT * FROM existing_queue ";
                        $result = mysqli_query($link, $sql);
                        /*if ($stmt = mysqli_prepare($link, $sql)) {

                        if (mysqli_stmt_execute($stmt)) {
                            /* store result 
                            mysqli_stmt_store_result($stmt);

                        } else {
                            echo "Oops! Something went wrong. Please try again later.";
                        }
                        } */
                        ?>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Class Number</th>
                        </tr>

                        <?php
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['fname'] . "</td>";
                            echo "<td>" . $row['lname'] . "</td>";
                            echo "<td>" . $row['classnum'] . "</td>";
                            echo "</tr>";
                        }

                        ?>
                    </table>


                    <div id="nameEntry">

                        <div class="row justify-content-center" style="margin-top: 50px;">
                            <form id="nameForm" method="post" action="add_queue.php">
                                <div class="form-group">
                                    <input type="hidden" id="eid" name="EID" value="<?php echo $_SESSION["eid"] ?>">
                                    <br>
                                    <input type="hidden" id="first" name="firstName" value="<?php echo $_SESSION["fname"] ?>">
                                    <br>
                                    <input type="hidden" id="last" name="lastName" value="<?php echo $_SESSION["lname"] ?>">
                                    <br>
                                    <select name="numClass" id="numClass" placeholder="Class number..">
                                        <option value="CS149">CS149</option>
                                        <option value="CS159">CS159</option>
                                        <option value="CS240">CS240</option>
                                        <option value="CS261">CS261</option>
                                        <option value="CS345">CS345</option>
                                    </select>
                                    <br>
                                    <button disabled id="joinButton" type="submit" onclick="createQueueEntry()" class="btn btn-primary btn-sm float-right mt-2">Join Queue</button>

                                    <!-- <button type="submit" class="btn btn-outline-primary btn-sm float-right mt-2 mr-2">Edit</button> -->
                                </div>
                            </form>
                            <form id="removeHolder" method="post" action="remove_queue.php">
                                <button disabled="disabled" id="removeButton" type="submit" onclick="removeQueryEntry()" class="btn btn-primary btn-sm float-right mt-2 hidden">Leave Queue</button>
                            </form>
                        </div>
                    </div>

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

    <script src='http://fullcalendar.io/js/fullcalendar-2.1.1/lib/moment.min.js'></script>
    <script src='http://fullcalendar.io/js/fullcalendar-2.1.1/lib/jquery.min.js'></script>
    <script src="http://fullcalendar.io/js/fullcalendar-2.1.1/lib/jquery-ui.custom.min.js"></script>
    <script src='http://fullcalendar.io/js/fullcalendar-2.1.1/fullcalendar.min.js'></script>

    <script type="text/javascript" src="./scripts/calendar_scripts.js"></script>
    <script type="text/javascript" src="./scripts/queue_scripts.js"></script>
    <script>
        events = [
            <?php if (!empty($events)) { ?>
                <?php
                    foreach ($events as $event) {
                        ?> {
                        title: "<?php echo $event["title"]; ?>",
                        start: "<?php echo $event["start"]; ?>",
                        end: "<?php echo $event["end"]; ?>",
                        color: "<?php echo $event["color"] ?>"
                    },
            <?php
                }
            }
            ?>
        ]
        load_calendar('ta_cal', events);
    </script>
    <script type="text/javascript" src="./scripts/role.js"></script>

</body>

</html>