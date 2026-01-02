<?php
class Antrian_model extends CI_Model {

    public function get_nomor_terakhir()
    {
        $this->db->select_max('nomor');
        $this->db->where('tanggal', date('Y-m-d'));
        return $this->db->get('antrian')->row()->nomor;
    }

    public function tambah_antrian($nomor)
    {
        return $this->db->insert('antrian', [
            'nomor' => $nomor,
            'tanggal' => date('Y-m-d')
        ]);

    }

    public function panggil_antrian_lama()
    {
        $this->db->where('status', 'menunggu');
        $this->db->order_by('nomor', 'ASC');
        $this->db->limit(1);
        $antrian = $this->db->get('antrian')->row();

        if ($antrian) {
            $this->db->where('id', $antrian->id);
            $this->db->update('antrian', ['status' => 'dipanggil']);
        }

        return $antrian;
    }

    public function panggil_antrian($loket)
    {
        $this->db->where('status', 'menunggu');
        $this->db->order_by('nomor', 'ASC');
        $this->db->limit(1);
        $antrian = $this->db->get('antrian')->row();

        if ($antrian) {
            $this->db->where('id', $antrian->id);
            $this->db->update('antrian', [
                'status' => 'dipanggil',
                'loket'  => $loket
            ]);
        }

        return $antrian;
    }

    public function antrian_aktif()
    {
        return $this->db->where('status','dipanggil')
        ->order_by('id','DESC')
        ->get('antrian')
        ->row();
    }

    public function sisa_antrian()
    {
        return $this->db->where('status','menunggu')
        ->count_all_results('antrian');
    }

    public function antrian_terakhir_loket($loket)
    {
        return $this->db->where('loket', $loket)
        ->where('status', 'dipanggil')
        ->order_by('id', 'DESC')
        ->limit(1)
        ->get('antrian')
        ->row();
    }

    // Total antrian per hari
    public function total_harian($tanggal)
    {
        return $this->db->where('tanggal', $tanggal)
        ->count_all_results('antrian');
    }

// Total per loket
    public function per_loket($tanggal)
    {
        return $this->db->select('loket, COUNT(*) as total')
        ->from('antrian')
        ->where('tanggal', $tanggal)
        ->where('loket IS NOT NULL')
        ->group_by('loket')
        ->get()
        ->result();
    }

// Jam pertama & terakhir
    public function jam_pelayanan($tanggal)
    {
        return $this->db->select('MIN(created_at) as mulai, MAX(created_at) as selesai')
        ->where('tanggal', $tanggal)
        ->get('antrian')
        ->row();
    }

    // Data grafik per loket
    public function grafik_loket($tanggal)
    {
        return $this->db->select('loket, COUNT(*) as total')
        ->from('antrian')
        ->where('tanggal', $tanggal)
        ->where('loket IS NOT NULL')
        ->group_by('loket')
        ->order_by('loket', 'ASC')
        ->get()
        ->result();
    }

// Data grafik per jam
    public function grafik_per_jam($tanggal)
    {
        return $this->db->select('HOUR(created_at) as jam, COUNT(*) as total')
        ->from('antrian')
        ->where('tanggal', $tanggal)
        ->group_by('HOUR(created_at)')
        ->order_by('jam', 'ASC')
        ->get()
        ->result();
    }
}
