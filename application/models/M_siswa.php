<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_siswa extends CI_Model {

	var $table = 'tb_siswa';

	public function json($id_kelas) {
		$this->datatables->select('tb_siswa.nis,
			tb_siswa.nama,
			tb_siswa.tgl_lahir,
			tb_siswa.tmp_lahir,
			tb_siswa.jenkel,
			tb_siswa.agama,
			tb_siswa.alamat,
			tb_siswa.password,
			tb_kelas.id,
			tb_kelas.nama_kelas,
			');
		$this->datatables->from($this->table);
		$this->datatables->join('tb_kelas', 'tb_siswa.id_kelas=tb_kelas.id');
		$this->datatables->where('id_kelas', $id_kelas);
		$this->datatables->add_column('view', '<div align="center">
			<a class="btn btn-primary btn-rounded btn-sm" href="javascript:void(0)" title="View" onclick="view($1)"> <span class="fa fa-eye"></span></a>
			<a class="btn btn-warning btn-rounded btn-sm" href="javascript:void(0)" title="Edit" onclick="edit($1)"> <span class="fa fa-edit"></span></a>
			<a class="btn btn-danger btn-rounded btn-sm" href="javascript:void(0)" title="Hapus" onclick="hapus($1)" > <span class="fa fa-trash"></span></a>
			</div>', 'nis');
		return $this->datatables->generate();
	}

	public function json1() {
		$this->datatables->select('tb_siswa.nis,
			tb_siswa.nama,
			tb_siswa.tgl_lahir,
			tb_siswa.tmp_lahir,
			tb_siswa.jenkel,
			tb_siswa.agama,
			tb_siswa.alamat,
			tb_siswa.password,
			tb_kelas.id,
			tb_kelas.nama_kelas,
			');
		$this->datatables->from($this->table);
		$this->datatables->join('tb_kelas', 'tb_siswa.id_kelas=tb_kelas.id');
		$this->datatables->where('id_kelas', $this->session->userdata('id_kelas'));
		$this->datatables->add_column('view', '<div align="center">
			<a class="btn btn-primary btn-rounded btn-sm" href="javascript:void(0)" title="View" onclick="view($1)"> <span class="fa fa-eye"></span></a>
			</div>', 'nis');
		return $this->datatables->generate();
	}	

}

/* End of file M_siswa.php */
/* Location: ./application/models/M_siswa.php */