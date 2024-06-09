<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f3d8;
            height: 100vh;
            margin: 0;
        }
        .parent-box{
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
            max-width: 400px;
            width: 100%;
        }
        .container h1 {
            margin-bottom: 1.5rem;
            font-size: 24px;
            color: #333;
            text-align: center;
        }
        .container input {
            display: block;
            width: 100%;
            padding: 0.8rem 0;
            margin: 1rem 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .container button {
            padding: 0.8rem 1rem;
            background: #333;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        .container button:hover {
            background: #555;
        }
        .warning{
            font-size: 0.7rem;
            color:red;
            margin-bottom: 2.5rem;
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
        .logo{
            font-size: 1.2rem;
            font-weight: 800;
        }
        .logo span{
            color:aqua
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
        <h1>Update Profile</h1>
        <form action="updatefunction.php" method="POST">
            <input type="text" name="fName" placeholder="First Name" required>
            <input type="text" name="lName" placeholder="Last Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <p class="warning">you can't change Email</p>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Update</button>
        </form>
    </div>
    </div>
</body>
</html>
