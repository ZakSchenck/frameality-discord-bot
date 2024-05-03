<?php
require_once 'ReadData.php';
class MessageConstructor
{
    private $message;
    private $frame_data;
    private $user;

    function __construct($message, $user)
    {
        $initialize_data = new ReadData();

        $this->message = $message;
        $this->frame_data = $initialize_data->get_frame_data();
        $this->user = $user;

        // Remove the command prefix and trim any leading/trailing whitespace
        $commandPrefix = '!frame';
        $this->message = trim(str_replace($commandPrefix, '', $message));
    }

    // Sets string ender based on the desired button type
    private function output_case_for_btn($btn_type)
    {
        switch ($btn_type) {
            case 'ob':
                return "of advantage on block.";
            case 'oh':
                return "of advantage on hit.";
            case 'su':
                return "of start up.";
            case 'ofb':
                return 'of advantage on flawless block.';
            default:
                return "of unknown type.";
        }
    }

    // Create safe checks if data does not exist
    private function build_data($character, $btn, $type) {
        if (
            isset($this->frame_data->$character) &&
            isset($this->frame_data->$character->$btn) &&
            isset($this->frame_data->$character->$btn->$type)
        ) {
            $frames = $this->frame_data->$character->$btn->$type;
            $output = $this->output_case_for_btn($type);
            $uppercase_character = ucfirst($character);

            return "$this->user, $uppercase_character's $btn is $frames frames $output";
        } else {
            return "Data not found or incorrect keys - Use `!frame help` command for assistance :)
            -- D7X
            ";
        }
    }

    // Check if data exists, then return the data
    public function return_data_str()
    {
        $split_msg = explode('-', $this->message);
        $character = strtolower($split_msg[0]);
        $btn = strtolower($split_msg[1]);
        $type = strtolower($split_msg[2]);

        return $this->build_data($character, $btn, $type);
    }


}