<?php

namespace BotLogic;
require_once 'ReadData.php';

class GetFramesByChar {
    private $read_data;

    function __construct() {
        $this->read_data = new ReadData();
    }

    // Getter function for returning all frame data by character
    public function get_frame_data_by_character($character, $button) {
        $all_frame_data = $this->read_data->get_frame_data();

        if (isset($all_frame_data->$character->$button)) {
            return $all_frame_data->$character->$button;
        } else {
            return "Could not find button data";
        }
    }
}