<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

	class M_meja extends CI_Model {
		
		function __construct() {
			parent::__construct();
		
			$this->load->helper('custom_func');
		}




	public function m_data()
	{
		$q = $this->db->query("SELECT a.* FROM tbl_meja a ");
		return $q->result();
	}


	public function m_data_aktif()
	{
		$q = $this->db->query("
							SELECT a.*, IFNULL(b.ada_pesanan,0) AS ada_pesanan
								FROM tbl_meja a
								LEFT JOIN 
								(
									SELECT a.* FROM 
								    (
								        SELECT id_meja, SUM(qty) AS ada_pesanan 
								        FROM `trx_meja` 
								        WHERE status=0
								        GROUP BY id_meja
								    )a 
								    WHERE a.ada_pesanan >0
								)b
								ON a.id_meja=b.id_meja
			");
		return $q->result();
	}

	public function detail_pesanan($id)
	{
		$q = $this->db->query("

							SELECT a.*,b.* FROM 
							(
								SELECT id,id_meja,id_barang, SUM(qty) AS qty, status FROM `trx_meja` WHERE status=0 AND id_meja='$id' GROUP BY id_barang
							)a
							LEFT JOIN tbl_barang b ON a.id_barang=b.id

							");
		return $q->result();
	}


	public function all_trx($awal,$akhir)
	{
		

		$q = $this->db->query("

							SELECT a.*,b.nama_admin,SUM(harga_pokok*qty) AS total FROM 
							(
								SELECT id,id_meja,id_admin,tgl_trx,group_trx,harga_pokok, SUM(qty) AS qty, status, url_bukti FROM `trx_meja` 
								WHERE 
								(tgl_trx BETWEEN '$awal' AND '$akhir') 
								 AND status=1 
								GROUP BY id_meja,id_barang,group_trx

							)a
							LEFT JOIN tbl_admin b ON a.id_admin=b.id_admin
							GROUP BY a.group_trx 
							ORDER BY a.id DESC
							");

		
				

		return $q->result();
	}




	public function all_trx_titipan($awal,$akhir)
	{
		
		
		$q = $this->db->query("

							SELECT a.id_barang,a.harga_pokok,b.nama_barang,b.kategori, 
									SUM(qty) AS qty, 
									SUM(a.qty*a.harga_pokok) AS total 
								FROM `trx_meja` a 
								LEFT JOIN tbl_barang b ON a.id_barang=b.id 
								WHERE b.kategori='titipan' AND (tgl_trx BETWEEN '$awal' AND '$akhir') 
								GROUP BY id_barang
							");


		return $q->result();
	}



	public function all_trx_roasting($awal,$akhir)
	{
		
		
		$q = $this->db->query("

							SELECT a.id_barang,a.harga_pokok,b.nama_barang,b.kategori, 
									SUM(b.berat) AS berat, 
									SUM(qty) AS qty, 
									SUM(a.qty*a.harga_pokok) AS total 
								FROM `trx_meja` a 
								LEFT JOIN tbl_barang b ON a.id_barang=b.id 
								WHERE b.kategori='roasting' AND (tgl_trx BETWEEN '$awal' AND '$akhir') 
								GROUP BY id_barang
							");


		return $q->result();
	}


	public function m_all_kopi()
	{
		
		
		$q = $this->db->query("
								SELECT * FROM tbl_barang WHERE kategori='kopi'
							");


		return $q->result();
	}



	


	public function trx_by_group($group_trx)
	{
		$q = $this->db->query("

							SELECT a.*,b.nama_barang,b.berat,c.nama_admin 
							FROM 
							(
								SELECT id,id_meja,id_barang,id_admin,tgl_trx,group_trx,harga_pokok, SUM(qty) AS qty, status FROM `trx_meja` WHERE group_trx='$group_trx' GROUP BY id_barang
							)a
							LEFT JOIN tbl_barang b ON a.id_barang=b.id
							LEFT JOIN tbl_admin c ON a.id_admin=c.id_admin

							");
		return $q->result();
	}
	


	public function m_by_id($id_meja)
	{
		$q = $this->db->query("SELECT a.*
									FROM tbl_meja a 
									
									WHERE a.id_meja='$id_meja'
							  ");
		return $q->result();
	}


	public function insert($serialize)
	{
		$this->db->set($serialize);
		$this->db->insert('tbl_meja');
	}

	public function update($serialize,$id_meja)
	{
		$this->db->set($serialize);
		$this->db->where('id_meja',$id_meja);
		$this->db->update('tbl_meja');
	}



	public function insert_trx($serialize)
	{
		$this->db->set($serialize);
		$this->db->insert('trx_meja');
	}
	

	public function update_status($serialize)
	{
		$id_meja = $serialize['id_meja'];
		$jenis_pembayaran = $serialize['jenis_pembayaran'];
		$group_trx = $serialize['group_trx'];
		$url_bukti = $serialize['url_bukti'];

		$this->db->query("UPDATE trx_meja SET 
							status='1',
							group_trx='$group_trx',
							jenis_pembayaran='$jenis_pembayaran', 
							url_bukti='$url_bukti' 
						WHERE id_meja='$id_meja' AND status=0");
		return $group_trx;


	}
	
}