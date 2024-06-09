<?php
// Include necessary files
include("connect.php");

// Check if ID parameter is provided in the URL
if (isset($_GET['id'])) {
    // Retrieve the post ID from the URL
    $post_id = $_GET['id'];

    // Query the database to fetch the post with the provided ID
    $query = mysqli_query($conn, "SELECT * FROM posts WHERE id = $post_id");

    // Check if the query was successful
    if ($query) {
        // Fetch the post data from the database
        $post = mysqli_fetch_assoc($query);

        // HTML structure for the post content
?>
        <!DOCTYPE html>
        <html lang='en'>

        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title><?php echo $post['label']; ?></title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 0;
                    background-color: #f4f4f4;
                }

                .post {
                    background-color: #fff;
                    max-width: 800px;
                    margin: 20px auto;
                    padding: 20px;
                    border-radius: 5px;
                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                }

                .post h1 {
                    font-size: 28px;
                    color: #333;
                    margin-bottom: 10px;
                }

                .post p {
                    font-size: 16px;
                    line-height: 1.6;
                    color: #666;
                    text-align: justify;
                }

                .post img {
                    width: 100%;
                    height: auto;
                    margin-top: 20px;
                    border-radius: 5px;
                }

                .logo {
                    font-size: 1.2rem;
                    font-weight: 800;
                }

                .logo span {
                    color: aqua;
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
            </style>
        </head>

        <body>
            <div class="navbar">
                <span class="logo">Byte<span>Beat</span></span>
                <div>
                    <a href="homepage.php">Home</a>
                    <a href="logout.php">Logout</a>
                </div>
            </div>
            <div class='post'>
                <h1><?php echo $post['label']; ?></h1>
                <p><?php echo $post['discription']; ?></p>
                <img src='<?php echo $post['file']; ?>' alt='Post Image'>
            </div>
        </body>

        </html>
<?php
    } else {
        // If the query fails, display an error message
        echo "Error: Unable to fetch post data from the database.";
    }
} else {
    // If no ID parameter is provided, display an error message
    echo "Error: Post ID not provided.";
}
?>