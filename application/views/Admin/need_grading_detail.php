<link href="<?= base_url("assets/") ?>assets/css/grading.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />

<?php
$data = $tradeData;
// var_dump($data);die;
$ci = &get_instance();
$ci->load->helper('global_helper');
$kelengkapan_html = kelengkapan_hp($tradeData->quisioner_5);
$warna_teks = (strpos($kelengkapan_html, 'text-danger') !== false) ? 'text-danger' : 'text-dark';


?>

<style>
	.dynamic-category {
		padding: 1rem;
		border-radius: 8px;
		margin-bottom: 1rem;
		border-left-width: 6px;
		box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
	}

	.kategori-lcd {
		background-color: #e0f2fe;
		border-color: #38bdf8;
		color: #0284c7;
	}

	.kategori-baterai {
		background-color: #dcfce7;
		border-color: #4ade80;
		color: #16a34a;
	}

	.kategori-backcover {
		background-color: #fef9c3;
		border-color: #facc15;
		color: #ca8a04;
	}

	.kategori-body {
		background-color: #fde68a;
		border-color: #f59e0b;
		color: #d97706;
	}

	.kategori-service {
		background-color: #fae8ff;
		border-color: #e879f9;
		color: #c026d3;
	}

	.kategori-kelengkapan {
		background-color: #e5e7eb;
		border-color: #9ca3af;
		color: #374151;
	}

	.kategori-software {
		background-color: #f1f5f9;
		border-color: #64748b;
		color: #334155;
	}

	.kategori-lainnya {
		background-color: #fef2f2;
		border-color: #f87171;
		color: #b91c1c;
	}
</style>
<style>
	#progress-bar {
		height: 30px;
		transition: width 1s, background-color 1s;
	}

	.shake {
		animation: shake 0.5s infinite;
	}

	@keyframes shake {

		0%,
		100% {
			transform: translateX(0);
		}

		25% {
			transform: translateX(-5px);
		}

		50% {
			transform: translateX(5px);
		}

		75% {
			transform: translateX(-5px);
		}
	}

	.btn-kirim {
		display: inline-block;
		padding: 10px 20px;
		background-color: #2563eb;
		color: white;
		font-weight: bold;
		border: none;
		border-radius: 12px;
		cursor: pointer;
		transition: background-color 0.3s, transform 0.2s;
		box-shadow: 0 4px 10px rgba(37, 99, 235, 0.3);
	}

	.btn-kirim:hover {
		background-color: #1e40af;
		transform: translateY(-3px);
		box-shadow: 0 6px 15px rgba(30, 64, 175, 0.4);
	}
</style>

<div class="main-content">
	<div class="row">

		<div class="col-12">
			<div class="card">
				<div class="card-body">

					<h3>Data Pengecekan </h3>
					<div class="card">
						<div class="card-body">
							<div class="row mt-3">

								<div class="container mt-3" id="countdown">
									<div class="progress">
										<div id="progress-bar" class="progress-bar bg-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<p id="countdown-text" class="text-center mt-2 fs-4"> detik</p>
								</div>


								<div class="col-md-12">
									<table class="table table-bordered">
										<tbody>
											<tr>
												<th>Tanggal</th>
												<td id="trade-tanggal"><?= !empty($tradeData->created_at) ? $tradeData->created_at : '-' ?></td>
												<th>IMEI</th>
												<td id="trade-imei"><?= !empty($data->imei) ? $data->imei : '-' ?></td>
											</tr>
											<tr>
												<th>Kode Trade</th>
												<td id="trade-kode"><?= !empty($data->kode_trade) ? $data->kode_trade : '-' ?> / <?= !empty($data->transaction_code) ? $data->transaction_code : '-' ?></td>
												<th>Merek </th>
												<td id="trade-merk"><?= !empty($data->merk) ? $data->merk : '-' ?> </td>
											</tr>
											<tr>
												<th>Status</th>
												<td id="trade-status">
													<?php
													$statusData = status_grade($data->status ?? 'pending');
													?>
													<span class="<?= $statusData['data']['class'] ?>">
														<?= $statusData['data']['text'] ?>
													</span>
												</td>
												<th>Tipe</th>
												<td id="trade-type"><?= !empty($data->type) ? $data->type : '-' ?></td>
											</tr>
											<tr>
												<th>Mitra</th>
												<td id="trade-mitra"><?= !empty($mitra->nama_mitra) ? $mitra->nama_mitra : '-' ?></td>
												<th>Penyimpanan - Ram</th>
												<td id="trade-storage"><?= !empty($data->storage) ? $data->storage . " - " . $data->ram : '-' ?></td>
											</tr>
											<tr>

												<th> Model</th>
												<td id="trade-merk"><?= !empty($data->model) ? $data->model : '-' ?></td>
												<th>Pemeriksa Device</th>
												<td id="trade-pemeriksa"><?= !empty($mitra->nama_toko) ? $mitra->nama_toko : '-' ?></td>
											</tr>
											<tr>
												<th>Harga</th>
												<td id="trade-harga"><?= !empty($data->harga) ? format_currency($data->harga) : format_currency(0) ?></td>
												<th>Grade</th>
												<td id="trade-grade">
													<?php
													$gradeData = grade($data->grade ?? '-');
													?>
													<span class="<?= $gradeData['data']['class'] ?>">
														<?= $gradeData['data']['text'] ?>
													</span>
												</td>
											</tr>
										</tbody>
									</table>

								</div>
							</div>

							<button class="btn btn-dark w-100 mt-3" data-bs-toggle="collapse" data-bs-target="#devicePhotos">Foto Device Pelanggan</button>
							<div id="devicePhotos" class="collapse mt-3">
								<div class="card">

									<div class="row text-center">
										<?php
										$photos = [
											'photo_front' => 'Foto Depan',
											'photo_back' => 'Foto Belakang',
											'photo_top' => 'Foto Atas',
											'photo_bottom' => 'Foto Bawah',
											'photo_about_phone' => 'Foto About Phone',
											'photo_true_tone' => 'Foto True Tone',
											'photo_battery_health' => 'Foto Battery Health'
										];

										$defaultImage = base_url('assets/img/default.png'); // Gambar default jika tidak ada foto

										foreach ($photos as $key => $label) :
											$photoUrl = !empty($tradeData->$key) ? base_url('uploads/quisioner/') . $tradeData->$key : $defaultImage;
										?>
											<div class="col-md-3 p-2">
												<a id="trade-<?= $key ?>-link" href="<?= $photoUrl ?>" data-lightbox="device-gallery" data-title="<?= $label ?>">
													<img id="trade-<?= $key ?>" src="<?= $photoUrl ?>" class="img-fluid img-thumbnail" style="max-height: 120px; object-fit: cover; cursor: pointer;" alt="<?= $label ?>">
												</a>
												<p class="text-center mt-2"> <?= $label ?> </p>
											</div>
										<?php endforeach; ?>
									</div>
								</div>
							</div>



							<button class="btn btn-dark w-100 mt-3" data-bs-toggle="collapse" data-bs-target="#additionalInfo">Hasil Test Oleh Pelanggan</button>
							<div id="additionalInfo" class="collapse  mt-3">
								<div class="card card-body">
									<table class="table table-bordered">
										<tr>
											<td id="trade-sim-card">Kartu SIM <?= status_icon($tradeData->sim_card) ?></td>
											<td id="trade-touchscreen">Layar Sentuh <?= status_icon($tradeData->touchscreen) ?></td>
											<td id="trade-biometric">Biometrik (Fingerprint) <?= status_icon($tradeData->biometric) ?></td>
										</tr>
										<tr>
											<td class="text-danger">
												<p><strong class="<?= $warna_teks ?>">Kelengkapan:</strong> <span id="trade-kelengkapan"><?= $kelengkapan_html ?></span></p>
											</td>
											<td id="trade-photo-front-status">Foto bagian depan <?= status_icon($tradeData->photo_front) ?></td>
											<td id="trade-photo-back-status">Foto bagian belakang <?= status_icon($tradeData->photo_back) ?></td>
										</tr>
										<tr>
											<td id="trade-button-volume">Tombol Volume <?= status_icon($tradeData->button_volume_up) ?></td>
											<td id="trade-button-silent">Tombol Kembali / Silent <?= status_icon($tradeData->button_silent) ?></td>
											<td id="trade-button-power">Tombol Power <?= status_icon($tradeData->button_power) ?></td>
										</tr>
										<tr>
											<td id="trade-cpu">CPU <?= status_icon($tradeData->cpu) ?></td>
											<td id="trade-storage">Penyimpanan <?= status_icon($tradeData->hardisk) ?></td>
											<td id="trade-battery">Kondisi Baterai <?= status_icon($tradeData->battery) ?></td>
										</tr>
									</table>

								</div>
							</div>

							<button class="btn btn-dark w-100 mt-3" data-bs-toggle="collapse" data-bs-target="#extraQuisioner">Hasil Quisioner </button>
							<div id="extraQuisioner" class="collapse  mt-3">
								<div class="card card-body">

									<div class="review-section">
										<div class="review-details">
											<div class="review-item"><strong>Quisioner 1</strong>
												<div class="col-md-3 p-2">

													<a id="trade-photo_front-link" href="<?= base_url() ?>assets/quiz/q_1.png" data-lightbox="device-gallery" data-title="quis 1">
														<img id="trade-photo_front" src="<?= base_url() ?>assets/quiz/q_1.png" class="img-fluid img-thumbnail" style="max-height: 120px; object-fit: cover; cursor: pointer;" alt="quis 1">
													</a>
													<span id="trade-smartphone"> <?= status_icon($tradeData->quisioner_1) ?><?= $tradeData->quisioner_1 ?></span>
												</div>
											</div>

											<div class="review-item"><strong>Quisioner 2</strong>
												<div class="col-md-3 p-2">

													<a id="trade-photo_front-link" href="<?= base_url() ?>assets/quiz/q_2.png" data-lightbox="device-gallery" data-title="quis 1">
														<img id="trade-photo_front" src="<?= base_url() ?>assets/quiz/q_2.png" class="img-fluid img-thumbnail" style="max-height: 120px; object-fit: cover; cursor: pointer;" alt="quis 1">
													</a>
													<span id="trade-smartphone"><?= status_icon($tradeData->quisioner_2) ?><?= $tradeData->quisioner_2 ?></span>
												</div>
											</div>

											<div class="review-item"><strong>Quisioner 3</strong>
												<div class="col-md-3 p-2">

													<a id="trade-photo_front-link" href="<?= base_url() ?>assets/quiz/q_3.png" data-lightbox="device-gallery" data-title="quis 1">
														<img id="trade-photo_front" src="<?= base_url() ?>assets/quiz/q_3.png" class="img-fluid img-thumbnail" style="max-height: 120px; object-fit: cover; cursor: pointer;" alt="quis 1">
													</a>
													<span id="trade-smartphone"><?= status_icon($tradeData->quisioner_3) ?><?= $tradeData->quisioner_3 ?></span>
												</div>
											</div>

											<div class="review-item"><strong>Quisioner 4</strong>
												<div class="col-md-3 p-2">

													<a id="trade-photo_front-link" href="<?= base_url() ?>assets/quiz/q_4.png" data-lightbox="device-gallery" data-title="quis 1">
														<img id="trade-photo_front" src="<?= base_url() ?>assets/quiz/q_4.png" class="img-fluid img-thumbnail" style="max-height: 120px; object-fit: cover; cursor: pointer;" alt="quis 1">
													</a>
													<span id="trade-smartphone"><?= status_icon($tradeData->quisioner_4) ?><?= $tradeData->quisioner_4 ?></span>
												</div>
											</div>
											<div class="review-item"><strong>Quisioner 5</strong>
												<div class="col-md-3 p-2">

													<a id="trade-photo_front-link" href="<?= base_url() ?>assets/quiz/q_5.png" data-lightbox="device-gallery" data-title="quis 1">
														<img id="trade-photo_front" src="<?= base_url() ?>assets/quiz/q_5.png" class="img-fluid img-thumbnail" style="max-height: 120px; object-fit: cover; cursor: pointer;" alt="quis 1">
													</a>
													<span id="trade-smartphone"><?= kelengkapan_hp($tradeData->quisioner_5) ?></span>
												</div>
											</div>




											<div class="review-item"><strong>Quisioner 6:</strong> <span id="trade-storage"><?php $quisioner6 = quiz_6($tradeData->quisioner_6); ?>
													<?php if (!empty($quisioner6)): ?>
														<?php foreach ($quisioner6 as $item): ?>
															<span class="label label-primary"><?= $item['text'] ?> - </span>
														<?php endforeach; ?>
													<?php else: ?>
														<span class="label label-default">Tidak Ada Data</span>
													<?php endif; ?>
													<!-- <?= $tradeData->quisioner_6 ?></span></div> -->



											</div>
										</div>
									</div>
								</div>
							</div>

							<button class="btn btn-dark w-100 mt-3" data-bs-toggle="collapse" data-bs-target="#extraFisik">Hasil Cek Fisik </button>
							<div id="extraFisik" class="collapse  mt-3">
								<div class="card card-body">

									<div class="review-section">
										<div class="review-details">
											<div class="review-item"><strong>Fisik 1 ( Imei) </strong>
												<div class="col-md-12 p-2">
													<td id="trade-imei"><?= !empty($data->imei) ? $data->imei : '-' ?></td>
												</div>
											</div>

											<div class="review-item"><strong>Fisik 2</strong>
												<div class="">
													<?php
													$photos = [
														'photo_front' => 'Foto Depan',
														'photo_back' => 'Foto Belakang',
													];

													$defaultImage = base_url('assets/img/default.png'); // Gambar default jika tidak ada foto

													foreach ($photos as $key => $label) :
														$photoUrl = !empty($tradeData->$key) ? base_url('uploads/quisioner/') . $tradeData->$key : $defaultImage;
													?>
														<div class="col-md-3 p-2">
															<a id="trade-<?= $key ?>-link" href="<?= $photoUrl ?>" data-lightbox="device-gallery" data-title="<?= $label ?>">
																<img id="trade-<?= $key ?>" src="<?= $photoUrl ?>" class="img-fluid img-thumbnail" style="max-height: 120px; object-fit: cover; cursor: pointer;" alt="<?= $label ?>">
															</a>
														</div>
													<?php endforeach; ?>

												</div>
											</div>

											<div class="review-item"><strong>Fisik 3</strong>
												<div class="">
													<?php
													$photos = [
														'photo_about_phone' => 'photo_about_phone',
													];

													$defaultImage = base_url('assets/img/default.png'); // Gambar default jika tidak ada foto

													foreach ($photos as $key => $label) :
														$photoUrl = !empty($tradeData->$key) ? base_url('uploads/quisioner/') . $tradeData->$key : $defaultImage;
													?>
														<div class="col-md-3 p-2">
															<a id="trade-<?= $key ?>-link" href="<?= $photoUrl ?>" data-lightbox="device-gallery" data-title="<?= $label ?>">
																<img id="trade-<?= $key ?>" src="<?= $photoUrl ?>" class="img-fluid img-thumbnail" style="max-height: 120px; object-fit: cover; cursor: pointer;" alt="<?= $label ?>">
															</a>
														</div>
													<?php endforeach; ?>

												</div>
											</div>

											<div class="review-item"><strong>Fisik 4</strong>
												<div class="">
													<?php
													$photos = [
														'photo_true_tone' => 'photo_true_tone',
													];

													$defaultImage = base_url('assets/img/default.png'); // Gambar default jika tidak ada foto

													foreach ($photos as $key => $label) :
														$photoUrl = !empty($tradeData->$key) ? base_url('uploads/quisioner/') . $tradeData->$key : $defaultImage;
													?>
														<div class="col-md-3 p-2">
															<a id="trade-<?= $key ?>-link" href="<?= $photoUrl ?>" data-lightbox="device-gallery" data-title="<?= $label ?>">
																<img id="trade-<?= $key ?>" src="<?= $photoUrl ?>" class="img-fluid img-thumbnail" style="max-height: 120px; object-fit: cover; cursor: pointer;" alt="<?= $label ?>">
															</a>
														</div>
													<?php endforeach; ?>

												</div>
											</div>

											<div class="review-item"><strong>Quisioner 5</strong>
												<div class="">
													<div id="trade-battery-health">
														<?php $batteryData = battery_status($tradeData->battery_health); ?>
														<?php if (!empty($batteryData)): ?>
															<?php foreach ($batteryData as $item): ?>
																<span class="label label-primary"><?= $item['text'] ?></span>
															<?php endforeach; ?>
														<?php else: ?>
															<span class="badge badge-secondary">Tidak Ada Data</span>
														<?php endif; ?>
													</div>
												</div>
											</div>




											<div class="review-item"><strong>Quisioner 6:</strong> <span id="trade-storage"><?php $quisioner6 = quiz_6($tradeData->quisioner_6); ?>

													<div class="">
														<?php
														$photos = [
															'photo_battery_health' => 'photo_battery_health',
														];

														$defaultImage = base_url('assets/img/default.png'); // Gambar default jika tidak ada foto

														foreach ($photos as $key => $label) :
															$photoUrl = !empty($tradeData->$key) ? base_url('uploads/quisioner/') . $tradeData->$key : $defaultImage;
														?>
															<div class="col-md-3 p-2">
																<a id="trade-<?= $key ?>-link" href="<?= $photoUrl ?>" data-lightbox="device-gallery" data-title="<?= $label ?>">
																	<img id="trade-<?= $key ?>" src="<?= $photoUrl ?>" class="img-fluid img-thumbnail" style="max-height: 120px; object-fit: cover; cursor: pointer;" alt="<?= $label ?>">
																</a>
															</div>
														<?php endforeach; ?>

													</div>

											</div>
										</div>
									</div>
								</div>
							</div>


							<button class="btn btn-dark w-100 mt-3" data-bs-toggle="collapse" data-bs-target="#extraInfo">Hasil Grading</button>
							<div id="extraInfo" class="collapse  mt-3">
								<div class="card card-body">
									<div class="review-section">
										<div class="review-header">Review Perangkat</div>
										<div class="review-details">
											<div class="review-item"><strong>Smartphone:</strong> <span id="trade-smartphone"><?= $tradeData->merk . ' / ' . $tradeData->model . ' / ' . $tradeData->type ?></span></div>
											<div class="review-item"><strong>Penyimpanan:</strong> <span id="trade-storage"><?= $tradeData->storage ?></span></div>
											<div class="review-item"><strong>Grading pada:</strong> <span id="trade-created-at"><?= $tradeData->created_at ?></span></div>
											<div class="review-item"><strong>Harga:</strong> <span class="text-success" id="trade-harga"><?= $tradeData->harga ?></span> <span class="status-badge gold" id="trade-grade"><?= $tradeData->grade ?></span></div>
											<div class="review-item"><strong>Kelengkapan:</strong> <span id="trade-kelengkapan"><?= kelengkapan_hp($tradeData->quisioner_5) ?></span></div>
										</div>
										<div class="btn-container">
											<button class="btn btn-primary">Kirim Notifikasi</button>
										</div>
									</div>
								</div>
							</div>

							<button class="btn btn-dark w-100 mt-3" data-bs-toggle="collapse" data-bs-target="#gradingAdmin">Grading </button>
							<div id="gradingAdmin" class="collapse  mt-3">
								<div class="card card-body">
									<div class="review-section">
										<div class="dynamic-category kategori-lcd">
											<h2 class="text-lg font-semibold mb-2"> Kategori LCD</h2>
											<select id="kategori-lcd" class="form-select w-full" multiple>
												<option value="Normal">Normal</option>
												<option value="Lecet/Baret Halus (Tidak Terasa)">Lecet/Baret Halus (Tidak Terasa)</option>
												<option value="Lecet/Baret Kasar/Dalam (Terasa)">Lecet/Baret Kasar/Dalam (Terasa)</option>
												<option value="LCD Retak">LCD Retak</option>
												<option value="LCD PECAH">LCD PECAH</option>
												<option value="LCD Shadow/Berbayang">LCD Shadow/Berbayang</option>
												<option value="LCD Bergaris">LCD Bergaris</option>
												<option value="LCD Berubah Warna (Merah/ Kuning /Hijau dst)">LCD Berubah Warna (Merah/ Kuning /Hijau dst)</option>
												<option value="LCD Terangkat">LCD Terangkat</option>
												<option value="LCD Dot Hitam">LCD Dot Hitam</option>
												<option value="LCD Bercak Hitam">LCD Bercak Hitam</option>
												<option value="LCD Titik Putih">LCD Titik Putih</option>
												<option value="LCD Bercak Putih">LCD Bercak Putih</option>
												<option value="Finger Print Bermasalah">Finger Print Bermasalah</option>
												<option value="Non Genuine Part - iOS (True Tone OFF)">Non Genuine Part - iOS (True Tone OFF)</option>
											</select>
										</div>

										<div class="dynamic-category kategori-baterai">
											<h2 class="text-lg font-semibold mb-2"> Kategori Baterai</h2>
											<select id="kategori-baterai" class="form-select w-full">
												<option value="100%">100%</option>
												<option value="95% - 99%">95% - 99%</option>
												<option value="90% - 94%">90% - 94%</option>
												<option value="85% - 89%">85% - 89%</option>
												<option value="84%">
													< 84% </option>
												<option value="batterai_service">Baterai Service</option>
												<option value="komponen_tidak_diketahui">Komponen Tidak Diketahui</option>
												<option value="batterai_kembung">Baterai Kembung</option>
												<option value="batterai_drop">Baterai Drop</option>
											</select>
										</div>

										<div class="dynamic-category kategori-backcover">
											<h2 class="text-lg font-semibold mb-2"> Kategori Back Cover</h2>
											<select id="kategori-backcover" class="form-select w-full" multiple>
												<option value="Normal">Normal</option>
												<option value="Back Cover Berjamur">Back Cover Berjamur</option>
												<option value="Lecet/Baret Halus (Tidak Terasa)">Lecet/Baret Halus (Tidak Terasa)</option>
												<option value="Lecet/Baret Kasar/Dalam (Terasa)">Lecet/Baret Kasar/Dalam (Terasa)</option>
												<option value="Terkelupas">Terkelupas</option>
												<option value="Penyok">Penyok</option>
												<option value="Retak">Retak</option>
												<option value="Pecah">Pecah</option>
											</select>
											</select>
										</div>

										<div class="dynamic-category kategori-body">
											<h2 class="text-lg font-semibold mb-2"> Kategori Body</h2>
											<select id="kategori-body" class="form-select w-full" multiple>
												<option value="normal">Normal</option>
												<option value="Berjamur">Berjamur</option>
												<option value="Lecet/Baret Halus (Tidak Terasa)">Lecet/Baret Halus (Tidak Terasa)</option>
												<option value="Lecet/Baret Kasar/Dalam (Terasa)">Lecet/Baret Kasar/Dalam (Terasa)</option>
												<option value="Terkelupas">Terkelupas</option>
												<option value="Penyok">Penyok</option>
												<option value="Retak">Retak</option>
												<option value="Pecah">Pecah</option>
												<option value="Tombol Hilang (On/Off, Volume/ Sim Tray)">Tombol Hilang (On/Off, Volume/ Sim Tray)</option>
											</select>
										</div>
										<div class="dynamic-category kategori-service">
											<h2 class="text-lg font-semibold mb-2"> Kategori Service</h2>
											<select id="kategori-service" class="form-select w-full" multiple>
												<option value="Tidak (Masih Garansi Resmi)">Tidak (Masih Garansi Resmi)</option>
												<option value="Tidak (Garansi Resmi sudah Berakhir)">Tidak (Garansi Resmi sudah Berakhir)</option>
												<option value="Pernah Service LCD">Pernah Service LCD</option>
												<option value="Pernah Service Board/Mesin">Pernah Service Board/Mesin</option>
												<option value="Pernah Service Kamera">Pernah Service Kamera</option>
												<option value="Pernah Ganti/Service Baterai">Pernah Ganti/Service Baterai</option>
											</select>
										</div>

										<div class="dynamic-category kategori-kelengkapan">
											<h2 class="text-lg font-semibold mb-2"> Kategori Kelengkapan</h2>
											<select id="kategori-kelengkapan" class="form-select w-full" multiple>
												<option value="Handphone Saja">Handphone Saja</option>
												<option value="Ada Box (IMEI di Box dan HP Sama)">Ada Box (IMEI di Box dan HP Sama)</option>
												<option value="Ada Box (IMEI di Box dan HP Tidak Sama)">Ada Box (IMEI di Box dan HP Tidak Sama)</option>
												<option value="Ada Kaber Charger">Ada Kaber Charger</option>
												<option value="Ada Adaptor Charger">Ada Adaptor Charger</option>
											</select>
										</div>


										<!-- <div class="dynamic-category kategori-software">
											<h2 class="text-lg font-semibold mb-2"> Kategori Software - Pilih Kerusakan</h2>
											<select id="kategori-software" class="form-select w-full" multiple>
												<option value="Normal">Normal</option>
												<option value="CPU">CPU</option>
												<option value="Hard Disk">Hard Disk</option>
												<option value="Baterai">Baterai</option>
												<option value="Tombol Senyap">Tombol Senyap</option>
												<option value="Tombol Power">Tombol Power</option>
												<option value="Tombol Volume (+/-)">Tombol Volume (+/-)</option>
												<option value="Kamera">Kamera</option>
												<option value="Layar">Layar</option>
												<option value="Biometrik (Face ID dll)">Biometrik (Face ID dll)</option>
												<option value="Sim Card (Signal)">Sim Card (Signal)</option>
												<option value="Speakers">Speakers</option>
											</select>
										</div> -->

										<div class="dynamic-category kategori-lainnya">
											<h2 class="text-lg font-semibold mb-2"> Kategori Lainnya</h2>
											<select id="kategori-lainnya" class="form-select w-full" multiple>
												<option value="Sim Terkunci">Sim Terkunci</option>
												<option value="Carrier Locked (IMEI Terkunci)">Carrier Locked (IMEI Terkunci)</option>
												<option value="Provider Locked (Terkunci oleh Provider Telekomunikasi)">Provider Locked (Terkunci oleh Provider Telekomunikasi)</option>
											</select>
										</div>
									</div>

									<button id="kirim-jawaban" class="btn-kirim bg-blue-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-blue-600">Kirim Jawaban</button>

								</div>
							</div>



							<div class="grading-section mt-3">
								<label for="gradeSelection" class="form-label">Paksa Pilih Grade:</label>
								<select id="gradeSelection" class="form-select">
									<option value="0">Pilih Grade</option>
									<option value="A" <?= isset($data->grade) && $data->grade == 'A' ? 'selected' : '' ?>>A</option>
									<option value="B" <?= isset($data->grade) && $data->grade == 'B' ? 'selected' : '' ?>>B</option>
									<option value="C" <?= isset($data->grade) && $data->grade == 'C' ? 'selected' : '' ?>>C</option>
									<option value="D" <?= isset($data->grade) && $data->grade == 'D' ? 'selected' : '' ?>>D</option>
									<option value="E" <?= isset($data->grade) && $data->grade == 'E' ? 'selected' : '' ?>>E</option>
								</select>
								<button class="btn btn-success mt-2" id="generateGrade">Hasilkan Grade</button>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
	<script src="https://cdn.socket.io/4.0.1/socket.io.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

	<?php
	$ci = &get_instance();
	$socket_url = $ci->config->item('socket_server_url'); // Ambil URL dari config

	?>
	<script>
		$(document).ready(function() {
			const socket = io("<?= $socket_url; ?>");
			// Ambil ID transaksi dari halaman
			const tradeId = "<?= $tradeData->id_transaction_tradein ?>";


			console.log("Menghubungkan ke Socket.IO, tradeId:", tradeId);

			// **Gabung ke Room berdasarkan ID transaksi**
			socket.emit("join_room", tradeId, (response) => {
				console.log("Response setelah join room:", response);
			});

			// **Dapatkan update hanya untuk room ini**
			socket.on("update_trade_" + tradeId, function(data) {
				console.log("🚀 Update diterima untuk transaksi:", data);
				fetchTradeData();

			});

			// **Debug jika terjadi error**
			socket.on("connect_error", (error) => {
				console.error("Socket.IO connection error:", error);
			});

			socket.on("disconnect", () => {
				console.log("🔴 Socket disconnected");
			});

			function updateKelengkapan(kelengkapanHTML) {
				if (kelengkapanHTML.trim() === "") {
					kelengkapanHTML = '<span class="text-danger">Tidak ada kelengkapan</span>';
				}

				// Perbarui elemen HTML di halaman
				$("#trade-kelengkapan").html(kelengkapanHTML);
			}

			function fetchTradeData() {
				$.ajax({
					url: "<?= base_url('Trade/fetchTradeData?id=') . $tradeData->id_transaction_tradein . '&kode_trade=' . $tradeData->kode_trade ?>",
					type: "GET",
					dataType: "json",
					success: function(response) {
						if (response.status) {
							let data = response.data;

							// **Update Data di Halaman Tanpa Reload**
							$("#trade-status").text(data.status);
							$("#trade-harga").text(data.harga);
							$("#trade-grade").text(data.grade);
							$("#trade-imei").text(data.imei);

							$("#trade-photo-front").attr("src", "<?= base_url('uploads/quisioner/') ?>" + data.photo_front);
							$("#trade-photo-back").attr("src", "<?= base_url('uploads/quisioner/') ?>" + data.photo_back);
							$("#trade-tanggal").text(data.created_at || '-');
							$("#trade-imei").text(data.imei || '-');
							$("#trade-kode").text((data.kode_trade || '-') + " / " + (data.transaction_code || '-'));
							$("#trade-merk").text((data.merk || '-') + " / " + (data.model || '-'));
							$("#trade-status").html('<span class="status-badge green">' + (data.status || 'Pending') + '</span>');
							$("#trade-type").text(data.type || '-');
							$("#trade-mitra").text(data.nama_mitra || '-');
							$("#trade-storage").text(data.storage || '-');
							$("#trade-toko").text(data.nama_toko || '-');
							$("#trade-pemeriksa").text(data.nama_toko || '-');
							$("#trade-harga").text(data.harga || '0');
							$("#trade-grade").text(data.grade || '-');

							let defaultImage = "<?= base_url('assets/img/default.png') ?>";

							updateKelengkapan(data.kelengkapan_text);

							let photoFields = [
								"photo_front",
								"photo_back",
								"photo_top",
								"photo_bottom",
								"photo_about_phone",
								"photo_true_tone",
								"photo_battery_health"
							];

							// **Loop Update Semua Foto**
							photoFields.forEach((key) => {
								let photoUrl = data[key] ? "<?= base_url('uploads/quisioner/') ?>" + data[key] : defaultImage;
								$("#trade-" + key).attr("src", photoUrl);
								$("#trade-" + key + "-link").attr("href", photoUrl);
							});

							$("#trade-sim-card").html("Kartu SIM " + statusIcon(data.sim_card));
							$("#trade-touchscreen").html("Layar Sentuh " + statusIcon(data.touchscreen));
							$("#trade-biometric").html("Biometrik (Fingerprint) " + statusIcon(data.biometric));

							$("#trade-kelengkapan").text(kelengkapanHp(data.quisioner_5));
							$("#trade-photo-front-status").html("Foto bagian depan " + statusIcon(data.photo_front));
							$("#trade-photo-back-status").html("Foto bagian belakang " + statusIcon(data.photo_back));

							$("#trade-button-volume").html("Tombol Volume " + statusIcon(data.button_volume_up));
							$("#trade-button-silent").html("Tombol Kembali / Silent " + statusIcon(data.button_silent));
							$("#trade-button-power").html("Tombol Power " + statusIcon(data.button_power));

							$("#trade-cpu").html("CPU " + statusIcon(data.cpu));
							$("#trade-storage").html("Penyimpanan " + statusIcon(data.hardisk));
							$("#trade-battery").html("Kondisi Baterai " + statusIcon(data.battery));
							$("#trade-smartphone").text(data.merk + " / " + data.model + " / " + data.type);
							$("#trade-storage").text(data.storage);
							$("#trade-created-at").text(data.created_at);
							$("#trade-harga").text(data.harga);
							$("#trade-grade").text(data.grade);
							$("#trade-kelengkapan").text(kelengkapanHp(data.quisioner_5));
							sws("Data Update")

						}
					},
					error: function(xhr, status, error) {
						console.error("Error fetching data:", error);
					}
				});
			}

			function statusIcon(value) {
				if (value === "working") {
					return '<span class="badge bg-success">✅</span>';
				} else if (value === "not_working") {
					return '<span class="badge bg-danger">❌</span>';
				}
				return '<span class="badge bg-secondary">⏳</span>'; // Jika data belum ada
			}

			// **Fungsi untuk mengembalikan kelengkapan HP**
			function kelengkapanHp(value) {
				return value ? value : "Tidak ada data";
			}


			$("#generateGrade").click(function() {
				var selectedGrade = $("#gradeSelection").val();
				if (selectedGrade === "0") {
					swe("Pilih grade terlebih dahulu!");
					// alert("Pilih grade terlebih dahulu!");
					return;
				}
				var tradeId = "<?= $tradeData->id_transaction_tradein ?>"; // Pastikan ID trade tersedia

				$.ajax({
					url: "<?= base_url('Grading/grade_manual') ?>",
					type: "POST",
					data: {
						id_transaction_tradein: tradeId,
						grade: selectedGrade
					},
					dataType: "json",
					success: function(response) {
						if (response.status === 'success') {
							Swal.fire({
								icon: 'success',
								title: 'Berhasil',
								text: 'Grade berhasil diperbarui!'
							});
							socket.emit("update_trade_kelengkapan", {
								id_transaction_tradein: tradeId,
								grade: selectedGrade
							});
							socket.emit("new_transaction", {
								id_transaction_tradein: tradeId,
								grade: selectedGrade
							});
							setTimeout(() => {
								location.reload(); // Refresh halaman jika perlu


							}, 1200);
						} else {
							Swal.fire({
								icon: 'error',
								text: response.message
							});
						}
					},
					error: function() {
						alert("Gagal menghubungi server.");
					}
				});
			});
			$('#kategori-kelengkapan').select2({
				placeholder: "Pilih Kategori Kelengkapan",
				width: '100%'
			});

			$('#kategori-kelengkapan').on('change', function() {
				let selectedOptions = $(this).val() || [];
				if (selectedOptions.includes('Handphone Saja')) {
					$('#kategori-kelengkapan').find('option:not([value="Handphone Saja"])').prop('disabled', true);
					$('#kategori-kelengkapan').select2({
						placeholder: "Hanya Handphone Saja yang dipilih"
					});
				} else {
					$('#kategori-kelengkapan').find('option[value="Handphone Saja"]').prop('disabled', selectedOptions.length > 0);
					$('#kategori-kelengkapan').find('option:not([value="Handphone Saja"])').prop('disabled', false);
					$('#kategori-kelengkapan').select2();
				}
			});

			var statusGrading = "<?= $tradeData->status ?>"
			if (statusGrading !== 'waiting_review' && statusGrading !== 'waiting_software') {
				$('#countdown').hide();
			}
			const selectElements = [
				'#kategori-lcd',
				'#kategori-baterai',
				'#kategori-backcover',
				'#kategori-body',
				'#kategori-service',
				// '#kategori-software',
				'#kategori-lainnya'
			];
			selectElements.forEach(function(selector) {
				$(selector).select2({
					placeholder: "Kriteria " + $(selector).closest('div').find('h2').text(),
					width: '100%'
				});
			});
			$('#kirim-jawaban').on('click', function() {
				let isValid = true;
				let unselectedCategories = [];

				// Loop melalui semua select dalam #gradingAdmin, kecuali kategori-lainnya
				$('#gradingAdmin select').each(function() {
					let id = $(this).attr('id').replace('kategori-', '');

					// Lewati validasi jika kategori-lainnya
					if (id === 'lainnya') {
						return;
					}

					// Validasi: cek apakah kategori belum dipilih
					if (!$(this).val() || $(this).val().length === 0) {
						isValid = false;
						let categoryName = $(this).closest('.dynamic-category').find('h2').text().trim();
						unselectedCategories.push(categoryName);
					}
				});

				// Jika ada kategori yang belum dipilih (selain kategori-lainnya), tampilkan alert
				if (!isValid) {
					let categoryList = unselectedCategories.map(cat => `<li>${cat}</li>`).join('');

					Swal.fire({
						title: 'Oops!',
						html: `<p>Harap pilih minimal satu opsi untuk setiap kategori berikut:</p>
                       <ul style="text-align: left; padding-left: 20px;">${categoryList}</ul>`,
						icon: 'error',
						confirmButtonColor: '#d33',
						confirmButtonText: 'Mengerti'
					});
					return;
				}

				// Konfirmasi sebelum mengirim data
				Swal.fire({
					title: 'Apakah Anda yakin?',
					text: 'Semua pilihan akan dikirim.',
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Ya, Kirim!'
				}).then((result) => {
					if (result.isConfirmed) {
						var data = {};

						// Loop untuk mengambil data yang akan dikirim, kecuali kategori-lainnya jika kosong
						$('#gradingAdmin select').each(function() {
							let id = $(this).attr('id').replace('kategori-', '');
							let value = $(this).val();

							if (id === 'lainnya' && (!value || value.length === 0)) {
								return; // Jangan kirim kategori-lainnya jika kosong
							}

							data[id] = value;
						});

						// Kirim data via AJAX
						$.ajax({
							type: "post",
							url: "<?= base_url() ?>Trade/jawabanGradeAdmin",
							data: {
								data,
								id_transaction: '<?= $tradeData->id_transaction_tradein ?>'
							},
							dataType: "json",
							success: function(r) {
								Swal.fire({
									title: 'Berhasil!',
									text: r.message,
									icon: 'success',
									confirmButtonColor: '#3085d6',
									confirmButtonText: 'OK'
								});
							},
							error: function() {
								Swal.fire({
									title: 'Gagal!',
									text: r.message,
									icon: 'error',
									confirmButtonColor: '#d33',
									confirmButtonText: 'Tutup'
								});
							}
						});
					}
				});
			});

		})
	</script>
	<script>
		// Mengambil nilai countdown dari konfigurasi PHP
		<?php $countdown = $this->config->item('countdown'); ?>
		const timeConfig = <?= isset($countdown) ? $countdown : 30; ?>;
		let timeLeft = timeConfig;
		const progressBar = document.getElementById('progress-bar');
		const countdownText = document.getElementById('countdown-text');

		const countdownInterval = setInterval(() => {
			timeLeft--;
			const percentage = (timeLeft / timeConfig) * 100;
			progressBar.style.width = percentage + '%';
			countdownText.textContent = timeLeft + ' detik';

			// Mengubah warna progress bar berdasarkan waktu tersisa
			if (timeLeft > timeConfig * 0.67) {
				progressBar.className = 'progress-bar bg-primary'; // Biru
			} else if (timeLeft > timeConfig * 0.33) {
				progressBar.className = 'progress-bar bg-success'; // Hijau
			} else if (timeLeft > 7) {
				progressBar.className = 'progress-bar bg-warning'; // Kuning
			} else {
				progressBar.className = 'progress-bar bg-danger'; // Merah
				countdownText.classList.add('shake'); // Menambahkan efek getar saat waktu < 7 detik
			}

			// Menghentikan countdown jika mencapai 0
			if (timeLeft <= 0) {
				clearInterval(countdownInterval);
				countdownText.textContent = 'Waktu Habis!';
				countdownText.classList.remove('shake');
			}
		}, 1000);
	</script>
