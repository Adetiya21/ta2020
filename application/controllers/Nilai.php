<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai extends CI_Controller {

	// deklarasi var table
	var $tableuser = 'tb_siswa';
	var $tablenilai = 'tb_nilaisiswa';
	var $tablekelas = 'tb_kelas';
	var $tablemapel = 'tb_mapel';

	public function __construct()
	{
		parent::__construct();
		// cek session siswa sudah login
		if ($this->session->userdata('siswa_logged_in') !=  "Sudah_Loggin") {
			echo "<script>
			alert('Login Dulu!');";
			echo 'window.location.assign("'.site_url("welcome").'")
			</script>';
		}
		$this->load->model('m_nilai','Model');
	}

	// fun json datatables
	public function json() {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json_siswa();
		}
	}

	// fun halman index
	public function index()
	{
		$cek = $this->DButama->GetDBWhere($this->tableuser,array('nis'=> $this->session->userdata('nis')));
		if ($cek->num_rows() == 1) {
			$title = array('title' => 'Data Nilai Siswa', );
			$data['profil'] = $cek->row();
			$this->load->view('siswa/temp-header',$title);
			$this->load->view('siswa/v_nilai',$data);
			$this->load->view('siswa/temp-footer');
		}else{
			redirect('error404','refresh');
		}
	}

	// fun halaman nilai_akhir
	public function nilai_akhir()
	{
		$cek = $this->DButama->GetDBWhere($this->tableuser,array('nis'=> $this->session->userdata('nis')));
		if ($cek->num_rows() == 1) {
			$title = array('title' => 'Data Nilai Akhir Siswa', );
			$data['kelas'] = $this->db->order_by('nama_kelas', 'asc');
			$data['kelas'] = $this->DButama->GetDB($this->tablekelas);
			$nil = $this->DButama->GetDBWhere($this->tablenilai,array('nis'=> $this->session->userdata('nis')));
			$data['nilai'] = $this->DButama->GetDBWhere($this->tablenilai,array('nis'=> $this->session->userdata('nis')));
			$data['mapel'] = $this->DButama->GetDB($this->tablemapel);
			$data['profil'] = $cek->row();
			$this->load->view('siswa/temp-header',$title);
			$this->load->view('siswa/v_nilai-akhir',$data);
			$this->load->view('siswa/temp-footer');
		}else{
			redirect('error404','refresh');
		}
	}

}

/* End of file Nilai.php */
/* Location: ./application/controllers/Nilai.php */