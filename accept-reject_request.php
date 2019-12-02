<?php
require_once "config.php";

$safePost = filter_input_array(INPUT_POST);
$elements = array();

$requestId = "";
$eid = "";
$message = "";
$email = "";
$comments = "";

$request_times = null;
$valid_times = array();

$currentUser = $_SESSION["eid"];

$request_strings = [
    'Mondays',
    'Tuesdays',
    'Wednesdays',
    'Thursdays',
    'Fridays',
    'Saturdays',
    'Sundays'
];

$managerEmail = get_user_email($currentUser);

foreach ($safePost as $post) {
    $elements[] = $post;
}

if (isset($_POST["accept"])) {
    if (sizeof($elements) > 1) {
        $request = get_request_data($elements);

        foreach ($request as $data) {
            $request_msg = "The following schedule request has been ACCEPTED: \n";
            $request_times = array();
            $valid_times = array();

            if ($data != null) {
                $eid = $data[0];
                $requestId = $data[1];

                foreach (get_request_times_by_id($requestId) as $request_time) {
                    if ($request_time != "NULL") {
                        $request_times[] = $request_time;
                    }
                }

                $email = get_user_email($eid);
            }

            $comments = $elements[sizeof($elements) - 2];

            // Sanitize E-mail Address
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            // Validate E-mail Address
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);

            for ($i = 0; $i < sizeof($request_times); $i++) {
                $valid_times[] = "* from " . $request_times[$i] . " on " . $request_strings[$i] . "\n";
            }

            foreach ($valid_times as $valid_time) {
                $request_msg = $request_msg . $valid_time;
            }

            $request_msg = $request_msg . "COMMENTS:\n" . $comments;

            if (!$email) {
                echo "This user does not have a valid email.";
                break;
            } else {
                $subject = "Schedule Request Accepted";
                $headers = 'From:' . $managerEmail . "rn"; // Sender's Email
                $message = $request_msg;
                // Message lines should not exceed 70 characters (PHP rule), so wrap it
                $message = wordwrap($message, 70);
                // Send Mail By PHP Mail Function
                mail($email, $subject, $message, $headers);
                echo "The request by " . $eid . " has been accepted.\t";
            }
        }
    }
}

if (isset($_POST["reject"])) {
    if (sizeof($elements) > 1) {
        $request = get_request_data($elements);

        foreach ($request as $data) {
            $request_msg = "The following schedule request has been DENIED: \n";
            $request_times = array();
            $valid_times = array();

            if ($data != null) {
                $eid = $data[0];
                $requestId = $data[1];

                foreach (get_request_times_by_id($requestId) as $request_time) {
                    if ($request_time != "NULL") {
                        $request_times[] = $request_time;
                    }
                }

                $email = get_user_email($eid);
            }

            $comments = $elements[sizeof($elements) - 2];

            // Sanitize E-mail Address
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            // Validate E-mail Address
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);

            for ($i = 0; $i < sizeof($request_times); $i++) {
                $valid_times[] = "* from " . $request_times[$i] . " on " . $request_strings[$i] . "\n";
            }

            foreach ($valid_times as $valid_time) {
                $request_msg = $request_msg . $valid_time;
            }

            $request_msg = $request_msg . "REASON:\n" . $comments;

            if (!$email) {
                echo "This user does not have a valid email.";
                break;
            } else {
                $subject = "Schedule Request Rejected";
                $headers = 'From:' . $managerEmail . "rn"; // Sender's Email
                $message = $request_msg;
                // Message lines should not exceed 70 characters (PHP rule), so wrap it
                $message = wordwrap($message, 70);
                // Send Mail By PHP Mail Function
                mail($email, $subject, $message, $headers);
                echo "The request by " . $eid . " has been accepted.\t";
            }
        }
    }
}

function get_request_data($elements)
{
    $data = array();

    if ($elements > 2) {
        unset($elements[sizeof($elements) - 1]);
        unset($elements[sizeof($elements) - 1]);
    }

    foreach ($elements as $element) {
        // get the eid and id associated with the request
        $data[] = explode(",", $element);
    }

    return $data;
}

function get_user_email($eid)
{
    global $link;
    $email = "";

    $sql = 'SELECT email FROM webportal_db.users WHERE eid LIKE ?';

    if ($link->connect_errno) {
        printf("Connect failed: %s\n", $link->connect_error);
        exit();
    }

    $stmt = $link->prepare($sql);
    $stmt->bind_param("s", $eid);
    $stmt->execute();

    $stmt->bind_result($result);
    while ($stmt->fetch()) {
        $email = $result;
    }

    $stmt->close();

    return $email;
}

function get_request_times_by_id($id)
{
    global $link;
    $times = array();
    $sql = 'SELECT mo_times, tu_times, we_times, th_times, fr_times, sa_times, su_times FROM webportal_db.scheduler_requests WHERE id = ?';

    if ($link->connect_errno) {
        printf("Connect failed: %s\n", $link->connect_error);
        exit();
    }

    $stmt = $link->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $stmt->bind_result($mo, $tu, $we, $th, $fr, $sa, $su);
    while ($stmt->fetch()) {
        $times[] = $mo;
        $times[] = $tu;
        $times[] = $we;
        $times[] = $th;
        $times[] = $fr;
        $times[] = $sa;
        $times[] = $su;
    }

    $stmt->close();

    return $times;
}

echo "";
