<?php
session_start();
include("connect.php");

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    echo '<div style="text-align:center; padding:15%;">';
    echo '<p style="font-size:50px; font-weight:bold;">Please log in to view this page.</p>';
    echo '<a href="index.php" style="font-size:20px; text-decoration:none; color:blue;">Go to Login</a>';
    echo '</div>';
    exit();
}

// Check if user is admin
$is_admin = false;
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $query = mysqli_query($conn, "SELECT * FROM `users` WHERE email='$email'");
    $user = mysqli_fetch_assoc($query);
    if ($user['email'] == 'admin@gmail.com') {
        $is_admin = true;
    }
}

// Fetch posts from the database
if (isset($_GET['latest'])) {
    $posts_query = mysqli_query($conn, "SELECT * FROM `posts` ORDER BY id DESC");
} else {
    $posts_query = mysqli_query($conn, "SELECT * FROM `posts`");
}
$posts = [];
while ($row = mysqli_fetch_assoc($posts_query)) {
    $posts[] = $row;
}

// Search functionality
if (isset($_GET['search'])) {
    $searchTerm = mysqli_real_escape_string($conn, $_GET['search']);
    $posts_query = mysqli_query($conn, "SELECT * FROM `posts` WHERE label LIKE '%$searchTerm%'");
    $posts = [];
    while ($row = mysqli_fetch_assoc($posts_query)) {
        $posts[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f3d8;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .navbar {
            background: #333;
            color: white;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            font-size: 20px;
            padding: 0 1rem;
        }

        .navbar a:hover {
            text-decoration: underline;
        }

        .content {
            text-align: center;
            flex: 1;
            padding: 5%;
        }


        .content a {
            font-size: 20px;
            text-decoration: none;
            color: red;
            display: inline-block;
            margin-top: 1rem;

        }

        .fixed-buttons {
            position: fixed;
            bottom: 1rem;
            right: 1rem;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 1rem;
        }

        .fixed-buttons a {
            font-size: 20px;
            text-decoration: none;
            color: white;
            background: black;
            padding: 1rem;
            border-radius: 5px;
            display: inline-block;
        }

        .fixed-buttons a:hover {
            background: #444;
        }

        .post {
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .post h3 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .post .dis {
            font-size: 16px;
            line-height: 1.6;
            text-align: justify;
        }

        .post img {
            max-width: 100%;
            border-radius: 5px;
            margin-top: 20px;
        }

        .search-bar {
            margin: 20px 0;
            text-align: end;
        }

        .searchbox {
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 5px;
            overflow: hidden;
        }

        .searchbox input[type="text"] {
            padding: 10px;
            border: none;
            outline: none;
            width: 200px;
            float: left;
            font-size: 16px;
        }

        .searchbox button {
            float: left;
            background-color: #333;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            border-radius: 0 5px 5px 0;
        }

        .searchbox button:hover {
            background-color: #444;
        }

       @media (max-width : 600px) {

        .searchbox button{
            padding: 10px 10px;
            cursor: pointer;
            font-size: 10px;
        }

        .searchbox input[type="text"] {
            padding: 10px 2px;
            border: none;
            outline: none;
            width: 200px;
            float: left;
            font-size: 10px;
        }
        .search-bar {    
            text-align: center;
        }
        .fixed-buttons a{
            font-size: 10px;
            padding: 10px 10px;
        }
       }
    </style>
</head>

<body>

    <div class="navbar">
        <span>Blog</span>
        <a href="logout.php">Logout</a>
    </div>

    <div class="content">
        <div class="search-bar">
            <form action="" method="GET" class=" searchbox">
                <input type="text" name="search" placeholder="Search by Label Name">
                <button type="submit">Search</button>
            </form>
        </div>

        <div class="posts-container">
            <?php foreach ($posts as $post) : ?>
                <div class="post">
                    <h3><?php echo htmlspecialchars($post['label']); ?></h3>
                    <p class="dis"><?php echo htmlspecialchars($post['discription']); ?></p>
                    <img src="<?php echo htmlspecialchars($post['file']); ?>" alt="Post Image">
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="fixed-buttons">
        <?php if ($is_admin) : ?>
            <a href="addpost.php" class="update-post">Add Post</a>
            <a href="adminpanel.php" class="update-post">Admin Panel</a>
        <?php endif; ?>
        <a href="update.php" class="update-profile">Update Your Profile</a>
    </div>

</body>

</html>