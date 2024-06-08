<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: left;
            margin-left: 20px;
            color: #333;
        }
        h2 {
            text-align: center;
            color: #555;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            color: #333;
        }
        .container {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
        }
        .box {
            background-color: #f2f2f2;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            flex: 1;
            margin: 0 10px;
            color: #333;
        }
        .delete-btn {
            background-color: #ff3333;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .delete-btn:hover {
            background-color: #cc0000;
        }
        .toggle-btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-left: 1rem;
        }
        .toggle-btn:hover {
            background-color: #0056b3;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <h1>Admin Panel</h1>

    <div class="container">
        <div class="box">
            <h2>Total Users</h2>
            <?php
            // Include database connection
            include("connect.php");

            // Count total users
            $users_count_query = mysqli_query($conn, "SELECT COUNT(*) AS total_users FROM `users`");
            $total_users = mysqli_fetch_assoc($users_count_query)['total_users'];
            echo "<p>$total_users</p>";
            ?>
        </div>

        <div class="box">
            <h2>Total Posts</h2>
            <?php
            // Count total posts
            $posts_count_query = mysqli_query($conn, "SELECT COUNT(*) AS total_posts FROM `posts`");
            $total_posts = mysqli_fetch_assoc($posts_count_query)['total_posts'];
            echo "<p>$total_posts</p>";
            ?>
        </div>
    </div>

    <button class="toggle-btn" onclick="toggleUserData()">Show User Data</button>
    <button class="toggle-btn" onclick="togglePostData()">Show Post Data</button>

    <h2 class="user-data-title hidden">All Users</h2>
    <table class="user-data-table hidden">
        <tr>
            <th>User ID</th>
            <th>Email</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Action</th>
        </tr>
        <?php
        // Fetch users from database
        $users_query = mysqli_query($conn, "SELECT * FROM `users`");
        while ($user = mysqli_fetch_assoc($users_query)) {
            echo "<tr>";
            echo "<td>" . $user['id'] . "</td>";
            echo "<td>" . $user['email'] . "</td>";
            echo "<td>" . $user['firstName'] . "</td>";
            echo "<td>" . $user['lastName'] . "</td>";
            echo "<td><button class='delete-btn' onclick='deleteUser(" . $user['id'] . ")'>Delete</button></td>";
            echo "</tr>";
        }
        ?>
    </table>

    <h2 class="post-data-title hidden">All Posts</h2>
    <table class="post-data-table hidden">
        <tr>
            <th>Post ID</th>
            <th>File</th>
            <th>Label</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
        <?php
        // Fetch posts from database
        $posts_query = mysqli_query($conn, "SELECT * FROM `posts`");
        while ($post = mysqli_fetch_assoc($posts_query)) {
            echo "<tr>";
            echo "<td>" . $post['id'] . "</td>";
            echo "<td>" . $post['file'] . "</td>";
            echo "<td>" . $post['label'] . "</td>";
            echo "<td>" . $post['discription'] . "</td>";
            echo "<td><button class='delete-btn' onclick='deletePost(" . $post['id'] . ")'>Delete</button></td>";
            echo "</tr>";
        }
        ?>
    </table>

    <script>
        function toggleUserData() {
            var userDataTitle = document.querySelector('.user-data-title');
            var userDataTable = document.querySelector('.user-data-table');
            userDataTitle.classList.toggle('hidden');
            userDataTable.classList.toggle('hidden');
        }

        function togglePostData() {
            var postDataTitle = document.querySelector('.post-data-title');
            var postDataTable = document.querySelector('.post-data-table');
            postDataTitle.classList.toggle('hidden');
            postDataTable.classList.toggle('hidden');
        }

        

        function deletePost(postId) {
        if (confirm("Are you sure you want to delete this post?")) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "delete_post.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Reload the page after successful deletion
                    location.reload();
                }
            };
            xhr.send("id=" + postId);
        }
        function deleteUser(userId) {
        if (confirm("Are you sure you want to delete this user?")) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "delete_user.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Reload the page after successful deletion
                    location.reload();
                }
            };
            xhr.send("id=" + userId);
        }
    }
    }
    </script>
</body>
</html>
