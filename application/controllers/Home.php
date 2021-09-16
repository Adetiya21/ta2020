<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	// deklarasi var table
	var $table = 'tb_siswa';

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
	}
	
	// fun halaman index
	public function index()
	{
		$cek = $this->DButama->GetDBWhere($this->table,array('nis'=> $this->session->userdata('nis')));
		$nilai = $this->session->userdata('nis');
		if ($cek->num_rows() == 1) {
			$data['title'] = 'Dashboard Siswa';
			$data['profil'] = $cek->row();
			// $data['nilai'] = $this->DButama->GetDBWhere('tb_nilaisiswa', array('nis' => $nilai))->row();
			$data['mapel'] = $this->DButama->GetDB('tb_mapel')->num_rows();

			$where = array('tb_nilaisiswa.id_kelas' => $this->session->userdata('id_kelas'));
			$query = $this->db->where($where);
			$where1 = array('tb_nilaisiswa.nis' => $this->session->userdata('nis'));
			$query = $this->db->where($where1);			
			$query = $this->db->select('id, sum(h1) as jh1, sum(h2) as jh2, sum(h3) as jh3, sum(uts) as juts, sum(uas) as juas, sum(total) as jtotal, sum(rata) as jrata');	
			$query = $this->db->from('tb_nilaisiswa');
			$query = $this->db->get();
			$data['nilai'] = $query->row();
			
			$this->load->view('siswa/temp-header',$data);
			$this->load->view('siswa/v_index',$data);
			$this->load->view('siswa/temp-footer');
		}else{
			redirect('error404','refresh');
		}

	}

	// fun halam profil
	public function profil($nis)
	{
		$cek = $this->DButama->GetDBWhere($this->table,array('nis'=> $nis));
		if ($cek->num_rows() == 1) {
			$title = array('title' => 'Profil', );
			$data['kelas'] = $this->db->order_by('nama_kelas', 'asc');
			$data['kelas'] = $this->DButama->GetDB('tb_kelas');
			$data['profil'] = $cek->row();
			$this->load->view('siswa/temp-header',$title);
			$this->load->view('siswa/v_profil',$data);
			$this->load->view('siswa/temp-footer');
		}else{
			// redirect('error404','refresh');
		}
	}

	// proses edit profil
	function edit_profil()
	{
		$this->load->library('form_validation');

		$config = array(
			array('field' => 'nama','label' => 'Nama','rules' => 'required',),
			array('field' => 'nis','label' => 'nis','rules' => 'required'),
			array('field' => 'password','label' => 'Password','rules' => 'required')
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', validation_errors());
			redirect('/home/profil/'.$this->session->userdata('nis').'','refresh');
		}else{
			$where  = array('nis' => $this->input->post('nis'));
			$query = $this->DButama->GetDBWhere($this->table,$where);
			$row = $query->row();
			$tgl_lahir = $this->input->post('tgl_lahir');
	        $tgl_lahir = date('Y-m-d', strtotime($tgl_lahir));        
			$pass=$this->input->post('password');
			$hash=password_hash($pass, PASSWORD_DEFAULT);

			// jika password tidak di ganti
			if ($row->password == $this->input->post('password')) {
				$data = array(
					'nama' => $this->input->post('nama'),
					'id_kelas' => $this->input->post('id_kelas'),
					'tmp_lahir' => $this->input->post('tmp_lahir'),
					'tgl_lahir' => $tgl_lahir,
					'jenkel' => $this->input->post('jenkel'),
					'agama' => $this->input->post('agama'),
					'alamat' => $this->input->post('alamat'),	
				);
				// fun update
				$sess_data['nama'] = $this->input->post('nama');
				$this->session->set_userdata($sess_data);
				$this->DButama->UpdateDB($this->table,$where,$data);
				$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>Akun anda sudah diperbaharui</strong> 
							</div>');
				redirect('home/profil/'.$this->session->userdata('nis').'','refresh');

			// jika password diganti
			} else {
				$data = array(
					'nama' => $this->input->post('nama'),
					'id_kelas' => $this->input->post('id_kelas'),
					'tmp_lahir' => $this->input->post('tmp_lahir'),
					'tgl_lahir' => $tgl_lahir,
					'jenkel' => $this->input->post('jenkel'),
					'agama' => $this->input->post('agama'),
					'alamat' => $this->input->post('alamat'),	
					'password' => $hash
				);
				// fun update
				$sess_data['nama'] = $this->input->post('nama');
				$this->session->set_userdata($sess_data);
				$this->DButama->UpdateDB($this->table,$where,$data);
				$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>Akun anda sudah diperbaharui</strong> 
							</div>');
				redirect('home/profil/'.$this->session->userdata('nis').'','refresh');
			}
		
		}
	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */