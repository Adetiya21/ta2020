<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru extends CI_Controller {

	var $table = 'tb_guru';

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('guru_logged_in') !=  "Sudah_Loggin") {
			echo "<script>
			alert('Login Dulu!');";
			echo 'window.location.assign("'.site_url("guru/welcome").'")
			</script>';
		}
		$this->load->model('m_guru','Model');
	}

	public function json() {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json_guru();
		}
	}

	public function index()
	{
		$data['kelas'] = $this->db->order_by('nama_kelas', 'asc');
		$data['kelas'] = $this->DButama->GetDB('tb_kelas');
		$data['mapel'] = $this->db->order_by('nama_mapel', 'asc');
		$data['mapel'] = $this->DButama->GetDB('tb_mapel');
		$data['title'] = 'Data Guru';
		$this->load->view('guru/temp-header',$data);
		$this->load->view('guru/v_guru',$data);
		$this->load->view('guru/temp-footer');
	}

    //view
	public function view($nip)
	{
		if ($this->input->is_ajax_request()) {
			$where = array('nip' => $nip);
			$data = $this->DButama->GetDBWhere($this->table,$where)->row();
			echo json_encode($data);
		}
	}

}

/* End of file Guru.php */
/* Location: ./application/controllers/guru/Guru.php */