# 📦 Aplikasi Peminjaman Barang Kampus

Aplikasi manajemen inventaris kampus yang dirancang untuk mendigitalisasi proses peminjaman barang (proyektor, kabel HDMI, tripod, dll). Dibangun menggunakan **Laravel 12**, **Filament v3**, dan dijalankan di lingkungan **Docker/WSL**.

## 🛠️ Tech Stack & Packages

* **Framework**: Laravel 12 (PHP 8.3+)
* **Admin Panel**: [Filament v3](https://filamentphp.com/) (TALL Stack: Tailwind, Alpine.js, Laravel, Livewire)
* **Database**: MySQL 8.0
* **API Documentation**: L5-Swagger
* **Environment**: Docker (Optimized with WSL)

---

## 🚀 Langkah Instalasi (Boilerplate Setup)

Gunakan perintah kustom yang tersedia untuk mempercepat setup di terminal WSL:

1. **Inisialisasi Project**
```bash
./start.sh uaspemweb

```


2. **Konfigurasi Terminal** (Lakukan setelah setup selesai)
```bash
source /root/.zshrc

```


3. **Setup Database & Migrasi**
```bash
dci

```


*Perintah ini otomatis menjalankan `migrate:fresh --seed`.*

---

## ⌨️ Shorthand Commands (Custom Alias)

| Command | Fungsi |
| --- | --- |
| `dcu` | **Docker Up**: Menjalankan container (`docker-compose up -d`) |
| `dcd` | **Docker Down**: Mematikan container (`docker-compose down`) |
| `dci` | **Project Init**: Reset database & seeder |
| `dcm [Nama]` | **Create Module**: Membuat Model, Controller, Migrasi, & Filament Resource |
| `dcr [Nama]` | **Remove Resource**: Menghapus resource terkait model tertentu |
| `dca [Cmd]` | **Artisan**: Shortcut untuk `php artisan` |
| `dcp [Msg]` | **Git Push**: Shortcut `git add`, `commit`, dan `push` |

---

## 🔄 Alur Kerja Sistem (System Workflow)

Sistem ini memiliki logika otomatisasi status barang untuk mencegah kesalahan input manual:

1. **Manajemen Inventaris**: Admin mendaftarkan barang baru. Secara default, sistem memberikan status **"tersedia"**.
2. **Peminjaman (Trigger)**:
* Admin membuat data peminjaman di Filament Dashboard.
* Sistem memvalidasi agar hanya barang berstatus **"tersedia"** yang bisa dipilih.
* **Otomatisasi**: Setelah data peminjaman disimpan, status barang di tabel `barangs` otomatis berubah menjadi **"dipinjam"**.


3. **Monitoring**:
* **Frontend**: Mahasiswa/Staf dapat melihat daftar barang dan statusnya secara real-time.
* **Swagger API**: Dokumentasi endpoint tersedia untuk integrasi eksternal.


4. **Pengembalian (Reset)**:
* Admin menghapus atau menyelesaikan data peminjaman.
* **Otomatisasi**: Sistem memicu perubahan status barang kembali menjadi **"tersedia"** sehingga barang siap dipinjam kembali.



---

## 🔗 Endpoint API

Dokumentasi API interaktif dapat diakses pada:
`http://localhost:8000/api/documentation`

---

## 📊 Skema Database

* **Tabel `barangs**`: Menyimpan info barang (`nama_barang`, `status`).
* **Tabel `peminjams**`: Menyimpan riwayat transaksi (`nama_peminjam`, `barang_id`, `tanggal_pinjam`, `tanggal_kembali`).

---

## 👤 Identitas Pengembang

* **Nama**: Bagas Yoas Sibagariang
* **NIM**: 20230801254
* **Mata Kuliah**: Pemrograman Web (UAS)
