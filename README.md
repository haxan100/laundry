# 🧺 Laundry Management System - UMKM

Sistem manajemen laundry lengkap untuk UMKM dengan fitur POS, manajemen customer, dan laporan transaksi.

## 📋 Deskripsi Aplikasi

Aplikasi web untuk mengelola bisnis laundry dengan sistem multi-role yang memungkinkan owner, admin, dan kasir bekerja sesuai dengan hak akses masing-masing. Dilengkapi dengan sistem POS untuk kasir, dashboard monitoring untuk owner/admin, dan halaman cek transaksi untuk customer.

## 👥 Role & Hak Akses

### 1. **Owner** (Pemilik)
- **Akses**: Semua fitur aplikasi
- **Dashboard**: Statistik lengkap, revenue, recent orders
- **Fitur**:
  - Master Data (Customer, Transaksi, Kasir, Admin, Role)
  - Setting Harga (Laundry, Ongkir, Discount Tier)
  - Laporan & Export
  - Manajemen User

### 2. **Admin** (Administrator)
- **Akses**: Berdasarkan permission yang diberikan owner
- **Dashboard**: Sesuai hak akses
- **Fitur**:
  - Master Data (sesuai permission)
  - Laporan (sesuai permission)
  - Tidak bisa mengelola Owner

### 3. **Kasir** (Operator)
- **Akses**: Sistem POS dan transaksi hari ini
- **Dashboard**: Counter transaksi hari ini
- **Fitur**:
  - POS System (buat transaksi baru)
  - Pilih customer (existing/new/guest)
  - Hitung harga otomatis
  - Print receipt
  - Lihat transaksi hari ini

### 4. **Customer** (Pelanggan)
- **Akses**: Cek status transaksi
- **Fitur**:
  - Cek transaksi dengan nomor telepon
  - Lihat detail transaksi
  - Lihat status (pending/process/completed/cancelled)

## 🚀 Cara Penggunaan

### Setup Awal

1. **Login sebagai Owner**
   ```
   URL: http://localhost/laundry/laundry/dashboard
   Default: Buat akun owner pertama
   ```

2. **Setup Master Data**
   - Buat role dan permission untuk admin
   - Tambah admin dan kasir
   - Set harga laundry dan ongkir
   - Atur discount tier customer

### Operasional Harian

3. **Kasir - Proses Transaksi**
   ```
   URL: http://localhost/laundry/laundry/kasir
   ```
   - Login sebagai kasir
   - Pilih/tambah customer
   - Input berat dan jarak (jika delivery)
   - Sistem hitung harga otomatis
   - Pilih metode pembayaran
   - Print receipt

4. **Owner/Admin - Monitoring**
   ```
   URL: http://localhost/laundry/laundry/owner
   URL: http://localhost/laundry/laundry/admin
   ```
   - Lihat dashboard statistik
   - Monitor transaksi real-time
   - Update status transaksi
   - Export laporan

5. **Customer - Cek Status**
   ```
   URL: http://localhost/laundry/laundry/user
   ```
   - Input nomor telepon (format: 8xxx)
   - Lihat riwayat transaksi
   - Cek status dan detail

## 🛠️ Fitur Utama

### 💰 Sistem Pricing
- **Dynamic Pricing**: Harga berdasarkan berat dan tier
- **Delivery Cost**: Biaya ongkir berdasarkan jarak
- **Customer Tier**: Bronze, Silver, Gold, Platinum dengan discount
- **Auto Calculate**: Perhitungan otomatis di POS

### 📊 Dashboard & Laporan
- **Real-time Stats**: Total customer, order bulan ini, pending orders
- **Revenue Tracking**: Pendapatan bulanan
- **Recent Orders**: 5 transaksi terbaru
- **Export**: Excel/PDF untuk laporan

### 🖨️ Receipt System
- **Detailed Receipt**: Breakdown perhitungan lengkap
- **Customer Info**: Nama, tier, contact
- **Transaction Details**: Kode, tanggal, kasir, status

### 📱 Mobile Friendly
- **Responsive Design**: Optimal di desktop dan mobile
- **Touch Friendly**: Interface mudah digunakan
- **Customer Portal**: Halaman khusus mobile untuk customer

## 🔧 Teknologi

- **Backend**: CodeIgniter 3, PHP, MySQL
- **Frontend**: Bootstrap 5, jQuery, SweetAlert2
- **Database**: MySQL dengan relasi lengkap
- **Security**: MD5 hashing, session management, role-based access, XSS protection

## 🔒 Keamanan (Security)

### **XSS Protection**
- **Global XSS Filtering**: Aktif untuk semua input
- **Input Sanitization**: Otomatis membersihkan script tags, javascript protocols
- **HTML Encoding**: Semua output di-encode untuk mencegah XSS
- **Type Validation**: Validasi khusus untuk email, phone, numeric, alphanumeric

### **Security Helper Functions**
- **`xss_clean()`**: Membersihkan input dari script berbahaya
- **`validate_input()`**: Validasi input berdasarkan tipe data
- **Auto-sanitization**: Semua GET/POST data otomatis dibersihkan

### **Base Controller Protection**
- **MY_Controller**: Extends CI_Controller dengan proteksi otomatis
- **Input Filtering**: Semua input melalui filter keamanan
- **SQL Injection Prevention**: Prepared statements dan input validation

## 📁 Struktur URL

```
/dashboard          - Multi-role login
/owner             - Owner dashboard & management
/admin             - Admin dashboard (permission-based)
/kasir             - POS system untuk kasir
/user              - Customer transaction checker
```

## 🎯 Target Pengguna

Aplikasi ini dirancang khusus untuk **UMKM Laundry** yang membutuhkan:
- ✅ Sistem POS sederhana tapi lengkap
- ✅ Manajemen customer dengan tier system
- ✅ Kontrol harga dan discount fleksibel
- ✅ Laporan dan monitoring real-time
- ✅ Multi-user dengan role berbeda
- ✅ Interface yang user-friendly

---

**Status**: Production Ready ✅  
**Version**: 1.0  
**Last Updated**: Januari 2025