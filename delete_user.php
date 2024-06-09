<?php
include("connect.php");

if(isset($_POST['id']) && !empty($_POST['id'])) {
    $userId = mysqli_real_escape_string($conn, $_POST['id']);
    $delete_query = mysqli_query($conn, "DELETE FROM `users` WHERE `id` = '$userId'");
    if($delete_query) {
        echo "User deleted successfully!";
    } else {
        echo "Error deleting user: " . mysqli_error($conn);
    }
} else {
    echo "User ID not provided!";
}
?>
