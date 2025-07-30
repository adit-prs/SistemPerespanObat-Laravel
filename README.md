🩺 Sistem Resep Obat – Mini Project

Mini project ini adalah aplikasi berbasis Laravel yang memungkinkan dokter untuk:

    Melihat data pasien

    Menambahkan pemeriksaan

    Menulis resep obat

    Melihat detail pemeriksaan dan resep

⚙️ Requirements

    PHP ≥ 8.1

    Composer

    MySQL (atau DBMS lain)

    Node.js (hanya diperlukan jika ingin development mode – tidak wajib untuk testing)

🚀 Cara Menjalankan Project

1. Clone Repository

        git clone <repo-url>
        cd <nama-folder-project>

2. Install Dependency Backend

         composer install        

3. Copy dan Konfigurasi File .env

         cp .env.example .env

4. Edit file .env sesuai database lokal dan mengonsumsi data dari API eksternal dan membutuhkan kredensial client: (
   Nilai email dan password ini tidak disertakan di repo. Pastikan Anda mengisi dengan kredensial yang sesuai untuk
   mengakses data dari API
   eksternal.)

        DB_DATABASE=nama_database
        DB_USERNAME=root
        DB_PASSWORD=
        
        API_CLIENT_ID=email-login-api
        API_CLIENT_SECRET=password-login-api

5. Generate App Key

         php artisan key:generate

6. Jalankan Migrasi

         php artisan migrate --seed

7. Jalankan Aplikasi

         php artisan serve

Buka browser dan akses: http://localhost:8000

🧩 Frontend (Vite)

Project ini menggunakan Vite dan Bootstrap yang di-install via NPM.

Bootstrap dan asset frontend sudah dibuild ke dalam public/build, jadi tidak perlu menjalankan npm install atau npm
run dev jika hanya ingin menjalankan aplikasi.
Namun jika ingin development mode:

    npm install
    npm run dev

🔐 Login Akun

Contoh akun dummy :

    Email   : john.doe@email.com
    Password: password

✍️ Catatan

Karena keterbatasan waktu, beberapa fitur belum diselesaikan sepenuhnya. Namun struktur dan alur dasar sudah tersedia
dan dapat dikembangkan lebih lanjut.
untuk struktur databasenya bisa dilihat disini : https://dbdiagram.io/d/sistem-resep-obat-68848164cca18e685cd5595f
