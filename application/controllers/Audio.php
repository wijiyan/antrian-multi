<?php

class Audio extends CI_Controller {

    public function next()
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