🩺 Sistem Resep Obat (Medication Prescribing) – Mini Project
=
Aplikasi ini dibuat dengan Laravel dan berfungsi untuk:

      - Menampilkan data pasien
      - Menambahkan pemeriksaan pasien
      - Membuat resep obat
      - Melihat detail pemeriksaan dan resep
      - Melakukan pembayaran resep

⚙️ Requirements

      PHP ≥ 8.2
      Composer
      MySQL (atau DBMS lain)
      Redis
      Node.js (opsional, hanya untuk mode pengembangan frontend)

🚀 Cara Menjalankan Project

1. Clone Repository

         git clone <repo-url>
         cd <nama-folder-project>

2. Install Dependency Backend

         composer install        

3. Copy dan Konfigurasi File .env

         cp .env.example .env

4. Ubah konfigurasi .env sesuai kebutuhan.
   Pastikan mengisi kredensial database dan kredensial API eksternal (base url API, email & password tidak disertakan
   dalam
   repo):

            DB_DATABASE=nama_database
            DB_USERNAME=root
            DB_PASSWORD=
         
            API_BASE_URL=url-api
            API_CLIENT_ID=email-login-api
            API_CLIENT_SECRET=password-login-api

5. Generate App Key

         php artisan key:generate

6. Jalankan Migrasi dan Buat Symlink Storage

         php artisan migrate --seed
         php artisan storage:link

7. Jalankan Aplikasi

         php artisan serve

Buka browser dan akses: http://localhost:8000

🧩 Frontend (Vite)

Project ini menggunakan Vite dan Bootstrap yang dikelola melalui NPM.

Bootstrap dan asset frontend sudah di-build ke public/build, jadi tidak wajib menjalankan npm install jika hanya ingin
menjalankan aplikasi.

Jika ingin mode development:

    npm install
    npm run dev

🔐 Login Akun

Contoh akun dummy:

Dokter

      Email: john.doe@example.com
      Password: password

Apoteker

      Email: david@example.com
      Password: password

✍️ Catatan

Struktur database dapat dilihat di sini:
https://dbdiagram.io/d/sistem-resep-obat-68848164cca18e685cd5595f