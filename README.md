# Buku Tamu Digital

- **Nama**: Asri Roy Bako
- **NIM**: 26110005

## Deskripsi Proyek

Buku Tamu Digital adalah aplikasi web sederhana (PHP + MariaDB) untuk menyimpan dan menampilkan pesan tamu. Proyek ini adalah tugas UTS Teknologi Platform dan berfokus pada aspek platform: command line, hak akses, Git, jaringan, Docker image, dan orkestrasi container dengan Docker Compose.

## Struktur Proyek

    uts_platform/
    |-- app/                  # kode aplikasi (boilerplate dosen)
    |-- config/               # berkas konfigurasi (.env)
    |-- logs/                 # log dan hasil pengujian
    |-- screenshots/          # bukti screenshot
    |-- Dockerfile            # image aplikasi web
    |-- docker-compose.yml    # orkestrasi web + db
    `-- README.md

## Cara Menjalankan

Prasyarat: Git dan Docker (dengan Docker Compose) sudah terpasang.

1. Clone repositori dan masuk ke foldernya:

        git clone <URL_REPOSITORI>
        cd uts_platform

2. Jalankan semua service (build image web dan jalankan db):

        docker compose up -d

3. Cek container berjalan:

        docker compose ps

4. Buka aplikasi di browser: http://localhost:5000

5. Hentikan aplikasi:

        docker compose down

Data database tersimpan di volume `db_data`, sehingga tetap ada setelah `docker compose down` lalu `up` lagi. Gunakan `docker compose down -v` hanya jika ingin menghapus data.

## Komponen Docker Compose

| Komponen | Keterangan |
|----------|------------|
| web      | Build dari Dockerfile, port host 5000 ke container 8000, depends_on db |
| db       | Image mariadb:10.11, root password dan nama database lewat environment |
| volume   | `db_data` untuk persistensi data di `/var/lib/mysql` |
| network  | `bukutamu-net` (custom bridge) untuk komunikasi web dan db |
