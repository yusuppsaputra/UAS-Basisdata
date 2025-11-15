-- =====================================================
-- HOSPITAL MANAGEMENT SYSTEM - EXAMPLE QUERIES
-- =====================================================
-- Collection of useful queries for reporting and analysis
-- =====================================================

-- =====================================================
-- 1. LAPORAN KUNJUNGAN DENGAN DETAIL DOKTER DAN PASIEN
-- =====================================================
-- Menampilkan semua kunjungan dengan informasi lengkap pasien, dokter, dan poliklinik

SELECT 
    k.id_kunjungan,
    p.nama AS nama_pasien,
    p.nik,
    p.golongan_darah,
    p.alergi,
    d.nama_dokter,
    d.spesialisasi,
    pol.nama_poli,
    rs.nama AS nama_rumahsakit,
    k.tanggal_kunjungan,
    k.keluhan,
    k.diagnosa,
    k.biaya_admin,
    k.status
FROM kunjungan k
JOIN pasien p ON k.id_pasien = p.id_pasien
JOIN dokter d ON k.id_dokter = d.id_dokter
JOIN poliklinik pol ON d.id_poli = pol.id_poli
JOIN rumah_sakit rs ON d.id_rumahsakit = rs.id_rumahsakit
WHERE k.tanggal_kunjungan BETWEEN '2025-01-01' AND '2025-12-31'
ORDER BY k.tanggal_kunjungan DESC;

-- =====================================================
-- 2. LAPORAN RESEP DENGAN DETAIL OBAT DAN PASIEN
-- =====================================================
-- Menampilkan semua resep dengan informasi lengkap obat, harga, dan total biaya

SELECT 
    r.id_resep,
    k.id_kunjungan,
    p.nama AS nama_pasien,
    p.nik,
    d.nama_dokter,
    d.spesialisasi,
    o.nama_obat,
    o.kategori,
    o.harga,
    r.jumlah,
    o.satuan,
    (r.jumlah * o.harga) AS total_harga,
    r.aturan_pakai,
    k.tanggal_kunjungan
FROM resep r
JOIN kunjungan k ON r.id_kunjungan = k.id_kunjungan
JOIN pasien p ON k.id_pasien = p.id_pasien
JOIN dokter d ON k.id_dokter = d.id_dokter
JOIN obat o ON r.id_obat = o.id_obat
ORDER BY r.id_resep DESC;

-- =====================================================
-- 3. SEARCH PASIEN BERDASARKAN NAMA DAN NIK
-- =====================================================
-- Mencari pasien berdasarkan kriteria nama atau NIK

SELECT 
    id_pasien,
    nik,
    nama,
    jenis_kelamin,
    tanggal_lahir,
    alamat,
    no_telepon,
    golongan_darah,
    alergi
FROM pasien
WHERE nama LIKE '%Ahmad%' OR nik LIKE '%3201%'
LIMIT 10;

-- =====================================================
-- 4. TOTAL KUNJUNGAN PER DOKTER
-- =====================================================
-- Statistik kunjungan dokter dengan breakdown status

SELECT 
    d.id_dokter,
    d.nama_dokter,
    d.spesialisasi,
    pol.nama_poli,
    rs.nama AS nama_rumahsakit,
    COUNT(k.id_kunjungan) AS total_kunjungan,
    SUM(CASE WHEN k.status = 'Selesai' THEN 1 ELSE 0 END) AS selesai,
    SUM(CASE WHEN k.status = 'Proses' THEN 1 ELSE 0 END) AS proses,
    SUM(CASE WHEN k.status = 'Batal' THEN 1 ELSE 0 END) AS batal,
    SUM(k.biaya_admin) AS total_biaya_admin
FROM dokter d
LEFT JOIN poliklinik pol ON d.id_poli = pol.id_poli
LEFT JOIN rumah_sakit rs ON d.id_rumahsakit = rs.id_rumahsakit
LEFT JOIN kunjungan k ON d.id_dokter = k.id_dokter
GROUP BY d.id_dokter, d.nama_dokter, d.spesialisasi, pol.nama_poli, rs.nama
ORDER BY total_kunjungan DESC;

-- =====================================================
-- 5. STOK OBAT DAN PENGGUNAAN
-- =====================================================
-- Analisis penggunaan obat dan sisa stok

SELECT 
    o.id_obat,
    o.nama_obat,
    o.kategori,
    o.satuan,
    o.harga,
    o.stok,
    COUNT(r.id_resep) AS total_penggunaan,
    SUM(r.jumlah) AS jumlah_terpakai,
    (o.stok - COALESCE(SUM(r.jumlah), 0)) AS sisa_stok,
    ROUND((o.stok - COALESCE(SUM(r.jumlah), 0)) / o.stok * 100, 2) AS persentase_sisa
FROM obat o
LEFT JOIN resep r ON o.id_obat = r.id_obat
GROUP BY o.id_obat, o.nama_obat, o.kategori, o.satuan, o.harga, o.stok
ORDER BY total_penggunaan DESC;

-- =====================================================
-- 6. JADWAL PRAKTEK DOKTER SPESIALIS JANTUNG
-- =====================================================
-- Menampilkan jadwal praktek untuk spesialisasi tertentu

SELECT 
    d.id_dokter,
    d.nama_dokter,
    d.spesialisasi,
    d.no_str,
    jp.hari,
    jp.jam_mulai,
    jp.jam_selesai,
    TIMEDIFF(jp.jam_selesai, jp.jam_mulai) AS durasi,
    pol.nama_poli,
    pol.lantai,
    rs.nama AS nama_rumahsakit,
    rs.kota,
    rs.no_telepon
FROM jadwal_praktek jp
JOIN dokter d ON jp.id_dokter = d.id_dokter
JOIN poliklinik pol ON d.id_poli = pol.id_poli
JOIN rumah_sakit rs ON d.id_rumahsakit = rs.id_rumahsakit
WHERE d.spesialisasi = 'Jantung'
ORDER BY jp.hari, jp.jam_mulai;

-- =====================================================
-- 7. LAPORAN REVENUE KUNJUNGAN PER BULAN
-- =====================================================
-- Analisis pendapatan dari biaya admin kunjungan

SELECT 
    YEAR(k.tanggal_kunjungan) AS tahun,
    MONTHNAME(k.tanggal_kunjungan) AS bulan,
    MONTH(k.tanggal_kunjungan) AS bulan_num,
    COUNT(k.id_kunjungan) AS total_kunjungan,
    SUM(CASE WHEN k.status = 'Selesai' THEN 1 ELSE 0 END) AS kunjungan_selesai,
    SUM(CASE WHEN k.status = 'Proses' THEN 1 ELSE 0 END) AS kunjungan_proses,
    SUM(CASE WHEN k.status = 'Batal' THEN 1 ELSE 0 END) AS kunjungan_batal,
    SUM(k.biaya_admin) AS total_biaya_admin,
    AVG(k.biaya_admin) AS rata_rata_biaya
FROM kunjungan k
WHERE k.status = 'Selesai'
GROUP BY YEAR(k.tanggal_kunjungan), MONTHNAME(k.tanggal_kunjungan), MONTH(k.tanggal_kunjungan)
ORDER BY tahun DESC, bulan_num DESC;

-- =====================================================
-- 8. DATA LENGKAP PASIEN DENGAN RIWAYAT KUNJUNGAN
-- =====================================================
-- Profil pasien dengan jumlah kunjungan dan diagnosa terakhir

SELECT 
    p.id_pasien,
    p.nik,
    p.nama,
    p.jenis_kelamin,
    p.tanggal_lahir,
    YEAR(CURDATE()) - YEAR(p.tanggal_lahir) AS usia,
    p.golongan_darah,
    p.alergi,
    p.alamat,
    p.no_telepon,
    COUNT(k.id_kunjungan) AS total_kunjungan,
    MAX(k.tanggal_kunjungan) AS kunjungan_terakhir,
    (SELECT diagnosa FROM kunjungan WHERE id_pasien = p.id_pasien ORDER BY tanggal_kunjungan DESC LIMIT 1) AS diagnosa_terakhir
FROM pasien p
LEFT JOIN kunjungan k ON p.id_pasien = k.id_pasien
GROUP BY p.id_pasien, p.nik, p.nama, p.jenis_kelamin, p.tanggal_lahir, p.golongan_darah, p.alergi, p.alamat, p.no_telepon
ORDER BY total_kunjungan DESC;

-- =====================================================
-- 9. DOKTER DENGAN JADWAL TERLENGKAP
-- =====================================================
-- Menampilkan dokter dengan jumlah hari praktek terbanyak

SELECT 
    d.id_dokter,
    d.nama_dokter,
    d.spesialisasi,
    d.no_str,
    pol.nama_poli,
    COUNT(jp.id_jadwal) AS total_hari_praktek,
    GROUP_CONCAT(DISTINCT jp.hari SEPARATOR ', ') AS hari_praktek,
    COUNT(DISTINCT k.id_kunjungan) AS total_pasien_dilayani
FROM dokter d
LEFT JOIN jadwal_praktek jp ON d.id_dokter = jp.id_dokter
LEFT JOIN poliklinik pol ON d.id_poli = pol.id_poli
LEFT JOIN kunjungan k ON d.id_dokter = k.id_dokter
GROUP BY d.id_dokter, d.nama_dokter, d.spesialisasi, d.no_str, pol.nama_poli
ORDER BY total_hari_praktek DESC;

-- =====================================================
-- 10. RESEP DENGAN TOTAL NILAI EKONOMIS
-- =====================================================
-- Analisis nilai ekonomis resep yang diberikan

SELECT 
    r.id_resep,
    k.id_kunjungan,
    p.nama AS nama_pasien,
    d.nama_dokter,
    k.diagnosa,
    COUNT(r.id_obat) AS jumlah_obat_resep,
    SUM(r.jumlah * o.harga) AS total_nilai_resep,
    k.biaya_admin,
    (SUM(r.jumlah * o.harga) + k.biaya_admin) AS total_biaya_kunjungan
FROM resep r
JOIN kunjungan k ON r.id_kunjungan = k.id_kunjungan
JOIN pasien p ON k.id_pasien = p.id_pasien
JOIN dokter d ON k.id_dokter = d.id_dokter
JOIN obat o ON r.id_obat = o.id_obat
GROUP BY r.id_resep, k.id_kunjungan, p.nama, d.nama_dokter, k.diagnosa, k.biaya_admin
ORDER BY total_nilai_resep DESC;

-- =====================================================
-- 11. POLIKLINIK DENGAN KUNJUNGAN TERBANYAK
-- =====================================================
-- Analisis poliklinik yang paling banyak dikunjungi

SELECT 
    pol.id_poli,
    pol.nama_poli,
    pol.lantai,
    pol.jam_operasional,
    rs.nama AS nama_rumahsakit,
    rs.kota,
    COUNT(DISTINCT d.id_dokter) AS jumlah_dokter,
    COUNT(k.id_kunjungan) AS total_kunjungan,
    COUNT(DISTINCT k.id_pasien) AS jumlah_pasien_unik,
    SUM(k.biaya_admin) AS total_biaya_admin
FROM poliklinik pol
LEFT JOIN rumah_sakit rs ON pol.id_rumahsakit = rs.id_rumahsakit
LEFT JOIN dokter d ON pol.id_poli = d.id_poli
LEFT JOIN kunjungan k ON d.id_dokter = k.id_dokter
GROUP BY pol.id_poli, pol.nama_poli, pol.lantai, pol.jam_operasional, rs.nama, rs.kota
ORDER BY total_kunjungan DESC;

-- =====================================================
-- 12. PASIEN DENGAN ALERGI RIWAYAT ALERGI
-- =====================================================
-- Data pasien yang memiliki alergi untuk keperluan keamanan

SELECT 
    p.id_pasien,
    p.nik,
    p.nama,
    p.golongan_darah,
    p.alergi,
    COUNT(k.id_kunjungan) AS total_kunjungan,
    GROUP_CONCAT(DISTINCT o.nama_obat SEPARATOR ', ') AS obat_yang_pernah_dikonsumsi
FROM pasien p
LEFT JOIN kunjungan k ON p.id_pasien = k.id_pasien
LEFT JOIN resep r ON k.id_kunjungan = r.id_kunjungan
LEFT JOIN obat o ON r.id_obat = o.id_obat
WHERE p.alergi IS NOT NULL AND p.alergi != ''
GROUP BY p.id_pasien, p.nik, p.nama, p.golongan_darah, p.alergi
ORDER BY p.nama;

-- =====================================================
-- 13. STATISTIK RUMAH SAKIT
-- =====================================================
-- Ringkasan statistik per rumah sakit

SELECT 
    rs.id_rumahsakit,
    rs.nama AS nama_rumahsakit,
    rs.kelas_rumah_sakit,
    rs.kota,
    rs.provinsi,
    COUNT(DISTINCT pol.id_poli) AS jumlah_poliklinik,
    COUNT(DISTINCT d.id_dokter) AS jumlah_dokter,
    COUNT(DISTINCT k.id_kunjungan) AS total_kunjungan,
    COUNT(DISTINCT k.id_pasien) AS jumlah_pasien_unik,
    SUM(k.biaya_admin) AS total_biaya_admin,
    AVG(k.biaya_admin) AS rata_rata_biaya
FROM rumah_sakit rs
LEFT JOIN poliklinik pol ON rs.id_rumahsakit = pol.id_rumahsakit
LEFT JOIN dokter d ON rs.id_rumahsakit = d.id_rumahsakit
LEFT JOIN kunjungan k ON d.id_dokter = k.id_dokter
GROUP BY rs.id_rumahsakit, rs.nama, rs.kelas_rumah_sakit, rs.kota, rs.provinsi
ORDER BY total_kunjungan DESC;

-- =====================================================
-- 14. OBAT YANG BELUM PERNAH DIGUNAKAN
-- =====================================================
-- Obat di inventory yang belum pernah diresepkan

SELECT 
    o.id_obat,
    o.nama_obat,
    o.kategori,
    o.satuan,
    o.stok,
    o.harga,
    (o.stok * o.harga) AS nilai_inventory
FROM obat o
LEFT JOIN resep r ON o.id_obat = r.id_obat
WHERE r.id_resep IS NULL
ORDER BY o.nama_obat;

-- =====================================================
-- 15. DIAGNOSIS YANG PALING SERING MUNCUL
-- =====================================================
-- Analisis penyakit/diagnosa yang paling banyak ditemukan

SELECT 
    k.diagnosa,
    COUNT(k.id_kunjungan) AS jumlah_kasus,
    COUNT(DISTINCT k.id_dokter) AS jumlah_dokter_menangani,
    COUNT(DISTINCT k.id_pasien) AS jumlah_pasien,
    ROUND(COUNT(k.id_kunjungan) / (SELECT COUNT(*) FROM kunjungan) * 100, 2) AS persentase,
    AVG(k.biaya_admin) AS rata_rata_biaya
FROM kunjungan k
WHERE k.diagnosa IS NOT NULL AND k.diagnosa != ''
GROUP BY k.diagnosa
ORDER BY jumlah_kasus DESC;
