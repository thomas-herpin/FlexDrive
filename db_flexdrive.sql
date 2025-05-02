-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Bulan Mei 2025 pada 12.39
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
-- Database: `db_flexdrive`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `harga_mobil`
--

CREATE TABLE `harga_mobil` (
  `id_harga` int(10) NOT NULL,
  `id_mobil` int(10) NOT NULL,
  `per_hari` decimal(10,2) NOT NULL,
  `per_minggu` decimal(10,2) NOT NULL,
  `per_bulan` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `harga_mobil`
--

INSERT INTO `harga_mobil` (`id_harga`, `id_mobil`, `per_hari`, `per_minggu`, `per_bulan`) VALUES
(1, 1, 800000.00, 3000000.00, 22000000.00),
(2, 2, 300000.00, 1800000.00, 8700000.00),
(3, 3, 600000.00, 4000000.00, 17800000.00),
(4, 4, 600000.00, 4000000.00, 17800000.00),
(5, 5, 400000.00, 1400000.00, 10000000.00),
(6, 6, 600000.00, 4000000.00, 17800000.00),
(7, 7, 384000.00, 2000000.00, 9000000.00),
(8, 8, 384000.00, 2000000.00, 9000000.00),
(9, 9, 1000000.00, 6800000.00, 28000000.00),
(10, 10, 700000.00, 4500000.00, 17000000.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mobil`
--

CREATE TABLE `mobil` (
  `id_mobil` int(10) NOT NULL,
  `tipe_mobil` varchar(20) NOT NULL,
  `merek_mobil` varchar(100) NOT NULL,
  `nama_mobil` varchar(100) NOT NULL,
  `tahun_produksi` int(4) NOT NULL,
  `nomor_plat` varchar(20) NOT NULL,
  `engine` varchar(100) NOT NULL,
  `bahan_bakar` varchar(100) NOT NULL,
  `transmission` varchar(100) NOT NULL,
  `interior_color` varchar(100) NOT NULL,
  `exterior_color` varchar(100) NOT NULL,
  `seats` int(10) NOT NULL,
  `status` enum('Tersedia','Sedang Disewa','Tidak Aktif') NOT NULL,
  `gambar_mobil` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `mobil`
--

INSERT INTO `mobil` (`id_mobil`, `tipe_mobil`, `merek_mobil`, `nama_mobil`, `tahun_produksi`, `nomor_plat`, `engine`, `bahan_bakar`, `transmission`, `interior_color`, `exterior_color`, `seats`, `status`, `gambar_mobil`) VALUES
(1, 'MPV', 'Toyota', 'Innova', 2018, 'BK 9123 TR', '2.4L 4-Cylinder DOHC', 'Diesel', 'Automatic', 'Silver', 'Silver', 7, 'Tersedia', 'toyota-venturer.png'),
(2, 'MPV', 'Suzuki', 'Ertiga', 2021, 'BK 8323 P', '1.5L K15B', 'Bensin', 'Automatic', 'Cokelat', 'Cokelat', 7, 'Tersedia', 'Suzuki Ertiga 2021.png'),
(3, 'MPV', 'Toyota', 'Veloz', 2021, 'BK 8832 AR', '1.5L 4-Cylinder DOHC Dual VVT-i', 'Bensin', 'CVT', 'Hitam', 'Silver', 7, 'Tersedia', 'toyota-veloz 2021.png'),
(4, 'MPV', 'Daihatsu', 'Xenia', 2021, 'BK 9913 UJ', '1.5L Dual VVT-i', 'Bensin', 'Manual', 'Putih', 'Hitam', 7, 'Tersedia', 'Daihatsu Xenia 2020.png'),
(5, 'SUV', 'Toyota', 'Rush', 2018, 'BK 3365 VA', '1.5L 2NR-VE Dual VVT-i', 'Bensin', 'Automatic', 'Cokelat', 'Cokelat', 7, 'Tersedia', 'Toyota Rush 2018.png'),
(6, 'SUV', 'Honda', 'CR-V', 2019, 'BK 7722 HL', '2.0L i-VTEC', 'Bensin', 'CVT', 'Hitam', 'Hitam', 7, 'Tersedia', 'Honda CR-V 2019.png'),
(7, 'Hatchback', 'Toyota', 'Agya Sport', 2022, 'BK 5191 WZ', '1.2L 3NR-VE Dual VVT-i', 'Bensin', 'Automatic', 'Hitam', 'Merah', 5, 'Tersedia', 'agya sport 2021.png'),
(8, 'Hatchback', 'Honda', 'Brio', 2022, 'BK 8835 FD', '1.2L i-VTEC SOHC', 'Bensin', 'CVT', 'Putih', 'Putih', 5, 'Tersedia', 'Honda Brio 2022.png'),
(9, 'Minibus', 'Toyota', 'Hiace Premio', 2018, 'BK 4796 OE', '2.8L 4-Cylinder Turbo Diesel', 'Diesel', 'Manual', 'Hitam', 'Putih', 15, 'Tersedia', 'Hiiace 2018.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id_notifikasi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_pesan` int(11) NOT NULL,
  `pesan` varchar(255) NOT NULL,
  `type` enum('new_order') DEFAULT 'new_order',
  `dibaca` tinyint(1) DEFAULT 0,
  `dibuat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(10) NOT NULL,
  `id_pesan` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `jumlah_bayar` decimal(10,2) NOT NULL,
  `metode_pembayaran` varchar(255) NOT NULL,
  `bukti_pembayaran` varchar(255) NOT NULL,
  `status_pembayaran` enum('Menunggu','Dikonfirmasi','Dibatalkan') NOT NULL,
  `tanggal_pembayaran` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pesan` int(10) NOT NULL,
  `id_mobil` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `lokasi_pengambilan` varchar(255) NOT NULL,
  `lokasi_pengembalian` varchar(255) NOT NULL,
  `tanggal_pengambilan` date NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `pelunasan` enum('50','100') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `first_name`, `last_name`, `email`, `password`, `role`) VALUES
(1, 'Sari', 'Cantika', 'sarican@gmail.com', '$2y$10$MfzjV4com2tMJHOEnt6QoeBDV/a16ZCa22k27uKSlWH40np0ZStmi', 'user'),
(2, 'Thomas', 'Herpin', 'thomas@admin.com', '$2a$12$4RTWvT3BqVRrd0Rsj1g7ouOM5J/msTtBJM54leSYvI2iAJ/urITDm', 'admin'),
(3, 'Terry', 'Centrino Fangesturi', 'terry@admin.com', '$2a$12$TvipzexkgFiqolgQDZQqHu84R6IypkpHfL1KQbG7cA6RlW/1M3A7K', 'admin'),
(4, 'Joko', 'Minto', 'chocomint123@gmail.com', '$2y$10$xW88KAZEuZMit1HZ/C0ZmOfq/yqS2FBOBnBlkPmO.XW1Eg7dIAEe2', 'user'),
(5, 'Yovie', 'Canter', 'yovie@admin.com', '$2y$10$rdbYwsSJ2GMQiS75PKRhluXWP0oFOyfDPE2uUEUODzLctx3paiuOO', 'admin'),
(6, 'Tandi', 'Lopa', 'lopa44@gmail.com', '$2y$10$.2eJ.jX87rtJ9PjjT.081O3sWutrcqHzSa3/1T/EVD5Vkfl7q3Wju', 'user'),
(7, 'Wilbert', 'Stanley', 'wilbert@admin.com', '$2y$10$C72fk3sLrubqSMaQaGlVpeRQK4ur9JroG7qy7YIYJmnkib5pWN9rG', 'admin'),
(8, 'Siti', 'Rahma', 'sitirahma32@gmail.com', '$2y$10$pwD2o9gvir9.DWZYGJZ4dOFP.s5/6DZUxkHUQrS60bOYb0ErUxIIm', 'user'),
(9, 'Budi', 'Santoso', 'budisans3@gmail.com', '$2y$10$/6cuLpSnr03IXiPhEX4y/es.4K8qp.MEm7qasghCvxSbm9qsqGoZ6', 'user'),
(10, 'Ahmad', 'Fadli', 'fadli784@gmail.com', '$2y$10$T.5BVWbwfcTYauqQP/a3je8zY/3l/U7QWioanltoUf1hoRN0r6VPO', 'user'),
(11, 'Maya', 'Putri', 'mayaputt72@gmail.com', '$2y$10$KU2vooXmif1e5gEjbz5qy.FW5KnsBGQjy7MUh7btrurYQMDAZGKfO', 'user'),
(12, 'Arron', 'Taslim', 'arron@gmail.com', '$2y$10$1k2KYDIGfhk/mU4skUByCeghVrj.NgkvZvUWBFrU1n58BQ4JPSrzy', 'user'),
(13, 'Pam', 'Keju', 'pam342@gmail.com', '$2y$10$fvowRRqBc6CJBB8m0QXeeu.V9fSHMMg0N67wQtGRO0STujnhxev4e', 'user'),
(14, 'adu', 'hay', 'aduhay@gmai.com', '$2y$10$abD8KX7///GUXuvP4xO6c.jm6BAl9HhvL1PV4TxXVYAkZod9JjIWW', 'user'),
(15, 'Erika', 'Taslim', 'erika@gmail.com', '$2y$10$O90vkpwmqJQxpw4sw.BiSu/L/SgY1z.CVIlWiuS.cghyj.7pap1P.', 'user'),
(16, 'kiw', 'kew', 'kiwkew@gmail.com', '$2y$10$fLKRnrfM/gSiNWLUyxz0Q.uA1gra87A1S5pC4d/jFwK32kO2TjaSu', 'user'),
(17, 'dar', 'der', 'dor@gmail.com', '$2y$10$Li.sdNcGaasHpNhzb0c9COQUM3yZd2WLNYUVROqF5T7eJ5yDXeCgy', 'user'),
(18, 'depan', 'samping', 'depanbelakang@gmail.com', '$2y$10$TcR73F9/zv4E/j/Kxb85muFjgrvZQEN2YXtlG5tzgk1bn6OvzxSLW', 'user'),
(19, 'baru', 'punya', 'baru@gmail.com', '$2y$10$r/9weANtx7cgvdWUC/p4E.tfHQxqNGzgQ/2p6aCnFfPDojKFejIw.', 'user'),
(20, 'Has', 'Kol', 'kol312@gmail.com', '$2y$10$ulixcGWNVjGKCY7dDjD7quxJgSfj4bQMmTJGtdqdYbeM5snLAybHS', 'user'),
(21, 'siapa', 'namanya', 'siapa@gmail.com', '$2y$10$1gCh2yducO7oFhrVSsiL3.TsiZZlFFictcylXio2SImsuSi7w06.u', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `harga_mobil`
--
ALTER TABLE `harga_mobil`
  ADD PRIMARY KEY (`id_harga`);

--
-- Indeks untuk tabel `mobil`
--
ALTER TABLE `mobil`
  ADD PRIMARY KEY (`id_mobil`);

--
-- Indeks untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id_notifikasi`),
  ADD KEY `id_pesan` (`id_pesan`),
  ADD KEY `idx_notif_user` (`id_user`),
  ADD KEY `idx_notif_baca` (`dibaca`),
  ADD KEY `idx_notif_buat` (`dibuat`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indeks untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pesan`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `harga_mobil`
--
ALTER TABLE `harga_mobil`
  MODIFY `id_harga` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `mobil`
--
ALTER TABLE `mobil`
  MODIFY `id_mobil` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notifikasi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pesan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD CONSTRAINT `notifikasi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `notifikasi_ibfk_2` FOREIGN KEY (`id_pesan`) REFERENCES `pemesanan` (`id_pesan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
