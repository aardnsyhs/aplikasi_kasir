-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Feb 2025 pada 08.41
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
  `id` char(36) NOT NULL,
  `penjualan_id` char(36) NOT NULL,
  `produk_id` char(36) NOT NULL,
  `jumlah_produk` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id`, `penjualan_id`, `produk_id`, `jumlah_produk`, `subtotal`, `created_at`, `updated_at`) VALUES
('9e30ee97-c97d-418a-a96f-25d77a82a142', '9e30ee97-c800-45ab-a4b0-bec2e5ead278', 'f868d4ac-f582-4deb-bb80-c34d4a20c3d8', 3, 9000.00, '2025-02-11 20:13:05', '2025-02-11 20:13:05'),
('9e30ee97-cc77-4260-b894-18ee162a8964', '9e30ee97-c800-45ab-a4b0-bec2e5ead278', 'fbf348bb-232f-4c3d-97f1-0aa763d504d7', 2, 19800.00, '2025-02-11 20:13:05', '2025-02-11 20:13:05'),
('9e30ee97-cfa6-4fd9-b629-1e3ea495a8dd', '9e30ee97-c800-45ab-a4b0-bec2e5ead278', 'a436ad5b-b84d-4a20-95cc-39eeba136726', 2, 12000.00, '2025-02-11 20:13:05', '2025-02-11 20:13:05'),
('9e3144e6-f89b-464d-a6bd-0ffcedb0ccef', '9e3144e6-f6fd-4b2d-835c-3383223758b3', '13e0d9aa-29a2-471c-8a5e-6ffcd9500840', 4, 16000.00, '2025-02-12 00:14:25', '2025-02-12 00:14:25'),
('9e3144e6-fb68-4688-979a-184d7f4820ba', '9e3144e6-f6fd-4b2d-835c-3383223758b3', '2a4d2612-090a-42e8-adb7-f0782d96fbec', 3, 15000.00, '2025-02-12 00:14:25', '2025-02-12 00:14:25'),
('9e3144e6-fcbc-457e-8c51-2e6f5f86442a', '9e3144e6-f6fd-4b2d-835c-3383223758b3', '803aff3d-2f17-4ea1-9667-53aeb78335d3', 3, 12000.00, '2025-02-12 00:14:25', '2025-02-12 00:14:25'),
('9e3144e6-fe1a-48f5-94ac-08b345a02316', '9e3144e6-f6fd-4b2d-835c-3383223758b3', '4e40dd76-8731-4f2f-bdde-f62e0327d782', 3, 10500.00, '2025-02-12 00:14:25', '2025-02-12 00:14:25'),
('9e3144e7-0022-4228-81c0-1613640642fe', '9e3144e6-f6fd-4b2d-835c-3383223758b3', 'a2c53bfa-a390-4020-a68c-4d98176d4937', 2, 14000.00, '2025-02-12 00:14:25', '2025-02-12 00:14:25'),
('9e31451b-b0d0-4fb6-9bea-759b89820a1b', '9e31451b-aef1-4fa9-b155-eec3390d0c2f', '71de6b81-0491-4ea7-8a0b-bf9079567f18', 2, 5000.00, '2025-02-12 00:15:00', '2025-02-12 00:15:00'),
('9e31451b-b30d-4405-b72d-176851e24a2c', '9e31451b-aef1-4fa9-b155-eec3390d0c2f', '05e4f383-bc85-4f5f-ac26-233ece1fdd16', 2, 6000.00, '2025-02-12 00:15:00', '2025-02-12 00:15:00'),
('9e31451b-b485-4eab-9403-4a0855783da3', '9e31451b-aef1-4fa9-b155-eec3390d0c2f', '3d511c31-79bc-4f9f-bafa-e5a908be37d0', 2, 5800.00, '2025-02-12 00:15:00', '2025-02-12 00:15:00'),
('9e31451b-b6cb-4ee7-b640-d7363e20988b', '9e31451b-aef1-4fa9-b155-eec3390d0c2f', 'a2c53bfa-a390-4020-a68c-4d98176d4937', 2, 14000.00, '2025-02-12 00:15:00', '2025-02-12 00:15:00'),
('9e31451b-b89d-4020-9710-aa97cba77a07', '9e31451b-aef1-4fa9-b155-eec3390d0c2f', 'fbf348bb-232f-4c3d-97f1-0aa763d504d7', 3, 29700.00, '2025-02-12 00:15:00', '2025-02-12 00:15:00'),
('9e314572-9646-4e53-afe1-4e0319145175', '9e314572-950d-48ca-8dd1-5a87d059b65e', '4e40dd76-8731-4f2f-bdde-f62e0327d782', 4, 14000.00, '2025-02-12 00:15:57', '2025-02-12 00:15:57'),
('9e314572-9978-495a-a245-60e0b1dc9950', '9e314572-950d-48ca-8dd1-5a87d059b65e', '13e0d9aa-29a2-471c-8a5e-6ffcd9500840', 3, 12000.00, '2025-02-12 00:15:57', '2025-02-12 00:15:57'),
('9e314572-9ac1-49c7-aa54-832ecba15130', '9e314572-950d-48ca-8dd1-5a87d059b65e', '3d511c31-79bc-4f9f-bafa-e5a908be37d0', 2, 5800.00, '2025-02-12 00:15:57', '2025-02-12 00:15:57'),
('9e314572-9c0a-421b-a517-547352f0959d', '9e314572-950d-48ca-8dd1-5a87d059b65e', '803aff3d-2f17-4ea1-9667-53aeb78335d3', 3, 12000.00, '2025-02-12 00:15:57', '2025-02-12 00:15:57'),
('9e314572-9d4b-469e-ae2d-4db3b403b4e1', '9e314572-950d-48ca-8dd1-5a87d059b65e', 'a436ad5b-b84d-4a20-95cc-39eeba136726', 2, 12000.00, '2025-02-12 00:15:57', '2025-02-12 00:15:57'),
('9e314572-9ec9-4c79-aedd-13150403c35c', '9e314572-950d-48ca-8dd1-5a87d059b65e', 'fbf348bb-232f-4c3d-97f1-0aa763d504d7', 4, 39600.00, '2025-02-12 00:15:57', '2025-02-12 00:15:57'),
('9e3145ca-5913-4bd4-91ba-c7fec9a57f32', '9e3145ca-57a1-4507-8d3a-fdced81eb439', '803aff3d-2f17-4ea1-9667-53aeb78335d3', 4, 16000.00, '2025-02-12 00:16:54', '2025-02-12 00:16:54'),
('9e3145ca-5b92-4b4e-8a55-e1ae6ac3cb67', '9e3145ca-57a1-4507-8d3a-fdced81eb439', '71de6b81-0491-4ea7-8a0b-bf9079567f18', 3, 7500.00, '2025-02-12 00:16:54', '2025-02-12 00:16:54'),
('9e3145ca-5d82-4bd0-b8f9-010b1f6bf310', '9e3145ca-57a1-4507-8d3a-fdced81eb439', '4e40dd76-8731-4f2f-bdde-f62e0327d782', 3, 10500.00, '2025-02-12 00:16:54', '2025-02-12 00:16:54'),
('9e3145ca-5eed-46db-a130-bd51c5da28b1', '9e3145ca-57a1-4507-8d3a-fdced81eb439', '05e4f383-bc85-4f5f-ac26-233ece1fdd16', 3, 9000.00, '2025-02-12 00:16:54', '2025-02-12 00:16:54'),
('9e3145ca-6142-4ade-a4a4-143c35620604', '9e3145ca-57a1-4507-8d3a-fdced81eb439', '13e0d9aa-29a2-471c-8a5e-6ffcd9500840', 4, 16000.00, '2025-02-12 00:16:54', '2025-02-12 00:16:54'),
('9e3145ca-6316-45a0-a56a-7c3638826835', '9e3145ca-57a1-4507-8d3a-fdced81eb439', 'a2c53bfa-a390-4020-a68c-4d98176d4937', 3, 21000.00, '2025-02-12 00:16:54', '2025-02-12 00:16:54'),
('9e314af9-eacd-46c5-bb55-ba7a32f4ecf8', '9e314af9-e968-4172-81b3-0eb8cff844a9', '13e0d9aa-29a2-471c-8a5e-6ffcd9500840', 2, 8000.00, '2025-02-12 00:31:24', '2025-02-12 00:31:24'),
('9e314af9-ed53-40ad-b858-91d06effdd4c', '9e314af9-e968-4172-81b3-0eb8cff844a9', '2a4d2612-090a-42e8-adb7-f0782d96fbec', 2, 10000.00, '2025-02-12 00:31:24', '2025-02-12 00:31:24');

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
  `id` char(36) NOT NULL,
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
('9e30ee97-c526-4d3c-b24e-58da2a8cf3d5', 'Iyan Jr', 'Jalan Iyan Jr', '089566432321', '2025-02-11 20:13:05', '2025-02-11 20:13:05'),
('9e3144e6-f426-45eb-91c5-13e1ba608a0c', 'Usman', 'Jalan Usman', '089235734273', '2025-02-12 00:14:25', '2025-02-12 00:14:25'),
('9e31451b-ac91-4e96-878b-16dd440c520d', 'Asman', 'Jalan Asman', '089456234356', '2025-02-12 00:15:00', '2025-02-12 00:15:00'),
('9e314572-92cd-4662-86d4-c184bb758746', 'Kisman', 'Jalan Kisman', '089234346234', '2025-02-12 00:15:57', '2025-02-12 00:15:57'),
('9e3145ca-5483-44e5-a99f-2460c485b5ee', 'Tusman', 'Jalan Tusman', '089238434582', '2025-02-12 00:16:54', '2025-02-12 00:16:54'),
('9e314af9-e652-435d-ad43-b7e82e2892d2', 'Perde', 'Jalan Perde', '089523424534', '2025-02-12 00:31:24', '2025-02-12 00:31:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id` char(36) NOT NULL,
  `tanggal_penjualan` date NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  `pelanggan_id` char(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id`, `tanggal_penjualan`, `total_harga`, `pelanggan_id`, `created_at`, `updated_at`) VALUES
('9e30ee97-c800-45ab-a4b0-bec2e5ead278', '2025-01-29', 40800.00, '9e30ee97-c526-4d3c-b24e-58da2a8cf3d5', '2025-02-11 20:13:05', '2025-02-11 20:13:05'),
('9e3144e6-f6fd-4b2d-835c-3383223758b3', '2025-02-03', 67500.00, '9e3144e6-f426-45eb-91c5-13e1ba608a0c', '2025-02-12 00:14:25', '2025-02-12 00:14:25'),
('9e31451b-aef1-4fa9-b155-eec3390d0c2f', '2025-02-04', 60500.00, '9e31451b-ac91-4e96-878b-16dd440c520d', '2025-02-12 00:15:00', '2025-02-12 00:15:00'),
('9e314572-950d-48ca-8dd1-5a87d059b65e', '2025-02-07', 95400.00, '9e314572-92cd-4662-86d4-c184bb758746', '2025-02-12 00:15:57', '2025-02-12 00:15:57'),
('9e3145ca-57a1-4507-8d3a-fdced81eb439', '2025-02-10', 80000.00, '9e3145ca-5483-44e5-a99f-2460c485b5ee', '2025-02-12 00:16:54', '2025-02-12 00:16:54'),
('9e314af9-e968-4172-81b3-0eb8cff844a9', '2025-02-12', 18000.00, '9e314af9-e652-435d-ad43-b7e82e2892d2', '2025-02-12 00:31:24', '2025-02-12 00:31:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id` char(36) NOT NULL,
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
('05e4f383-bc85-4f5f-ac26-233ece1fdd16', 'Good Day', 3000.00, 55, 'produk/4i0YKXeBqsNAbDbNOkC6NeY9IJkkURFm8fmiT7zU.jpg', '2025-02-11 18:26:40', '2025-02-12 00:16:54'),
('13e0d9aa-29a2-471c-8a5e-6ffcd9500840', 'Aqua', 4000.00, 57, 'produk/2eXRk9y6eUVTWMNaRxBt4QoqbgXCmGKawknhovG0.jpg', '2025-02-11 18:26:40', '2025-02-12 00:31:24'),
('2a4d2612-090a-42e8-adb7-f0782d96fbec', 'Tango', 5000.00, 25, 'produk/TigLahhHPv7aIPw7FLj6p3FxS0ZRM2Oex6KMW5Gu.jpg', '2025-02-11 18:26:40', '2025-02-12 00:31:24'),
('3d511c31-79bc-4f9f-bafa-e5a908be37d0', 'Indomie', 2900.00, 100, 'produk/nMwSbSLp4UgbDA0qNjOwTmiO3LHCpfs4cmMJDFOk.jpg', '2025-02-11 18:26:40', '2025-02-12 00:24:14'),
('4e40dd76-8731-4f2f-bdde-f62e0327d782', 'Fruit Tea', 3500.00, 35, 'produk/whbhuA0nje6HFdskQji5avZuh9TGKhjy7FuAhmX5.jpg', '2025-02-11 18:26:40', '2025-02-12 00:16:54'),
('71de6b81-0491-4ea7-8a0b-bf9079567f18', 'Beng Beng', 2500.00, 75, 'produk/o4QN94Rox5ZgKQqC79mKrym9nRPuPPYfeezZd9A9.jpg', '2025-02-11 18:26:40', '2025-02-12 00:16:54'),
('803aff3d-2f17-4ea1-9667-53aeb78335d3', 'Nabati', 4000.00, 30, 'produk/WROurdJNNlCprXSzGN7p89H82t4d1F8QoDPa0cZR.jpg', '2025-02-11 18:26:40', '2025-02-12 00:16:54'),
('a2c53bfa-a390-4020-a68c-4d98176d4937', 'Nutriboost', 7000.00, 13, 'produk/fUV0NOeOJbjoIjWYNznu4gBdGIKv1e0gsygdRvVD.jpg', '2025-02-11 18:26:40', '2025-02-12 00:16:54'),
('a436ad5b-b84d-4a20-95cc-39eeba136726', 'Gery Malkist', 6000.00, 21, 'produk/2t0EnppR1k5U7iThHYugkbx7ovwaVJYFUcRknAQI.jpg', '2025-02-11 18:26:40', '2025-02-12 00:15:57'),
('f868d4ac-f582-4deb-bb80-c34d4a20c3d8', 'Teh Pucuk', 3000.00, 47, 'produk/9UquCu9jc05TQHz6f2YR0nAFRVUWnbGTyemZ49mA.jpg', '2025-02-11 18:26:40', '2025-02-12 00:11:52'),
('fbf348bb-232f-4c3d-97f1-0aa763d504d7', 'Chitato', 9900.00, 26, 'produk/Xra9oieb7YnGrRXH3yU02JFXnioNh9pBtY9DdSai.jpg', '2025-02-11 18:26:40', '2025-02-12 00:15:57');

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
('3B37K7Aq9Zh1LSFS4lBt2Eph8Pjv7VcW9IKBziOH', '9e30c889-9ed7-4f0a-a5e1-4f926b2a1cf8', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZXpRZVZneHFvbnVnRjhIMzRQMmRhaGNobUJvRG5EWlJZdGZxRThuQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7czozNjoiOWUzMGM4ODktOWVkNy00ZjBhLWE1ZTEtNGY5MjZiMmExY2Y4Ijt9', 1739346000),
('QJ6YRcZN1AkFTa021n50fmzIQw2BYhokt83T9naT', '9e30d27e-7a16-4026-bea6-65d2271efda8', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoibnlFM0ZZRmU2aTZZVVRPOWNWeGppcVl4a3BvRGVsUExLd0N3MklhNiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0ODoiaHR0cDovL2xvY2FsaG9zdC9hcGxpa2FzaV9rYXNpci9wdWJsaWMvcGVtYmVsaWFuIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly9sb2NhbGhvc3QvYXBsaWthc2lfa2FzaXIvcHVibGljL3Byb2R1ayI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtzOjM2OiI5ZTMwZDI3ZS03YTE2LTQwMjYtYmVhNi02NWQyMjcxZWZkYTgiO30=', 1739345505),
('siJuyZ7RS1kFBiMzYXeRaBzScKjts1IrqWpTsgJp', '9e30c889-9ed7-4f0a-a5e1-4f926b2a1cf8', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiREtPYnVkSU1vTTFCcjQ2cjczeE5jaUgzR1NLcWZpWW84T2x5QUdSWiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly9sb2NhbGhvc3QvYXBsaWthc2lfa2FzaXIvcHVibGljL2Rhc2hib2FyZCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtzOjM2OiI5ZTMwYzg4OS05ZWQ3LTRmMGEtYTVlMS00ZjkyNmIyYTFjZjgiO30=', 1739346035);

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
('9e30c889-9ed7-4f0a-a5e1-4f926b2a1cf8', 'admin', 'admin@example.com', '$2y$12$OAZPPUqKdyQIG4o6qT9aQun4Oc2tTJrdGR2DbR9/2pU/cY/Src2Wi', 'Admin', 'admin', NULL, NULL, '2025-02-11 18:26:40', '2025-02-12 00:29:39'),
('9e30d27e-7a16-4026-bea6-65d2271efda8', 'iyan', 'iyan@example.com', '$2y$12$tpqS9sqCz4lV493LAnyIr.7xe4Bn4aiFx./J1kplJCiUtVPDFaqMG', 'Ardiansyah Sulistyo', 'petugas', NULL, NULL, '2025-02-11 18:54:31', '2025-02-11 18:54:31');

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
