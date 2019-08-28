<?php

// Put your device token here (without spaces):
  $deviceToken = '59ee229ea0741d1fdd5525a32bb9f482e6a94291900ccca0e0f9cb1ec1acf71b';
// Put your private key's passphrase here:
$passphrase = 'mypassphase';
// Put your alert message here:
$message = 'Test iOS 10 Media Attachment Push';

////////////////////////////////////////////////////////////////////////////////

$ctx = stream_context_create();
stream_context_set_option($ctx, 'ssl', 'local_cert', 'ck.pem');
stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
stream_context_set_option($ctx, 'ssl', 'cafile', 'entrust_2048_ca.cer');

// Open a connection to the APNS server
$fp = stream_socket_client(
    'ssl://gateway.sandbox.push.apple.com:2195', $err,
    $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

if (!$fp)
    exit("Failed to connect: $err $errstr" . PHP_EOL);

echo 'Connected to APNS' . PHP_EOL;

// Create the payload body
$body['aps'] = array(
    'alert' => $message,
    'sound' => 'default',
     'mutable-content' => 1,
     'category'=> "pusher"
    );
$body['data'] = array(
    'mediaUrl' => "http://www.alphansotech.com/wp-content/uploads/2015/12/Push-notification-1.jpg",
    'mediaType' => "jpg"
);

// Encode the payload as JSON
$payload = json_encode($body);

// Build the binary notification
$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

// Send it to the server
$result = fwrite($fp, $msg, strlen($msg));

if (!$result)
    echo 'Message not delivered' . PHP_EOL;
else
    echo 'Message successfully delivered' . PHP_EOL;

// Close the connection to the server
fclose($fp);