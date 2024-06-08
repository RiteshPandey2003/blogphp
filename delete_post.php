<?php
// Include database connection
include("connect.php");

// Check if the post ID is set and not empty
if(isset($_POST['id']) && !empty($_POST['id'])) {
    // Sanitize the input
    $postId = mysqli_real_escape_string($conn, $_POST['id']);
    
    // Delete the post from the database
    $delete_query = mysqli_query($conn, "DELETE FROM `posts` WHERE `id` = '$postId'");
    
    // Check if the deletion was successful
    if($delete_query) {
        // Return a success message
        echo "Post deleted successfully!";
    } else {
        // Return an error message
        echo "Error deleting post: " . mysqli_error($conn);
    }
} else {
    // Return an error message if the post ID is not set or empty
    echo "Post ID not provided!";
}
?>
