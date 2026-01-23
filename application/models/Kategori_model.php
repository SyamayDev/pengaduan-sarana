<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori_model extends CI_Model
{

    const TABLE = 'kategori';

    /**
     * Get all kategori
     */
    public function get_all()
    {
        return $this->db->order_by('nama_kategori', 'ASC')->get(self::TABLE)->result();
    }

    /**
     * Get kategori by id
     */
    public function get_by_id($id)
    {
        return $this->db->get_where(self::TABLE, ['id_kategori' => $id])->row();
    }

    /**
     * Insert kategori
     */
    public function insert($data)
    {
        return $this->db->insert(self::TABLE, $data);
    }

    /**
     * Update kategori
     */
    public function update($id, $data)
    {
        return $this->db->where('id_kategori', $id)->update(self::TABLE, $data);
    }

    /**
     * Delete kategori
     */
    public function delete($id)
    {
        return $this->db->where('id_kategori', $id)->delete(self::TABLE);
    }
}
