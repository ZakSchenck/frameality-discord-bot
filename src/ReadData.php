<?php
namespace BotLogic;
class ReadData {
    private $frame_data_to_obj;

    function __construct() {
        // Get file contents from JSON file
        $frame_data_str = file_get_contents(__DIR__ . '/../framedata.json');
        $this->frame_data_to_obj = json_decode($frame_data_str);
    }

    // Getter for frame data object
    public function get_frame_data() {
        return $this->frame_data_to_obj;
    }
}