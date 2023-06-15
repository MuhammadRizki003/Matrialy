<!-- Modal -->
<div class="modal fade" id="informasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<img class="col-12  rounded mt-2" src="<?php echo base_url('/assets/gambar/freeOngkir.png') ?> " alt="...">
			<div class="modal-body ">
				<h5>Promo gratis ongkos kirim :</h5>
				<ul>
					<li>Biaya ongkos pengiriman <span class="text-success">GRATIS!!</span> dengan ketentuan : </li>
					<table class="table table-sm table-bordered" style="width:fit-content;">
						<tr>
							<td>Pembelian</td>
							<td align="right">Jarak</td>
						</tr>
						<tr>
							<td>Rp.0 - 50.000</td>
							<td align="right">5 Km</td>
						</tr>
						<tr>
							<td>Rp. 51.000 - 300.000</td>
							<td align="right">10 Km</td>
						</tr>
						<tr>
							<td>Rp. 301.000 - 500.000</td>
							<td align="right">15 Km</td>
						</tr>
						<tr>
							<td>Lebih dari Rp. 500.000</td>
							<td align="right">20 Km</td>
						</tr>
					</table>
					<li>Jika jarak melebihi ketentuan maka akan di kenakan biaya ongkos pengiriman tambahan </li>
				</ul>
				<h5>Biaya ongkos pengiriman tambahan :</h5>
				<ul>
					<li>Biaya pengiriman sebesar : Rp.50.0000 /10Km</li>
					<li>pengiriman juga dapat dilakukan menggunakan <span class="text-warning">layanan JNT/JNE</span> jika memungkinkan (<span class="text-warning">Biaya pengiriman di tanggung oleh Pembeli</span>)</li>
				</ul>
				<button type="button" class="btn btn-danger mb-2 mr-2  col-12 " data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Tutup</span></button>
			</div>


		</div>
	</div>
</div>

<!-- Main Footer -->
<footer class="main-footer">
	<strong>Copyright &copy; 2022 Matrialy.</strong>
	All rights reserved.
	<div class="float-right d-none d-sm-inline-block">
		<a class="text-secondary" href="https://api.whatsapp.com/send?phone=6288222999109" target="_blank"><b>Contact Us</b><i class="far fa-comment text-md"></i></a>
	</div>
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="<?php echo base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url() ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>assets/dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="<?php echo base_url() ?>assets/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/raphael/raphael.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url() ?>assets/plugins/chart.js/Chart.min.js"></script>
<script>
	function previewGambar() {
		var preview = document.getElementById("preview");
		var file = document.getElementById("gambar").files[0];
		var reader = new FileReader();
		reader.onloadend = function() {
			preview.src = reader.result;
		}
		if (file) {
			reader.readAsDataURL(file);
		} else {
			preview.src = "";
		}
	}

	function iklanShow() {
		$('#iklan').modal('show');
	};
	// window.setTimeout(function() {
	// 	$("#iklan").modal('hide');
	// }, 999100);
	window.setTimeout(
		function() {
			document.getElementById("buttonIklan").style.visibility = 'visible';
		}, 700
	);
	// var timeleft = 5;
	// var downloadTimer = setInterval(function() {
	// 	timeleft--;
	// 	document.getElementById("countdowntimer").textContent = '(Otomatis tutup dalam ' + timeleft + ' detik)';
	// 	if (timeleft <= 0) {
	// 		document.getElementById("countdowntimer").textContent = "";
	// 		// document.getElementById("buttonIklan").style.visibility = "hidden";
	// 		clearInterval(downloadTimer);
	// 	}
	// }, 1000);
	window.setTimeout(function() {
		$(".alert").fadeTo(500, 0).slideUp(500, function() {
			$(this).remove();
		});
	}, 2500);

	function ketOngkir() {
		$("#iklan").modal('hide');
		window.setTimeout(function() {
			$('#informasi').modal('show');
		}, 345);
	}
</script>

<script>
	function plus(id, stok) {
		var pr = document.getElementById(id);
		if (pr.value >= stok) {
			pr.value = stok;
		} else {
			pr.value++;
		}
	}

	function min(id) {
		var pr = document.getElementById(id);
		if (pr.value - 1 < 1)
			return;
		else
			pr.value--;
	}
</script>
<script>
	$(document).ready(function() {
		var msg = <?php echo $this->session->flashdata('message'); ?>;
		if ($msg === '') {

		} else {
			$('#test123').modal('show');
		}
	});
</script>


<!-- keranjang -->
<?php if (!empty($this->session->flashdata('messageErr'))) : ?>
	<script>
		$(document).ready(function() {
			$('#test123').modal('show');
		});
	</script>
<?php endif; ?>
<script>
	function edit(id) {
		document.getElementById(id).submit();
	}
</script>
<!-- end keranjang -->
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.0/jquery.cookie.min.js">
</script>
<script type="text/javascript">
	$(document).ready(function() {
		if ($.cookie('pop') == null) {
			$('#iklan').modal('show');
			$.cookie('pop', '1');
		}
	});
</script> -->
<script>
	function hapusCart() {
		$('#modalHapus').modal('show');
		var timeleft = 3;
		document.getElementById("countHapus").disabled = true;
		document.getElementById("countHapus").textContent = 'Tunggu ' + timeleft + ' detik';
		var downloadTimer = setInterval(function() {
			timeleft--;
			document.getElementById("countHapus").textContent = 'Tunggu ' + timeleft + ' detik';
			if (timeleft <= 0) {
				document.getElementById("countHapus").textContent = "Hapus Keranjang";
				document.getElementById("countHapus").disabled = false;
				// document.getElementById("buttonIklan").style.visibility = "hidden";
				clearInterval(downloadTimer);
			}
		}, 1000);
	}
</script>

</body>

</html>
