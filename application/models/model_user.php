<?php

class Model_user extends CI_Model{
	public function regis($data,$table){
		$this->db->insert($table,$data);
	}
	public function cari($where,$table){
		return $this->db->get_where($table,$where);
	}
	public function update_data($where,$update,$table){
		$this->db->where($where);
		$this->db->update($table,$update);
	}
	public function tampiluser(){
		return $this->db->get_where('tb_user',array('role_id' => 2));
	}
	public function tampilkota()
	{
		return $this->db->get("tb_ongkir");
	}
	public function cariDataAlamat($where)
	{
		$result = $this->db->get_where("tb_alamat", $where);
		if ($result->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	public function tambahAlamat($data, $table)
	{
		$this->db->insert($table, $data);
	}
	public function ubahAlamat($where, $update, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $update);
	}
	public function tampilAlamat($id)
	{
		$data = array('id_user' => $id);
		$result = $this->db->where($data)->get('tb_alamat');
		if ($result->num_rows() > 0) {
			return $result->row_array();
		} else {
			return false;
		}
	}
}
