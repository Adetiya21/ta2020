<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	var $table = 'tb_guru';

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('guru_logged_in') !=  "Sudah_Loggin") {
			echo "<script>
			alert('Login Dulu!');";
			echo 'window.location.assign("'.site_url("guru/welcome").'")
			</script>';
		}
	}

	public function index()
	{
		$data['title'] = 'Dashboard';
		$data['siswa'] = $this->DButama->GetDB('tb_siswa')->num_rows();
		$data['nsiswa'] = $this->DButama->GetDBWhere('tb_nilaisiswa', array('id_mapel' => $this->session->userdata('id_mapel') ))->num_rows();
		$data['guru'] = $this->DButama->GetDBWhere('tb_guru', array('id_mapel' => $this->session->userdata('id_mapel') ))->num_rows();
		// $data['kls'] = $this->DButama->GetDBWhere('tb_kelas', array('id' => $this->session->userdata('id_kelas') ))->row();
		$data['mapel'] = $this->DButama->GetDBWhere('tb_mapel', array('id' => $this->session->userdata('id_mapel') ))->row();

		// kelas 1
		$data['sw1'] = $this->DButama->GetDBWhere('tb_siswa', array('id_kelas' => '101'))->num_rows();
		$where = array('id_mapel' => $this->session->userdata('id_mapel'));
		$where1 = array('id_kelas' => '101');
		$query = $this->db->where($where);
		$query = $this->db->where($where1);	
		$query = $this->db->select('id, sum(rata) as jrata');	
		$query = $this->db->from('tb_nilaisiswa');
		$query = $this->db->get();
		$data['kls1'] = $query->row();

		// kelas 2
		$data['sw2'] = $this->DButama->GetDBWhere('tb_siswa', array('id_kelas' => '102'))->num_rows();
		$where = array('id_mapel' => $this->session->userdata('id_mapel'));
		$where1 = array('id_kelas' => '102');
		$query = $this->db->where($where);
		$query = $this->db->where($where1);	
		$query = $this->db->select('id, sum(rata) as jrata');	
		$query = $this->db->from('tb_nilaisiswa');
		$query = $this->db->get();
		$data['kls2'] = $query->row();

		// kelas 3
		$data['sw3'] = $this->DButama->GetDBWhere('tb_siswa', array('id_kelas' => '103'))->num_rows();
		$where = array('id_mapel' => $this->session->userdata('id_mapel'));
		$where1 = array('id_kelas' => '103');
		$query = $this->db->where($where);
		$query = $this->db->where($where1);	
		$query = $this->db->select('id, sum(rata) as jrata');	
		$query = $this->db->from('tb_nilaisiswa');
		$query = $this->db->get();
		$data['kls3'] = $query->row();

		// kelas 4
		$data['sw4'] = $this->DButama->GetDBWhere('tb_siswa', array('id_kelas' => '104'))->num_rows();
		$where = array('id_mapel' => $this->session->userdata('id_mapel'));
		$where1 = array('id_kelas' => '104');
		$query = $this->db->where($where);
		$query = $this->db->where($where1);	
		$query = $this->db->select('id, sum(rata) as jrata');	
		$query = $this->db->from('tb_nilaisiswa');
		$query = $this->db->get();
		$data['kls4'] = $query->row();

		// kelas 5
		$data['sw5'] = $this->DButama->GetDBWhere('tb_siswa', array('id_kelas' => '105'))->num_rows();
		$where = array('id_mapel' => $this->session->userdata('id_mapel'));
		$where1 = array('id_kelas' => '105');
		$query = $this->db->where($where);
		$query = $this->db->where($where1);	
		$query = $this->db->select('id, sum(rata) as jrata');	
		$query = $this->db->from('tb_nilaisiswa');
		$query = $this->db->get();
		$data['kls5'] = $query->row();

		// kelas 6
		$data['sw6'] = $this->DButama->GetDBWhere('tb_siswa', array('id_kelas' => '106'))->num_rows();
		$where = array('id_mapel' => $this->session->userdata('id_mapel'));
		$where1 = array('id_kelas' => '106');
		$query = $this->db->where($where);
		$query = $this->db->where($where1);	
		$query = $this->db->select('id, sum(rata) as jrata');	
		$query = $this->db->from('tb_nilaisiswa');
		$query = $this->db->get();
		$data['kls6'] = $query->row();
		
		$data['kelas'] = $this->db->order_by('nama_kelas', 'asc');
		$data['kelas'] = $this->DButama->GetDB('tb_kelas');
			
		$this->load->view('guru/temp-header',$data);
		$this->load->view('guru/v_index',$data);
		$this->load->view('guru/temp-footer');
	}

	public function profil($nip)
	{
		$cek = $this->DButama->GetDBWhere($this->table,array('nip'=> $nip));
		if ($cek->num_rows() == 1) {
			$data['title'] = 'Profil';
			$data['kelas'] = $this->db->order_by('nama_kelas', 'asc');
			$data['kelas'] = $this->DButama->GetDB('tb_kelas');
			$data['mapel'] = $this->db->order_by('nama_mapel', 'asc');
			$data['mapel'] = $this->DButama->GetDB('tb_mapel');
			$data['profil'] = $cek->row();
			$this->load->view('guru/temp-header',$data);
			$this->load->view('guru/v_profil',$data);
			$this->load->view('guru/temp-footer');
		}else{
			redirect('error404','refresh');
		}
	}

	function edit_profil()
	{
		$this->load->library('form_validation');

		$config = array(
			array('field' => 'nama','label' => 'Nama','rules' => 'required',),
			array('field' => 'nip','label' => 'nip','rules' => 'required'),
			array('field' => 'password','label' => 'Password','rules' => 'required')
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', validation_errors());
			redirect('guru/home/profil/'.$this->session->userdata('nip').'','refresh');
		}else{
			$where  = array('nip' => $this->input->post('nip'));
			$query = $this->DButama->GetDBWhere($this->table,$where);
			$row = $query->row();
				$pass=$this->input->post('password');
				$hash=password_hash($pass, PASSWORD_DEFAULT);
				$data = array(
					'nama' => $this->input->post('nama'),
					'id_kelas' => $this->input->post('id_kelas'),
					'id_mapel' => $this->input->post('id_mapel'),
					'jenkel' => $this->input->post('jenkel'),
					'agama' => $this->input->post('agama'),
					'no_telp' => $this->input->post('no_telp'),
					'alamat' => $this->input->post('alamat'),
					'password' => $hash
				);
				$sess_data['nama'] = $this->input->post('nama');
				$this->session->set_userdata($sess_data);
			
				$this->DButama->UpdateDB($this->table,$where,$data);
				$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>Akun anda sudah diperbaharui</strong> 
							</div>');
				redirect('guru/home/profil/'.$this->session->userdata('nip').'','refresh');
		
		}
	}

}

/* End of file Home.php */
/* Location: ./application/controllers/guru/Home.php */