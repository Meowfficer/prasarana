-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Mar 2021 pada 15.17
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prasarana`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barangs`
--

CREATE TABLE `barangs` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `jml_barang` int(11) DEFAULT NULL,
  `jenis_barang` varchar(255) NOT NULL,
  `kategori_barang` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barangs`
--

INSERT INTO `barangs` (`id`, `kode_barang`, `nama_barang`, `jml_barang`, `jenis_barang`, `kategori_barang`, `created_at`, `updated_at`) VALUES
(7, 'PRY93', 'In Focus', 4, 'Elektronik', 'Proyekto', '2021-03-26 18:54:48', '2021-03-26 18:54:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_keluars`
--

CREATE TABLE `barang_keluars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_barang` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `id_peminjam` int(11) NOT NULL,
  `jml_barang` int(11) NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_masuks`
--

CREATE TABLE `barang_masuks` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `seri_barang` varchar(255) NOT NULL,
  `jumlah_masuk` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang_masuks`
--

INSERT INTO `barang_masuks` (`id`, `kode_barang`, `seri_barang`, `jumlah_masuk`, `id_supplier`, `created_at`, `updated_at`) VALUES
(7, 'PRY93', 'PRY93-19', 1, 1, '2021-03-26 15:37:43', '2021-03-26 15:37:43'),
(8, 'PRY93', 'PRY93-83', 1, 1, '2021-03-26 17:41:07', '2021-03-26 17:41:07'),
(9, 'PRY93', 'PRY93-25', 1, 1, '2021-03-26 17:41:08', '2021-03-26 17:41:08'),
(10, 'PRY93', 'PRY93-23', 1, 1, '2021-03-26 17:41:09', '2021-03-26 17:41:09'),
(11, 'PRY93', 'PRY93-75', 1, 1, '2021-03-26 17:41:09', '2021-03-26 17:41:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_11_29_094954_create_barangs_table', 1),
(5, '2021_01_17_210433_create_pinjam_barangs_table', 2),
(6, '2021_02_23_220418_create_barang_keluars_table', 3),
(8, '2021_03_08_205226_create_stok_barangs_table', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pinjam_barangs`
--

CREATE TABLE `pinjam_barangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_peminjam` bigint(20) UNSIGNED NOT NULL,
  `kode_barang` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `seri_barang` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `jml_barang` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1 = Menunggu Persetujuan Meminjam, 2 = Dipinjam, 3 = Menunggu Persetujuan Mengembalikan, 4 = Dikembalikan, 5 = Ditolak',
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pinjam_barangs`
--

INSERT INTO `pinjam_barangs` (`id`, `id_peminjam`, `kode_barang`, `seri_barang`, `jml_barang`, `status`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 1, 'PRY93', 'PRY93-5', 1, 5, 'Presentasi', '2021-03-26 17:23:58', '2021-03-26 17:23:58'),
(2, 4, 'PRY93', 'PRY93-19', 1, 5, 'Presentasi', '2021-03-26 18:52:19', '2021-03-26 18:52:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok_barangs`
--

CREATE TABLE `stok_barangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_barang` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `seri_barang` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `status` int(11) NOT NULL COMMENT '1 = Tersedia, 2 = Tidak Tersedia',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `stok_barangs`
--

INSERT INTO `stok_barangs` (`id`, `kode_barang`, `seri_barang`, `status`, `created_at`, `updated_at`) VALUES
(7, 'PRY93', 'PRY93-19', 1, '2021-03-26 15:37:43', '2021-03-26 15:37:43'),
(8, 'PRY93', 'PRY93-83', 1, '2021-03-26 17:41:07', '2021-03-26 17:41:07'),
(9, 'PRY93', 'PRY93-25', 1, '2021-03-26 17:41:08', '2021-03-26 17:41:08'),
(10, 'PRY93', 'PRY93-23', 1, '2021-03-26 17:41:09', '2021-03-26 17:41:09'),
(11, 'PRY93', 'PRY93-75', 1, '2021-03-26 17:41:09', '2021-03-26 17:41:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `kota` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `suppliers`
--

INSERT INTO `suppliers` (`id`, `nama`, `alamat`, `no_telp`, `kota`, `created_at`, `updated_at`) VALUES
(1, 'Agung', 'Jl. Agung Sahaja', '085315267519', 'Kota Agung', '2021-03-26 17:44:35', '2021-03-26 17:44:35'),
(2, 'Budi', 'Jl. Balas Budi', '085423651126', 'Kota Budi', '2021-03-26 18:24:44', '2021-03-26 18:24:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_akun` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email_verified_at`, `password`, `role`, `status_akun`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Alandra', 'admin', NULL, '$2y$10$q0zuurZztwzjR.woexOUXe9BaxwLGGUsqQPefySQYQGToc8uN5/tS', '1', 1, NULL, '2020-12-02 09:49:58', '2021-02-26 18:06:23'),
(2, 'User', 'user', NULL, '$2y$10$T5svT1rDTmmNx3ZAZqATduygtjQuhBd44qgO81cX2Eg4XiE1kMpNq', '2', 1, NULL, '2020-12-02 21:17:24', '2020-12-02 21:17:24'),
(4, 'Alandra Ravi', 'alandra', NULL, '$2y$10$dEGx8HFPXrBch6KXFPOf3.UF/HsYwF79nIxHFr3OMYiE6jPWl5LfK', '2', 0, NULL, '2021-03-26 18:47:20', '2021-03-27 09:21:14');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barangs`
--
ALTER TABLE `barangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_barang` (`kode_barang`);

--
-- Indeks untuk tabel `barang_keluars`
--
ALTER TABLE `barang_keluars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_barang` (`kode_barang`);

--
-- Indeks untuk tabel `barang_masuks`
--
ALTER TABLE `barang_masuks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_supplier` (`id_supplier`),
  ADD KEY `kode_barang` (`kode_barang`),
  ADD KEY `seri_barang` (`seri_barang`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `pinjam_barangs`
--
ALTER TABLE `pinjam_barangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_peminjam` (`id_peminjam`),
  ADD KEY `kode_barang` (`kode_barang`),
  ADD KEY `seri_barang` (`seri_barang`);

--
-- Indeks untuk tabel `stok_barangs`
--
ALTER TABLE `stok_barangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_barang` (`kode_barang`),
  ADD KEY `seri_barang` (`seri_barang`);

--
-- Indeks untuk tabel `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barangs`
--
ALTER TABLE `barangs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `barang_keluars`
--
ALTER TABLE `barang_keluars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `barang_masuks`
--
ALTER TABLE `barang_masuks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `pinjam_barangs`
--
ALTER TABLE `pinjam_barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `stok_barangs`
--
ALTER TABLE `stok_barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang_masuks`
--
ALTER TABLE `barang_masuks`
  ADD CONSTRAINT `barang_masuks_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `suppliers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `barang_masuks_ibfk_2` FOREIGN KEY (`kode_barang`) REFERENCES `barangs` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pinjam_barangs`
--
ALTER TABLE `pinjam_barangs`
  ADD CONSTRAINT `pinjam_barangs_ibfk_2` FOREIGN KEY (`id_peminjam`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `stok_barangs`
--
ALTER TABLE `stok_barangs`
  ADD CONSTRAINT `stok_barangs_ibfk_1` FOREIGN KEY (`seri_barang`) REFERENCES `barang_masuks` (`seri_barang`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;