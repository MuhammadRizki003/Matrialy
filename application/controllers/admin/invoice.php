<?php
class Invoice extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('role_id') != "1") {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Akses Ditolak, Silahkan Login!!!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('auth/index');
		}
	}


	public function index()
	{
		$data['title']	 = 'Invoice';
		$data['sortBy'] = 'Semua Transaksi';
		$data['invoice'] = $this->model_invoice->tampilData();
		$data['pesanan'] = $this->model_invoice->dataDetail();
		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('templates_admin/navbar');
		$this->load->view('admin/invoice', $data);
		$this->load->view('templates_admin/footer');
	}


	public function detail($id_invoice)
	{
		$data['title']	 = 'Invoice';
		$data['invoice'] = $this->model_invoice->ambil_id_invoice($id_invoice);
		$data['pesanan'] = $this->model_invoice->ambil_id_pesanan($id_invoice);
		$data['bukti']	 = $this->model_invoice->ambil_bukti($id_invoice);
		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('templates_admin/navbar');
		$this->load->view('admin/detail_invoice', $data);
		$this->load->view('templates_admin/footer');
	}

	public function hapus($id_invoice)
	{
		$where = array('id_invoice' => $id_invoice);
		$this->model_invoice->hapusInvoice($where);
	}

	public function konfirmasi($id_invoice)
	{
		$data = array(
			'keterangan' => 'Proses Pengiriman',
			'status' 	 =>	'Pembayaran Berhasil'
		);
		$where = array(
			'id_invoice' => $id_invoice
		);
		$this->model_invoice->update_data($where, $data, 'tb_invoice');
		$this->session->set_flashdata(
			'message',
			'<div class= "pt-2 pl-3 pr-3"><div class="alert alert-success mx-auto" align="center" role="alert"><strong>Pembayaran Dikonfirmasi !</strong></div></div>'
		);
		redirect('admin/invoice/sortirData/Sedang_Diproses');
	}


	public function selesai($id_invoice)
	{
		$data = array(
			'keterangan' => 'Barang Sampai'
		);
		$where = array(
			'id_invoice' => $id_invoice
		);
		$this->model_invoice->update_data($where, $data, 'tb_invoice');
		$this->session->set_flashdata(
			'message',
			'<div class= "pt-2 pl-3 pr-3"><div class="alert alert-success mx-auto" align="center" role="alert"><strong>Transaksi Selesai !</strong></div></div>'
		);
		redirect('admin/invoice/sortirData/Proses_Pengiriman');
	}
	public function sortirData($ket)
	{
		$data['title']	 = 'Invoice';
		$ket = str_replace('_', ' ', $ket);
		$data['sortBy'] = 'Transaksi Berdasarkan ' . $ket;
		$data['invoice'] = $this->model_invoice->ambilBerdasarkan($ket);
		$data['pesanan'] = $this->model_invoice->dataDetail();
		$this->tampilkan($data);
	}
	public function monthly()
	{
		$data['title']	 = 'Invoice';
		if ($this->input->get('bln') == "") {
			$this->index();
		} else {
			$cari = $this->input->get('bln');
			$data['sort'] = $cari;
			$data['invoice'] = $this->model_invoice->dataBulan($cari);
			$data['pesanan'] = $this->model_invoice->dataDetail();
			$this->tampilkan($data);
		}
	}
	private function tampilkan($data)
	{
		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('templates_admin/navbar');
		$this->load->view('admin/invoice', $data);
		$this->load->view('templates_admin/footer');
	}

	// Laporan Barang Terjual

	public function laporanJual()
	{
		$data['title'] = 'Laporan Barang Terjual';
		$data['bulan'] = 'Semua Data Barang Terjual';
		$data['produk'] = $this->model_invoice->produk();
		$data['pesanan'] = $this->model_invoice->produkTerjual();
		$this->tampilJual($data);
	}
	public function laporanJualPerbulan()
	{
		$data['title']	 = 'Laporan Barang Terjual';
		if ($this->input->get('bln') == '') {
			$this->laporanJual();
		} else {
			$cari = $this->input->get('bln');
			$data['bulan'] = $cari;
			$data['produk'] = $this->model_invoice->produk();
			$data['pesanan'] = $this->model_invoice->produkTerjualBln($cari);
			$this->tampilJual($data);
		}
	}
	private function tampilJual($data)
	{
		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('templates_admin/navbar');
		$this->load->view('admin/laporanjual', $data);
		$this->load->view('templates_admin/footer');
	}
}
