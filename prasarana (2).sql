-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Feb 2021 pada 02.27
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
(1, 'LPT27', 'HP - bs0xx', 9, 'Elektronik', 'Laptop', '2021-02-23 19:15:57', '2021-02-23 19:15:57');

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

--
-- Dumping data untuk tabel `barang_keluars`
--

INSERT INTO `barang_keluars` (`id`, `kode_barang`, `id_peminjam`, `jml_barang`, `deskripsi`, `created_at`, `updated_at`) VALUES
(5, 'LPT27', 1, 1, 'Rusak', '2021-02-23 19:15:38', '2021-02-23 19:15:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_masuks`
--

CREATE TABLE `barang_masuks` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `jumlah_masuk` int(11) NOT NULL,
  `id_supplier` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang_masuks`
--

INSERT INTO `barang_masuks` (`id`, `kode_barang`, `jumlah_masuk`, `id_supplier`, `created_at`, `updated_at`) VALUES
(3, 'LPT27', 12, '9', '2021-02-21 09:12:39', '2021-02-21 09:12:39');

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
-- Struktur dari tabel `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `kode_barang_log` varchar(255) NOT NULL,
  `jumlah_log` int(11) DEFAULT NULL,
  `keterangan_log` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `logs`
--

INSERT INTO `logs` (`id`, `kode_barang_log`, `jumlah_log`, `keterangan_log`, `created_at`, `updated_at`) VALUES
(5, 'MO5', NULL, 'Penambahan Data Barang', '2020-12-07 09:52:32', '2020-12-07 09:52:32'),
(6, 'TE87', NULL, 'Penambahan Data Barang', '2020-12-07 09:52:51', '2020-12-07 09:52:51'),
(7, 'PR92', NULL, 'Penambahan Data Barang', '2020-12-07 09:53:13', '2020-12-07 09:53:13'),
(8, 'TE87', 6, 'Barang Masuk', '2020-12-07 10:12:56', '2020-12-07 10:12:56'),
(9, 'MO5', 5, 'Barang Masuk', '2020-12-07 10:26:18', '2020-12-07 10:26:18'),
(10, 'TE87', 10, 'Barang Masuk', '2020-12-07 10:27:35', '2020-12-07 10:27:35'),
(11, 'MO5', 10, 'Barang Masuk', '2020-12-07 10:46:59', '2020-12-07 10:46:59'),
(12, 'SP23', NULL, 'Penambahan Data Barang', '2020-12-09 20:42:24', '2020-12-09 20:42:24'),
(13, 'MO5', 5, 'Barang Masuk', '2020-12-09 20:50:46', '2020-12-09 20:50:46'),
(14, 'MO5', 10, 'Barang Masuk', '2020-12-09 20:51:30', '2020-12-09 20:51:30'),
(15, 'MO5', 10, 'Edit Barang Masuk', '2020-12-09 21:57:20', '2020-12-09 21:57:20'),
(16, 'MO5', 2, 'Edit Barang Masuk', '2020-12-09 21:58:24', '2020-12-09 21:58:24'),
(17, 'MO5', 10, 'Hapus Barang Masuk', '2020-12-10 09:04:13', '2020-12-10 09:04:13'),
(18, 'PR92', 10, 'Barang Masuk', '2020-12-10 09:12:23', '2020-12-10 09:12:23'),
(19, 'PR92', 10, 'Hapus Barang Masuk', '2020-12-10 16:13:56', '2020-12-10 16:13:56'),
(20, 'KO65', NULL, 'Penambahan Data Barang', '2020-12-12 03:42:24', '2020-12-12 03:42:24'),
(21, 'KO65', 5, 'Barang Masuk', '2020-12-12 03:43:23', '2020-12-12 03:43:23'),
(22, 'KO65', 3, 'Edit Barang Masuk', '2020-12-12 03:44:25', '2020-12-12 03:44:25'),
(23, 'KO65', 3, 'Hapus Barang Masuk', '2020-12-12 03:44:52', '2020-12-12 03:44:52'),
(24, 'MO5', 4, 'Edit Barang Masuk', '2021-01-13 10:17:02', '2021-01-13 10:17:02'),
(25, 'MO5', 4, 'Hapus Barang Masuk', '2021-01-17 10:09:43', '2021-01-17 10:09:43'),
(26, 'PR92', 10, 'Barang Masuk', '2021-01-17 13:29:42', '2021-01-17 13:29:42'),
(27, 'PR92', 10, 'Edit Barang Masuk', '2021-01-17 13:42:23', '2021-01-17 13:42:23'),
(28, 'MO5', 10, 'Barang Masuk', '2021-01-17 16:27:27', '2021-01-17 16:27:27'),
(29, 'TE87', 10, 'Barang Masuk', '2021-01-19 07:13:14', '2021-01-19 07:13:14'),
(30, 'MO36', NULL, 'Penambahan Data Barang', '2021-02-03 05:57:24', '2021-02-03 05:57:24'),
(31, 'MO36', 10, 'Barang Masuk', '2021-02-03 06:01:31', '2021-02-03 06:01:31'),
(32, 'Pry54', NULL, 'Penambahan Data Barang', '2021-02-07 07:26:46', '2021-02-07 07:26:46'),
(33, 'Pry54', 20, 'Barang Masuk', '2021-02-07 07:27:25', '2021-02-07 07:27:25'),
(34, 'TRM26', NULL, 'Penambahan Data Barang', '2021-02-07 07:29:37', '2021-02-07 07:29:37'),
(35, 'Pry54', NULL, 'Hapus Data Barang', '2021-02-07 07:29:52', '2021-02-07 07:29:52'),
(36, 'PRY89', NULL, 'Penambahan Data Barang', '2021-02-07 08:39:39', '2021-02-07 08:39:39'),
(37, 'PRY80', 20, 'Barang Masuk', '2021-02-12 14:07:23', '2021-02-12 14:07:23'),
(38, 'PRY80', 20, 'Hapus Barang Masuk', '2021-02-12 14:10:21', '2021-02-12 14:10:21'),
(39, 'PRY80', 12, 'Barang Masuk', '2021-02-17 05:12:11', '2021-02-17 05:12:11'),
(40, 'PRY81', NULL, 'Penambahan Data Barang', '2021-02-17 06:41:43', '2021-02-17 06:41:43'),
(41, 'PRY81', 12, 'Barang Masuk', '2021-02-17 06:50:47', '2021-02-17 06:50:47'),
(42, 'PRY81', NULL, 'Penambahan Data Barang', '2021-02-17 06:58:08', '2021-02-17 06:58:08'),
(43, 'PRY81', 22, 'Barang Masuk', '2021-02-17 06:59:12', '2021-02-17 06:59:12'),
(44, 'PRY12', NULL, 'Penambahan Data Barang', '2021-02-17 07:12:33', '2021-02-17 07:12:33'),
(45, 'PRY12', 22, 'Barang Masuk', '2021-02-17 07:13:33', '2021-02-17 07:13:33'),
(46, 'PRY8', NULL, 'Penambahan Data Barang', '2021-02-17 07:43:34', '2021-02-17 07:43:34'),
(47, 'PRY8', 12, 'Barang Masuk', '2021-02-17 07:43:56', '2021-02-17 07:43:56'),
(48, 'LPT52', NULL, 'Penambahan Data Barang', '2021-02-18 15:33:41', '2021-02-18 15:33:41'),
(49, 'HND37', NULL, 'Penambahan Data Barang', '2021-02-18 15:34:04', '2021-02-18 15:34:04'),
(50, 'LPT52', 14, 'Barang Masuk', '2021-02-18 15:34:28', '2021-02-18 15:34:28'),
(51, 'HND37', 4, 'Barang Masuk', '2021-02-18 15:34:41', '2021-02-18 15:34:41');

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
(6, '2021_02_23_220418_create_barang_keluars_table', 3);

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
  `id_peminjam` int(11) NOT NULL,
  `kode_barang` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `jml_barang` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1 = Menunggu Persetujuan Meminjam, 2 = Dipinjam, 3 = Menunggu Persetujuan Mengembalikan, 4 = Dikembalikan, 5 = Ditolak',
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pinjam_barangs`
--

INSERT INTO `pinjam_barangs` (`id`, `id_peminjam`, `kode_barang`, `jml_barang`, `status`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 2, 'LPT27', 2, 5, 'Presentasi', '2021-02-21 09:13:46', '2021-02-21 09:13:46'),
(2, 1, 'LPT27', 2, 4, 'Presentasi', '2021-02-23 17:19:21', '2021-02-23 17:19:21'),
(3, 1, 'LPT27', 3, 4, 'Presen', '2021-02-23 17:44:02', '2021-02-23 17:44:02'),
(4, 1, 'LPT27', 2, 4, 'Presentasi', '2021-02-23 19:13:04', '2021-02-23 19:13:04'),
(5, 1, 'LPT27', 1, 4, 'Presentasi', '2021-02-23 19:14:59', '2021-02-23 19:14:59');

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
(5, 'Otong', 'Jl. Otong 69', '086969696969', 'Kota Otong', '2020-12-02 15:32:22', '2020-12-02 08:32:22'),
(8, '2', '2', '2', '2', '2020-12-02 08:29:36', '2020-12-02 08:29:36'),
(9, 'Pak Pol', 'Jl. Gocap Otong', '08969696', 'Kota Pak Pol', '2021-01-17 13:42:00', '2021-01-17 13:42:00');

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
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Alandra', 'admin', NULL, '$2y$10$33fmz5ry7mYg6CpeETlDl.zjhRadLcjPEYUVY13PfrXSJ9s/MtoMm', '1', NULL, '2020-12-02 09:49:58', '2020-12-02 09:49:58'),
(2, 'User', 'user', NULL, '$2y$10$T5svT1rDTmmNx3ZAZqATduygtjQuhBd44qgO81cX2Eg4XiE1kMpNq', '2', NULL, '2020-12-02 21:17:24', '2020-12-02 21:17:24');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barangs`
--
ALTER TABLE `barangs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `barang_keluars`
--
ALTER TABLE `barang_keluars`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `barang_masuks`
--
ALTER TABLE `barang_masuks`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `logs`
--
ALTER TABLE `logs`
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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `barang_keluars`
--
ALTER TABLE `barang_keluars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `barang_masuks`
--
ALTER TABLE `barang_masuks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pinjam_barangs`
--
ALTER TABLE `pinjam_barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
