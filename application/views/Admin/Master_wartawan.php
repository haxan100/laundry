<?php
defined('BASEPATH') or exit('No direct script access allowed');
$bu = base_url();

?>

<div class="main-content">


	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">

					<h4 class="card-title">Default Datatable</h4>
					<p class="card-title-desc">DataTables has most features enabled by
						default, so all you need to do to use it with your own tables is to call
						the construction function: <code>$().DataTable();</code>.
					</p>
					<!-- <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
						 -->
					<table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

						<thead>
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Position</th>
								<th>Office</th>
								<th>Age</th>
								<th>Start date</th>
								<th>Salary</th>
								<th>Edit</th>
							</tr>
						</thead>


						<tbody>
						</tbody>
					</table>

				</div>
			</div>
		</div> <!-- end col -->
	</div> <!-- end row -->
</div>

<script>
	$(document).ready(function() {
			var datatable = $('#datatable').DataTable({
				'lengthMenu': [
					[5, 10, 25, 50, -1],
					[5, 10, 25, 50, 'All']
				],
				'pageLength': 10,
				"processing": true,
				"serverSide": true,
				"language": {
					processing: '....loading<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>....<span class="sr-only">Loading...</span>'
				},
				"ajax": {
					url: '<?= base_url('Data/getWartawan'); ?>',
					type: 'POST'
				},
				"columnDefs": [{
					"targets": -1, // Kolom terakhir untuk tombol edit dan save
					"data": null,
					"defaultContent": `
                    <button class="btn btn-primary btn-edit">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                    <button class="btn btn-success btn-save d-none">
                        <i class="fas fa-save"></i>
                    </button>
                `
				}],
				"order": [
					[0, "asc"]
				]
			});

			// Event untuk tombol edit
			$('#datatable tbody').on('click', '.btn-edit', function() {
				var row = $(this).closest('tr');
				row.find('td').not(':last').each(function() {
					var text = $(this).text();
					$(this).html(`<input type="text" class="form-control" value="${text}">`);
				});

				row.find('.btn-edit').addClass('d-none');
				row.find('.btn-save').removeClass('d-none');
			});

			// Event untuk tombol save
			$('#datatable tbody').on('click', '.btn-save', function() {
				var row = $(this).closest('tr');
				var rowData = {
					id: row.find('td:first').text(),
					name: row.find('td:eq(1) input').val(),
					position: row.find('td:eq(2) input').val(),
					office: row.find('td:eq(3) input').val(),
					age: row.find('td:eq(4) input').val(),
					start_date: row.find('td:eq(5) input').val(),
					salary: row.find('td:eq(6) input').val()
				};

				$.ajax({
					url: '<?= base_url('Data/updateWartawan'); ?>',
					type: 'POST',
					data: rowData,
					success: function(response) {
						// Tampilkan data terbaru
						datatable.ajax.reload();

						// Tampilkan notifikasi jika perlu
						alert('Data berhasil diperbarui!');
					}
				});
			});
		});
</script>
