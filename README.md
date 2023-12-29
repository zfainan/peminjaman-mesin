## User

| Email          | Password | Jabatan        | Akses semua fitur |
| -------------- | -------- | -------------- | ----------------- |
| admin          | password | Admin          | ya                |
| petugas.gudang | password | Petugas Gudang | tidak             |
| kepala.lane    | password | Kepala Lane    | tidak             |
| kepala.lane1   | password | Kepala Lane    | tidak             |
| kepala.lane2   | password | Kepala Lane    | tidak             |

## Cara Setup Aplikasi

Untuk menjalankan aplikasi ini, dibutuhkan PHP versi 8.1, NodeJS dan database MySQL.

1. Install dependensi Composer:

```bash
composer install
```

2. Install dependensi JS:

```bash
npm install
```

3. Copy file `env.example` dan paste dengan nama `.env`
4. Generate app key:

```bash
php artisan key:generate
```

5. Sesuaikan koneksi database di file `.env`
6. Jalankan migrasi database:

```bash
php artisan migrate
```

7. Jalankan Seeder:

```bash
php artisan db:seed
```
```bash
php artisan db:seed --class=DummySeeder
```

8. Build Front-End:

```bash
npm run build
```
9. Jalankan aplikasi:

Untuk menjalankan aplikasi dapat menggunakan tool Artisan (bawaan Laravel) atau dengan PHP.

-   Menggunakan Artisan

```bash
php artisan serve
```

-   Menggunakan PHP

Masuk ke direktori public:

```bash
cd public
```

Jalankan server:

```bash
php -S localhost:8000
```
