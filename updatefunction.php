<?php
session_start();
include("connect.php");

if (!isset($_SESSION['email'])) {
    echo '<div style="text-align:center; padding:15%;">';
    echo '<p style="font-size:50px; font-weight:bold;">Please log in to view this page.</p>';
    echo '<a href="index.php" style="font-size:20px; text-decoration:none; color:blue;">Go to Login</a>';
    echo '</div>';
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $_POST['fName'];
    $lastName = $_POST['lName'];
    $email = $_SESSION['email']; // User cannot change their email

    $password = $_POST['password'];
    $password = md5($password);

    $sessionEmail = $_SESSION['email'];
    $query = "UPDATE users SET firstName='$firstName', lastName='$lastName', password='$password' WHERE email='$sessionEmail'";

    if (mysqli_query($conn, $query)) {
        echo '<div style="text-align:center; padding:15%;">';
        echo '<p style="font-size:50px; font-weight:bold;">Profile updated successfully!</p>';
        echo '<a href="homepage.php" style="font-size:20px; text-decoration:none; color:blue;">Go to Homepage</a>';
        echo '</div>';
    } else {
        echo '<div style="text-align:center; padding:15%;">';
        echo '<p style="font-size:50px; font-weight:bold;">Error updating profile: ' . mysqli_error($conn) . '</p>';
        echo '<a href="update.html" style="font-size:20px; text-decoration:none; color:blue;">Try Again</a>';
        echo '</div>';
    }
} else {

    echo '<div style="text-align:center; padding:15%;">';
    echo '<p style="font-size:50px; font-weight:bold;">You cannot change your email address.</p>';
    echo '<form action="update.php" method="POST">';

    echo '</form>';
    echo '</div>';
}
