<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{

    const TABLE = 'admin';

    /**
     * Get admin by username
     */
    public function login($username)
    {
        return $this->db->get_where(self::TABLE, ['username' => $username])->row();
    }

    /**
     * Get admin by id
     */
    public function get_by_id($id)
    {
        return $this->db->get_where(self::TABLE, ['id_admin' => $id])->row();
    }
}
