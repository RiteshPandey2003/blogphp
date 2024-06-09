<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Post</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f3d8;
            height: 100vh;
            margin: 0;
        }

        .parent-box {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
         
            background: white;
            padding: 2rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            width: 100%;
            max-width: 500px;
        }

        .container h1 {
            margin-bottom: 1rem;
            text-align: center;
        }

        .container label {
            display: block;
            margin-bottom: 0.5rem;
        }

        .container input,
        .container textarea {
            width: 100%;
            padding: 0.5rem 0;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .container button {
            padding: 0.5rem 1rem;
            background: <?php echo isset($success) && $success ? 'green' : 'black'; ?>;
            /* Change button color to green if $success is set and true */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        .container button:hover {
            background: <?php echo isset($success) && $success ? '#0a8d00' : '#444'; ?>;
            /* Darker green on hover if $success is set and true */
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

        .logo {
            font-size: 1.2rem;
            font-weight: 800;
        }

        .logo span {
            color: aqua
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
    <div class="parent-box">
        <div class="container">
            <h1>Add Post</h1>
            <form action="addpostfunction.php" method="POST" enctype="multipart/form-data">
                <label for="label">Label:</label>
                <input type="text" id="label" name="label" required>

                <label for="discription">Description:</label>
                <textarea id="discription" name="discription" rows="5" required></textarea>

                <label for="file">Upload File:</label>
                <input type="file" id="file" name="file" required>

                <button type="submit">Add Post</button>
            </form>
        </div>
    </div>
</body>

</html>