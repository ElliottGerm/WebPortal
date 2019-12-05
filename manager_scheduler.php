<?php
$_SESSION["eid"] = "";
session_start();

include("./php/get_users.php");
include("./php/get_events.php");
include("./php/get_requests.php");
include("./php/get_stu_availability.php");

$events = get_events();
$users = get_users();
$requests = get_requests();
$stu_availabilities = get_stu_availability();

$request_strings = [
    'Mondays' => 'mo_times',
    'Tuesdays' => 'tu_times',
    'Wednesdays' => 'we_times',
    'Thursdays' => 'th_times',
    'Fridays' => 'fr_times',
    'Saturdays' => 'sa_times',
    'Sundays' => 'su_times'
];

$availability_strings = [
    'mo_times',
    'tu_times',
    'we_times',
    'th_times',
    'fr_times',
    'sa_times',
    'su_times'
];

$currentDate = date("Y-m-d 00:00:00");

$items = [];
$total_unique_logs = "SELECT 'total-logs', COUNT(*) as count FROM(SELECT eid,COUNT(*) FROM signInLogger WHERE signinTime >= CURDATE() GROUP BY eid) AS sr";

if ($link->connect_errno) {
    printf("Connect failed: %s\n", $link->connect_error);
    exit();
}
if ($result = $link->query($total_unique_logs)) {
    while($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
    /* free result set */
    $result->close();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TAPortal-TA Scheduler</title>
    <link href="./styles/manager_scheduler.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="your_website_domain/css_root/flaticon.css">
    <link href="./styles/manager_scheduler.css" type="text/css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href='packages/core/main.css' rel='stylesheet' />
    <link href='packages/daygrid/main.css' rel='stylesheet' />
    <link href='packages/timegrid/main.css' rel='stylesheet' />
    <link href='packages/list/main.css' rel='stylesheet' />
    <script src='packages/core/main.js'></script>
    <script src='packages/interaction/main.js'></script>
    <script src='packages/daygrid/main.js'></script>
    <script src='packages/timegrid/main.js'></script>
    <script src='packages/list/main.js'></script>

    <script type="text/javascript" src="./lib/jquery-3.3.1.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="./scripts/validate_form.js"></script>
    <script type="text/javascript" src="./scripts/menu_selector.js"></script>

    <!-- cdn for modernizr, if you haven't included it already -->
    <script src="http://cdn.jsdelivr.net/webshim/1.12.4/extras/modernizr-custom.js"></script>
    <!-- polyfiller file to detect and load polyfills -->
    <script src="http://cdn.jsdelivr.net/webshim/1.12.4/polyfiller.js"></script>
    <script>
        webshims.setOptions('waitReady', false);
        webshims.setOptions('forms-ext', {
            types: 'date'
        });
        webshims.polyfill('forms forms-ext');
    </script>

    <style>
        #ta_cal {
            max-width: 900px;
            margin: 0 auto;
        }

        .vertical-menu {
            width: 350px;
            height: 150px;
            overflow-y: auto;
        }

        .vertical-menu option {
            color: black;
            display: block;
            padding: 12px;
            text-decoration: none;
        }

        .vertical-menu option:hover {
            background-color: #ccc;
        }

        .vertical-menu option.active {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>

<body>
    <!-- Navbar stuff starts -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">TAPortal</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item active" id="manager_view">
                    <a class="nav-link" href="./manager_scheduler.php">Manager <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item" id="stu_feedback_view">
                    <a class="nav-link" href="./student-feedback.php">Student Feedback</a>
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
                <a class="btn btn-outline-secondary" id="signOutButton" href="./logout.php" role="button">Logout</a>
            </div>
        </div>
    </nav>
    <!-- navbar stuff ends -->
                
    <div class="container">
    <!-- <div class="row" style="margin-top: 300px;"> -->
    <div style="margin-top: 150px;">

    </div>
    <!-- TA AVAILABILITY TABLE -->
    <div class="row" id="availableTable">
        <div class="col-8">
            <h4>TA Availabilities:</h4>
            <table style="width:700" border="1">
                <tr>
                    <th>User</th>
                    <th>Monday</th>
                    <th>Tuesday</th>
                    <th>Wednesday</th>
                    <th>Thursday</th>
                    <th>Friday</th>
                    <th>Saturday</th>
                    <th>Sunday</th>
                </tr>
                <?php
                foreach ($stu_availabilities as $availability) {
                    echo "<tr>";
                    echo "<td>" . $availability["eid"] . "</td>";
                    foreach ($availability_strings as $availability_string) {
                        if ($availability[$availability_string] != "NULL") {
                            echo "<td>" . $availability[$availability_string] . "</td>";
                        } else {
                            echo "<td>None</td>";
                        }
                    }
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
        <?php 
        
            printf( '<div class="col-4 d-flex align-items-center">
                        <div id="useCount">
                            <h4 style="font-weight: bold; text-align: center">Lab Activity Monitor</h4>
                            <h6 style="text-align: center">Total number of unique students that attended lab hours today: <strong>%s</strong></h6>
                        </div>

                    </div>', $items[0]["count"]);
        ?>
    </div>

        
        <div class="row mt-3" id="shiftForms">
            <!-- SHIFT SCHEDULING FORM -->
            <div class="col-7 py-0">
                <form method="post" action="add_event.php" onsubmit="return validateForm()">
                    <div class="form-group row">
                        <!-- SELECTING USER -->
                        <label for="title">User: </label>
                        <select name="title" id="title" >
                            <?php
                            if (!empty($users)) {
                                foreach ($users as $user) {
                                    echo '<option>' . $user . '</option>';
                                }
                            } else {
                                echo '<option>None</option>';
                            }
                            ?>
                        </select>
                        <!-- SELECTING COURSES -->
                        <label for="courses">Courses: </label>
                        <select name="course" id="course">
                            <?php
                            const courses = array(
                                'CS139', 'CS149', 'CS159', 'CS227', 'CS240', 'CS261', 'CS327', 'CS345', 'CS361', 'CS430', 'CS474'
                            );
                            foreach (courses as $course) {
                                echo '<option>' . $course . '</option>';
                            }
                            ?>
                        </select>
                        <!-- SELECTING COLOR -->
                        <label for="color">Color: </label>
                        <select name="color" id="color" >
                            <?php
                            const colors = array(
                                'Blue', 'Magenta', 'Light Green', 'Pink', 'Light Orange', 'Light Purple',
                                'Cyan', 'Light Yellow', 'Light Red', 'Light Brown'
                            );
                            foreach (colors as $color) {
                                echo '<option>' . $color . '</option>';
                            }
                            ?>
                        </select>
                        <br>
                    </div>
                    <div class="form-group row">
                        <label for="date">Date: </label>
                        <input type="date" name="date" id="date">
                        <br>
                        <label for="start_time">Start Time: </label>
                        <select name="start_time" id="start_time" >
                            <?php
                            for ($hours = 0; $hours < 24; $hours++) // the interval for hours is '1'
                                for ($mins = 0; $mins < 60; $mins += 60) // the interval for mins is '30'
                                    echo '<option>' . str_pad($hours, 2, '0', STR_PAD_LEFT) . ':'
                                        . str_pad($mins, 2, '0', STR_PAD_LEFT) . ':'
                                        . str_pad(0, 2, '0', STR_PAD_LEFT) . '</option>';
                            ?>
                        </select>
                        <label for="end_time">   End Time: </label>
                        <!-- <input type="date" name="end_date" id="end_date"> -->
                        <select name="end_time" id="end_time">
                            <?php
                            for ($hours = 0; $hours < 24; $hours++) // the interval for hours is '1'
                                for ($mins = 0; $mins < 60; $mins += 60) // the interval for mins is '30'
                                    echo '<option>' . str_pad($hours, 2, '0', STR_PAD_LEFT) . ':'
                                        . str_pad($mins, 2, '0', STR_PAD_LEFT) . ':'
                                        . str_pad(0, 2, '0', STR_PAD_LEFT) . '</option>';
                            ?>
                        </select>
                    </div>

                    <div class="form-group row float-right pr-5">
                        <input class="btn btn-outline-dark btn-md" type="submit" name="submit" value="Add Shift">
                    </div>
                </form>
            </div>


            <!-- REMOVE SHIFT -->
            <div class="col-5">
                <?php if (!empty($events)) { ?>
                    <div class="form-group row">
                        <form method="post" action="remove_event.php">
                            <label for="remove_event">Remove Shift: </label>
                            <select name="remove_event" id="remove_event" >
                                <?php
                                    foreach ($events as $event) {
                                        echo '<option value =' . $event["eventid"] . '>'. $event["title"] .
                                            ': ' . $event["start"] . ' - ' . $event["end"] . '</option>';
                                    }
                                    ?>
                            </select>
                            <br>
                            <input class="btn btn-outline-dark btn-md mt-2 float-right" type="submit" name="submit" value="Remove Shift" >
                        </form>
                    </div>
                <?php } ?>
            </div>
        </div>
        <!-- CALANDER -->
        <div class="row justify-content-center my-5" id='ta_cal'></div>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
        if ($('#start_date')[0].type != 'date') $('#start_date').datepicker();
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
        if ($('#end_date')[0].type != 'date') $('#end_date').datepicker();
    </script>

    <script type="text/javascript" src="./scripts/calendar_scripts.js"></script>

    <script>
        events = [
            <?php if (!empty($events)) { ?>
                <?php
                    // TODO: CHECK IF THE RESULTS OF get_events() IS NULL OR EMPTY
                    foreach ($events as $event) {
                        ?> {
                        title: "<?php echo $event["title"];
                                        echo " (Shift " . $event["eventid"] . ")"; ?>",
                        start: "<?php echo $event["start"]; ?>",
                        end: "<?php echo $event["end"]; ?>",
                        color: "<?php echo $event["color"]; ?>"
                    },
            <?php
                }
            }
            ?>
        ]

        load_calendar('ta_cal', events);
    </script>


</body>

</html>