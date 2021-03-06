<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mapel extends CI_Controller {

	var $table = 'tb_mapel';

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('guru_logged_in') !=  "Sudah_Loggin") {
			echo "<script>
			alert('Login Dulu!');";
			echo 'window.location.assign("'.site_url("guru/welcome").'")
			</script>';
		}
		$this->load->model('m_mapel','Model');
	}

	public function json() {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json();
		}
	}

	public function index()
	{
		$data['title'] = 'Data Mata Pelajaran' ;
		$data['kelas'] = $this->db->order_by('nama_kelas', 'asc');
		$data['kelas'] = $this->DButama->GetDB('tb_kelas');
		$this->load->view('guru/temp-header',$data);
		$this->load->view('guru/v_mapel');
		$this->load->view('guru/temp-footer');
	}

}

/* End of file Mapel.php */
/* Location: ./application/controllers/guru/Mapel.php */