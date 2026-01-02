<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Display extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Antrian_model');
    }

    public function index()
    {
        $this->load->view('display_tv');
    }

    public function data()
    {
        $aktif = $this->Antrian_model->antrian_aktif();
        $sisa  = $this->Antrian_model->sisa_antrian();

        echo json_encode([
            'aktif' => $aktif ? $aktif->nomor : '-',
            'sisa'  => $sisa
        ]);
    }

    public function audio_next()
    {
        $q = $this->db->where('status','menunggu')
        ->order_by('id','ASC')
        ->limit(1)
        ->get('audio_queue')
        ->row();

        if ($q) {
            $this->db->where('id',$q->id)
            ->update('audio_queue',['status'=>'diputar']);
        }

        echo json_encode($q);
    }
}
