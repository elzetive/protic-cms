# PROTIC CMS - Management System UKM PROTIC PNC

Sistem Manajemen Konten dan Administrasi Internal yang dikembangkan untuk **UKM PROTIC (Programming Technology Informatics Club)** di Politeknik Negeri Cilacap. Aplikasi ini mengelola informasi publik seperti Program Kerja dan Prestasi, serta administrasi internal organisasi.

## 🛠️ Fitur Utama
Sistem ini mencakup berbagai modul manajemen yang sudah aktif:
* **Manajemen Konten Publik**: CRUD Program Kerja dan Prestasi dengan fitur *Preview Modal* dan Halaman Detail Premium.
* **Manajemen Struktur Pengurus**: Pengelolaan data fungsionaris (BPH).
* **Manajemen Keuangan (Kas)**: Pencatatan kas masuk dan keluar organisasi.
* **Manajemen Absensi**: Sistem pencatatan kehadiran anggota.
* **Manajemen Arsip**: Pengelolaan dokumen dan file penting organisasi.

## 💻 Tech Stack
* **Framework**: Laravel
* **Styling**: Tailwind CSS
* **Database**: MySQL/MariaDB
* **Tooling**: Laragon (Local Development)

## 📥 Panduan Instalasi

Ikuti langkah-langkah berikut untuk menjalankan proyek di perangkat lokal Anda:

1. **Clone Repository**
   ```bash
   git clone [https://github.com/elzetive/protic_cms.git](https://github.com/elzetive/protic_cms.git)
   cd protic_cms

2. **Install Dependensi PHP**

   ```bash
    composer install

3. **Konfigurasi Database**
   * Buat database baru di MySQL dengan nama `protic_cms`.
   * Salin file `.env.example` menjadi `.env`.
   * Sesuaikan `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD` di dalam file `.env`.

4. **Setup Aplikasi**
   ```bash
   php artisan key:generate
   php artisan storage:link

5. **Migrasi & Seeder**
Jalankan perintah ini untuk membuat tabel dan mengisi akun admin default:

   ```bash
    php artisan migrate:fresh --seed

6. **Jalankan Server**

   ```bash
    php artisan serve

## 🔐 Akses Login Admin
Gunakan akun default berikut untuk masuk ke Dashboard:
* **Email**: `admin@protic.com`
* **Password**: `protic2026`

## 💡 Catatan Tambahan
* **IDE Helper**: Proyek ini menyertakan file `_ide_helper.php` untuk mendukung fitur *intellisense* (autofill kode) yang lebih baik di VS Code.
* **Ikon**: Aplikasi ini menggunakan library **FontAwesome** untuk elemen visual. (Cara cek: Lihat di file `resources/views/user/layouts/app.blade.php`, terdapat link CDN FontAwesome di bagian `<head>`).

## 👤 Pengembang
**Dimas Riyan Wirayuda**  
Mahasiswa D3 Teknik Informatika - Politeknik Negeri Cilacap.
