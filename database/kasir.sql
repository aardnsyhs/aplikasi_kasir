-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Jan 2025 pada 05.27
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `penjualan_id` bigint(20) UNSIGNED NOT NULL,
  `produk_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah_produk` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id`, `penjualan_id`, `produk_id`, `jumlah_produk`, `subtotal`, `created_at`, `updated_at`) VALUES
(16, 7, 1, 1, 2500000.00, '2025-01-29 18:23:22', '2025-01-29 18:23:22'),
(17, 7, 2, 4, 2000000.00, '2025-01-29 18:23:22', '2025-01-29 18:23:22'),
(18, 8, 3, 4, 10000.00, '2025-01-29 18:23:48', '2025-01-29 18:23:48'),
(19, 8, 4, 2, 4000.00, '2025-01-29 18:23:48', '2025-01-29 18:23:48'),
(20, 8, 6, 2, 5000.00, '2025-01-29 18:23:48', '2025-01-29 18:23:48'),
(21, 9, 7, 1, 70000.00, '2025-01-29 18:27:48', '2025-01-29 18:27:48'),
(22, 9, 8, 1, 150000.00, '2025-01-29 18:27:48', '2025-01-29 18:27:48'),
(23, 10, 11, 5, 17500.00, '2025-01-29 18:29:33', '2025-01-29 18:29:33'),
(24, 10, 5, 2, 6000.00, '2025-01-29 18:29:33', '2025-01-29 18:29:33'),
(25, 11, 7, 2, 140000.00, '2025-01-29 18:57:25', '2025-01-29 18:57:25'),
(27, 13, 5, 5, 15000.00, '2025-01-29 18:59:58', '2025-01-29 18:59:58'),
(29, 15, 9, 2, 1500000.00, '2025-01-29 21:12:35', '2025-01-29 21:12:35'),
(30, 15, 10, 1, 700000.00, '2025-01-29 21:12:35', '2025-01-29 21:12:35'),
(31, 15, 3, 4, 10000.00, '2025-01-29 21:12:35', '2025-01-29 21:12:35'),
(32, 16, 9, 2, 1500000.00, '2025-01-29 21:12:59', '2025-01-29 21:12:59'),
(33, 16, 10, 1, 700000.00, '2025-01-29 21:12:59', '2025-01-29 21:12:59'),
(34, 16, 3, 4, 10000.00, '2025-01-29 21:12:59', '2025-01-29 21:12:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_01_15_065117_create_produk_table', 1),
(5, '2025_01_22_031422_create_pelanggan_table', 1),
(6, '2025_01_22_041423_create_penjualan_table', 1),
(7, '2025_01_22_042936_create_detail_penjualan_table', 1),
(8, '2025_01_26_093931_add_image_to_produk_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_pelanggan` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `nomor_telepon` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama_pelanggan`, `alamat`, `nomor_telepon`, `created_at`, `updated_at`) VALUES
(7, 'Ardiansyah Sulistyo', 'Jalan Cihanjuang, Gang Ledeng', '08952436321', '2025-01-29 18:23:22', '2025-01-29 18:23:22'),
(8, 'Iyan Jr', 'Jalan Kahuripan', '08952344631', '2025-01-29 18:23:48', '2025-01-29 18:23:48'),
(9, 'Ahmad', 'Jalan KH Junjunan', '0895346352', '2025-01-29 18:27:48', '2025-01-29 18:27:48'),
(10, 'Ujang', 'Jalan Ujang Ganteng', '0879573452', '2025-01-29 18:29:33', '2025-01-29 18:29:33'),
(11, 'Adit', 'adit', '9036783523', '2025-01-29 18:57:25', '2025-01-29 18:57:25'),
(13, 'Mahes jELEK', 'JElek', '05214896566', '2025-01-29 18:59:58', '2025-01-29 18:59:58'),
(15, 'Ordal', 'Jalan Ordal', '08976456772', '2025-01-29 21:12:35', '2025-01-29 21:12:35'),
(16, 'Ordal', 'Jalan Ordal', '08976456772', '2025-01-29 21:12:59', '2025-01-29 21:12:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal_penjualan` date NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  `pelanggan_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id`, `tanggal_penjualan`, `total_harga`, `pelanggan_id`, `created_at`, `updated_at`) VALUES
(7, '2025-01-28', 4500000.00, 7, '2025-01-29 18:23:22', '2025-01-29 18:23:22'),
(8, '2025-01-29', 19000.00, 8, '2025-01-29 18:23:48', '2025-01-29 18:23:48'),
(9, '2025-01-30', 220000.00, 9, '2025-01-29 18:27:48', '2025-01-29 18:27:48'),
(10, '2025-01-27', 23500.00, 10, '2025-01-29 18:29:33', '2025-01-29 18:29:33'),
(11, '2025-01-30', 140000.00, 11, '2025-01-29 18:57:25', '2025-01-29 18:57:25'),
(13, '2025-01-30', 15000.00, 13, '2025-01-29 18:59:58', '2025-01-29 18:59:58'),
(15, '2025-01-30', 2210000.00, 15, '2025-01-29 21:12:35', '2025-01-29 21:12:35'),
(16, '2025-01-30', 2210000.00, 16, '2025-01-29 21:12:59', '2025-01-29 21:12:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `stok` int(11) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id`, `nama_produk`, `harga`, `stok`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'Meja', 2500000.00, 96, 'produk/sD5MIK58lCnyUMIgvpe2mUoEZqvsWpB7nc3Azel4.jpg', '2025-01-29 17:58:57', '2025-01-29 19:36:20'),
(2, 'Kursi', 500000.00, 234, 'produk/X1DaEci8ZtAuHMUCudpcF5nUzVaPQ5vSgM2Co2pA.jpg', '2025-01-29 17:59:55', '2025-01-29 18:23:22'),
(3, 'Pensil', 2500.00, 396, 'produk/p63rE6L4cGsEp0ep94uh2cTfMXHLDdVbAQguy67D.jpg', '2025-01-29 18:00:16', '2025-01-29 21:12:59'),
(4, 'Penghapus', 2000.00, 342, 'produk/idMoGg2xooLuWSmZb27B7zj5uBns5wl2KUYuEYlH.jpg', '2025-01-29 18:00:37', '2025-01-29 18:23:48'),
(5, 'Tipe-X', 3000.00, 238, 'produk/BCNlLEYzxFxoRTIEpSJ4NBr2Jn8vkVYYXAtm6x9J.jpg', '2025-01-29 18:01:46', '2025-01-29 19:00:09'),
(6, 'Penggaris', 2500.00, 392, 'produk/G6wSsPfa9gt5HW6cgwqAYvmdZ8uqwKKtnDoFwG1E.jpg', '2025-01-29 18:02:45', '2025-01-29 18:23:48'),
(7, 'Keyboard', 70000.00, 145, 'produk/D8Td3iVIwaTOU7teBgd5c4DiRcrBjtC8Cf4Ci3az.jpg', '2025-01-29 18:05:20', '2025-01-29 18:57:32'),
(8, 'Mouse', 150000.00, 299, 'produk/52z3q8FxmFBURQszGO6tr1yozrgYL2Hp1ZPtSuqf.jpg', '2025-01-29 18:06:07', '2025-01-29 18:27:48'),
(9, 'Headset', 750000.00, 196, 'produk/NvWr9igeqwisSZzwQx2efo7ZcrReck7afwlb0R7J.jpg', '2025-01-29 18:06:59', '2025-01-29 21:12:59'),
(10, 'Karpet Permadani', 700000.00, 98, 'produk/Jts4jD6Zd6LhLyIGKPS4xs34x22QjdqOyzJT7ZrY.jpg', '2025-01-29 18:08:44', '2025-01-29 21:12:59'),
(11, 'Pulpen', 3500.00, 225, 'produk/TIkrkF9Tk7kGvarofJszfw03HTzRfanupWhLHff5.jpg', '2025-01-29 18:25:54', '2025-01-29 18:29:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` char(36) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('beUQAPPgH4H3ayAGBIbFFKcZ6wEixzBDmgn1rg2i', '9e169708-16ef-4a22-b48b-09a108f348fc', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNWgyMDkxcnBneHNmWWVibEJ6eUo4QUxZckdQTGRFaTVUaE1xQ3BIYiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3BlbWJlbGlhbiI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMwOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvY2hlY2tvdXQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7czozNjoiOWUxNjk3MDgtMTZlZi00YTIyLWI0OGItMDlhMTA4ZjM0OGZjIjt9', 1738210379),
('ZuOn6a8MGLYD9u7lnttP0lmODHGT6J34SH2ky49b', '9e16968d-8d27-4ea8-a8d1-9050d8c7242f', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiU1p1SEl3aWQwb0QyT3hTeGxKZFQyZWxxNkQxNjVrRk5NRHE4SmMycyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO3M6MzY6IjllMTY5NjhkLThkMjctNGVhOC1hOGQxLTkwNTBkOGM3MjQyZiI7fQ==', 1738210379);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `nama_lengkap`, `role`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
('9e16968d-8d27-4ea8-a8d1-9050d8c7242f', 'admin', 'admin@example.com', '$2y$12$yYHN92UUurPpVKswrn3O7.lpLFtyNxgIc5pgcKA4ExriHJsUr.kqa', 'Admin', 'admin', NULL, NULL, '2025-01-29 17:55:23', '2025-01-29 17:55:23'),
('9e169708-16ef-4a22-b48b-09a108f348fc', 'petugas', 'petugas@example.com', '$2y$12$LThwELsWu1CivQiy0fa4KeIaZA5Df5qBM6vcbS6xq964xfR0eUBw.', 'Petugas', 'petugas', NULL, NULL, '2025-01-29 17:56:43', '2025-01-29 17:56:43'),
('9e16a551-f04f-4a04-a150-19c9c05ad004', 'petugas2', 'petugas2@example.com', '$2y$12$RMiGhE15VqrkwcsRZVhLHe8pry3pHbv43E/OBGrUTRVF8P9gFS0xS', 'Petugas 2', 'petugas', NULL, NULL, '2025-01-29 18:36:40', '2025-01-29 18:36:40'),
('9e16a56c-fcef-405c-8a98-9492c94f44f5', 'petugas3', 'petugas3@example.com', '$2y$12$LfPY1Z54CXz2r4Ta4V2JeuX52PKh2OIN77H1Uq9mY.bLjo5hgFxsC', 'Petugas 3', 'petugas', NULL, NULL, '2025-01-29 18:36:58', '2025-01-29 18:36:58'),
('9e16a589-b565-4c08-85b9-37050b380cd6', 'petugas4', 'petugas4@example.com', '$2y$12$IZbeZ68AGllki6Xz9vtyW.0D97kPYVMy2MiHp.kjPLbg7bN/jtDfO', 'Petugas 4', 'petugas', NULL, NULL, '2025-01-29 18:37:17', '2025-01-29 18:37:17'),
('9e16a5a4-4c60-4816-bbd4-b6939ae4e2bd', 'petugas5', 'petugas5@example.com', '$2y$12$EeiNxsn/StXb0K8/j2eVHuimH1DhhsEnTxyLqDh6V6TFSJMoqKu.a', 'Petugas 5', 'petugas', NULL, NULL, '2025-01-29 18:37:34', '2025-01-29 18:37:34');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_penjualan_penjualan_id_foreign` (`penjualan_id`),
  ADD KEY `detail_penjualan_produk_id_foreign` (`produk_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penjualan_pelanggan_id_foreign` (`pelanggan_id`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD CONSTRAINT `detail_penjualan_penjualan_id_foreign` FOREIGN KEY (`penjualan_id`) REFERENCES `penjualan` (`id`),
  ADD CONSTRAINT `detail_penjualan_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`);

--
-- Ketidakleluasaan untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_pelanggan_id_foreign` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
