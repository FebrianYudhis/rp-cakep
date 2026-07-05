# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.0.0] - 2026-07-05
### Changed
- Merombak total desain antarmuka (UI) aplikasi menjadi lebih modern dan dinamis (Penambahan custom `redesign.css`).
- Memperbaiki tata letak (layout) dan desain komponen Stat Cards di halaman Dashboard Admin dan User.
- Mengganti gambar profil default (PNG lokal) dengan ikon SVG (FontAwesome).
- Menyeragamkan tampilan tabel menggunakan desain bawaan DataTables untuk mencegah konflik CSS.
- Melakukan refactoring struktur URL (Routes), Controller, dan tampilan aplikasi untuk mengganti istilah "Absen" menjadi "Presensi" secara komprehensif.
- Melakukan refactoring struktur Database (Tabel `absents` ➔ `presensi`), Model Eloquent, Factory, dan File Migration.
- Mengubah nama file cetak template Word dari `Absen.docx` menjadi `Presensi.docx`.
- Memperbarui dokumentasi (`README.md`) agar selaras dengan penggunaan istilah "Presensi".

## [1.1.1]
### Added
- Menyelesaikan Penambahan Kolom "Nomor Identitas Pegawai / Nomor Registrasi Pegawai".

### Changed
- Mengganti Template Word.

### Fixed
- Memperbaiki Factory Untuk Model User.

## [1.1.0]
### Added
- Menambahkan Satu Kolom Baru pada Tabel 'users'.

## [1.0.3]
### Added
- Menambahkan Waktu Presensi Supaya Berjalan Pada Menu Presensi Datang dan Presensi Pulang.

### Changed
- Membersihkan Kode.

## [1.0.2]
### Fixed
- Memperbaiki Struktur Logika Presensi.

## [1.0.1]
### Added
- Mempersiapkan Tampilan Untuk Tetap Presensi.

### Fixed
- Memperbaiki Struktur Logika Presensi.

## [1.0.0]
### Added
- Initial Version.

### Changed
- Untrack File "composer.lock".
- Mengganti Template Word.
