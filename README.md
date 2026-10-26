# 🍾 Pitch.Perfume - Inventory Management System

Aplikasi manajemen inventaris stok parfum berbasis web yang dibangun menggunakan **Laravel 10**, **Tailwind CSS**, dan **Chart.js**. Sistem ini dirancang untuk mencatat stok produk, memantau mutasi stok (masuk/keluar), memberikan notifikasi stok kritis, serta menerapkan Role-Based Access Control (RBAC) antara **Admin** dan **Staff**.

---

## 🚀 Fitur Utama

- **Authentication & RBAC (Role-Based Access Control)**
  - **Admin**: Akses penuh ke Dashboard, CRUD Katalog Produk, dan Mutasi Stok.
  - **Staff**: Akses terbatas hanya untuk Dashboard Monitoring dan Input Mutasi Stok.
- **Dashboard Analytics & Real-Time Chart**
  - Monitoring Total Varian, Total Stok Botol, Stok Kritis, dan Penjualan Hari Ini.
  - Grafik visual interaktif jumlah stok per produk menggunakan **Chart.js**.
  - Panel notifikasi otomatis untuk produk yang mencapai/melewati batas `minimum_stock`.
- **Katalog Produk (CRUD)**
  - Tambah, edit, hapus, dan cari data varian parfum lengkap dengan SKU, harga, stok awal, dan minimum stok.
  - Format mata uang otomatis (Rupiah).
- **Mutasi Stok (Stock Mutation)**
  - Pencatatan transaksi **Stok Masuk (Stock-In)** dan **Stok Keluar (Stock-Out)** secara *real-time*.
  - Otomatis memperbarui sisa stok pada tabel produk.

---

## 🛠️ Tech Stack

- **Framework Backend**: Laravel 10 (PHP 8.x)
- **Frontend & Styling**: Blade Templating, Tailwind CSS
- **Visualization**: Chart.js
- **Database**: MySQL / MariaDB

---

## ⚙️ Panduan Instalasi & Pengoperasian

Ikuti langkah-langkah berikut untuk menjalankan project di lingkungan lokal:

### 1. Clone Repository & Install Dependency
```bash
git clone [https://github.com/username-kamu/pitch-perfume.git](https://github.com/username-kamu/pitch-perfume.git)
cd pitch-perfume
composer install
npm install && npm run build