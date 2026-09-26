# Bank Sampah Digital masyarakat

Aplikasi Bank Sampah Digital berbasis web untuk mempermudah pengelolaan data bank sampah desa.

## Fitur
1. **Dua Role**: Petugas (Admin) dan Warga (Nasabah).
2. **Scan QR Code**: Warga menggunakan QR Code unik, dan petugas memindainya menggunakan kamera HP (via browser) untuk input setoran atau penukaran poin.
3. **Logika Otomatis**: Setoran sampah otomatis menghitung poin berdasarkan berat dan jenis sampah.
4. **Halaman Publik Warga**: Warga tidak perlu login. Mereka cukup memindai QR Code mereka sendiri untuk melihat riwayat setoran dan sisa poin mereka.
5. **Laporan & Statistik**: Dashboard interaktif menggunakan Chart.js untuk menampilkan ringkasan data sampah.

## Tech Stack
- Laravel 12 (PHP 8.2+)
- MySQL
- Tailwind CSS
- Alpine.js
- HTML5-QRCode (Browser Camera Scanner)
- SimpleSoftwareIO/Simple-QRCode (Generator)
- Chart.js

## Cara Instalasi

1. Clone repository atau copy folder.
2. Buka terminal di dalam folder proyek.
3. Install dependensi PHP:
   ```bash
   composer install
   ```
4. Install dependensi Node:
   ```bash
   npm install
   ```
5. Salin konfigurasi `.env`:
   ```bash
   cp .env.example .env
   ```
6. Sesuaikan koneksi database di file `.env` (misal: `DB_DATABASE=bank_sampah`).
7. Buat database di MySQL (misal bernama `bank_sampah`).
8. Generate key aplikasi:
   ```bash
   php artisan key:generate
   ```
9. Jalankan migrasi dan seeder awal:
   ```bash
   php artisan migrate --seed
   ```
10. Compile asset frontend:
    ```bash
    npm run build
    ```
11. Jalankan server lokal:
    ```bash
    php artisan serve
    ```

## Akun Login (Petugas)
Email: `admin@banksampah.com`
Password: `password`

----------------terimakasih---------------
