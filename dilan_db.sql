-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Agu 2019 pada 16.55
-- Versi server: 10.3.16-MariaDB
-- Versi PHP: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dilan_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kecamatan`
--

CREATE TABLE `kecamatan` (
  `kec_id` int(5) NOT NULL,
  `nama_kec` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kecamatan`
--

INSERT INTO `kecamatan` (`kec_id`, `nama_kec`) VALUES
(1, 'Tapa'),
(2, 'Suwawa'),
(3, 'Kabila');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lapor`
--

CREATE TABLE `lapor` (
  `id_lapor` int(5) NOT NULL,
  `id_usaha` int(5) NOT NULL,
  `periode` text NOT NULL,
  `tahun` year(4) NOT NULL,
  `PH` text NOT NULL,
  `tgl_pantau` date NOT NULL,
  `parameter` varchar(100) NOT NULL,
  `b_mutu` varchar(50) NOT NULL,
  `h_pantau` varchar(50) NOT NULL,
  `lampiran` text NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `vlap` enum('0','1') NOT NULL,
  `tgl_vlap` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `lapor`
--

INSERT INTO `lapor` (`id_lapor`, `id_usaha`, `periode`, `tahun`, `PH`, `tgl_pantau`, `parameter`, `b_mutu`, `h_pantau`, `lampiran`, `created_at`, `updated_at`, `vlap`, `tgl_vlap`) VALUES
(1, 1, 'January-March', 2019, 'cekidot', '2019-03-07', 'dual aer', 'baik sekali', 'baik juga', '', '0000-00-00', '0000-00-00', '1', '2019-08-01'),
(2, 1, 'August-October', 2019, 'beraian', '2019-07-31', 'dual aer', 'baik sekali', 'baik juga', '', '0000-00-00', '0000-00-00', '1', '2019-08-01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporsm`
--

CREATE TABLE `laporsm` (
  `id_laporsm` int(5) NOT NULL,
  `id_usaha` int(5) NOT NULL,
  `periode_sm` varchar(200) NOT NULL,
  `tahun_sm` year(4) NOT NULL,
  `s_dampak` varchar(250) NOT NULL,
  `j_dampak` varchar(250) NOT NULL,
  `kelola` text NOT NULL,
  `pantau` text NOT NULL,
  `lampiran` varchar(100) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `vlapsm` enum('0','1') NOT NULL,
  `tgl_vlapsm` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `laporsm`
--

INSERT INTO `laporsm` (`id_laporsm`, `id_usaha`, `periode_sm`, `tahun_sm`, `s_dampak`, `j_dampak`, `kelola`, `pantau`, `lampiran`, `created_at`, `updated_at`, `vlapsm`, `tgl_vlapsm`) VALUES
(1, 1, 'January-June', 2018, 'mencair es12', 'susah sekali12', '                                        kelola lingkungan                               12     ', '                                                                             pantau lingkungan 12\r\n                                    ', '', '0000-00-00', '0000-00-00', '1', '2019-08-01'),
(2, 1, 'July-December', 2018, '', '', '                                                                                                                                                                                                                                                                                                                ', '                                                                                                                                                                 \r\n                                     \r\n                                     \r\n                                     \r\n                                    ', 'file-cv_angola123-orange.jpg', '0000-00-00', '0000-00-00', '0', '0000-00-00'),
(3, 1, 'January-July', 2017, '', '', '                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ', '                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      \r\n                                     \r\n                                     \r\n                                     \r\n                                     \r\n                                     \r\n                                     \r\n                                     \r\n                                     \r\n                                     \r\n                                     \r\n                                     \r\n                                     \r\n                                     \r\n                                    ', 'file-cv_angola123-lime.jpg', '0000-00-00', '0000-00-00', '0', '0000-00-00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `perizinan`
--

CREATE TABLE `perizinan` (
  `id_izin` int(5) NOT NULL,
  `id_usaha` int(5) NOT NULL,
  `j_izin` varchar(200) NOT NULL,
  `nmr_izin` varchar(150) NOT NULL,
  `tgl_terbit` date NOT NULL,
  `berlaku` varchar(150) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `perizinan`
--

INSERT INTO `perizinan` (`id_izin`, `id_usaha`, `j_izin`, `nmr_izin`, `tgl_terbit`, `berlaku`, `keterangan`) VALUES
(2, 1, 'jemur13', 'asd13', '2019-07-31', '2tahun13', 'barucoy13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sarana`
--

CREATE TABLE `sarana` (
  `id_sarana` int(5) NOT NULL,
  `id_usaha` int(5) NOT NULL,
  `l_bangunan` varchar(20) NOT NULL,
  `l_parkir` varchar(20) NOT NULL,
  `ruang_hijau` varchar(20) NOT NULL,
  `penyimpanan` varchar(20) NOT NULL,
  `nm_boiler` varchar(150) NOT NULL,
  `kp_boiler` varchar(20) NOT NULL,
  `jml_crb` varchar(10) NOT NULL,
  `tinggi_crb` varchar(10) NOT NULL,
  `bentuk_crb` varchar(80) NOT NULL,
  `diameter_crb` varchar(80) NOT NULL,
  `wktu_o` varchar(50) NOT NULL,
  `nm_genset` varchar(150) NOT NULL,
  `kp_genset` varchar(20) NOT NULL,
  `waktu_opr` varchar(20) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sarana`
--

INSERT INTO `sarana` (`id_sarana`, `id_usaha`, `l_bangunan`, `l_parkir`, `ruang_hijau`, `penyimpanan`, `nm_boiler`, `kp_boiler`, `jml_crb`, `tinggi_crb`, `bentuk_crb`, `diameter_crb`, `wktu_o`, `nm_genset`, `kp_genset`, `waktu_opr`, `created_at`, `updated_at`) VALUES
(2, 1, '15003', '3003', '1003', 'gudang3', 'arima3', '30003', '43', '103', 'segi lima3', '73', '83', 'komatsu3', '10003', '83', '2019-07-28', '2019-07-28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `usaha`
--

CREATE TABLE `usaha` (
  `id_usaha` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `email` varchar(128) NOT NULL,
  `nm_usaha` varchar(200) NOT NULL,
  `jenis` varchar(200) NOT NULL,
  `owner` varchar(200) NOT NULL,
  `almt_ktr` text NOT NULL,
  `kec_ktr` varchar(100) NOT NULL,
  `almt_ush` text NOT NULL,
  `kec_ush` varchar(150) NOT NULL,
  `telepon` varchar(50) NOT NULL,
  `email_u` varchar(50) NOT NULL,
  `tahun_opr` varchar(50) NOT NULL,
  `jenis_dok` varchar(50) NOT NULL,
  `tahun_sah` varchar(50) NOT NULL,
  `luas_lahan` varchar(50) NOT NULL,
  `jenis_produk` varchar(100) NOT NULL,
  `kapasitas` varchar(50) NOT NULL,
  `jenis_bahan` varchar(50) NOT NULL,
  `penggunaan` varchar(50) NOT NULL,
  `sumber_air` varchar(100) NOT NULL,
  `jml_karyawan` varchar(50) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `verifikasi` enum('0','1') NOT NULL,
  `tgl_v` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `usaha`
--

INSERT INTO `usaha` (`id_usaha`, `user_id`, `email`, `nm_usaha`, `jenis`, `owner`, `almt_ktr`, `kec_ktr`, `almt_ush`, `kec_ush`, `telepon`, `email_u`, `tahun_opr`, `jenis_dok`, `tahun_sah`, `luas_lahan`, `jenis_produk`, `kapasitas`, `jenis_bahan`, `penggunaan`, `sumber_air`, `jml_karyawan`, `created_at`, `updated_at`, `verifikasi`, `tgl_v`) VALUES
(1, 44, 'ktrcamatbulu@gmail.com', 'cv angola123', 'aman123', 'mansur lahmutu123', 'desa oluhuta3', 'Tapa', 'desa padengo3', 'Suwawa', '0821972155853', 'kantor123@gmail.com', '2003', 'jenis dokumen', '2001', 'luas lahan', 'jenis produk', 'kapasitas', 'jenis bahan baku', 'penggunaan bahan baku', 'sungai', '400', '2019-07-25', '0000-00-00', '1', '2019-08-01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(5) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `image` varchar(100) NOT NULL,
  `role_id` int(5) NOT NULL,
  `is_active` int(1) NOT NULL,
  `token` varchar(150) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `nama`, `email`, `password`, `image`, `role_id`, `is_active`, `token`, `created_at`) VALUES
(16, 'admin', 'syafrinibrahim12@gmail.com', '$2y$10$6gcyP/HNFer5aU0GE5.oqe9sFv/6HaQlxyFVLpE6G3hS0kVSeAkNa', 'default-image.jpg', 1, 1, '', '2019-07-13'),
(44, 'andika', 'ktrcamatbulu@gmail.com', '$2y$10$0bYHd8f495HBym4b5nT7Ke5/XNIjcf7b0BiapBAXd9yELFYUTiu/C', 'default-image.jpg', 4, 1, 'aSTDPiidR5ZPcDKd6jcz4syogPz+s1ZfK14iYdZpKe8=', '2019-07-25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `role_id` int(5) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`role_id`, `role`) VALUES
(1, 'Administrator'),
(2, 'kepala Dinas'),
(3, 'Admin kecamatan'),
(4, 'User');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`kec_id`);

--
-- Indeks untuk tabel `lapor`
--
ALTER TABLE `lapor`
  ADD PRIMARY KEY (`id_lapor`);

--
-- Indeks untuk tabel `laporsm`
--
ALTER TABLE `laporsm`
  ADD PRIMARY KEY (`id_laporsm`);

--
-- Indeks untuk tabel `perizinan`
--
ALTER TABLE `perizinan`
  ADD PRIMARY KEY (`id_izin`);

--
-- Indeks untuk tabel `sarana`
--
ALTER TABLE `sarana`
  ADD PRIMARY KEY (`id_sarana`);

--
-- Indeks untuk tabel `usaha`
--
ALTER TABLE `usaha`
  ADD PRIMARY KEY (`id_usaha`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`role_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kecamatan`
--
ALTER TABLE `kecamatan`
  MODIFY `kec_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `lapor`
--
ALTER TABLE `lapor`
  MODIFY `id_lapor` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `laporsm`
--
ALTER TABLE `laporsm`
  MODIFY `id_laporsm` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `perizinan`
--
ALTER TABLE `perizinan`
  MODIFY `id_izin` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `sarana`
--
ALTER TABLE `sarana`
  MODIFY `id_sarana` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `usaha`
--
ALTER TABLE `usaha`
  MODIFY `id_usaha` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `role_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
