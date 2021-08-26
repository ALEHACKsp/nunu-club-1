<?php

	function GenSessionID($length) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}

	if (!isset($_SESSION))
	{
	    session_start();
	}

	ob_start();
	error_reporting(0);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	ini_set('max_execution_time', 300); //300 seconds = 5 minutes. In case if your CURL is slow and is loading too much (Can be IPv6 problem)
	header("content-type: text/html; charset=UTF-8");
	header("set-cookie: nunu_session=" . GenSessionID(248) . "; Max-Age=7200; path=/; httponly");
	ini_set('session.cookie_httponly', 1);
	ini_set('session.use_only_cookies', 1);

$connection = mysqli_connect("127.0.0.1","Admin","4kHsO4xvCk4AeVWgRulfNPexfFSehqeY","Authorization");
if (!$connection){
    die("Database Connection Failed");
}

$mysqli = new mysqli("127.0.0.1","Admin","4kHsO4xvCk4AeVWgRulfNPexfFSehqeY","Authorization"); 

	if(isset($_SESSION['verified']) || $_SESSION['verified'] === true) {
		header("Location: index.php");
		return;
	}

$errors = array();
global $errors;

	if($_POST){
	    if(isset($_POST['login'])) {
	        $username = $_POST["username_input"];
	        $userpasswd = $_POST["password_input"];
	        if ($username == "" || empty($username)) {
	            $errors[] = "Please enter a username.";
	        }
	        if (preg_match('/[\'\"^£$%&*()}{@#~?><>,|=_+¬-]/', $username)) {
	            $errors[] = "Dont use special characters in username.";
	        }
	        if ($userpasswd == "" || empty($userpasswd)) {
	          $errors[] = "Please enter a password.";
	        }
	              $shapassword = hash('sha512', $userpasswd."PUJuORdbg2JASIcA350ATSWzLj1bbgVp");
	    if ($username == "" || empty($username) || preg_match('/[\'\"^£$%&*()}{@#~?><>,|=_+¬-]/', $username) || $userpasswd == "" || empty($userpasswd) || strlen($errors[0]) > 3) {
	        } else {
	      $users = mysqli_query($connection, "SELECT password, uid FROM auth WHERE username = '" . $username . "';");
	        if ($users) {
	          $usersrows = mysqli_fetch_array($users);
	            if ($usersrows["password"] === $shapassword) {
	              $_SESSION["verified"] = true;
	              $_SESSION["usernameget"] = $username;
	              $_SESSION["user_uid"] = $usersrows["uid"];
	              
	              $message = "----------------------------------------------------------------------\n**" . $_SESSION["usernameget"] . " connected with Panel .**\nIP: `". $_SERVER['REMOTE_ADDR'] . "`\n----------------------------------------------------------------------";

	              $data = ['content' => $message];
	              $options = [
	                  'http' => [
	                  'method' => 'POST',
	                  'header' => 'Content-Type: application/json',
	                  'content' => json_encode($data)
	                ]
	              ];

	              $context = stream_context_create($options);
	              $result = file_get_contents('https://canary.discord.com/api/webhooks/857344341152628769/Rc1JuGBwEdzTk-nStp7afyS7oBXP2DEYZNW5YkQQ5Rc5d_NEpJQFDr8k2nR3kgL3djwo', false, $context);
	              header('Location: index.php/dashboard');
	            } else {
	                mysqli_close($connection);
	                $errors[] = "Invalid username or password.";
	              }
	          }
	      }
	    }
	}
function output_error($errors) {
    return '<br><p style="color: red; text-align: center;">' . $errors[0] . '</p>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/animate.min.css">
</head>
<body>
	<?php
	echo '
	<form method="post">
		' . output_error($errors) . '
                <h1 class="glitch" data-text="Sign In">
                    Sign In
                </h1>
		<label>Username</label>
		<input placeholder="Username" name="username_input" type="text" name="username" />
		<label>Password</label>
		<input placeholder="Password" name="password_input" type="password" name="password" />
		<br>
		<button name="login" class="btn">Log In</button>
	</form>';
?>
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

	label {
		color: white;
	}

    form {
        margin-top: -10%;
        max-width: 500px;
        width: 100%;
        padding: 40px;
        border: 1px solid black;
        background-color: #272727;
    }

	label {
		margin: 10px 0 0 0;
		font-size: 1.2em;
		display: block;
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
</body>
</html>