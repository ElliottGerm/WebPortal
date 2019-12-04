<?php

require_once("config.php");

global $link;
$postId = (int) filter_input(INPUT_POST, "postId");

$deletePostQuery = "DELETE FROM comments WHERE postId=?";

if ($link->connect_errno) {
    printf("Connect failed: %s\n", $link->connect_error);
    exit();
}

$stmt = $link->prepare($deletePostQuery);
$stmt->bind_param("i", $postId);
$stmt->execute();

header('Location: give-feedback.php');
