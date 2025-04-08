<div class="main-content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Master Harga</h4>
                    <p class="card-title-desc">Kelola data Harga di sini.</p>

                    <button class="btn btn-primary mb-3" id="addHargaButton">Tambah Harga</button>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul Harga</th>
                                <th>Periode Awal</th>
                                <th>Periode Akhir</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Harga -->
    <div class="modal fade" id="hargaModal" tabindex="-1" aria-labelledby="hargaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="hargaForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="hargaModalLabel">Tambah Harga</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="harga_id" name="id">

                        <div class="mb-3">
                            <label for="judul_harga" class="form-label">Judul Harga</label>
                            <input type="text" class="form-control" id="judul_harga" name="judul_harga" required>
                        </div>

                        <div class="mb-3">
                            <label for="periode_awal" class="form-label">Periode Awal</label>
                            <input type="date" class="form-control" id="periode_awal" name="periode_awal" required>
                        </div>

                        <div class="mb-3">
                            <label for="periode_akhir" class="form-label">Periode Akhir</label>
                            <input type="date" class="form-control" id="periode_akhir" name="periode_akhir" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        // Inisialisasi DataTable
        var datatable = $('#datatable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "<?= base_url('Harga/getHarga'); ?>",
                type: "POST"
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
                url: '<?= base_url("Harga/getHargaById"); ?>',
                type: 'POST',
                data: { id },
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        $('#hargaModalLabel').text('Edit Harga');
                        $('#harga_id').val(response.data.id);
                        $('#judul_harga').val(response.data.judul_harga);
                        $('#periode_awal').val(response.data.periode_awal);
                        $('#periode_akhir').val(response.data.periode_akhir);
                        $('#hargaModal').modal('show');
                    } else {
                        alert("Gagal mendapatkan data harga");
                    }
                },
            });
        });

        // Submit Form
        $('#hargaForm').on('submit', function (e) {
            e.preventDefault();

            const url = $('#harga_id').val() ? '<?= base_url("Harga/updateHarga"); ?>' : '<?= base_url("Harga/addHarga"); ?>';

            $.ajax({
                url,
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        $('#hargaModal').modal('hide');
                        datatable.ajax.reload();
						sws(response.message);
                    } else {
                        alert(response.message);
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
    });
</script>
