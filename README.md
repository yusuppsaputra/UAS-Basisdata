# 🏥 Rumah Sakit — UTS Basis Data

Proyek ini adalah tugas **UTS mata kuliah Basis Data** dengan studi kasus **Sistem Informasi Rumah Sakit**.  
Dokumentasi lengkap menjelaskan struktur database, migration, seeder, dan contoh implementasi dengan Laravel.

---

## 🛠️ Teknologi yang Digunakan

- **Laravel Framework** — Migration & Seeder
- **MySQL / MariaDB** — Relational Database
- **Eloquent ORM** — Relasi & Foreign Key
- **PHP 8.0+**

---

## 📊 Entitas Utama (ER Model)

| Entitas | Deskripsi |
|---------|-----------|
| **Rumah Sakit** | Data institusi medis |
| **Poliklinik** | Departemen/spesialisasi |
| **Dokter** | Tenaga medis profesional |
| **Jadwal Praktek** | Waktu konsultasi dokter |
| **Pasien** | Data pasien & rekam medis |
| **Kunjungan** | Riwayat kunjungan pasien |
| **Obat** | Inventori farmasi |
| **Resep** | Resep obat pasien |

---

## 📁 Struktur Proyek

```
rumahsakit-2025/
├── database/
│   ├── migrations/     ← File migration tabel
│   └── seeders/        ← File seeder data
├── src/
│   ├── app/
│   ├── config/
│   ├── routes/
│   └── ...
└── README.md
```

---

## 🚀 Cara Menyiapkan Project

### 1. Buat Project Baru

```bash
cd /root/boilerplate
./start.sh uts-basisdata
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Setup Database

```bash
# Copy .env jika belum ada
cp .env.example .env

# Generate key aplikasi
php artisan key:generate

# Buat database MySQL terlebih dahulu
# CREATE DATABASE rumahsakit;
```

---

## 📋 Migration — Struktur Tabel

Setiap tabel menggunakan **Foreign Key & Cascade Delete** untuk integritas data relasional.

### 1️⃣ Tabel: rumah_sakits

```php
Schema::create('rumah_sakits', function (Blueprint $table) {
    $table->id();
    $table->string('kode_rs')->unique();
    $table->string('nama');
    $table->string('tipe_rs');          // Tipe RS (A, B, C, dll)
    $table->string('alamat');
    $table->string('kota');
    $table->string('provinsi');
    $table->string('telepon')->nullable();
    $table->string('email')->nullable();
    $table->string('website')->nullable();
    $table->timestamps();
});
```

### 2️⃣ Tabel: polikliniks

```php
Schema::create('polikliniks', function (Blueprint $table) {
    $table->id();
    $table->foreignId('rumah_sakit_id')->constrained()->cascadeOnDelete();
    $table->string('kode_poli')->unique();
    $table->string('nama');
    $table->string('lantai')->nullable();
    $table->string('jam_operasional')->nullable();
    $table->timestamps();
});
```

### 3️⃣ Tabel: dokters

```php
Schema::create('dokters', function (Blueprint $table) {
    $table->id();
    $table->foreignId('poliklinik_id')->constrained()->cascadeOnDelete();
    $table->string('kode_dokter')->unique();
    $table->string('nama');
    $table->string('spesialisasi');
    $table->string('no_str')->nullable();      // Surat Registrasi
    $table->string('no_sip')->nullable();      // Surat Izin Praktek
    $table->string('no_hp')->nullable();
    $table->string('email')->nullable();
    $table->integer('pengalaman_tahun')->nullable();
    $table->timestamps();
});
```

### 4️⃣ Tabel: jadwal_prakteks

```php
Schema::create('jadwal_prakteks', function (Blueprint $table) {
    $table->id();
    $table->foreignId('dokter_id')->constrained()->cascadeOnDelete();
    $table->enum('hari', ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu']);
    $table->time('jam_mulai');
    $table->time('jam_selesai');
    $table->boolean('is_libur')->default(false);
    $table->timestamps();
});
```

### 5️⃣ Tabel: pasiens

```php
Schema::create('pasiens', function (Blueprint $table) {
    $table->id();
    $table->string('no_rm')->unique();         // Nomor Rekam Medis
    $table->string('nik')->unique();
    $table->string('nama');
    $table->enum('jenis_kelamin', ['L', 'P']);
    $table->date('tanggal_lahir');
    $table->string('alamat');
    $table->string('kota')->nullable();
    $table->string('provinsi')->nullable();
    $table->string('no_hp')->nullable();
    $table->string('golongan_darah')->nullable();
    $table->string('status_pernikahan')->nullable();
    $table->string('pekerjaan')->nullable();
    $table->string('kontak_darurat_nama')->nullable();
    $table->string('kontak_darurat_hp')->nullable();
    $table->string('kontak_darurat_hubungan')->nullable();
    $table->timestamps();
});
```

### 6️⃣ Tabel: kunjungans

```php
Schema::create('kunjungans', function (Blueprint $table) {
    $table->id();
    $table->foreignId('pasien_id')->constrained()->cascadeOnDelete();
    $table->foreignId('dokter_id')->constrained()->cascadeOnDelete();
    $table->dateTime('tanggal_kunjungan');
    $table->string('keluhan');
    $table->text('diagnosa')->nullable();
    $table->text('tindakan')->nullable();
    $table->integer('biaya_kunjungan')->default(0);
    $table->enum('status', ['menunggu', 'diperiksa', 'selesai'])->default('menunggu');
    $table->timestamps();
});
```

### 7️⃣ Tabel: obats

```php
Schema::create('obats', function (Blueprint $table) {
    $table->id();
    $table->string('kode_obat')->unique();
    $table->string('nama');
    $table->string('kategori');           // Tablet, Sirup, Salep, Kapsul, Injeksi
    $table->string('jenis');              // Generik / Non-Generik
    $table->integer('stok')->default(0);
    $table->integer('harga')->default(0);
    $table->string('satuan');             // Strip, Botol, Vial
    $table->timestamps();
});
```

### 8️⃣ Tabel: reseps

```php
Schema::create('reseps', function (Blueprint $table) {
    $table->id();
    $table->foreignId('kunjungan_id')->constrained()->cascadeOnDelete();
    $table->foreignId('obat_id')->constrained()->cascadeOnDelete();
    $table->integer('jumlah')->default(1);
    $table->string('aturan_pakai');       // Contoh: "3x1 sesudah makan"
    $table->string('catatan')->nullable();
    $table->timestamps();
});
```

---

## 🌱 Seeder — Data Contoh

### Membuat Seeder

```bash
php artisan make:seeder RumahSakitSeeder
php artisan make:seeder PoliklinikSeeder
php artisan make:seeder DokterSeeder
php artisan make:seeder JadwalPraktekSeeder
php artisan make:seeder PasienSeeder
php artisan make:seeder KunjunganSeeder
php artisan make:seeder ObatSeeder
php artisan make:seeder ResepSeeder
```

### Contoh Seeder: Dokter

```php
DB::table('dokters')->insert([
    [
        'poliklinik_id' => 1,
        'kode_dokter' => 'DR001',
        'nama' => 'dr. Siti Waindah',
        'spesialisasi' => 'Umum',
        'no_str' => 'STR202501',
        'no_sip' => 'SIP202316',
        'no_hp' => '0813456789',
        'email' => 'sitiw@rssehat.com',
        'pengalaman_tahun' => 5,
    ],
]);
```

### Contoh Seeder: Pasien

```php
DB::table('pasiens')->insert([
    [
        'no_rm' => 'RM0001',
        'nik' => '3174051234560001',
        'nama' => 'Laura Prima',
        'jenis_kelamin' => 'P',
        'tanggal_lahir' => '2001-12-01',
        'alamat' => 'Jl. Delima No.37',
        'kota' => 'Jakarta',
        'provinsi' => 'DKI Jakarta',
        'no_hp' => '08123456789',
        'golongan_darah' => 'O',
        'status_pernikahan' => 'Belum Kawin',
        'pekerjaan' => 'Karyawan',
    ],
    [
        'no_rm' => 'RM0002',
        'nik' => '3174051234560002',
        'nama' => 'Riko Ramadhan',
        'jenis_kelamin' => 'L',
        'tanggal_lahir' => '1999-03-17',
        'alamat' => 'Jl. Dukuh No.21',
        'kota' => 'Jakarta',
        'provinsi' => 'DKI Jakarta',
        'no_hp' => '08129876543',
        'golongan_darah' => 'A',
        'status_pernikahan' => 'Kawin',
        'pekerjaan' => 'Barista',
    ],
]);
```

### Contoh Seeder: Obat

```php
DB::table('obats')->insert([
    [
        'kode_obat' => 'OB001',
        'nama' => 'Omeprazole',
        'kategori' => 'Kapsul',
        'jenis' => 'Generik',
        'stok' => 150,
        'harga' => 5000,
        'satuan' => 'strip',
    ],
    [
        'kode_obat' => 'OB002',
        'nama' => 'Amoxicillin',
        'kategori' => 'Kapsul',
        'jenis' => 'Generik',
        'stok' => 300,
        'harga' => 12000,
        'satuan' => 'strip',
    ],
]);
```

---

## ▶️ Menjalankan Migration & Seeder

### Run semua migration

```bash
php artisan migrate
```

### Run seeder tertentu

```bash
php artisan db:seed --class=RumahSakitSeeder
php artisan db:seed --class=PasienSeeder
php artisan db:seed --class=DokterSeeder
```

### Run semua seeder (DatabaseSeeder)

```bash
php artisan db:seed
```

### Rollback & Re-migrate

```bash
php artisan migrate:rollback
php artisan migrate --seed
```

---

## 💡 Tips & Best Practices

✅ **Foreign Key Integrity**
- Selalu gunakan `constrained()` untuk menghubungkan foreign key  
- Gunakan `cascadeOnDelete()` agar data terkait otomatis terhapus

✅ **Indexing untuk Performa**
- Tambahkan index pada kolom sering dicari: `no_rm`, `kode_dokter`, `kode_obat`  
- Contoh: `$table->string('no_rm')->unique()->index();`

✅ **Data Seeding**
- Gunakan factory & faker untuk data testing yang realistis  
- Simpan contoh data di seeder untuk mempermudah pengujian manual

✅ **Dokumentasi**
- Update README setiap ada perubahan struktur database  
- Catat relasi antar tabel dengan diagram ER jika perlu

---

## 📞 Kontak & Support

Jika ada pertanyaan atau issue, hubungi pengembang melalui GitHub issues.

---

**Last updated:** November 2025
