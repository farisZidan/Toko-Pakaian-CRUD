-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Apr 2025 pada 19.47
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
-- Database: `phpdasar`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `Kode` int(11) NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `Gambar` varchar(100) NOT NULL,
  `Harga` int(9) NOT NULL,
  `Deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`Kode`, `Nama`, `Gambar`, `Harga`, `Deskripsi`) VALUES
(1, 'Batik 1', 'Batik 1.jpg', 50000, 'Pakaian Batik'),
(3, ' Batik 2', 'Batik 2.jpg', 70000, 'Pakaian Batik Bagus gaess'),
(4, 'Batik 3', 'Batik 3.jpg', 50000, 'Pakaian Batik'),
(5, 'Batik 4', 'Batik 4.jpg', 50000, 'Pakaian Batik'),
(6, 'Batik 5', 'Batik 5.jpg', 50000, 'Pakaian Batik'),
(7, 'Batik 6', 'Batik 6.jpg', 70000, 'Pakaian Batik'),
(10, ' Batik 7', 'Batik 7.jpg', 80000, 'Batik 7 bla bla'),
(13, 'Batik 8', 'Batik 8.jpg', 80000, 'Batik nomor 8'),
(15, 'Batik 9', '68110ef9ef836.jpg', 99000, 'asdfasdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
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
(2, 'Faris', 'thornestarkk@gmail.com', '$2y$10$P6Ubu3M8MPZTf/4KQuLzwennQPHpXjoW9TVO6nuq//ImNuEiEBiZ.', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`Kode`);

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
  MODIFY `Kode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
