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
		$this->load->model('m_jenis_kopi');
		
	}



	public function kasir_agen()
	{
		$data['data_kopi'] = $this->m_meja->m_all_kopi();	
		$this->load->view('kasir_agen',$data);
	}


	public function batal_meja($id_meja)
	{
		$this->db->query("DELETE FROM trx_meja WHERE id_meja=$id_meja");
	}


	public function kasir_member()
	{
		$data['data_kopi'] = $this->m_meja->m_all_kopi();	
		$this->load->view('kasir_member',$data);
	}




	public function simpan_kasir_agen()
	{
		$data = $this->input->post();
		//var_dump($data);		
		$trx['bukti'] 		= upload_file('bukti_pembayaran');
		$trx['kode_trx']	= date('ymdhis')."_".$this->session->userdata('id_admin');
		$trx['jenis_pembayaran'] = $data['jenis_pembayaran'];
		

		for ($i=0; $i <count($data['id_barang']) ; $i++) { 
			if(hanya_nomor($data['qty'][$i])>0)
			{
				$trx['berat'] = hanya_nomor($data['berat'][$i]);
				$trx['qty'] = hanya_nomor($data['qty'][$i]);
				$trx['id_barang'] = $data['id_barang'][$i];
				$trx['harga']	= hanya_nomor($data['harga_agen'][$i]);
				$trx['nama']  	= $data['nama'];
				$trx['hp']  	= $data['hp'];
				$trx['keterangan']  = "Kasir Agen -  ".$data['keterangan']." - ".date('Y-m-d H:i:s');				
				$trx['kategori_trx']='keluar';
				$trx['diskon'] = hanya_nomor($data['diskon']);

				$this->db->set($trx);
				$this->db->insert('kopi_trx');
				$id_trx = $this->db->insert_id();

				/*********** insert ke transaksi **************/	

				$ser_trx = array(
								"id_group"=>"19",							
								"keterangan"	=>"[".$trx['jenis_pembayaran']."] - kpd : ".$data['nama']." - ". $trx['keterangan'],
								"jumlah"		=>($trx['harga']*$data['qty'][$i]),
								"url_bukti"=>$trx['bukti'],
								"kategori"=>"bubuk",
								"jenis_pembayaran"=>$trx['jenis_pembayaran']
							);				
				/* untuk id_referensi = id_group/id_table*/
				$ser_trx['id_referensi'] = $id_trx;	
				$this->db->set($ser_trx);
				$this->db->insert('tbl_transaksi');
				/*********** insert ke transaksi **************/

				if($trx['jenis_pembayaran']=='utang')
				{
					/*********** insert ke transaksi **************/	
					$ser_trx = array(
									"id_group"=>"18",							
									"keterangan"=>"Qty: ".$data['qty'][$i] ." - Harga:  ".rupiah($data['harga_agen'][$i])."@ - kpd : ".$data['nama']." - ". $trx['keterangan'],
									"jumlah" =>($trx['harga']*$data['qty'][$i]),
									"url_bukti"=>$trx['bukti']
								);				
					/* untuk id_referensi = id_group/id_table*/
					$ser_trx['id_referensi'] = $id_trx;	
					$this->db->set($ser_trx);
					$this->db->insert('tbl_transaksi');
					/*********** insert ke transaksi **************/					
				}
			}
				
		}

		echo $trx['kode_trx'];


		
		/* diskon */
		$ser_disk['diskon'] = hanya_nomor($data['diskon']);
		$ser_disk = array(
									"id_group"=>"9",							
									"keterangan"=>"Diskon Kpd: ".$data['nama']."-".$data['hp']." - Trx:".$trx['kode_trx'],
									"jumlah" =>$ser_disk['diskon'],
									"kategori"=>"bubuk",
									"jenis_pembayaran"=>$trx['jenis_pembayaran']
								);		
		$ser_disk['id_referensi'] =  $trx['kode_trx'];	

		$this->db->set($ser_disk);
		$this->db->insert('tbl_transaksi');
		/* diskon */

		


		die("");

	}





	public function simpan_kasir_member()
	{
		$data = $this->input->post();
		//var_dump($data);		
		$trx['bukti'] 		= upload_file('bukti_pembayaran');
		$trx['kode_trx']	= date('ymdhis')."_".$this->session->userdata('id_admin');
		$trx['jenis_pembayaran'] = $data['jenis_pembayaran'];
		for ($i=0; $i <count($data['id_barang']) ; $i++) { 
			if(hanya_nomor($data['qty'][$i])>0)
			{
				$trx['berat'] = hanya_nomor($data['berat'][$i]);
				$trx['qty'] = hanya_nomor($data['qty'][$i]);
				$trx['id_barang'] = $data['id_barang'][$i];
				$trx['harga']	= hanya_nomor($data['harga_agen'][$i]);
				$trx['nama']  	= $data['nama'];
				$trx['hp']  	= $data['hp'];
				$trx['keterangan']  = "Kasir Member -  ".$data['keterangan']." - ".date('Y-m-d H:i:s');			
				$trx['kategori_trx']='keluar';
				$trx['diskon'] = hanya_nomor($data['diskon']);

				$this->db->set($trx);
				$this->db->insert('kopi_trx');
				$id_trx = $this->db->insert_id();

				/*********** insert ke transaksi **************/	

				$ser_trx = array(
								"id_group"		=>"20",							
								"keterangan"	=>"[".$trx['jenis_pembayaran']."] - kpd : ".$data['nama']." - ". $trx['keterangan'],
								"jumlah"		=>($trx['harga']*$data['qty'][$i]),
								"url_bukti"		=>$trx['bukti'],
								"kategori"=>"bubuk",
								"jenis_pembayaran"=>$trx['jenis_pembayaran']
							);				
				/* untuk id_referensi = id_group/id_table*/
				$ser_trx['id_referensi'] = $id_trx;	
				$this->db->set($ser_trx);
				$this->db->insert('tbl_transaksi');
				/*********** insert ke transaksi **************/

				
			}
				
		}

		echo $trx['kode_trx'];

		

		/* diskon */
		$ser_disk['diskon'] = hanya_nomor($data['diskon']);
		$ser_disk = array(
									"id_group"=>"9",							
									"keterangan"=>"Diskon Kpd: ".$data['nama']."-".$data['hp']." - Trx:".$trx['kode_trx'],
									"jumlah" =>$ser_disk['diskon'],
									"kategori"=>"bubuk",
									"jenis_pembayaran"=>$trx['jenis_pembayaran']
								);		
		$ser_disk['id_referensi'] =  $trx['kode_trx'];	

		$this->db->set($ser_disk);
		$this->db->insert('tbl_transaksi');
		/* diskon */


		die("");

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
		$data['titipan'] = $this->m_meja->all_trx_titipan($data['tgl_awal'],$data['tgl_akhir']);
		$data['roasting'] = $this->m_meja->all_trx_roasting($data['tgl_awal'],$data['tgl_akhir']);
		$data['menu'] = $this->m_meja->all_trx_menu($data['tgl_awal'],$data['tgl_akhir']);
		$data['kopi'] = $this->m_meja->all_trx_kopi($data['tgl_awal'],$data['tgl_akhir']);

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
		if($serialize['qty']>0)
		{
			$this->m_meja->insert_trx($serialize);	
		}
		
		
	}


	public function simpan_pembayaran()
	{
		$data['url_bukti'] 	= upload_file('bukti_pembayaran');
		$serialize = $this->input->post();		
		$serialize['group_trx'] = date('Ymdhis')."_".$serialize['id_meja'];
		$serialize['url_bukti'] = $data['url_bukti'];
		

		
		
	

		$group_trx = $serialize['group_trx'];
		$serialize['harga_ekspedisi'] = hanya_nomor($serialize['harga_ekspedisi']);
		$serialize['diskon_cafe'] = hanya_nomor($serialize['diskon_cafe']);
		$serialize['diskon_bubuk'] = hanya_nomor($serialize['diskon_bubuk']);

		if($this->m_meja->update_status($serialize))
		{

			$q = $this->db->query("
				SELECT a.id_barang,a.tgl_trx,a.group_trx,a.harga_pokok,a.url_bukti,a.jenis_pembayaran, SUM(a.qty) as qty,a.jenis,
				b.nama_barang
					FROM `trx_meja` a
					LEFT JOIN tbl_barang b ON a.id_barang=b.id
					WHERE a.group_trx='$group_trx'
					GROUP BY a.id_meja,a.id_barang,a.group_trx

			 ");


			/******** diskon *******/

			if($serialize['diskon_cafe']>0)
			{
					$disk['keterangan'] = "Diskon Cafe id Meja  ".$serialize['id_meja']." - ".rupiah($serialize['diskon_cafe']*1);
					$disk['id_group']	=9;
					$disk['id_referensi'] = $serialize['id_meja'];					
					$disk['jumlah'] 	= $serialize['diskon_cafe'];					
					$disk['kategori'] = "cafe";
					$disk['jenis_pembayaran'] = $serialize['jenis_pembayaran'];
					$this->db->set($disk);
					$this->db->insert('tbl_transaksi');
			}

			if($serialize['diskon_bubuk']>0)
			{
				$disk['keterangan'] = "Diskon Bubuk id Meja  ".$serialize['id_meja']." - ".rupiah($serialize['diskon_bubuk']*1);
				$disk['id_group']	=9;
					$disk['id_referensi'] = $serialize['id_meja'];					
					$disk['jumlah'] 	= $serialize['diskon_bubuk'];					
					$disk['kategori'] = "bubuk";
					$disk['jenis_pembayaran'] = $serialize['jenis_pembayaran'];
					$this->db->set($disk);
					$this->db->insert('tbl_transaksi');	
			}
			
			/********** diskon ********/



			

			foreach ($q->result() as $key) {
				$kategori = $key->jenis;
				$jumlah_bubuk =0;
				$jumlah_cafe =0;
				$this->db->query("INSERT INTO kopi_trx 
										SET 
										id_barang='$key->id_barang',
										kategori_trx='keluar', 										
										harga='$key->harga_pokok',
										qty='$key->qty',
										kode_trx='$key->group_trx',
										bukti='$key->url_bukti',
										jenis_pembayaran='$key->jenis_pembayaran',					
										jenis='$kategori',				
										keterangan='Kasir Cafe'

								");

				if($kategori=='bubuk')				
				{
					
					$jumlah_bubuk+=$key->harga_pokok; 					
					$data['id_group']	=8;
					$data['keterangan'] = "Pemayaran [".$serialize['jenis_pembayaran']."] id meja ".$serialize['id_meja']." - $key->nama_barang ";
					
					$data['id_referensi'] = $serialize['id_meja'];
					$data['jenis_pembayaran'] = $serialize['jenis_pembayaran'];
					$data['harga_ekspedisi'] = hanya_nomor($serialize['harga_ekspedisi']);
					$data['jumlah'] 	= $key->harga_pokok;
					$data['kategori']=$kategori;
					$this->db->set($data);
					$this->db->insert('tbl_transaksi');

				}


				if($kategori=='cafe')				
				{
					
					$jumlah_cafe+=$key->harga_pokok; 					
					$data['id_group']	=8;
					$data['keterangan'] = "Pemayaran [".$serialize['jenis_pembayaran']."] id meja ".$serialize['id_meja']."- $key->nama_barang ";
					
					$data['id_referensi'] = $serialize['id_meja'];
					$data['jenis_pembayaran'] = $serialize['jenis_pembayaran'];
					$data['harga_ekspedisi'] = hanya_nomor($serialize['harga_ekspedisi']);
					$data['jumlah'] 	= $key->harga_pokok;
					$data['kategori']=$kategori;
					$this->db->set($data);
					$this->db->insert('tbl_transaksi');

				}
			}	
		}
		

		echo $serialize['group_trx'];
	}



	public function cicilan_agen()
	{
		$data['all'] = null;	
		$this->load->view('form_cicilan_agen',$data);

	}



	public function simpan_cicilan_agen()
	{
		$serialize = $this->input->post();
		$serialize['jumlah']=hanya_nomor($serialize['jumlah']);
		$serialize['id_group']='17';
		$serialize['url_bukti'] = upload_file('bukti_pembayaran');

		$serialize['keterangan'] = "Pemayaran Cicilan A.n: ".$serialize['nama']." - ".$serialize['keterangan'];
		unset($serialize['nama']);

		$this->db->set($serialize);
		$this->db->insert('tbl_transaksi');

	}

	public function struk_sebelum($id_meja)
	{

		$trx['data'] = $this->m_meja->trx_sebelum_bayar($id_meja);
		
		 $html = $this->load->view('struk_sebelum.php',$trx);
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


	public function struk_kopi($group_trx)
	{
		
		
		
		$trx['data'] = $this->m_meja->trx_by_group_kopi($group_trx);

		//var_dump($staff_arr);
		$filename = "slip_penjualan_".$this->router->fetch_class()."_".$group_trx;
		
		// As PDF creation takes a bit of memory, we're saving the created file in /downloads/reports/
		$pdfFilePath = FCPATH."/downloads/$filename.pdf";
		
		 $html = $this->load->view('struk_kopi.php',$trx);
    
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
