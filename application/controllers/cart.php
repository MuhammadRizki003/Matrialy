<?php
class Cart extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_user_login();
    }
    public function tambah_ke_keranjang($id)
    {
        $qty        =     $this->input->post('qty');
        $produk = $this->model_produk->cari($id);
        foreach ($this->cart->contents() as $cart) {
            if ($cart['id'] == $id) {
                if ($cart['qty'] + $qty > $cart['stok']) {
                    $this->session->set_flashdata(
                        'message',
                        '<div class= "pt-2 pl-3 pr-3"><div class="alert alert-danger mx-auto" align="center" role="alert"><strong>Semua stok yang tersisa telah anda masukan ke keranjang</strong></div></div>'
                    );
                    redirect('home');
                }
            }
        }
        $data = array(
            'id'      => $id,
            'qty'     => $qty,
            'price'   => $produk->harga,
            'name'    => $produk->nama_produk,
            'gambar'  => $produk->gambar,
            'stok'      => $produk->stok
        );
        if ($qty > $produk->stok) {
            $this->session->set_flashdata(
                'message',
                '<div class= "pt-2 pl-3 pr-3"><div class="alert alert-danger mx-auto" align="center" role="alert"><strong>Stok Tersisa hanya ' . $produk->stok . '</strong></div></div>'
            );
            redirect('home/index');
        } else {

            $this->cart->insert($data);
            $this->session->set_flashdata(
                'message',
                '<div class= "pt-2 pl-3 pr-3"><div class="alert alert-success mx-auto" align="center" role="alert"><strong>Produk ditambahkan ke Keranjang</strong></div></div>'
            );
            redirect('home/index');
        }
    }

    public function update_keranjang()
    {
        $row = $this->input->post('rowid');
        $qty = $this->input->post('qty');
        $stok = $this->input->post('stok');
        $cart = $this->cart->contents();
        if ($qty > $cart[$row]['stok']) {
            $this->session->set_flashdata(
                'messageErr',
                $cart[$row]['name'] . ' hanya tersisa sebanyak ' . $cart[$row]['stok']
            );
        } else {
            if (strpos($qty, '.')) {
                $this->session->set_flashdata(
                    'message',
                    '<div class= "pt-2 pl-3 pr-3"><div class="alert alert-danger mx-auto" align="center" role="alert"><strong>Jumlah barang tidak bisa desimal!.</strong></div></div>'
                );
            } else {
                $data = array(
                    'rowid' => $row,
                    'qty' => $qty
                );
                $this->cart->update($data);
            }
        }
        redirect('cart/detail_keranjang');
    }

    public function tambah_prd($row)
    {
        $cart = $this->cart->contents();
        $qtyAwal = $cart[$row]['qty'];
        $qtyUbah = $qtyAwal + 1;
        if ($qtyUbah <= $cart[$row]['stok']) {
            $data = array(
                'rowid' => $row,
                'qty' => $qtyUbah
            );
            $this->cart->update($data);
            redirect('cart/detail_keranjang');
        } else {
            $this->session->set_flashdata(
                'messageErr',
                $cart[$row]['name'] . ' hanya tersisa sebanyak ' . $cart[$row]['stok']
            );
            redirect('cart/detail_keranjang');
        }
    }
    public function kurang_prd($row)
    {
        $cart = $this->cart->contents();
        $qtyAwal = $cart[$row]['qty'];
        $qtyUbah = $qtyAwal - 1;
        if ($qtyUbah <= 0) {
            $this->cart->remove($row);
            redirect('cart/detail_keranjang');
        } else {
            $data = array(
                'rowid' => $row,
                'qty' => $qtyUbah
            );
            $this->cart->update($data);
            redirect('cart/detail_keranjang');
        }
    }

    public function detail_keranjang()
    {

        $data['title'] = 'Keranjang';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('keranjangBaru');
        $this->load->view('templates/footer');
    }


    public function hapus_keranjang()
    {
        $this->cart->destroy();
        $this->session->set_flashdata(
            'message',
            '<div class= "pt-2 pl-3 pr-3"><div class="alert alert-danger mx-auto" align="center" role="alert"><strong>Produk di hapus dari keranjang !</strong></div></div>'
        );
        redirect('home/index');
    }
    public function pemesanan()
    {
        if ($this->cart->total_items() == 0) {
            redirect('home');
        } else {
            $data['title'] = 'Pembayaran';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar');
            $this->load->view('pemesanan');
            $this->load->view('templates/footer');
        }
    }

    public function hapus_item_keranjang($rowid)
    {
        $this->cart->remove($rowid);
        $this->session->set_flashdata(
            'message',
            '<div class= "pt-2 pl-3 pr-3"><div class="alert alert-danger mx-auto" align="center" role="alert"><strong>Produk di hapus dari keranjang !</strong></div></div>'
        );
        redirect('cart/detail_keranjang');
    }


    public function proses_pesanan()
    {
        if ($this->cart->total_items() == 0) {
            redirect('order/pesanan');
        } else {
            $is_processed = $this->model_invoice->index();
            if ($is_processed) {
                $this->cart->destroy();
                $this->session->set_flashdata(
                    'message',
                    '<div class= "pt-2 pl-3 pr-3"><div class="alert alert-success mx-auto" align="center" role="alert">Pesanan di Proses! Silahkan Lakukan Pembayaran Pada menu<strong>Pesanan Saya</strong></div></div>'
                );
                redirect('order/pesanan');
            } else {
                echo 'Maaf, Pesanan anda Gagal Diproses!';
            }
        }
    }
}
