<?php

namespace Database\Seeders;

use App\Models\Dokter;
use App\Models\JadwalPraktek;
use App\Models\Kunjungan;
use App\Models\Obat;
use App\Models\Pasien;
use App\Models\Poliklinik;
use App\Models\Resep;
use App\Models\RumahSakit;
use Illuminate\Database\Seeder;

class HospitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // =====================================================
        // 1. SEED RUMAH_SAKIT (10 records)
        // =====================================================
        RumahSakit::insert([
            ['nama' => 'RS Pusat Medika Jaya', 'alamat' => 'Jl. Gatot Subroto No. 1', 'kota' => 'Jakarta', 'provinsi' => 'DKI Jakarta', 'no_telepon' => '021-1234567', 'kelas_rumah_sakit' => 'A', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'RS Klinik Cahaya Sehat', 'alamat' => 'Jl. Sudirman No. 45', 'kota' => 'Bandung', 'provinsi' => 'Jawa Barat', 'no_telepon' => '022-2345678', 'kelas_rumah_sakit' => 'B', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'RS Medikas Utama', 'alamat' => 'Jl. Ahmad Yani No. 12', 'kota' => 'Surabaya', 'provinsi' => 'Jawa Timur', 'no_telepon' => '031-3456789', 'kelas_rumah_sakit' => 'A', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'RS Harapan Baru', 'alamat' => 'Jl. Diponegoro No. 78', 'kota' => 'Medan', 'provinsi' => 'Sumatera Utara', 'no_telepon' => '061-4567890', 'kelas_rumah_sakit' => 'C', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'RS Sehat Sejahtera', 'alamat' => 'Jl. Merdeka No. 99', 'kota' => 'Semarang', 'provinsi' => 'Jawa Tengah', 'no_telepon' => '024-5678901', 'kelas_rumah_sakit' => 'B', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'RS Kesehatan Mandiri', 'alamat' => 'Jl. Imam Bonjol No. 23', 'kota' => 'Palembang', 'provinsi' => 'Sumatera Selatan', 'no_telepon' => '0711-6789012', 'kelas_rumah_sakit' => 'C', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'RS Adi Husada', 'alamat' => 'Jl. Sultan Agung No. 56', 'kota' => 'Yogyakarta', 'provinsi' => 'DI Yogyakarta', 'no_telepon' => '0274-7890123', 'kelas_rumah_sakit' => 'B', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'RS Bahagia Abadi', 'alamat' => 'Jl. Minto Harahap No. 34', 'kota' => 'Makassar', 'provinsi' => 'Sulawesi Selatan', 'no_telepon' => '0411-8901234', 'kelas_rumah_sakit' => 'D', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'RS Permata Medika', 'alamat' => 'Jl. Panglima Polim No. 11', 'kota' => 'Bandung', 'provinsi' => 'Jawa Barat', 'no_telepon' => '022-9012345', 'kelas_rumah_sakit' => 'C', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'RS Bintang Sehat', 'alamat' => 'Jl. Veteran No. 67', 'kota' => 'Jakarta', 'provinsi' => 'DKI Jakarta', 'no_telepon' => '021-0123456', 'kelas_rumah_sakit' => 'A', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // =====================================================
        // 2. SEED POLIKLINIK (12 records)
        // =====================================================
        Poliklinik::insert([
            ['id_rumahsakit' => 1, 'nama_poli' => 'Poli Umum', 'lantai' => 2, 'jam_operasional' => '08:00-17:00', 'created_at' => now(), 'updated_at' => now()],
            ['id_rumahsakit' => 1, 'nama_poli' => 'Poli Jantung', 'lantai' => 3, 'jam_operasional' => '08:00-15:00', 'created_at' => now(), 'updated_at' => now()],
            ['id_rumahsakit' => 1, 'nama_poli' => 'Poli Anak', 'lantai' => 2, 'jam_operasional' => '08:00-17:00', 'created_at' => now(), 'updated_at' => now()],
            ['id_rumahsakit' => 2, 'nama_poli' => 'Poli Umum', 'lantai' => 1, 'jam_operasional' => '07:00-16:00', 'created_at' => now(), 'updated_at' => now()],
            ['id_rumahsakit' => 2, 'nama_poli' => 'Poli Gigi', 'lantai' => 2, 'jam_operasional' => '08:00-17:00', 'created_at' => now(), 'updated_at' => now()],
            ['id_rumahsakit' => 2, 'nama_poli' => 'Poli Mata', 'lantai' => 3, 'jam_operasional' => '08:00-15:00', 'created_at' => now(), 'updated_at' => now()],
            ['id_rumahsakit' => 3, 'nama_poli' => 'Poli Umum', 'lantai' => 1, 'jam_operasional' => '08:00-17:00', 'created_at' => now(), 'updated_at' => now()],
            ['id_rumahsakit' => 3, 'nama_poli' => 'Poli Saraf', 'lantai' => 2, 'jam_operasional' => '08:00-14:00', 'created_at' => now(), 'updated_at' => now()],
            ['id_rumahsakit' => 3, 'nama_poli' => 'Poli Orthopedi', 'lantai' => 3, 'jam_operasional' => '09:00-17:00', 'created_at' => now(), 'updated_at' => now()],
            ['id_rumahsakit' => 4, 'nama_poli' => 'Poli Umum', 'lantai' => 1, 'jam_operasional' => '08:00-17:00', 'created_at' => now(), 'updated_at' => now()],
            ['id_rumahsakit' => 5, 'nama_poli' => 'Poli Umum', 'lantai' => 2, 'jam_operasional' => '08:00-17:00', 'created_at' => now(), 'updated_at' => now()],
            ['id_rumahsakit' => 6, 'nama_poli' => 'Poli Umum', 'lantai' => 1, 'jam_operasional' => '08:00-17:00', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // =====================================================
        // 3. SEED DOKTER (15 records)
        // =====================================================
        Dokter::insert([
            ['id_rumahsakit' => 1, 'id_poli' => 1, 'nama_dokter' => 'Dr. Ahmad Wijaya', 'spesialisasi' => 'Umum', 'no_str' => 'STR001-2023', 'no_telepon' => '0812-1234567', 'created_at' => now(), 'updated_at' => now()],
            ['id_rumahsakit' => 1, 'id_poli' => 2, 'nama_dokter' => 'Dr. Budi Santoso', 'spesialisasi' => 'Jantung', 'no_str' => 'STR002-2023', 'no_telepon' => '0812-2345678', 'created_at' => now(), 'updated_at' => now()],
            ['id_rumahsakit' => 1, 'id_poli' => 3, 'nama_dokter' => 'Dr. Siti Nurhaliza', 'spesialisasi' => 'Anak', 'no_str' => 'STR003-2023', 'no_telepon' => '0812-3456789', 'created_at' => now(), 'updated_at' => now()],
            ['id_rumahsakit' => 2, 'id_poli' => 4, 'nama_dokter' => 'Dr. Roni Dharma', 'spesialisasi' => 'Umum', 'no_str' => 'STR004-2023', 'no_telepon' => '0812-4567890', 'created_at' => now(), 'updated_at' => now()],
            ['id_rumahsakit' => 2, 'id_poli' => 5, 'nama_dokter' => 'Dr. Yeni Maharani', 'spesialisasi' => 'Gigi', 'no_str' => 'STR005-2023', 'no_telepon' => '0812-5678901', 'created_at' => now(), 'updated_at' => now()],
            ['id_rumahsakit' => 2, 'id_poli' => 6, 'nama_dokter' => 'Dr. Hendra Wijaya', 'spesialisasi' => 'Mata', 'no_str' => 'STR006-2023', 'no_telepon' => '0812-6789012', 'created_at' => now(), 'updated_at' => now()],
            ['id_rumahsakit' => 3, 'id_poli' => 7, 'nama_dokter' => 'Dr. Andi Pratama', 'spesialisasi' => 'Umum', 'no_str' => 'STR007-2023', 'no_telepon' => '0812-7890123', 'created_at' => now(), 'updated_at' => now()],
            ['id_rumahsakit' => 3, 'id_poli' => 8, 'nama_dokter' => 'Dr. Nadia Putri', 'spesialisasi' => 'Saraf', 'no_str' => 'STR008-2023', 'no_telepon' => '0812-8901234', 'created_at' => now(), 'updated_at' => now()],
            ['id_rumahsakit' => 3, 'id_poli' => 9, 'nama_dokter' => 'Dr. Bambang Irawan', 'spesialisasi' => 'Orthopedi', 'no_str' => 'STR009-2023', 'no_telepon' => '0812-9012345', 'created_at' => now(), 'updated_at' => now()],
            ['id_rumahsakit' => 4, 'id_poli' => 10, 'nama_dokter' => 'Dr. Lina Kusuma', 'spesialisasi' => 'Umum', 'no_str' => 'STR010-2023', 'no_telepon' => '0813-0123456', 'created_at' => now(), 'updated_at' => now()],
            ['id_rumahsakit' => 5, 'id_poli' => 11, 'nama_dokter' => 'Dr. Gunawan Haryanto', 'spesialisasi' => 'Umum', 'no_str' => 'STR011-2023', 'no_telepon' => '0813-1234567', 'created_at' => now(), 'updated_at' => now()],
            ['id_rumahsakit' => 6, 'id_poli' => 12, 'nama_dokter' => 'Dr. Endang Wijaya', 'spesialisasi' => 'Umum', 'no_str' => 'STR012-2023', 'no_telepon' => '0813-2345678', 'created_at' => now(), 'updated_at' => now()],
            ['id_rumahsakit' => 1, 'id_poli' => 1, 'nama_dokter' => 'Dr. Mira Kusuma', 'spesialisasi' => 'Umum', 'no_str' => 'STR013-2023', 'no_telepon' => '0813-3456789', 'created_at' => now(), 'updated_at' => now()],
            ['id_rumahsakit' => 2, 'id_poli' => 4, 'nama_dokter' => 'Dr. Fajar Sidik', 'spesialisasi' => 'Umum', 'no_str' => 'STR014-2023', 'no_telepon' => '0813-4567890', 'created_at' => now(), 'updated_at' => now()],
            ['id_rumahsakit' => 3, 'id_poli' => 7, 'nama_dokter' => 'Dr. Wahyu Santoso', 'spesialisasi' => 'Umum', 'no_str' => 'STR015-2023', 'no_telepon' => '0813-5678901', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // =====================================================
        // 4. SEED PASIEN (15 records)
        // =====================================================
        Pasien::insert([
            ['nik' => '3201012345678901', 'nama' => 'Ahmad Suryanto', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1985-03-15', 'alamat' => 'Jl. Merdeka No. 10, Jakarta', 'no_telepon' => '0811-1111111', 'golongan_darah' => 'O', 'alergi' => 'Amoxicillin', 'created_at' => now(), 'updated_at' => now()],
            ['nik' => '3204067890123456', 'nama' => 'Siti Nurhaliza', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1990-06-22', 'alamat' => 'Jl. Sudirman No. 25, Bandung', 'no_telepon' => '0812-2222222', 'golongan_darah' => 'A', 'alergi' => 'Aspirin', 'created_at' => now(), 'updated_at' => now()],
            ['nik' => '3503019876543210', 'nama' => 'Budi Hartono', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1978-09-05', 'alamat' => 'Jl. Ahmad Yani No. 30, Surabaya', 'no_telepon' => '0813-3333333', 'golongan_darah' => 'B', 'alergi' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nik' => '2201018765432109', 'nama' => 'Dewi Lestari', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1995-11-18', 'alamat' => 'Jl. Gatot Subroto No. 15, Jakarta', 'no_telepon' => '0814-4444444', 'golongan_darah' => 'AB', 'alergi' => 'Penicillin', 'created_at' => now(), 'updated_at' => now()],
            ['nik' => '5371029876543210', 'nama' => 'Rudi Hermawan', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1982-07-10', 'alamat' => 'Jl. Diponegoro No. 50, Medan', 'no_telepon' => '0815-5555555', 'golongan_darah' => 'O', 'alergi' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nik' => '3306019876543210', 'nama' => 'Ani Wijaya', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1988-04-28', 'alamat' => 'Jl. Merdeka No. 20, Semarang', 'no_telepon' => '0816-6666666', 'golongan_darah' => 'A', 'alergi' => 'Erythromycin', 'created_at' => now(), 'updated_at' => now()],
            ['nik' => '1671019876543210', 'nama' => 'Hariyanto Kusuma', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1980-12-03', 'alamat' => 'Jl. Imam Bonjol No. 40, Palembang', 'no_telepon' => '0817-7777777', 'golongan_darah' => 'B', 'alergi' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nik' => '7371069876543210', 'nama' => 'Nurul Hamidah', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1992-08-14', 'alamat' => 'Jl. Sultan Agung No. 35, Yogyakarta', 'no_telepon' => '0818-8888888', 'golongan_darah' => 'O', 'alergi' => 'Ibuprofen', 'created_at' => now(), 'updated_at' => now()],
            ['nik' => '7401049876543210', 'nama' => 'Tommy Suwandi', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1986-01-20', 'alamat' => 'Jl. Minto Harahap No. 25, Makassar', 'no_telepon' => '0819-9999999', 'golongan_darah' => 'AB', 'alergi' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nik' => '3206039876543210', 'nama' => 'Eka Safitri', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1993-05-11', 'alamat' => 'Jl. Panglima Polim No. 12, Bandung', 'no_telepon' => '0820-1010101', 'golongan_darah' => 'A', 'alergi' => 'Tetracycline', 'created_at' => now(), 'updated_at' => now()],
            ['nik' => '3201049876543210', 'nama' => 'Iwan Setiawan', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1984-02-27', 'alamat' => 'Jl. Veteran No. 45, Jakarta', 'no_telepon' => '0821-1111111', 'golongan_darah' => 'B', 'alergi' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nik' => '3205059876543210', 'nama' => 'Lisa Gunawan', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1989-09-16', 'alamat' => 'Jl. Gatot Subroto No. 60, Jakarta', 'no_telepon' => '0822-2222222', 'golongan_darah' => 'O', 'alergi' => 'Metformin', 'created_at' => now(), 'updated_at' => now()],
            ['nik' => '3206079876543210', 'nama' => 'Setiawan Hidayat', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1981-10-08', 'alamat' => 'Jl. Sudirman No. 77, Bandung', 'no_telepon' => '0823-3333333', 'golongan_darah' => 'A', 'alergi' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nik' => '3503089876543210', 'nama' => 'Maya Permatasari', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1994-03-22', 'alamat' => 'Jl. Ahmad Yani No. 88, Surabaya', 'no_telepon' => '0824-4444444', 'golongan_darah' => 'B', 'alergi' => 'Sulfa', 'created_at' => now(), 'updated_at' => now()],
            ['nik' => '2201089876543210', 'nama' => 'Doni Hermawan', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1987-06-19', 'alamat' => 'Jl. Gatot Subroto No. 33, Jakarta', 'no_telepon' => '0825-5555555', 'golongan_darah' => 'AB', 'alergi' => null, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // =====================================================
        // 5. SEED OBAT (12 records)
        // =====================================================
        Obat::insert([
            ['nama_obat' => 'Amoxicillin 500mg', 'kategori' => 'Antibiotik', 'satuan' => 'Tablet', 'stok' => 500, 'harga' => 5000.00, 'created_at' => now(), 'updated_at' => now()],
            ['nama_obat' => 'Paracetamol 500mg', 'kategori' => 'Analgesik', 'satuan' => 'Tablet', 'stok' => 1000, 'harga' => 2500.00, 'created_at' => now(), 'updated_at' => now()],
            ['nama_obat' => 'Ibuprofen 200mg', 'kategori' => 'NSAID', 'satuan' => 'Tablet', 'stok' => 750, 'harga' => 3500.00, 'created_at' => now(), 'updated_at' => now()],
            ['nama_obat' => 'Metformin 500mg', 'kategori' => 'Antidiabetes', 'satuan' => 'Tablet', 'stok' => 300, 'harga' => 4500.00, 'created_at' => now(), 'updated_at' => now()],
            ['nama_obat' => 'Atorvastatin 10mg', 'kategori' => 'Statin', 'satuan' => 'Tablet', 'stok' => 200, 'harga' => 8000.00, 'created_at' => now(), 'updated_at' => now()],
            ['nama_obat' => 'Omeprazole 20mg', 'kategori' => 'PPI', 'satuan' => 'Tablet', 'stok' => 400, 'harga' => 6000.00, 'created_at' => now(), 'updated_at' => now()],
            ['nama_obat' => 'Vitamin C 1000mg', 'kategori' => 'Vitamin', 'satuan' => 'Tablet', 'stok' => 800, 'harga' => 3000.00, 'created_at' => now(), 'updated_at' => now()],
            ['nama_obat' => 'Dexamethasone 0.5mg', 'kategori' => 'Kortikosteroid', 'satuan' => 'Tablet', 'stok' => 150, 'harga' => 2000.00, 'created_at' => now(), 'updated_at' => now()],
            ['nama_obat' => 'Ciprofloxacin 500mg', 'kategori' => 'Antibiotik', 'satuan' => 'Tablet', 'stok' => 250, 'harga' => 12000.00, 'created_at' => now(), 'updated_at' => now()],
            ['nama_obat' => 'Antacid Gel', 'kategori' => 'Antacid', 'satuan' => 'Botol', 'stok' => 100, 'harga' => 25000.00, 'created_at' => now(), 'updated_at' => now()],
            ['nama_obat' => 'Loratadine 10mg', 'kategori' => 'Antihistamin', 'satuan' => 'Tablet', 'stok' => 600, 'harga' => 3500.00, 'created_at' => now(), 'updated_at' => now()],
            ['nama_obat' => 'Diclofenac 50mg', 'kategori' => 'NSAID', 'satuan' => 'Tablet', 'stok' => 450, 'harga' => 4000.00, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // =====================================================
        // 6. SEED JADWAL_PRAKTEK (20 records)
        // =====================================================
        JadwalPraktek::insert([
            // Dr. Ahmad Wijaya (ID: 1)
            ['id_dokter' => 1, 'hari' => 'Senin', 'jam_mulai' => '08:00:00', 'jam_selesai' => '12:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['id_dokter' => 1, 'hari' => 'Rabu', 'jam_mulai' => '14:00:00', 'jam_selesai' => '17:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['id_dokter' => 1, 'hari' => 'Jumat', 'jam_mulai' => '08:00:00', 'jam_selesai' => '12:00:00', 'created_at' => now(), 'updated_at' => now()],

            // Dr. Budi Santoso (ID: 2)
            ['id_dokter' => 2, 'hari' => 'Selasa', 'jam_mulai' => '08:00:00', 'jam_selesai' => '12:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['id_dokter' => 2, 'hari' => 'Kamis', 'jam_mulai' => '13:00:00', 'jam_selesai' => '15:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['id_dokter' => 2, 'hari' => 'Sabtu', 'jam_mulai' => '09:00:00', 'jam_selesai' => '13:00:00', 'created_at' => now(), 'updated_at' => now()],

            // Dr. Siti Nurhaliza (ID: 3)
            ['id_dokter' => 3, 'hari' => 'Senin', 'jam_mulai' => '09:00:00', 'jam_selesai' => '12:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['id_dokter' => 3, 'hari' => 'Selasa', 'jam_mulai' => '14:00:00', 'jam_selesai' => '17:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['id_dokter' => 3, 'hari' => 'Kamis', 'jam_mulai' => '09:00:00', 'jam_selesai' => '12:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['id_dokter' => 3, 'hari' => 'Jumat', 'jam_mulai' => '14:00:00', 'jam_selesai' => '17:00:00', 'created_at' => now(), 'updated_at' => now()],

            // Dr. Roni Dharma (ID: 4)
            ['id_dokter' => 4, 'hari' => 'Senin', 'jam_mulai' => '07:00:00', 'jam_selesai' => '11:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['id_dokter' => 4, 'hari' => 'Rabu', 'jam_mulai' => '13:00:00', 'jam_selesai' => '16:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['id_dokter' => 4, 'hari' => 'Jumat', 'jam_mulai' => '07:00:00', 'jam_selesai' => '11:00:00', 'created_at' => now(), 'updated_at' => now()],

            // Dr. Yeni Maharani (ID: 5)
            ['id_dokter' => 5, 'hari' => 'Selasa', 'jam_mulai' => '08:00:00', 'jam_selesai' => '12:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['id_dokter' => 5, 'hari' => 'Kamis', 'jam_mulai' => '14:00:00', 'jam_selesai' => '17:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['id_dokter' => 5, 'hari' => 'Sabtu', 'jam_mulai' => '08:00:00', 'jam_selesai' => '12:00:00', 'created_at' => now(), 'updated_at' => now()],

            // Dr. Hendra Wijaya (ID: 6)
            ['id_dokter' => 6, 'hari' => 'Selasa', 'jam_mulai' => '09:00:00', 'jam_selesai' => '12:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['id_dokter' => 6, 'hari' => 'Kamis', 'jam_mulai' => '14:00:00', 'jam_selesai' => '15:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['id_dokter' => 6, 'hari' => 'Sabtu', 'jam_mulai' => '09:00:00', 'jam_selesai' => '12:00:00', 'created_at' => now(), 'updated_at' => now()],

            // Dr. Andi Pratama (ID: 7)
            ['id_dokter' => 7, 'hari' => 'Senin', 'jam_mulai' => '08:00:00', 'jam_selesai' => '12:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['id_dokter' => 7, 'hari' => 'Rabu', 'jam_mulai' => '14:00:00', 'jam_selesai' => '17:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['id_dokter' => 7, 'hari' => 'Jumat', 'jam_mulai' => '08:00:00', 'jam_selesai' => '12:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['id_dokter' => 7, 'hari' => 'Minggu', 'jam_mulai' => '10:00:00', 'jam_selesai' => '13:00:00', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // =====================================================
        // 7. SEED KUNJUNGAN (15 records)
        // =====================================================
        Kunjungan::insert([
            ['id_pasien' => 1, 'id_dokter' => 1, 'tanggal_kunjungan' => '2025-01-10 09:00:00', 'keluhan' => 'Demam dan batuk-batukan', 'diagnosa' => 'Influenza', 'biaya_admin' => 150000.00, 'status' => 'Selesai', 'created_at' => now(), 'updated_at' => now()],
            ['id_pasien' => 2, 'id_dokter' => 1, 'tanggal_kunjungan' => '2025-01-12 10:30:00', 'keluhan' => 'Sakit kepala dan pusing', 'diagnosa' => 'Migrain', 'biaya_admin' => 150000.00, 'status' => 'Selesai', 'created_at' => now(), 'updated_at' => now()],
            ['id_pasien' => 3, 'id_dokter' => 2, 'tanggal_kunjungan' => '2025-01-15 10:00:00', 'keluhan' => 'Nyeri dada', 'diagnosa' => 'Aritmia Jantung', 'biaya_admin' => 200000.00, 'status' => 'Selesai', 'created_at' => now(), 'updated_at' => now()],
            ['id_pasien' => 4, 'id_dokter' => 3, 'tanggal_kunjungan' => '2025-01-18 09:30:00', 'keluhan' => 'Anak demam tinggi', 'diagnosa' => 'Demam Berdarah', 'biaya_admin' => 150000.00, 'status' => 'Proses', 'created_at' => now(), 'updated_at' => now()],
            ['id_pasien' => 5, 'id_dokter' => 4, 'tanggal_kunjungan' => '2025-02-01 08:00:00', 'keluhan' => 'Diare dan muntah-muntah', 'diagnosa' => 'Gastroenteritis', 'biaya_admin' => 150000.00, 'status' => 'Selesai', 'created_at' => now(), 'updated_at' => now()],
            ['id_pasien' => 6, 'id_dokter' => 5, 'tanggal_kunjungan' => '2025-02-05 11:00:00', 'keluhan' => 'Sakit gigi', 'diagnosa' => 'Karies Gigi', 'biaya_admin' => 100000.00, 'status' => 'Selesai', 'created_at' => now(), 'updated_at' => now()],
            ['id_pasien' => 7, 'id_dokter' => 6, 'tanggal_kunjungan' => '2025-02-08 09:00:00', 'keluhan' => 'Mata merah dan gatal', 'diagnosa' => 'Konjungtivitis Alergi', 'biaya_admin' => 125000.00, 'status' => 'Selesai', 'created_at' => now(), 'updated_at' => now()],
            ['id_pasien' => 8, 'id_dokter' => 7, 'tanggal_kunjungan' => '2025-02-10 10:00:00', 'keluhan' => 'Nyeri sendi', 'diagnosa' => 'Arthritis', 'biaya_admin' => 150000.00, 'status' => 'Selesai', 'created_at' => now(), 'updated_at' => now()],
            ['id_pasien' => 9, 'id_dokter' => 8, 'tanggal_kunjungan' => '2025-02-12 14:00:00', 'keluhan' => 'Pusing dan lemas', 'diagnosa' => 'Anemia', 'biaya_admin' => 150000.00, 'status' => 'Batal', 'created_at' => now(), 'updated_at' => now()],
            ['id_pasien' => 10, 'id_dokter' => 4, 'tanggal_kunjungan' => '2025-02-15 09:30:00', 'keluhan' => 'Batuk kronis', 'diagnosa' => 'Bronkitis', 'biaya_admin' => 150000.00, 'status' => 'Selesai', 'created_at' => now(), 'updated_at' => now()],
            ['id_pasien' => 11, 'id_dokter' => 1, 'tanggal_kunjungan' => '2025-02-18 11:00:00', 'keluhan' => 'Tekanan darah tinggi', 'diagnosa' => 'Hipertensi', 'biaya_admin' => 150000.00, 'status' => 'Selesai', 'created_at' => now(), 'updated_at' => now()],
            ['id_pasien' => 12, 'id_dokter' => 2, 'tanggal_kunjungan' => '2025-02-20 13:00:00', 'keluhan' => 'Sesak napas', 'diagnosa' => 'Angina Pektoris', 'biaya_admin' => 200000.00, 'status' => 'Proses', 'created_at' => now(), 'updated_at' => now()],
            ['id_pasien' => 13, 'id_dokter' => 3, 'tanggal_kunjungan' => '2025-02-22 08:00:00', 'keluhan' => 'Anak tidak mau makan', 'diagnosa' => 'Malnutrisi', 'biaya_admin' => 150000.00, 'status' => 'Selesai', 'created_at' => now(), 'updated_at' => now()],
            ['id_pasien' => 14, 'id_dokter' => 5, 'tanggal_kunjungan' => '2025-02-25 10:30:00', 'keluhan' => 'Bersihkan gigi dan skalering', 'diagnosa' => 'Scaling & Polishing', 'biaya_admin' => 200000.00, 'status' => 'Selesai', 'created_at' => now(), 'updated_at' => now()],
            ['id_pasien' => 15, 'id_dokter' => 7, 'tanggal_kunjungan' => '2025-02-28 15:00:00', 'keluhan' => 'Flu biasa', 'diagnosa' => 'Common Cold', 'biaya_admin' => 150000.00, 'status' => 'Selesai', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // =====================================================
        // 8. SEED RESEP (20 records)
        // =====================================================
        Resep::insert([
            // Kunjungan 1 (Ahmad - Flu)
            ['id_kunjungan' => 1, 'id_obat' => 1, 'jumlah' => 1, 'aturan_pakai' => 'Minum 3 kali sehari, 1 tablet per kali, sesudah makan, selama 7 hari', 'created_at' => now(), 'updated_at' => now()],
            ['id_kunjungan' => 1, 'id_obat' => 2, 'jumlah' => 1, 'aturan_pakai' => 'Minum 3 kali sehari, 1 tablet per kali, jika demam, selama 3 hari', 'created_at' => now(), 'updated_at' => now()],
            ['id_kunjungan' => 1, 'id_obat' => 7, 'jumlah' => 1, 'aturan_pakai' => 'Minum 2 kali sehari, 1 tablet per kali, sesudah makan, selama 7 hari', 'created_at' => now(), 'updated_at' => now()],

            // Kunjungan 2 (Siti - Migrain)
            ['id_kunjungan' => 2, 'id_obat' => 2, 'jumlah' => 1, 'aturan_pakai' => 'Minum 2 kali sehari, 1 tablet per kali, saat nyeri, maksimal 5 hari', 'created_at' => now(), 'updated_at' => now()],
            ['id_kunjungan' => 2, 'id_obat' => 3, 'jumlah' => 1, 'aturan_pakai' => 'Minum 2 kali sehari, 1 tablet per kali, sesudah makan, selama 5 hari', 'created_at' => now(), 'updated_at' => now()],

            // Kunjungan 3 (Budi - Jantung)
            ['id_kunjungan' => 3, 'id_obat' => 5, 'jumlah' => 1, 'aturan_pakai' => 'Minum 1 kali sehari, 1 tablet per kali, pagi hari, selama 1 bulan', 'created_at' => now(), 'updated_at' => now()],
            ['id_kunjungan' => 3, 'id_obat' => 4, 'jumlah' => 1, 'aturan_pakai' => 'Minum 1 kali sehari, 1 tablet per kali, malam hari, selama 1 bulan', 'created_at' => now(), 'updated_at' => now()],

            // Kunjungan 4 (Dewi - DBD)
            ['id_kunjungan' => 4, 'id_obat' => 1, 'jumlah' => 1, 'aturan_pakai' => 'Minum 2 kali sehari, 1 tablet per kali, sesudah makan, selama 5 hari', 'created_at' => now(), 'updated_at' => now()],
            ['id_kunjungan' => 4, 'id_obat' => 7, 'jumlah' => 1, 'aturan_pakai' => 'Minum 2 kali sehari, 1 tablet per kali, sesudah makan, selama 5 hari', 'created_at' => now(), 'updated_at' => now()],
            ['id_kunjungan' => 4, 'id_obat' => 8, 'jumlah' => 1, 'aturan_pakai' => 'Minum 1 kali sehari, 1 tablet per kali, pagi hari, selama 3 hari', 'created_at' => now(), 'updated_at' => now()],

            // Kunjungan 5 (Rudi - Gastroenteritis)
            ['id_kunjungan' => 5, 'id_obat' => 6, 'jumlah' => 1, 'aturan_pakai' => 'Minum 2 kali sehari, 1 tablet per kali, sebelum makan, selama 7 hari', 'created_at' => now(), 'updated_at' => now()],
            ['id_kunjungan' => 5, 'id_obat' => 1, 'jumlah' => 1, 'aturan_pakai' => 'Minum 2 kali sehari, 1 tablet per kali, sesudah makan, selama 5 hari', 'created_at' => now(), 'updated_at' => now()],

            // Kunjungan 6 (Ani - Sakit Gigi)
            ['id_kunjungan' => 6, 'id_obat' => 3, 'jumlah' => 1, 'aturan_pakai' => 'Minum 2 kali sehari, 1 tablet per kali, sesudah makan, selama 5 hari', 'created_at' => now(), 'updated_at' => now()],
            ['id_kunjungan' => 6, 'id_obat' => 12, 'jumlah' => 1, 'aturan_pakai' => 'Minum 2 kali sehari, 1 tablet per kali, sesudah makan, selama 3 hari', 'created_at' => now(), 'updated_at' => now()],

            // Kunjungan 7 (Hariyanto - Konjungtivitis)
            ['id_kunjungan' => 7, 'id_obat' => 11, 'jumlah' => 2, 'aturan_pakai' => 'Diminum 1 kali sehari, 1 tablet per kali, malam hari, selama 5 hari', 'created_at' => now(), 'updated_at' => now()],

            // Kunjungan 8 (Nurul - Arthritis)
            ['id_kunjungan' => 8, 'id_obat' => 12, 'jumlah' => 1, 'aturan_pakai' => 'Minum 2 kali sehari, 1 tablet per kali, sesudah makan, selama 10 hari', 'created_at' => now(), 'updated_at' => now()],

            // Kunjungan 10 (Eka - Bronkitis)
            ['id_kunjungan' => 10, 'id_obat' => 1, 'jumlah' => 1, 'aturan_pakai' => 'Minum 2 kali sehari, 1 tablet per kali, sesudah makan, selama 7 hari', 'created_at' => now(), 'updated_at' => now()],
            ['id_kunjungan' => 10, 'id_obat' => 9, 'jumlah' => 1, 'aturan_pakai' => 'Minum 2 kali sehari, 1 tablet per kali, sesudah makan, selama 7 hari', 'created_at' => now(), 'updated_at' => now()],

            // Kunjungan 11 (Iwan - Hipertensi)
            ['id_kunjungan' => 11, 'id_obat' => 5, 'jumlah' => 1, 'aturan_pakai' => 'Minum 1 kali sehari, 1 tablet per kali, pagi hari, selama 1 bulan', 'created_at' => now(), 'updated_at' => now()],

            // Kunjungan 12 (Lisa - Angina)
            ['id_kunjungan' => 12, 'id_obat' => 5, 'jumlah' => 1, 'aturan_pakai' => 'Minum 1 kali sehari, 1 tablet per kali, pagi hari, selama 1 bulan', 'created_at' => now(), 'updated_at' => now()],

            // Kunjungan 13 (Setiawan - Malnutrisi)
            ['id_kunjungan' => 13, 'id_obat' => 7, 'jumlah' => 2, 'aturan_pakai' => 'Minum 2 kali sehari, 1 tablet per kali, sesudah makan, selama 2 minggu', 'created_at' => now(), 'updated_at' => now()],

            // Kunjungan 15 (Doni - Common Cold)
            ['id_kunjungan' => 15, 'id_obat' => 2, 'jumlah' => 1, 'aturan_pakai' => 'Minum 3 kali sehari, 1 tablet per kali, saat demam, selama 3 hari', 'created_at' => now(), 'updated_at' => now()],
            ['id_kunjungan' => 15, 'id_obat' => 7, 'jumlah' => 1, 'aturan_pakai' => 'Minum 2 kali sehari, 1 tablet per kali, sesudah makan, selama 5 hari', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
