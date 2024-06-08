<?php
session_start();
include("connect.php");

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $label = mysqli_real_escape_string($conn, $_POST['label']);
    $discription = mysqli_real_escape_string($conn, $_POST['discription']); 

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    if ($_FILES["file"]["size"] > 5000000) { // 5MB limit
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    $allowed_types = array("jpg", "png", "jpeg", "gif", "pdf", "doc", "docx");
    if (!in_array($fileType, $allowed_types)) {
        echo "Sorry, only JPG, JPEG, PNG, GIF, PDF, DOC, and DOCX files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            
            $sql = "INSERT INTO posts (file, label, discription) VALUES ('$target_file', '$label', '$discription')";
            if (mysqli_query($conn, $sql)) {
                // Success message
                echo "<script>alert('The post has been added successfully.'); window.location.replace('homepage.php');</script>";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
} else {
    header("Location: addpost.php");
}

mysqli_close($conn);
?>
