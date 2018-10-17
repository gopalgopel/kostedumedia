<?php

require_once('generic_dao.php');

class kosan_dao extends Generic_dao  {
	
	public function table_name(){
		return 'kosan';
	}

	public function field_map() {
		return array (
			'id_kosan'=>'id_kosan',
			'nama_kosan'=>'nama_kosan',
			'alamat'=>'alamat',
			'fasum'=>'fasum',
			'foto_kosan'=>'foto_kosan',
			'kontak'=>'kontak',
			'lokasi'=>'lokasi',
			'kamarmandi'=>'kamarmandi',
			'deskripsilokasi'=>'deskripsilokasi',
			'deskripsi'=>'deskripsi',
			'id_pengguna'=>'id_pengguna',
			'lat'=>'lat',
			'lon'=>'lon'
		);
	}

	public function __construct() {
		parent::__construct();
	}

	function getDaftarKosan($id_user) {
		$limit = 100;
		$offset = 0;
		return $this->fetch($limit, $offset, 'nama_kosan', array('id_pengguna' => $id_user));
	}

	function getKosans() {
		$limit = 1000;
		$offset = 0;
		return $this->fetch($limit, $offset, 'nama_kosan');
	}

	function getInfoKosan($id_kosan) {
		return $this->by_id(array('id_kosan' => $id_kosan));
	}

	function saveNewKosan($obj) {
		return $this->insert($obj);
	}

	function editKosan($id, $obj) {
		return $this->update($obj, array('id_kosan' => $id));
	}

	function getAllKosan() {
		$this->ci->db->select('*');
		$this->ci->db->from('kamar RIGHT JOIN kosan ON (kamar.id_kosan = kosan.id_kosan)
				LEFT JOIN penghuni ON (kamar.id_penghuni = penghuni.id_penghuni)
		');
		
		$this->ci->db->order_by('kosan.id_kosan', 'asc');
		$this->ci->db->order_by('kamar.id_kamar', 'asc');
		$q = $this->ci->db->get();
		return $q->result();
	}
}

?>