<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai extends CI_Controller {

	var $table = 'tb_nilaisiswa';
	var $tablesiswa = 'tb_siswa';
	var $tablekelas = 'tb_kelas';
	var $tablemapel = 'tb_mapel';

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('guru_logged_in') !=  "Sudah_Loggin") {
			echo "<script>
			alert('Login Dulu!');";
			echo 'window.location.assign("'.site_url("welcome").'")
			</script>';
		}
		$this->load->model('m_nilai','Model');
	}

	// public function json() {
	// 	if ($this->input->is_ajax_request()) {
	// 		header('Content-Type: application/json');
	// 		echo $this->Model->json_guru();
	// 	}
	// }

	public function json($id_kelas) {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->jsonguru($id_kelas);
		}
	}

	public function index()
	{
		redirect('guru/nilai/kelas/101','refresh');
	}

	public function kelas($id_kelas)
	{
		$cek = $this->DButama->GetDBWhere($this->tablekelas,array('id'=> $id_kelas));
		if ($cek->num_rows() == 1) {
			$cek1 = $this->DButama->GetDBWhere($this->tablemapel,array('id'=> $this->session->userdata('id_mapel')));
			if ($cek1->num_rows() == 1) {
				$data['kl1'] = $id_kelas;
				$data['mapel'] = $this->DButama->GetDB('tb_mapel')->row();
				$data['jadwal'] = $this->db->order_by('id_kelas', 'asc');
				$data['jadwal'] = $this->DButama->GetDBWhere('tb_jadwal', array('nip_guru' => $this->session->userdata('nip')));$data['kelas'] = $this->DButama->GetDB('tb_kelas');
				$data['kls'] = $cek->row();
				$data['mp'] = $cek1->row();
				$data['title'] = 'Data Nilai '.$cek->row('nama_kelas').' '.$cek1->row('nama_mapel');
				$this->load->view('guru/temp-header',$data);
				$this->load->view('guru/v_nilai',$data);
				$this->load->view('guru/temp-footer');
			} else {
			redirect('error404','refresh');
			}
		} else {
			redirect('error404','refresh');
		}
	}

	public function cetak($id_kelas)
	{
		$cek = $this->DButama->GetDBWhere($this->tablekelas,array('id'=> $id_kelas));
		if ($cek->num_rows() == 1) {
			$cek1 = $this->DButama->GetDBWhere($this->tablemapel,array('id'=> $this->session->userdata('id_mapel')));
			if ($cek1->num_rows() == 1) {
				$data['kl1'] = $id_kelas;
				$data['mapel'] = $this->DButama->GetDB('tb_mapel')->row();
				$data['kelas'] = $this->DButama->GetDB('tb_kelas');
				$data['kls'] = $cek->row();
				$data['mp'] = $cek1->row();
				$data['title'] = 'Data Nilai '.$cek->row('nama_kelas').' '.$cek1->row('nama_mapel');
				$this->load->view('guru/temp-header-cetak',$data);
				$this->load->view('guru/v_cetak-nilai',$data);
				$this->load->view('guru/temp-footer');
			} else {
			redirect('error404','refresh');
			}
		} else {
			redirect('error404','refresh');
		}
	}

	//edit
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

	//proses update
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
/* Location: ./application/controllers/guru/Nilai.php */