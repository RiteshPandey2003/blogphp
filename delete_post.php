<?php
include("connect.php");

if(isset($_POST['id']) && !empty($_POST['id'])) { 
    $postId = mysqli_real_escape_string($conn, $_POST['id']);    
    $delete_query = mysqli_query($conn, "DELETE FROM `posts` WHERE `id` = '$postId'");
    if($delete_query) {
        echo "Post deleted successfully!";
    } else {
        echo "Error deleting post: " . mysqli_error($conn);
    }
} else {
    echo "Post ID not provided!";
}
?>
