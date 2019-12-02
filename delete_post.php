<?php 

    require_once("config.php");

    // function deletePost(){
        global $link;
        $postId = (int)filter_input(INPUT_POST, "postId");
        // echo gettype($postId);

        $deletePostQuery = "DELETE FROM comments WHERE postId=?";

        if ($link->connect_errno) {
            printf("Connect failed: %s\n", $link->connect_error);
            exit();
        }

        $stmt = $link->prepare($deletePostQuery);
        $stmt->bind_param("i", $postId);
        $stmt->execute();
        echo " Records Delete ".$link->affected_rows;

        header('Location: give-feedback.php');
    // }


?>  