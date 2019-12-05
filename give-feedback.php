<?php
$_SESSION["eid"] = "";
$_SESSION["loggedin"] = "";
$postId = 0;


session_start();
require_once("config.php");
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {

    $current_user = $_SESSION["eid"];
}

function questionsToday()
{
    global $link;
    $questionsTodayQuery = "SELECT * from comments WHERE eid=?";
    if ($link->connect_errno) {
        printf("Connect failed: %s\n", $link->connect_error);
        exit();
    }

    $stmt = $link->prepare($questionsTodayQuery);
    $stmt->bind_param("s", $_SESSION["eid"]);
    $stmt->execute();

    $result = $stmt->get_result();

    $items = [];


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

                                <div class="float-right pr-3">
                                   <form method="post" action="./delete_post.php">
                                        <button class="btn btn-outline-secondary btn-sm m-2" role="button" type="submit" value=%s name="postId">
                                            <span><i class="fa fa-trash mr-1"></i></span>delete post
                                        </button>
                                    </form>
                                </div>
                                <div class="row cover-bar"></div>
                            </div>', $item["eid"], $item["postDate"], $item["commentBody"], $item["postId"]);
    }

    /* free result set */
    $result->close();
}

function newQuestion($post, $author)
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
            // printf("Select returned %d rows.\n", $result->num_rows);
            while ($row = $result->fetch_assoc()) {
                $tmp = array_reverse($row);
                $postId = array_pop($tmp) + 1;
            }
            /* free result set */
            $result->close();
        }
    } else {
        $postId = 0;
    }

    date_default_timezone_set('America/New_York');
    $postDate = date("m/d/y g:i a");
    $newFeedbackQuery = "INSERT into comments (postId, eid, commentBody, postDate) values (?, ?, ?, ?)";

    if ($link->connect_errno) {
        printf("Connect failed: %s\n", $link->connect_error);
        exit();
    }

    $stmt = $link->prepare($newFeedbackQuery);
    $stmt->bind_param("isss", $postId, $author, $post, $postDate);
    $stmt->execute();

    $newId = $link->insert_id;
    // if (!is_null($newId)) {
    //     echo "New record created successfully. Last inserted ID is: " . $newId;
    // } else {
    //     echo "Error: " . $newFeedbackQuery . "<br>" . $link->error;
    // }
}

if (isset($_POST['submit'])) {
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
                <li class="nav-item active">
                    <a class="nav-link" href="#">Give Feedback<span class="sr-only">(current)</span></a>
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
        <h1>Learn something new today?</h1>
        <h3>We want to hear about it. Tell us about your experience below</h3>
        <div class="col rounded-top mt-4 py-3 commentWraper">
            <div class="row justify-content-center" style="margin-top: 50px;">
                <form action="give-feedback.php" method="post" id="commentForm">
                    <div class="form-group">
                        <label for="commentBody">Share your experience here</label>
                        <textarea name="commentBody" id="commentBody" class="form-control" required minlength="5" maxlength="1000"></textarea>
                        <input type="submit" name="submit" value="post" class="btn btn-primary btn-sm float-right mt-2">
                    </div>
                </form>
            </div>
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