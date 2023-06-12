<?php
class Order extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_user_login();
    }
    public function pesanan_saya()
    {
        $id_user = $this->session->userdata('id_user');
        $data['invoice'] = $this->model_invoice->pesananku($id_user);
        $this->session->set_flashdata(
            'pesanan',
            '<div class= "pt-2 pl-3 pr-3"><div class="alert alert-info mx-auto" align="center" role="alert"><strong>Anda belum memesan produk!</strong></div></div>'
        );
        $data['title'] = 'Pesanan Saya';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('pesanan', $data);
        $this->load->view('templates/footer');
    }


    public function detail_pesanan()
    {
        $id_invoice = $this->input->post('id');
        $data['pesanan'] = $this->model_invoice->ambil_id_pesanan($id_invoice);
        $data['title'] = 'Detail Pesanan';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('detail_pesanan', $data);
        $this->load->view('templates/footer');
    }


    public function bayar()
    {
        $id_invoice = $this->input->post('id_invoice');
        $gambar     = $_FILES['gambar']['name'];
        $config['upload_path'] = './assets/gambar/bayar';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $namaGambar = uniqid();
        $config['file_name'] = $namaGambar;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('gambar')) {
            $this->session->set_flashdata(
                'info',
                '<div class= "pt-2 pl-3 pr-3"><div class="alert alert-danger mx-auto" align="center" role="alert"><strong>Gambar Gagal Di Upload</strong></div></div>'
            );
            redirect('order/pesanan');
        } else {
            $gambar = $this->upload->data('file_name');
        }
        $data = array(
            'id_invoice'     => $id_invoice,
            'gambar'        => $gambar
        );
        $where = array(
            'id_invoice' => $id_invoice
        );
        $update = array(
            'status'     => 'Sedang Diproses',
            'keterangan' => 'Sedang Diproses'
        );
        $this->model_invoice->bayar($data, 'tb_buktibayar');
        $this->model_invoice->update_data($where, $update, 'tb_invoice');
        redirect('order/pesanan');
    }
    public function pesanan()
    {
        $id_user = $this->session->userdata('id_user');
        $data['invoice'] = $this->model_invoice->pesananku($id_user);
        $data['pesanan'] = $this->model_invoice->dataPesanan($id_user);
        $this->session->set_flashdata(
            'pesanan',
            '<div class= "pt-2 pl-3 pr-3"><div class="alert alert-info mx-auto" align="center" role="alert"><strong>Anda belum memesan produk!</strong></div></div>'
        );
        $data['title'] = 'Pesanan Saya';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('pesananku', $data);
        $this->load->view('templates/footer');
    }
    public function pembayaran($id)
    {
        $data['id'] = $id;
        $data['pesanan'] = $this->model_invoice->ambilPesanan($id);
        $data['title'] = 'Pembayaran Pesanan';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('pembayaran', $data);
        $this->load->view('templates/footer');
    }
}
