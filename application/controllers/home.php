<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		user_only();
	}


	public function index()
	{
		$data['produk'] = $this->model_produk->tampilData()->result();
		$data['title'] = 'Matrialy Home';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
		$this->load->view('templates/sidebar');
		$this->load->view('home', $data);
		$this->load->view('templates/footer');
	}

	public function cari_barang()
	{
		$kata = $this->input->post('cari');
		$data['produk'] = $this->model_produk->cari_produk($kata);
		$data['title'] = 'Hasil Pencarian';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
		$this->load->view('templates/sidebar');
		$this->load->view('home', $data);
		$this->load->view('templates/footer');
	}
}
