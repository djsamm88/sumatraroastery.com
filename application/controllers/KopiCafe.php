<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KopiCafe extends CI_Controller {
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
		$this->load->model('m_kopiCafe');
		$this->load->model('m_jenis_kopi');
		$this->load->model('m_barang');
		
	}


	

	public function roasting_cafe()
	{
		$data['data_kopi'] = $this->m_jenis_kopi->m_data();	
		$data['stok'] = $this->m_kopiCafe->m_stok_kopi();	
		$this->load->view('roasting_cafe',$data);
	}


	public function pembelian_cafe()
	{
		$data['data_kopi'] = $this->m_jenis_kopi->m_data();	
		$this->load->view('pembelian_cafe',$data);
	}




	public function bubuk_cafe()
	{		
		$data['stok_bubuk'] = $this->m_kopiCafe->m_stok('kopi');
		$this->load->view('stok_bubuk',$data);
	}




	public function laporan_jual_beli_bubuk()
	{
		$tgl_awal = $this->input->get('tgl_awal');
		$tgl_akhir = $this->input->get('tgl_akhir');
		$data['all'] = $this->m_kopiCafe->m_jual_beli_bubuk($tgl_awal,$tgl_akhir);		
		$data['tgl_awal'] = $tgl_awal;
		$data['tgl_akhir'] = $tgl_akhir;
		$data['stok_bubuk'] = $this->m_kopiCafe->m_stok('kopi');
		$this->load->view('laporan_jual_beli_bubuk',$data);
	}



	public function laporan_jual_beli_bubuk_xl()
	{
		$file="laporan_stok.xls";
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=$file");
		header("Pragma: no-cache");
		header("Expires: 0");	
		$tgl_awal = $this->input->get('tgl_awal');
		$tgl_akhir = $this->input->get('tgl_akhir');
		$data['all'] = $this->m_kopiCafe->m_jual_beli_bubuk($tgl_awal,$tgl_akhir);		
		$data['tgl_awal'] = $tgl_awal;
		$data['tgl_akhir'] = $tgl_akhir;
		$data['stok_bubuk'] = $this->m_kopiCafe->m_stok('kopi');
		$this->load->view('laporan_jual_beli_bubuk_xl',$data);

	}



	public function simpan_stok_masuk()
	{
		$data['url_bukti'] 	= upload_file('bukti_pembayaran');
		$serialize = $this->input->post();		
		$serialize['group_trx'] = date('Ymdhis')."_".$this->session->userdata('id_admin');
		$serialize['url_bukti'] = $data['url_bukti'];
		


		
		for ($i=0; $i < count($serialize['id']); $i++) { 
			$qty 	= hanya_nomor($serialize['qty'][$i]);
			$id 	= $serialize['id'][$i];
			$group_trx = $serialize['group_trx'];
			$url_bukti = $serialize['url_bukti'];
			$keterangan = $serialize['keterangan'];
			

			if($qty>0)
			{
				$this->db->query("INSERT INTO kopi_trx 
									SET 
									id_barang='$id',
									kategori_trx='masuk', 													
									qty='$qty',
									kode_trx='$group_trx',
									bukti='$url_bukti',
									keterangan='$keterangan'

							");
	
			}
			

		}

		echo $serialize['group_trx'];
	}




	public function simpan_kasir_beli()
	{
		$data = $this->input->post();
		//var_dump($data);		
		
		$trx['kode_trx']	= date('ymdhis')."_".$this->session->userdata('id_admin');
		
		for ($i=0; $i <count($data['id_kopi']) ; $i++) { 
			if(hanya_nomor($data['berat'][$i])>0)
			{
				$trx['berat'] = hanya_nomor($data['berat'][$i]);
				$trx['id_kopi'] = $data['id_kopi'][$i];
				$trx['harga']	= hanya_nomor($data['harga_beli'][$i])*hanya_nomor($data['berat'][$i]);
				$trx['nama']  	= $data['nama'];
				$trx['hp']  	= $data['hp'];
				$trx['keterangan']  = $data['keterangan']." - ".date('Y-m-d H:i:s');				
				$trx['kategori_trx']='masuk';
				$trx['jenis_pembayaran']='utang';

				$this->db->set($trx);
				$this->db->insert('kopi_trx_cafe');
				$id_trx = $this->db->insert_id();


			}
				
		}

		echo $trx['kode_trx'];

		


		die("");

	}



	


	public function simpan_kasir_roasting()
	{
		$data = $this->input->post();
		//var_dump($data);		
		
		$trx['kode_trx']	= date('ymdhis')."_".$this->session->userdata('id_admin');
		
		for ($i=0; $i <count($data['id_kopi']) ; $i++) { 
			if(hanya_nomor($data['berat'][$i])>0)
			{
				$trx['berat'] = hanya_nomor($data['berat'][$i]);
				$trx['id_kopi'] = $data['id_kopi'][$i];				
				$trx['nama']  	= $data['nama'];
				$trx['hp']  	= $data['hp'];
				$trx['keterangan']  = "Roasting - ".$data['keterangan']." - ".date('Y-m-d H:i:s');				
				$trx['kategori_trx']='keluar';
				$trx['jenis_pembayaran']='';

				$this->db->set($trx);
				$this->db->insert('kopi_trx_cafe');
				$id_trx = $this->db->insert_id();


			}
				
		}

		echo $trx['kode_trx'];

		


		die("");

	}



	public function laporan_jual_beli()
	{
		$tgl_awal = $this->input->get('tgl_awal');
		$tgl_akhir = $this->input->get('tgl_akhir');
		$data['all'] = $this->m_kopiCafe->m_jual_beli($tgl_awal,$tgl_akhir);		
		$data['tgl_awal'] = $tgl_awal;
		$data['tgl_akhir'] = $tgl_akhir;
		$data['stok'] = $this->m_kopiCafe->m_stok_kopi();	
		$this->load->view('kopi_cafe_laporan',$data);
	}



	public function laporan_jual_beli_xl()
	{
		$file="laporan_jual_beli.xls";
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=$file");
		header("Pragma: no-cache");
		header("Expires: 0");	
		$tgl_awal = $this->input->get('tgl_awal');
		$tgl_akhir = $this->input->get('tgl_akhir');
		$data['all'] = $this->m_kopiCafe->m_jual_beli($tgl_awal,$tgl_akhir);		
		$data['tgl_awal'] = $tgl_awal;
		$data['tgl_akhir'] = $tgl_akhir;
		$data['stok'] = $this->m_kopiCafe->m_stok_kopi();	
		$this->load->view('laporan_jual_beli_xl',$data);
	}




}
