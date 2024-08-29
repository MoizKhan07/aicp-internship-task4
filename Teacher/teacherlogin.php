<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Signin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
        }

        h1 {
            margin-bottom: 20px;
            color: #333;
        }

        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            text-align: left;
            font-weight: bold;
        }

        input {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        p {
            color: #555;
            font-size: 14px;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container" style="text-align: center;">
    <h1>Signin</h1>

<!-- Display login message -->
<?php if (!empty($message)): ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>

<!-- Login Form -->
<form action="teacherlogin.php" method="POST">
    <label for="admin-username">Username</label>
    <input type="text" name="admin-username" id="admin-username" placeholder="Enter your username" required>
    <label for="admin-password">Password</label>
    <input type="password" name="admin-password" id="admin-password" placeholder="Enter your password" required>
    <button type="submit"><a href="../../Task4/Teacher/home.html" style="color:#f4f4f4; text-decoration:none">Login</a></button>
</form>

<p>Don't have an account? <a href="teachersignup.html">Signup</a></p>
    </div>
</body>
</html>
