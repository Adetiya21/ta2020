<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

	var $table = 'tb_siswa';

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('guru_logged_in') !=  "Sudah_Loggin") {
			echo "<script>
			alert('Login Dulu!');";
			echo 'window.location.assign("'.site_url("guru/welcome").'")
			</script>';
		}
		$this->load->model('m_siswa','Model');
	}

	public function json() {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json1();
		}
	}

	public function index()
	{
		$data['kelas'] = $this->db->order_by('nama_kelas', 'asc');
		$data['kelas'] = $this->DButama->GetDB('tb_kelas');
		$data['mapel'] = $this->DButama->GetDB('tb_mapel')->row();
		$title = array('title' => 'Data Siswa', );
		$this->load->view('guru/temp-header',$title);
		$this->load->view('guru/v_siswa',$data);
		$this->load->view('guru/temp-footer');
	}

    //view
	public function view($nis)
	{
		if ($this->input->is_ajax_request()) {
			$where = array('nis' => $nis);
			$data = $this->DButama->GetDBWhere($this->table,$where)->row();
			echo json_encode($data);
		}
	}

}

/* End of file Siswa.php */
/* Location: ./application/controllers/guru/Siswa.php */