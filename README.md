# PT. Nusantara Portal Inc. — Portal P3MI Terintegrasi

<p align="center">
    <a href="https://laravel.com"><img alt="Laravel v11.x" src="https://img.shields.io/badge/Laravel-v11.x-FF2D20?style=for-the-badge&logo=laravel"></a>
    <a href="https://filamentphp.com"><img alt="Filament v3.x" src="https://img.shields.io/badge/Filament-v3.x-F59E0B?style=for-the-badge"></a>
    <a href="https://livewire.laravel.com"><img alt="Livewire v3.x" src="https://img.shields.io/badge/Livewire-v3.x-FB70A9?style=for-the-badge"></a>
    <a href="https://php.net"><img alt="PHP 8.2+" src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php"></a>
    <a href="https://tailwindcss.com"><img alt="Tailwind CSS" src="https://img.shields.io/badge/TailwindCSS-v3.x-38B2AC?style=for-the-badge&logo=tailwind-css"></a>
</p>

---

## 📌 Ringkasan & Review Aplikasi (Overview)

**PT. Nusantara Portal Inc.** adalah sistem informasi manajemen dan portal operasional terpadu untuk **Perusahaan Penempatan Pekerja Migran Indonesia (P3MI)**. Aplikasi ini dirancang untuk mendigitalkan seluruh siklus hidup penempatan tenaga kerja migran Indonesia secara legal, transparan, dan akuntabel sesuai dengan regulasi resmi pemerintah Republik Indonesia (**BP2MI**, **Kementerian Ketenagakerjaan RI**, **SIAPkerja**, dan **OSS-RBA**).

Sistem ini melayani dua audiens utama:
1. **Publik & Calon Mitra Internasional**: Menghadirkan landing page modern dengan multi-bahasa (ID, EN, TW, CN, JA, KO), showcase kandidat pekerja siap kerja (*talent pool*), transparansi legalitas, serta saluran konsultasi langsung.
2. **Internal Perusahaan & Agensi Luar Negeri**: Back-office berbasis **Filament v3** yang mengelola pendaftaran CPMI, pipeline tahapan proses (MCU, BLK, Paspor, Visa, e-KTKLN, Flight), kurasi marketing, portal agensi luar negeri, hingga generator PDF biodata standar internasional.

---

## 🌟 Fitur Utama (Key Features)

### 1. Landing Page Publik Modern & Responsif
- **Dukungan Multi-Bahasa Native (6 Bahasa)**: Mendukung Bahasa Indonesia (`ID`), English (`EN`), Traditional Chinese/Taiwan (`TW`), Simplified Chinese (`CN`), Japanese (`JA`), dan Korean (`KO`) tanpa ketergantungan API pihak ketiga.
- **Dark & Light Mode**: Deteksi otomatis preferensi waktu/sistem dengan toggle interaktif.
- **Carousel Sinkronisasi Regulasi & Legalitas**: Banner otomatis (*auto-loop*) dengan indikator titik interaktif yang menampilkan sinkronisasi BP2MI, Kemnaker, SIAPkerja, Karirhub, OSS, APJATI, dan BNSP.
- **Showcase Talenta & Tenaga Siap Kerja**: Carousel kartu kandidat CPMI dengan gambar proteksi klik-kanan, penanganan otomatis foto yang gagal dimuat (*graceful fallback*), dan tombol aksi cepat menuju Portal Agency.
- **Modal Informasi Interaktif**:
  - Modal profil perusahaan, legalitas perizinan, visi & misi.
  - Modal Daftar Rekanan Lembaga Pelatihan (LPK/BLK) & Agensi Luar Negeri (dengan pembatasan baris demi privasi data dan tombol detail menuju login).
  - Modal program penempatan Sektor Formal & Informal.
  - Modal kontak kantor cabang dan hotline darurat (SOS 24 Jam).

### 2. Panel Administrasi & Operasional (Filament v3 Back-Office)
- **Pendaftaran CPMI**: Pencatatan data calon pekerja migran, data keluarga, data paspor, data sponsor/PL, riwayat pengalaman, dan integrasi master wilayah Indonesia (**IndoRegion**).
- **Tracking & Pipeline Proses CPMI**:
  - Pelacakan berjenjang: Seleksi ➔ Medical Check Up (MCU) ➔ Pelatihan BLK/LPK ➔ Penerbitan ID BP2MI ➔ Pembuatan Paspor ➔ Pengajuan Visa ➔ Job Order & Kontrak Kerja ➔ PAP (Pembekalan Akhir Pemberangkatan) ➔ e-KTKLN ➔ Penerbangan (Flight).
  - Tampilan visual Kanban/Pipeline untuk memantau status kandidat secara *real-time*.
- **Portal Khusus Agensi Luar Negeri (`/admin/workers`)**:
  - Agensi rekanan di luar negeri dapat mencari, memfilter, dan meninjau portofolio calon pekerja siap kerja sesuai kriteria yang dibutuhkan (usia, tujuan, keahlian, bahasa).
- **Generator Biodata Multi-Negara (Export PDF Otomatis)**:
  - Ekspor format biodata resmi yang disesuaikan dengan regulasi masing-masing negara penempatan:
    - 🇹🇼 **Taiwan** (`/taiwan/{id}/pdf/download`)
    - 🇭🇰 **Hong Kong** (`/hongkong/{id}/pdf/download`)
    - 🇸🇬 **Singapura** (`/singapore/{id}/pdf/download`)
    - 🇲🇾 **Malaysia** (`/malaysia/{id}/pdf/download`)
- **Laporan Operasional & Penempatan**:
  - Filter laporan berdasarkan rentang tanggal, kantor cabang, status proses, dan tujuan negara, dengan opsi cetak PDF.
- **Audit Trail & Keamanan**:
  - Pelacakan riwayat aktivitas dan perubahan data secara otomatis melalui `owen-it/laravel-auditing`.
  - Sistem perizinan ketat berbasis peran (*Role-Based Access Control / RBAC*) menggunakan **Filament Shield**.
  - Monitoring kinerja server terintegrasi dengan **Laravel Pulse**.

---

## 🏗️ Struktur Direktori Proyek (Project Structure)

Berikut adalah gambaran arsitektur dan struktur folder penting dalam aplikasi:

```text
portal-main/
├── app/
│   ├── Filament/                  # Konfigurasi & Panel Back-Office Filament v3
│   │   ├── Pages/                 # Custom Pages (Dashboard, Proses/Pipeline, Workers, Pulse)
│   │   ├── Resources/             # CRUD Resources (Pendaftaran, ProsesCpmi, Marketing, dll)
│   │   │   ├── AgencyResource.php         # Manajemen Agensi Rekanan Luar Negeri
│   │   │   ├── KantorResource.php         # Manajemen Kantor Cabang
│   │   │   ├── MarketingResource.php      # Manajemen Data Marketing / Talent Pool
│   │   │   ├── PelatihanResource.php      # Manajemen Lembaga Pelatihan (LPK / BLK)
│   │   │   ├── PendaftaranResource.php    # Manajemen Pendaftaran CPMI
│   │   │   ├── ProsesCpmiResource.php     # Manajemen Tahapan & Status Proses CPMI
│   │   │   ├── SponsorResource.php        # Manajemen Sponsor / Petugas Lapangan (PL)
│   │   │   ├── TujuanResource.php         # Master Negara Tujuan Penempatan
│   │   │   └── UserResource.php           # Manajemen Pengguna & Hak Akses
│   │   └── Widgets/               # Statistik & Widget Ringkasan Dashboard
│   ├── Http/
│   │   └── Controllers/
│   │       ├── LandingPageController.php  # Controller Halaman Depan & Data Showcase
│   │       ├── HongkongController.php     # Export Biodata Format Hong Kong (PDF)
│   │       ├── TaiwanController.php       # Export Biodata Format Taiwan (PDF)
│   │       ├── SingaporeController.php    # Export Biodata Format Singapura (PDF)
│   │       ├── MalaysiaController.php     # Export Biodata Format Malaysia (PDF)
│   │       └── LaporanController.php      # Pelaporan Internal & Cetak PDF
│   └── Models/                    # Eloquent Models (Menggunakan protected $fillable)
│       ├── Agency.php
│       ├── Kantor.php
│       ├── Marketing.php
│       ├── Pelatihan.php
│       ├── Pendaftaran.php
│       ├── ProsesCpmi.php
│       ├── Sponsor.php
│       ├── User.php
│       └── ...
├── config/                        # File Konfigurasi (audit, filament, auth, shield, dll)
├── database/
│   ├── migrations/                # Skema Database Migrations
│   └── seeders/                   # Seeder Data Awal & Akun Default
├── public/
│   ├── images/                    # Aset Publik (Logo resmi, bendera, foto dokumentasi)
│   └── storage/                   # Tautan Simbolik ke Storage Berkas
├── resources/
│   ├── css/                       # Sumber Tailwind CSS
│   ├── js/                        # Script Frontend
│   └── views/
│       ├── landing.blade.php      # Master Template Landing Page Multi-Bahasa
│       ├── pdf/                   # Template Blade untuk Biodata PDF per Negara
│       │   ├── hongkong.blade.php
│       │   ├── taiwan.blade.php
│       │   ├── singapore.blade.php
│       │   └── malaysia.blade.php
│       └── laporan/               # Template Blade Laporan Operasional
├── routes/
│   └── web.php                    # Rute Aplikasi (Landing, Download PDF, Keamanan Foto)
└── storage/
    └── app/public/biodata/foto/   # Direktori Aman Penyimpanan Foto CPMI
```

---

## 🔄 Cara Kerja Aplikasi (Application Workflow)

Alur operasional penempatan pekerja migran dalam aplikasi ini dirancang terstruktur dari hulu ke hilir:

```
[ CPMI Mendaftar / Dijaring Sponsor (PL) ]
                   │
                   ▼
[ 1. Input Biodata & Berkas di PendaftaranResource ]
   • Data Identitas (KTP, KK, Akta)
   • Kontak & Keluarga
   • Master Wilayah (Provinsi/Kota/Kecamatan/Desa)
                   │
                   ▼
[ 2. Seleksi & Verifikasi Awal ]
   • Rekomendasi Sektor: Formal vs. Informal
   • Penentuan Negara Tujuan (Taiwan, Hong Kong, SG, MY, Jepang, Korea)
                   │
                   ▼
[ 3. Pelatihan & Sertifikasi di BLK / LPK (PelatihanResource) ]
   • Pembekalan Bahasa Asing & Kejuruan (Caregiver, Manufaktur, Housekeeper)
   • Uji Kompetensi BNSP / Sertifikasi Kerja
                   │
                   ▼
[ 4. Kurasi Marketing & Showcase Agensi (MarketingResource & Workers Page) ]
   • Profil diterbitkan ke Talent Pool & Portal Agensi Luar Negeri
   • Agensi Luar Negeri meninjau kandidat & mengunduh PDF Biodata Standar Resmi
   • Penerbitan Job Order / Kontrak Kerja dari Majikan Luar Negeri
                   │
                   ▼
[ 5. Pemrosesan Legalitas & Dokumen (ProsesCpmiResource / Pipeline) ]
   • Medical Check Up (MCU) Fit to Work
   • Pembuatan Paspor & Rekomendasi Paspor
   • Verifikasi ID SISKOP2MI / BP2MI
   • Pengajuan Visa Kerja Kedutaan
   • Pembekalan Akhir Pemberangkatan (PAP) & Penerbitan e-KTKLN
                   │
                   ▼
[ 6. Jadwal Terbang (Flight) & Penempatan Kerja ]
   • Input tiket & koordinasi penjemputan agensi di negara tujuan
   • Pelaporan data penempatan selesai & monitoring perlindungan kerja
```

---

## 🛡️ Standar Keamanan & Perlindungan Data

1. **Proteksi Mass-Assignment**:
   - Seluruh model Eloquent menerapkan deklarasi eksplisit `protected $fillable = [...]` untuk mencegah manipulasi kolom sensitif saat penyimpanan formulir.
2. **Pencegahan Directory Traversal pada Media**:
   - Endpoint `/foto/{filename}` dilengkapi validasi regex nama berkas `^[a-zA-Z0-9_\-\.]+$`, verifikasi canonical path via `realpath()`, pengecekan direktori induk `storage/app/public/biodata/foto`, serta pembatasan MIME type gambar yang diizinkan dengan header anti-sniffing (`X-Content-Type-Options: nosniff`).
3. **Pemisahan Hak Akses Berbasis Peran (RBAC)**:
   - Panel admin diamankan dengan **Filament Shield**. Setiap peran (Super Admin, Petugas Pendaftaran, Tim Proses, Tim Marketing, Agency) memiliki izin akses granular terhadap sumber daya data yang relevan.
4. **Audit Trail Lengkap**:
   - Setiap penambahan, pengubahan, atau penghapusan data penting pada berkas calon pekerja tercatat secara otomatis di tabel audit (`audits`), mencakup pengguna pengubah, alamat IP, timestamp, serta nilai sebelum dan sesudah perubahan.

---

## ⚙️ Panduan Instalasi (Installation Guide)

Ikuti langkah-langkah di bawah ini untuk menjalankan proyek di lingkungan pengembangan lokal:

### 1. Prasyarat Sistem
- **PHP** `>= 8.2` (dengan ekstensi `pdo_mysql`, `mbstring`, `fileinfo`, `gd`, `zip`, `bcmath`)
- **Composer** `>= 2.x`
- **Node.js** `>= 18.x` & **NPM**
- **MySQL** / **MariaDB**

### 2. Langkah Pemasangan

1. **Kloning Repositori**:
   ```bash
   git clone <URL_REPOSITORI>
   cd portal-main
   ```

2. **Siapkan Konfigurasi Lingkungan (`.env`)**:
   ```bash
   cp .env.example .env
   ```
   Sesuaikan parameter koneksi database pada berkas `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=portal_p3mi
   DB_USERNAME=root
   DB_PASSWORD=
   ```

3. **Install Dependensi PHP**:
   ```bash
   composer install
   ```

4. **Generate Application Key**:
   ```bash
   php artisan key:generate
   ```

5. **Migrasi Database & Seeder**:
   ```bash
   php artisan migrate
   ```
   *(Opsional jika ingin mengisi data awal seeder)*:
   ```bash
   php artisan migrate:fresh --seed
   ```

6. **Generate Peran & Izin Pengguna (Filament Shield)**:
   ```bash
   php artisan shield:generate --all
   php artisan shield:super-admin
   ```

7. **Tautkan Direktori Penyimpanan Publik (Storage Link)**:
   ```bash
   php artisan storage:link
   ```

8. **Install Dependensi Frontend & Kompilasi Aset**:
   ```bash
   npm install
   npm run build
   ```

9. **Jalankan Server Lokal**:
   ```bash
   php artisan serve
   ```
   Aplikasi dapat diakses pada peramban web:
   - **Landing Page Publik**: [http://127.0.0.1:8000](http://127.0.0.1:8000)
   - **Panel Admin / Back-Office**: [http://127.0.0.1:8000/admin](http://127.0.0.1:8000/admin)

---

## 🚀 Perintah Artisan yang Sering Digunakan

| Perintah | Deskripsi |
| :--- | :--- |
| `php artisan optimize:clear` | Membersihkan seluruh cache aplikasi (config, route, view, cache). |
| `php artisan shield:generate --all` | Menghasilkan ulang seluruh permissions Filament Shield dari resources yang ada. |
| `php artisan shield:super-admin` | Memberikan peran Super Admin ke akun pengguna yang dipilih. |
| `php artisan storage:link` | Menghubungkan direktori `storage/app/public` ke `public/storage`. |
| `php artisan pulse:check` | Menjalankan *check worker* untuk pengumpulan metrik performa Laravel Pulse. |

---

## 🌐 Tautan & Ekstensi cPanel (Deployment Production)

Jika aplikasi di-deploy pada lingkungan hosting berbasis cPanel / Apache, buat tautan penyimpanan menggunakan perintah terminal:
```bash
ln -s /home/username/public_html/storage/app/public /home/username/public_html/public/storage
```
*(Sesuaikan `username` dan jalur root instalasi Anda).*

---

## 📄 Lisensi & Hak Cipta
Hak Cipta © 2026 **PT. Nusantara Portal Inc.** Seluruh hak cipta dilindungi undang-undang. Sistem dibangun untuk tata kelola penempatan pekerja migran Indonesia yang profesional dan berintegritas.
