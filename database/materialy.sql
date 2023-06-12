-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Des 2022 pada 05.57
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `materialy`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_buktibayar`
--

CREATE TABLE `tb_buktibayar` (
  `id_bayar` int(11) NOT NULL,
  `id_invoice` int(11) NOT NULL,
  `gambar` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_buktibayar`
--

INSERT INTO `tb_buktibayar` (`id_bayar`, `id_invoice`, `gambar`) VALUES
(10, 20, 'MuhammadRizki.png'),
(11, 20, '009630b1577e66dcbb766cf98149bf7f45a92391.jpg'),
(12, 22, '9f21ec3d507489d40729fda83a03152bdd1fa191.jpg'),
(13, 23, 'cb2a95f221d7a7af3c9db7698ed714da232f9458.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_invoice`
--

CREATE TABLE `tb_invoice` (
  `id_invoice` int(11) NOT NULL,
  `nama_pemesan` varchar(100) NOT NULL,
  `alamat` varchar(225) NOT NULL,
  `no_tlp` varchar(15) NOT NULL,
  `tgl_pesan` datetime NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_invoice`
--

INSERT INTO `tb_invoice` (`id_invoice`, `nama_pemesan`, `alamat`, `no_tlp`, `tgl_pesan`, `keterangan`, `status`, `id_user`) VALUES
(20, 'Muhammad Rizki', 'Perum. Telaga Murni', '088222999109', '2022-11-27 10:07:40', 'Barang Sampai', 'Pembayaran Berhasil', 3),
(21, 'Jauhari ', 'Jakarta', '09790732049032', '2022-11-28 13:52:33', 'Menunggu Pembayaran', 'Belum Dibayar', 2),
(22, 'Muhammad Rizki', 'Perum. Telaga Murni', '088222999109', '2022-12-03 10:20:47', 'Barang Sampai', 'Pembayaran Berhasil', 3),
(23, 'Muhammad Rizki', 'Perum. Telaga Murni', '088222999109', '2022-12-03 11:41:00', 'Proses Pengiriman', 'Pembayaran Berhasil', 3),
(24, 'Muhammad Rizki', 'Perum Telaga Murni', '1241242121421', '2022-12-06 13:56:45', 'Menunggu Pembayaran', 'Belum Dibayar', 3),
(25, 'Jauhari', 'Jakarta', '02196969696', '2022-12-07 19:04:23', 'Menunggu Pembayaran', 'Belum Dibayar', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pesanan`
--

CREATE TABLE `tb_pesanan` (
  `id` int(11) NOT NULL,
  `id_invoice` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `harga` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pesanan`
--

INSERT INTO `tb_pesanan` (`id`, `id_invoice`, `id_produk`, `nama_produk`, `jumlah`, `harga`) VALUES
(20, 20, 4, 'Papan kayu 35 X 50 Jati ', 1, 60000),
(21, 20, 5, 'Batako', 1, 3500),
(22, 20, 6, 'Pasir Halus 5.7m3 - 1 truck', 1, 1500000),
(23, 21, 5, 'Batako', 1, 3500),
(24, 21, 6, 'Pasir Halus 5.7m3 - 1 truck', 1, 1500000),
(25, 21, 29, 'Cat Tembok - Warna Putih', 1, 70000),
(26, 21, 33, 'Cat Tembok - Warna Hijau', 1, 70000),
(27, 22, 4, 'Papan kayu 35 X 50 Jati ', 1, 60000),
(28, 22, 6, 'Pasir Halus 5.7m3 - 1 truck', 1, 1500000),
(29, 22, 34, 'Cat Kayu', 1, 70000),
(30, 22, 2, 'Sekop', 1, 60000),
(31, 22, 1, 'Semen Tiga Roda ', 2, 95000),
(32, 23, 4, 'Papan kayu 35 X 50 Jati ', 20, 60000),
(33, 23, 5, 'Batako', 600, 3500),
(34, 24, 32, 'Cat Tembok - Warna Merah', 1, 70000),
(35, 25, 6, 'Pasir Halus 5.7m3 - 1 truck', 1, 1500000),
(36, 25, 5, 'Batako', 200, 3500),
(37, 25, 4, 'Papan kayu 35 X 50 Jati ', 1, 60000);

--
-- Trigger `tb_pesanan`
--
DELIMITER $$
CREATE TRIGGER `pesanan_produk` AFTER INSERT ON `tb_pesanan` FOR EACH ROW BEGIN
	Update tb_produk SET stok = stok-NEW.jumlah
    where id_produk = NEW.id_produk; 
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_produk`
--

CREATE TABLE `tb_produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `kategori` varchar(60) NOT NULL,
  `harga` double NOT NULL,
  `stok` int(4) NOT NULL,
  `gambar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_produk`
--

INSERT INTO `tb_produk` (`id_produk`, `nama_produk`, `kategori`, `harga`, `stok`, `gambar`) VALUES
(1, 'Semen Tiga Roda ', 'lainnya', 95000, 198, 'sementigaroda.png'),
(2, 'Sekop', 'peralatan', 60000, 500, 'sekop.jpg'),
(3, 'Kuas Cat', 'peralatan', 15000, 600, 'kuas.jpg'),
(4, 'Papan kayu 35 X 50 Jati ', 'lainnya', 60000, 125, 'papan.jpg'),
(5, 'Batako', 'lainnya', 3500, 9197, 'batako.png'),
(6, 'Pasir Halus 5.7m3 - 1 truck', 'lainnya', 1500000, 94, '9f3fee6a6acf2feb8bd3942af7e27b1e57bda08a.jpg'),
(28, 'Cat Tembok - Warna Kuning', 'cat', 70000, 50, 'CatTembok-WarnaKuning19211122.jpeg'),
(29, 'Cat Tembok - Warna Putih', 'cat', 70000, 48, 'CatTembok-WarnaPutih19221122.jpeg'),
(30, 'Cat Tembok - Warna Hitam', 'cat', 70000, 49, 'CatTembok-WarnaHitam19221122.jpeg'),
(31, 'Cat Tembok - Warna Biru', 'cat', 70000, 49, 'CatTembok-WarnaBiru19231122.jpeg'),
(32, 'Cat Tembok - Warna Merah', 'cat', 70000, 49, 'CatTembok-WarnaMerah19241122.jpeg'),
(33, 'Cat Tembok - Warna Hijau', 'cat', 70000, 49, 'CatTembok-WarnaHijau19241122.jpeg'),
(34, 'Cat Kayu', 'cat', 70000, 49, 'da39a3ee5e6b4b0d3255bfef95601890afd807091.jpeg'),
(36, 'Sendok Semen', 'peralatan', 15000, 152, 'c1d2cad065cc3b93494e213d6b654d7254a87115.jpg'),
(37, 'Palu', 'peralatan', 40000, 450, 'da39a3ee5e6b4b0d3255bfef95601890afd80709.jpg'),
(39, 'Cat Semprot - Warna Putih', 'cat', 30000, 500, '63940142a8a9f.jpeg'),
(40, 'Cat Semprot - Warna Kuning', 'cat', 30000, 500, '63940162c9cdd.jpeg'),
(41, 'Cat Semprot - Warna Biru muda', 'cat', 30000, 500, '639401777e026.jpeg'),
(42, 'Cat Semprot - Warna Hijau', 'cat', 30000, 500, '6394019fbcf5f.jpeg'),
(43, 'Cat Semprot - Warna Oranye', 'cat', 30000, 500, '639401b0ce1d9.jpeg'),
(44, 'Cat Semprot - Warna Ungu', 'cat', 30000, 500, '639401fc125df.jpeg'),
(45, 'Cat Semprot - Warna Hitam', 'cat', 30000, 500, '6394021aac45d.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama`, `email`, `password`, `role_id`) VALUES
(1, 'Muhammad Rizki', 'admin@admin.com', '$2y$10$0w/NJjcx3Ob/tGWd4jF/PubNgpD8J5JfKKqHm4qcgZOhX9mfACEuq', 1),
(2, 'Jauhari', 'jauhari@gmail.com', '$2y$10$fjUgQ3HUTuE/L.OarmRHVuDd2woK7zm4s.YL1tEYxqYyHrWY8gGi6', 2),
(3, 'Muhammad Rizki', 'rizki10062003@gmail.com', '$2y$10$CLeSjtukFA15KmJCUMl9yuOvDSUZBtWOFgupkPT.7N24W9WNounQW', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_buktibayar`
--
ALTER TABLE `tb_buktibayar`
  ADD PRIMARY KEY (`id_bayar`),
  ADD KEY `id_invoice` (`id_invoice`);

--
-- Indeks untuk tabel `tb_invoice`
--
ALTER TABLE `tb_invoice`
  ADD PRIMARY KEY (`id_invoice`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_invoice` (`id_invoice`);

--
-- Indeks untuk tabel `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_buktibayar`
--
ALTER TABLE `tb_buktibayar`
  MODIFY `id_bayar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tb_invoice`
--
ALTER TABLE `tb_invoice`
  MODIFY `id_invoice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `tb_produk`
--
ALTER TABLE `tb_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_buktibayar`
--
ALTER TABLE `tb_buktibayar`
  ADD CONSTRAINT `tb_buktibayar_ibfk_1` FOREIGN KEY (`id_invoice`) REFERENCES `tb_invoice` (`id_invoice`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_invoice`
--
ALTER TABLE `tb_invoice`
  ADD CONSTRAINT `tb_invoice_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  ADD CONSTRAINT `tb_pesanan_ibfk_1` FOREIGN KEY (`id_invoice`) REFERENCES `tb_invoice` (`id_invoice`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_pesanan_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `tb_produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
