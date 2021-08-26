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



            $check_status = mysqli_query($connection, "SELECT * FROM status;");

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
        border:none;
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

    div {
        display: block;
        color: white;
    }

    h2 {
        display: block;
        font-size: 1.5em;
        margin-block-start: 0.83em;
        margin-block-end: 0.83em;
        margin-inline-start: 0px;
        margin-inline-end: 0px;
        font-weight: bold;
    }

</style>

</head>

<body>

    <div style="border-top: 5px solid #202020; width: 20%; background: #272727; padding: 20px;">

        <h2 style="color: white;">Status Page</h2>

                <div style="padding: 30px 0; border-bottom: 1px solid #e2e2e2;">
                            <div style="width: 50%; float: left;">
                                <p>Product Name</p>
                            </div>
                            <div style="width: 50%; text-align: right; float: left;">
                                <p>Status</p>
                            </div>
                         <br>
                         <?php
                         while($row = $check_status->fetch_array(MYSQLI_ASSOC)){
                            if ($row["status"] === "Under Maintence") {
                                $status_name = "<p style=\"color: orange;\">" . $row["status"] . "</p>";
                            }
                            if ($row["status"] === "Undetected") {
                                $status_name = "<p style=\"color: #00ff00;\">" . $row["status"] . "</p>";
                            }
                            if ($row["status"] === "Detected") {
                                $status_name = "<p style=\"color: red;\">" . $row["status"] . "</p>";
                            }
                            if ($row["status"] === "Testing") {
                                $status_name = "<p style=\"color: #009BFF;\">" . $row["status"] . "</p>";
                            }
                            echo '
                            <div style="width: 50%; float: left;">
                                <p>' . $row["name"] . '</p>
                            </div>
                            <div style="width: 50%; text-align: right; float: left;">
                                ' . $status_name . '
                            </div>';
                         }
                        ?>
                  </div>

     </div>

        <footer>
            <div class="common_wrapper">
                <nav>
                    <a href="http://nunu.club/panel">Panel</a>
                    <a href="http://nunu.club/products.php">Products</a>
                    <a href="http://nunu.club/status.php">Status</a>
                    <a href="http://nunu.club/panel/index.php/faq">FAQ</a>
                    <a href="http://nunu.club/panel/index.php/tos">ToS</a>
                    <a href="http://nunu.club/key.php">Sign Up</a>
                    <a href="http://nunu.club/panel">Login</a>
                </nav>
            </div>
        </footer>

</body>

</html>
