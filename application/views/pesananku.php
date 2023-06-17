<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <h3 class="mb-1 ml-1"><i class="nav-icon fa fa-truck mr-3"></i>Pesanan Saya</h3>
    </div>
  </div>
  <div class="content">
    <div class="container-fluid">
      <?php
      foreach ($invoice as $inv) : ?>
        <div class="card">
          <div class="card-body">
            <h5 class="card-title white-text">Pemesan : <?php echo $inv->nama_pemesan; ?></h5><br>
            <div class="row col-12">
              <table class="col-xl-4 col-lg-5 col-md-6 col-12 mt-2">
                <?php
                $nomor = 1;
                $total = 0;
                foreach ($pesanan as $psn) {
                  $subtotal = $psn->jumlah * $psn->harga;
                  $total += $subtotal;
                  if ($psn->id_invoice == $inv->id_invoice) : ?>
                    <tr>
                      <td class="pb-2" style="width: 20% ; "><img class=" bg-dark col-12" src="<?php echo base_url('/assets/gambar/upload/' . $psn->gambar) ?>"></td>
                      <td class="ml-4">
                        <?php echo $psn->nama_produk; ?><br>
                        Rp. <?php echo number_format($psn->harga, 0, ',', '.') ?> x <?php echo $psn->jumlah ?><br>
                        Rp.<?php echo number_format($subtotal, 0, ',', '.') ?>
                      </td>
                    </tr>
                <?php
                  endif;
                }; ?>
              </table>
              <div class="col-xl-8 col-lg-7 col-md-6 col-12 mt-2 table table-borderless table-sm">
                <table class="col-xl-7 col-lg-9 col-md-11 col-12">
                  <tr>
                    <td>Alamat Pengiriman</td>
                    <td>:</td>
                    <td align="right"><?php echo $inv->alamat; ?></td>
                  </tr>
                  <tr>
                    <td>Nomor Telepon</td>
                    <td>:</td>
                    <td align="right"><?php echo $inv->no_tlp; ?></td>
                  </tr>
                  <tr>
                    <td>Tanggal Pemesanan</td>
                    <td>:</td>
                    <?php
                    $jam = explode(' ', $inv->tgl_pesan);
                    $tgl = explode('-', $jam[0]);
                    switch ($tgl[1]) {
                      case '1':
                        $bln = 'Januari';
                        break;
                      case '2':
                        $bln = 'Februari';
                        break;
                      case '3':
                        $bln = 'Maret';
                        break;
                      case '4':
                        $bln = 'April';
                        break;
                      case '5':
                        $bln = 'Mei';
                        break;
                      case '6':
                        $bln = 'Juni';
                        break;
                      case '7':
                        $bln = 'Juli';
                        break;
                      case '8':
                        $bln = 'Agustus';
                        break;
                      case '9':
                        $bln = 'September';
                        break;
                      case '10':
                        $bln = 'Oktober';
                        break;
                      case '11':
                        $bln = 'November';
                        break;
                      case '12':
                        $bln = 'Desember';
                        break;
                    }
                    ?>

                    <td align="right"><?php echo $tgl[2] . " " . $bln . " " . $tgl[0]; ?></td>
                  </tr>
                  <tr>
                    <td colspan="2"></td>
                    <td align="right"><?php echo $jam[1]; ?></td>
                  </tr>
                  <tr>
                    <?php
                    $nomor = 1;
                    $total = 0;
                    foreach ($pesanan as $psn) {
                      if ($psn->id_invoice == $inv->id_invoice) :
                        $subtotal = $psn->jumlah * $psn->harga;
                        $total += $subtotal;
                      endif;
                    }; ?>
                    <td>Total Pembelian</td>
                    <td>:</td>
                    <td align="right">Rp. <?php echo number_format($total, 0, ',', '.'); ?></td>
                  </tr>
                  <tr>
                    <td>Status Pengiriman</td>
                    <td>:</td>
                    <td align="right"><?php echo $inv->keterangan; ?></td>
                  </tr>
                  <tr>
                    <td>Status Pembayaran</td>
                    <td>:</td>
                    <td align="right"><?php echo $inv->status; ?></td>
                  </tr>
                  <tr>
                    <td colspan="3" align="right">
                      <div class="row">
                        <?php
                        if ($inv->status == 'Belum Dibayar') {
                        ?>
                          <a href="<?php echo base_url('order/pembayaran/' . $inv->id_invoice) ?>" class="col-6">
                            <button class='btn btn-sm btn-warning text-white col-12'>
                              Bayar
                            </button>
                          </a>
                        <?php
                        } elseif ($inv->status == 'Sedang Diproses' or 'Pembayaran Berhasil' and $inv->keterangan != 'Barang Sampai') {
                        ?>
                          <a href="https://api.whatsapp.com/send?phone=6288222999109&text=Saya%20ingin%20mengajukan%20pembatalan%20pesanan%20berikut%20%3A%0ANama%20Pemesan%20%3A%20<?php echo $inv->nama_pemesan ?>%0ANomor%20pesanan%20%3A <?php echo $inv->id_invoice ?>%0ATanggal%20Pemesanan%3A <?php echo $tgl[2] . " " . $bln . " " . $tgl[0]; ?>%0ATotal%20Pembayaran%20%3A Rp.<?php echo number_format($total, 0, ',', '.'); ?>" target="_blank" class="col-6">
                            <button class='btn btn-sm btn-danger col-12'>
                              Ajukan Batal
                            </button>
                          </a>
                        <?php
                        } else {
                        ?>
                          <a href="<?php echo base_url('home') ?>" class="col-6">
                            <button class='btn btn-sm btn-success col-12'>
                              Beli Lagi
                            </button>
                          </a>
                        <?php }; ?>
                        <a href="https://wa.me/6288222999109" target="_blank" class="col-6">
                          <button class='btn btn-sm btn-success col-12 '>
                            Hubungi Admin
                          </button>
                        </a>
                      </div>
                    </td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach;
      else : ?>
        <div class="row">
          <div class="text-lg mt-2 mx-auto">Tidak ada Pesanan.</div>
        </div>
      <?php
      endif;
      ?>
    </div>
  </div>
</div>
