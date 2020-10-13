<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran_bulanan_gudang extends CI_Controller {
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
		$this->load->model('M_pengeluaran_bulanan_gudang');
		$this->load->model('m_pembayaran');

	}


	public function data()
	{
		$data['all'] = $this->M_pengeluaran_bulanan_gudang->m_data();	
		$this->load->view('data_pengeluaran_bulanan_gudang',$data);
	}


	public function data_json()
	{
		header('Content-Type: application/json');
		$data['all'] = $this->M_pengeluaran_bulanan_gudang->m_data();	
		echo json_encode($data['all']);
	}

	public function data_json_cari()
	{
		$cari=$this->input->get('cari');
		header('Content-Type: application/json');
		$data['all'] = $this->M_pengeluaran_bulanan_gudang->m_data_cari($cari);	
		echo json_encode($data['all']);
	}


	public function by_id($id)
	{
		header('Content-Type: application/json');
		$data['all'] = $this->M_pengeluaran_bulanan_gudang->m_by_id($id);
		echo json_encode($data['all']);
	}



	public function trx_pengeluaran_bulanan_gudang()
	{
		$tgl_awal 	= $this->input->get('tgl_awal');
		$tgl_akhir 	= $this->input->get('tgl_akhir');
		$jenis 		= $this->input->get('jenis');
		$data['tgl_awal']=$tgl_awal;
		$data['tgl_akhir']=$tgl_akhir;
		$data['jenis']=$jenis;

		$data['all'] = $this->M_pengeluaran_bulanan_gudang->m_trx_pengeluaran_bulanan($tgl_awal,$tgl_akhir,$jenis);	
		$this->load->view('pengeluaran_bulanan_trx_gudang',$data);
	}


	public function Pengeluaran_bulanan_gudang_xl()
	{

		$file="Laporan_pengeluaran.xls";
		
		
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=$file");
		header("Pragma: no-cache");
		header("Expires: 0");	

		$tgl_awal 	= $this->input->get('tgl_awal');
		$tgl_akhir 	= $this->input->get('tgl_akhir');
		$jenis 		= $this->input->get('jenis');
		$data['tgl_awal']=$tgl_awal;
		$data['tgl_akhir']=$tgl_akhir;
		$data['jenis']=$jenis;
		
		$data['all'] = $this->M_pengeluaran_bulanan_gudang->m_trx_pengeluaran_bulanan($tgl_awal,$tgl_akhir,$jenis);	
		$this->load->view('pengeluaran_bulanan_gudang_xl',$data);
	}

	public function form_pengeluaran_bulanan_gudang()
	{
		
		$data['all'] = $this->M_pengeluaran_bulanan_gudang->m_data();
		$this->load->view('form_pengeluaran_bulanan_gudang',$data);
	}

	public function simpan_pengeluaran_bulanan_gudang()
	{
		$data = $this->input->post();
		//var_dump($data);		
		$data['jumlah'] = hanya_nomor($data['jumlah']);
		$data['berat'] 	= hanya_nomor($data['berat']);
		$data['bukti_pembayaran'] 	= upload_file('bukti_pembayaran');

		$this->db->set($data);
		$this->db->insert('tbl_pengeluaran_bulanan_transaksi_gudang');
		$id_trx = $this->db->insert_id();

			$ket = $data['nama_pengeluaran']."- ".$data['keterangan']." : jumlah=".$data['jumlah'];

			/*********** insert ke transaksi **************/	
			$ser_trx = array(
							"id_group"=>"4",							
							"keterangan"=>$ket,
							"jumlah"=>($data['jumlah']),
							"url_bukti"=>$data['bukti_pembayaran']
						);				
			/* untuk id_referensi = id_group/id_table*/
			$ser_trx['id_referensi'] = $id_trx;	
			$this->db->set($ser_trx);
			$this->db->insert('tbl_transaksi_gudang');
			/*********** insert ke transaksi **************/
			

		if($data['nama_pengeluaran']=='Pembelian Kopi')
		{
			$trx['kategori_trx']='keluar';
			$trx['berat']		=$data['berat'];
			$trx['harga']		=$data['jumlah'];
			$trx['bukti']		=$data['bukti_pembayaran'];
			$this->db->set($trx);
			$this->db->insert('gudang_trx');

		}


		die("1");

	}




	public function simpan_form()
	{
		$id = $this->input->post('id');
		
		$serialize = $this->input->post();

		if($id=='')
		{
			
			$this->M_pengeluaran_bulanan_gudang->tambah_data($serialize);
			die('1');
		}else{

			$this->M_pengeluaran_bulanan_gudang->update_data($serialize,$id);
			die('1');			

		}
		

	}

	public function hapus($id)
	{
		$this->M_pengeluaran_bulanan_gudang->m_hapus_data($id);
	}


}
