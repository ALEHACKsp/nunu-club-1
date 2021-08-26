<?php
error_reporting(0);
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('max_execution_time', 300); //300 seconds = 5 minutes. In case if your CURL is slow and is loading too much (Can be IPv6 problem)
header("content-type: text/html; charset=UTF-8");
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);

$connection = mysqli_connect("127.0.0.1","Admin","4kHsO4xvCk4AeVWgRulfNPexfFSehqeY","Authorization");
if (!$connection){
    die("Database Connection Failed");
}

$mysqli = new mysqli("127.0.0.1","Admin","4kHsO4xvCk4AeVWgRulfNPexfFSehqeY","Authorization"); 


if($_POST){
    if(isset($_POST['Sumbit'])) {
        $password_input = $_POST["password"];

        if ($password_input == "") {
     	   echo '<script>alert("Please enter a password.");</script>';
            header("Refresh:0");
            return;
        }
        if ($password_input === "lRQ8TD265DbTGVswb9GMqY8TgYWaPAmHsnPLdOQGbfYTzCK1NTStNAJ0OAVFOKlzp9bsJZkFWKAxlUufDiD8pxQeDNVDGmlvrRtVksuEbOAROF8VUMRTmxu8gDRVr4xn") {
        	$_SESSION["Nunu_Logged_In"] = true;
        } else {
     	    echo '<script>alert("Invaild Password.");</script>';
            header("Refresh:0");
            return;
        }
    }
}

	if ($_SESSION["Nunu_Logged_In"] != true) {
		echo '
		<!DOCTYPE html>

		<html>

		<head>

		    <title>Gen</title>

		    <link rel="stylesheet" type="text/css" href="style.css">

		</head>

		<body>

		    <form method="post">

		        <label>Password</label>

		        <input type="password" name="password" placeholder="password"><br>

		        <button name="Sumbit">Sumbit</button>

		     </form>

		</body>

		</html>';
	} else {

function RandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return  $randomString;
}

	if($_POST){
	    if(isset($_POST['Generate'])) {
           $number_of_licenses = $_POST["number_of_licenses"];
            $licenses_time_expire = $_POST["license_time"];
                if ($number_of_licenses == "") {
                  echo '<script>alert("Please enter a number of keys.");</script>';
                  header("Refresh:0");
                  return;
                }
                if ($licenses_time_expire == "") {
                  echo '<script>alert("Please enter a time.");</script>';
                  header("Refresh:0");
                  return;
                }
                if ($number_of_licenses > 25) {
                  echo '<script>alert("Number of keys can not exceed 25.");</script>';
                  header("Refresh:0");
                  return;
                }
            if ($licenses_time_expire == "lifetime") {
                $licenses_time_expire = "1000 year";
            }
            if ($licenses_time_expire == "month") {
                $licenses_time_expire = "1 month";
            }
            if ($licenses_time_expire == "trial") {
                $licenses_time_expire = "7 day";
            }
            $i = 1;
            echo '<div id="div-table" style="position: absolute; top: 20%; left: 30%; border: 1px solid #353535;border-radius: 5px;overflow-x: hidden;width: 800px;height: 450px;" class="table-div">';
            while($i <= $number_of_licenses) {
                $license_gen_input = RandomString(64);
                echo'<string id="generated_licenses" value="'.$license_gen_input.'" style="color: white;position: absolute; transform: translate(-50%, 50%); left:50%">'.$license_gen_input."</string><br>";
                $gen_license = mysqli_query($connection, "INSERT INTO auth (license, expire) VALUES ('" . $license_gen_input . "', DATE_ADD(NOW(), INTERVAL " . $licenses_time_expire . "));");
                if ($gen_license) {
                    $message = $_SESSION["discord_id"] . " Generated key (" . $license_gen_input . ")";

                    $data = ['content' => $message];
                    $options = [
                        'http' => [
                        'method' => 'POST',
                        'header' => 'Content-Type: application/json',
                        'content' => json_encode($data)
                      ]
                    ];

                    $context = stream_context_create($options);
                    $result = file_get_contents('https://canary.discord.com/api/webhooks/857225312575160340/a2rcGx4nu0WW21EXNkEhqqZNh-rDXNqMB6ZyYi0bEjKW8JamEvJ6ytOFmFpUzRCAnPPx', false, $context);
                    if ($i == $number_of_licenses) {
                        mysqli_close($connection);
                    }
                }
                $i++;
            }
            echo '</div>';
        }
    }

		echo '
		<!DOCTYPE html>

		<html>

		<head>

		    <title>Gen</title>

		    <link rel="stylesheet" type="text/css" href="style.css">

		</head>

		<body>

		    <form method="post">

		        <label>Amount</label>

		        <input name="number_of_licenses" placeholder="Amount"><br>

				<label>Time</label>

		        <input name="license_time" style="width: 11%;" placeholder="Time (lifetime, month, trial)"><br>

		        <button name="Generate">Generate</button>

		     </form>

		</body>

		</html>';
	}
?>