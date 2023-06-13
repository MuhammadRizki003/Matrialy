<?php

header("Content-type: application/vnd-ms-excel");

header("Content-Disposition: attachment; filename=$title.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>
<style type="text/css">
    .table-data,
    td {
        border: thin solid black;
        width: 85%;
    }

    .table-data tr th,

    .table-data tr td {

        border: thin solid black;

        font-size: 11pt;

        font-family: Verdana;

        padding: 10px 10px 10px 10px;

    }

    h3 {

        font-family: Verdana;

    }

    .text {
        mso-number-format: "\@";
        /*force text*/
    }

    .textRight {
        mso-number-format: "\@";
        text-align: right
    }

    .textLeft {
        mso-number-format: "\@";
        text-align: left
    }

    .textCenter {
        mso-number-format: "\@";
        text-align: center
    }

    h3 {
        text-align: center;
        width: 85%;
        font-size: 20px;
    }
</style>

<h3>Invoice</h3>
<table class="table-data">
    <tr>
        <th class="table-dark">Id Invoice</th>
        <th class="textLeft">Nama Pemesan</th>
        <th class="textLeft">Alamat Pemesan</th>
        <th class="table-dark">No.Telepon</th>
        <th class="table-dark">Tanggal Pemesanan</th>
        <th class="textLeft">Keterangan</th>
        <th class="textLeft">Status</th>
        <th class="textRight">Total</th>
    </tr>
    <?php
    $grandtotal = 0;
    foreach ($invoice as $inv) : ?>
        <tr>
            <td class="textCenter"><?php echo $inv->id_invoice ?></td>
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
            <td class="textCenter">
                &nbsp<span class="text" id="link"><?php echo $inv->no_tlp ?></span>
            </td>
            <td class="textCenter"><?php echo $inv->tgl_pesan ?></td>
            <td><?php echo $inv->keterangan ?></td>
            <td><?php echo $inv->status ?></td>
            <td class="textRight">Rp.<?php echo number_format($total, 0, ',', '.'); ?></td>

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
        <td class="textRight">Rp.<?php echo number_format($grandtotal, 0, ',', '.'); ?></td>

    </tr>
</table>