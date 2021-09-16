<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

	// deklarasi var table
	var $table = 'tb_siswa';
	var $tablenilai = 'tb_nilaisiswa';
	var $tablekelas = 'tb_kelas';

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
		$this->load->model('m_siswa','Model');  //load model
	}

	// fun json datatables
	public function json($id_kelas) {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json1($id_kelas);
		}
	}

	public function index()
	{
		redirect('guru/siswa/kelas/101','refresh');
	}

	// fun halaman siswa per kelas
	public function kelas($id_kelas)
	{
		$cek = $this->DButama->GetDBWhere($this->tablekelas,array('id'=> $id_kelas));
		if ($cek->num_rows() == 1) {
			$data['kls'] = $id_kelas;
			$data['kelas'] = $this->db->order_by('nama_kelas', 'asc');
			$data['kelas'] = $this->DButama->GetDB('tb_kelas');
			$data['mapel'] = $this->db->order_by('nama_mapel', 'asc');
			$data['mapel'] = $this->DButama->GetDB('tb_mapel');
			$data['jadwal'] = $this->db->order_by('id_kelas', 'asc');
			$data['jadwal'] = $this->DButama->GetDBWhere('tb_jadwal', array('nip_guru' => $this->session->userdata('nip')));
		
			$data['title'] = 'Data Siswa '.$cek->row('nama_kelas');
			$this->load->view('guru/temp-header',$data);
			$this->load->view('guru/v_siswa',$data);
			$this->load->view('guru/temp-footer');
		} else {
			redirect('error404','refresh');
		}
	}

    // fun view detail
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