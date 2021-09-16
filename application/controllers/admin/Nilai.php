<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai extends CI_Controller {

	// deklarasi var table
	var $table = 'tb_nilaisiswa';
	var $tablesiswa = 'tb_siswa';
	var $tablekelas = 'tb_kelas';
	var $tablemapel = 'tb_mapel';
	var $id_kelas= '';
	var $id_mapel= '';

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
		$this->load->model('m_nilai','Model');  //load model
	}

	// fun json datatables
	public function json($id_kelas="", $id_mapel="") {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->jsonadmin($id_kelas,$id_mapel);
		}
	}

	public function index()
	{
		redirect('admin/nilai/siswa/','refresh');
	}

	// fun halaman siswa sesuai kelas dan mapel
	public function siswa($id_kelas="", $id_mapel="")
	{
		$cek = $this->DButama->GetDBWhere($this->tablekelas,array('id'=> $id_kelas));  //cek data kelas
		if ($cek->num_rows() == 1) {
			$cek1 = $this->DButama->GetDBWhere($this->tablemapel,array('id'=> $id_mapel));  //cek data mapel
			if ($cek1->num_rows() == 1) {
				$data['kl1'] = $id_kelas;
				$data['mp1'] = $id_mapel;
				$data['mapel'] = $this->DButama->GetDB('tb_mapel');
				$data['kelas'] = $this->DButama->GetDB('tb_kelas');
				$cek = $this->DButama->GetDBWhere($this->tablekelas,array('id'=> $id_kelas));
				$cek1 = $this->DButama->GetDBWhere($this->tablemapel,array('id'=> $id_mapel));
				$data['kls'] = $cek->row();
				$data['mp'] = $cek1->row();
				$data['title'] = 'Data Nilai '.$cek->row('nama_kelas').' '.$cek1->row('nama_mapel');
				$this->load->view('admin/temp-header',$data);
				$this->load->view('admin/v_nilai',$data);
				$this->load->view('admin/temp-footer');
			} else {
			redirect('error404','refresh');
			}
		} else {
			redirect('error404','refresh');
		}
	}

	// fun halaman cetak siswa sesuai kelas dan mapel
	public function cetak($id_kelas="", $id_mapel="")
	{
		$cek = $this->DButama->GetDBWhere($this->tablekelas,array('id'=> $id_kelas));  //cek data kelas
		if ($cek->num_rows() == 1) {
			$cek1 = $this->DButama->GetDBWhere($this->tablemapel,array('id'=> $id_mapel));  //cek data mapel
			if ($cek1->num_rows() == 1) {
				$data['kl1'] = $id_kelas;
				$data['mp1'] = $id_mapel;
				$data['mapel'] = $this->DButama->GetDB('tb_mapel');
				$data['kelas'] = $this->DButama->GetDB('tb_kelas');
				$cek = $this->DButama->GetDBWhere($this->tablekelas,array('id'=> $id_kelas));
				$cek1 = $this->DButama->GetDBWhere($this->tablemapel,array('id'=> $id_mapel));
				$data['kls'] = $cek->row();
				$data['mp'] = $cek1->row();
				$data['title'] = 'Data Nilai '.$cek->row('nama_kelas').' '.$cek1->row('nama_mapel');
				$this->load->view('admin/temp-header-cetak',$data);
				$this->load->view('admin/v_cetak-nilai',$data);
				$this->load->view('admin/temp-footer');
			} else {
			redirect('error404','refresh');
			}
		} else {
			redirect('error404','refresh');
		}
	}
	
	// fun edit
	public function edit($id)
	{
		if ($this->input->is_ajax_request()) {
			$where = array('tb_nilaisiswa.id' => $id);
			$query = $this->db->where($where);
			$query = $this->db->select('tb_siswa.nis, tb_siswa.nama as nama, tb_kelas.nama_kelas as kelas, tb_nilaisiswa.id, tb_nilaisiswa.h1, tb_nilaisiswa.h2, tb_nilaisiswa.h3, tb_nilaisiswa.uts, tb_nilaisiswa.uas, tb_nilaisiswa.total, tb_nilaisiswa.rata');	
			$query = $this->db->from('tb_nilaisiswa');
			$query = $this->db->join('tb_kelas', 'tb_nilaisiswa.id_kelas = tb_kelas.id', 'left');
			$query = $this->db->join('tb_siswa', 'tb_nilaisiswa.nis = tb_siswa.nis', 'left');
			$query = $this->db->get();
			$data = $query->row();
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
				'h1' => $this->input->post('h1'),
				'h2' => $this->input->post('h2'),
				'h3' => $this->input->post('h3'),
				'uts' => $this->input->post('uts'),
				'uas' => $this->input->post('uas'),
				'total' => $this->input->post('total'),
				'rata' => $this->input->post('rata')
			);
			$this->DButama->UpdateDB($this->table,$where,$data);
			echo json_encode(array("status" => TRUE));
		}

	}

}

/* End of file Nilai.php */
/* Location: ./application/controllers/admin/Nilai.php */