<div class="content-wrapper">
    <div class="content-header">
        <div class=" card  mx-auto col-12 mb-5 mt-1 ml-5">
            <img src="<?php echo base_url('assets/gambar/logo/logo_white_large.png') ?>" alt="AdminLTE Logo" class="col-6 "><br>
            <div class="ml-3 mr-3">

                Pesanan anda akan segera kami proses setelah pembayaran terverifikasi
                <br>
                <table>
                    <tr>
                        <td>-</td>
                        <td width="50px" align="center">BCA</td>
                        <td>123901249421</td>
                        <td width="30px" align="center">a/n</td>
                        <td>PT.Matrialy Sumber Jaya</td>
                    </tr>
                    <tr>
                        <td>-</td>
                        <td width="50px" align="center">BRI</td>
                        <td>192890829809</td>
                        <td width="30px" align="center">a/n</td>
                        <td>PT.Matrialy Sumber Jaya</td>
                    </tr>
                    <tr>
                        <td>-</td>
                        <td width="50px" align="center">BNI</td>
                        <td>123901241241</td>
                        <td width="30px" align="center">a/n</td>
                        <td>PT.Matrialy Sumber Jaya</td>
                    </tr>
                </table>
                <div class="titik">
                    <h5>..........................................................................................................................................................................................................................................................................................................................................................................................................</h5>
                    <table class="col-12 table table-borderless table-sm">
                        <tr>
                            <td>Nama Produk</td>
                            <td align="center">Jumlah</td>
                            <td align="right" colspan="2">Harga</td>
                            <td align="right" colspan="2">Subtotal</td>
                        </tr>
                        <?php
                        $nomor = 1;
                        $total = 0;
                        foreach ($pesanan as $psn) {
                            $subtotal = $psn->jumlah * $psn->harga;
                            $total += $subtotal; ?>
                            <tr>
                                <td><?php echo $psn->nama_produk ?></td>
                                <td align="center"><?php echo $psn->jumlah ?></td>
                                <td align="right">Rp.</td>
                                <td align="right"><?php echo number_format($psn->harga, 0, ',', '.') ?></td>
                                <td align="right">Rp.</td>
                                <td align="right"><?php echo number_format($subtotal, 0, ',', '.') ?></td>
                            </tr>
                        <?php
                            $nomor++;
                        }; ?>
                    </table>
                    <div class="titik ">
                        <h5>..........................................................................................................................................................................................................................................................................................................................................................................................................</h5>
                        <table class="col-6 table table-borderless table-sm ml-auto">
                            <tr>
                                <td>Total Produk</td>
                                <td align="right"><?php echo $nomor - 1; ?></td>
                            </tr>
                            <tr>
                                <td>Total Belanja</td>
                                <td align="right">Rp.<?php echo number_format($total, 0, ',', '.'); ?></td>
                            </tr>

                        </table>
                        Upload Bukti Pembayaran Di sini :
                        <form action="<?php echo base_url('order/bayar') ?>" method=post enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="hidden" name="id_invoice" value="<?php echo $id; ?>">
                                <img id="preview" src="" alt="" class="col-lg-3 col-md-4 col-12 mx-auto mt-2">
                                <div class="row mt-2">
                                    <input type="file" onchange="previewGambar()" name="gambar" id='gambar' class="form-control-file btn btn-dark col-9" required>
                                    <button type="submit" class="btn btn-success col-3">kirim</button>
                                </div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
