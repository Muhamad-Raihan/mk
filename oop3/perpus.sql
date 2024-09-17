-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Sep 2024 pada 17.52
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
-- Database: `perpus`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `buku_id` int(5) NOT NULL,
  `judul` text NOT NULL,
  `kategori` varchar(20) NOT NULL,
  `penerbit` varchar(50) NOT NULL,
  `stok` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`buku_id`, `judul`, `kategori`, `penerbit`, `stok`) VALUES
(1, 'kelinci yang bijak', 'CV Tirta Buana', 'Pendidikan', 10),
(2, 'kelinci yang bijak', 'CV Tirta Buana', 'Pendidikan', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjam`
--

CREATE TABLE `peminjam` (
  `peminjam_id` int(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tgl_pinjam` varchar(30) NOT NULL,
  `lama_pinjam` varchar(5) NOT NULL,
  `status` varchar(15) NOT NULL,
  `telp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peminjam`
--

INSERT INTO `peminjam` (`peminjam_id`, `nama`, `tgl_pinjam`, `lama_pinjam`, `status`, `telp`) VALUES
(1, 'jeriko', '07-09-2024', '2', 'Sedang Meminjam', '089234542112');

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `petugas_id` int(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jk` varchar(10) NOT NULL,
  `ttl` varchar(30) NOT NULL,
  `agama` varchar(10) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`petugas_id`, `nama`, `jk`, `ttl`, `agama`, `telp`, `alamat`) VALUES
(1, 'Raihan', 'Laki-Laki', 'Asahan, 14 oktober 2007', 'Islam', '082113077922', 'Jln. Perintis Baru');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pinjam`
--

CREATE TABLE `pinjam` (
  `pinjam_id` int(5) NOT NULL,
  `buku_id` int(5) NOT NULL,
  `peminjam_id` int(5) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `petugas_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pinjam`
--

INSERT INTO `pinjam` (`pinjam_id`, `buku_id`, `peminjam_id`, `jumlah`, `petugas_id`) VALUES
(1, 1, 1, 5, 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`buku_id`);

--
-- Indeks untuk tabel `peminjam`
--
ALTER TABLE `peminjam`
  ADD PRIMARY KEY (`peminjam_id`);

--
-- Indeks untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`petugas_id`);

--
-- Indeks untuk tabel `pinjam`
--
ALTER TABLE `pinjam`
  ADD PRIMARY KEY (`pinjam_id`),
  ADD UNIQUE KEY `peminjam_id` (`peminjam_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `buku_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `peminjam`
--
ALTER TABLE `peminjam`
  MODIFY `peminjam_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `petugas`
--
ALTER TABLE `petugas`
  MODIFY `petugas_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pinjam`
--
ALTER TABLE `pinjam`
  MODIFY `pinjam_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pinjam`
--
ALTER TABLE `pinjam`
  ADD CONSTRAINT `pinjam_ibfk_1` FOREIGN KEY (`peminjam_id`) REFERENCES `peminjam` (`peminjam_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
