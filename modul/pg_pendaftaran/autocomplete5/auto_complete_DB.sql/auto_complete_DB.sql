-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 07, 2010 at 04:13 
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `auto_complete_DB`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_master`
--

CREATE TABLE IF NOT EXISTS `tabel_master` (
  `kode_rekening` varchar(10) NOT NULL DEFAULT '',
  `nama_rekening` varchar(100) NOT NULL,
  `tanggal_awal` varchar(12) NOT NULL,
  `awal_debet` int(15) NOT NULL,
  `awal_kredit` int(15) NOT NULL,
  `mut_debet` int(15) NOT NULL,
  `mut_kredit` int(15) NOT NULL,
  `sisa_debet` int(15) NOT NULL,
  `sisa_kredit` int(15) NOT NULL,
  `rl_debet` int(15) NOT NULL,
  `rl_kredit` int(15) NOT NULL,
  `nrc_debet` int(15) NOT NULL,
  `nrc_kredit` int(15) NOT NULL,
  `posisi` varchar(15) NOT NULL,
  `normal` varchar(10) NOT NULL,
  PRIMARY KEY (`kode_rekening`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_master`
--

INSERT INTO `tabel_master` (`kode_rekening`, `nama_rekening`, `tanggal_awal`, `awal_debet`, `awal_kredit`, `mut_debet`, `mut_kredit`, `sisa_debet`, `sisa_kredit`, `rl_debet`, `rl_kredit`, `nrc_debet`, `nrc_kredit`, `posisi`, `normal`) VALUES
('111.01', 'Kas Unit Umum', '02/12/2010', 20000000, 0, 10000000, 39000000, 0, 9000000, 0, 0, 23000000, 0, 'neraca', 'debet'),
('112.01', 'Kas Di Bank', '02/12/2010', 20000000, 0, 0, 0, 20000000, 0, 0, 0, 20000000, 0, 'neraca', 'debet'),
('113.01', 'Piutang Anggota', '02/12/2010', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'neraca', 'debet'),
('114.01', 'Piutang Pengurus', '02/12/2010', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'neraca', 'debet'),
('133.01', 'Mesin Ketik', '02/12/2010', 100000, 0, 5000000, 0, 5100000, 0, 0, 0, 100000, 0, 'neraca', 'debet'),
('133.02', 'Komputer', '02/12/2010', 30000000, 0, 14000000, 0, 44000000, 0, 0, 0, 32000000, 0, 'neraca', 'debet'),
('133.03', 'Mesin Foto Copy', '02/12/2010', 12500000, 0, 20000000, 0, 32500000, 0, 0, 0, 12500000, 0, 'neraca', 'debet'),
('133.04', 'Handphone', '02/12/2010', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'neraca', 'debet'),
('134.01', 'Kendaraan Roda Empat', '02/12/2010', 75000000, 0, 0, 0, 75000000, 0, 0, 0, 75000000, 0, 'neraca', 'debet'),
('135.01', 'Perlengkapan Toko', '02/12/2010', 5000000, 0, 0, 0, 5000000, 0, 0, 0, 5000000, 0, 'neraca', 'debet'),
('135.02', 'Perabot/Inventaris', '02/12/2010', 5000000, 0, 0, 0, 5000000, 0, 0, 0, 5000000, 0, 'neraca', 'debet'),
('211.01', 'Hutang Barang Toko', '02/12/2010', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'neraca', 'kredit'),
('212.01', 'Simpanan Manasuka', '02/12/2010', 0, 10000000, 0, 0, 0, 10000000, 0, 0, 0, 10000000, 'neraca', 'kredit'),
('212.02', 'Simpanan Khusus', '02/12/2010', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'neraca', 'kredit'),
('213.01', 'Dana Anggota', '02/12/2010', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'neraca', 'kredit'),
('213.02', 'Dana Pengurus', '02/12/2010', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'neraca', 'kredit'),
('311.01', 'Simpanan Anggota Pokok', '02/12/2010', 0, 10000000, 0, 0, 0, 10000000, 0, 0, 0, 10000000, 'neraca', 'kredit'),
('311.02', 'Simpanan Anggota Wajib', '02/12/2010', 0, 10000000, 0, 0, 0, 10000000, 0, 0, 0, 10000000, 'neraca', 'kredit'),
('313.01', 'Modal Donasi', '02/12/2010', 0, 50000000, 0, 0, 0, 50000000, 0, 0, 0, 50000000, 'neraca', 'kredit'),
('313.05', 'SHU Tahun Lalu Belum Dibagi', '02/12/2010', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'neraca', 'kredit'),
('314.01', 'SHU Tahun Berjalan(Umum)', '02/12/2010', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'neraca', 'kredit'),
('411.01', 'Penjualan Barang Toko', '02/12/2010', 0, 0, 0, 10000000, 0, 10000000, 0, 5000000, 0, 0, 'rugi-laba', 'debet'),
('411.02', 'Pendapatan Jasa', '02/12/2010', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'rugi-laba', 'debet'),
('412.01', 'Pendapatan Simpan Pinjam', '02/12/2010', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'rugi-laba', 'kredit'),
('413.01', 'Pendapatan Jasa Lain-lain', '02/12/2010', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'rugi-laba', 'kredit'),
('511.01', 'Biaya Pembelian Barang', '02/12/2010', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'rugi-laba', 'debet'),
('522.01', 'Biaya Administrasi', '02/12/2010', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'rugi-laba', 'debet'),
('522.02', 'Biaya Gaji Karyawan', '02/12/2010', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'rugi-laba', 'debet'),
('522.03', 'Biaya Keuangan (Bank)', '02/12/2010', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'rugi-laba', 'debet'),
('522.04', 'Biaya Organisasi', '02/12/2010', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'rugi-laba', 'debet');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
