<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aspirasi_model extends CI_Model
{

    const TABLE = 'aspirasi';

    /**
     * Get all aspirasi with join
     */
    public function get_all($limit = NULL)
    {
        $this->db->select('aspirasi.*, siswa.kelas, kategori.nama_kategori');
        $this->db->join('siswa', 'aspirasi.nis = siswa.nis', 'left');
        $this->db->join('kategori', 'aspirasi.id_kategori = kategori.id_kategori', 'left');
        $this->db->order_by('aspirasi.tanggal', 'DESC');

        if ($limit) {
            $this->db->limit($limit);
        }

        return $this->db->get(self::TABLE)->result();
    }

    /**
     * Get aspirasi by NIS
     */
    public function get_by_nis($nis)
    {
        $this->db->select('aspirasi.*, siswa.kelas, kategori.nama_kategori');
        $this->db->join('siswa', 'aspirasi.nis = siswa.nis', 'left');
        $this->db->join('kategori', 'aspirasi.id_kategori = kategori.id_kategori', 'left');
        $this->db->where('aspirasi.nis', $nis);
        $this->db->order_by('aspirasi.tanggal', 'DESC');

        return $this->db->get(self::TABLE)->result();
    }

    /**
     * Get aspirasi by ID
     */
    public function get_by_id($id)
    {
        $this->db->select('aspirasi.*, siswa.kelas, kategori.nama_kategori');
        $this->db->join('siswa', 'aspirasi.nis = siswa.nis', 'left');
        $this->db->join('kategori', 'aspirasi.id_kategori = kategori.id_kategori', 'left');
        $this->db->where('aspirasi.id_aspirasi', $id);

        return $this->db->get(self::TABLE)->row();
    }

    /**
     * Get aspirasi by status
     */
    public function get_by_status($status)
    {
        $this->db->select('aspirasi.*, siswa.kelas, kategori.nama_kategori');
        $this->db->join('siswa', 'aspirasi.nis = siswa.nis', 'left');
        $this->db->join('kategori', 'aspirasi.id_kategori = kategori.id_kategori', 'left');
        $this->db->where('aspirasi.status', $status);
        $this->db->order_by('aspirasi.tanggal', 'DESC');

        return $this->db->get(self::TABLE)->result();
    }

    /**
     * Count total aspirasi
     */
    public function count_all()
    {
        return $this->db->count_all(self::TABLE);
    }

    /**
     * Count aspirasi by status
     */
    public function count_by_status($status)
    {
        return $this->db->where('status', $status)->count_all_results(self::TABLE);
    }

    /**
     * Insert aspirasi
     */
    public function insert($data)
    {
        return $this->db->insert(self::TABLE, $data);
    }

    /**
     * Update aspirasi
     */
    public function update($id, $data)
    {
        return $this->db->where('id_aspirasi', $id)->update(self::TABLE, $data);
    }

    /**
     * Delete aspirasi
     */
    public function delete($id)
    {
        return $this->db->where('id_aspirasi', $id)->delete(self::TABLE);
    }
}
