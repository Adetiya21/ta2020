<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru extends CI_Controller {

	var $table = 'tb_guru';

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('admin_logged_in') !=  "Sudah_Loggin") {
			echo "<script>
			alert('Login Dulu!');";
			echo 'window.location.assign("'.site_url("admin/welcome").'")
			</script>';
		}
		$this->load->model('m_guru','Model');
	}

	public function json() {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json();
		}
	}

	public function index()
	{
		$data['mapel'] = $this->db->order_by('nama_mapel', 'asc');
		$data['mapel'] = $this->DButama->GetDB('tb_mapel');
		$data['kelas'] = $this->db->order_by('nama_kelas', 'asc');
		$data['kelas'] = $this->DButama->GetDB('tb_kelas');
		$data['title'] = 'Data Guru';
		$this->load->view('admin/temp-header',$data);
		$this->load->view('admin/v_guru',$data);
		$this->load->view('admin/temp-footer');
	}

	//hapus
	public function hapus($nip)
	{
		if ($this->input->is_ajax_request()) {
			$where = array('nip' => $nip);
			$this->DButama->GetDBWhere($this->table,$where)->row();
			$this->DButama->DeleteDB($this->table,$where);
			echo json_encode(array("status" => TRUE));
		}
	}

    //input
	public function tambah()
	{
		if ($this->input->is_ajax_request()) {
			$DataUser  = array('nip' => $this->input->post('nip'));
			if ($this->DButama->GetDBWhere($this->table,$DataUser)->num_rows() == 1) {
				$data = array();
				$data['inputerror'][] = 'nip';
				$data['error_string'][] = 'NIP sudah ada / tidak boleh duplikat';
				$data['status'] = FALSE;
				echo json_encode($data);
				exit();
			}else{
				$pass=$this->input->post('password');
				$hash=password_hash($pass, PASSWORD_DEFAULT);
				$data = array(
					'nip' => $this->input->post('nip'),
					'id_kelas' => $this->input->post('id_kelas'),
					'id_mapel' => $this->input->post('id_mapel'),
					'nama' => $this->input->post('nama'),
					'jenkel' => $this->input->post('jenkel'),
					'agama' => $this->input->post('agama'),
					'alamat' => $this->input->post('alamat'),
					'password' => $hash					
				);
				
				$this->DButama->AddDB($this->table,$data);
				echo json_encode(array("status" => TRUE));
			}
		}
	}

    //edit
	public function edit($nip)
	{
		if ($this->input->is_ajax_request()) {
			$where = array('nip' => $nip);
			$data = $this->DButama->GetDBWhere($this->table,$where)->row();
			echo json_encode($data);
		}
	}
	
	//proses update
	public function update()
	{
		if ($this->input->is_ajax_request()) {
			$where  = array('nip' => $this->input->post('nip'));
			$query = $this->DButama->GetDBWhere($this->table,$where);
			$row = $query->row();
			$pass=$this->input->post('password');
			$hash=password_hash($pass, PASSWORD_DEFAULT);
			$data = array(
					'id_kelas' => $this->input->post('id_kelas'),
					'id_mapel' => $this->input->post('id_mapel'),
					'nama' => $this->input->post('nama'),
					'jenkel' => $this->input->post('jenkel'),
					'agama' => $this->input->post('agama'),
					'alamat' => $this->input->post('alamat'),
					'password' => $hash
				);
				$this->DButama->UpdateDB($this->table,$where,$data);
				echo json_encode(array("status" => TRUE));
		}
	}

}

/* End of file Guru.php */
/* Location: ./application/controllers/admin/Guru.php */