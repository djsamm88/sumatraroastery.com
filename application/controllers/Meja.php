<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meja extends CI_Controller {
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
		$this->load->model('m_meja');
		$this->load->model('m_barang');
		
	}


	public function data()
	{
		$data['all'] = $this->m_meja->m_data();	
		$this->load->view('data_meja',$data);
	}

	public function by_id($id_meja)
	{
		header('Content-Type: application/json');
		$data['all'] = $this->m_meja->m_by_id($id_meja);
		echo json_encode($data['all']);
	}

	public function simpan()
	{
		$id_meja = $this->input->post('id_meja');		
		$serialize = $this->input->post();
		

		if($id_meja=='')
		{
			$this->m_meja->insert($serialize);
			die('1');
		}else{

			$this->m_meja->update($serialize,$id_meja);
		}

	}

	public function hapus($id_meja)
	{
		$this->db->query("DELETE FROM tbl_meja WHERE id_meja='$id_meja'");
	}


	public function form_penjualan()
	{
		$data['all_meja'] = $this->m_meja->m_data_aktif();
		
		$this->load->view('form_penjualan_barang',$data);
	}

	public function pindah_meja($id)
	{
		$data['all_meja'] = $this->m_meja->m_data_aktif();
		$data['id']=$id;
		$this->load->view('pindah_meja',$data);
	}

	public function go_pindah_meja()
	{
		$serialize = $this->input->post();		
		$id_meja = $serialize['id_meja'];
		$id_meja_lama = $serialize['id_meja_lama'];

		$this->db->query("UPDATE trx_meja SET id_meja='$id_meja' WHERE id_meja='$id_meja_lama' AND status=0");
	}

	public function buku_menu($id)
	{
		$data['menu_menu'] = $this->m_barang->m_data('menu');	
		$data['menu_kopi'] = $this->m_barang->m_data('kopi');	
		$data['menu_titipan'] = $this->m_barang->m_data('titipan');	
		$data['menu_roasting'] = $this->m_barang->m_data('roasting');	
		$data['id']=$id;
		$this->load->view('buku_menu',$data);

	}


	public function detail_pesanan($id)
	{
		$data['all'] = $this->m_meja->detail_pesanan($id);				
		$data['id']=$id;
		$this->load->view('detail_pesanan',$data);
	}



	public function penjualan()
	{
		$data['tgl_awal'] = $this->input->get('tgl_awal');
		$data['tgl_akhir'] = $this->input->get('tgl_akhir');
		$data['all'] = $this->m_meja->all_trx($data['tgl_awal'],$data['tgl_akhir']);
		$this->load->view('lap_penjualan',$data);
	}


	public function penjualan_xl()
	{
		$file="Laporan_penjualan.xls";
		
		
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=$file");
		header("Pragma: no-cache");
		header("Expires: 0");	

		$data['tgl_awal'] = $this->input->get('tgl_awal');
		$data['tgl_akhir'] = $this->input->get('tgl_akhir');
		$data['all'] = $this->m_meja->all_trx($data['tgl_awal'],$data['tgl_akhir']);
		$this->load->view('lap_penjualan_xl',$data);
	}


	public function order()
	{
		$serialize = $this->input->post();
		$serialize['id_admin'] = $this->session->userdata('id_admin');
		$this->m_meja->insert_trx($serialize);
		
	}


	public function simpan_pembayaran()
	{
		$data['url_bukti'] 	= upload_file('bukti_pembayaran');
		$serialize = $this->input->post();		
		$serialize['group_trx'] = date('Ymdhis')."_".$serialize['id_meja'];
		$serialize['url_bukti'] = $data['url_bukti'];
		$group_trx = $this->m_meja->update_status($serialize);

		
		$data['id_group']	=8;
		$data['keterangan'] = "Pemayaran [".$serialize['jenis_pembayaran']."] id meja ".$serialize['id_meja']." pada tgl ".date('Y-m-d H:i:s');
		$data['jumlah'] 	= $serialize['total'];
		$data['id_referensi'] = $serialize['id_meja'];

		$this->db->set($data);
		$this->db->insert('tbl_transaksi');

		echo $serialize['group_trx'];
	}




	public function struk_penjualan($group_trx)
	{
		
		
		
		$trx['data'] = $this->m_meja->trx_by_group($group_trx);

		//var_dump($staff_arr);
		$filename = "slip_penjualan_".$this->router->fetch_class()."_".$group_trx;
		
		// As PDF creation takes a bit of memory, we're saving the created file in /downloads/reports/
		$pdfFilePath = FCPATH."/downloads/$filename.pdf";
		
		 $html = $this->load->view('struk.php',$trx);
    
    	//echo json_encode($data);
    	//$this->load->view('template/part/laporan_pdf.php',$data);
    	
    	/*
		if (file_exists($pdfFilePath) == FALSE)
		{
			//ini_set('memory_limit','512M'); // boost the memory limit if it's low <img class="emoji" draggable="false" alt="" src="https://s.w.org/images/core/emoji/72x72/1f609.png">
        	ini_set('memory_limit', '2048M');
			//$html = $this->load->view('laporan_mpdf/pdf_report', $data, true); // render the view into HTML
			$html = $this->load->view('slip_pembayaran.php',$data,true);
			
			$this->load->library('pdf_potrait'); 
			$pdf = $this->pdf_potrait->load();
			//$this->load->library('pdf');
			//$pdf = $this->pdf->load();

			$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date("YmdHis")."_".$this->session->userdata('id_admin')); // Add a footer for good measure <img class="emoji" draggable="false" alt="" src="https://s.w.org/images/core/emoji/72x72/1f609.png">
			$pdf->WriteHTML($html); // write the HTML into the PDF
			$pdf->Output($pdfFilePath, 'F'); // save to file because we can
		}
		 
		redirect(base_url()."downloads/$filename.pdf","refresh");
		*/
		
		
	}



}
