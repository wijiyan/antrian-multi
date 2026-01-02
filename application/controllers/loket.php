<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loket extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /* ===============================
       HALAMAN PILIH LOKET
    =============================== */
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

    /* ===============================
       HALAMAN LOKET TERTENTU
       contoh: /loket/buka/1
    =============================== */
    public function buka($loket)
    {
        $data['loket'] = (int)$loket;
        $this->load->view('loket', $data);
    }

    /* ===============================
       PANGGIL ANTRIAN (AJAX)
    =============================== */
    public function panggil()
    {
        $input = json_decode(file_get_contents("php://input"), true);

        $loket = (int)$input['loket'];
        $kode  = $input['kode'];
        $today = date('Y-m-d');

        // Ambil antrian terlama sesuai kode
        $antrian = $this->db
            ->where([
                'kode'    => $kode,
                'tanggal' => $today,
                'status'  => 'menunggu'
            ])
            ->order_by('nomor', 'ASC')
            ->get('antrian')
            ->row();

        if (!$antrian) {
            echo json_encode([
                'status'  => false,
                'message' => "Tidak ada antrian kode $kode"
            ]);
            return;
        }

        // Update status antrian
        $this->db->where('id', $antrian->id)
                 ->update('antrian', [
                     'status' => 'dipanggil',
                     'loket'  => $loket
                 ]);

        // Masukkan ke audio_queue
        $this->db->insert('audio_queue', [
            'kode'  => $kode,
            'nomor' => $antrian->nomor,
            'loket' => $loket
        ]);

        echo json_encode([
            'status' => true,
            'kode'   => $kode,
            'nomor'  => $antrian->nomor
        ]);
    }

    /* ===============================
       PANGGIL ULANG
    =============================== */
    public function ulang()
    {
        $input = json_decode(file_get_contents("php://input"), true);

        $loket = (int)$input['loket'];
        $kode  = $input['kode'];

        // Ambil terakhir dipanggil di loket ini
        $antrian = $this->db
            ->where([
                'loket'  => $loket,
                'kode'   => $kode,
                'status' => 'dipanggil'
            ])
            ->order_by('id', 'DESC')
            ->get('antrian')
            ->row();

        if (!$antrian) {
            echo json_encode([
                'status'  => false,
                'message' => 'Belum ada antrian dipanggil'
            ]);
            return;
        }

        // Masukkan ulang ke audio_queue
        $this->db->insert('audio_queue', [
            'kode'  => $kode,
            'nomor' => $antrian->nomor,
            'loket' => $loket
        ]);

        echo json_encode([
            'status' => true,
            'kode'   => $kode,
            'nomor'  => $antrian->nomor
        ]);
    }
}
