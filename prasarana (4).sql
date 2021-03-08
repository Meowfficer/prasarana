-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Mar 2021 pada 20.52
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
(1, 'LPT27', 'HP - bs0xx', 1, 'Elektronik', 'Laptop', '2021-03-08 19:01:22', '2021-03-08 19:01:22'),
(2, 'PRY57', 'In Focus', 5, 'Elektronik', 'Proyektor', '2021-03-08 19:46:53', '2021-03-08 19:46:53');

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
  `seri_barang` varchar(255) NOT NULL,
  `jumlah_masuk` int(11) NOT NULL,
  `id_supplier` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang_masuks`
--

INSERT INTO `barang_masuks` (`id`, `kode_barang`, `seri_barang`, `jumlah_masuk`, `id_supplier`, `created_at`, `updated_at`) VALUES
(56, 'LPT27', 'LPT27-28', 1, '5', '2021-03-08 18:49:24', '2021-03-08 18:49:24'),
(57, 'PRY57', 'PRY57-19', 1, '9', '2021-03-08 18:54:03', '2021-03-08 18:54:03'),
(58, 'PRY57', 'PRY57-37', 1, '9', '2021-03-08 18:54:03', '2021-03-08 18:54:03'),
(59, 'PRY57', 'PRY57-14', 1, '9', '2021-03-08 18:54:04', '2021-03-08 18:54:04'),
(60, 'PRY57', 'PRY57-28', 1, '9', '2021-03-08 18:54:04', '2021-03-08 18:54:04'),
(61, 'PRY57', 'PRY57-80', 1, '9', '2021-03-08 18:54:04', '2021-03-08 18:54:04');

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
  `id_peminjam` int(11) NOT NULL,
  `kode_barang` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `seri_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(13, 1, 'LPT27', 'LPT27-28', 1, 5, 'Gaming', '2021-03-08 18:50:16', '2021-03-08 18:50:16'),
(14, 1, 'PRY57', 'PRY57-19', 1, 4, 'Nobar', '2021-03-08 18:55:21', '2021-03-08 18:55:21'),
(15, 1, 'PRY57', 'PRY57-37', 1, 5, 'nobar', '2021-03-08 18:55:40', '2021-03-08 18:55:40'),
(16, 1, 'LPT27', 'LPT27-28', 1, 5, 'Gaming', '2021-03-08 18:57:06', '2021-03-08 18:57:06'),
(17, 2, 'PRY57', 'PRY57-14', 1, 5, 'Nobar', '2021-03-08 18:59:21', '2021-03-08 18:59:21'),
(18, 1, 'PRY57', 'PRY57-19', 1, 5, 'Nobar', '2021-03-08 19:15:35', '2021-03-08 19:15:35'),
(19, 2, 'PRY57', 'PRY57-19', 1, 4, 'Nobar', '2021-03-08 19:19:52', '2021-03-08 19:19:52'),
(20, 2, 'PRY57', 'PRY57-19', 1, 5, 'Nobar Skuy', '2021-03-08 19:26:16', '2021-03-08 19:26:16'),
(21, 2, 'PRY57', 'PRY57-19', 1, 5, 'Nobar', '2021-03-08 19:36:42', '2021-03-08 19:36:42');

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
(33, 'LPT27', 'LPT27-28', 1, '2021-03-08 18:49:25', '2021-03-08 18:49:25'),
(34, 'PRY57', 'PRY57-19', 1, '2021-03-08 18:54:03', '2021-03-08 18:54:03'),
(35, 'PRY57', 'PRY57-37', 1, '2021-03-08 18:54:03', '2021-03-08 18:54:03'),
(36, 'PRY57', 'PRY57-14', 1, '2021-03-08 18:54:04', '2021-03-08 18:54:04'),
(37, 'PRY57', 'PRY57-28', 1, '2021-03-08 18:54:04', '2021-03-08 18:54:04'),
(38, 'PRY57', 'PRY57-80', 1, '2021-03-08 18:54:04', '2021-03-08 18:54:04');

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
(1, 'Alandra', 'admin', NULL, '$2y$10$q0zuurZztwzjR.woexOUXe9BaxwLGGUsqQPefySQYQGToc8uN5/tS', '1', NULL, '2020-12-02 09:49:58', '2021-02-26 18:06:23'),
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
-- Indeks untuk tabel `stok_barangs`
--
ALTER TABLE `stok_barangs`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `barang_keluars`
--
ALTER TABLE `barang_keluars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `barang_masuks`
--
ALTER TABLE `barang_masuks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `stok_barangs`
--
ALTER TABLE `stok_barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

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
