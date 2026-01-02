<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loket extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Antrian_model');
        $this->load->database();
    }

    /**
     * Halaman loket
     * contoh akses:
     * /loket/index/1
     * /loket/index/2
     * /loket/index/3
     */
    public function index($loket = null)
    {
        if ($loket === null) {
        // halaman pilih loket
            $this->load->view('loket_pilih');
        } else {
        // halaman loket aktif
            $data['loket'] = (int)$loket;
            $this->load->view('loket', $data);
        }
    }

    /**
     * Panggil antrian baru (masuk audio queue)
     */
    public function panggil($loket)
    {
        $loket = (int)$loket;

        $antrian = $this->Antrian_model->panggil_antrian($loket);

        if ($antrian) {
            // Masukkan ke audio queue (untuk Display TV)
            $this->db->insert('audio_queue', [
                'nomor' => $antrian->nomor,
                'loket' => $loket
            ]);
        }

        echo json_encode([
            'status' => $antrian ? true : false,
            'nomor'  => $antrian ? $antrian->nomor : null,
            'loket'  => $loket
        ]);
    }

    /**
     * Panggil ulang antrian terakhir di loket ini
     */
    public function ulang($loket)
    {
        $loket = (int)$loket;

        $antrian = $this->Antrian_model->antrian_terakhir_loket($loket);

        if ($antrian) {
            // Masukkan ulang ke audio queue
            $this->db->insert('audio_queue', [
                'nomor' => $antrian->nomor,
                'loket' => $loket
            ]);
        }

        echo json_encode([
            'status' => $antrian ? true : false,
            'nomor'  => $antrian ? $antrian->nomor : null,
            'loket'  => $loket
        ]);
    }
}
