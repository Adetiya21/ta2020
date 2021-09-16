<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends CI_Controller {

	// deklarasi var table
	var $table = 'tb_jadwal';

	function __construct()
	{
		parent::__construct();
		// cek session guru sudah login
		if ($this->session->userdata('guru_logged_in') !=  "Sudah_Loggin") {
			echo "<script>
			alert('Login Dulu!');";
			echo 'window.location.assign("'.site_url("welcome").'")
			</script>';
		}
		$this->load->model('m_jadwal','Model');  //load model
	}

	// fun json datatables
	public function json() {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json_guru();
		}
	}

	// fun halaman index
	public function index()
	{
		$data['title'] = 'Jadwal';
		$data['kelas'] = $this->db->order_by('nama_kelas', 'asc');
		$data['kelas'] = $this->DButama->GetDB('tb_kelas');
		$data['jadwal'] = $this->db->order_by('id_kelas', 'asc');
		$data['jadwal'] = $this->DButama->GetDBWhere('tb_jadwal', array('nip_guru' => $this->session->userdata('nip')));
		
		$this->load->view('guru/temp-header',$data);
		$this->load->view('guru/v_jadwal',$data);
		$this->load->view('guru/temp-footer');
	}

}

/* End of file Jadwal.php */
/* Location: ./application/controllers/guru/Jadwal.php */