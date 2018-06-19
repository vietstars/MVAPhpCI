<?php
class home_model extends CI_Model {
    public function __construct()
    {
        $this->load->database();
    }
    public function get_user($slug = FALSE)
	{
        if ($slug === FALSE)
        {
            $this->db->cache_on();
            $query = $this->db->get('user');
            $this->db->cache_off();
            return $query->result_array();exit;
        }
        $this->db->cache_on();
        $query = $this->db->get_where('user', array('id' => $slug));
        $this->db->cache_off();
        return $query->row_array();exit;
	}
}