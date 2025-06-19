-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Jun 2025 pada 15.00
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rbgallerydatabase`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `Kode` int(11) NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `Ukuran_S` int(3) NOT NULL DEFAULT 6,
  `Ukuran_M` int(3) NOT NULL DEFAULT 6,
  `Ukuran_L` int(3) NOT NULL DEFAULT 6,
  `Ukuran_XL` int(3) NOT NULL DEFAULT 6,
  `Gambar` varchar(100) NOT NULL,
  `Harga` int(9) NOT NULL,
  `Deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`Kode`, `Nama`, `Ukuran_S`, `Ukuran_M`, `Ukuran_L`, `Ukuran_XL`, `Gambar`, `Harga`, `Deskripsi`) VALUES
(1, 'Batik 1', 6, 24, 6, 6, 'Batik 1.jpg', 50000, 'Pakaian Batik'),
(3, ' Batik 2', 6, 24, 6, 6, 'Batik 2.jpg', 70000, 'Pakaian Batik Bagus gaess'),
(4, 'Batik 3', 6, 24, 6, 6, 'Batik 3.jpg', 50000, 'Pakaian Batik'),
(5, 'Batik 4', 6, 24, 6, 6, 'Batik 4.jpg', 50000, 'Pakaian Batik'),
(6, 'Batik 5', 6, 24, 6, 6, 'Batik 5.jpg', 50000, 'Pakaian Batik'),
(7, 'Batik 6', 6, 24, 6, 6, 'Batik 6.jpg', 70000, 'Pakaian Batik'),
(10, ' Batik 7', 6, 24, 6, 6, 'Batik 7.jpg', 80000, 'Batik 7 bla bla'),
(13, 'Batik 8', 6, 24, 6, 6, 'Batik 8.jpg', 80000, 'Batik nomor 8'),
(15, 'Batik 9', 6, 24, 6, 6, '68110ef9ef836.jpg', 99000, 'asdfasdf'),
(17, ' USM jaya', 6, 0, 6, 6, '68510a7deea86.png', 5, '5'),
(36, ' Baggy pants', 0, 0, 1, 0, '6851a6da43401.jpeg', 400000, 'Celana gombrong skena');

-- --------------------------------------------------------

--
-- Struktur dari tabel `item_keranjang`
--

CREATE TABLE `item_keranjang` (
  `id` int(11) NOT NULL,
  `keranjang_id` int(4) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `ukuran` enum('S','M','L','XL') NOT NULL,
  `jumlah` int(11) NOT NULL DEFAULT 1,
  `harga` decimal(10,0) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `item_keranjang`
--

INSERT INTO `item_keranjang` (`id`, `keranjang_id`, `barang_id`, `ukuran`, `jumlah`, `harga`, `created_at`, `updated_at`) VALUES
(1, 18, 3, 'XL', 5, 70000, '2025-06-15 17:59:15', '2025-06-16 17:12:02'),
(2, 18, 3, 'M', 1, 70000, '2025-06-15 17:59:45', '2025-06-15 17:59:45'),
(15, 22, 3, 'M', 3, 70000, '2025-06-17 05:48:09', '2025-06-17 06:46:00'),
(17, 22, 3, 'L', 4, 70000, '2025-06-17 06:42:39', '2025-06-17 06:49:06'),
(18, 23, 5, 'L', 1, 50000, '2025-06-17 08:33:18', '2025-06-17 08:33:18'),
(19, 23, 3, 'XL', 1, 70000, '2025-06-17 17:18:00', '2025-06-17 17:18:00'),
(20, 24, 4, 'M', 1, 50000, '2025-06-17 17:30:58', '2025-06-17 17:30:58'),
(21, 24, 5, 'M', 1, 50000, '2025-06-17 17:31:11', '2025-06-17 17:31:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(11) NOT NULL,
  `user_id` int(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `keranjang`
--

INSERT INTO `keranjang` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(18, 1, '2025-06-15 17:51:07', '2025-06-15 17:51:07'),
(22, 6, '2025-06-17 05:48:09', '2025-06-17 05:48:09'),
(23, 7, '2025-06-17 08:33:18', '2025-06-17 08:33:18'),
(24, 8, '2025-06-17 17:30:58', '2025-06-17 17:30:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(4) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(500) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `email`, `password`, `role`) VALUES
(1, 'Admin', 'superadmin123@admin', '$2y$10$JFTVY1SaCA6GL7ONh1Kt4efYzlQopizpd8UCt7DThkXAxan8rF2Ti', 'admin'),
(6, 'Test User 1', 'testuser1@admin', '$2y$10$WVeA8SOCR2RDetG2c0jawOZtWAcsr6tmyE8XaKEnxbptOmaFky7JC', 'user'),
(7, 'Test User  2', 'testuser2@admin', '$2y$10$xgjPQL2TQiY/VKQRNH9wNu2G4vH6xwBeLs0Y8tye03axfOWo2E.TK', 'user'),
(8, 'Test User  3', 'testuser3@admin', '$2y$10$JogwqF.AiZ8k4uOOaassDetTjBrtN67RMN1W4wSpXMN.Ikn6D2Mg.', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`Kode`);

--
-- Indeks untuk tabel `item_keranjang`
--
ALTER TABLE `item_keranjang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `item_keranjang_unique` (`keranjang_id`,`barang_id`,`ukuran`),
  ADD KEY `barang_id` (`barang_id`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `Kode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `item_keranjang`
--
ALTER TABLE `item_keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `item_keranjang`
--
ALTER TABLE `item_keranjang`
  ADD CONSTRAINT `item_keranjang_ibfk_1` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`Kode`) ON DELETE CASCADE,
  ADD CONSTRAINT `item_keranjang_ibfk_2` FOREIGN KEY (`keranjang_id`) REFERENCES `keranjang` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
