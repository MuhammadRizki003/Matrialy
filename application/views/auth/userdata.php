<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<h3 class="m-0"><i class="fas fa-edit"></i>Info Akun</h3>
		</div>
	</div>
	<div class="pl-3 pr-3"><?php echo $this->session->flashdata('message'); ?></div>
	<div class="content">
		<div class="container-fluid">
			<label> Nama Lengkap</label>
			<div class="card col-lg-4 col-md-5 col-12">
				<div class="card-body">
					<table class="table table-borderless">
						<tr>
							<td><?php echo $this->session->userdata('nama'); ?></td>
							<td align="right"><a href="#edit_nama" data-toggle='modal' class="card-link">Edit Nama</a></td>
						</tr>
					</table>
				</div>
			</div>
			<label>Email</label>
			<div class="card col-lg-4 col-md-5 col-12">
				<div class="card-body">
					<table class="table table-borderless">
						<tr>
							<td><?php echo $this->session->userdata('email'); ?></td>
							<td align="right"><a href="#edit_email" data-toggle='modal' class="card-link">Edit Email</a></td>
						</tr>
					</table>
				</div>
			</div>
			<label>Alamat</label>
			<div class="card col-lg-4 col-md-5 col-12">
				<div class="card-body">
					<table class="table table-borderless">
						<tr>
							<td><?php if ($alamat == false) { ?>
									Anda belum mengatur alamat anda
								<?php
								} else {
									echo $alamat['alamat'];
								}
								?></td>
							<td align="right"><a href="#edit_alamat" data-toggle='modal' class="card-link">
									<?php if ($alamat == false) { ?>
										Tambah&nbsp;Alamat
										<?php
									} else {
										?>Edit&nbsp;Alamat <?php } ?></a></td>
						</tr>
					</table>
				</div>
			</div>
			<a href="#edit_password" data-toggle='modal'>
				<button type="button" class="btn btn-primary mb-5">Ganti Password</button>
			</a>
		</div>
	</div>
</div>



<div class="modal fade" id="edit_nama" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit mr-2"></i>Form Edit Akun</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo base_url() . 'auth/ganti_nama/' ?>">
					<div class="form-group">
						<label>Masukan Password</label>
						<input type="password" name="password" class="form-control" placeholder="Masukan Password Anda" autocomplete="off">
					</div>
					<div class="form-group">
						<label>Masukan Nama Baru</label>
						<input type="text" name="nama" class="form-control" placeholder="Contoh : Muhammad Rizki" autocomplete="off">
					</div>
					<div>
						<?php echo anchor('auth/info_akun/', '<button type="button" class="btn btn-danger mr-1" >Batal</button>') ?>
						<button type="submit" class="btn btn-primary">Perbarui data</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="edit_email" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit mr-2"></i>Form Edit Akun</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo base_url() . 'auth/ganti_email/' ?>">
					<div class="form-group">
						<label>Masukan Password</label>
						<input type="password" name="password" class="form-control" placeholder="Masukan Password Anda" autocomplete="off">
					</div>
					<div class="form-group">
						<label>Masukan Email Baru</label>
						<input type="text" name="email" class="form-control" placeholder="Contoh : rizki@gmail.com" autocomplete="off">
					</div>
					<div>
						<?php echo anchor('auth/info_akun/', '<button type="button" class="btn btn-danger mr-1" >Batal</button>') ?>
						<button type="submit" class="btn btn-primary">Perbarui data</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="edit_password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit mr-2"></i>Form Edit Akun</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo base_url() . 'auth/ganti_password/' ?>">
					<div class="form-group">
						<label>Masukan Password Lama</label>
						<input type="password" name="password" class="form-control" placeholder="Masukan Password Anda" autocomplete="off">
					</div>
					<div class="form-group">
						<label>Masukan Password Baru</label>
						<input type="password" name="password_baru" class="form-control" placeholder="Masukan Password Baru" autocomplete="off">
					</div>
					<div class="form-group">
						<label>Konfirmasi Password Baru</label>
						<input type="password" name="password_baru2" class="form-control" placeholder="Konfirmasi Password Baru" autocomplete="off">
					</div>
					<div>
						<?php echo anchor('auth/info_akun/', '<button type="button" class="btn btn-danger mr-1" >Batal</button>') ?>
						<button type="submit" class="btn btn-primary">Perbarui data</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- baru -->
<div class="modal fade" id="edit_alamat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit mr-2"></i>Form Edit Akun</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo base_url() . 'auth/alamat/' ?>">
					<input type="hidden" name="id_user" value="<?php echo $this->session->userdata('id_user'); ?>">
					<div class="form-group">
						<label>Pilih Kota</label>
						<select name=kota class="form-control form-control-md" required>
							<option hidden value="<?php if ($alamat != false) {
														echo $alamat['kota'];
													}
													?> ">Pilih kota</option>
							<?php
							foreach ($kota as $k) {
							?>
								<option style="font-size: large;" value="<?php echo $k->kota ?>"><?php echo $k->kota ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label>Masukan Alamat Lengkap</label>
						<textarea name="alamat" cols="30" rows="5" class="form-control" required><?php if ($alamat != false) {
																										echo $alamat['alamat'];
																									} ?></textarea>
					</div>
					<div>
						<?php echo anchor('auth/info_akun/', '<button type="button" class="btn btn-danger mr-1" >Batal</button>') ?>
						<button type="submit" class="btn btn-primary">Perbarui data</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
