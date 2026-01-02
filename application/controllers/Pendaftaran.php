<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Antrian_model');
    }

    public function index()
    {
        $this->load->view('pendaftaran');
    }

    // public function ambil()
    // {
    //     $last = $this->Antrian_model->get_nomor_terakhir();
    //     $nomor = ($last) ? $last + 1 : 1;

    //     $this->Antrian_model->tambah_antrian($nomor);

    //     echo json_encode([
    //         'status' => true,
    //         'nomor'  => $nomor
    //     ]);
    // }

    public function cetak($kode, $nomor)
    {
        $data['kode']  = $kode;
        $data['nomor'] = $nomor;

        $this->load->view('cetak_antrian', $data);
    }

    public function ambil($kode)
    {
        $today = date('Y-m-d');

    // nomor terakhir per kode per hari
        $last = $this->db->where([
            'kode' => $kode,
            'tanggal' => $today
        ])->order_by('nomor','DESC')->get('antrian')->row();

        $nomor = $last ? $last->nomor + 1 : 1;

        $this->db->insert('antrian', [
            'kode' => $kode,
            'nomor' => $nomor,
            'tanggal' => $today
        ]);

        echo json_encode([
            'status' => true,
            'kode' => $kode,
            'nomor' => str_pad($nomor, 3, '0', STR_PAD_LEFT)
        ]);
    }


}
