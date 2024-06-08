<?php
// Include database connection
include("connect.php");

// Check if the user ID is set and not empty
if(isset($_POST['id']) && !empty($_POST['id'])) {
    // Sanitize the input
    $userId = mysqli_real_escape_string($conn, $_POST['id']);
    
    // Delete the user from the database
    $delete_query = mysqli_query($conn, "DELETE FROM `users` WHERE `id` = '$userId'");
    
    // Check if the deletion was successful
    if($delete_query) {
        // Return a success message
        echo "User deleted successfully!";
    } else {
        // Return an error message
        echo "Error deleting user: " . mysqli_error($conn);
    }
} else {
    // Return an error message if the user ID is not set or empty
    echo "User ID not provided!";
}
?>
