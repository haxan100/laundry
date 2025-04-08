
<div class="main-content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Master Toko</h4>
                    <p class="card-title-desc">Kelola data Toko di sini.</p>

                    <button class="btn btn-primary mb-3" id="addHargaButton">Tambah Toko</button>
					<h6>Toko-toko Mitra :  <?= $data->nama_mitra ?></h6>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Toko</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Nomor Telpon</th>
                                <th>created At</th>
                                <th>Last Login</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

	<div class="modal fade" id="hargaModal" tabindex="-1" aria-labelledby="hargaModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<form id="hargaForm">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="hargaDetailModalLabel">Tambah </h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="detail_id" name="detail_id">
						<input type="hidden" id="id_mitra" name="id_mitra" value="<?= $this->uri->segment(3); ?>">

						<div class="row">
							<!-- Bagian Kiri: Detail Produk -->
							<div class="col-md-12">
								<div class="mb-3">
									<label for="nama_toko" class="form-label">Nama Toko</label>
									<input type="text" class="form-control" id="nama_toko" name="nama_toko" required>
								</div>
								<div class="mb-3">
									<label for="nomor_telpon" class="form-label">No Telpon</label>
									<input type="text" class="form-control" id="nomor_telpon" name="nomor_telpon" required>
								</div>
								<div class="mb-3">
									<label for="email" class="form-label">Email</label>
									<input type="text" class="form-control" id="email" name="email" required>
								</div>
								<div class="mb-3">
									<label for="username" class="form-label">Username</label>
									<input type="text" class="form-control" id="username" name="username" required>
								</div>
								
								<div class="mb-3">
									<label for="password" class="form-label">Password</label>
									<div class="input-group">
										<input type="password" class="form-control" id="password" name="password" required>
										<button type="button" class="btn btn-outline-secondary" id="togglePassword">
											<i class="fas fa-eye"></i>
										</button>
									</div>
								</div>
							</div>
							
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Simpan</button>
					</div>
				</div>
			</form>
		</div>
	</div>

<script>
    $(document).ready(function () {
		$('.importModal').click(function (e) { 
			e.preventDefault();
			$('#importModal').modal('show');

		});
		const id = '<?= $this->uri->segment(3); ?>';
        var datatable = $('#datatable').DataTable({

            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "<?= base_url('Toko/getDTMasterMitra'); ?>",
                type: "POST",
				data: { id },
            },

        });
		
        $('#addHargaButton').on('click', function () {
            $('#hargaModalLabel').text('Tambah Harga');
            $('#hargaForm')[0].reset();
            $('#harga_id').val('');
            $('#hargaModal').modal('show');
        });

        // Edit Harga
        $(document).on('click', '.btn-edit', function () {
			const id = $(this).data('id');
			console.log(id);
		

			
			$.ajax({
				url: '<?= base_url("Toko/getById"); ?>',
				type: 'POST',
				data: { id },
				dataType: 'json',
				success: function (response) {
					if (response.status === 'success') {
						$('#hargaModalLabel').text('Edit Detail Harga');
						$('#detail_id').val(response.data.id_toko);
						$('#nama_toko').val(response.data.nama_toko);
						$('#username').val(response.data.username);
						$('#password').val(response.data.password);
						$('#email').val(response.data.email);
						$('#nomor_telpon').val(response.data.nomor_telpon);
						$('#hargaModal').modal('show');
					} else {
						alert("Gagal mendapatkan data detail harga");
					}
				},
			});
		});
        $('#hargaForm').on('submit', function (e) {
			e.preventDefault();
			const idMasterHarga =  '<?= $this->uri->segment(3); ?>';
			var url;
			if ($('#detail_id').val() === "" || $('#detail_id').val() === null || $('#detail_id').val() === undefined) {
				url = '<?= base_url("Toko/add"); ?>';
			} else {
				url = '<?= base_url("Toko/updateHarga"); ?>';
			}
			

			$.ajax({
				url: url,
				type: 'POST',
				data: $(this).serialize(),
				dataType: 'json',
				success: function (response) {
					if (response.status === 'success') {
						$('#hargaModal').modal('hide');
						datatable.ajax.reload();
						sws(response.message); // Tampilkan notifikasi sukses
					} else {
						alert(response.message); // Tampilkan pesan error jika ada
					}
				},
			});
		});

		$(document).on('click', '.btn-delete', function() {
			const id = $(this).data('id');
			const nama_toko = $(this).data('nama_toko');

			Swal.fire({
				title: `Hapus  ${nama_toko}?`,
				text: 'Data yang dihapus tidak dapat dikembalikan!',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Ya, Hapus!',
				cancelButtonText: 'Batal',
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: '<?= base_url("Toko/delete"); ?>',
						type: 'POST',
						data: {
							id
						},
						dataType: 'json',
						success: function(response) {
							if (response.status === 'success') {
								datatable.ajax.reload();
								Swal.fire('Berhasil!', response.message, 'success');
							} else {
								Swal.fire('Gagal!', response.message, 'error');
							}
						},
					});
				}
			});
		});


	// Terapkan format saat pengguna mengetik
	document.querySelectorAll('.format-rupiah').forEach((input) => {
		input.addEventListener('input', (e) => {
			const inputValue = e.target.value;
			e.target.value = formatRupiah(inputValue);
		});
	});
	$('#togglePassword').on('click', function() {
		const passwordField = $('#password');
		const passwordFieldType = passwordField.attr('type');
		const icon = $(this).find('i');

		// Toggle input type and icon class
		if (passwordFieldType === 'password') {
			passwordField.attr('type', 'text');
			icon.removeClass('fa-eye').addClass('fa-eye-slash');
		} else {
			passwordField.attr('type', 'password');
			icon.removeClass('fa-eye-slash').addClass('fa-eye');
		}
	});

    });
</script>
