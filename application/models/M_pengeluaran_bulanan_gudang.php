<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

	class M_pengeluaran_bulanan_gudang extends CI_Model {
		
		function __construct() {
			parent::__construct();
		
			$this->load->helper('custom_func');
		}



	public function m_data()
	{
		$q = $this->db->query("SELECT * FROM tbl_pengeluaran_bulanan_gudang 							
								ORDER BY id ASC
					");
		return $q->result();
	}

	public function m_data_cari($cari)
	{
		$q = $this->db->query("SELECT * FROM tbl_pengeluaran_bulanan_gudang 							
								WHERE nama_pengeluaran LIKE '%$cari%'
								ORDER BY id ASC
					");
		return $q->result();
	}

	

	public function m_trx_pengeluaran_bulanan($tgl_awal,$tgl_akhir,$jenis)
	{
		if($jenis=="")
		{
			$w_jenis="";
		}else{
			$w_jenis=" AND nama_pengeluaran='$jenis'";
		}

		$q = $this->db->query("SELECT a.*
								FROM `tbl_pengeluaran_bulanan_transaksi_gudang` a 								
								WHERE (tgl_update BETWEEN '$tgl_awal' AND '$tgl_akhir') $w_jenis
								ORDER BY tgl_update DESC
							 ");
		return $q->result();
	}

	


	public function m_by_id($id)
	{
		$q = $this->db->query("SELECT * FROM tbl_pengeluaran_bulanan_gudang WHERE id='$id'");
		return $q->result();
	}


	public function tambah_data($serialize)
	{
		$this->db->set($serialize);
		$this->db->insert('tbl_pengeluaran_bulanan_gudang');
	}


	public function update_data($serialize,$id)
	{
		$this->db->set($serialize);
		$this->db->where('id',$id);
		$this->db->update('tbl_pengeluaran_bulanan_gudang');
	}

	public function m_hapus_data($id)
	{		
		$this->db->where('id',$id);
		$this->db->delete('tbl_pengeluaran_bulanan_gudang');
	}


}