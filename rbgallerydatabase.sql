-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Jun 2025 pada 16.15
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
(2, 'Faris', 'thornestarkk@gmail.com', '$2y$10$P6Ubu3M8MPZTf/4KQuLzwennQPHpXjoW9TVO6nuq//ImNuEiEBiZ.', 'user'),
(3, 'Slamet', 'slamet@gmail.com', '$2y$10$dtH.BY6jHDQHOhnSIt6n0e8ZSDewPjfxO2ww7vUjw8QugrB7r1y7e', 'user'),
(4, 'Supriadi', 'supriadi@gmail.com', '$2y$10$Ld8dCXzp1jwRmPnf26puB.vzqxkCnkvXXU8rFAqAJUTo2i/Xk6maW', 'user'),
(5, 'Shodik', 'shodik@gmail.com', '$2y$10$ieYOZTKb6aylGTovsu2S5ecB3LbGsMAu4obSrSIzMR9CA6UOrsO9m', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
