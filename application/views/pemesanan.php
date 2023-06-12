<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<h3 class="m-0"><i class="fas fa-shopping-cart mr-1"></i>Pemesanan</h3>
		</div>
	</div>
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-8 col-md-8 col-12 ">
					<div class="card bg-dark">
						<div class="card-header bg-secondary">
							Input Alamat Pengiriman
						</div>
						<div class="card-body">
							<form action="<?php echo base_url() ?>cart/proses_pesanan" method="POST">
								<div class="form-group">
									<label>Nama Lengkap</label>
									<input type="text" name="nama" class="form-control" placeholder="Nama Lengkap Anda" value="<?php echo $this->session->userdata('nama'); ?>" autocomplete="off" required>
								</div>
								<div class="form-group">
									<label>Alamat Lengkap</label>
									<textarea name="alamat" cols="30" rows="5" class="form-control" required></textarea>
								</div>
								<div class="form-group">
									<label>No. Telepon </label>
									<input type="text" name="no_tlp" class="form-control" placeholder="No.Telepon Anda" autocomplete="off" required>
								</div>
								<div class="mb-1">
									<div class="form-check">
										<input type="checkbox" class="form-check-input" required>
										<label class="form-check-label" for="exampleCheck1">Saya Setuju Dengan Informasi Biaya Ongkos Kirim <a href="#informasi" data-toggle="modal">Klik Disini</a></label>
									</div>

								</div>
								<button type="submit" class="btn btn-primary mb-1 mt-2 col-lg-2 col-md-3 col-12">Pesan</button>
							</form>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-12">
					<div class="card bg-dark mb-3">
						<div class="card-header bg-secondary">
							Pesanan
						</div>
						<div class="card-body">
							<table class="table">
								<tr>
									<td>Produk</td>
									<td align="center">Junlah</td>
									<td align="center">Harga</td>
								</tr>
								<?php
								foreach ($this->cart->contents() as $items) : ?>
									<tr>
										<td><?php echo $items['name'] ?></td>
										<td align="center"><?php echo $items['qty'] ?></td>
										<td align="right">Rp.<?php echo number_format($items['price'], 0, ',', '.') ?></td>
									</tr>
									<tr>
										<td style="border: 0px;">Subtotal</td>
										<td colspan="2" align="right" style="border: 0px;">Rp.<?php echo number_format($items['subtotal'], 0, ',', '.') ?></td>
									</tr>
								<?php
								endforeach; ?>
								<tr>
									<td>Total</td>
									<td colspan="2" align="right">Rp. <?php echo number_format($this->cart->total(), 0, ',', '.') ?></td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>