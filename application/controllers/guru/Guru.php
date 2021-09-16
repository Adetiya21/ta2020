<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru extends CI_Controller {

	// deklarasi var table
	var $table = 'tb_guru';

	public function __construct()
	{
		parent::__construct();
		// cek session guru sudah login
		if ($this->session->userdata('guru_logged_in') !=  "Sudah_Loggin") {
			echo "<script>
			alert('Login Dulu!');";
			echo 'window.location.assign("'.site_url("welcome").'")
			</script>';
		}
		$this->load->model('m_guru','Model');  //load model
	}

	// fun json datatables
	public function json() {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json_guru();
		}
	}

	// fun halman index
	public function index()
	{
		$data['kelas'] = $this->db->order_by('nama_kelas', 'asc');
		$data['kelas'] = $this->DButama->GetDB('tb_kelas');
		$data['mapel'] = $this->db->order_by('nama_mapel', 'asc');
		$data['mapel'] = $this->DButama->GetDB('tb_mapel');
		$data['jadwal'] = $this->db->order_by('id_kelas', 'asc');
		$data['jadwal'] = $this->DButama->GetDBWhere('tb_jadwal', array('nip_guru' => $this->session->userdata('nip')));
		$data['title'] = 'Data Guru';
		$this->load->view('guru/temp-header',$data);
		$this->load->view('guru/v_guru',$data);
		$this->load->view('guru/temp-footer');
	}

    // fun view detail
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