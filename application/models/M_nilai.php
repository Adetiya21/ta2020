<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_nilai extends CI_Model {

	var $table = 'tb_nilaisiswa';

	public function json_guru() {
		$this->datatables->select('tb_nilaisiswa.id as id_nilai, tb_nilaisiswa.nis, tb_nilaisiswa.id_kelas, tb_nilaisiswa.id_mapel,
			tb_nilaisiswa.h1, tb_nilaisiswa.h2, tb_nilaisiswa.h3, tb_nilaisiswa.uts, tb_nilaisiswa.uas, tb_nilaisiswa.total, tb_nilaisiswa.rata,
			tb_siswa.nama,
			tb_kelas.id, tb_kelas.nama_kelas,
			tb_mapel.id, tb_mapel.nama_mapel
			');
		$this->datatables->from($this->table);
		$this->datatables->join('tb_siswa', 'tb_nilaisiswa.nis=tb_siswa.nis');
		$this->datatables->join('tb_kelas', 'tb_nilaisiswa.id_kelas=tb_kelas.id');
		$this->datatables->join('tb_mapel', 'tb_nilaisiswa.id_mapel=tb_mapel.id');
		$this->datatables->where('tb_nilaisiswa.id_mapel', $this->session->userdata('id_mapel'));
		$this->datatables->where('tb_nilaisiswa.id_kelas', $this->session->userdata('id_kelas'));
		$this->datatables->add_column('view', '<div align="center">
			<a class="btn btn-warning btn-rounded btn-sm" href="javascript:void(0)" title="Edit" onclick="edit($1)"> <span class="fa fa-edit"></span></a>
			</div>', 'id_nilai');
		return $this->datatables->generate();
	}

	public function jsonadmin($id_kelas,$id_mapel) {
		$this->datatables->select('tb_nilaisiswa.id as id_nilai, tb_nilaisiswa.nis, tb_nilaisiswa.id_kelas, tb_nilaisiswa.id_mapel,
			tb_nilaisiswa.h1, tb_nilaisiswa.h2, tb_nilaisiswa.h3, tb_nilaisiswa.uts, tb_nilaisiswa.uas, tb_nilaisiswa.total, tb_nilaisiswa.rata,
			tb_siswa.nama,
			tb_kelas.id, tb_kelas.nama_kelas,
			tb_mapel.id, tb_mapel.nama_mapel
			');
		$this->datatables->from($this->table);
		$this->datatables->join('tb_siswa', 'tb_nilaisiswa.nis=tb_siswa.nis');
		$this->datatables->join('tb_kelas', 'tb_nilaisiswa.id_kelas=tb_kelas.id');
		$this->datatables->join('tb_mapel', 'tb_nilaisiswa.id_mapel=tb_mapel.id');
		$this->datatables->where('tb_nilaisiswa.id_mapel', $id_mapel);
		$this->datatables->where('tb_nilaisiswa.id_kelas', $id_kelas);
		$this->datatables->add_column('view', '<div align="center">
			<a class="btn btn-warning btn-rounded btn-sm" href="javascript:void(0)" title="Edit" onclick="edit($1)"> <span class="fa fa-edit"></span></a>
			</div>', 'id_nilai');
		return $this->datatables->generate();
	}

	public function jsonguru($id_kelas) {
		$this->datatables->select('tb_nilaisiswa.id as id_nilai, tb_nilaisiswa.nis, tb_nilaisiswa.id_kelas, tb_nilaisiswa.id_mapel,
			tb_nilaisiswa.h1, tb_nilaisiswa.h2, tb_nilaisiswa.h3, tb_nilaisiswa.uts, tb_nilaisiswa.uas, tb_nilaisiswa.total, tb_nilaisiswa.rata,
			tb_siswa.nama,
			tb_kelas.id, tb_kelas.nama_kelas,
			tb_mapel.id, tb_mapel.nama_mapel
			');
		$this->datatables->from($this->table);
		$this->datatables->join('tb_siswa', 'tb_nilaisiswa.nis=tb_siswa.nis');
		$this->datatables->join('tb_kelas', 'tb_nilaisiswa.id_kelas=tb_kelas.id');
		$this->datatables->join('tb_mapel', 'tb_nilaisiswa.id_mapel=tb_mapel.id');
		$this->datatables->where('tb_nilaisiswa.id_mapel', $this->session->userdata('id_mapel'));
		$this->datatables->where('tb_nilaisiswa.id_kelas', $id_kelas);
		$this->datatables->add_column('view', '<div align="center">
			<a class="btn btn-warning btn-rounded btn-sm" href="javascript:void(0)" title="Edit" onclick="edit($1)"> <span class="fa fa-edit"></span></a>
			</div>', 'id_nilai');
		return $this->datatables->generate();
	}

	public function json_siswa() {
		$this->datatables->select('tb_nilaisiswa.id as id_nilai, tb_nilaisiswa.nis, tb_nilaisiswa.id_kelas, tb_nilaisiswa.id_mapel,
			tb_nilaisiswa.h1, tb_nilaisiswa.h2, tb_nilaisiswa.h3, tb_nilaisiswa.uts, tb_nilaisiswa.uas, tb_nilaisiswa.total, tb_nilaisiswa.rata,
			tb_siswa.nama,
			tb_kelas.id, tb_kelas.nama_kelas,
			tb_mapel.id, tb_mapel.nama_mapel
			');
		$this->datatables->from($this->table);
		$this->datatables->join('tb_siswa', 'tb_nilaisiswa.nis=tb_siswa.nis');
		$this->datatables->join('tb_kelas', 'tb_nilaisiswa.id_kelas=tb_kelas.id');
		$this->datatables->join('tb_mapel', 'tb_nilaisiswa.id_mapel=tb_mapel.id');
		$this->datatables->where('tb_nilaisiswa.nis', $this->session->userdata('nis'));
		$this->datatables->where('tb_nilaisiswa.id_kelas', $this->session->userdata('id_kelas'));
		return $this->datatables->generate();
	}

}

/* End of file M_nilai.php */
/* Location: ./application/models/M_nilai.php */