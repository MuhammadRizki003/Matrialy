<!-- Content Wrapper. Contains page content -->
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

    .judul {
        text-align: center;
        width: 85%;
        font-size: 20px;
    }
</style>

<p class="judul">Laporan Produk Terjual</p>


<table class="table-data">
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
                            <?php echo  $prd->nama_produk ?>
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
            <td colspan="3" class="table-dark" align="right">Total</td>
            <td class="table-dark" align="right" scope="col">Rp.<?php echo number_format($total, 0, ',', '.') ?></td>
        </tr>
</table>