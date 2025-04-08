/**
 * Tampilkan notifikasi sukses.
 * @param {string} message - Pesan yang akan ditampilkan.
 */
function sws(message) {
	Swal.fire({
		icon: "success",
		title: "Berhasil",
		text: message,
		timer: 3000,
		timerProgressBar: true,
		showConfirmButton: false,
	});
}

/**
 * Tampilkan notifikasi error.
 * @param {string} message - Pesan yang akan ditampilkan.
 */
function swe(message) {
	Swal.fire({
		icon: "error",
		title: "Gagal",
		text: message,
		timer: 3000,
		timerProgressBar: true,
		showConfirmButton: false,
	});
}

/**
 * Tampilkan konfirmasi sebelum melakukan aksi.
 * @param {string} message - Pesan konfirmasi.
 * @param {function} onConfirm - Fungsi callback jika pengguna mengonfirmasi.
 */
function swc(message, onConfirm) {
	Swal.fire({
		title: "Konfirmasi",
		text: message,
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Ya, Lanjutkan",
		cancelButtonText: "Batal",
	}).then((result) => {
		if (result.isConfirmed) {
			onConfirm();
		}
	});
}

/**
 * Tampilkan pesan informasi.
 * @param {string} message - Pesan informasi.
 */
function swi(message) {
	Swal.fire({
		icon: "warning",
		title: "Mohon Perhatian",
		text: message,
		timer: 3000,
		timerProgressBar: true,
		showConfirmButton: false,
	});
}
function sww(message) {
	Swal.fire({
		icon: "info",
		title: "Informasi",
		text: message,
		timer: 3000,
		timerProgressBar: true,
		showConfirmButton: false,
	});
}

/**
 * Tampilkan pesan loading.
 * @param {string} message - Pesan loading.
 */
function swl(message = "Memproses...") {
	Swal.fire({
		title: message,
		allowOutsideClick: false,
		didOpen: () => {
			Swal.showLoading();
		},
	});
}

/**
 * Tutup SweetAlert loading.
 */
function closeLoadingAlert() {
	Swal.close();
}
