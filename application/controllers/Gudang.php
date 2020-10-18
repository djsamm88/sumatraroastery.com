<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gudang extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');				
		$this->load->helper('custom_func');
		if ($this->session->userdata('id_admin')=="") {
			redirect(base_url().'index.php/login');
		}
		$this->load->helper('text');
		date_default_timezone_set("Asia/jakarta");
		//$this->load->library('datatables');
		$this->load->model('m_gudang');
		$this->load->model('m_jenis_kopi');
		
	}


	public function data()
	{
		$data['all'] = $this->m_gudang->m_data();	
		$this->load->view('data_gudang',$data);
	}


	public function kasir()
	{
		$data['data_kopi'] = $this->m_jenis_kopi->m_data();	
		$this->load->view('kasir_gudang',$data);
	}

	public function by_id($id_gudang)
	{
		header('Content-Type: application/json');
		$data['all'] = $this->m_gudang->m_by_id($id_gudang);
		echo json_encode($data['all']);
	}

	public function simpan()
	{
		$id_gudang = $this->input->post('id_gudang');		
		$serialize = $this->input->post();
		

		if($id_gudang=='')
		{
			$this->m_gudang->insert($serialize);
			die('1');
		}else{

			$this->m_gudang->update($serialize,$id_gudang);
		}

	}

	public function hapus($id_gudang)
	{
		$this->db->query("DELETE FROM tbl_gudang WHERE id_gudang='$id_gudang'");
	}






	public function simpan_kasir()
	{
		$data = $this->input->post();
		//var_dump($data);		
		$trx['bukti'] 		= upload_file('bukti_pembayaran');
		$trx['kode_trx']	= date('ymdhis')."_".$this->session->userdata('id_admin');
		$trx['jenis_pembayaran'] = $data['jenis_pembayaran'];
		for ($i=0; $i <count($data['id_kopi']) ; $i++) { 
			if(hanya_nomor($data['berat'][$i])>0)
			{
				$trx['berat'] = hanya_nomor($data['berat'][$i]);
				$trx['id_kopi'] = $data['id_kopi'][$i];
				$trx['harga']	= hanya_nomor($data['harga_jual'][$i])*hanya_nomor($data['berat'][$i]);
				$trx['nama']  	= $data['nama'];
				$trx['hp']  	= $data['hp'];
				$trx['keterangan']  = $data['keterangan']." - ".date('Y-m-d H:i:s');				
				$trx['kategori_trx']='masuk';

				$this->db->set($trx);
				$this->db->insert('gudang_trx');
				$id_trx = $this->db->insert_id();

				/*********** insert ke transaksi **************/	
				$ser_trx = array(
								"id_group"=>"8",							
								"keterangan"=>$trx['keterangan'],
								"jumlah"=>($trx['harga']),
								"url_bukti"=>$trx['bukti']
							);				
				/* untuk id_referensi = id_group/id_table*/
				$ser_trx['id_referensi'] = $id_trx;	
				$this->db->set($ser_trx);
				$this->db->insert('tbl_transaksi_gudang');
				/*********** insert ke transaksi **************/

				if($trx['jenis_pembayaran']=='utang')
				{
					/*********** insert ke transaksi **************/	
					$ser_trx = array(
									"id_group"=>"18",							
									"keterangan"=>$trx['keterangan'],
									"jumlah"=>($trx['harga']),
									"url_bukti"=>$trx['bukti']
								);				
					/* untuk id_referensi = id_group/id_table*/
					$ser_trx['id_referensi'] = $id_trx;	
					$this->db->set($ser_trx);
					$this->db->insert('tbl_transaksi_gudang');
					/*********** insert ke transaksi **************/					
				}
			}
				
		}

		echo $trx['kode_trx'];

		


		die("1");

	}



}
