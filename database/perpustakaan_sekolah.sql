-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Apr 2020 pada 12.17
-- Versi server: 10.3.16-MariaDB
-- Versi PHP: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan_sekolah`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `idBuku` varchar(6) NOT NULL,
  `idKategori` varchar(5) DEFAULT NULL,
  `judul` varchar(150) DEFAULT NULL,
  `idPenerbit` varchar(5) DEFAULT NULL,
  `penulis` varchar(50) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `sinopsis` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`idBuku`, `idKategori`, `judul`, `idPenerbit`, `penulis`, `qty`, `image`, `sinopsis`) VALUES
('BK0001', 'CA05', 'Grafik dan Animasi Proffesional Power Point', 'PB001', 'Edy Winarno dan Ali Zaki', 36, '519.6.WIN.G.1.jpg', 'Belajar cepat animasi PPT hanya dengan buku ini..'),
('BK0002', 'CA01', 'Manajemen Database dengan Microsoft VB 6', 'PB001', 'M Agus, J. Alam', 55, '519.8.AGU.M.1.jpeg', 'Belajar database dengan VB ? disini tempatnya untuk belajar..'),
('BK0003', 'CA01', 'Pemrograman Database dengan Delphi7 Access ADO', 'PB004', 'Abdul Kadir', 12, '519.6.KAD.P.3.jpg', 'Belajar delphi7 disini...'),
('BK0004', 'CA02', 'The C++ Programming Language third edition', 'PB005', 'Bjarne Stroustup', 23, '519.6.Str.T.1.jpg', '3rd edition, let\'s learn c++ with us..'),
('BK0005', 'CA02', 'Algoritma dan Teknik Pemrograman', 'PB006', 'Budi Sutejo, MIchael An', 44, '519.6.SUT.A.1.jpeg', 'Belajar pemrograman disini..'),
('BK0006', 'CA04', 'Ragam Tutorial Desain Grafis bagi Pemula', 'PB001', 'Lea Wilsen Honey Dee', 21, 'dg.jpg', 'Bagaimana memulai design? ayo cari caranya disini..'),
('BK0007', 'CA04', 'Mahir Desain Grafis dengan CorelDraw', 'PB001', 'Jubilee Enterprise', 32, '107402_f.jpg', 'Apa itu Corel?? Cari tahu disini..'),
('BK0008', 'CA04', 'Photoshop Special F/X', 'PB001', 'Jubilee Enterprise', 55, 'fx.jpg', 'Belajar Photoshop disini..'),
('BK0009', 'CA03', 'Wireless Networking', 'PB004', 'Eko Priyo Utomo', 44, '57587_f.jpg', 'WIreless Networking ? Apa itu ? Bagaimana ?'),
('BK0010', 'CA01', 'TestDefaultPicure', 'PB001', 'Test', 1, 'default.jpg', 'Test..');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detailtransaksi`
--

CREATE TABLE `detailtransaksi` (
  `idTransaksi` varchar(7) NOT NULL,
  `idBuku` varchar(6) DEFAULT NULL,
  `tglDikembalikan` date DEFAULT NULL,
  `status` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detailtransaksi`
--

INSERT INTO `detailtransaksi` (`idTransaksi`, `idBuku`, `tglDikembalikan`, `status`) VALUES
('TR00001', 'BK0004', '2020-04-20', '1'),
('TR00002', 'BK0001', '2020-04-20', '1'),
('TR00002', 'BK0007', NULL, '0'),
('TR00003', 'BK0009', '2020-04-20', '1'),
('TR00003', 'BK0005', '2020-04-20', '1'),
('TR00004', 'BK0001', '2020-04-20', '1'),
('TR00004', 'BK0006', '2020-04-20', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `idKategori` varchar(5) NOT NULL,
  `kategoriBuku` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`idKategori`, `kategoriBuku`) VALUES
('CA01', 'Database'),
('CA02', 'Programming'),
('CA03', 'Networking'),
('CA04', 'Design Grafis'),
('CA05', 'Multimedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `idPustakawan` varchar(4) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `hakUser` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`idPustakawan`, `username`, `password`, `hakUser`) VALUES
('P001', 'hem', 'hem', 'Admin'),
('P002', 'ilham', 'ilham', 'Pustakawan'),
('P003', 'admin', 'admin', 'Admin'),
('P004', 'pustakawan', 'pustakawan', 'Pustakawan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penerbit`
--

CREATE TABLE `penerbit` (
  `idPenerbit` varchar(5) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penerbit`
--

INSERT INTO `penerbit` (`idPenerbit`, `nama`, `alamat`, `phone`, `email`) VALUES
('PB001', 'ElexMedia Komputindo', 'JL. Palmerah No. 100 Jakarta', '021-7866665', 'elex@gmail.com'),
('PB002', 'Gagas Media', 'Jl. Geger Kalong No.23 Bandung', '022-89775655', 'gagas@gagas.com'),
('PB003', 'Dicoding Centre', 'Jakarta Pusat', '022-99976', 'dicodcen@dicoding.com'),
('PB004', 'Penerbit Andi ', 'Badung', '021-226754', 'andipublisher@gmail.com'),
('PB005', 'AT&T Labs', 'New York, USA', '021-33456', 'atlabs@gmail.com'),
('PB006', 'ANDI', 'Bandung', '021-8989433', 'andiandi@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pustakawan`
--

CREATE TABLE `pustakawan` (
  `idPustakawan` varchar(4) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pustakawan`
--

INSERT INTO `pustakawan` (`idPustakawan`, `nama`, `alamat`, `phone`, `email`, `image`) VALUES
('P001', 'Hem Holland', 'Queens, England', '022-222-22', 'hemhol@marvel.com', 'editan2.png'),
('P002', 'Ilham Shiddiq', 'Jl. Kebon Manggu, Padasuka', '082130486258', 'shdqillham123@gmail.com', '33-picsay.jpg'),
('P003', 'Saya Admin', 'Indonesia', '12345', 'iamadmin@gmail.com', 'logo stm.png'),
('P004', 'Saya Pustakawan', 'Indonesia', '54321', 'iampustakawan@gmail.com', 'rpl.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `nis` varchar(9) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` varchar(150) DEFAULT NULL,
  `jurusan` varchar(5) DEFAULT NULL,
  `tingkat` char(2) DEFAULT NULL,
  `kelas` char(1) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`nis`, `nama`, `alamat`, `jurusan`, `tingkat`, `kelas`, `phone`, `email`, `image`) VALUES
('171113839', 'Surya Rahmat', 'Jl. Cihanjuang', 'TPTU', '12', 'B', '-', 'sayarahmat@gmail.com', 'default.jpg'),
('181113820', 'Adam Albani Timmothy', '-', 'RPL', '11', 'A', '01', 'adam@sea.com', 'adam.jpg'),
('181113836', 'Ilham Shiddiq', 'jl. Kebon Manggu, Padasuka', 'RPL', '11', 'A', '082130486258', 'shdqillham123@gmail.com', 'default.jpg'),
('191113869', 'Muhammad Ariq Rifqi', 'Jl.Cibeber', 'TEDK', '10', 'C', '08642257282', 'ariqariq@gmail.com', 'default.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `idTransaksi` varchar(7) NOT NULL,
  `nis` varchar(9) DEFAULT NULL,
  `idPustakawan` varchar(4) DEFAULT NULL,
  `tglPinjam` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`idTransaksi`, `nis`, `idPustakawan`, `tglPinjam`) VALUES
('TR00001', '181113820', 'P002', '2020-04-20'),
('TR00002', '171113839', 'P002', '2020-04-20'),
('TR00003', '191113869', 'P002', '2020-04-20'),
('TR00004', '181113836', 'P004', '2020-04-13');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`idBuku`),
  ADD KEY `idKategori` (`idKategori`),
  ADD KEY `idPenerbit` (`idPenerbit`);

--
-- Indeks untuk tabel `detailtransaksi`
--
ALTER TABLE `detailtransaksi`
  ADD KEY `idBuku` (`idBuku`),
  ADD KEY `idTransaksi` (`idTransaksi`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`idKategori`);

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`idPustakawan`);

--
-- Indeks untuk tabel `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`idPenerbit`);

--
-- Indeks untuk tabel `pustakawan`
--
ALTER TABLE `pustakawan`
  ADD PRIMARY KEY (`idPustakawan`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`idTransaksi`),
  ADD KEY `nis` (`nis`),
  ADD KEY `idPustakawan` (`idPustakawan`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`idKategori`) REFERENCES `kategori` (`idKategori`),
  ADD CONSTRAINT `buku_ibfk_2` FOREIGN KEY (`idPenerbit`) REFERENCES `penerbit` (`idPenerbit`);

--
-- Ketidakleluasaan untuk tabel `detailtransaksi`
--
ALTER TABLE `detailtransaksi`
  ADD CONSTRAINT `detailtransaksi_ibfk_2` FOREIGN KEY (`idBuku`) REFERENCES `buku` (`idBuku`),
  ADD CONSTRAINT `detailtransaksi_ibfk_3` FOREIGN KEY (`idTransaksi`) REFERENCES `transaksi` (`idTransaksi`);

--
-- Ketidakleluasaan untuk tabel `pustakawan`
--
ALTER TABLE `pustakawan`
  ADD CONSTRAINT `pustakawan_ibfk_1` FOREIGN KEY (`idPustakawan`) REFERENCES `login` (`idPustakawan`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`idPustakawan`) REFERENCES `pustakawan` (`idPustakawan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
