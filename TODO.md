# TODO: Update Siswa Dashboard

## Overview
Update dashboard siswa untuk menampilkan fitur jadwal pelajaran, nama wali kelas, cek tagihan, dan informasi pribadi siswa. Hapus fitur nilai dan raport. Pastikan perubahan hanya mempengaruhi panel siswa.

## Steps
- [x] Update app/Http/Controllers/Siswa/DashboardController.php untuk pass data jadwal, wali kelas, dll.
- [x] Buat app/Http/Controllers/Siswa/JadwalController.php untuk menampilkan jadwal siswa.
- [x] Buat resources/views/siswa/jadwal/index.blade.php untuk view jadwal siswa.
- [x] Update resources/views/siswa/dashboard.blade.php: hapus kartu Nilai & Raport, tambah kartu Wali Kelas dan Informasi Pribadi.
- [x] Update routes/web.php untuk route jadwal siswa.
- [x] Update navigation siswa untuk link jadwal.
- [x] Test perubahan dengan login sebagai siswa.
