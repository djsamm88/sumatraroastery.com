<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

	class M_gudang extends CI_Model {
		
		function __construct() {
			parent::__construct();
		
			$this->load->helper('custom_func');
		}


	public function m_jual_beli($tgl_awal,$tgl_akhir)
	{
		$q = $this->db->query("
				SELECT kode_trx,nama,hp,bukti,kategori_trx,jenis_pembayaran, 
					SUM(berat) AS berat,
					SUM(harga) AS harga, 
					tgl_trx 
				FROM `gudang_trx` 

				WHERE (tgl_trx BETWEEN '$tgl_awal' AND '$tgl_akhir')
				GROUP BY kode_trx 
				
				ORDER BY tgl_trx DESC

			");

		return $q->result();
	}

	public function m_struk_jual_beli($kode_trx)
	{
		$q = $this->db->query("
				SELECT a.*,b.nama_kopi
				FROM `gudang_trx` a 
				LEFT JOIN jenis_kopi b ON a.id_kopi=b.id
				WHERE kode_trx='$kode_trx'				
			");

		return $q->result();
	}

	public function m_stok_kopi()
	{
		$q = $this->db->query("
						SELECT 
						a.*,
						IFNULL(SUM(b.dibeli),0) AS dibeli,
						IFNULL(SUM(b.dijual),0) AS dijual
						FROM jenis_kopi a
						LEFT JOIN (
							SELECT 
							b.id_kopi,
							CASE WHEN b.kategori_trx='masuk' THEN berat  END AS dibeli,
							CASE WHEN b.kategori_trx='keluar' THEN berat  END AS dijual
							FROM  (
								SELECT id_kopi, SUM(berat) AS berat,kategori_trx 
								FROM `gudang_trx` 
								
								GROUP BY kategori_trx,id_kopi
							)b
						)b ON a.id=b.id_kopi						
						GROUP BY b.id_kopi	
						");
		return $q->result();
	}



	public function m_data()
	{
		$q = $this->db->query("SELECT a.* FROM tbl_gudang a ");
		return $q->result();
	}


	public function m_by_id($id_gudang)
	{
		$q = $this->db->query("SELECT a.*
									FROM tbl_gudang a 
									
									WHERE a.id_gudang='$id_gudang'
							  ");
		return $q->result();
	}


	public function insert($serialize)
	{
		$this->db->set($serialize);
		$this->db->insert('tbl_gudang');
	}

	public function update($serialize,$id_gudang)
	{
		$this->db->set($serialize);
		$this->db->where('id_gudang',$id_gudang);
		$this->db->update('tbl_gudang');
	}
}