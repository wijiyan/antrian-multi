<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Antrian_model');
    }

    public function index()
    {
        $tanggal = $this->input->get('tanggal') ?? date('Y-m-d');

        $data['tanggal'] = $tanggal;
        $data['total']   = $this->Antrian_model->total_harian($tanggal);
        $data['loket']   = $this->Antrian_model->per_loket($tanggal);
        $data['jam']     = $this->Antrian_model->jam_pelayanan($tanggal);

        $this->load->view('laporan_harian', $data);
    }
    
    public function grafik()
    {
        $tanggal = $this->input->get('tanggal') ?? date('Y-m-d');

        $data['tanggal'] = $tanggal;
        $data['loket']   = $this->Antrian_model->grafik_loket($tanggal);
        $data['jam']     = $this->Antrian_model->grafik_per_jam($tanggal);

        $this->load->view('laporan_grafik', $data);
    }

}
