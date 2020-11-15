<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_kopi extends CI_Controller {
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
		$this->load->model('m_jenis_kopi');
		
	}


	public function data()
	{
		$data['all'] = $this->m_jenis_kopi->m_data();	
		$this->load->view('jenis_kopi',$data);
	}

	public function by_id($id)
	{
		header('Content-Type: application/json');
		$data['all'] = $this->m_jenis_kopi->m_by_id($id);
		echo json_encode($data['all']);
	}

	public function simpan()
	{
		$id = $this->input->post('id');		
		$serialize = $this->input->post();
		$serialize['harga_beli'] = hanya_nomor($serialize['harga_beli']);
		$serialize['harga_jual'] = hanya_nomor($serialize['harga_jual']);
		$serialize['harga_jual_ke_cafe'] = hanya_nomor($serialize['harga_jual_ke_cafe']);

		if($id=='')
		{
			$this->m_jenis_kopi->insert($serialize);
			die('1');
		}else{

			$this->m_jenis_kopi->update($serialize,$id);
		}

	}

	public function hapus($id)
	{
		$this->db->query("DELETE FROM jenis_kopi WHERE id='$id'");
	}


}
