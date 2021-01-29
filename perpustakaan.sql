-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 29 Jan 2021 pada 02.13
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.3.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` char(4) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `nama`, `alamat`) VALUES
('801L', 'Mamat', 'Bongol'),
('8S2A', 'Hasim', 'Kedungraya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id_buku` char(6) NOT NULL,
  `judul_buku` varchar(50) NOT NULL,
  `tahun_terbit` varchar(4) NOT NULL,
  `penerbit` varchar(25) NOT NULL,
  `stok_buku` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id_buku`, `judul_buku`, `tahun_terbit`, `penerbit`, `stok_buku`) VALUES
('BK1521', 'suara rakyat', '2010', 'ridwan emil', 19),
('BK7716', 'Pemuda tersesat', '2019', 'Khoirudin', 9),
('BK8172', 'Segitiga bermuda', '2010', 'Joko santoso', 99);

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `id_login` char(4) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(70) NOT NULL,
  `level` enum('PETUGAS','ADMIN') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`id_login`, `username`, `password`, `level`) VALUES
('28AH', 'bambang', '$2y$10$JbIkqI6CtP4VHCiExiu2feWMGCtXv.4hjgNx2MY3zu3TwW1DxOrR.', 'PETUGAS'),
('772K', 'admin', '$2y$10$SRak8gDv6nfuGKToTi7f5eQ8H/Ra4zBX7Xi6KX1bNrZxefVOcB4We', 'ADMIN'),
('82KZ', 'slamet', '$2y$10$hgGF/UvE9W3VUqNol0tqv.9jFji8Phyb8sW8dQjM6QzSKmbgtrafa', 'PETUGAS');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_pinjam` char(8) NOT NULL,
  `id_anggota` char(4) NOT NULL,
  `id_buku` char(6) NOT NULL,
  `id_petugas` char(4) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id_pinjam`, `id_anggota`, `id_buku`, `id_petugas`, `tanggal`) VALUES
('Q0RPYBTT', '8S2A', 'BK8172', '772K', '2021-01-29'),
('Z3LFT1XI', '801L', 'BK1521', '772K', '2021-01-08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` char(4) NOT NULL,
  `nama_petugas` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `nama_petugas`) VALUES
('28AH', 'Bambang'),
('772K', 'Admin'),
('82KZ', 'Slamet');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `VIEW_PEMINJAMAN`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `VIEW_PEMINJAMAN` (
`id_pinjam` char(8)
,`nama_anggota` varchar(30)
,`judul_buku` varchar(50)
,`nama_petugas` varchar(30)
,`tanggal` date
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `VIEW_PETUGAS`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `VIEW_PETUGAS` (
`id_petugas` char(4)
,`nama_petugas` varchar(30)
,`username` varchar(50)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `VIEW_PEMINJAMAN`
--
DROP TABLE IF EXISTS `VIEW_PEMINJAMAN`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `VIEW_PEMINJAMAN`  AS  select `peminjaman`.`id_pinjam` AS `id_pinjam`,`anggota`.`nama` AS `nama_anggota`,`buku`.`judul_buku` AS `judul_buku`,`petugas`.`nama_petugas` AS `nama_petugas`,`peminjaman`.`tanggal` AS `tanggal` from (((`peminjaman` join `anggota`) join `buku`) join `petugas`) where `peminjaman`.`id_anggota` = `anggota`.`id_anggota` and `peminjaman`.`id_buku` = `buku`.`id_buku` and `peminjaman`.`id_petugas` = `petugas`.`id_petugas` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `VIEW_PETUGAS`
--
DROP TABLE IF EXISTS `VIEW_PETUGAS`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `VIEW_PETUGAS`  AS  select `petugas`.`id_petugas` AS `id_petugas`,`petugas`.`nama_petugas` AS `nama_petugas`,`login`.`username` AS `username` from (`petugas` join `login`) where `petugas`.`id_petugas` = `login`.`id_login` ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_pinjam`);

--
-- Indeks untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
