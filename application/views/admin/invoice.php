<div class="content-wrapper prinin">
  <div class="container-fluid">
    <div class="pt-2 pb-2">
      <h3 class="ml-3">Invoice</h3>
    </div>
  </div>
  <?php echo $this->session->flashdata('message'); ?>
  <div class="content">
    <div class="container-fluid">
      <div class="dropdown no-print">
        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Sortir Data
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="<?php echo base_url('admin/invoice/') ?>">
            <button class='btn btn-sm btn-primary mb-2 mr-2 col-12 my-auto'>Semua Transaksi</button>
          </a>
          <a class="dropdown-item" href="<?php echo base_url('admin/invoice/sortirData/Menunggu_Pembayaran') ?>">
            <button class='btn btn-sm btn-primary mb-2 mr-2 col-12 my-auto'>Menunggu Pembayaran</button>
          </a>
          </a>
          <a class="dropdown-item" href="<?php echo base_url('admin/invoice/sortirData/Sedang_Diproses') ?>">
            <button class='btn btn-sm btn-primary mb-2 mr-2 col-12 my-auto'>Menunggu Konfirmasi</button>
            <a class="dropdown-item" href="<?php echo base_url('admin/invoice/sortirData/Proses_Pengiriman') ?>">
              <button class='btn btn-sm btn-primary mb-2 mr-2 col-12 my-auto'>Proses Pengiriman</button>
            </a>
            <a class="dropdown-item" href="<?php echo base_url('admin/invoice/sortirData/Barang_Sampai') ?>">
              <button class='btn btn-sm btn-primary mb-2 mr-2 col-12 my-auto'>Transaksi Selesai</button>
            </a>


        </div>
      </div>
    </div>
    <div class="row mr-2">
      <form action="<?php echo base_url('admin/invoice/monthly/') ?>" method="get" class="mt-2 no-print col-lg-4 col-md-6 col-9 ">
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
        <div class="row col-12 ">
          <?php
          if ($this->uri->segment('4')) {
            $ket = $this->uri->segment('4');
          ?>
            <a href="<?php echo base_url('admin/invoice/excelData/' . $ket) ?>" class="btn btn-success col-lg-2 col-md-4 col-7 mt-2 mr-1 ml-auto"><i class="far fa-file-excel"></i> Print</a>
          <?php
          } elseif (!empty($sort)) {
            $ket = $sort;
          ?>
            <a href="<?php echo base_url('admin/invoice/excelDataBln/' . $ket) ?> " class=" btn btn-success col-lg-2 col-md-4 col-7 mt-2 mr-1 ml-auto"><i class="far fa-file-excel"></i> Print</a>
          <?php } else {
          ?>
            <a href="<?php echo base_url('admin/invoice/excelAll/') ?> " class=" btn btn-success col-lg-2 col-md-4 col-7 mt-2 mr-1 ml-auto"><i class="far fa-file-excel"></i> Print</a>
          <?php } ?>

          <button class="btn btn-primary col-lg-2 col-md-4 col-7 mt-2 " onclick=" window.print(); ">Print</button>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table">
        <tr>
          <th class="table-dark">Id Invoice</th>
          <th class="table-dark">Nama Pemesan</th>
          <th class="table-dark">Alamat Pemesan</th>
          <th class="table-dark">No.Telepon</th>
          <th class="table-dark">Tanggal Pemesanan</th>
          <th class="table-dark">Keterangan</th>
          <th class="table-dark">Status</th>
          <th class="table-dark">Total</th>
          <td class="table-dark no-print" colspan="2" align="center">Aksi</td>
        </tr>
        <?php
        $grandtotal = 0;
        foreach ($invoice as $inv) : ?>
          <tr>
            <td align="left"><?php echo $inv->id_invoice ?></td>
            <?php
            $total = 0;

            foreach ($pesanan as $psn) {
              if ($psn->id_invoice == $inv->id_invoice) {
                $subtotal = $psn->jumlah * $psn->harga;
                $total += $subtotal;
              }
            }
            ?>

            <td><?php echo $inv->nama_pemesan ?></td>
            <td><?php echo $inv->alamat ?></td>
            <td>
              <a href="<?php echo 'https://wa.me/' . $inv->no_tlp ?>" target="_blank" class="hitam">
                <span class="text-white hitam" id="link"><?php echo $inv->no_tlp ?></span>
              </a>
            </td>
            <td><?php echo $inv->tgl_pesan ?></td>
            <td><?php echo $inv->keterangan ?></td>
            <td><?php echo $inv->status ?></td>
            <td>Rp.<?php echo number_format($total, 0, ',', '.'); ?></td>
            <td class="no-print"><?php echo anchor('admin/invoice/detail/' . $inv->id_invoice, '<div class="btn btn-sm btn-primary col-12">Detail</div>') ?></td>
            <td class="no-print"><?php echo anchor('admin/invoice/hapus/' . $inv->id_invoice, '<div class="btn btn-sm btn-danger col-12 " onclick="return confirm(\'Hapus Pesanan?\')">Hapus</div>'); ?></td>

          </tr>
        <?php
          $grandtotal += $total;
        endforeach;
        if (empty($sort)) {
          $ket = $sortBy;
        } else {
          $rekap = explode('-', $sort);
          switch ($rekap[1]) {
            case '01':
              $bln = 'Januari';
              break;
            case '02':
              $bln = 'Februari';
              break;
            case '03':
              $bln = 'Maret';
              break;
            case '04':
              $bln = 'April';
              break;
            case '05':
              $bln = 'Mei';
              break;
            case '06':
              $bln = 'Juni';
              break;
            case '07':
              $bln = 'Juli';
              break;
            case '08':
              $bln = 'Agustus';
              break;
            case '09':
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
          }
          $ket = 'Transaksi Selesai Bulan ' . $bln . ' ' . $rekap[0];
        }
        ?>
        <tr>
          <td colspan="6" class="only-print ">*Data <?php echo $ket; ?></td>
          <td class="only-print ">Grandtotal </td>
          <td class="only-print ">Rp.<?php echo number_format($grandtotal, 0, ',', '.'); ?></td>
          <td class="no-print" colspan="2"></td>
        </tr>
      </table>
    </div>
  </div>
</div>
