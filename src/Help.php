<?php

class Help
{
    private $message;
    private $msg_type;
    public function __construct($message)
    {
        $this->message = $message;
    }

    // Reads what type of help the user needs
    private function read_input_type()
    {
        $split_msg = explode(' ', $this->message);
        return $this->msg_type = $split_msg[1];
    }


    // converts frame data json keys to string
    private static function convert_keys_to_str_arr()
    {
        $initialize_data = new ReadData();
        $frame_data = $initialize_data->get_frame_data();

        $keys_string = '';
        $index_count = 0;
        foreach ($frame_data as $key => $value) {
            // Index count is for setting a new line after each 4 elements
            if ($index_count < 3) {
                $keys_string .= $key . ' - ';
                $index_count++;
            } else {
                $keys_string .= $key . "\n";
                $index_count = 0;
            }
        }
        // Remove the trailing space
        $keys_string = rtrim($keys_string);
        return $keys_string;
    }

    // Return messages based on user input
    public function message_returned()
    {
        $this->read_input_type();
        switch ($this->msg_type) {
            case strtolower('help'):
                return "Thanks for reaching out for help commands. DLC characters are not added yet, as this is in beta version.\nI will update data based on patches, but this process take a bit of time.\n\n**Character and button keys:** `!frame keys`\n**For help on command structure:** `!frame struct`\n**DM Report Bugs:** https://twitter.com/D7X_o";
            case strtolower('keys'):
                return "**Available Character Keys:**\n{$this->convert_keys_to_str_arr()}\n\n**Button Hit Type Keys:**\n- **ob:** On Block\n- **oh:** On Hit\n- **ofb:** On Flawless Block\n- **su:** Startup\n**Examples: ashrah-s1-ob, ashrah-122-ofb**";
            case strtolower('su'):
                return "of start up.";
            case strtolower('ofb'):
                return 'of advantage on flawless block.';
            default:
                return "Unknown command... Type `!frame help for assistance`";
        }

    }
}