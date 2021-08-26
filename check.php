<?php
date_default_timezone_set('Europe/Warsaw');

    $con = mysqli_connect("127.0.0.1","LoaderAdmin","OUwThBy647BZ8fqZoGW16ICDTgUukxyW","Authorization"); 

    $username = htmlspecialchars($_GET["username"]);
    $password = htmlspecialchars($_GET["password"]);
    $hwid = htmlspecialchars($_GET["hwid"]);
    $token = htmlspecialchars($_GET["token"]);
    $filepath = htmlspecialchars($_GET["filename"]);
    $shapassword = hash('sha512', $password."PUJuORdbg2JASIcA350ATSWzLj1bbgVp");

    if ($token !== "0Qehw9ViWdsLPkOW4jPZq5E6jv8LuN511Do0MLHuDVqrKneKL0iErJOuhS6NGiWv") {
        echo 'krDKQdLZJlTobcXRHdnic5t4ISFRTlXJezWFHkidRRxQ16BYSZ3SvytqUCCfX5pR';
        http_response_code(403);
        return;
    }

    if ($_SERVER['HTTP_USER_AGENT'] !== "User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36") {
        echo 'krDKQdLZJlTobcXRHdnic5t4ISFRTlXJezWFHkidRRxQ16BYSZ3SvytqUCCfX5pR';
        http_response_code(403);
        return;
    }

    $check_ban = $con->query("SELECT * FROM bans WHERE username = '". $username . "' OR hwid = '" . $hwid . "' OR ip = '" . $_SERVER['REMOTE_ADDR'] . "';");
    if ($check_ban) {
        if (mysqli_num_rows($check_ban) > 0) {
          $message = "Banned user tried to connect, username: " . $username;

          $data = ['content' => $message];
          $options = [
              'http' => [
              'method' => 'POST',
              'header' => 'Content-Type: application/json',
              'content' => json_encode($data)
            ]
          ];

          $context = stream_context_create($options);
          $result = file_get_contents("https://canary.discord.com/api/webhooks/857180422567231488/7lJux8q7rfz1HwlmPV1fQTFlJ8_0mDw1hxR78Vh_dxCVp0DoZHZWEXu-lPiOubGzIC61", false, $context);
            echo 'dSq7FjJoWuEp60zENzFWX4CcqtoDrXTg2bVFnmDdodK3ICYyf887u3TVAqdBnQz1gPohAipqMz35UeW0CCHq0bl2ARdzzx20VajSUHXQvAS5CrZarOT9GiIHQbYHcqzl';
            http_response_code(403);
            return;
        }
    }

  $auth_connection = $con->query("SELECT * FROM auth WHERE username = '". $username . "' AND password = '" . $shapassword . "';");

  $row = mysqli_fetch_array($auth_connection);

  if (mysqli_num_rows($auth_connection) > 0) {
    $update_ip = $con->query("UPDATE auth SET ip = '" . $_SERVER['REMOTE_ADDR'] . "' WHERE username = '". $username . "' AND password = '" . $shapassword . "';");
    $update_filepath = $con->query("UPDATE auth SET FilePath = '" . $filepath . "' WHERE username = '". $username . "' AND password = '" . $shapassword . "';");

    echo '6FXRbktbJVZgtof6fmKJtO3Xc1hNd3WBvMPYJqq2fLq1f4ySA5rNZE8HLubZuBoEkQSADggJSCc4SrdqmrObA8xCcEQHw5xOyY2rjeI0WWBa5RKTsXl1ujbEl1HbeIER';

    if ($hwid === $row['hwid']) {

        echo '7MblJ3QuTZiINYe3nDq0qHfMUTK056vL6yC46aKV2RL0Hn3zA2jTzr8HgHa2VPPWkqHyk7UIxbvQii59uA7OWw40ioVr1jKp3C8CZQ3Q6lDva794nFNLjPJ8S6nJLpyy';
        $date = date_create();
        $date_expire = date_create($row['expire']);
        if (date_timestamp_get($date_expire) > date_timestamp_get($date)) {
            echo 'Z9J4SrcdywBOimCTln0s87ZlPvw3QRDvse5Pgw4NVNN6gUNLfxQDDLtLWcQLzcn98kYGnhFvltYnk0UWSBcGjQ9XwgSSjLak0XuLCXD9dA8F0owgQ114jdgMOvfdQkc3';
            http_response_code(200);
        } else {
            echo 'AisCw32stumy1MWkLnMp8WaQrDqtqpWWo03EZdML8uRVPwCBapRYO2kWx4qdaE0YuqPy9nuntMomSwwQtYJ2xGSqAGP7YXbISxvDo8ZhuL9lEZQRsk6dQ0MBAGudhO7i';
            http_response_code(403);
            return;
        }

    } else {
        if ($row['hwid'] === NULL || $row['hwid'] === "") {
            $date = date_create();
            $date_expire = date_create($row['expire']);
            if (date_timestamp_get($date_expire) > date_timestamp_get($date)) {
                  $message = $username . " Connected With Auth in loader";

                  $data = ['content' => $message];
                  $options = [
                      'http' => [
                      'method' => 'POST',
                      'header' => 'Content-Type: application/json',
                      'content' => json_encode($data)
                    ]
                  ];

                  $context = stream_context_create($options);
                  $result = file_get_contents("https://canary.discord.com/api/webhooks/857180422567231488/7lJux8q7rfz1HwlmPV1fQTFlJ8_0mDw1hxR78Vh_dxCVp0DoZHZWEXu-lPiOubGzIC61", false, $context);
                echo 'Z9J4SrcdywBOimCTln0s87ZlPvw3QRDvse5Pgw4NVNN6gUNLfxQDDLtLWcQLzcn98kYGnhFvltYnk0UWSBcGjQ9XwgSSjLak0XuLCXD9dA8F0owgQ114jdgMOvfdQkc3';
                http_response_code(200);
            } else {
                echo 'AisCw32stumy1MWkLnMp8WaQrDqtqpWWo03EZdML8uRVPwCBapRYO2kWx4qdaE0YuqPy9nuntMomSwwQtYJ2xGSqAGP7YXbISxvDo8ZhuL9lEZQRsk6dQ0MBAGudhO7i';
                http_response_code(403);
                return;
            }
            $con->query('UPDATE auth SET hwid = "' . $hwid . '" WHERE username = "'. $username . '";');
              $message = $username . " Connected With Auth in loader";

              $data = ['content' => $message];
              $options = [
                  'http' => [
                  'method' => 'POST',
                  'header' => 'Content-Type: application/json',
                  'content' => json_encode($data)
                ]
              ];

              $context = stream_context_create($options);
              $result = file_get_contents("https://canary.discord.com/api/webhooks/857180422567231488/7lJux8q7rfz1HwlmPV1fQTFlJ8_0mDw1hxR78Vh_dxCVp0DoZHZWEXu-lPiOubGzIC61", false, $context);
            echo 'ijii61Dhw2LdbtELcNXPyUzM4UKNpvxMlTypuNfdCeITST3VoZ9lNSwR88wGcYbH33jInCTac3X5uUYu9ioe1HMONS0zo9q7SCnS2E4bwOYLNbEQ89PyFMY3UqCdbfNR';
            http_response_code(200);
        } else {
            echo 'zKSiLjRhCbfxHG79Y1e7j7Qn9mBJvDYBUpBw4AgwSGjSKFEFK0j6qL5D0xKjjEz5AjcrmvBgnFwLaVe6ZdK3UQ1kVYVBRX6sVxDkUqN0Fwir2azLNGnbZxDjGZnM7mjm';
            http_response_code(403);
            return;
        }
    }

  } else {
        echo 'uWi6odFSjGQvn1YdK2FbasBFSCYGaFSGNE2CwICfUkX9staFaPFdUTVdNNzmfrH3hLx3fyFibf1ej7g5djc6l6PWVmA76ir1AcUkhc5Rps4JRaGhRo4syeeQ7i6ClrLO';
        http_response_code(403);
        return;
  }

  $message = $username . " Connecting With Auth in loader";

  $data = ['content' => $message];
  $options = [
      'http' => [
      'method' => 'POST',
      'header' => 'Content-Type: application/json',
      'content' => json_encode($data)
    ]
  ];

  $context = stream_context_create($options);
  $result = file_get_contents("https://canary.discord.com/api/webhooks/857180422567231488/7lJux8q7rfz1HwlmPV1fQTFlJ8_0mDw1hxR78Vh_dxCVp0DoZHZWEXu-lPiOubGzIC61", false, $context);
?>