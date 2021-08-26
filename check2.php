<?php
date_default_timezone_set('Europe/Warsaw');

    $con = mysqli_connect("127.0.0.1","Admin","4kHsO4xvCk4AeVWgRulfNPexfFSehqeY","Authorization"); 

    $hwid = htmlspecialchars($_GET["hwid"]);
    $token = htmlspecialchars($_GET["token"]);

    if ($token !== "MnGgcFCjjn7gx3H4JsaouGq9Dsq2JTgbFl5T6kkxD2TKHYkByCbzbfjDldJBtljb") {
        echo 'krDKQdLZJlTobcXRHdnic5t4ISFRTlXJezWFHkidRRxQ16BYSZ3SvytqUCCfX5pR';
        http_response_code(403);
        return;
    }

    if ($_SERVER['HTTP_USER_AGENT'] !== "xAYdZ0jPktvwRLqVGKLFYT69ZPhBz3QrXEoFOupPsBfyIJbVBKR7as7v1J26WvwQB1mSq3nZSlExfRT4BgwnXTeDOwoJSC6MldwuOF7XDvEA0D5sUgnnPGJqHdHMGoqO") {
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

  $auth_connection = $con->query("SELECT expire, username, hwid FROM auth WHERE hwid = '". $hwid . "';");

  $row = mysqli_fetch_array($auth_connection);

  if (mysqli_num_rows($auth_connection) > 0) {
    $update_ip = $con->query("UPDATE auth SET ip = '" . $_SERVER['REMOTE_ADDR'] . "' WHERE hwid = '". $hwid . "';");

    if ($hwid === $row['hwid']) {
        $date = date_create();
        $date_expire = date_create($row['expire']);
        if (date_timestamp_get($date_expire) > date_timestamp_get($date)) {
            $update_inject_time = $con->query("UPDATE auth SET LastInject = DATE_ADD(NOW(), INTERVAL 0 day) WHERE hwid = '". $hwid . "';");

            echo $row['username'];
              $message = $row['username'] . " Connected With Auth in dll";

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
            http_response_code(200);
        } else {
            echo 'AisCw32stumy1MWkLnMp8WaQrDqtqpWWo03EZdML8uRVPwCBapRYO2kWx4qdaE0YuqPy9nuntMomSwwQtYJ2xGSqAGP7YXbISxvDo8ZhuL9lEZQRsk6dQ0MBAGudhO7i';
            http_response_code(403);
            return;
        }
    }

  } else {
        echo 'uWi6odFSjGQvn1YdK2FbasBFSCYGaFSGNE2CwICfUkX9staFaPFdUTVdNNzmfrH3hLx3fyFibf1ej7g5djc6l6PWVmA76ir1AcUkhc5Rps4JRaGhRo4syeeQ7i6ClrLO';
        http_response_code(403);
        return;
  }
?>