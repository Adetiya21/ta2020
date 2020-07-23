<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

	var $table = 'tb_siswa';
	var $tablenilai = 'tb_nilaisiswa';
	var $tablekelas = 'tb_kelas';

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('admin_logged_in') !=  "Sudah_Loggin") {
			echo "<script>
			alert('Login Dulu!');";
			echo 'window.location.assign("'.site_url("admin/welcome").'")
			</script>';
		}
		$this->load->model('m_siswa','Model');
	}

	public function json($id_kelas) {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json($id_kelas);
		}
	}

	public function index()
	{
		redirect('admin/siswa/kelas/101','refresh');
	}

	public function kelas($id_kelas)
	{
		$cek = $this->DButama->GetDBWhere($this->tablekelas,array('id'=> $id_kelas));
		if ($cek->num_rows() == 1) {
			$data['kls'] = $id_kelas;
			$data['kelas'] = $this->db->order_by('nama_kelas', 'asc');
			$data['kelas'] = $this->DButama->GetDB('tb_kelas');
			$data['mapel'] = $this->db->order_by('nama_mapel', 'asc');
			$data['mapel'] = $this->DButama->GetDB('tb_mapel');
			$data['title'] = 'Data Siswa '.$cek->row('nama_kelas');
			$this->load->view('admin/temp-header',$data);
			$this->load->view('admin/v_siswa',$data);
			$this->load->view('admin/temp-footer');
		} else {
			redirect('error404','refresh');
		}
	}

	//hapus
	public function hapus($nis)
	{
		if ($this->input->is_ajax_request()) {
			$where = array('nis' => $nis);
			$this->DButama->GetDBWhere($this->table,$where)->row();
			$this->DButama->DeleteDB($this->table,$where);
			echo json_encode(array("status" => TRUE));
		}
	}

    //input
	public function tambah()
	{
		if ($this->input->is_ajax_request()) {
			$DataUser  = array('nis' => $this->input->post('nis'));
			if ($this->DButama->GetDBWhere($this->table,$DataUser)->num_rows() == 1) {
				$data = array();
				$data['inputerror'][] = 'nis';
				$data['error_string'][] = 'NIS sudah ada / tidak boleh duplikat';
				$data['status'] = FALSE;
				echo json_encode($data);
				exit();
			}else{
				$tgl_lahir = $this->input->post('tgl_lahir');
		        $tgl_lahir = date('Y-m-d', strtotime($tgl_lahir));        
				$pass=$this->input->post('password');
				$hash=password_hash($pass, PASSWORD_DEFAULT);
				$data = array(
					'nis' => $this->input->post('nis'),
					'id_kelas' => $this->input->post('id_kelas'),
					'nama' => $this->input->post('nama'),
					'tgl_lahir' => $tgl_lahir,
					'tmp_lahir' => $this->input->post('tmp_lahir'),
					'jenkel' => $this->input->post('jenkel'),
					'agama' => $this->input->post('agama'),
					'alamat' => $this->input->post('alamat'),
					'password' => $hash					
				);

				$this->DButama->AddDB($this->table,$data);

				$mpl = $this->DButama->GetDB('tb_mapel')->num_rows();
				$ml = $this->DButama->GetDB('tb_mapel')->row();
				for ($i=0; $i < $mpl; $i++) { 
					$data1 = array(
					'nis' => $this->input->post('nis'),
					'id_kelas' => $this->input->post('id_kelas'),
					'id_mapel' => $ml->id+$i,
				);
				$this->DButama->AddDB($this->tablenilai,$data1);
				}
				// $data1 = array(
				// 	'nis' => $this->input->post('nis'),
				// 	'id_kelas' => $this->input->post('id_kelas'),
				// 	'h1' => '0',
				// 	'h2' => '0',
				// 	'h3' => '0',
				// 	'uts' => '0',
				// 	'uas' => '0',
				// 	'total' => '0',
				// 	'rata' => '0'
				// );
				
				echo json_encode(array("status" => TRUE));
			}
		}
	}

    //edit
	public function edit($nis)
	{
		if ($this->input->is_ajax_request()) {
			$where = array('nis' => $nis);
			$data = $this->DButama->GetDBWhere($this->table,$where)->row();
			echo json_encode($data);
		}
	}
	
	//proses update
	public function update()
	{
		if ($this->input->is_ajax_request()) {
			$where  = array('nis' => $this->input->post('nis'));
			$query = $this->DButama->GetDBWhere($this->table,$where);
			$row = $query->row();
			
			$tgl_lahir = $this->input->post('tgl_lahir');
	        $tgl_lahir = date('Y-m-d', strtotime($tgl_lahir));        
			$pass=$this->input->post('password');
			$hash=password_hash($pass, PASSWORD_DEFAULT);
			$data = array(
					'id_kelas' => $this->input->post('id_kelas'),
					'nama' => $this->input->post('nama'),
					'tgl_lahir' => $tgl_lahir,
					'tmp_lahir' => $this->input->post('tmp_lahir'),
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

/* End of file Siswa.php */
/* Location: ./application/controllers/admin/Siswa.php */