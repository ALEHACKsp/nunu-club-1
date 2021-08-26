<?php
date_default_timezone_set('Europe/Warsaw');

    $con = mysqli_connect("127.0.0.1","Admin","4kHsO4xvCk4AeVWgRulfNPexfFSehqeY","Authorization"); 

    $hwid = htmlspecialchars($_GET["hwid"]);

  $auth_connection = $con->query("SELECT * FROM testauth WHERE hwid = '" . $hwid . "';");

  $row = mysqli_fetch_array($auth_connection);

  if (mysqli_num_rows($auth_connection) > 0) {
        $date = date_create();
        $date_expire = date_create($row['expire_date']);
        if (date_timestamp_get($date_expire) > date_timestamp_get($date)) {
            echo 'OK';
            http_response_code(200);
        } else {
            echo 'expired';
            http_response_code(403);
            return;
        }
  } else {
        echo 'Bad Hwid';
        http_response_code(403);
        return;
  }

  $message = $hwid . " Connecting With Auth in loader";

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