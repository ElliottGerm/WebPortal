<!DOCTYPE html>
<html lang="en">

<?php
// include("get_users.php");
// include("get_events.php");

// $events = get_events();
// $users = get_users();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TAPortal-TA Scheduler</title>
    <link href="./styles/index.css" type="text/css" rel="stylesheet">
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
                <li class="nav-item ">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item active" id="manager_view">
                    <a class="nav-link" href="./manager_scheduler.php">Manager <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <div>
                <a class="btn btn-outline-primary" id="signInButton" href="./login.php" role="button">Sign In | Register</a>
                <a class="btn btn-outline-secondary" id="signOutButton" href="./logout.php" role="button">Logout</a>
            </div>
        </div>
    </nav>
    <!-- navbar stuff ends -->

    <!-- <div class="container"> -->
    <!-- <div class="row" style="margin-top: 300px;"> -->
    <div style="margin-top: 150px;">
        <div id='ta_cal'></div>
    </div>

    <!-- <?php if (!empty($users)) { } ?> -->
    <!-- </div> -->
    <form method="post" action="add_event.php" onsubmit="return validateForm()">
        <div class="form-group">
            <label for="title">User: </label>
            <select name="title" id="title"  style= "background-color: gray; color: white; font-size: smaller">
                <?php
                foreach ($users as $user) {
                    echo '<option>' . $user . '</option>';
                }
                ?>
            </select>
            <br>
            <label for="start_date">Start: </label>
            <input type="date" name="start_date" id="start_date">
            <select name="start_time" id="start_time" style= "background-color: gray; color: white; font-size: smaller">
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
            <select name="end_time" id="end_time" style= "background-color: gray; color: white; font-size: smaller">
                <?php
                for ($hours = 0; $hours < 24; $hours++) // the interval for hours is '1'
                    for ($mins = 0; $mins < 60; $mins += 15) // the interval for mins is '30'
                        echo '<option>' . str_pad($hours, 2, '0', STR_PAD_LEFT) . ':'
                            . str_pad($mins, 2, '0', STR_PAD_LEFT) . ':'
                            . str_pad(0, 2, '0', STR_PAD_LEFT) . '</option>';
                ?>
            </select>
            <br>
            <label for="color">Color: </label>
            <select name="color" id="color" style= "background-color: gray; color: white; font-size: smaller">
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

            <input type="submit" name="submit" value="Add Shift">
        </div>
    </form>

    <br>

    <?php if (!empty($events)) { ?>
        <form method="post" action="remove_event.php">
            <label for="remove_event">Remove Shift: </label>
            <select name="remove_event" id="remove_event" style= "background-color: gray; color: white; font-size: smaller">
                <?php
                    foreach ($events as $event) {
                        echo '<option value =' . $event["eventid"] . '>' . 'Shift ' . $event["eventid"] . ': ' . $event["title"] .
                            '; ' . $event["start"] . ' - ' . $event["end"] . '</option>';
                    }
                    ?>
            </select>

            <br>

            <input type="submit" name="submit" value="Remove Shift" style= "background-color: gray; color: white; font-size: smaller">
        </form>
    <?php } ?>
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
                                        echo " (Shift " . $event["eventid"] . ")" ?>",
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