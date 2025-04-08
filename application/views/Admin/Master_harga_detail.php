
<div class="main-content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Master Harga</h4>
                    <p class="card-title-desc">Kelola data Harga di sini.</p>
					<button type="button" class="btn btn-primary  mb-3 importModal" data-toggle="modal" data-target="#importModal">
						Import Excel
					</button>
					<button class="btn btn-success mb-3" id="exportButton">Export Excel</button>

                    <button class="btn btn-primary mb-3" id="addHargaButton">Tambah Harga</button>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Merk</th>
                                <th>Model</th>
                                <th>Type</th>
                                <th>Storage</th>
                                <th>Ram</th>
                                <th>Harga A</th>
                                <th>Harga J</th>
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
						<h5 class="modal-title" id="hargaDetailModalLabel">Tambah Detail Harga</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="detail_id" name="id">
						<input type="hidden" id="id_master_harga_detail" name="id_master_harga_detail" value="<?= $this->uri->segment(3); ?>">

						<div class="row">
							<!-- Bagian Kiri: Detail Produk -->
							<div class="col-md-6">
								<h6>Detail Produk</h6>
								<div class="mb-3">
									<label for="merk" class="form-label">Merk</label>
									<input type="text" class="form-control" id="merk" name="merk" required>
								</div>
								<div class="mb-3">
									<label for="model" class="form-label">Model</label>
									<input type="text" class="form-control" id="model" name="model" required>
								</div>
								<div class="mb-3">
									<label for="type" class="form-label">Type</label>
									<input type="text" class="form-control" id="type" name="type" required>
								</div>
								<div class="mb-3">
									<label for="storage" class="form-label">Storage</label>
									<input type="text" class="form-control" id="storage" name="storage" required>
								</div>
								<div class="mb-3">
									<label for="ram" class="form-label">Ram</label>
									<input type="text" class="form-control" id="ram" name="ram" required>
								</div>
							</div>

							<!-- Bagian Kanan: Input Harga -->
							<div class="col-md-6">
								<h6>Detail Harga</h6>
								<div class="row">
									<div class="col-6">
										<div class="mb-3">
											<label for="harga_a" class="form-label">Harga A</label>
											<input type="text" class="form-control format-rupiah" id="harga_a" name="harga_a" required>
										</div>
										<div class="mb-3">
											<label for="harga_c" class="form-label">Harga C</label>
											<input type="text" class="form-control format-rupiah" id="harga_c" name="harga_c" required>
										</div>
										<div class="mb-3">
											<label for="harga_e" class="form-label">Harga E</label>
											<input type="text" class="form-control format-rupiah" id="harga_e" name="harga_e" required>
										</div>
										<div class="mb-3">
											<label for="harga_g" class="form-label">Harga G</label>
											<input type="text" class="form-control format-rupiah" id="harga_g" name="harga_g" required>
										</div>
										<div class="mb-3">
											<label for="harga_i" class="form-label">Harga I</label>
											<input type="text" class="form-control format-rupiah" id="harga_i" name="harga_i" required>
										</div>
										<div class="mb-3">
											<label for="harga_fullset" class="form-label">Harga Fullset</label>
											<input type="text" class="form-control format-rupiah" id="harga_fullset" name="harga_fullset" required>
										</div>
									</div>
									<div class="col-6">
										<div class="mb-3">
											<label for="harga_b" class="form-label">Harga B</label>
											<input type="text" class="form-control format-rupiah" id="harga_b" name="harga_b" required>
										</div>
										<div class="mb-3">
											<label for="harga_d" class="form-label">Harga D</label>
											<input type="text" class="form-control format-rupiah" id="harga_d" name="harga_d" required>
										</div>
										<div class="mb-3">
											<label for="harga_f" class="form-label">Harga F</label>
											<input type="text" class="form-control format-rupiah" id="harga_f" name="harga_f" required>
										</div>
										<div class="mb-3">
											<label for="harga_h" class="form-label">Harga H</label>
											<input type="text" class="form-control format-rupiah" id="harga_h" name="harga_h" required>
										</div>
										<div class="mb-3">
											<label for="harga_j" class="form-label">Harga J</label>
											<input type="text" class="form-control format-rupiah" id="harga_j" name="harga_j" required>
										</div>
										<div class="mb-3">
											<label for="harga_promotion" class="form-label">Harga Promosi</label>
											<input type="text" class="form-control format-rupiah" id="harga_promotion" name="harga_promotion" required>
										</div>
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
	<!-- Modal Import -->
	<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="importModalLabel">Import Data dari Excel</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="importForm" action="import.php" method="POST" enctype="multipart/form-data">
						<div class="form-group">
						<input type="hidden" name="id_master_harga" id="id_master_harga" value="<?= $this->uri->segment(3); ?>">

							<label for="file">Pilih File Excel</label>
							<input type="file" name="file" id="file" class="form-control" required>
						</div>
						<button type="submit" class="btn btn-primary">Import</button>
					</form>
				</div>
			</div>
		</div>
	</div>

<script>
    $(document).ready(function () {
		$('.importModal').click(function (e) { 
			e.preventDefault();
			$('#importModal').modal('show');

		});
        // Inisialisasi DataTable
		const id = '<?= $this->uri->segment(3); ?>';
        var datatable = $('#datatable').DataTable({

            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "<?= base_url('Harga/getHargaDetail'); ?>",
                type: "POST",
				data: { id },
            },

        });

        // Tambah Harga
        $('#addHargaButton').on('click', function () {
            $('#hargaModalLabel').text('Tambah Harga');
            $('#hargaForm')[0].reset();
            $('#harga_id').val('');
            $('#hargaModal').modal('show');
        });

        // Edit Harga
        $(document).on('click', '.btn-edit', function () {
			const id = $(this).data('id');

			$.ajax({
				url: '<?= base_url("Harga/getHargaDetailById"); ?>',
				type: 'POST',
				data: { id },
				dataType: 'json',
				success: function (response) {
					if (response.status === 'success') {
						$('#hargaModalLabel').text('Edit Detail Harga');
						$('#detail_id').val(response.data.id);
						$('#merk').val(response.data.merk);
						$('#model').val(response.data.model);
						$('#type').val(response.data.type);
						$('#storage').val(response.data.storage);
						$('#ram').val(response.data.ram);
						$('#harga_a').val(formatRupiah(response.data.harga_a));
						$('#harga_b').val(formatRupiah(response.data.harga_b));
						$('#harga_c').val(formatRupiah(response.data.harga_c));
						$('#harga_d').val(formatRupiah(response.data.harga_d));
						$('#harga_e').val(formatRupiah(response.data.harga_e));
						$('#harga_f').val(formatRupiah(response.data.harga_f));
						$('#harga_g').val(formatRupiah(response.data.harga_g));
						$('#harga_h').val(formatRupiah(response.data.harga_h));
						$('#harga_i').val(formatRupiah(response.data.harga_i));
						$('#harga_j').val(formatRupiah(response.data.harga_j));
						$('#harga_fullset').val(formatRupiah(response.data.harga_fullset));
						$('#harga_promotion').val(formatRupiah(response.data.harga_promotion));
						$('#hargaModal').modal('show');
					} else {
						alert("Gagal mendapatkan data detail harga");
					}
				},
			});
		});

// Fungsi format Rupiah
function formatRupiah(angka) {
    if (typeof angka !== 'number' && typeof angka !== 'string') return ''; // Jika bukan angka atau string
    angka = angka.toString(); // Pastikan angka menjadi string
    return angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}



        // Submit Form
        $('#hargaForm').on('submit', function (e) {
			e.preventDefault();

			// Pastikan `id_master_harga_detail` selalu tersedia
			const idMasterHarga = $('#id_master_harga_detail').val() || '<?= $this->uri->segment(3); ?>';

			// Tambahkan hidden input jika belum ada
			if (!$('#id_master_harga_detail').length) {
				$('<input>')
					.attr({
						type: 'hidden',
						id: 'id_master_harga_detail',
						name: 'id_master_harga_detail',
						value: idMasterHarga,
					})
					.appendTo('#hargaForm');
			}

			const url = '<?= base_url("Harga/addHargaDetail"); ?>';

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
			const judul = $(this).data('judul');

			Swal.fire({
				title: `Hapus Harga ${judul}?`,
				text: 'Data yang dihapus tidak dapat dikembalikan!',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Ya, Hapus!',
				cancelButtonText: 'Batal',
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: '<?= base_url("Harga/delete"); ?>',
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
		$(document).on('click', '.btn-detail', function () {
        	const id = $(this).data('id')
			window.location.href = '<?= base_url('Admin/master_harga_detail/'); ?>' + id;
			
        });


	// Terapkan format saat pengguna mengetik
	document.querySelectorAll('.format-rupiah').forEach((input) => {
		input.addEventListener('input', (e) => {
			const inputValue = e.target.value;
			e.target.value = formatRupiah(inputValue);
		});
	});
	$('#importForm').on('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);
        $.ajax({
            url: '<?= base_url("Import/importHargaDetailExcel"); ?>',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                let res = JSON.parse(response);
                if (res.status === 'success') {
                    $('#importModal').modal('hide');
                    $('#importForm')[0].reset();
                    datatable.ajax.reload(); // Reload DataTable
                    sws(res.message);
                } else {
                    swe(res.message);
                }
            },
            error: function () {
                swe('Terjadi kesalahan saat mengunggah file.');
            },
        });
    });
	$('#exportButton').on('click', function () {
		var id_harga = '<?= $this->uri->segment(3); ?>';
		console.log(`<?= base_url("Export/exportHargaDetailExcel"); ?>/${id_harga}`);
		// return false
		window.location.href = `<?= base_url("Export/exportHargaDetailExcel"); ?>/${id_harga}`;
	});

    });
</script>
