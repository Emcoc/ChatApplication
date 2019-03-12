<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../css/main.css">
        <title>Registration</title>
    </head>
    <body>
        <?php
            require 'config.php';

            if(isset($_POST['register'])) {
                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $user_name = $_POST['user_name'];
                $password = $_POST['password'];

                $connection = new mysqli($host, $username, $password, $db);
                $query = "insert into users values (" . $first_name . ", " . $last_name . ", " . $user_name . ", " . $password . ")";
                
            }
        ?>
        <div id="main">
            <h2 align="center">Registration</h2>
            <form method="post">
                <div>
                    <label for="first_name">First Name:</label><br>
                    <input type="text" name="first_name" id="first_name" placeholder="First name" required>
                </div>
                <div>
                    <label for="last_name">Last Name:</label><br>
                    <input type="text" name="last_name" id="last_name" placeholder="Last name" required>
                </div>
                <div>
                    <label for="user_name">User Name:</label><br>
                    <input type="text" name="user_name" id="user_name" placeholder="User name" required>
                </div>
                <div>
                    <label for="password">Password:</label><br>
                    <input type="password" name="password" id="password" placeholder="Password" required>
                </div>
                <button type="submit" name="submit" id="submit">Register</button>
            </form>
        </div>
    </body>
</html>