<?php

	$token = htmlspecialchars($_GET["token"]);

	if ($token != "KiWmwuGA1FTOrNuN8cu0IK5H4hWP1gl4GAt70mieoDk1hGyRdFmGsF5qnOP8xtor") {
        echo '8mKLh5ej5TgxPKfrSWDrVPEExzbtrdBT5bfhvYV98AmV8AwGWzlWj37NjrfVWp1T';
        http_response_code(403);
        return;
	}

	if (!isset($_SESSION))
		session_start();

	ob_start();
	error_reporting(0);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	ini_set('max_execution_time', 300); //300 seconds = 5 minutes. In case if your CURL is slow and is loading too much (Can be IPv6 problem)
	header("content-type: text/html; charset=UTF-8");
	ini_set('session.cookie_httponly', 1);
	ini_set('session.use_only_cookies', 1);

	/////////////////////////////////////////////

	$file = '/home/dll_nunu/Nunu_Cheat.dll';

	if ($file) {
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="' . basename($file) . '"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Content-Transfer-Encoding: Binary');
		header('Pragma: private');
		header('Content-Length: ' . filesize($file));
		ob_clean();
		readfile($file);
	}
	echo 'lolz';
?>