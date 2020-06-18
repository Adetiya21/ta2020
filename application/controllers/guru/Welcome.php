<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
	}

	public function index()
	{
		$this->load->view('guru/v_login');
	}

	public function login()
	{
		$recaptcha = $this->input->post('g-recaptcha-response');
		$response = $this->recaptcha->verifyResponse($recaptcha);
		if (!isset($response['success']) || $response['success'] <> true) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Klik Recaptcha</strong> 
				</div>');
			redirect('guru','refresh');
		} else {
			$this->load->library('form_validation');
			$config = array(
				array('field' => 'nip','label' => "nip",'rules' => 'required' ),
				array('field' => 'password','label' => 'Password','rules' => 'required',)
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('nip', set_value('nip') );
				$this->session->set_flashdata('password', set_value('password') );
				$this->session->set_flashdata('error', validation_errors());
				redirect('guru','refresh');
			}else{
				$query = $this->DButama->GetDBWhere('tb_guru', array('nip' => $this->input->post('nip'), ));
				if ($query->num_rows() == 0 ) {
					$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>nip / Password Tidak Ada</strong> 
						</div>');
					redirect('guru','refresh');
				}else{
					$hasil = $query->row();
					if (password_verify($this->input->post('password'), $hasil->password)) {
						foreach ($query->result() as $key ) {
							$sess_data['guru_logged_in'] = "Sudah_Loggin";
							$sess_data['nama'] = $key->nama;
							$sess_data['nip'] = $key->nip;
							$sess_data['id_kelas'] = $key->id_kelas;
							$sess_data['id_mapel'] = $key->id_mapel;
							$this->session->set_userdata($sess_data);
							$this->session->unset_userdata('user_logged_in');
							redirect('guru/home', 'refresh');
						}
					}else{
						$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>NIP / Password Tidak Ada</strong> 
							</div>');
						redirect('guru','refresh');
					}
				}
			}
		}
	}

	function logout()
	{
		$user_data = $this->session->all_userdata();
		foreach ($user_data as $key => $value) {
			if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
				$this->session->unset_userdata($key);
			}
		}
		redirect('guru/welcome','refresh');
	}

}

/* End of file Welcome.php */
/* Location: ./application/controllers/guru/Welcome.php */