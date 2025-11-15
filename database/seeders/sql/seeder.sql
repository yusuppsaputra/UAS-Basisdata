-- =====================================================
-- HOSPITAL MANAGEMENT SYSTEM - SEED DATA (SQL)
-- =====================================================
-- This file contains INSERT statements for all tables
-- Data is 100% consistent across all foreign key relationships
-- =====================================================

-- =====================================================
-- 1. INSERT DATA INTO RUMAH_SAKIT (10 records)
-- =====================================================
INSERT INTO rumah_sakit (nama, alamat, kota, provinsi, no_telepon, kelas_rumah_sakit) VALUES
('RS Pusat Medika Jaya', 'Jl. Gatot Subroto No. 1', 'Jakarta', 'DKI Jakarta', '021-1234567', 'A'),
('RS Klinik Cahaya Sehat', 'Jl. Sudirman No. 45', 'Bandung', 'Jawa Barat', '022-2345678', 'B'),
('RS Medikas Utama', 'Jl. Ahmad Yani No. 12', 'Surabaya', 'Jawa Timur', '031-3456789', 'A'),
('RS Harapan Baru', 'Jl. Diponegoro No. 78', 'Medan', 'Sumatera Utara', '061-4567890', 'C'),
('RS Sehat Sejahtera', 'Jl. Merdeka No. 99', 'Semarang', 'Jawa Tengah', '024-5678901', 'B'),
('RS Kesehatan Mandiri', 'Jl. Imam Bonjol No. 23', 'Palembang', 'Sumatera Selatan', '0711-6789012', 'C'),
('RS Adi Husada', 'Jl. Sultan Agung No. 56', 'Yogyakarta', 'DI Yogyakarta', '0274-7890123', 'B'),
('RS Bahagia Abadi', 'Jl. Minto Harahap No. 34', 'Makassar', 'Sulawesi Selatan', '0411-8901234', 'D'),
('RS Permata Medika', 'Jl. Panglima Polim No. 11', 'Bandung', 'Jawa Barat', '022-9012345', 'C'),
('RS Bintang Sehat', 'Jl. Veteran No. 67', 'Jakarta', 'DKI Jakarta', '021-0123456', 'A');

-- =====================================================
-- 2. INSERT DATA INTO POLIKLINIK (12 records)
-- =====================================================
INSERT INTO poliklinik (id_rumahsakit, nama_poli, lantai, jam_operasional) VALUES
(1, 'Poli Umum', 2, '08:00-17:00'),
(1, 'Poli Jantung', 3, '08:00-15:00'),
(1, 'Poli Anak', 2, '08:00-17:00'),
(2, 'Poli Umum', 1, '07:00-16:00'),
(2, 'Poli Gigi', 2, '08:00-17:00'),
(2, 'Poli Mata', 3, '08:00-15:00'),
(3, 'Poli Umum', 1, '08:00-17:00'),
(3, 'Poli Saraf', 2, '08:00-14:00'),
(3, 'Poli Orthopedi', 3, '09:00-17:00'),
(4, 'Poli Umum', 1, '08:00-17:00'),
(5, 'Poli Umum', 2, '08:00-17:00'),
(6, 'Poli Umum', 1, '08:00-17:00');

-- =====================================================
-- 3. INSERT DATA INTO DOKTER (15 records)
-- =====================================================
INSERT INTO dokter (id_rumahsakit, id_poli, nama_dokter, spesialisasi, no_str, no_telepon) VALUES
(1, 1, 'Dr. Ahmad Wijaya', 'Umum', 'STR001-2023', '0812-1234567'),
(1, 2, 'Dr. Budi Santoso', 'Jantung', 'STR002-2023', '0812-2345678'),
(1, 3, 'Dr. Siti Nurhaliza', 'Anak', 'STR003-2023', '0812-3456789'),
(2, 4, 'Dr. Roni Dharma', 'Umum', 'STR004-2023', '0812-4567890'),
(2, 5, 'Dr. Yeni Maharani', 'Gigi', 'STR005-2023', '0812-5678901'),
(2, 6, 'Dr. Hendra Wijaya', 'Mata', 'STR006-2023', '0812-6789012'),
(3, 7, 'Dr. Andi Pratama', 'Umum', 'STR007-2023', '0812-7890123'),
(3, 8, 'Dr. Nadia Putri', 'Saraf', 'STR008-2023', '0812-8901234'),
(3, 9, 'Dr. Bambang Irawan', 'Orthopedi', 'STR009-2023', '0812-9012345'),
(4, 10, 'Dr. Lina Kusuma', 'Umum', 'STR010-2023', '0813-0123456'),
(5, 11, 'Dr. Gunawan Haryanto', 'Umum', 'STR011-2023', '0813-1234567'),
(6, 12, 'Dr. Endang Wijaya', 'Umum', 'STR012-2023', '0813-2345678'),
(1, 1, 'Dr. Mira Kusuma', 'Umum', 'STR013-2023', '0813-3456789'),
(2, 4, 'Dr. Fajar Sidik', 'Umum', 'STR014-2023', '0813-4567890'),
(3, 7, 'Dr. Wahyu Santoso', 'Umum', 'STR015-2023', '0813-5678901');

-- =====================================================
-- 4. INSERT DATA INTO PASIEN (15 records)
-- =====================================================
INSERT INTO pasien (nik, nama, jenis_kelamin, tanggal_lahir, alamat, no_telepon, golongan_darah, alergi) VALUES
('3201012345678901', 'Ahmad Suryanto', 'Laki-laki', '1985-03-15', 'Jl. Merdeka No. 10, Jakarta', '0811-1111111', 'O', 'Amoxicillin'),
('3204067890123456', 'Siti Nurhaliza', 'Perempuan', '1990-06-22', 'Jl. Sudirman No. 25, Bandung', '0812-2222222', 'A', 'Aspirin'),
('3503019876543210', 'Budi Hartono', 'Laki-laki', '1978-09-05', 'Jl. Ahmad Yani No. 30, Surabaya', '0813-3333333', 'B', NULL),
('2201018765432109', 'Dewi Lestari', 'Perempuan', '1995-11-18', 'Jl. Gatot Subroto No. 15, Jakarta', '0814-4444444', 'AB', 'Penicillin'),
('5371029876543210', 'Rudi Hermawan', 'Laki-laki', '1982-07-10', 'Jl. Diponegoro No. 50, Medan', '0815-5555555', 'O', NULL),
('3306019876543210', 'Ani Wijaya', 'Perempuan', '1988-04-28', 'Jl. Merdeka No. 20, Semarang', '0816-6666666', 'A', 'Erythromycin'),
('1671019876543210', 'Hariyanto Kusuma', 'Laki-laki', '1980-12-03', 'Jl. Imam Bonjol No. 40, Palembang', '0817-7777777', 'B', NULL),
('7371069876543210', 'Nurul Hamidah', 'Perempuan', '1992-08-14', 'Jl. Sultan Agung No. 35, Yogyakarta', '0818-8888888', 'O', 'Ibuprofen'),
('7401049876543210', 'Tommy Suwandi', 'Laki-laki', '1986-01-20', 'Jl. Minto Harahap No. 25, Makassar', '0819-9999999', 'AB', NULL),
('3206039876543210', 'Eka Safitri', 'Perempuan', '1993-05-11', 'Jl. Panglima Polim No. 12, Bandung', '0820-1010101', 'A', 'Tetracycline'),
('3201049876543210', 'Iwan Setiawan', 'Laki-laki', '1984-02-27', 'Jl. Veteran No. 45, Jakarta', '0821-1111111', 'B', NULL),
('3205059876543210', 'Lisa Gunawan', 'Perempuan', '1989-09-16', 'Jl. Gatot Subroto No. 60, Jakarta', '0822-2222222', 'O', 'Metformin'),
('3206079876543210', 'Setiawan Hidayat', 'Laki-laki', '1981-10-08', 'Jl. Sudirman No. 77, Bandung', '0823-3333333', 'A', NULL),
('3503089876543210', 'Maya Permatasari', 'Perempuan', '1994-03-22', 'Jl. Ahmad Yani No. 88, Surabaya', '0824-4444444', 'B', 'Sulfa'),
('2201089876543210', 'Doni Hermawan', 'Laki-laki', '1987-06-19', 'Jl. Gatot Subroto No. 33, Jakarta', '0825-5555555', 'AB', NULL);

-- =====================================================
-- 5. INSERT DATA INTO OBAT (12 records)
-- =====================================================
INSERT INTO obat (nama_obat, kategori, satuan, stok, harga) VALUES
('Amoxicillin 500mg', 'Antibiotik', 'Tablet', 500, 5000.00),
('Paracetamol 500mg', 'Analgesik', 'Tablet', 1000, 2500.00),
('Ibuprofen 200mg', 'NSAID', 'Tablet', 750, 3500.00),
('Metformin 500mg', 'Antidiabetes', 'Tablet', 300, 4500.00),
('Atorvastatin 10mg', 'Statin', 'Tablet', 200, 8000.00),
('Omeprazole 20mg', 'PPI', 'Tablet', 400, 6000.00),
('Vitamin C 1000mg', 'Vitamin', 'Tablet', 800, 3000.00),
('Dexamethasone 0.5mg', 'Kortikosteroid', 'Tablet', 150, 2000.00),
('Ciprofloxacin 500mg', 'Antibiotik', 'Tablet', 250, 12000.00),
('Antacid Gel', 'Antacid', 'Botol', 100, 25000.00),
('Loratadine 10mg', 'Antihistamin', 'Tablet', 600, 3500.00),
('Diclofenac 50mg', 'NSAID', 'Tablet', 450, 4000.00);

-- =====================================================
-- 6. INSERT DATA INTO JADWAL_PRAKTEK (20 records)
-- =====================================================
-- Dr. Ahmad Wijaya (ID: 1)
INSERT INTO jadwal_praktek (id_dokter, hari, jam_mulai, jam_selesai) VALUES
(1, 'Senin', '08:00:00', '12:00:00'),
(1, 'Rabu', '14:00:00', '17:00:00'),
(1, 'Jumat', '08:00:00', '12:00:00'),

-- Dr. Budi Santoso (ID: 2)
(2, 'Selasa', '08:00:00', '12:00:00'),
(2, 'Kamis', '13:00:00', '15:00:00'),
(2, 'Sabtu', '09:00:00', '13:00:00'),

-- Dr. Siti Nurhaliza (ID: 3)
(3, 'Senin', '09:00:00', '12:00:00'),
(3, 'Selasa', '14:00:00', '17:00:00'),
(3, 'Kamis', '09:00:00', '12:00:00'),
(3, 'Jumat', '14:00:00', '17:00:00'),

-- Dr. Roni Dharma (ID: 4)
(4, 'Senin', '07:00:00', '11:00:00'),
(4, 'Rabu', '13:00:00', '16:00:00'),
(4, 'Jumat', '07:00:00', '11:00:00'),

-- Dr. Yeni Maharani (ID: 5)
(5, 'Selasa', '08:00:00', '12:00:00'),
(5, 'Kamis', '14:00:00', '17:00:00'),
(5, 'Sabtu', '08:00:00', '12:00:00'),

-- Dr. Hendra Wijaya (ID: 6)
(6, 'Selasa', '09:00:00', '12:00:00'),
(6, 'Kamis', '14:00:00', '15:00:00'),
(6, 'Sabtu', '09:00:00', '12:00:00'),

-- Dr. Andi Pratama (ID: 7)
(7, 'Senin', '08:00:00', '12:00:00'),
(7, 'Rabu', '14:00:00', '17:00:00'),
(7, 'Jumat', '08:00:00', '12:00:00'),
(7, 'Minggu', '10:00:00', '13:00:00');

-- =====================================================
-- 7. INSERT DATA INTO KUNJUNGAN (15 records)
-- =====================================================
INSERT INTO kunjungan (id_pasien, id_dokter, tanggal_kunjungan, keluhan, diagnosa, biaya_admin, status) VALUES
(1, 1, '2025-01-10 09:00:00', 'Demam dan batuk-batukan', 'Influenza', 150000.00, 'Selesai'),
(2, 1, '2025-01-12 10:30:00', 'Sakit kepala dan pusing', 'Migrain', 150000.00, 'Selesai'),
(3, 2, '2025-01-15 10:00:00', 'Nyeri dada', 'Aritmia Jantung', 200000.00, 'Selesai'),
(4, 3, '2025-01-18 09:30:00', 'Anak demam tinggi', 'Demam Berdarah', 150000.00, 'Proses'),
(5, 4, '2025-02-01 08:00:00', 'Diare dan muntah-muntah', 'Gastroenteritis', 150000.00, 'Selesai'),
(6, 5, '2025-02-05 11:00:00', 'Sakit gigi', 'Karies Gigi', 100000.00, 'Selesai'),
(7, 6, '2025-02-08 09:00:00', 'Mata merah dan gatal', 'Konjungtivitis Alergi', 125000.00, 'Selesai'),
(8, 7, '2025-02-10 10:00:00', 'Nyeri sendi', 'Arthritis', 150000.00, 'Selesai'),
(9, 8, '2025-02-12 14:00:00', 'Pusing dan lemas', 'Anemia', 150000.00, 'Batal'),
(10, 4, '2025-02-15 09:30:00', 'Batuk kronis', 'Bronkitis', 150000.00, 'Selesai'),
(11, 1, '2025-02-18 11:00:00', 'Tekanan darah tinggi', 'Hipertensi', 150000.00, 'Selesai'),
(12, 2, '2025-02-20 13:00:00', 'Sesak napas', 'Angina Pektoris', 200000.00, 'Proses'),
(13, 3, '2025-02-22 08:00:00', 'Anak tidak mau makan', 'Malnutrisi', 150000.00, 'Selesai'),
(14, 5, '2025-02-25 10:30:00', 'Bersihkan gigi dan skalering', 'Scaling & Polishing', 200000.00, 'Selesai'),
(15, 7, '2025-02-28 15:00:00', 'Flu biasa', 'Common Cold', 150000.00, 'Selesai');

-- =====================================================
-- 8. INSERT DATA INTO RESEP (20 records)
-- =====================================================
INSERT INTO resep (id_kunjungan, id_obat, jumlah, aturan_pakai) VALUES
-- Kunjungan 1 (Ahmad - Flu)
(1, 1, 1, 'Minum 3 kali sehari, 1 tablet per kali, sesudah makan, selama 7 hari'),
(1, 2, 1, 'Minum 3 kali sehari, 1 tablet per kali, jika demam, selama 3 hari'),
(1, 7, 1, 'Minum 2 kali sehari, 1 tablet per kali, sesudah makan, selama 7 hari'),

-- Kunjungan 2 (Siti - Migrain)
(2, 2, 1, 'Minum 2 kali sehari, 1 tablet per kali, saat nyeri, maksimal 5 hari'),
(2, 3, 1, 'Minum 2 kali sehari, 1 tablet per kali, sesudah makan, selama 5 hari'),

-- Kunjungan 3 (Budi - Jantung)
(3, 5, 1, 'Minum 1 kali sehari, 1 tablet per kali, pagi hari, selama 1 bulan'),
(3, 4, 1, 'Minum 1 kali sehari, 1 tablet per kali, malam hari, selama 1 bulan'),

-- Kunjungan 4 (Dewi - DBD)
(4, 1, 1, 'Minum 2 kali sehari, 1 tablet per kali, sesudah makan, selama 5 hari'),
(4, 7, 1, 'Minum 2 kali sehari, 1 tablet per kali, sesudah makan, selama 5 hari'),
(4, 8, 1, 'Minum 1 kali sehari, 1 tablet per kali, pagi hari, selama 3 hari'),

-- Kunjungan 5 (Rudi - Gastroenteritis)
(5, 6, 1, 'Minum 2 kali sehari, 1 tablet per kali, sebelum makan, selama 7 hari'),
(5, 1, 1, 'Minum 2 kali sehari, 1 tablet per kali, sesudah makan, selama 5 hari'),

-- Kunjungan 6 (Ani - Sakit Gigi)
(6, 3, 1, 'Minum 2 kali sehari, 1 tablet per kali, sesudah makan, selama 5 hari'),
(6, 12, 1, 'Minum 2 kali sehari, 1 tablet per kali, sesudah makan, selama 3 hari'),

-- Kunjungan 7 (Hariyanto - Konjungtivitis)
(7, 11, 2, 'Diminum 1 kali sehari, 1 tablet per kali, malam hari, selama 5 hari'),

-- Kunjungan 8 (Nurul - Arthritis)
(8, 12, 1, 'Minum 2 kali sehari, 1 tablet per kali, sesudah makan, selama 10 hari'),

-- Kunjungan 10 (Eka - Bronkitis)
(10, 1, 1, 'Minum 2 kali sehari, 1 tablet per kali, sesudah makan, selama 7 hari'),
(10, 9, 1, 'Minum 2 kali sehari, 1 tablet per kali, sesudah makan, selama 7 hari'),

-- Kunjungan 11 (Iwan - Hipertensi)
(11, 5, 1, 'Minum 1 kali sehari, 1 tablet per kali, pagi hari, selama 1 bulan'),

-- Kunjungan 12 (Lisa - Angina)
(12, 5, 1, 'Minum 1 kali sehari, 1 tablet per kali, pagi hari, selama 1 bulan'),

-- Kunjungan 13 (Setiawan - Malnutrisi)
(13, 7, 2, 'Minum 2 kali sehari, 1 tablet per kali, sesudah makan, selama 2 minggu'),

-- Kunjungan 15 (Doni - Common Cold)
(15, 2, 1, 'Minum 3 kali sehari, 1 tablet per kali, saat demam, selama 3 hari'),
(15, 7, 1, 'Minum 2 kali sehari, 1 tablet per kali, sesudah makan, selama 5 hari');

-- =====================================================
-- VERIFICATION QUERIES
-- =====================================================
-- Count records in each table
SELECT 'rumah_sakit' as table_name, COUNT(*) as total FROM rumah_sakit
UNION ALL
SELECT 'poliklinik', COUNT(*) FROM poliklinik
UNION ALL
SELECT 'dokter', COUNT(*) FROM dokter
UNION ALL
SELECT 'pasien', COUNT(*) FROM pasien
UNION ALL
SELECT 'obat', COUNT(*) FROM obat
UNION ALL
SELECT 'jadwal_praktek', COUNT(*) FROM jadwal_praktek
UNION ALL
SELECT 'kunjungan', COUNT(*) FROM kunjungan
UNION ALL
SELECT 'resep', COUNT(*) FROM resep;
