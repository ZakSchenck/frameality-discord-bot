<?php

namespace BotLogic;
use Dotenv\Dotenv;

require 'vendor/autoload.php';
require 'src/GetFramesByChar.php';
require 'src/MessageConstructor.php';
require 'src/Help.php';

if (!getenv('IS_HEROKU')) {
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();
}

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
            if (str_contains($message->content, '-')) {
                $msg_construct = new MessageConstructor($message->content, $message->author);
                $response = $msg_construct->return_data_str();
                $message->channel->sendMessage($response);
            } else {
                $help_msg = new Help($message->content);
                $message->channel->sendMessage($help_msg->message_returned());
            }
        }
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
});

$discord->run();