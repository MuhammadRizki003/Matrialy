<?php
class Kategori extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}


	public function peralatan()
	{
		$data['produk'] = $this->model_kategori->data_peralatan()->result();
		$data['title'] = 'Kategori - Peralatan';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
		$this->load->view('templates/sidebar');
		$this->load->view('home', $data);
		$this->load->view('templates/footer');
	}


	public function cat()
	{
		$data['produk'] = $this->model_kategori->data_cat()->result();
		$data['title'] = 'Kategori - Cat';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
		$this->load->view('templates/sidebar');
		$this->load->view('home', $data);
		$this->load->view('templates/footer');
	}


	public function lainnya()
	{
		$data['produk'] = $this->model_kategori->data_lainnya()->result();
		$data['title'] = 'Kategori - Lainnya';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
		$this->load->view('templates/sidebar');
		$this->load->view('home', $data);
		$this->load->view('templates/footer');
	}
}
