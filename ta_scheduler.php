<!DOCTYPE html>
<html lang="en">

<?php
include("get_users.php");
include("get_events.php");

$events = get_events();
$days = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TAPortal-TA Scheduler</title>
    <link href="./styles/ta_scheduler.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="your_website_domain/css_root/flaticon.css">

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

<body>
    <!-- Navbar stuff starts -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark mb-4">
        <a class="navbar-brand" href="#">TAPortal</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item ">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="./ta_scheduler.php">My Schedule<span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <div>
                <a class="btn btn-outline-primary" id="signInButton" href="./login.php" role="button">Sign In | Register</a>
                <a class="btn btn-outline-secondary" id="signOutButton" href="./logout.php" role="button">Logout</a>
            </div>
        </div>
    </nav>

    <!-- navbar stuff ends -->
    <div style="margin-top: 150px;">
        <div class="row justify-content-center">
            <?php
            foreach ($days as $day) {
                ?>
                <div>
                    <h5 class="dayHeadings"><?php echo $day ?></h5>
                    <div class="boxes">
                        <p>Start:
                            <span>
                                <select class="drop-down">
                                    <option selected value="1:00">1:00</option>
                                    <option value="2:00">2:00</option>
                                    <option value="3:00">3:00</option>
                                    <option value="3:00">4:00</option>
                                    <option value="3:00">5:00</option>
                                    <option value="3:00">6:00</option>
                                    <option value="3:00">7:00</option>
                                    <option value="3:00">8:00</option>
                                    <option value="3:00">9:00</option>
                                    <option value="3:00">10:00</option>
                                    <option value="3:00">11:00</option>
                                    <option value="3:00">12:00</option>
                                </select>
                            </span>
                            <span>
                                <select class="drop-down">
                                    <option selected value="AM">AM</option>
                                    <option value="PM">PM</option>
                                </select>
                            </span>
                        </p>
                        <p>End:
                            <span>
                                <select class="drop-down">
                                    <option selected value="1:00">1:00</option>
                                    <option value="2:00">2:00</option>
                                    <option value="3:00">3:00</option>
                                    <option value="3:00">4:00</option>
                                    <option value="3:00">5:00</option>
                                    <option value="3:00">6:00</option>
                                    <option value="3:00">7:00</option>
                                    <option value="3:00">8:00</option>
                                    <option value="3:00">9:00</option>
                                    <option value="3:00">10:00</option>
                                    <option value="3:00">11:00</option>
                                    <option value="3:00">12:00</option>
                                </select>
                            </span>
                            <span>
                                <select class="drop-down">
                                    <option selected value="AM">AM</option>
                                    <option value="PM">PM</option>
                                </select>
                            </span>
                        </p>
                    </div>
                </div>
            <?php } ?>
            <!-- <div>
                <h5 class="dayHeadings">Tuesday </h5>
                <div class="boxes">
                    <p>Start:
                        <span>
                            <select class="drop-down">
                                <option selected value="1:00">0:00</option>
                                <option value="2:00">2:00</option>
                                <option value="3:00">3:00</option>
                                <option value="3:00">4:00</option>
                                <option value="3:00">5:00</option>
                                <option value="3:00">6:00</option>
                                <option value="3:00">7:00</option>
                                <option value="3:00">8:00</option>
                                <option value="3:00">9:00</option>
                                <option value="3:00">10:00</option>
                                <option value="3:00">11:00</option>
                                <option value="3:00">12:00</option>
                            </select>
                        </span>
                        <span>
                            <select class="drop-down">
                                <option selected value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select>
                        </span>
                    </p>
                    <p>End:
                        <span>
                            <select class="drop-down">
                                <option selected value="1:00">0:00</option>
                                <option value="2:00">2:00</option>
                                <option value="3:00">3:00</option>
                                <option value="3:00">4:00</option>
                                <option value="3:00">5:00</option>
                                <option value="3:00">6:00</option>
                                <option value="3:00">7:00</option>
                                <option value="3:00">8:00</option>
                                <option value="3:00">9:00</option>
                                <option value="3:00">10:00</option>
                                <option value="3:00">11:00</option>
                                <option value="3:00">12:00</option>
                            </select>
                        </span>
                        <span>
                            <select class="drop-down">
                                <option selected value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select>
                        </span>
                    </p>
                </div>
            </div>
            <div>
                <h5 class="dayHeadings">Wednesday</h5>
                <div class="boxes">
                    <p>Start:
                        <span>
                            <select class="drop-down">
                                <option selected value="1:00">0:00</option>
                                <option value="2:00">2:00</option>
                                <option value="3:00">3:00</option>
                                <option value="3:00">4:00</option>
                                <option value="3:00">5:00</option>
                                <option value="3:00">6:00</option>
                                <option value="3:00">7:00</option>
                                <option value="3:00">8:00</option>
                                <option value="3:00">9:00</option>
                                <option value="3:00">10:00</option>
                                <option value="3:00">11:00</option>
                                <option value="3:00">12:00</option>
                            </select>
                        </span>
                        <span>
                            <select class="drop-down">
                                <option selected value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select>
                        </span>
                    </p>
                    <p>End:
                        <span>
                            <select class="drop-down">
                                <option selected value="1:00">0:00</option>
                                <option value="2:00">2:00</option>
                                <option value="3:00">3:00</option>
                                <option value="3:00">4:00</option>
                                <option value="3:00">5:00</option>
                                <option value="3:00">6:00</option>
                                <option value="3:00">7:00</option>
                                <option value="3:00">8:00</option>
                                <option value="3:00">9:00</option>
                                <option value="3:00">10:00</option>
                                <option value="3:00">11:00</option>
                                <option value="3:00">12:00</option>
                            </select>
                        </span>
                        <span>
                            <select class="drop-down">
                                <option selected value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select>
                        </span>
                    </p>
                </div>
            </div>
            <div>
                <h5 class="dayHeadings">Thursday</h5>
                <div class="boxes">
                    <p>Start:
                        <span>
                            <select class="drop-down">
                                <option selected value="1:00">0:00</option>
                                <option value="2:00">2:00</option>
                                <option value="3:00">3:00</option>
                                <option value="3:00">4:00</option>
                                <option value="3:00">5:00</option>
                                <option value="3:00">6:00</option>
                                <option value="3:00">7:00</option>
                                <option value="3:00">8:00</option>
                                <option value="3:00">9:00</option>
                                <option value="3:00">10:00</option>
                                <option value="3:00">11:00</option>
                                <option value="3:00">12:00</option>
                            </select>
                        </span>
                        <span>
                            <select class="drop-down">
                                <option selected value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select>
                        </span>
                    </p>
                    <p>End:
                        <span>
                            <select class="drop-down">
                                <option selected value="1:00">0:00</option>
                                <option value="2:00">2:00</option>
                                <option value="3:00">3:00</option>
                                <option value="3:00">4:00</option>
                                <option value="3:00">5:00</option>
                                <option value="3:00">6:00</option>
                                <option value="3:00">7:00</option>
                                <option value="3:00">8:00</option>
                                <option value="3:00">9:00</option>
                                <option value="3:00">10:00</option>
                                <option value="3:00">11:00</option>
                                <option value="3:00">12:00</option>
                            </select>
                        </span>
                        <span>
                            <select class="drop-down">
                                <option selected value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select>
                        </span>
                    </p>
                </div>
            </div>
            <div>
                <h5 class="dayHeadings">Friday</h5>
                <div class="boxes">
                    <p>Start:
                        <span>
                            <select class="drop-down">
                                <option selected value="1:00">0:00</option>
                                <option value="2:00">2:00</option>
                                <option value="3:00">3:00</option>
                                <option value="3:00">4:00</option>
                                <option value="3:00">5:00</option>
                                <option value="3:00">6:00</option>
                                <option value="3:00">7:00</option>
                                <option value="3:00">8:00</option>
                                <option value="3:00">9:00</option>
                                <option value="3:00">10:00</option>
                                <option value="3:00">11:00</option>
                                <option value="3:00">12:00</option>
                            </select>
                        </span>
                        <span>
                            <select class="drop-down">
                                <option selected value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select>
                        </span>
                    </p>
                    <p>End:
                        <span>
                            <select class="drop-down">
                                <option selected value="1:00">0:00</option>
                                <option value="2:00">2:00</option>
                                <option value="3:00">3:00</option>
                                <option value="3:00">4:00</option>
                                <option value="3:00">5:00</option>
                                <option value="3:00">6:00</option>
                                <option value="3:00">7:00</option>
                                <option value="3:00">8:00</option>
                                <option value="3:00">9:00</option>
                                <option value="3:00">10:00</option>
                                <option value="3:00">11:00</option>
                                <option value="3:00">12:00</option>
                            </select>
                        </span>
                        <span>
                            <select class="drop-down">
                                <option selected value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select>
                        </span>
                    </p>
                </div>
            </div>
            <div>
                <h5 class="dayHeadings">Saturday</h5>
                <div class="boxes">
                    <p>Start:
                        <span>
                            <select class="drop-down">
                                <option selected value="1:00">0:00</option>
                                <option value="2:00">2:00</option>
                                <option value="3:00">3:00</option>
                                <option value="3:00">4:00</option>
                                <option value="3:00">5:00</option>
                                <option value="3:00">6:00</option>
                                <option value="3:00">7:00</option>
                                <option value="3:00">8:00</option>
                                <option value="3:00">9:00</option>
                                <option value="3:00">10:00</option>
                                <option value="3:00">11:00</option>
                                <option value="3:00">12:00</option>
                            </select>
                        </span>
                        <span>
                            <select class="drop-down">
                                <option selected value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select>
                        </span>
                    </p>
                    <p>End:
                        <span>
                            <select class="drop-down">
                                <option selected value="1:00">0:00</option>
                                <option value="2:00">2:00</option>
                                <option value="3:00">3:00</option>
                                <option value="3:00">4:00</option>
                                <option value="3:00">5:00</option>
                                <option value="3:00">6:00</option>
                                <option value="3:00">7:00</option>
                                <option value="3:00">8:00</option>
                                <option value="3:00">9:00</option>
                                <option value="3:00">10:00</option>
                                <option value="3:00">11:00</option>
                                <option value="3:00">12:00</option>
                            </select>
                        </span>
                        <span>
                            <select class="drop-down">
                                <option selected value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select>
                        </span>
                    </p>
                </div>
            </div>
            <div>
                <h5 class="dayHeadings">Sunday</h5>
                <div class="boxes">
                    <p>Start:
                        <span>
                            <select class="drop-down">
                                <option selected value="1:00">0:00</option>
                                <option value="2:00">2:00</option>
                                <option value="3:00">3:00</option>
                                <option value="3:00">4:00</option>
                                <option value="3:00">5:00</option>
                                <option value="3:00">6:00</option>
                                <option value="3:00">7:00</option>
                                <option value="3:00">8:00</option>
                                <option value="3:00">9:00</option>
                                <option value="3:00">10:00</option>
                                <option value="3:00">11:00</option>
                                <option value="3:00">12:00</option>
                            </select>
                        </span>
                        <span>
                            <select class="drop-down">
                                <option selected value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select>
                        </span>
                    </p>
                    <p>End:
                        <span>
                            <select class="drop-down">
                                <option selected value="1:00">0:00</option>
                                <option value="2:00">2:00</option>
                                <option value="3:00">3:00</option>
                                <option value="3:00">4:00</option>
                                <option value="3:00">5:00</option>
                                <option value="3:00">6:00</option>
                                <option value="3:00">7:00</option>
                                <option value="3:00">8:00</option>
                                <option value="3:00">9:00</option>
                                <option value="3:00">10:00</option>
                                <option value="3:00">11:00</option>
                                <option value="3:00">12:00</option>
                            </select>
                        </span>
                        <span>
                            <select class="drop-down">
                                <option selected value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select>
                        </span>
                    </p>
                </div>
            </div> -->
        </div>
    </div>


    <!-- <div class="container"> -->
    <!-- <div class="row" style="margin-top: 300px;"> -->
    <div style="margin-top: 150px;">
        <div id='ta_cal'></div>
    </div>

    <!-- </div> -->
    <form method="post">
        <div class="form-group">
            <label for="start_date">Start: </label>
            <input type="date" name="start_date" id="start_date">
            <select name="start_time" id="start_time">
                <?php
                for ($hours = 0; $hours < 24; $hours++) // the interval for hours is '1'
                    for ($mins = 0; $mins < 60; $mins += 15) // the interval for mins is '30'
                        echo '<option>' . str_pad($hours, 2, '0', STR_PAD_LEFT) . ':'
                            . str_pad($mins, 2, '0', STR_PAD_LEFT) . ':'
                            . str_pad(0, 2, '0', STR_PAD_LEFT) . '</option>';
                ?>
            </select>
            <br>
            <label for="end_date">End: </label>
            <input type="date" name="end_date" id="end_date">
            <select name="end_time" id="end_time">
                <?php
                for ($hours = 0; $hours < 24; $hours++) // the interval for hours is '1'
                    for ($mins = 0; $mins < 60; $mins += 15) // the interval for mins is '30'
                        echo '<option>' . str_pad($hours, 2, '0', STR_PAD_LEFT) . ':'
                            . str_pad($mins, 2, '0', STR_PAD_LEFT) . ':'
                            . str_pad(0, 2, '0', STR_PAD_LEFT) . '</option>';
                ?>
            </select>
            <input type="submit" name="submit" value="submit">
        </div>
    </form>

    <!-- </div> -->

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
    <!-- <script> load_calendar('ta_cal'); </script> -->

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

</body>

</html>