<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kelas extends CI_Model {

	var $table = 'tb_kelas';

	public function json() {
		$this->datatables->select('tb_kelas.id,
			tb_kelas.nama_kelas,
			');
		$this->datatables->from($this->table);
		$this->datatables->add_column('view', '<div align="center">
			<a class="btn btn-warning btn-rounded btn-sm" href="javascript:void(0)" title="Edit" onclick="edit($1)"> <span class="fa fa-edit"></span></a>
			<a class="btn btn-danger btn-rounded btn-sm" href="javascript:void(0)" title="Hapus" onclick="hapus($1)" > <span class="fa fa-trash"></span></a>
			</div>', 'id');
		return $this->datatables->generate();
	}

}

/* End of file M_kelas.php */
/* Location: ./application/models/M_kelas.php */