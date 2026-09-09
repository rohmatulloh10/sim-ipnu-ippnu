# 🚀 SIMAP - Sistem Informasi Manajemen & LPJ PAC IPNU-IPPNU

Aplikasi web berbasis **Laravel 13 StarterKit React** yang dirancang khusus untuk mengelola administrasi, data kader ranting, surat-menyurat, program kerja, keuangan, serta rekapitulasi Laporan Pertanggungjawaban (LPJ) secara terpusat di tingkat Pimpinan Anak Cabang (PAC) IPNU-IPPNU.

---

## 💻 Cara Instalasi & Menjalankan Proyek

Ikuti langkah-langkah di bawah ini untuk memasang proyek ini di lingkungan lokal (localhost) Anda:

### 1. Clone Repository

```bash
git clone https://github.com/rohmatulloh10/sim-ipnu-ippnu.git
cd simap-ipnu-ippnu
```

### 2. Install Dependencies PHP (Composer)

```bash
composer install
```

### 3. Install Dependencies Frontend (Node.js)

```bash
npm install
```

### 4. Salin File Konfigurasi Lingkungan

```bash
cp .env.example .env
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Konfigurasi Database

Buka file `.env` yang baru dibuat, lalu sesuaikan pengaturan koneksi database Anda:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sim_ipnu_ippnu
DB_USERNAME=root
DB_PASSWORD=
```

### 7. Jalankan Migration

Buat struktur tabel beserta data bawaan awal dengan perintah:

```bash
php artisan migrate
```

---

## ⚡ Cara Menjalankan Aplikasi

Untuk menjalankan aplikasi ini secara penuh, buka **dua jendela terminal** terpisah dan jalankan perintah berikut secara bersamaan:

- **Terminal 1 (Server Backend Laravel):**
    ```bash
    php artisan serve
    ```
- **Terminal 2 (Compiler Frontend Vite/Tailwind):**
    ```bash
    npm run dev
    ```

Setelah keduanya berjalan, Anda dapat mengakses aplikasi melalui browser di alamat: [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 📄 Lisensi

Proyek ini bersifat open-source dan dikembangkan untuk kebutuhan internal organisasi kepemudaan IPNU-IPPNU.
