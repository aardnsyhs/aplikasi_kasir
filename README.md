
### Langkah-langkah untuk Login sebagai Admin

#### 1. Install Dependency
Jalankan perintah ini buat install semua dependency Laravel:
```bash
composer install
```
```bash
npm install
```

#### 2. Konfigurasi Environment

Copy file `.env.example`, terus ubah namanya jadi `.env`:

```bash
cp .env.example .env
```

Lalu, generate application key:
```bash
php artisan key:generate
```

#### 3. Jalankan Migration dan Seed Database

Buat generate tabel dan isi data awalnya, jalankan perintah ini:
```bash
php artisan migrate --seed
```
 Setelah itu, login menggunakan kredensial berikut:
-  **Email**: `admin@example.com`

-  **Password**: `admin`

#### 4. Jalankan Server Laravel

Jalankan server bawaan Laravel dan jalankan untuk load TailwindCSS nya:
```bash
php artisan serve
```
```bash
npm run dev
```

Sekarang, buka aplikasi di browser lewat `http://127.0.0.1:8000`

### Setup Tambahan buat Export ke Excel & PDF

Biar Laravel bisa jalan dengan lancar, pastikan beberapa ekstensi PHP udah aktif. Buka file berikut:
```
xampp/php/php.ini
```

Terus cari dan hapus tanda `;` di depan baris berikut:
```ini
extension=gd
extension=zip
```
Setelah itu, restart Apache lewat XAMPP Control Panel.
