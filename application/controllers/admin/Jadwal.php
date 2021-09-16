<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends CI_Controller {

	// deklarasi var table
	var $table = 'tb_jadwal';
	var $tablekelas = 'tb_kelas';

	function __construct()
	{
		parent::__construct();
		// cek session admin sudah login
		if ($this->session->userdata('admin_logged_in') !=  "Sudah_Loggin") {
			echo "<script>
			alert('Login Dulu!');";
			echo 'window.location.assign("'.site_url("admin/welcome").'")
			</script>';
		}
		$this->load->model('m_jadwal','Model');  //load model
	}

	// fun json datatables
	public function json($id_kelas) {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json($id_kelas);
		}
	}

	public function index()
	{
		redirect('admin/jadwal/kelas/101','refresh');
	}

	// fun halaman kelas
	public function kelas($id_kelas)
	{
		$cek = $this->DButama->GetDBWhere($this->tablekelas,array('id'=> $id_kelas));
		if ($cek->num_rows() == 1) {
			$data['kls'] = $id_kelas;
			$data['kelas'] = $this->db->order_by('nama_kelas', 'asc');
			$data['kelas'] = $this->DButama->GetDB('tb_kelas');
			$data['mapel'] = $this->db->order_by('nama_mapel', 'asc');
			$data['mapel'] = $this->DButama->GetDB('tb_mapel');
			$data['guru'] = $this->db->order_by('nama', 'asc');
			$data['guru'] = $this->DButama->GetDB('tb_guru');
			$data['title'] = 'Data Jadwal';
			$this->load->view('admin/temp-header',$data);
			$this->load->view('admin/v_jadwal');
			$this->load->view('admin/temp-footer');
		} else {
			redirect('error404','refresh');
		}
	}

	// fun hapus
	public function hapus($id)
	{
		if ($this->input->is_ajax_request()) {
			$where = array('id' => $id);
			$this->DButama->GetDBWhere($this->table,$where)->row();
			$this->DButama->DeleteDB($this->table,$where);
			echo json_encode(array("status" => TRUE));
		}
	}

    // fun tambah
	public function tambah()
	{
		if ($this->input->is_ajax_request()) {
			$data = array(
				'nip_guru' => $this->input->post('nip_guru'),
				'id_kelas' => $this->input->post('id_kelas'),
				'hari' => $this->input->post('hari'),
				'jam_masuk' => $this->input->post('jam_masuk'),
				'jam_selesai' => $this->input->post('jam_selesai'),
			);
			$this->DButama->AddDB($this->table,$data);
			echo json_encode(array("status" => TRUE));
		}
	}

    // fun edit
	public function edit($id)
	{
		if ($this->input->is_ajax_request()) {
			$where = array('id' => $id);
			$data = $this->DButama->GetDBWhere($this->table,$where)->row();
			echo json_encode($data);
		}
	}
	
	// proses update
	public function update()
	{
		if ($this->input->is_ajax_request()) {
			$where  = array('id' => $this->input->post('id'));
			$query = $this->DButama->GetDBWhere($this->table,$where);
			$row = $query->row();
			$data = array(
				'nip_guru' => $this->input->post('nip_guru'),
				'id_kelas' => $this->input->post('id_kelas'),
				'hari' => $this->input->post('hari'),
				'jam_masuk' => $this->input->post('jam_masuk'),
				'jam_selesai' => $this->input->post('jam_selesai'),
			);
			$this->DButama->UpdateDB($this->table,$where,$data);
			echo json_encode(array("status" => TRUE));
		}
	}

}

/* End of file Jadwal.php */
/* Location: ./application/controllers/admin/Jadwal.php */