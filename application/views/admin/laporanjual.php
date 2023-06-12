<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper prinin">
    <!-- Content Header (Page header) -->
    <div class="container-fluid">
        <div class="pb-2 pt-2">
            <h3 class="ml-3">Laporan Produk Terjual</h3>
        </div>
    </div><!-- /.container-fluid -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <form action="<?php echo base_url('admin/invoice/LaporanJualPerbulan/') ?>" method="get" class="no-print col-lg-4 col-md-6 col-9 ">
                    <div class="form-group col-12">
                        <div class="row">
                            <div class="col-9">
                                <input type="text" class="form-control datetimepicker-input" name="bln" id="bln" data-toggle="datetimepicker" data-target="#datetimepicker5" placeholder="Rekap Data" autocomplete="off">
                            </div>
                            <div class="col-3">
                                <button type="submit" class="btn btn-primary col-12 ">Cari</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="col-lg-8 col-md-6 col-3 no-print">
                    <div class="row">
                        <button class="btn btn-primary col-lg-2 col-md-4 col-7 mt-2 ml-auto" onclick=" window.print(); ">Print</button>
                    </div>
                </div>
            </div>
            <table class="table">
                <tr>
                    <td class="table-dark" scope="col">Nama Produk</td>
                    <td align="center" class="table-dark " scope="col">Terjual</td>
                    <td align="right" class="table-dark" scope="col">Harga</td>
                    <td align="right" class="table-dark" scope="col">SubTotal</td>
                </tr>
                <?php
                $total = 0;
                foreach ($produk as $prd) :
                    $jumlah = 0;
                    $nama = " ";
                    foreach ($pesanan as $psn) :
                        if ($psn->nama_produk == $prd->nama_produk and $psn->nama_produk != $nama) :
                            $nama = $prd->nama_produk;
                            if ($psn->jumlah != 0) : ?>
                                <tr>
                                    <td>
                                        <img class="mr-2 no-print" style=" width: 3rem;" src="<?php echo base_url('/assets/gambar/upload/') . $prd->gambar ?>"><?php echo  $prd->nama_produk ?>
                                    </td>
                                <?php
                            endif;
                                ?>
                                <?php
                                foreach ($pesanan as $psn) :
                                    if ($psn->nama_produk == $nama) :
                                        $jumlah += $psn->jumlah;
                                        $subtotal = $prd->harga * $jumlah;
                                    endif;
                                endforeach;
                                $total += $subtotal;
                                ?>
                                <td align="center"><?php echo $jumlah ?></td>
                                <td align="right">Rp.<?php echo number_format($prd->harga, 0, ',', '.') ?></td>
                                <td align="right">Rp.<?php echo number_format($subtotal, 0, ',', '.') ?></td>
                                </tr>

                    <?php
                        endif;
                    endforeach;
                endforeach; ?>
                    <tr>
                        <td class="table-dark" align="left" colspan="2">
                            <div class="only-print "><?php echo $bulan ?></div>
                        </td>
                        <td class="table-dark" align="right">Total</td>
                        <td class="table-dark" align="right" scope="col">Rp.<?php echo number_format($total, 0, ',', '.') ?></td>
                    </tr>
            </table>
        </div>
    </section>
</div>