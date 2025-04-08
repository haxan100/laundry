<link href="<?= base_url("assets/") ?>assets/css/grading.css" rel="stylesheet">

<div class="main-content">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Master Toko</h4>
					<p class="card-title-desc">Kelola data Toko di sini.</p>

					<button id="reload" class="btn btn-secondary">
						<i class="ti-reload"></i> Segarkan
					</button>

					<h6>Toko-toko Mitra </h6>
					<table id="datatable" class="tabl e table-bordered dt-responsive nowrap" style="width: 100%;">
						<thead>
							<tr>
								<th>No</th>
								<th>Tanggal</th>
								<th>Mitra - Toko</th>
								<th>Device</th>
								<th>Kode trade- Imei</th>
								<th>Status</th>
								<th>Grade</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<script src="https://cdn.socket.io/4.0.1/socket.io.min.js"></script>
	<?php
	$ci = &get_instance();
	// $socket_url = $ci->config->item('socket_server_url'); // Ambil URL dari config

	?>
	<script>
		$(document).ready(function() {

			const socket = io("wss://[2a00:f48:1000:55a::1]:3000", {
				transports: ["websocket"]
			});
			
			console.log(socket);

			socket.on("refresh_datatable", function(data) {
				console.log("Received event: ", data);
				datatable.ajax.reload(null, false); // Refresh tanpa reset halaman
				sws("Update Data ");
			});

			$('#reload').click(function(e) {
				e.preventDefault();
				datatable.ajax.reload()
			});

			var datatable = $('#datatable').DataTable({

				"processing": true,
				"serverSide": true,
				"ajax": {
					url: "<?= base_url('Trade/getDT'); ?>",
					type: "POST",
					data: {

					},
				},

			});
			$(document).on('click', '.detail', function() {
				var id = $(this).data('id');
				var kode_trade = $(this).data('kode_trade');
				window.location.href = "<?= base_url('Admin/need_grading_detail/'); ?>" + id + "/" + kode_trade;
			});

		});
	</script>
