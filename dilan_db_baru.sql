-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Agu 2019 pada 15.57
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
-- Struktur dari tabel `download`
--

CREATE TABLE `download` (
  `id_d` int(5) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `nm_file` varchar(200) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `download`
--

INSERT INTO `download` (`id_d`, `judul`, `nm_file`, `created_at`) VALUES
(1, 'file regulasi', 'file_regulasi-DILAN.pdf', '2019-08-07'),
(2, 'pengumuman penginputan', 'pengumuman_penginputan-DILAN.docx', '2019-08-07');

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
-- Struktur dari tabel `kelola_pantau`
--

CREATE TABLE `kelola_pantau` (
  `id_kelola` int(5) NOT NULL,
  `id_usaha` varchar(20) NOT NULL,
  `periode` varchar(100) NOT NULL,
  `tahun` varchar(100) NOT NULL,
  `sumber` varchar(100) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `kelola` text NOT NULL,
  `pantau` text NOT NULL,
  `file` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kelola_pantau`
--

INSERT INTO `kelola_pantau` (`id_kelola`, `id_usaha`, `periode`, `tahun`, `sumber`, `jenis`, `kelola`, `pantau`, `file`) VALUES
(1, 'ush002', 'January-June', ' 2019', 'kegiatan operasi produksi', 'penurunan kualitas air permukaan', 'melakukan pengolahan air limbah', '<p>melakukan parameter kualitas parameter air limbah</p>\r\n', 'file-usr003-pixel_google.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `konsul`
--

CREATE TABLE `konsul` (
  `id_k` int(5) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `email` varchar(128) NOT NULL,
  `kontak` varchar(20) NOT NULL,
  `perihal` varchar(300) NOT NULL,
  `isi` text NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `konsul`
--

INSERT INTO `konsul` (`id_k`, `user_id`, `email`, `kontak`, `perihal`, `isi`, `created_at`) VALUES
(1, 'usr003', 'ktrcamatbulu@gmail.com', '081233455', 'aturan izin baru', 'aturan izin baru tahun 2019', '2019-08-03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lapor`
--

CREATE TABLE `lapor` (
  `id_lapor` int(5) NOT NULL,
  `id_usaha` varchar(20) NOT NULL,
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
(3, 'ush002', 'January-March', 2018, '100', '2019-08-14', 'air', 'air', 'baik', 'file-cv_hasrat_abadi-fruitpunch.jpg', '2019-08-02', '2019-08-02', '0', '0000-00-00'),
(8, 'ush001', 'January-March', 2019, '700', '2019-08-21', 'dual aer', 'baik sekali', 'baik juga', 'file-cv_tetap_sejati-latte.jpg', '2019-08-02', '2019-08-02', '1', '2019-08-04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporsm`
--

CREATE TABLE `laporsm` (
  `id_laporsm` int(5) NOT NULL,
  `id_usaha` varchar(20) NOT NULL,
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
(6, 'ush002', 'January-March', 2019, 'limbah', 'limbah berat', '                                        membersihkan limbah                                    ', '                                                             2 bulan sekali \r\n                                    ', 'file-cv_hasrat_abadi-lime.jpg', '2019-08-02', '2019-08-02', '0', '0000-00-00'),
(7, 'ush001', 'January-June', 2019, 'mencair es', 'limbah berat', '                                        pembersihan limbah                                    ', '                                                                             2 bulan \r\n                                    ', 'file-cv_tetap_sejati-drinks.jpg', '2019-08-02', '2019-08-02', '0', '0000-00-00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `perizinan`
--

CREATE TABLE `perizinan` (
  `id_izin` int(5) NOT NULL,
  `id_usaha` varchar(20) NOT NULL,
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
(3, 'ush002', 'izin produksi', '02/01/2019', '2019-08-02', '2 tahun', 'produksi mobil baru'),
(4, 'ush001', 'minyak bumi dan gas', '06/02/2019', '2019-08-05', '5 tahun', 'perusahan minyak bumi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `p_air`
--

CREATE TABLE `p_air` (
  `id_p` int(5) NOT NULL,
  `id_usaha` varchar(20) NOT NULL,
  `parameter_a` varchar(50) NOT NULL,
  `bk_mutu` varchar(50) NOT NULL,
  `b1` varchar(10) NOT NULL,
  `b2` varchar(10) NOT NULL,
  `b3` varchar(10) NOT NULL,
  `b4` varchar(10) NOT NULL,
  `b5` varchar(10) NOT NULL,
  `b6` varchar(10) NOT NULL,
  `b7` varchar(10) NOT NULL,
  `b8` varchar(10) NOT NULL,
  `b9` varchar(10) NOT NULL,
  `b10` varchar(10) NOT NULL,
  `b11` varchar(10) NOT NULL,
  `b12` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `p_air`
--

INSERT INTO `p_air` (`id_p`, `id_usaha`, `parameter_a`, `bk_mutu`, `b1`, `b2`, `b3`, `b4`, `b5`, `b6`, `b7`, `b8`, `b9`, `b10`, `b11`, `b12`) VALUES
(25, 'ush002', 'BOD', '85', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'),
(26, 'ush002', 'COD', '75', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22'),
(27, 'ush002', 'TSS', '23', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `p_b3`
--

CREATE TABLE `p_b3` (
  `id_b3` int(5) NOT NULL,
  `id_usaha` varchar(20) NOT NULL,
  `jenis` varchar(150) NOT NULL,
  `jml_bfr` float NOT NULL,
  `jml_now` float NOT NULL,
  `ttl_now` float NOT NULL,
  `used` float NOT NULL,
  `give_3` float NOT NULL,
  `sisa` float NOT NULL,
  `bln` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `p_b3`
--

INSERT INTO `p_b3` (`id_b3`, `id_usaha`, `jenis`, `jml_bfr`, `jml_now`, `ttl_now`, `used`, `give_3`, `sisa`, `bln`) VALUES
(1, 'ush001', 'oli', 2.5, 0.5, 3, 0, 0.75, 2.25, '01'),
(2, 'ush001', 'aki', 1.4, 0.25, 1.65, 0, 1.65, 0, '02'),
(3, 'ush002', 'abu batu', 1200, 450, 1650, 800, 0, 850, '01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `p_udara`
--

CREATE TABLE `p_udara` (
  `id_u` int(5) NOT NULL,
  `id_usaha` varchar(20) NOT NULL,
  `parameter_u` varchar(50) NOT NULL,
  `bk_mutu` varchar(50) NOT NULL,
  `b1` varchar(10) NOT NULL,
  `b2` varchar(10) NOT NULL,
  `b3` varchar(10) NOT NULL,
  `b4` varchar(10) NOT NULL,
  `b5` varchar(10) NOT NULL,
  `b6` varchar(10) NOT NULL,
  `b7` varchar(10) NOT NULL,
  `b8` varchar(10) NOT NULL,
  `b9` varchar(10) NOT NULL,
  `b10` varchar(10) NOT NULL,
  `b11` varchar(10) NOT NULL,
  `b12` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `p_udara`
--

INSERT INTO `p_udara` (`id_u`, `id_usaha`, `parameter_u`, `bk_mutu`, `b1`, `b2`, `b3`, `b4`, `b5`, `b6`, `b7`, `b8`, `b9`, `b10`, `b11`, `b12`) VALUES
(1, 'ush002', 'CO2', '100000', '1000', '2000', '3000', '4000', '5000', '6000', '7000', '8000', '9000', '10000', '11000', '12000'),
(3, 'ush002', '03', '50', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21'),
(4, 'ush002', 'PM10', '30000', '100', '200', '300', '400', '500', '600', '700', '800', '900', '1000', '1100', '1200');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sarana`
--

CREATE TABLE `sarana` (
  `id_sarana` int(5) NOT NULL,
  `id_usaha` varchar(20) NOT NULL,
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
(3, 'ush002', '1400', '1350', '1600', 'gudang', 'berkat', '1450', '20', '230', 'segi 5', '20', '120', 'genset kodu', '1500', '150', '2019-08-02', '0000-00-00'),
(4, 'ush001', '2400', '150', '130', 'gudnag khusus', 'boiler heroku', '1340', '3', '400', 'segi 5', '25', '2600', 'genset heroku', '20000', '240', '2019-08-02', '0000-00-00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `usaha`
--

CREATE TABLE `usaha` (
  `id_usaha` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
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
('ush001', 'usr002', '', 'cv tetap sejati', 'minyak bumi', 'mansur migrate', 'bulota', 'kota utara', 'huntu', 'tapa', '0812345566', 'sejati@gmail.com', '2002', 'dokumen minyak', '2003', '2000', 'minyak bumi', '530 ', 'minyak ', 'air minyak', 'air', '1300', '2019-08-02', '0000-00-00', '0', '0000-00-00'),
('ush002', 'usr003', '', 'cv hasrat abadi', 'otomotif', 'abraham bua', 'suka makmur', 'buliide', 'suka makmur', 'buliide', '0813425552', 'hazrat@gmail.com', '2001', 'jenis dokumen', '2001', '1500', 'mobil', '120', 'baja', 'besi', 'sungai', '1400', '2019-08-02', '0000-00-00', '0', '0000-00-00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` varchar(20) NOT NULL,
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
('usr001', 'admin', 'syafrinibrahim12@gmail.com', '$2y$10$6gcyP/HNFer5aU0GE5.oqe9sFv/6HaQlxyFVLpE6G3hS0kVSeAkNa', 'user2-160x160.jpg', 1, 1, '', '2019-07-13'),
('usr002', 'dedi mulyadi', 'dedi@gmail.com', '$2y$10$.ctzLsA5vQMytM2sXiuB9.pJhPN8cE32ALDCjgbjtERm3luvTRALW', 'user2-160x160.jpg', 4, 1, '', '2019-08-02'),
('usr003', 'ismail nusi', 'ktrcamatbulu@gmail.com', '$2y$10$4jp5/A8FWaQ9s1F.waHv6u6Z6h72lSqRinzVs5BPWbmoX1o1zBg56', 'photo_2.jpg', 4, 1, 'MCfrEEYEAM+2uKvh7ERf8Hy+UHW4mE3VTKVPSGTOrjE=', '2019-08-02');

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
(4, 'User');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `download`
--
ALTER TABLE `download`
  ADD PRIMARY KEY (`id_d`);

--
-- Indeks untuk tabel `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`kec_id`);

--
-- Indeks untuk tabel `kelola_pantau`
--
ALTER TABLE `kelola_pantau`
  ADD PRIMARY KEY (`id_kelola`);

--
-- Indeks untuk tabel `konsul`
--
ALTER TABLE `konsul`
  ADD PRIMARY KEY (`id_k`);

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
-- Indeks untuk tabel `p_air`
--
ALTER TABLE `p_air`
  ADD PRIMARY KEY (`id_p`);

--
-- Indeks untuk tabel `p_b3`
--
ALTER TABLE `p_b3`
  ADD PRIMARY KEY (`id_b3`);

--
-- Indeks untuk tabel `p_udara`
--
ALTER TABLE `p_udara`
  ADD PRIMARY KEY (`id_u`);

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
-- AUTO_INCREMENT untuk tabel `download`
--
ALTER TABLE `download`
  MODIFY `id_d` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `kecamatan`
--
ALTER TABLE `kecamatan`
  MODIFY `kec_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kelola_pantau`
--
ALTER TABLE `kelola_pantau`
  MODIFY `id_kelola` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `konsul`
--
ALTER TABLE `konsul`
  MODIFY `id_k` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `lapor`
--
ALTER TABLE `lapor`
  MODIFY `id_lapor` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `laporsm`
--
ALTER TABLE `laporsm`
  MODIFY `id_laporsm` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `perizinan`
--
ALTER TABLE `perizinan`
  MODIFY `id_izin` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `p_air`
--
ALTER TABLE `p_air`
  MODIFY `id_p` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `p_b3`
--
ALTER TABLE `p_b3`
  MODIFY `id_b3` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `p_udara`
--
ALTER TABLE `p_udara`
  MODIFY `id_u` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `sarana`
--
ALTER TABLE `sarana`
  MODIFY `id_sarana` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `role_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
