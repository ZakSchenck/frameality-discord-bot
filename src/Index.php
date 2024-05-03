<?php
require 'vendor/autoload.php';
require 'GetFramesByChar.php';
require 'MessageConstructor.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . './../');
$dotenv->load();

use Discord\Discord;
use Discord\Parts\Channel\Message;

$discord = new Discord([
    'token' => $_ENV['AUTH_TOKEN'], 
]);

$discord->on('message', function (Message $message) use ($discord) {
    try {
        if ($message->author->bot)
            return;

        echo "Received a message from {$message->author->username}: {$message->content}", PHP_EOL;

        if (strpos($message->content, '!frame') === 0) {
            $msg_construct = new MessageConstructor($message->content, $message->author);
            $response = $msg_construct->return_data_str();
            $message->channel->sendMessage($response);
        }
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
        // Optionally log the error or send a message back to the server
    }
});

$discord->run();