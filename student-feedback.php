<?php
$_SESSION["eid"] = "";
$_SESSION["loggedin"] = "";
$postId = 0;

session_start();
include("config.php");
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {

    $current_user = $_SESSION["eid"];
}

function questionsToday()
{
    global $link;
    // date_default_timezone_set('America/New_York');
    // $today = date(DATE_RSS);
    // $questionsTodayQuery = "select * from comments where asked > curdate()";

    $questionsTodayQuery = "select * from comments";
    if ($link->connect_errno) {
        printf("Connect failed: %s\n", $link->connect_error);
        exit();
    }
    $items = [];
    if ($result = $link->query($questionsTodayQuery)) {
        while ($question = $result->fetch_assoc()) {
            $items[] = $question;
        }
        if (sizeof($items) > 0) {
            $items = array_reverse($items, true);
        }


        foreach ($items as $item) {
            printf('<div class="scroll-bar-wrap"> 
                                <div class="row">
                                    <div class="scroll-box">
                                        <div class="sticky-top commentHeader">
                                            <p> <strong> %s </strong> <span class="dateFormat"> %s</span> </p> 
                                        </div>
                                        <br>
                                        <div class="commentBody">
                                            <pre style="font-family: arial; line-height: 1.4;">%s</pre>
                                        </div>                                   
                                    </div>
                                </div>
                                <div class="row cover-bar"></div>
                            </div>', $item["eid"], $item["postDate"], $item["commentBody"]);
        }

        /* free result set */
        $result->close();
    }
}

function newQuestion($question, $author)
{
    global $link;
    $isEmpty = 0;

    // Creates unique ID
    $sql = "SELECT EXISTS (SELECT 1 FROM webportal_db.comments)";

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
        $sql = "SELECT MAX(postId) FROM webportal_db.comments;";

        if ($result = $link->query($sql)) {
            while ($row = $result->fetch_assoc()) {
                $tmp = array_reverse($row);
                $postId = array_pop($tmp) + 1;
            }
            /* free result set */
            $result->close();
        }
    }


    date_default_timezone_set('America/New_York');
    $postDate = date("m/d/y g:i a");
    $newQuestionQuery = "INSERT into comments (eid, commentBody, postDate, postId) values (?, ?, ?, ?)";
    if ($link->connect_errno) {
        printf("Connect failed: %s\n", $link->connect_error);
        exit();
    }

    $stmt = $link->prepare($newQuestionQuery);
    $stmt->bind_param("sssi", $author, $question, $postDate, $postId);
    $stmt->execute();
}

if (isset($_POST['submit'])) {
    echo (" was set post <br>");
    newQuestion($_POST["commentBody"], $current_user);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TAPortal-Ask-Question</title>
    <link href="./styles/student-feedback.css" type="text/css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <link rel="stylesheet" href="https://cdn.dhtmlx.com/richtext/1.0/richtext.css" type="text/css">
    <script src="https://cdn.dhtmlx.com/richtext/1.0/richtext.js"></script>
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
                    <a class="nav-link" href="./index.php">Home </a>
                </li>
                <li class="nav-item" id="manager_view">
                    <a class="nav-link" href="./manager_scheduler.php">Manager</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Student Feedback<span class="sr-only">(current)</span></a>
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
                <a class="btn btn-outline-primary" id="signInButton" href="./login.php" role="button">Sign In |
                    Register</a>
                <a class="btn btn-outline-secondary" id="signOutButton" href="./logout.php" role="button">Logout</a>
            </div>
        </div>
    </nav>
    <!-- navbar stuff ends -->

    <div class="container mt-5 pt-5">
        <h1 style="text-align:center">Student Feedback</h1>
        <div class="row justify-content-center mt-4 commentWraper">
            <div class="row justify-content-center" id="newPost">
                <?php
                questionsToday();
                ?>
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
    <script src="./scripts/student-feedback.js"></script>
</body>

</html>