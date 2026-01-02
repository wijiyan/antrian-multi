<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {

    public function reset_antrian()
    {
        // Keamanan sederhana
        if (php_sapi_name() !== 'cli') {
            show_404();
        }

        $this->db->truncate('antrian');
        $this->db->truncate('audio_queue');

        echo "Reset antrian sukses\n";
    }
}