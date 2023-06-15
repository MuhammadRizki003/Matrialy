<?php
class Model_invoice extends CI_Model
{
	public function index()
	{
		date_default_timezone_set('Asia/Jakarta');
		$nama_pemesan		= $this->input->post('nama');
		$alamat				= $this->input->post('alamat');
		$no_tlp				= $this->input->post('no_tlp');
		$id_user 			= $this->session->userdata('id_user');
		$invoice 			= array(
			'nama_pemesan'		=> $nama_pemesan,
			'alamat'			=> $alamat,
			'no_tlp'			=> $no_tlp,
			'tgl_pesan'			=> date('y-m-d H:i:s'),
			'keterangan'		=> 'Menunggu Pembayaran',
			'status'			=> 'Belum Dibayar',
			'id_user'			=> $id_user
		);
		$this->db->insert('tb_invoice', $invoice);
		$id_invoice = $this->db->insert_id();
		foreach ($this->cart->contents() as $items) {
			$data = array(
				'id_invoice'	=> $id_invoice,
				'id_produk'		=> $items['id'],
				'nama_produk'	=> $items['name'],
				'jumlah'		=> $items['qty'],
				'harga'			=> $items['price']
			);
			$this->db->insert('tb_pesanan', $data);
			$jmlUp = $items['qty'];
			$idUp = $items['id'];
			$this->db->query("update tb_produk set stok=stok-'$jmlUp' where id_produk = '$idUp'");
		}
		return TRUE;
	}
	public function tampilData()
	{
		$result = $this->db->from('tb_invoice')->order_by('id_invoice', 'desc')->get();
		return $result->result();
	}
	public function ambil_id_invoice($id_invoice)
	{
		$result = $this->db->where('id_invoice', $id_invoice)->limit(1)->get('tb_invoice');
		if ($result->num_rows() > 0) {
			return $result->row();
		} else {
			return false;
		}
	}
	public function ambil_id_pesanan($id_invoice)
	{
		// $result = $this->db->where('id_invoice',$id_invoice)->get('tb_pesanan');
		$result = $this->db->select('*')->from('tb_pesanan')->where('id_invoice', $id_invoice)->join('tb_produk', 'tb_produk.id_produk = tb_pesanan.id_produk')->get();
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return false;
		}
	}
	public function pesananku($id_user)
	{
		$result = $this->db->where('id_user', $id_user)->order_by('id_invoice', 'desc')->get('tb_invoice');
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return false;
		}
	}
	public function bayar($data, $table)
	{
		$this->db->insert($table, $data);
	}
	public function update_data($where, $update, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $update);
	}
	public function ambil_bukti($id_invoice)
	{
		$result = $this->db->where('id_invoice', $id_invoice)->get('tb_buktibayar');
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return false;
		}
	}

	public function dataPesanan($id)
	{
		$result = $this->db->query("select inv.id_invoice, pe.id_produk, pe.nama_produk,pe.jumlah,pe.harga,pr.gambar from tb_invoice as inv, tb_pesanan as pe, tb_produk as pr where inv.id_user='$id' and inv.id_invoice = pe.id_invoice and pe.id_produk= pr.id_produk ;")->result();
		return $result;
	}
	public function ambilPesanan($id)
	{
		$result = $this->db->from('tb_pesanan')->where('id_invoice', $id)->get();
		return $result->result();
	}
	public function ambilBerdasarkan($ket)
	{
		$lol = str_replace('_', ' ', $ket);
		$ket = $lol;
		$result = $this->db->from('tb_invoice')->where('status', $ket)->or_where('keterangan', $ket)->order_by('id_invoice', 'desc')->get();
		return $result->result();
	}
	public function dataBulan($cari)
	{
		$result = $this->db->from('tb_invoice')->like('tgl_pesan', $cari)->where('keterangan', 'Barang Sampai')->order_by('id_invoice', 'desc')->get();
		return $result->result();
	}
	public function dataDetail()
	{
		$result = $this->db->from('tb_pesanan')->get();
		return $result->result();
	}
	public function produk()
	{
		$result = $this->db->from('tb_produk')->get()->result();
		return $result;
	}
	public function produkTerjual()
	{
		$result = $this->db->query('select inv.tgl_pesan, inv.keterangan, pe.jumlah, pe.nama_produk from tb_invoice as inv,tb_pesanan as pe where inv.keterangan="Barang Sampai" and inv.id_invoice=pe.id_invoice;')->result();
		return $result;
	}
	public function produkTerjualBln($tgl)
	{
		$result = $this->db->query('select inv.tgl_pesan, inv.keterangan, pe.jumlah, pe.nama_produk from tb_invoice as inv,tb_pesanan as pe where inv.keterangan="Barang Sampai" and inv.id_invoice=pe.id_invoice and inv.tgl_pesan like "%' . $tgl . '%";')->result();
		return $result;
	}
	
	public function hapusInvoice($id)
	{
		$where = array('id_invoice' => $id);
		$update = $this->db->query("select id_produk, jumlah from tb_pesanan where id_invoice = '$id'")->result_array();
		foreach ($update as $up) {
			$jmlup = $up['jumlah'];
			$idup = $up['id_produk'];
			$this->db->query("update tb_produk set stok=stok+'$jmlup' where id_produk = '$idup';");
		}
		$this->db->where($where)->delete('tb_invoice');
		$this->db->where($where)->delete('tb_pesanan');
		redirect('admin/invoice');
	}
}
