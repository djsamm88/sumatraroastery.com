<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

	class M_jenis_kopi extends CI_Model {
		
		function __construct() {
			parent::__construct();
		
			$this->load->helper('custom_func');
		}




	public function m_data()
	{
		$q = $this->db->query("SELECT a.* FROM jenis_kopi a ");
		return $q->result();
	}


	public function m_by_id($id)
	{
		$q = $this->db->query("SELECT a.*
									FROM jenis_kopi a 
									
									WHERE a.id='$id'
							  ");
		return $q->result();
	}


	public function insert($serialize)
	{
		$this->db->set($serialize);
		$this->db->insert('jenis_kopi');
	}

	public function update($serialize,$id)
	{
		$this->db->set($serialize);
		$this->db->where('id',$id);
		$this->db->update('jenis_kopi');
	}
}