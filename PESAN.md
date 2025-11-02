# 🧺 Software Laundry Management System Berbasis Web Dengan PHP dan MySQL

Aplikasi laundry management system berbasis web kami kembangkan dan kami uji di lingkungan pengembangan sebagai berikut:
- Menggunakan PHP Versi 7.4 ke atas, Dites menggunakan XAMPP/MAMP
- Menggunakan Database MariaDB/MySQL
- Menggunakan Javascript dengan library jQuery 3.6
- Menggunakan framework CodeIgniter 3
- Menggunakan Framework CSS Bootstrap 5
- Sistem operasi Windows 10, macOS, dan Linux
- Tablet dan Smartphone (Mobile Responsive)

## 👥 4 Aktor Sistem dengan Hak Akses Berbeda

### 1. **OWNER** (Pemilik Usaha)
**Menu yang dapat diakses:**
- 📊 Dashboard (Statistik lengkap, revenue, recent orders)
- 👤 Master Owner (CRUD owner accounts)
- 🛡️ Master Admin (CRUD admin dengan role permission)
- 💼 Master Kasir (CRUD kasir accounts)
- 🎭 Master Role (CRUD role dan permission)
- 👥 Master Customer (CRUD customer dengan tier system)
- 📋 Master Transaksi (View, filter, update status, detail)
- 💰 Setting Harga Laundry (Dynamic pricing berdasarkan berat)
- 🚚 Setting Harga Ongkir (Distance-based delivery cost)
- 🎯 Setting Discount Tier (Bronze, Silver, Gold, Platinum)
- 📈 Laporan & Export (Excel/PDF)
- 🔧 Pengaturan Sistem

### 2. **ADMIN** (Administrator)
**Menu yang dapat diakses (berdasarkan permission dari Owner):**
- 📊 Dashboard (Sesuai hak akses)
- 👥 Master Customer (jika diberi permission)
- 📋 Master Transaksi (jika diberi permission)
- 💰 Setting Harga (jika diberi permission)
- 📈 Laporan (jika diberi permission)
- ❌ **TIDAK BISA** mengelola Owner dan Role

### 3. **KASIR** (Operator POS)
**Menu yang dapat diakses:**
- 📊 Dashboard Kasir (Counter transaksi hari ini)
- 🛒 POS System (Buat transaksi baru)
- 👤 Pilih Customer (Existing/New/Guest)
- ⚖️ Input Berat & Jarak
- 💵 Hitung Harga Otomatis
- 🖨️ Print Receipt
- 📋 Lihat Transaksi Hari Ini
- 🔐 Logout

### 4. **CUSTOMER/USER** (Pelanggan)
**Fitur yang dapat diakses:**
- 📱 Halaman Mobile-Friendly
- 📞 Input Nomor Telepon (format 8xxx)
- 📋 Lihat Riwayat Transaksi (10 terbaru)
- 🔍 Detail Transaksi Lengkap
- 📊 Status Tracking (Pending/Process/Completed/Cancelled)
- 💰 Breakdown Perhitungan Harga
- 📄 Info Kasir dan Tanggal Transaksi

## 🚀 Fitur Utama Software Laundry Management System

Fitur utama software laundry management system berbasis web yang kami kembangkan adalah sebagai berikut:

- **Desain Professional**. Aplikasi ini kami kembangkan dengan teliti, detail dan professional khusus untuk bisnis laundry UMKM.

- **Dashboard Transaksi Komprehensif** yang dapat digunakan untuk memantau perkembangan bisnis laundry Anda dengan real-time statistics.

- **Sistem Multi-Role Management**. Tersedia 4 role berbeda: Owner (full access), Admin (permission-based), Kasir (POS only), dan Customer (transaction checker).

- **Layout POS Kasir yang Adaptif**. Tersedia layout kasir untuk layar besar (PC, laptop) dan layout untuk mobile (tablet dan smartphone). Interface dikembangkan dengan konsep user-friendly.

- **Pengaturan Harga Dinamis**. Anda dapat dengan mudah mengatur harga laundry berdasarkan berat, tier customer, dan biaya ongkir berdasarkan jarak.

- **Desain Receipt Transaksi Professional**. Dokumen receipt transaksi didesain sedemikian rupa sehingga terlihat professional dengan breakdown perhitungan lengkap.

- **Manajemen Customer dengan Tier System**. Sistem tier Bronze, Silver, Gold, Platinum dengan discount otomatis untuk customer loyal.

- **Sistem Tracking Status Transaksi**. Customer dapat dengan mudah memantau status laundry mereka: pending, process, completed, cancelled.

- **Pengaturan Pricing yang Fleksibel**. Aplikasi memungkinkan pengaturan harga laundry berdasarkan berat minimum dan harga ongkir berdasarkan jarak.

- **Dashboard Monitoring Real-time**. Owner dan Admin dapat memantau total customer, order bulan ini, pending orders, dan revenue bulanan.

- **Laporan Transaksi Lengkap**. Tersedia menu laporan transaksi dengan filter tanggal dan detail perhitungan.

- **Ekspor Data ke Berbagai Format**. Laporan transaksi dapat diekspor ke format Excel dan PDF.

- **Mobile-First Customer Portal**. Halaman khusus mobile untuk customer cek transaksi dengan nomor telepon.

- **Security XSS Protection**. Dilengkapi dengan proteksi XSS, input validation, dan sanitization untuk keamanan data.

- **Print Receipt System**. Receipt langsung dapat dicetak dengan detail perhitungan matematika yang akurat.

## 🎯 Keunggulan Khusus UMKM Laundry

- **Mudah Digunakan**. Interface sederhana dan intuitif, cocok untuk staff laundry yang tidak tech-savvy.
- **Perhitungan Otomatis**. Sistem menghitung harga otomatis berdasarkan berat, jarak, dan tier customer.
- **Manajemen Role Fleksibel**. Owner dapat mengatur permission admin sesuai kebutuhan bisnis.
- **Customer Self-Service**. Customer dapat cek status transaksi sendiri tanpa mengganggu kasir.
- **Responsive Design**. Dapat diakses dari PC, tablet, atau smartphone dengan tampilan optimal.

## 💰 Investasi Sekali untuk Selamanya

**Beli sekali untuk selamanya**. Aplikasi menjadi milik Anda, tidak perlu berlangganan bulanan untuk menggunakan aplikasi. Cocok untuk UMKM yang ingin menghemat biaya operasional.

## 📞 Info Demo & Pembelian

**Silahkan Inbox untuk:**
- Demo aplikasi lengkap
- Konsultasi kebutuhan bisnis laundry
- Harga dan paket instalasi
- Training penggunaan aplikasi
- Support dan maintenance

**Ready to boost your laundry business!** 🚀

---

*Aplikasi Laundry Management System - Solusi Digital untuk UMKM Laundry Modern*