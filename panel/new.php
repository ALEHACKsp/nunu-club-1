<?php

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
	ini_set('session.cookie_httponly', 1);
	ini_set('session.use_only_cookies', 1);

	$connection = mysqli_connect("127.0.0.1","Admin","4kHsO4xvCk4AeVWgRulfNPexfFSehqeY","Authorization");
	if (!$connection){
	    die("Database Connection Failed");
	}

	$mysqli = new mysqli("127.0.0.1","Admin","4kHsO4xvCk4AeVWgRulfNPexfFSehqeY","Authorization"); 

	if(!isset($_SESSION['verified']) || $_SESSION['verified'] !== true) {
		header("Location: https://nunu.club/panel/login.php");
		die();
	}

	if($_GET){
	    if(isset($_GET['logout'])) {
	        $_SESSION = array();
	        session_unset();
	        session_destroy();
	    
	        header("Location: https://nunu.club/panel/login.php");
	        exit;
	    }
	}

	if ($_SESSION['usernameget'] === "ventu") {
    echo '<style>
    @import url(\'https://fonts.googleapis.com/css?family=Raleway|Roboto\');
	  body {
	    background-color: #242424;
      	font-family: \'Roboto\', sans-serif;
	  }
  </style>
    ';
      echo '<h2 style="color: white; text-align: center;">You are blacklisted</h2>';
      echo '<h3 style="color: white; text-align: center;">Reason : Pasting</h3>';
      return;
	}

if (!function_exists('str_contains')) {
    function str_contains(string $haystack, string $needle): bool
    {
        return '' === $needle || false !== strpos($haystack, $needle);
    }
}

if (!str_contains($_SERVER['REQUEST_URI'], "/panel/new.php/profile?id=") && !str_contains($_SERVER['REQUEST_URI'], "/panel/new.php/dashboard") && !str_contains($_SERVER['REQUEST_URI'], "/panel/new.php/admin_menu")) {
	header("Location: https://nunu.club/panel/new.php/dashboard");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Panel</title>
	<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;900&display=swap" rel="stylesheet">
</head>
<style>

	body {
		font-family: Source Sans Pro;
		background-color: rgb(17, 24, 39);
	}

	label {
		color: white;
	}

	a {
		color: #959595;
		text-decoration: none;
	}

    a:hover {
        text-decoration: underline;
    }

	input {
		padding: 7px;
		border: 0;
		border-bottom: 1px solid #ccc;
		outline: none;
		font-size: 1.0em;
		color: white;
		background-color: rgb(19, 27, 43);
		transition: border-color .3s;
		max-width: 97%;
	}

    input:focus {
        border-color: #606060;
    }

	button {
	    border: 1px solid rgb(75, 85, 99);
	    border-radius: 5px;
	    background: none;
	    color: white;
	    text-align: center;
	    cursor: pointer;
	    outline: none;
	    transition: 0.25s;
	}

	button:hover {
		background: rgb(55, 65, 81);
	}

	.stats {
	    position: absolute;
	    right: 15px;
	    bottom: 55px;
	    padding:  10px;
		border: 1px solid #353535;
		border-radius: 5px;
		width: 200px;
	}

	.Div-Dashboard {
	    position: absolute;
	    transform: translate(-50%, -50%);
	    top: 50%;
	    left: 50%;
	    text-align: center;
	    width: 100%;
	    max-width: 100%;
	}

	.btn {
		background: #303030;
		padding: 12px 50px;
        border: 1px solid black;
		font-size: 1.0em;
		cursor: pointer;
		margin: 20px 0;
		color: white;
		font-weight: bold;
		user-select: none;
		display: inline-block;
		transition: background .3s;
	}

/* Fixed sidenav, full height */
.sidenav {
  height: 100%;
  width: 120px;
  position: fixed;
  max-width: 120px;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: rgb(31, 41, 55);
  overflow-x: hidden;
  padding-top: 20px;
}

/* Style the sidenav links and the dropdown button */
.sidenav a, .dropdown-btn {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  color: white;
  display: block;
  border: none;
  background: none;
  width: 100%;
  text-align: left;
  cursor: pointer;
  outline: none;
}

/* On mouse-over */
.sidenav a:hover, .dropdown-btn:hover {
  color: #f1f1f1;
}


	.btn2 {
		border-radius: 5px;
		padding: 5px 16px;
		width: 100px;
		max-width: 100px;
		font-size: 14px;
		cursor: pointer;
		color: white;
	    font-weight: 500;
		user-select: none;
		display: inline-block;
		transition: background .3s;
	}

    .btn2:hover {
        background: rgb(55, 65, 81);
        text-decoration: none;
    }

    .btn2:active {
        box-shadow: inset 0 0 3px 4px rgba(0,0,0,.2);
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
	   background-color: rgb(31, 41, 55);
	   color: white;
	   text-align: center;
	}

	*::-webkit-scrollbar {
	    width: 2px;
	}

	*::-webkit-scrollbar-track {
	    background: none;
	}

	*::-webkit-scrollbar-thumb {
	    background-color: #9C9C9C;
	}

    .modal {
      display: none;
      position: fixed;
      z-index: 1;
      padding-top: 100px;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgb(0,0,0);
      background-color: rgba(0,0,0,0.4);
    }

    .modal-content {
      background-color: rgb(17, 24, 39);
      margin: auto;
      padding: 10px;
      border: 1px solid #888;
      min-width: 25%;
      max-width: 25%;
      width: 25%;
      height: 19%;
    }

    .close {
      color: #aaaaaa;
      float: right;
      cursor: pointer;
      font-size: 28px;
      font-weight: bold;
    }
    .close:hover,
    .close:focus {
      color: #aaaaaa;
      text-decoration: none;
      cursor: pointer;
    }

	div.table#dashboard_products_i_own div.table_column:nth-of-type(1){
	    width: 30%;
	}


	div.table{
	}

	div.table div.table_head{
	    padding: 10px 0;
	    border-bottom: 1px solid #e2e2e2;
	}

	div.table div.table_head div.table_column p{
	    margin: 0;
	    font-size: 16px;
	    font-weight: 500;
	}

	div.table div.table_body div.table_row{
	    padding: 10px 0;
	    border-bottom: 1px solid #e2e2e2;
	}

	div.table div.table_body div.table_row:last-of-type{
	    border-bottom: 0;
	}
	div.table div.table_body div.table_row p{
	    margin: 0;
	}

	div.table div.table_head:before, div.table div.table_head:after, div.table div.table_row:before, div.table div.table_row:after{
	    content: " ";
	    display: table;
	}

	div.table div.table_head:after, div.table div.table_row:after{
	    clear: both;
	}

	div.table div.table_column{
	    float: left;
	}

	hr {
	    height: 0;
	    border: none;
	    border-top: 1px solid #e2e2e2;
	    margin: 10px 0;
	}

	p {
	    display: block;
	    margin-block-start: 1em;
	    margin-block-end: 1em;
	    margin-inline-start: 0px;
	    margin-inline-end: 0px;
	}

	div.common_wrapper {
	    width: 90%;
	    max-width: 1280px;
	    margin: 0 auto;
	}

	.Div-Options-Admin {
	    position: absolute;
	    transform: translate(-50%, -50%);
	    left: 50%;
	    text-align: center;
	    top: 50%;
	}

	.Admin-License-Table {
	    overflow: auto;
	    overflow-x: hidden;  
		width: 1000%;
		max-width: 1000%;
	}

    table.VapeTable {
      width: 100%;
      background-color: rgb(17, 24, 39);
      border-collapse: collapse;
      border-width: 2px;
      border-color: white;
      border-style: double;
      color: #ffffff;
      table-layout: fixed;
      border: none;
      max-width: 100%;
    }

    table.VapeTable th {
      border: none;
      padding: 3px;
      overflow-wrap: break-word;
    }

    table.VapeTable tr {
      border-bottom: 1px solid #353535;
    }

    table.VapeTable td {
      padding: 3px;
      overflow-wrap: break-word;
    }

    option {
    	padding: 5px;
    	outline: none;
    	color: white;
    	background-color: rgb(31, 41, 55);
    }

    select {
    	border: 1px solid black;
    	padding: 10px;
    	width: 60%;
    	text-align-last: center;
    	max-width: 100%;
    	outline: none;
    	appearance: none;
    	color: white;
    	background-color: rgb(31, 41, 55);
    }

</style>
<body>
<?php
if (str_contains($_SERVER['REQUEST_URI'], "/panel/new.php/profile?id=")) {

    $id = htmlspecialchars($_GET["id"]);
          if (!is_numeric($id)) {
              echo '<script>alert("Lol");</script>';
              header("Refresh:0");
              return;
          }

          $user_info = mysqli_query($connection, "SELECT username FROM auth WHERE uid = '" . intval($id) . "';");
          $row_info = mysqli_fetch_array($user_info);

          if ($user_info) {

            $check_user_license = mysqli_query($connection, "SELECT expire FROM auth WHERE username = '" . $row['username'] . "';");
            if ($check_user_license) {
                $row = mysqli_fetch_array($check_user_license);
                if ($row['valid'] == true) {
                    $user_role = "<label style=\"color: #FFFF00;\">customer</label>";
                } else {
                    $user_role = "<label style=\"color: gray;\">user</label>";
                }
            }
          }

    if($_POST){

        if(isset($_POST['send_comment'])) {
          $comment_input = $_POST["comment_input"];
          if ($comment_input == "") {
              echo '<script>alert("Please enter a comment.");</script>';
              header("Refresh:0");
              return;
          }

          $add_comment = mysqli_query($connection, "INSERT INTO panel_comments (creator_uid, creator_username, profile_uid, profile_username, message) VALUES ('" . $_SESSION["user_uid"]. "', '" . $_SESSION["usernameget"] . "', '" . intval($id) . "', '" . $row_info['username'] . "', '" . $comment_input . "');");
          if ($add_comment) {
              header("Refresh:0");
              return;
          }
        }
    }
    if ($row_info['username'] == "") {
        header('Location: new.php');
        return;
    }
    echo '
    <h4 style="position: absolute; left: 47.5%; top: 24%; color:white;">user profile</h4>
    <div style="border: 1px solid #353535; width: 600px; height: 40px; top: 35%; padding: 20px;" class="Div-Dashboard" id="user_profile">
    <label style="color:white;">username: </label><label style="color: #008cff;">' . $row_info["username"] . '</label>
    <br>';
    if ($row_info["username"] == "admin" || $row_info["username"] == "Nunu") {
        $user_role = "<label style=\"color: red;\">developer</label>";
    }

    echo '
    <label style="color:white;">role: </label>' . $user_role . '
    </div>
    <h4 style="position: absolute; left: 47.5%; top: 39.5%; color:white;">comments</h4>
    <div style="overflow: auto; border: 1px solid #353535; width: 610px; height: 360px; top: 65%; padding: 10px;" class="Div-Dashboard" id="comments_profile">
    <label id="show_input_to_comment" style="float: left; color: white;" onclick"ShowInputToComment()">leave a comment</label>
    <div style="display: none;" id="leave_a_comment">
    <form method="post">
    <button name="send_comment" style="position: absolute; right: 47%; top: 13.7%; height: 25px; width: 50px; font-size: 13px;">send</button>
    <br style="display: block; content: \'\'; border-bottom: 35px solid transparent;">
    <input name="comment_input" style="float: left; font-size: 13px; width: 250px;">
    </form>
    <br style="display: block; content: \'\'; border-bottom: 30px solid transparent;">
    </div>
    <br style="display: block; content: \'\'; border-bottom: 30px solid transparent;">';
                $user_comments = mysqli_query($connection, "SELECT * FROM panel_comments WHERE profile_uid = '". intval($id). "';");
                while($row = $user_comments->fetch_array(MYSQLI_ASSOC)){
                    if ($row['creator_uid'] == $_SESSION['user_uid'] || $row['profile_uid'] == $_SESSION['user_uid'] || $_SESSION["user_uid"] == "1" || $_SESSION["user_uid"] == "2") {
                    echo '
                    <a class="user_creator_comment" style="float: left; color:yellow; margin-top: -3px;" href="https://nunu.club/panel/new.php/deletecomment?id=' . $id . '&comment_id=' . $row['id'] . '">🗑️</a>';
                    }
                    echo '
                    <a class="user_creator_comment" href="https://nunu.club/panel/new.php/profile?id=' . htmlentities($row['creator_uid'], ENT_QUOTES, 'UTF-8') . '" style="float: left; color: rgb(200, 200, 200); font-size: 16px; margin-left: 7px;">' . htmlentities($row['creator_username'], ENT_QUOTES, 'UTF-8') . '</a>
                    <br>
                    <label style="cursor: text; float: left; color:grey; margin-left: 7px; font-size: 16px;">' . htmlentities($row['message'], ENT_QUOTES, 'UTF-8') . '</label>
                    <br style="display: block; content: \'\'; border-bottom: 25px solid transparent;">
                    <div style="border-bottom: solid 1px #202020;">
                    </div>
                    <br style="display: block; content: \'\'; border-bottom: 10px solid transparent;">';
                }
                $user_comments->close();
    echo '</div>
    <script>
    function ShowInputToComment () {
        if (document.getElementById("leave_a_comment").style.display === "none") {
            document.getElementById("leave_a_comment").style.display = "block";
        } else {
            document.getElementById("leave_a_comment").style.display = "none";
        }
    }
    document.getElementById("show_input_to_comment").addEventListener("click", ShowInputToComment);
    </script>';
}

    if (str_contains($_SERVER['REQUEST_URI'], "/panel/new.php/deletecomment?id=")) {
        $get_user_comment = mysqli_query($connection, "SELECT * FROM panel_comments WHERE id = '". intval($id). "';");
        if ($get_user_comment) {
            $row = mysqli_fetch_array($get_user_comment);
                    if ($row['creator_uid'] == $_SESSION['user_uid'] || $row['profile_uid'] == $_SESSION['user_uid'] || $_SESSION["user_uid"] == "1" || $_SESSION["user_uid"] == "2") {
                $comment_id = htmlspecialchars($_GET["comment_id"]);
                $delete_comment = mysqli_query($connection, "DELETE FROM panel_comments WHERE id = '" . intval($comment_id) . "';");
                if ($delete_comment) {
                  echo '<script>history.go(-1);</script>';
                  return;
                } else {
                  echo '<script>history.go(-1);</script>';
                  return;
                }
            } else {
                echo '<script>history.go(-1);</script>';
                return;
            }
        }
    }

if (str_contains($_SERVER['REQUEST_URI'], "/panel/new.php/dashboard")) {
echo '
          <div id="Redeem_Modal" class="modal">

            <div class="modal-content">
              <span class="close">&times;</span>
              <strong>
                <p style="color: white;">Redeem Key</p>
              </strong>
              <hr style="border: 1px solid #353535">
              <br>
                <form method="post">
                  <input type="text" name="license_input" placeholder="License" style="text-align:center; min-width:1px; width: 460px; height: 10%;">
                <br>
              <br>
              <hr style="border: 1px solid #353535">
                  <button name="redeem_license" style="float: right;">Redeem Key</button>
                </form>
            </div>
          </div>
 <div class="Div-Dashboard">
	 <div style="position: relative; transform: translate(27%, -5%); background-color: rgb(31, 41, 55); border: 1px solid rgb(75, 85, 99); border-radius: 5px; overflow-x: hidden; max-width: 60%; height: 400px; max-height 400px; padding: 10px;" class="table-div">
	 	<label style="display: block; color:white; text-align: center;">'; echo'welcome. <a href="https://nunu.club/panel/new.php/profile?id=' . $_SESSION['user_uid'] . '">' . $_SESSION["usernameget"] . '</a> (uid: ' . $_SESSION["user_uid"] . ')</label>
		<hr><br><br>
		<div style="width: 50%; float: left;">
			<label style=" color:white;">stats</label><br>';
}
//	<h4 style="color:white; position: relative; bottom: 220px;">user profile</h4>

			?>
			<?php
			if (str_contains($_SERVER['REQUEST_URI'], "/panel/new.php/dashboard")) {
		      $info_sub = mysqli_query($connection, "SELECT license, expire FROM auth WHERE username = '" . $_SESSION["usernameget"] . "';");
		      $expire_date_license;
		        if ($info_sub) {
		        	$row = mysqli_fetch_array($info_sub);
		        	$expire_date_license = $row['expire'];
					    $expire_start = new DateTime(date("Y-m-d H:i:s"));
					    $expire_end  = new DateTime($row['expire']);
					    $expire_diff = $expire_start->diff($expire_end);
					    $expire_days = $expire_diff->format('%r%a');
		        }
				$newest_user_id = mysqli_query($connection, "SELECT MAX(uid) FROM auth;");
				$nu_ri = mysqli_fetch_array($newest_user_id);
				$newest_user= mysqli_query($connection, "SELECT username FROM auth WHERE uid = '" . $nu_ri[0] . "';");
				$nu_row = mysqli_fetch_array($newest_user);
				$registered_users = mysqli_query($connection, "SELECT count(*) as total FROM auth WHERE username != '';");
				$r_row = mysqli_fetch_array($registered_users);

				$result_users_online = mysqli_query($connection, "SELECT * FROM online_users"); 
				$count_user_online = mysqli_num_rows($result_users_online);

			echo '
		<label>online users: ' . $count_user_online . '</label><br>
		<label>registered users: ' . $r_row["total"] . '</label><br>
		<label>newest user: </label><a href="https://nunu.club/panel/new.php/profile?id=' . $nu_ri[0] . '">' . $nu_row["username"] . '</a><br><br>
			<label>client</label><br>
			<a href="xd">download loader</a>
		</div>
		<div style="width: 50%; float: right;">
			<label>discord</label><br>
			<a href="xd">link account</a><br><br>
			<label>information</label><br>
			<a href="xd">frequently asked questions</a><br>
			<a href="xd">terms of service</a>
		</div>
		<h4 style="color: white;">Your Active Licenses : </h4>';
		if ($expire_diff->h > 1) {
			echo '
                  <div class="table" id="dashboard_products_i_own">
                         <div class="table_head">
                            <div class="table_column" style="width: 33%;"><p style="color: white;">Product</p></div>
                            <div class="table_column" style="width: 33%;"><p style="color: white;">Time Remaining</p></div>
                            <div class="table_column" style="width: 33%;"><p style="color: white;">Expires On</p></div>
                         </div>
                        <div class="table_body">
                        	<div class="table_row">
                        		<div class="table_column" style="width: 33%;"><p style="color: white;"><a style="font-size: 16px;" href="x">Nunu Cheat</a></p></div>
	                            <div class="table_column" style="width: 33%;"><p style="color: white;">' . $expire_diff->days . ' Day(s) ' . $expire_diff->h . ' Hour(s)</p></div>
 								<div class="table_column" style="width: 33%;"><p style="color: white;">' . $expire_date_license . '</p></div>
                            </div>
                        </div>
                  </div>';
        } else {
        	echo '<label style=" color:red;">expired</label><br><a id="Redeem_Key_Button_Modal">Redeem</a><br><br>';
        }
        echo '
	</div>
</div>';
}

if ($_SESSION['usernameget'] === "Nunu" || $_SESSION['usernameget'] === "admin") {
	if (str_contains($_SERVER['REQUEST_URI'], "/panel/new.php/admin_menu/licenses")) {

		if ($_POST) {
			if (isset($_POST['admin_delete_key'])) {
				$license = $_POST['admin_delete_key'];
				$delete_license = mysqli_query($connection, "DELETE FROM auth WHERE license = '" . $license . "';");
				if ($delete_license) {
					  mysqli_close($connection);
			          header("Refresh:0");
			          return;
		      	} else {
			          mysqli_close($connection);
			          echo '<script>alert("Something went wrong contact with Developer");</script>';
			          header("Refresh:0");
			          return;
		      	}
			}
			if (isset($_POST['admin_reset_hwid_key'])) {
				$license = $_POST['admin_reset_hwid_key'];
				$reset_hwid_license = mysqli_query($connection, "UPDATE auth SET hwid = NULL WHERE license = '" . $license . "';");
				if ($reset_hwid_license) {
			          header("Refresh:0");
			          return;
				} else {
			          mysqli_close($connection);
			          echo '<script>alert("Something went wrong contact with Developer");</script>';
			          header("Refresh:0");
			          return;
				}
			}
			if (isset($_POST['admin_ban_key'])) {
				$license = $_POST['admin_ban_key'];
				$license_info = mysqli_query($connection, "SELECT username, license, hwid, ip FROM auth WHERE license = '" . $license . "';");
				if ($license_info) {
					$row = mysqli_fetch_array($license_info);
					$license_ban = mysqli_query($connection, "INSERT INTO bans (username, license, hwid, ip) VALUES ('" . $row["username"] . "', '" . $row["license"] . "', '" . $row["hwid"] . "', '" . $row["ip"] . "');");
					if ($license_ban) {
				          header("Refresh:0");
				          return;
					} else {
				          mysqli_close($connection);
				          echo '<script>alert("Something went wrong contact with Developer");</script>';
				          header("Refresh:0");
				          return;
					}
				}
			}
		}

		echo '
        <div class="Div-Options-Admin">
            <h3 style="position: relative; bottom: 310px; color:white;">All Licenses</h3>
            <div style="border: 1px solid #353535;border-radius: 5px; position: absolute; top:-120%; transform: translate(-50%, -50%); left:50%;" class="Admin-License-Table">
                <table class="VapeTable">';
                $all_licenses_admin = mysqli_query($connection, "SELECT * FROM auth;");
                echo '
                    <tr>
                        <th>User</th>
                        <th>License</th>
                        <th>Expires On</th>
                        <th>Hwid</th>
                        <th>Actions</th>
                    </tr>';
                    while($row = $all_licenses_admin->fetch_array(MYSQLI_ASSOC)){
                    	$check_ban = mysqli_query($connection, "SELECT license FROM bans WHERE license = '"  . $row['license'] . "';");
                    	$row_ban = mysqli_fetch_array($check_ban);
                      if ($row['hwid'] == "") {
                        $row['hwid'] = "None";
                      }
                      if ($row['username'] == "") {
                        $row['username'] = "None";
                      }
                      if ($row_ban['license'] === $row['license']) {
                      	$banned = "Banned";
                      } else {
                      	$banned = "Not Banned";
                      }
                        echo '
                        <tr>
                            <td>' . $row['username'] . '</td>
                            <td><button onclick="copy_to_clipboard(\'' . $row['license'] . '\')" value="' . $row['license'] . '">Copy Key</button>(' . $banned . ')</td>
                            <td>' . $row['expire'] . '</td>
                            <td>' . $row['hwid'] . '</td>
                            <form method="POST">
                            <td><button name="admin_delete_key" value="' . $row['license'] . '">Delete</button><button name="admin_reset_hwid_key" value="' . $row['license'] . '">Reset Hwid</button><button name="admin_ban_key" value="' . $row['license'] . '">Ban</button></td>
                            </form>
                        </tr>';
                    }
                    $all_licenses_admin->close();
                    echo '
                </table>
            </div>
        </div>
	<script>
	    function copy_to_clipboard(str) {
	      var el = document.createElement(\'textarea\');
	      el.value = str;
	      el.setAttribute(\'readonly\', \'\');
	      el.style = {position: \'absolute\', left: \'-9999px\'};
	      document.body.appendChild(el);
	      el.select();
	      document.execCommand(\'copy\');
	      document.body.removeChild(el);
	      alert(\'Copied to clipboard.\');
	    }
	</script>';
	}
	if (str_contains($_SERVER['REQUEST_URI'], "/panel/new.php/admin_menu/bans")) {

		if ($_POST) {
			if (isset($_POST['admin_manage'])) {
				$action = $_POST['admin_selected_action'];
				$user = $_POST['admin_selected_user'];
				if ($action === "admin_unban") {
					$delete_license = mysqli_query($connection, "DELETE FROM bans WHERE username = '" . $user . "';");
					if ($delete_license) {
						  mysqli_close($connection);
				          header("Refresh:0");
				          return;
			      	} else {
				          mysqli_close($connection);
				          echo '<script>alert("Something went wrong contact with Developer");</script>';
				          header("Refresh:0");
				          return;
			      	}
				}
			}
		}

		echo '
        <div class="Div-Options-Admin">
            <h3 style="position: relative; bottom: 310px; color:white;">All Bans</h3>
            <div style="height: 550%; width: 653%; border: 1px solid #353535;border-radius: 5px; position: absolute; top:50%; transform: translate(-50%, -50%); left:50%;" class="Admin-License-Table">
            <button onclick="history.go(-1);" style="background: rgb(31, 41, 55); border-radius: 1px; border: none; width: 100%; height: 20px;">Back to Prev Page</button>
            <h4 style="color: white;">User</h4>
            <form method="post">
                <select name="admin_selected_user" size="1" autocomplete="off">';
                $all_licenses_admin = mysqli_query($connection, "SELECT * FROM bans;");
                    while($row = $all_licenses_admin->fetch_array(MYSQLI_ASSOC)){
                        echo '
						    <option value="' . $row["username"] . '">' . $row["username"] . '</option>
						';
                    }
                    $all_licenses_admin->close();
                    echo '
                </select>
                <h4 style="color: white;">Action</h4>
                <select name="admin_selected_action" size="1" autocomplete="off">
                <option value="admin_unban">Unban</option>
                </select><br><br><br>
                <button name="admin_manage" style="width: 60%; height: 30px;">Manage</button>
                </form>
            </div>
        </div>';
	}
	if (str_contains($_SERVER['REQUEST_URI'], "/panel/new.php/admin_menu/users")) {

		if ($_POST) {
			if (isset($_POST['admin_manage'])) {
				$action = $_POST['admin_selected_action'];
				$user = $_POST['admin_selected_user'];
				if ($action === "admin_delete") {
					$delete_license = mysqli_query($connection, "DELETE FROM auth WHERE username = '" . $user . "';");
					if ($delete_license) {
						  mysqli_close($connection);
				          header("Refresh:0");
				          return;
			      	} else {
				          mysqli_close($connection);
				          echo '<script>alert("Something went wrong contact with Developer");</script>';
				          header("Refresh:0");
				          return;
			      	}
				}
				if ($action === "admin_reset_hwid") {
					$reset_hwid_license = mysqli_query($connection, "UPDATE auth SET hwid = NULL WHERE username = '" . $user . "';");
					if ($reset_hwid_license) {
						  mysqli_close($connection);
				          header("Refresh:0");
				          return;
					} else {
				          mysqli_close($connection);
				          echo '<script>alert("Something went wrong contact with Developer");</script>';
				          header("Refresh:0");
				          return;
					}
				}
				if ($action === "admin_unban") {
					$delete_license = mysqli_query($connection, "DELETE FROM bans WHERE username = '" . $user . "';");
					if ($delete_license) {
						  mysqli_close($connection);
				          header("Refresh:0");
				          return;
			      	} else {
				          mysqli_close($connection);
				          echo '<script>alert("Something went wrong contact with Developer");</script>';
				          header("Refresh:0");
				          return;
			      	}
				}
				if ($action === "admin_ban") {
					$license_info = mysqli_query($connection, "SELECT username, license, hwid, ip FROM auth WHERE username = '" . $user . "';");
					if ($license_info) {
						$row = mysqli_fetch_array($license_info);
						$license_ban = mysqli_query($connection, "INSERT INTO bans (username, license, hwid, ip) VALUES ('" . $row["username"] . "', '" . $row["license"] . "', '" . $row["hwid"] . "', '" . $row["ip"] . "');");
						if ($license_ban) {
					          header("Refresh:0");
					          return;
						} else {
					          mysqli_close($connection);
					          echo '<script>alert("Something went wrong contact with Developer");</script>';
					          header("Refresh:0");
					          return;
						}
					}
				}
			}
		}

		echo '
        <div class="Div-Options-Admin">
            <h3 style="position: relative; bottom: 310px; color:white;">All Users</h3>
            <div style="height: 550%; width: 600%; border: 1px solid #353535;border-radius: 5px; position: absolute; top:50%; transform: translate(-50%, -50%); left:50%;" class="Admin-License-Table">
            <button onclick="history.go(-1);" style="background: rgb(31, 41, 55); border-radius: 1px; border: none; width: 100%; height: 20px;">Back to Prev Page</button>
            <h4 style="color: white;">User</h4>
            <form method="post">
                <select name="admin_selected_user" size="1" autocomplete="off">';
                $all_licenses_admin = mysqli_query($connection, "SELECT * FROM auth;");
                    while($row = $all_licenses_admin->fetch_array(MYSQLI_ASSOC)){
                        echo '
						    <option value="' . $row["username"] . '">' . $row["username"] . '</option>
						';
                    }
                    $all_licenses_admin->close();
                    echo '
                </select>
                <h4 style="color: white;">Action</h4>
                <select name="admin_selected_action" size="1" autocomplete="off">
                <option value="admin_reset_hwid">Reset Hwid</option>
                <option value="admin_ban">Ban</option>
                <option value="admin_unban">Unban</option>
                <option value="admin_delete">Remove</option>
                </select><br><br><br>
                <button name="admin_manage" style="width: 60%; height: 30px;">Manage</button>
                </form>
            </div>
        </div>';
	}
	if (str_contains($_SERVER['REQUEST_URI'], "/panel/new.php/admin_menu/info_sub")) {

		if ($_POST) {
			if (isset($_POST['admin_get_info'])) {
				$license = $_POST['admin_selected_license'];
					$license_info = mysqli_query($connection, "SELECT * FROM auth WHERE license = '" . $license . "';");
					if ($license_info) {
						$row = mysqli_fetch_array($license_info);
						$license_info_ban = mysqli_query($connection, "SELECT * FROM bans WHERE license = '" . $row['license'] . "';");
						$row_ban = mysqli_fetch_array($license_info_ban);
	                      if ($row_ban['license'] === $row['license']) {
	                      	$banned = "true";
	                      } else {
	                      	$banned = "false";
	                      }
						  mysqli_close($connection);
						  echo '
					        <div class="Div-Options-Admin">
					            <h3 style="position: relative; bottom: 310px; color:white;">Information subscribe</h3>
					            <div style="height: 550%; width: 400%; border: 1px solid #353535;border-radius: 5px; position: absolute; top:-120%; transform: translate(-50%, -50%); left:50%;" class="Admin-License-Table">
					            <button onclick="history.go(-1);" style="background: rgb(31, 41, 55); border-radius: 1px; border: none; width: 100%; height: 20px;">Back to Prev Page</button>
					            <h4 style="color: rgb(160, 160, 160);">Infomation subscribe</h4>
					            <label style="color: rgb(180, 180, 180);">License key: ' . $row['license'] . '</label><br>
					            <label style="color: rgb(180, 180, 180);">End: ' . $row['expire'] . '</label><br>
					            <label style="color: rgb(180, 180, 180);">Banned: ' . $banned . '</label><br>
					            <h4 style="color: rgb(160, 160, 160);">Infomation last launch</h4>
					            <label style="color: rgb(180, 180, 180);">Date: ' . $row['LastInject'] . '</label><br>
					            <label style="color: rgb(180, 180, 180);">IP: ' . $row['ip'] . '</label><br>
					            </div>
					        </div>
						  ';
				          return;
			      	} else {
				          mysqli_close($connection);
				          echo '<script>alert("Something went wrong contact with Developer");</script>';
				          header("Refresh:0");
				          return;
			      	}
			}
		}

		echo '
        <div class="Div-Options-Admin">
            <div style="height: 600%; width: 130%; border: 1px solid #353535;border-radius: 5px; position: relative; bottom: -100px; transform: translate(-50%, -50%); left:50%;" class="Admin-License-Table">
            <button onclick="history.go(-1);" style="background: rgb(31, 41, 55); border-radius: 1px; border: none; width: 100%; height: 20px;">Back to Prev Page</button>
            <h3 style="color:white;">Information subscribe</h3><br>
            <h4 style="color: white;">License key</h4>
            <form method="post">
                <select style="width: 75%;" name="admin_selected_license" size="1" autocomplete="off">';
                $all_licenses_admin = mysqli_query($connection, "SELECT * FROM auth;");
                    while($row = $all_licenses_admin->fetch_array(MYSQLI_ASSOC)){
                        echo '
						    <option value="' . $row["license"] . '">' . $row["license"] . '</option>
						';
                    }
                    $all_licenses_admin->close();
                    echo '
                </select><br><br><br>
                <button name="admin_get_info" style="width: 75%; height: 30px;">Get information</button><br><br><br>
                </form>
            </div>
        </div>';
	}
}
?>

<!-- 	<div style="position: absolute; transform: translate(-10%, 1%); height: 98%; max-height: 98%; width: 12%; max-width: 12%; background: rgb(31, 41, 55);"> -->
<!-- 	<div style="position: absolute; transform: translate(-10%, 1%); height: 98%; max-height: 98%; width: 12%; max-width: 12%; background: rgb(31, 41, 55);"> -->
	<div class="sidenav">
		<label style="position: relative; left: 20px; font-size: 30px;">Nunu Panel</label>
		<br>
		<br>
		<br>
				<div style="position: absolute; transform: translate(10%, 1%); width: 100%; background: rgb(31, 41, 55);">

			<form method="get">
				<button style="text-align: left; border: none;" class="btn2" name="logout">Logout</button><br>
				<a href="https://nunu.club/panel/new.php/dashboard" class="btn2">Dashboard</a>
				<a href="https://nunu.club/panel/new.php/reset_hwid" class="btn2">Resets</a>
				<a href="https://nunu.club/panel/new.php/download" class="btn2">Download</a>
			</form>
			<?php
			if ($_SESSION['usernameget'] === "Nunu" || $_SESSION['usernameget'] === "admin") {
				echo '
					<label style="color: white; font-size: 14px; font-weight: 500;">Admin Options</label>
				<a href="https://nunu.club/panel/new.php/admin_menu/users" class="btn2">Users</a>
				<a href="https://nunu.club/panel/new.php/admin_menu/bans" class="btn2">Bans</a>
				<a href="https://nunu.club/panel/new.php/admin_menu/info_sub" class="btn2">Info Sub</a>
				<a href="https://nunu.club/panel/new.php/admin_menu/licenses" class="btn2">Licenses</a>';
			}
			?>
		</div>
	</div>
        <footer>
            <div class="common_wrapper">
                <nav>
                    <a href="https://nunu.club/panel">Panel</a>
                    <a href="https://nunu.club/products.php">Products</a>
                    <a href="https://nunu.club/status.php">Status</a>
                    <a href="https://nunu.club/panel/new.php/faq">FAQ</a>
                    <a href="https://nunu.club/panel/new.php/tos">ToS</a>
                    <a href="https://nunu.club/key.php">Sign Up</a>
                    <a href="https://nunu.club/panel">Login</a>
                </nav>
            </div>
        </footer>
<script>
      function Modal_Redeem() {
        let modal_redeem = document.getElementById("Redeem_Modal");
        let Show_Modal_Button = document.getElementById("Redeem_Key_Button_Modal");
        let span_close = document.getElementsByClassName("close")[0];
        let button_close = document.getElementById("close_button");

        Show_Modal_Button.onclick = function() {
          modal_redeem.style.display = "block";
        }

        span_close.onclick = function() {
          modal_redeem.style.display = "none";
        }

        button_close.onclick = function() {
          modal_redeem.style.display = "none";
        }

        window.onclick = function(event) {
          if (event.target == modal_redeem) {
            modal_redeem.style.display = "none";
          }
        }
      }
      Modal_Redeem();
</script>
</body>
</html>