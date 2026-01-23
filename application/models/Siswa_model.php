<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa_model extends CI_Model
{

    const TABLE = 'siswa';

    /**
     * Get all siswa
     */
    public function get_all()
    {
        return $this->db->get(self::TABLE)->result();
    }

    /**
     * Get siswa by NIS
     */
    public function get_by_nis($nis)
    {
        return $this->db->get_where(self::TABLE, ['nis' => $nis])->row();
    }

    /**
     * Get siswa by NIS and Class
     */
    public function get_by_nis_and_class($nis, $kelas)
    {
        return $this->db->get_where(self::TABLE, ['nis' => $nis, 'kelas' => $kelas])->row();
    }

    /**
     * Insert siswa
     */
    public function insert($data)
    {
        return $this->db->insert(self::TABLE, $data);
    }

    /**
     * Update siswa
     */
    public function update($nis, $data)
    {
        return $this->db->where('nis', $nis)->update(self::TABLE, $data);
    }

    /**
     * Delete siswa
     */
    public function delete($nis)
    {
        return $this->db->where('nis', $nis)->delete(self::TABLE);
    }
}
