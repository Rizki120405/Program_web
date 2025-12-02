# Sistem Penggajian Karyawan

Sistem Penggajian Karyawan adalah aplikasi berbasis web yang dirancang untuk mengelola data karyawan, absensi, dan penggajian di sebuah perusahaan.

## Fitur Utama

- Manajemen data karyawan
- Sistem absensi karyawan
- Perhitungan gaji otomatis
- Slip gaji digital
- Sistem autentikasi dan otorisasi
- Dashboard admin dan karyawan

## Struktur Proyek

```
PenggajianKaryawan/
│
├─ app/
│   ├─ config/
│   │   └─ database.php
│   ├─ controllers/
│   │   ├─ AuthController.php
│   │   ├─ KaryawanController.php
│   │   ├─ AbsensiController.php
│   │   └─ PenggajianController.php
│   ├─ models/
│   │   ├─ User.php
│   │   ├─ Karyawan.php
│   │   ├─ Absensi.php
│   │   └─ Penggajian.php
│   └─ helpers/
│       └─ auth.php
│
├─ public/
│   ├─ index.php
│   ├─ login.php
│   ├─ css/
│   ├─ js/
│   └─ uploads/
│
├─ resources/
│   ├─ views/
│   │   ├─ layouts/
│   │   │   └─ main.php
│   │   ├─ auth/
│   │   │   └─ login.php
│   │   ├─ dashboard/
│   │   │   ├─ admin.php
│   │   │   └─ karyawan.php
│   │   ├─ karyawan/
│   │   ├─ absensi/
│   │   └─ penggajian/
│   └─ templates/
│
├─ vendor/
│
└─ .env
```

## Instalasi

1. Clone atau download proyek ini
2. Buat database MySQL dengan nama `penggajian_karyawan`
3. Sesuaikan konfigurasi database di file `.env`
4. Impor struktur database (akan ditambahkan kemudian)
5. Akses aplikasi melalui browser

## Konfigurasi Database

Edit file `.env` sesuai dengan konfigurasi database Anda:

```
DB_HOST=localhost
DB_NAME=penggajian_karyawan
DB_USER=nama_user
DB_PASS=kata_sandi
```

## Hak Akses

- **Admin**: Bisa mengelola semua data (karyawan, absensi, penggajian)
- **Karyawan**: Bisa melihat data pribadi dan slip gaji

## Teknologi yang Digunakan

- PHP 7.4+
- MySQL
- Bootstrap 5
- JavaScript
- Font Awesome

## Catatan

Aplikasi ini masih dalam pengembangan dan akan terus ditingkatkan sesuai kebutuhan.