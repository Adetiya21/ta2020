-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 27 Mar 2021 pada 15.53
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ta2020`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id` int(3) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id`, `nama`, `username`, `password`) VALUES
(1, 'Putri Berkahati', '0', '$2y$10$j.0n.HBIJAPj/3uHAFC1X.SE0nNxgHLPWfASJ.4tWKbiImQZhfF3K');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_guru`
--

CREATE TABLE `tb_guru` (
  `nip` varchar(12) NOT NULL,
  `id_kelas` int(3) NOT NULL,
  `id_mapel` int(4) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jenkel` enum('Laki-Laki','Perempuan') NOT NULL,
  `agama` enum('Islam','Kristen','Katolik','Hindu','Buddha','Kong Hu Cu') NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_guru`
--

INSERT INTO `tb_guru` (`nip`, `id_kelas`, `id_mapel`, `nama`, `jenkel`, `agama`, `alamat`, `no_telp`, `password`) VALUES
('198001011001', 101, 1011, 'Eko Saputra, S.Pd', 'Laki-Laki', 'Islam', 'semparuk', '085345453070', '$2y$10$RseV.MEJBDRay4Dm2dZhZ.HiKxI.4zOeXoc5dbkXyOrb8Iu5leYR2'),
('198001011009', 101, 1012, 'Romi, S.Pd', 'Laki-Laki', 'Hindu', 'pemangkat', '085750683895', '$2y$10$Iikg24e88.MGGbgrIEOGtewwZchzaYXb/G8oJCu7GzKP3Nsf23DsW'),
('198002022002', 102, 1013, 'Asmawati.A, S.Pd', 'Perempuan', 'Islam', 'tebas', '085750683895', '$2y$10$eQvqyHCbNPOFP5QG6erhbOfNPi2m5tb1qwIkze/iBlMxPG28mwYHC'),
('198003031003', 103, 1015, 'Ade Kurniawan, S.Pd', 'Laki-Laki', 'Islam', 'sempalai', '082153427150', '$2y$10$gp11HhUFAfgERvnmEvMaO.Qmb5vBorPQe10zYnvsqVyt7U1C0ec5.'),
('198004042004', 104, 1016, 'Reni Handriyani, S,Pd', 'Perempuan', 'Islam', 'tebas', '089531074848', '$2y$10$MtM8SNgEmmkl2gv9o76jKu1uuJwhkE7E.8xjPsuAKCImi78ItIvMm'),
('198005051005', 105, 1012, 'Romi, S.Pd', 'Laki-Laki', 'Islam', 'pemangkat', '082153427151', '$2y$10$/ryyYKWgHoQMF3kUc.2HdeUsuCmNNepkPKcpnZdPpRC/X.dPex356'),
('198006062006', 106, 1018, 'Nurwati, S.Pd ', 'Perempuan', 'Islam', 'sambas', '085304042359', '$2y$10$kCR12bc95YomrwwDTn1j7.yfGH6FD6id2qhQZ57qrgtZ0tRw/YZ4a'),
('198007071007', 101, 1017, 'Alimin, S.Pd', 'Laki-Laki', 'Islam', 'tebas', '089531074849', '$2y$10$AUhIWYFB8Cv8mn7MfXLNB.OZufmP45u0dsx5VLlw9ajZNBHVdhR0O');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jadwal`
--

CREATE TABLE `tb_jadwal` (
  `id` int(11) NOT NULL,
  `id_kelas` int(3) NOT NULL,
  `nip_guru` varchar(12) NOT NULL,
  `hari` varchar(10) NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_selesai` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_jadwal`
--

INSERT INTO `tb_jadwal` (`id`, `id_kelas`, `nip_guru`, `hari`, `jam_masuk`, `jam_selesai`) VALUES
(1, 105, '198001011001', 'Senin', '12:00:00', '00:00:00'),
(2, 102, '198001011001', 'Kamis', '14:00:00', '18:00:00'),
(3, 106, '198001011001', 'Rabu', '08:00:00', '10:00:00'),
(4, 101, '198007071007', 'Selasa', '11:00:00', '13:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id` int(3) NOT NULL,
  `nama_kelas` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_kelas`
--

INSERT INTO `tb_kelas` (`id`, `nama_kelas`) VALUES
(101, 'Kelas 1'),
(102, 'Kelas 2'),
(103, 'Kelas 3'),
(104, 'Kelas 4'),
(105, 'Kelas 5'),
(106, 'Kelas 6');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_mapel`
--

CREATE TABLE `tb_mapel` (
  `id` int(4) NOT NULL,
  `nama_mapel` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_mapel`
--

INSERT INTO `tb_mapel` (`id`, `nama_mapel`) VALUES
(1011, 'Bahasa Indonesia'),
(1012, 'Matematika'),
(1013, 'Bahasa Inggris'),
(1014, 'Pendidikan Agama'),
(1015, 'IPA'),
(1016, 'IPS'),
(1017, 'Penjaskes'),
(1018, 'Seni Budaya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_nilaisiswa`
--

CREATE TABLE `tb_nilaisiswa` (
  `id` int(11) NOT NULL,
  `nis` varchar(12) NOT NULL,
  `id_kelas` int(3) NOT NULL,
  `id_mapel` int(4) DEFAULT NULL,
  `h1` int(3) NOT NULL DEFAULT '0',
  `h2` int(3) NOT NULL DEFAULT '0',
  `h3` int(3) NOT NULL DEFAULT '0',
  `uts` int(3) NOT NULL DEFAULT '0',
  `uas` int(3) NOT NULL DEFAULT '0',
  `total` float NOT NULL DEFAULT '0',
  `rata` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_nilaisiswa`
--

INSERT INTO `tb_nilaisiswa` (`id`, `nis`, `id_kelas`, `id_mapel`, `h1`, `h2`, `h3`, `uts`, `uas`, `total`, `rata`) VALUES
(1, '200603001', 101, 1011, 70, 70, 70, 70, 90, 370, 74),
(2, '200603001', 101, 1012, 0, 0, 0, 0, 0, 0, 0),
(3, '200603001', 101, 1013, 0, 0, 0, 0, 0, 0, 0),
(4, '200603001', 101, 1014, 0, 0, 0, 0, 0, 0, 0),
(5, '200603001', 101, 1015, 0, 0, 0, 0, 0, 0, 0),
(6, '200603001', 101, 1016, 0, 0, 0, 0, 0, 0, 0),
(7, '200603001', 101, 1017, 0, 0, 0, 0, 0, 0, 0),
(8, '200603001', 101, 1018, 0, 0, 0, 0, 0, 0, 0),
(9, '2006002', 101, 1011, 80, 90, 80, 90, 90, 430, 86),
(10, '2006002', 101, 1012, 0, 0, 0, 0, 0, 0, 0),
(11, '2006002', 101, 1013, 0, 0, 0, 0, 0, 0, 0),
(12, '2006002', 101, 1014, 0, 0, 0, 0, 0, 0, 0),
(13, '2006002', 101, 1015, 0, 0, 0, 0, 0, 0, 0),
(14, '2006002', 101, 1016, 0, 0, 0, 0, 0, 0, 0),
(15, '2006002', 101, 1017, 0, 0, 0, 0, 0, 0, 0),
(16, '2006002', 101, 1018, 0, 0, 0, 0, 0, 0, 0),
(17, '2006003', 101, 1011, 90, 90, 90, 90, 90, 450, 90),
(18, '2006003', 101, 1012, 0, 0, 0, 0, 0, 0, 0),
(19, '2006003', 101, 1013, 0, 0, 0, 0, 0, 0, 0),
(20, '2006003', 101, 1014, 0, 0, 0, 0, 0, 0, 0),
(21, '2006003', 101, 1015, 0, 0, 0, 0, 0, 0, 0),
(22, '2006003', 101, 1016, 0, 0, 0, 0, 0, 0, 0),
(23, '2006003', 101, 1017, 0, 0, 0, 0, 0, 0, 0),
(24, '2006003', 101, 1018, 0, 0, 0, 0, 0, 0, 0),
(25, '200603004', 101, 1011, 95, 80, 80, 90, 100, 445, 89),
(26, '200603004', 101, 1012, 0, 0, 0, 0, 0, 0, 0),
(27, '200603004', 101, 1013, 0, 0, 0, 0, 0, 0, 0),
(28, '200603004', 101, 1014, 0, 0, 0, 0, 0, 0, 0),
(29, '200603004', 101, 1015, 0, 0, 0, 0, 0, 0, 0),
(30, '200603004', 101, 1016, 0, 0, 0, 0, 0, 0, 0),
(31, '200603004', 101, 1017, 0, 0, 0, 0, 0, 0, 0),
(32, '200603004', 101, 1018, 0, 0, 0, 0, 0, 0, 0),
(33, '200603005', 101, 1011, 90, 100, 90, 100, 100, 480, 96),
(34, '200603005', 101, 1012, 0, 0, 0, 0, 0, 0, 0),
(35, '200603005', 101, 1013, 0, 0, 0, 0, 0, 0, 0),
(36, '200603005', 101, 1014, 0, 0, 0, 0, 0, 0, 0),
(37, '200603005', 101, 1015, 0, 0, 0, 0, 0, 0, 0),
(38, '200603005', 101, 1016, 0, 0, 0, 0, 0, 0, 0),
(39, '200603005', 101, 1017, 0, 0, 0, 0, 0, 0, 0),
(40, '200603005', 101, 1018, 0, 0, 0, 0, 0, 0, 0),
(129, '190603001', 102, 1011, 0, 0, 0, 0, 0, 0, 0),
(130, '190603001', 102, 1012, 0, 0, 0, 0, 0, 0, 0),
(131, '190603001', 102, 1013, 0, 0, 0, 0, 0, 0, 0),
(132, '190603001', 102, 1014, 0, 0, 0, 0, 0, 0, 0),
(133, '190603001', 102, 1015, 0, 0, 0, 0, 0, 0, 0),
(134, '190603001', 102, 1016, 0, 0, 0, 0, 0, 0, 0),
(135, '190603001', 102, 1017, 0, 0, 0, 0, 0, 0, 0),
(136, '190603001', 102, 1018, 0, 0, 0, 0, 0, 0, 0),
(137, '180603001', 103, 1011, 0, 0, 0, 0, 0, 0, 0),
(138, '180603001', 103, 1012, 0, 0, 0, 0, 0, 0, 0),
(139, '180603001', 103, 1013, 0, 0, 0, 0, 0, 0, 0),
(140, '180603001', 103, 1014, 0, 0, 0, 0, 0, 0, 0),
(141, '180603001', 103, 1015, 0, 0, 0, 0, 0, 0, 0),
(142, '180603001', 103, 1016, 0, 0, 0, 0, 0, 0, 0),
(143, '180603001', 103, 1017, 0, 0, 0, 0, 0, 0, 0),
(144, '180603001', 103, 1018, 0, 0, 0, 0, 0, 0, 0),
(145, '170603001', 104, 1011, 0, 0, 0, 0, 0, 0, 0),
(146, '170603001', 104, 1012, 0, 0, 0, 0, 0, 0, 0),
(147, '170603001', 104, 1013, 0, 0, 0, 0, 0, 0, 0),
(148, '170603001', 104, 1014, 0, 0, 0, 0, 0, 0, 0),
(149, '170603001', 104, 1015, 0, 0, 0, 0, 0, 0, 0),
(150, '170603001', 104, 1016, 0, 0, 0, 0, 0, 0, 0),
(151, '170603001', 104, 1017, 0, 0, 0, 0, 0, 0, 0),
(152, '170603001', 104, 1018, 0, 0, 0, 0, 0, 0, 0),
(153, '160603001', 105, 1011, 0, 0, 0, 0, 0, 0, 0),
(154, '160603001', 105, 1012, 0, 0, 0, 0, 0, 0, 0),
(155, '160603001', 105, 1013, 0, 0, 0, 0, 0, 0, 0),
(156, '160603001', 105, 1014, 0, 0, 0, 0, 0, 0, 0),
(157, '160603001', 105, 1015, 0, 0, 0, 0, 0, 0, 0),
(158, '160603001', 105, 1016, 0, 0, 0, 0, 0, 0, 0),
(159, '160603001', 105, 1017, 0, 0, 0, 0, 0, 0, 0),
(160, '160603001', 105, 1018, 0, 0, 0, 0, 0, 0, 0),
(161, '150603001', 106, 1011, 0, 0, 0, 0, 0, 0, 0),
(162, '150603001', 106, 1012, 0, 0, 0, 0, 0, 0, 0),
(163, '150603001', 106, 1013, 0, 0, 0, 0, 0, 0, 0),
(164, '150603001', 106, 1014, 0, 0, 0, 0, 0, 0, 0),
(165, '150603001', 106, 1015, 0, 0, 0, 0, 0, 0, 0),
(166, '150603001', 106, 1016, 0, 0, 0, 0, 0, 0, 0),
(167, '150603001', 106, 1017, 0, 0, 0, 0, 0, 0, 0),
(168, '150603001', 106, 1018, 0, 0, 0, 0, 0, 0, 0),
(169, '190603002', 102, 1011, 0, 0, 0, 0, 0, 0, 0),
(170, '190603002', 102, 1012, 0, 0, 0, 0, 0, 0, 0),
(171, '190603002', 102, 1013, 0, 0, 0, 0, 0, 0, 0),
(172, '190603002', 102, 1014, 0, 0, 0, 0, 0, 0, 0),
(173, '190603002', 102, 1015, 0, 0, 0, 0, 0, 0, 0),
(174, '190603002', 102, 1016, 0, 0, 0, 0, 0, 0, 0),
(175, '190603002', 102, 1017, 0, 0, 0, 0, 0, 0, 0),
(176, '190603002', 102, 1018, 0, 0, 0, 0, 0, 0, 0),
(177, '190603003', 102, 1011, 0, 0, 0, 0, 0, 0, 0),
(178, '190603003', 102, 1012, 0, 0, 0, 0, 0, 0, 0),
(179, '190603003', 102, 1013, 0, 0, 0, 0, 0, 0, 0),
(180, '190603003', 102, 1014, 0, 0, 0, 0, 0, 0, 0),
(181, '190603003', 102, 1015, 0, 0, 0, 0, 0, 0, 0),
(182, '190603003', 102, 1016, 0, 0, 0, 0, 0, 0, 0),
(183, '190603003', 102, 1017, 0, 0, 0, 0, 0, 0, 0),
(184, '190603003', 102, 1018, 0, 0, 0, 0, 0, 0, 0),
(185, '190603004', 102, 1011, 0, 0, 0, 0, 0, 0, 0),
(186, '190603004', 102, 1012, 0, 0, 0, 0, 0, 0, 0),
(187, '190603004', 102, 1013, 0, 0, 0, 0, 0, 0, 0),
(188, '190603004', 102, 1014, 0, 0, 0, 0, 0, 0, 0),
(189, '190603004', 102, 1015, 0, 0, 0, 0, 0, 0, 0),
(190, '190603004', 102, 1016, 0, 0, 0, 0, 0, 0, 0),
(191, '190603004', 102, 1017, 0, 0, 0, 0, 0, 0, 0),
(192, '190603004', 102, 1018, 0, 0, 0, 0, 0, 0, 0),
(193, '190603005', 102, 1011, 0, 0, 0, 0, 0, 0, 0),
(194, '190603005', 102, 1012, 0, 0, 0, 0, 0, 0, 0),
(195, '190603005', 102, 1013, 0, 0, 0, 0, 0, 0, 0),
(196, '190603005', 102, 1014, 0, 0, 0, 0, 0, 0, 0),
(197, '190603005', 102, 1015, 0, 0, 0, 0, 0, 0, 0),
(198, '190603005', 102, 1016, 0, 0, 0, 0, 0, 0, 0),
(199, '190603005', 102, 1017, 0, 0, 0, 0, 0, 0, 0),
(200, '190603005', 102, 1018, 0, 0, 0, 0, 0, 0, 0),
(201, '180603002', 103, 1011, 0, 0, 0, 0, 0, 0, 0),
(202, '180603002', 103, 1012, 0, 0, 0, 0, 0, 0, 0),
(203, '180603002', 103, 1013, 0, 0, 0, 0, 0, 0, 0),
(204, '180603002', 103, 1014, 0, 0, 0, 0, 0, 0, 0),
(205, '180603002', 103, 1015, 0, 0, 0, 0, 0, 0, 0),
(206, '180603002', 103, 1016, 0, 0, 0, 0, 0, 0, 0),
(207, '180603002', 103, 1017, 0, 0, 0, 0, 0, 0, 0),
(208, '180603002', 103, 1018, 0, 0, 0, 0, 0, 0, 0),
(209, '180603003', 103, 1011, 0, 0, 0, 0, 0, 0, 0),
(210, '180603003', 103, 1012, 0, 0, 0, 0, 0, 0, 0),
(211, '180603003', 103, 1013, 0, 0, 0, 0, 0, 0, 0),
(212, '180603003', 103, 1014, 0, 0, 0, 0, 0, 0, 0),
(213, '180603003', 103, 1015, 0, 0, 0, 0, 0, 0, 0),
(214, '180603003', 103, 1016, 0, 0, 0, 0, 0, 0, 0),
(215, '180603003', 103, 1017, 0, 0, 0, 0, 0, 0, 0),
(216, '180603003', 103, 1018, 0, 0, 0, 0, 0, 0, 0),
(217, '180603004', 103, 1011, 0, 0, 0, 0, 0, 0, 0),
(218, '180603004', 103, 1012, 0, 0, 0, 0, 0, 0, 0),
(219, '180603004', 103, 1013, 0, 0, 0, 0, 0, 0, 0),
(220, '180603004', 103, 1014, 0, 0, 0, 0, 0, 0, 0),
(221, '180603004', 103, 1015, 0, 0, 0, 0, 0, 0, 0),
(222, '180603004', 103, 1016, 0, 0, 0, 0, 0, 0, 0),
(223, '180603004', 103, 1017, 0, 0, 0, 0, 0, 0, 0),
(224, '180603004', 103, 1018, 0, 0, 0, 0, 0, 0, 0),
(225, '180603005', 103, 1011, 0, 0, 0, 0, 0, 0, 0),
(226, '180603005', 103, 1012, 0, 0, 0, 0, 0, 0, 0),
(227, '180603005', 103, 1013, 0, 0, 0, 0, 0, 0, 0),
(228, '180603005', 103, 1014, 0, 0, 0, 0, 0, 0, 0),
(229, '180603005', 103, 1015, 0, 0, 0, 0, 0, 0, 0),
(230, '180603005', 103, 1016, 0, 0, 0, 0, 0, 0, 0),
(231, '180603005', 103, 1017, 0, 0, 0, 0, 0, 0, 0),
(232, '180603005', 103, 1018, 0, 0, 0, 0, 0, 0, 0),
(233, '170603002', 104, 1011, 0, 0, 0, 0, 0, 0, 0),
(234, '170603002', 104, 1012, 0, 0, 0, 0, 0, 0, 0),
(235, '170603002', 104, 1013, 0, 0, 0, 0, 0, 0, 0),
(236, '170603002', 104, 1014, 0, 0, 0, 0, 0, 0, 0),
(237, '170603002', 104, 1015, 0, 0, 0, 0, 0, 0, 0),
(238, '170603002', 104, 1016, 0, 0, 0, 0, 0, 0, 0),
(239, '170603002', 104, 1017, 0, 0, 0, 0, 0, 0, 0),
(240, '170603002', 104, 1018, 0, 0, 0, 0, 0, 0, 0),
(241, '170603003', 104, 1011, 0, 0, 0, 0, 0, 0, 0),
(242, '170603003', 104, 1012, 0, 0, 0, 0, 0, 0, 0),
(243, '170603003', 104, 1013, 0, 0, 0, 0, 0, 0, 0),
(244, '170603003', 104, 1014, 0, 0, 0, 0, 0, 0, 0),
(245, '170603003', 104, 1015, 0, 0, 0, 0, 0, 0, 0),
(246, '170603003', 104, 1016, 0, 0, 0, 0, 0, 0, 0),
(247, '170603003', 104, 1017, 0, 0, 0, 0, 0, 0, 0),
(248, '170603003', 104, 1018, 0, 0, 0, 0, 0, 0, 0),
(249, '170603004', 104, 1011, 0, 0, 0, 0, 0, 0, 0),
(250, '170603004', 104, 1012, 0, 0, 0, 0, 0, 0, 0),
(251, '170603004', 104, 1013, 0, 0, 0, 0, 0, 0, 0),
(252, '170603004', 104, 1014, 0, 0, 0, 0, 0, 0, 0),
(253, '170603004', 104, 1015, 0, 0, 0, 0, 0, 0, 0),
(254, '170603004', 104, 1016, 0, 0, 0, 0, 0, 0, 0),
(255, '170603004', 104, 1017, 0, 0, 0, 0, 0, 0, 0),
(256, '170603004', 104, 1018, 0, 0, 0, 0, 0, 0, 0),
(257, '170603005', 104, 1011, 0, 0, 0, 0, 0, 0, 0),
(258, '170603005', 104, 1012, 0, 0, 0, 0, 0, 0, 0),
(259, '170603005', 104, 1013, 0, 0, 0, 0, 0, 0, 0),
(260, '170603005', 104, 1014, 0, 0, 0, 0, 0, 0, 0),
(261, '170603005', 104, 1015, 0, 0, 0, 0, 0, 0, 0),
(262, '170603005', 104, 1016, 0, 0, 0, 0, 0, 0, 0),
(263, '170603005', 104, 1017, 0, 0, 0, 0, 0, 0, 0),
(264, '170603005', 104, 1018, 0, 0, 0, 0, 0, 0, 0),
(265, '160603002', 105, 1011, 0, 0, 0, 0, 0, 0, 0),
(266, '160603002', 105, 1012, 0, 0, 0, 0, 0, 0, 0),
(267, '160603002', 105, 1013, 0, 0, 0, 0, 0, 0, 0),
(268, '160603002', 105, 1014, 0, 0, 0, 0, 0, 0, 0),
(269, '160603002', 105, 1015, 0, 0, 0, 0, 0, 0, 0),
(270, '160603002', 105, 1016, 0, 0, 0, 0, 0, 0, 0),
(271, '160603002', 105, 1017, 0, 0, 0, 0, 0, 0, 0),
(272, '160603002', 105, 1018, 0, 0, 0, 0, 0, 0, 0),
(273, '160603003', 105, 1011, 0, 0, 0, 0, 0, 0, 0),
(274, '160603003', 105, 1012, 0, 0, 0, 0, 0, 0, 0),
(275, '160603003', 105, 1013, 0, 0, 0, 0, 0, 0, 0),
(276, '160603003', 105, 1014, 0, 0, 0, 0, 0, 0, 0),
(277, '160603003', 105, 1015, 0, 0, 0, 0, 0, 0, 0),
(278, '160603003', 105, 1016, 0, 0, 0, 0, 0, 0, 0),
(279, '160603003', 105, 1017, 0, 0, 0, 0, 0, 0, 0),
(280, '160603003', 105, 1018, 0, 0, 0, 0, 0, 0, 0),
(281, '160603004', 105, 1011, 0, 0, 0, 0, 0, 0, 0),
(282, '160603004', 105, 1012, 0, 0, 0, 0, 0, 0, 0),
(283, '160603004', 105, 1013, 0, 0, 0, 0, 0, 0, 0),
(284, '160603004', 105, 1014, 0, 0, 0, 0, 0, 0, 0),
(285, '160603004', 105, 1015, 0, 0, 0, 0, 0, 0, 0),
(286, '160603004', 105, 1016, 0, 0, 0, 0, 0, 0, 0),
(287, '160603004', 105, 1017, 0, 0, 0, 0, 0, 0, 0),
(288, '160603004', 105, 1018, 0, 0, 0, 0, 0, 0, 0),
(289, '160603005', 105, 1011, 0, 0, 0, 0, 0, 0, 0),
(290, '160603005', 105, 1012, 0, 0, 0, 0, 0, 0, 0),
(291, '160603005', 105, 1013, 0, 0, 0, 0, 0, 0, 0),
(292, '160603005', 105, 1014, 0, 0, 0, 0, 0, 0, 0),
(293, '160603005', 105, 1015, 0, 0, 0, 0, 0, 0, 0),
(294, '160603005', 105, 1016, 0, 0, 0, 0, 0, 0, 0),
(295, '160603005', 105, 1017, 0, 0, 0, 0, 0, 0, 0),
(296, '160603005', 105, 1018, 0, 0, 0, 0, 0, 0, 0),
(297, '150603002', 106, 1011, 0, 0, 0, 0, 0, 0, 0),
(298, '150603002', 106, 1012, 0, 0, 0, 0, 0, 0, 0),
(299, '150603002', 106, 1013, 0, 0, 0, 0, 0, 0, 0),
(300, '150603002', 106, 1014, 0, 0, 0, 0, 0, 0, 0),
(301, '150603002', 106, 1015, 0, 0, 0, 0, 0, 0, 0),
(302, '150603002', 106, 1016, 0, 0, 0, 0, 0, 0, 0),
(303, '150603002', 106, 1017, 0, 0, 0, 0, 0, 0, 0),
(304, '150603002', 106, 1018, 0, 0, 0, 0, 0, 0, 0),
(305, '150603003', 106, 1011, 0, 0, 0, 0, 0, 0, 0),
(306, '150603003', 106, 1012, 0, 0, 0, 0, 0, 0, 0),
(307, '150603003', 106, 1013, 0, 0, 0, 0, 0, 0, 0),
(308, '150603003', 106, 1014, 0, 0, 0, 0, 0, 0, 0),
(309, '150603003', 106, 1015, 0, 0, 0, 0, 0, 0, 0),
(310, '150603003', 106, 1016, 0, 0, 0, 0, 0, 0, 0),
(311, '150603003', 106, 1017, 0, 0, 0, 0, 0, 0, 0),
(312, '150603003', 106, 1018, 0, 0, 0, 0, 0, 0, 0),
(313, '150603004', 106, 1011, 0, 0, 0, 0, 0, 0, 0),
(314, '150603004', 106, 1012, 0, 0, 0, 0, 0, 0, 0),
(315, '150603004', 106, 1013, 0, 0, 0, 0, 0, 0, 0),
(316, '150603004', 106, 1014, 0, 0, 0, 0, 0, 0, 0),
(317, '150603004', 106, 1015, 0, 0, 0, 0, 0, 0, 0),
(318, '150603004', 106, 1016, 0, 0, 0, 0, 0, 0, 0),
(319, '150603004', 106, 1017, 0, 0, 0, 0, 0, 0, 0),
(320, '150603004', 106, 1018, 0, 0, 0, 0, 0, 0, 0),
(321, '150603005', 106, 1011, 0, 0, 0, 0, 0, 0, 0),
(322, '150603005', 106, 1012, 0, 0, 0, 0, 0, 0, 0),
(323, '150603005', 106, 1013, 0, 0, 0, 0, 0, 0, 0),
(324, '150603005', 106, 1014, 0, 0, 0, 0, 0, 0, 0),
(325, '150603005', 106, 1015, 0, 0, 0, 0, 0, 0, 0),
(326, '150603005', 106, 1016, 0, 0, 0, 0, 0, 0, 0),
(327, '150603005', 106, 1017, 0, 0, 0, 0, 0, 0, 0),
(328, '150603005', 106, 1018, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `nis` varchar(12) NOT NULL,
  `id_kelas` int(3) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `tmp_lahir` varchar(20) NOT NULL,
  `jenkel` enum('Laki-Laki','Perempuan') NOT NULL,
  `agama` enum('Islam','Kristen','Katolik','Hindu','Buddha','Kong Hu Cu') NOT NULL,
  `alamat` text NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_siswa`
--

INSERT INTO `tb_siswa` (`nis`, `id_kelas`, `nama`, `tgl_lahir`, `tmp_lahir`, `jenkel`, `agama`, `alamat`, `password`) VALUES
('150603001', 106, 'Jurina', '2009-01-27', 'Sempalai', 'Perempuan', 'Islam', 'sempalai', '$2y$10$JeLBmb5wC66dz/5mMIkqLOjG8AF8iKgKVce6VdjeviWqM2ut557Na'),
('150603002', 106, 'Lulu', '2009-09-04', 'selakau', 'Perempuan', 'Islam', 'sempalai', '$2y$10$FMgh/vi98vEtz.sFxswNt.yv6j.CZ2Wg3dznR66VCd.aEye1jwQoG'),
('150603003', 106, 'Rena Hunadri', '2009-09-13', 'tebas', 'Perempuan', 'Islam', 'sempalai', '$2y$10$XZAjppiPuUpoec5Xrw1nNOuT7N//ZGd5Ti6eZHMCiP1mRypIfiUAu'),
('150603004', 106, 'Yuni yuningsih', '2009-01-12', 'Pontianak', 'Perempuan', 'Islam', 'sempalai', '$2y$10$umAt/CSnhqWHDrEVFaODreW/I/B/t0cWlKx3PKzAgaR5a6Tb6JBEK'),
('150603005', 106, 'Putra', '2009-04-04', 'Pemangkat', 'Laki-Laki', 'Islam', 'sempalai', '$2y$10$Qv9LQ1EDu.AWro5P4USWoOEnAwt5kkhmEpo2gSsmNTXrEdyKMn16i'),
('160603001', 105, 'Roni', '2010-01-12', 'tebas', 'Laki-Laki', 'Islam', 'sempalai', '$2y$10$yLRiinpOKJQkuglET4tIcukF2jCZKkrVtcAuYAifno1O4yX/TK/A6'),
('160603002', 105, 'Hanindia', '2010-02-03', 'semparuk', 'Perempuan', 'Islam', 'sempalai', '$2y$10$IOdFrZtRJQW36f4j8IavIeWfG5UzUkKiKRBziYhTcS9.W1HIbMPYa'),
('160603003', 105, 'Feriyansah', '1970-01-01', 'Pontianak', 'Laki-Laki', 'Islam', 'sempalai', '$2y$10$srb3w9bTN0jJcg0Ty/tHueB9lYICDJiOqoQ90FrYZbwkVtGVPEVDS'),
('160603004', 105, 'Joko Maulana', '2010-02-22', 'jawai', 'Laki-Laki', 'Islam', 'sempalai', '$2y$10$IhQ5ZCCT6jm1ogoQeFSje.AxRzlLZBqvVp91ucHywhgaUqQ4LgWoK'),
('160603005', 105, 'Putri Andini', '2010-01-01', 'Pemangkat', 'Perempuan', 'Islam', 'sempalai', '$2y$10$bPYs7y1VgUES8lNBTMZJEuz7MCDNtTecSD8UJ3kQvD/ZwFMIE5o9y'),
('170603001', 104, 'Neni angraini', '2011-09-12', 'Pemangkat', 'Perempuan', 'Islam', 'sempalai', '$2y$10$htrevoduWSFrG/u3AJaVp.kmnvBVK1OVqXckFabMRWa.G095ulOme'),
('170603002', 104, 'Jenie ', '2011-01-23', 'paloh', 'Perempuan', 'Kristen', 'sempalai', '$2y$10$w9LXuGCpYFrtC/RcU.m3ieMcGHHG.0/PMgXNhi3h6hElxAusT4mru'),
('170603003', 104, 'Owen', '2011-09-15', 'tebas', 'Laki-Laki', 'Islam', 'sempalai', '$2y$10$Z9KncE9OrKogGA9S14LBa.7/UZINeSqfsSSZrw.7mmludg5HXE31u'),
('170603004', 104, 'Riyansyah', '2011-06-11', 'Pemangkat', 'Laki-Laki', 'Islam', 'sempalai', '$2y$10$CuGxqLMGDVykPXjoxnmjx.m74rczReXUfNkZmNiEFZH1ooNtG5mh.'),
('170603005', 104, 'Wiwit cantika', '2011-08-23', 'Pontianak', 'Perempuan', 'Islam', 'sempalai', '$2y$10$WVLEk52wIxhOVJbnrQIkt.pFTca83XBuRLx0GmyVlyRMkRsiEw87O'),
('180603001', 103, 'Yudha', '2012-09-11', 'selakau', 'Laki-Laki', 'Islam', 'sempalai', '$2y$10$qRBBhZjMbIAI8DLI5H4Z7.MyyCJWAQiA.8VXdL9YRfT5RMoAaidZm'),
('180603002', 103, 'Jumi', '2012-09-14', 'selakau', 'Perempuan', 'Islam', 'sempalai', '$2y$10$aLP.pMhDH0XnM9rTPt0y8O2ZmirdQ3kV3RNqQtDKkoO.xQKoFsR/q'),
('180603003', 103, 'Nanda', '2012-09-07', 'sejangkung', 'Laki-Laki', 'Islam', 'sempalai', '$2y$10$LMTG0EDnSlKiVtNZLHRVZ.FtY0uY6/PXYQp/Ou6Hi9HUDzRpdF.RW'),
('180603004', 103, 'Reno saputra', '2012-01-29', 'Pontianak', 'Laki-Laki', 'Islam', 'sempalai', '$2y$10$w/6kRqt8Z6EpD3LXa0v75.WVWEMh4ZVb13dKHFJmWq4I.AkC90E.i'),
('180603005', 103, 'Ayu saputra', '2012-08-23', 'sambas', 'Perempuan', 'Islam', 'sempalai', '$2y$10$rlZeKLy6n0qvhNIBro/HPu4werFrGl9joIZhm6HWR3/XAxrSeALfe'),
('190603001', 102, 'Yusuf', '2013-09-02', 'Sempalai', 'Laki-Laki', 'Islam', 'sempalai', '$2y$10$0D2863HNc0Bw72M28zK.MuwX.HVcGexHAvptjHOnSmc1aDUiKbRee'),
('190603002', 102, 'Yeni Susilawati', '2013-03-24', 'Pontianak', 'Perempuan', 'Islam', 'sempalai', '$2y$10$V8.pqJjOG8rymmGoDy9v9uH20vpRsamrK/K3086fPsP72fsnmcxQO'),
('190603003', 102, 'Kurli', '2013-09-12', 'tebas', 'Laki-Laki', 'Islam', 'sempalai', '$2y$10$WOkJbA/zwcmi/I9pGneeR.q2rWzDuvzNq9JdbxSiNCrycO4raulDG'),
('190603004', 102, 'Anggi', '2013-09-25', 'tebas', 'Laki-Laki', 'Islam', 'sempalai', '$2y$10$8wlBZH5UFsDr9Nw4ItrOVu7D1k4T5jW5hON0MZStt42Wefjkx5D7q'),
('190603005', 102, 'Anto saputra', '2013-01-12', 'semparuk', 'Laki-Laki', 'Islam', 'sempalai', '$2y$10$6fmAg2te7/lcgVB5v2nxZOSd3UEiM997BlFMyRDZJwx5H4Jd5tU9S'),
('2006002', 101, 'Falisha Inara', '2014-12-05', 'Pemangkat', '', '', 'Sempalai', '$2y$10$J6o02OpMNM44MjQ5EEI8GehuM6rmsW2xcjcyf5zj2Jes9h.VNIrwG'),
('2006003', 101, 'Doni saputra', '2014-03-07', 'Sempalai', 'Laki-Laki', 'Islam', 'sempalai', '$2y$10$vGgxCBd5F2X/Bj3709LLUet6o8nLUKI..xfnIn3t0LnnPAK.OiAoi'),
('200603001', 101, 'Hanif abqari', '2014-12-05', 'Pemangkat', 'Laki-Laki', 'Islam', 'pemangkat', '$2y$10$52YEi0ev7cPrzV4Uqiz8fOEe4ZKJ0QsVkYsejBtZ9.ctY.Dr1OTnW'),
('200603004', 101, 'Rarasilawati', '2014-03-12', 'Sempalai', 'Perempuan', 'Islam', 'sempalai', '$2y$10$dcR3XlN.1xLNrS8MTK5BeuC/1B72eFcdYTfLD18s1CQ8WCP4WKa/O'),
('200603005', 101, 'suhendra', '2014-03-21', 'Sempalai', 'Laki-Laki', 'Islam', 'sempalai', '$2y$10$J9lXGM6y8w44JOXCrQ.gl.cQW0Hp6c0xZ4Q3MDxNlhv.A8Auk3Cqm');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_mapel` (`id_mapel`);

--
-- Indeks untuk tabel `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `nip_guru` (`nip_guru`) USING BTREE;

--
-- Indeks untuk tabel `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_mapel`
--
ALTER TABLE `tb_mapel`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_nilaisiswa`
--
ALTER TABLE `tb_nilaisiswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nis` (`nis`),
  ADD KEY `id_mapel` (`id_mapel`) USING BTREE,
  ADD KEY `id_kelas` (`id_kelas`) USING BTREE;

--
-- Indeks untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`nis`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT untuk tabel `tb_nilaisiswa`
--
ALTER TABLE `tb_nilaisiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=329;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD CONSTRAINT `tb_guru_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `tb_kelas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tb_guru_ibfk_2` FOREIGN KEY (`id_mapel`) REFERENCES `tb_mapel` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
  ADD CONSTRAINT `tb_jadwal_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `tb_kelas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tb_jadwal_ibfk_2` FOREIGN KEY (`nip_guru`) REFERENCES `tb_guru` (`nip`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_nilaisiswa`
--
ALTER TABLE `tb_nilaisiswa`
  ADD CONSTRAINT `tb_nilaisiswa_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `tb_siswa` (`nis`) ON DELETE CASCADE,
  ADD CONSTRAINT `tb_nilaisiswa_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `tb_kelas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tb_nilaisiswa_ibfk_3` FOREIGN KEY (`id_mapel`) REFERENCES `tb_mapel` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD CONSTRAINT `tb_siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `tb_kelas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
