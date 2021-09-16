<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct()
	{
		parent::__construct(); 
	}

	public function get_tokens($value="") {
		if ($this->session->userdata('sd') == "SudahMasukMas") {
			echo $this->security->get_csrf_hash();
		}
	}

	// fun halaman login
	public function index()
	{
		$this->load->view('v_login');
	}

	// proses login
	public function login()
	{
		$recaptcha = $this->input->post('g-recaptcha-response');
		$response = $this->recaptcha->verifyResponse($recaptcha);
		if (!isset($response['success']) || $response['success'] <> true) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Klik Recaptcha</strong> 
				</div>');
			redirect('welcome','refresh');
		} else {
			// validasi
			$this->load->library('form_validation');
			$config = array(
				array('field' => 'nis/nip','label' => "NIS/NIP",'rules' => 'required' ),
				array('field' => 'password','label' => 'Password','rules' => 'required' )
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('nis/nip', set_value('nis/nip') );
				$this->session->set_flashdata('password', set_value('password') );
				$this->session->set_flashdata('error', validation_errors());
				redirect('welcome','refresh');
			}else{

				// load database dengan nis/nip
				$query = $this->DButama->GetDBWhere('tb_siswa', array('nis' => $this->input->post('nis/nip'), ));  //tabel siswa
				$query_guru = $this->DButama->GetDBWhere('tb_guru',  array('nip' => $this->input->post('nis/nip')));  //tabel guru
				
				if ($query->num_rows() == 0 && $query_guru->num_rows() == 0) {
					$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>NIS/NIP/Password Tidak Ada</strong> 
						</div>');
					redirect('welcome','refresh');
				} 
				//login siswa
				else if ($query->num_rows() == 1 ) {
					$hasil = $query->row();
					if (password_verify($this->input->post('password'), $hasil->password)) {
						foreach ($query->result() as $key ) {
							$sess_data['siswa_logged_in'] = "Sudah_Loggin";
							$sess_data['nama'] = $key->nama;
							$sess_data['nis'] = $key->nis;
							$sess_data['id_kelas'] = $key->id_kelas;
							$this->session->set_userdata($sess_data);
							$this->session->unset_userdata('guru_logged_in');
							$this->session->unset_userdata('admin_logged_in');
							redirect('home', 'refresh');
						}
					}else{
						$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>NIS / Password Tidak Ada</strong> 
							</div>');
						redirect('welcome','refresh');
					}
				} 
				//login guru
				else if ($query_guru->num_rows() == 1 ) {
					$hasil_guru = $query_guru->row();
					if (password_verify($this->input->post('password'), $hasil_guru->password)) {
						foreach ($query_guru->result() as $key ) {
							$sess_data['guru_logged_in'] = "Sudah_Loggin";
							$sess_data['nama'] = $key->nama;
							$sess_data['nip'] = $key->nip;
							$sess_data['gambar'] = $key->gambar;
							$sess_data['id_mapel'] = $key->id_mapel;
							$this->session->set_userdata($sess_data);
							$this->session->unset_userdata('admin_logged_in');  //mengeluarkan session user
							$this->session->unset_userdata('siswa_logged_in');  //mengeluarkan session user
							redirect('guru/home', 'refresh');
						}
					}else{
						// menampilkan pesan error
						$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>NIP / Password Tidak Ada</strong> 
							</div>');
						redirect('welcom','refresh');
					}
				}
			}
		}
	}

	// fun logout
	function logout()
	{
		$user_data = $this->session->all_userdata();
		foreach ($user_data as $key => $value) {
			if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
				$this->session->unset_userdata($key);
			}
		}
		redirect('welcome','refresh');
	}

}
