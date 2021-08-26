<?php
error_reporting(0);
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('max_execution_time', 300); //300 seconds = 5 minutes. In case if your CURL is slow and is loading too much (Can be IPv6 problem)
header("content-type: text/html; charset=UTF-8");

$connection = mysqli_connect("127.0.0.1","Admin","4kHsO4xvCk4AeVWgRulfNPexfFSehqeY","Authorization");
if (!$connection){
    die("Database Connection Failed");
}

$mysqli = new mysqli("127.0.0.1","Admin","4kHsO4xvCk4AeVWgRulfNPexfFSehqeY","Authorization"); 


if($_POST){
      if(isset($_POST['register_account'])) {
            $username_input = $_POST["uname"];
            $password_input = $_POST["password"];
            $license_input = $_POST["key"];
            if ($username_input == "") {
                echo '<script>alert("Please enter a username.");</script>';
                header("Refresh:0");
                return;
            }
            if ($password_input == "") {
                echo '<script>alert("Please enter a password.");</script>';
                header("Refresh:0");
                return;
            }
            if ($license_input == "") {
                echo '<script>alert("Please enter a license.");</script>';
                header("Refresh:0");
                return;
            }
               $shapassword = hash('sha512', $password_input."PUJuORdbg2JASIcA350ATSWzLj1bbgVp");
               
            $check_license = mysqli_query($connection, "SELECT username, expire FROM auth WHERE license = '" . $license_input . "';");

            if ($check_license) {
                $row = mysqli_fetch_array($check_license);

                if ($row['username'] != "") {
                    echo '<script>alert("License is not valid or its already redeemed.");</script>';
                    header("Refresh:0");
                    return;
                }

                $register_account = mysqli_query($connection, "UPDATE auth SET username = '" .  $username_input. "', password = '" . $shapassword . "', redeemed_date = DATE_ADD(NOW(), INTERVAL 0 day) WHERE license = '" . $license_input . "';");
                if ($register_account) {
                    $expire_start = new DateTime(date("Y-m-d H:i:s"));
                    $expire_end  = new DateTime($row['expire']);
                    $expire_diff = $expire_start->diff($expire_end);
                    $expire_days = $expire_diff->format('%r%a');
                    echo '<script>alert("Successfuly Registered, license Days Left: ' . $expire_diff->days . '.");</script>';
                    header("Refresh:0");
                    return;
                } else {
                    echo '<script>alert("Cant register account, conatct with developer.");</script>';
                    header("Refresh:0");
                    return;
                }
            } else {
                echo '<script>alert("License is not valid or its already redeemed.");</script>';
                header("Refresh:0");
                return;
            }
      }
}

?>
<!DOCTYPE html>

<html>

<head>

    <title>Register</title>

    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;900&display=swap" rel="stylesheet">

<style>

    body {
        height: 100vh;
        margin: 0;
        padding: 0;
        font-family: Source Sans Pro;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #242424;
    }

    form {
        margin-top: -10%;
        max-width: 400px;
        width: 100%;
        padding: 40px;
        border: 1px solid black;
        background-color: #272727;
    }

    label {
        color: white;
    }

    input {
        padding: 7px;
        border: 0;
        border-bottom: 1px solid #ccc;
        outline: none;
        font-size: 1.2em;
        width: 100%;
        background-color: #272727;
        transition: border-color .3s;
        color: white;
    }

    input:focus {
        border-color: #606060;
    }

    .btn {
        background: #303030;
        padding: 12px 50px;
        border: 1px solid black;
        font-size: 1.0em;
        cursor: pointer;
        margin: 20px 0;
        margin-left: 30%;
        margin-right: 30%;
        color: white;
        font-weight: bold;
        user-select: none;
        display: inline-block;
        transition: background .3s;
    }

    .btn:hover {
        background: #404040;
    }

    .btn:active {
        box-shadow: inset 0 0 3px 4px rgba(0,0,0,.2);
    }

    footer nav {
        text-align: center;
        margin-top: 10px;
    }

    footer nav a {
        color: #FFF;
        text-decoration: none;
        font-weight: 500;
        font-size: 14px;
        margin: 0 10px;
    }

    footer {
       position: fixed;
       left: 0;
       bottom: 0;
       width: 100%;
       height: 40px;
       background-color: #202020;
       color: white;
       text-align: center;
    }

    div.common_wrapper {
        width: 90%;
        max-width: 1280px;
        margin: 0 auto;
    }

</style>

</head>

<body>

    <form method="post">

        <label>Username</label>

        <input type="text" name="uname" placeholder="username"><br>

        <label>Password</label>

        <input type="password" name="password" placeholder="password"><br>

        <label>Key</label>

        <input type="key" name="key" placeholder="key"><br>

        <button class="btn" name="register_account">Register</button>

     </form>

        <footer>
            <div class="common_wrapper">
                <nav>
                    <a href="http://146.59.23.7/panel">Panel</a>
                    <a href="http://146.59.23.7/products.php">Products</a>
                    <a href="http://146.59.23.7/status.php">Status</a>
                    <a href="http://146.59.23.7/panel/index.php/faq">FAQ</a>
                    <a href="http://146.59.23.7/panel/index.php/tos">ToS</a>
                    <a href="http://146.59.23.7/key.php">Sign Up</a>
                    <a href="http://146.59.23.7/panel">Login</a>
                </nav>
            </div>
        </footer>

</body>

</html>
