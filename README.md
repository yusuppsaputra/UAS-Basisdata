UAS BASIS DATA
Entity Model yang dibuat
Rumah Sakit
Poliklinik
Dokter
Jadwal Praktek
Pasien
Kunjungan
Obat
Resep
User
Service Lanjutan Metabase & Minio
Metabase
Metabase User Login
Email : yusuppsaputra935@student.esaunggul.ac.id
Password : Esaunggul123
Contoh membuat visualisasi di metabase
Login
Kunjungi halaman http://localhost:3000/ dan login menggunakan akun di atas.

Buat dashboard visualisasi
Buka menu our analytics -> lalu klik + New -> lalu pilih dashboard -> bisa memilih collection our analytics / personal (saya memilih personal)

Di dalam dashboard kita bisa menambah / merubah visualisasi kita berdasarkan table yang sudah ada dengan New Question / Membuat query manual sendiri

Visualisasi di metabase bisa menampilkan Pie Chart, Line Chart, Bar chart dan lain lain masih banyak lagi.

Minio
Untuk website minio bisa dikunjungi di http://localhost:9001/ atau http://localhost:9000/

Minio harus perlu di Setup dulu sebelum di gunakan berikut penjelasan singkat nya

Buat bucket baru

Bucket yang sudah dibuat harus dibuat PUBLIC status nya dengan melakukan command command berikut pada service Minio

mc alias set myminio http://127.0.0.1:9000 minioadmin minioadmin
mc anonymous set download myminio/nama-bucket
mc anonymous set public myminio/nama-bucket
install library league/flysystem-aws-s3-v3 dan melakukan publikasi file livewire dan merubah configurasi disk livewire dengan 'local'

Menambahkan script berikut agar minio dapat digunakan

'minio' => [
            'driver' => 's3',
            'key' => env('MINIO_ACCESS_KEY'),
            'secret' => env('MINIO_SECRET_KEY'),
            'region' => env('MINIO_REGION'),
            'bucket' => env('MINIO_BUCKET'),
            'url' => env('MINIO_URL') . '/' . env('MINIO_BUCKET'),
            'endpoint' => env('MINIO_ENDPOINT'),
            'use_path_style_endpoint' => env('MINIO_USE_PATH_STYLE_ENDPOINT', false),
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ]
Dan yang terakhir adalah merubah konfigurasi environment (jika belum ada maka tambahkan jika sudah ada maka rubah)
FILESYSTEM_DISK=minio
MINIO_ACCESS_KEY=minioadmin
MINIO_SECRET_KEY=minioadmin
MINIO_REGION=us-east-1
MINIO_BUCKET=uas
MINIO_ENDPOINT=http://minio:9000
MINIO_URL=http://localhost:9000
MINIO_USE_PATH_STYLE_ENDPOINT=true
Saya disini mengambil contoh sebagai rumah sakit bisa menampilkan dan mengupload / merubah gambar rumah sakit

Pada migration rumah sakit harus di tambahkan
$table->string('upload_gambar')->nullable();
Setelah itu untuk table bisa menampilkan gambar nya maka harus memiliki script berikut pada Resource Rumah Sakit
Tables\Columns\ImageColumn::make('upload_gambar')
                    ->label('Gambar')
                    ->disk('minio')
                    ->size(60)
                    ->searchable()
Disini saya mengatur size nya 60 pada gambar dan merubah column table menjadi Gambar.

Jika form rumah sakit agar bisa upload gambar maka harus memiliki script berikut pada Resource Rumah Sakit
Forms\Components\FileUpload::make('upload_gambar')
->disk('minio')
->visibility('public')
->image()
->maxSize(2048),
Disini saya mengatur max size gambar yang di upload 2MB.

Terimakasih
Mungkin ini terkait UAS tentang materi lanjutan yaitu Metabase dengan visualisasi dan Minio dengan menampilkan / mengupload gambar.

