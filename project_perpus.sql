-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 13 Jun 2016 pada 05.12
-- Versi Server: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_perpus`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `agenda`
--

CREATE TABLE `agenda` (
  `id_agenda` varchar(20) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `isi_agenda` text NOT NULL,
  `tanggal_agenda` date NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` varchar(15) NOT NULL,
  `pass` varchar(15) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `pass`, `status`) VALUES
('12345', 'admin', 'ADMIN'),
('A2346', 'admin', 'ANGGOTA'),
('A2347', 'PHOLENK', 'ANGGOTA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `aturan`
--

CREATE TABLE `aturan` (
  `id_aturan` varchar(10) NOT NULL,
  `aturan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `id_berita` varchar(20) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `isi_berita` text NOT NULL,
  `tanggal_berita` date NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `isbn` varchar(20) NOT NULL,
  `judul` varchar(150) NOT NULL,
  `penulis` varchar(30) NOT NULL,
  `tahun_terbit` int(4) NOT NULL,
  `tempat_terbit` varchar(20) NOT NULL,
  `penerbit` varchar(20) NOT NULL,
  `edisi` int(4) NOT NULL,
  `kategori` varchar(15) NOT NULL,
  `deskripsi_fisik` text NOT NULL,
  `jumlah` int(10) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`isbn`, `judul`, `penulis`, `tahun_terbit`, `tempat_terbit`, `penerbit`, `edisi`, `kategori`, `deskripsi_fisik`, `jumlah`, `status`) VALUES
('12345', 'anu itu', 'ina', 2016, 'cilacap', 'poltek', 1, 'teknik', '200 halaman', 4, 'ADA'),
('123456789', 'anu fuck', 'adi jaya', 1989, 'semarang', 'adi jaya', 10, 'IT', 'buku ini buat anu anu', 25, 'ADA'),
('45555', 'kobokan', 'ipan', 1998, 'cilacap', 'poltek', 2, 'anu anu', '200 halaman', 20, 'TIDAK ADA'),
('987654', 'anu anu', 'bule', 2016, 'cilacap', 'poltek', 1, 'anu itu', 'bla bla bla', 10, 'ADA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `denda`
--

CREATE TABLE `denda` (
  `id_denda` varchar(5) NOT NULL,
  `nom_denda` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `denda`
--

INSERT INTO `denda` (`id_denda`, `nom_denda`) VALUES
('DND00', 500);

-- --------------------------------------------------------

--
-- Struktur dari tabel `det_anggota`
--

CREATE TABLE `det_anggota` (
  `id_anggota` varchar(15) NOT NULL,
  `no_pendaftaran` varchar(15) NOT NULL,
  `jenis_identitas` varchar(10) NOT NULL,
  `no_identitas` varchar(25) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `tempat_lahir` varchar(15) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `pekerjaan` varchar(25) NOT NULL,
  `no_telpon` varchar(25) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `det_anggota`
--

INSERT INTO `det_anggota` (`id_anggota`, `no_pendaftaran`, `jenis_identitas`, `no_identitas`, `nama`, `alamat`, `tempat_lahir`, `tanggal_lahir`, `pekerjaan`, `no_telpon`, `status`) VALUES
('12345', '54321', 'SIM', '654321', 'pholenk', 'Jalan Mataram', 'Semarang', '1995-08-22', 'Mahasiswa', '898', 'AKTIF'),
('A2346', 'DT4322', 'KTP', '2147483647', 'INA FADILA SARI', 'JALAN LOMBOK', 'CILACAP', '1995-08-22', 'Mahasiswa', '898', 'AKTIF'),
('A2347', 'DT4323', 'SIM', '3374152208950003', 'BRAMANDITYA ADI PRABOWO', 'JALAN MATARAM 6', 'SEMARANG', '1995-08-22', 'MAHASISWA', '085640856846', 'AKTIF');

-- --------------------------------------------------------

--
-- Struktur dari tabel `det_pinjam`
--

CREATE TABLE `det_pinjam` (
  `id_pinjam` varchar(15) NOT NULL,
  `isbn` varchar(20) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kembali`
--

CREATE TABLE `kembali` (
  `id_pinjam` varchar(15) NOT NULL,
  `isbn` varchar(20) NOT NULL,
  `jumlah_denda` int(15) NOT NULL,
  `tgl_pengembalian` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pinjam`
--

CREATE TABLE `pinjam` (
  `id_pinjam` varchar(15) NOT NULL,
  `id_anggota` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id_agenda`);

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `aturan`
--
ALTER TABLE `aturan`
  ADD PRIMARY KEY (`id_aturan`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`isbn`);

--
-- Indexes for table `denda`
--
ALTER TABLE `denda`
  ADD PRIMARY KEY (`id_denda`);

--
-- Indexes for table `det_anggota`
--
ALTER TABLE `det_anggota`
  ADD KEY `id_anggota` (`id_anggota`);

--
-- Indexes for table `det_pinjam`
--
ALTER TABLE `det_pinjam`
  ADD KEY `id_pinjam` (`id_pinjam`),
  ADD KEY `isbn` (`isbn`);

--
-- Indexes for table `kembali`
--
ALTER TABLE `kembali`
  ADD KEY `id_pinjam` (`id_pinjam`),
  ADD KEY `isbn` (`isbn`);

--
-- Indexes for table `pinjam`
--
ALTER TABLE `pinjam`
  ADD PRIMARY KEY (`id_pinjam`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `det_anggota`
--
ALTER TABLE `det_anggota`
  ADD CONSTRAINT `det_anggota_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`);

--
-- Ketidakleluasaan untuk tabel `det_pinjam`
--
ALTER TABLE `det_pinjam`
  ADD CONSTRAINT `det_pinjam_ibfk_1` FOREIGN KEY (`id_pinjam`) REFERENCES `pinjam` (`id_pinjam`),
  ADD CONSTRAINT `det_pinjam_ibfk_2` FOREIGN KEY (`isbn`) REFERENCES `buku` (`isbn`);

--
-- Ketidakleluasaan untuk tabel `kembali`
--
ALTER TABLE `kembali`
  ADD CONSTRAINT `kembali_ibfk_1` FOREIGN KEY (`id_pinjam`) REFERENCES `pinjam` (`id_pinjam`),
  ADD CONSTRAINT `kembali_ibfk_2` FOREIGN KEY (`isbn`) REFERENCES `buku` (`isbn`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
