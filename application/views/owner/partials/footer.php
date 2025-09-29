            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 text-center">
                            <p class="text-muted mb-0">
                                © <script>document.write(new Date().getFullYear())</script> <?= $this->config->item('title') ?>
                                <span class="d-none d-sm-inline-block"> - Laundry Management System</span>
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="<?= base_url('assets/assets/libs/jquery/jquery.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/assets/libs/metismenu/metisMenu.min.js') ?>"></script>
    <script src="<?= base_url('assets/assets/libs/simplebar/simplebar.min.js') ?>"></script>
    <script src="<?= base_url('assets/assets/libs/node-waves/waves.min.js') ?>"></script>
    <script src="<?= base_url('assets/assets/js/app.js') ?>"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        $(document).ready(function() {
            // DataTables - Skip auto-init for tables with custom initialization
            if ($('.table:not(#customerTable, #adminTable, #ownerTable, #roleTable)').length && typeof $.fn.DataTable !== 'undefined') {
                $('.table:not(#customerTable, #adminTable, #ownerTable, #roleTable)').DataTable({
                    responsive: true,
                    pageLength: 10,
                    language: {
                        "sProcessing": "Sedang memproses...",
                        "sLengthMenu": "Tampilkan _MENU_ entri",
                        "sZeroRecords": "Tidak ditemukan data yang sesuai",
                        "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                        "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                        "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                        "sSearch": "Cari:",
                        "oPaginate": {
                            "sFirst": "Pertama",
                            "sPrevious": "Sebelumnya",
                            "sNext": "Selanjutnya",
                            "sLast": "Terakhir"
                        }
                    }
                });
            }

            // Dark mode toggle
            const themeToggle = document.getElementById('theme-toggle');
            const themeIcon = document.getElementById('theme-icon');
            const body = document.body;
            
            // Load saved theme
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'dark') {
                body.classList.add('dark-mode');
                if (themeIcon) themeIcon.className = 'fas fa-sun';
            }
            
            if (themeToggle) {
                themeToggle.addEventListener('click', function() {
                    if (body.classList.contains('dark-mode')) {
                        body.classList.remove('dark-mode');
                        if (themeIcon) themeIcon.className = 'fas fa-moon';
                        localStorage.setItem('theme', 'light');
                    } else {
                        body.classList.add('dark-mode');
                        if (themeIcon) themeIcon.className = 'fas fa-sun';
                        localStorage.setItem('theme', 'dark');
                    }
                });
            }

            // Clean up modal backdrops
            $('.modal-backdrop').remove();
            $('body').removeClass('modal-open');
            $('body').css('padding-right', '');
            
            // Handle modal cleanup
            $('.modal').on('hidden.bs.modal', function () {
                $('.modal-backdrop').remove();
                $('body').removeClass('modal-open');
                $('body').css('padding-right', '');
            });
        });

        // SweetAlert2 Global Configuration
        const Toast = Swal.mixin({
            backdrop: true,
            allowOutsideClick: true,
            heightAuto: false,
            customClass: {
                container: 'swal2-container-custom'
            }
        });

        // SweetAlert2 configuration
        const swalConfig = {
            backdrop: true,
            allowOutsideClick: true,
            heightAuto: false,
            showClass: {
                backdrop: 'swal2-backdrop-show'
            },
            customClass: {
                container: 'swal2-container-custom'
            }
        };

        // SweetAlert2 functions
        function showSuccess(message) {
            Swal.fire({
                ...swalConfig,
                icon: 'success',
                title: 'Berhasil!',
                text: message,
                timer: 2000,
                showConfirmButton: false
            });
        }

        function showError(message) {
            Swal.fire({
                ...swalConfig,
                icon: 'error',
                title: 'Error!',
                text: message
            });
        }

        function confirmDelete(callback) {
            Swal.fire({
                ...swalConfig,
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    callback();
                }
            });
        }
    </script>
</body>
</html>