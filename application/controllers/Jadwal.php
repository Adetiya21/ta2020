<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends CI_Controller {

	var $table = 'tb_jadwal';

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('siswa_logged_in') !=  "Sudah_Loggin") {
			echo "<script>
			alert('Login Dulu!');";
			echo 'window.location.assign("'.site_url("welcome").'")
			</script>';
		}
		$this->load->model('m_jadwal','Model');
	}

	public function json() {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json_siswa();
		}
	}

	public function index()
	{
		$query = $this->DButama->GetDBWhere('tb_kelas', array('id' => $this->session->userdata('id_kelas'), ));
		$row = $query->row();
		$data['kelas'] = $row->nama_kelas;
		$title = array('title' => 'Jadwal Kelas', );
		$this->load->view('siswa/temp-header',$title);
		$this->load->view('siswa/v_jadwal',$data);
		$this->load->view('siswa/temp-footer');
	}

}

/* End of file Jadwal.php */
/* Location: ./application/controllers/Jadwal.php */