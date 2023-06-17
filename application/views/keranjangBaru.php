<div class="content-wrapper">
    <div class="content-header mb-2">
        <div class="container-fluid">
            <h3 class="m-0"><i class="fas fa-shopping-cart mr-2"></i>Keranjang</h3>
        </div>
    </div>
    <?php echo $this->session->flashdata('message') ?>
    <?php
    if ($this->cart->total() != 0) : ?>
        <div class="content">
            <table class="table table-stripped table-responsive-sm">
                <tr>

                    <td>Nama Produk</td>
                    <td align="right">Harga</td>
                    <td align="right" class="andro-hidden">Sub-total</td>
                    <td></td>
                </tr>
                <?php
                $nomer = 1;
                foreach ($this->cart->contents() as $items) : ?>
                    <tr>
                        <td colspan="4"><img class="img-thumbnail border-dark bg-dark mr-2" style="width:5rem;" src="<?php echo base_url('/assets/gambar/upload/' . $items['gambar']) ?>"><?php echo $items['name'] ?></td>
                    </tr>
                    <tr>
                        <form action="<?= base_url('cart/update_keranjang') ?>" method="POST" id="form<?php echo $nomer; ?>">
                            <td align="center" width='300px' style="border: 0px;">
                                <input type="hidden" name="stok" value="<?php echo $items['stok'] ?>">
                                <input type="hidden" name="rowid" value="<?= $items['rowid'] ?>">
                                <div class="row col-12 display-hp">
                                    <a href="<?php echo base_url('cart/kurang_prd/' . $items['rowid']) ?>" class="btn btn-outline-secondary text-center text-light col-lg-3 col-md-4 col-3">-</a>
                                    <input type="number" min="1" name="qty" value='<?php echo $items['qty']; ?>' id="<?php echo $items['id']; ?>" class="form-control text-center col-lg-6 col-md-4 col-6" onchange="javascript: edit('form<?php echo $nomer; ?>')" style="background-color: transparent;">
                                    <a href="<?php echo base_url('cart/tambah_prd/' . $items['rowid']) ?>" class="btn  btn-outline-secondary text-center text-light col-lg-3 col-md-4 col-3 ">+</a>
                                </div>
                            </td>
                        </form>
                        <td align="right" style="border: 0px;">Rp.<?php echo number_format($items['price'], 0, ',', '.') ?></td>
                        <td align="right" style="border: 0px;" class="andro-hidden">Rp.<?php echo number_format($items['price'] * $items['qty'], 0, ',', '.') ?></td>
                        <td align="center" width="70px" style="border: 0px;"><?php echo anchor('cart/hapus_item_keranjang/' . $items['rowid'], '<div class="btn btn-sm btn-danger col-12"><i class="fa fa-trash"></i></div>') ?></td>
                    </tr>
                <?php $nomer++;
                endforeach; ?>
                <tr>
                    <td class="andro-hidden"></td>
                    <td colspan="2" align="right">Rp. <?php echo number_format($this->cart->total(), 0, ',', '.') ?></td>
                    <td></td>
                </tr>
            </table>
            <div align="right">

            </div>
        </div>

        <div class="container-fluid">
            <div class="row">

                 <div class="col-4">
                    <button type="button" onclick="javascript: hapusCart(0)" class="btn  btn-block btn-danger text-center">Hapus keranjang</button>
                </div>
                <div class="col-4">
                    <a href="<?php echo base_url('home/index') ?>" class="btn  btn-block btn-primary">Tambah barang Lagi</a>
                </div>
                <div class="col-4">
                    <a href="<?php echo base_url('cart/pemesanan') ?>" class="btn  btn-block btn-success">Proses&nbspPembayaran</a>
                </div>
            <?php
        else : ?>
                <div class="content">
                    <div class="row col-12 mb-1">
                        <img class="col-xl-2 col-lg-4 col-md-6 col-8 mx-auto" src="<?php echo base_url('/assets/gambar/cartKosong.png') ?>">
                    </div>
                    <div class="row col-12 ml-1">
                        <div class="col-xl-2  col-lg-4 col-md-6 col-8 pl-4 pr-5 mx-auto">
                            <a href="<?php echo base_url('home/index') ?>" class="btn  btn-block btn-primary" style="border-radius: 15px;">Mulai Pilih produk</a>
                        </div>
                    </div>
                </div>
            <?php
        endif; ?>
            </div>
            <!-- </form> -->
        </div>

        <!-- Modal -->
        <div class="modal fade" id="test123" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-danger" style="background: #E74C3C;">
                    <div class="modal-body mt-2 text-center text-md">
                        Mohon maaf, <?php echo $this->session->flashdata('messageErr') ?> buah
                    </div>
                    <button type="button" class="btn btn-danger btn-lg text-md col-12 text-center text-light pb-3" data-dismiss="modal" style="border-radius: 0px; background:transparent; border:0px;"><strong>OK</strong> </button>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="modalHapus" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body mt-2 mb-2 text-center text-md">
                        <div>Yakin ingin menghapus semua barang di keranjang?</div>
                        <div class="row col-12 mt-4 ">
                            <button type="button" class="btn mx-auto btn-primary btn-lg text-md col-5 text-center text-light" onclick="javascript: hapusCart(1)">Batal</button>
                            <button onclick="location.href='<?php echo base_url('cart/hapus_keranjang') ?>'" class="btn mx-auto btn-danger btn-lg text-md col-5 text-center text-light" id="countHapus" disabled>Tunggu 3 detik</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
