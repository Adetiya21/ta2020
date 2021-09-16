<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_jadwal extends CI_Model {

	var $table = 'tb_jadwal';

	public function json($id_kelas) {
		$this->datatables->select('tb_jadwal.id, tb_jadwal.id_kelas, tb_jadwal.nip_guru,
			tb_jadwal.hari,
			CONCAT(tb_jadwal.jam_masuk," s/d ",tb_jadwal.jam_selesai) as jam,
			tb_guru.nama,
			tb_kelas.nama_kelas,
			tb_mapel.nama_mapel
			');
		$this->datatables->from($this->table);
		$this->datatables->join('tb_guru', 'tb_jadwal.nip_guru=tb_guru.nip');
		$this->datatables->join('tb_kelas', 'tb_jadwal.id_kelas=tb_kelas.id');
		$this->datatables->join('tb_mapel', 'tb_guru.id_mapel=tb_mapel.id');
		$this->datatables->where('tb_jadwal.id_kelas', $id_kelas);
		$this->datatables->add_column('view', '<div align="center">
			<a class="btn btn-warning btn-rounded btn-sm" href="javascript:void(0)" title="Edit" onclick="edit($1)"> <span class="fa fa-edit"></span></a>
			<a class="btn btn-danger btn-rounded btn-sm" href="javascript:void(0)" title="Hapus" onclick="hapus($1)" > <span class="fa fa-trash"></span></a>
			</div>', 'id');
		return $this->datatables->generate();
	}

	public function json_siswa() {
		$this->datatables->select('tb_jadwal.id, tb_jadwal.id_kelas, tb_jadwal.nip_guru,
			tb_jadwal.hari,
			CONCAT(tb_jadwal.jam_masuk," s/d ",tb_jadwal.jam_selesai) as jam,
			tb_guru.nama,
			tb_kelas.nama_kelas,
			tb_mapel.nama_mapel
			');
		$this->datatables->from($this->table);
		$this->datatables->join('tb_guru', 'tb_jadwal.nip_guru=tb_guru.nip');
		$this->datatables->join('tb_kelas', 'tb_jadwal.id_kelas=tb_kelas.id');
		$this->datatables->join('tb_mapel', 'tb_guru.id_mapel=tb_mapel.id');
		$this->datatables->where('tb_jadwal.id_kelas', $this->session->userdata('id_kelas'));
		return $this->datatables->generate();
	}

	public function json_guru() {
		$this->datatables->select('tb_jadwal.id, tb_jadwal.id_kelas, tb_jadwal.nip_guru,
			tb_jadwal.hari,
			CONCAT(tb_jadwal.jam_masuk," s/d ",tb_jadwal.jam_selesai) as jam,
			tb_guru.nama,
			tb_kelas.nama_kelas,
			tb_mapel.nama_mapel
			');
		$this->datatables->from($this->table);
		$this->datatables->join('tb_guru', 'tb_jadwal.nip_guru=tb_guru.nip');
		$this->datatables->join('tb_kelas', 'tb_jadwal.id_kelas=tb_kelas.id');
		$this->datatables->join('tb_mapel', 'tb_guru.id_mapel=tb_mapel.id');
		$this->datatables->where('tb_jadwal.nip_guru', $this->session->userdata('nip'));
		return $this->datatables->generate();
	}

}

/* End of file M_jadwal.php */
/* Location: ./application/models/M_jadwal.php */