<div class="content-wrapper">
	<div class="content-header mb-2">
		<div class="container-fluid">
			<h3 class="m-0"><i class="fas fa-shopping-cart mr-2"></i>Keranjang</h3>
		</div>
	</div>
	<?php echo $this->session->flashdata('message') ?>
	<div class="content">
		<table class="table table-stripped table-responsive-sm">
			<tr>

				<td>Nama Produk</td>
				<td align="center">Jumlah Pembelian</td>
				<td align="right">Harga</td>
				<td align="right">Sub-total</td>
				<td></td>
			</tr>
			<?php
			$nomer = 1;
			foreach ($this->cart->contents() as $items) : ?>
				<tr>
					<td><img class="img-thumbnail border-dark bg-dark mr-2" style="width:5rem;" src="<?php echo base_url('/assets/gambar/upload/' . $items['gambar']) ?>"><?php echo $items['name'] ?></td>
					<form action="<?= base_url('cart/update_keranjang') ?>" method="POST" id="form<?php echo $nomer; ?>">
						<td align="center" width='400px'>
							<input type="hidden" name="stok" value="<?php echo $items['stok'] ?>">
							<input type="hidden" name="rowid" value="<?= $items['rowid'] ?>">
							<div class="row col-12 display-hp">
								<a href="<?php echo base_url('cart/kurang_prd/' . $items['rowid']) ?>" class="btn btn-outline-secondary text-center text-light col-lg-3 col-md-4 col-4">-</a>
								<input type="number" min="1" name="qty" value='<?php echo $items['qty']; ?>' id="<?php echo $items['id']; ?>" class="form-control text-center col-lg-6 col-md-4 col-4" onchange="javascript: edit('form<?php echo $nomer; ?>')" style="background-color: transparent;">
								<a href="<?php echo base_url('cart/tambah_prd/' . $items['rowid']) ?>" class="btn  btn-outline-secondary text-center text-light col-lg-3 col-md-4 col-4">+</a>
							</div>
						</td>
					</form>
					<td align="right">Rp.<?php echo number_format($items['price'], 0, ',', '.') ?></td>
					<td align="right">Rp.<?php echo number_format($items['price'] * $items['qty'], 0, ',', '.') ?></td>
					<td align="center" width="70px"><?php echo anchor('cart/hapus_item_keranjang/' . $items['rowid'], '<div class="btn btn-sm btn-danger col-12"><i class="fa fa-trash"></i></div>') ?></td>
				</tr>
			<?php $nomer++;
			endforeach; ?>
			<tr>
				<td colspan="2"></td>
				<td colspan="2" align="right">Rp. <?php echo number_format($this->cart->total(), 0, ',', '.') ?></td>
				<td></td>
			</tr>
		</table>
		<div align="right">

		</div>
	</div>

	<div class="container-fluid">
		<div class="row">
			<?php
			if ($this->cart->total() != 0) : ?>
				<div class="col-4">
					<a href="<?php echo base_url('cart/hapus_keranjang') ?>" class="btn btn-sm btn-block btn-danger ">Hapus semua</a>
				</div>
				<div class="col-4">
					<a href="<?php echo base_url('home/index') ?>" class="btn btn-sm btn-block btn-primary">Beli Lagi</a>
				</div>
				<div class="col-4">
					<a href="<?php echo base_url('cart/pemesanan') ?>" class="btn btn-sm btn-block btn-success">Buat Pesanan</a>
				</div>
			<?php
			else : ?>
				<div class="col-4">
					<a href="<?php echo base_url('cart/hapus_keranjang') ?>" class="btn btn-sm btn-block btn-danger disabled">Hapus semua</a>
				</div>
				<div class="col-4 ">
					<a href="<?php echo base_url('home/index') ?>" class="btn btn-sm btn-block btn-primary">Beli Lagi</a>
				</div>
				<div class="col-4">
					<a href="<?php echo base_url('cart/pemesanan') ?>" class="btn btn-sm btn-block btn-success disabled">Buat Pesanan</a>
				</div>
			<?php
			endif; ?>
		</div>
		<!-- </form> -->
	</div>

	<!-- Modal -->
	<div class="modal fade" id="test123" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content modal-content-danger" style="background: #E74C3C;">
				<div class="modal-body mt-2 text-center text-md">
					Mohon maaf, <?php echo $this->session->flashdata('messageErr') ?> buah
				</div>
				<button type="button" class="btn btn-danger btn-lg text-md col-12 text-center text-light pb-3" data-dismiss="modal" style="border-radius: 0px; background:transparent; border:0px;"><strong>OK</strong> </button>
			</div>
		</div>
	</div>