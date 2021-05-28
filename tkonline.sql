-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Bulan Mei 2021 pada 11.10
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tkonline`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `fullname`) VALUES
(1, 'tkonline.com', 'tkonline', 'tkonline depok');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bintang`
--

CREATE TABLE `bintang` (
  `id_bintang` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `ukur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bintang`
--

INSERT INTO `bintang` (`id_bintang`, `id_pelanggan`, `id_produk`, `ukur`) VALUES
(46, 7, 1, 3),
(47, 1, 1, 4),
(48, 9, 1, 5),
(49, 9, 10, 5),
(50, 9, 10, 5),
(51, 7, 140, 5),
(52, 9, 2, 2),
(53, 1, 2, 3),
(54, 1, 10, 4),
(55, 7, 2, 3),
(56, 7, 10, 2),
(57, 7, 11, 4),
(58, 1, 11, 3),
(59, 1, 26, 4),
(60, 1, 140, 4),
(61, 7, 12, 2),
(62, 1, 12, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `chat`
--

CREATE TABLE `chat` (
  `id_chat_user` int(11) NOT NULL,
  `id_enroll` int(11) NOT NULL,
  `id_message` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `pesan_user` text NOT NULL,
  `pesan_admin` text NOT NULL,
  `waktu_user` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `chat`
--

INSERT INTO `chat` (`id_chat_user`, `id_enroll`, `id_message`, `id_pelanggan`, `id_admin`, `pesan_user`, `pesan_admin`, `waktu_user`) VALUES
(5, 1, 0, 1, 1, 'halo admin que', '', '2021-05-23 17:00:00'),
(6, 1, 0, 7, 1, 'halo', '', '2021-05-23 17:00:00'),
(7, 6, 0, 7, 1, 'min lu ini ?', '', '2021-05-24 11:04:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `enroll`
--

CREATE TABLE `enroll` (
  `id_enroll` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `enroll`
--

INSERT INTO `enroll` (`id_enroll`, `id_admin`, `id_pelanggan`) VALUES
(1, 1, 1),
(2, 1, 1),
(1, 1, 7),
(2, 1, 7),
(3, 1, 7),
(4, 1, 7),
(5, 1, 7),
(6, 1, 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(5) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'merchandise'),
(2, 'gadget'),
(5, 'komputer');

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentar`
--

CREATE TABLE `komentar` (
  `id_komen` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama_pelanggan_komen` varchar(100) NOT NULL,
  `komentar` text NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `komentar`
--

INSERT INTO `komentar` (`id_komen`, `id_pelanggan`, `id_produk`, `nama_pelanggan_komen`, `komentar`, `tanggal`) VALUES
(8, 7, 11, 'Muhammad Rizki', 'produknya oke banget untuk dibeli!', '2021-05-12'),
(9, 7, 10, 'Muhammad Rizki', 'Ada Stiker lain tidak?', '2021-05-12'),
(13, 1, 140, 'hinandina hina', 'Produknya gk kalah bagus sama yang lain!', '2021-05-12'),
(17, 7, 10, 'muhammad rizki', 'Ada Stiker lain yang lebih bagus?', '2021-05-12'),
(18, 7, 140, 'muhammad rizki', 'Mantap bang paket nya!', '2021-05-13'),
(21, 7, 2, 'muhammad rizki', 'mantap!', '2021-05-14'),
(22, 1, 1, 'hinandina hina', 'mantap barang ini!', '2021-05-18'),
(24, 7, 11, 'muhammad rizki', 'kok stok habis sih?', '2021-05-25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `konfirmasi`
--

CREATE TABLE `konfirmasi` (
  `id_konfirmasi` int(11) NOT NULL,
  `id_pembayaran` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `bukti_barang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `konfirmasi`
--

INSERT INTO `konfirmasi` (`id_konfirmasi`, `id_pembayaran`, `id_pelanggan`, `id_produk`, `nama_pelanggan`, `jumlah`, `bukti_barang`) VALUES
(3, 16, 1, 1, 'hinandina hina', 155000, '60a34eff2940e.jpg'),
(4, 16, 1, 11, 'hinandina hina', 155000, '60a34eff2940e.jpg'),
(5, 19, 7, 1, 'muhammad rizki', 110000, '60ab66fe47536.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `message`
--

CREATE TABLE `message` (
  `id_message` int(11) NOT NULL,
  `id_enroll` int(11) NOT NULL,
  `id_chat_user` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `pesan_admin` text NOT NULL,
  `pesan_user` text NOT NULL,
  `waktu_admin` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `message`
--

INSERT INTO `message` (`id_message`, `id_enroll`, `id_chat_user`, `id_admin`, `id_pelanggan`, `pesan_admin`, `pesan_user`, `waktu_admin`) VALUES
(4, 2, 0, 1, 1, 'ya kenapa user?', '', '2021-05-23 17:00:00'),
(5, 2, 0, 1, 7, 'ya?', '', '2021-05-23 17:00:00'),
(6, 3, 0, 1, 7, 'hai', '', '2021-05-23 17:00:00'),
(7, 4, 0, 1, 7, 'hai gan', '', '2021-05-23 17:00:00'),
(8, 5, 0, 1, 7, 'hai gan gan gan', '', '2021-05-24 10:55:23'),
(9, 6, 0, 1, 7, 'gan?', '', '2021-05-24 11:05:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(5) NOT NULL,
  `nama_kota` varchar(100) NOT NULL,
  `tarif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `nama_kota`, `tarif`) VALUES
(1, 'Demak', 30000),
(2, 'Cirebon', 25000),
(3, 'Depok', 20000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `email_pelanggan` varchar(100) NOT NULL,
  `password_pelanggan` varchar(50) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `telepon_pelanggan` varchar(25) NOT NULL,
  `alamat_pelanggan` text NOT NULL,
  `foto_pelanggan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `email_pelanggan`, `password_pelanggan`, `nama_pelanggan`, `telepon_pelanggan`, `alamat_pelanggan`, `foto_pelanggan`) VALUES
(1, 'hihi@gmail.com', 'hihi456', 'hinandina hina', '178909', 'JL. Kenangan tempo doeloe', ''),
(2, 'kangen@gmail.com', 'kangen123', 'ben kangen', '179234', '', ''),
(7, 'humanrizki123@gmail.com', 'humanrizki123', 'muhammad rizki', '085691009232', 'JL lustrum FE UI no 73', 'LogoP.png'),
(9, 'udin@gmail.com', 'udin123', 'Udin Sarudin', '085212345464', 'JL, lagi dibangunNo 90', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `bukti` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pembelian`, `nama`, `bank`, `jumlah`, `tanggal`, `bukti`) VALUES
(19, 60, 'Muhammad Rizki', 'BANK INI', 110000, '2021-05-24', '20210524103909.jpg'),
(20, 61, 'Muhammad Rizki', 'BANK INI', 100000, '2021-05-28', '20210528104650.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_ongkir` int(11) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `total_pembelian` int(11) NOT NULL,
  `nama_kota` varchar(100) NOT NULL,
  `tarif` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `status_pembelian` varchar(100) NOT NULL DEFAULT 'pending',
  `resi_pengiriman` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_pelanggan`, `id_ongkir`, `tanggal_pembelian`, `total_pembelian`, `nama_kota`, `tarif`, `alamat`, `status_pembelian`, `resi_pengiriman`) VALUES
(60, 7, 1, '2021-05-22', 110000, 'Demak', 30000, '', 'sudah kirim', '962917d5'),
(61, 7, 3, '2021-05-28', 100000, 'Depok', 20000, 'JL. Lustrum FE UI no 73. KEC - PANCORANMAS', 'barang dikirim', '977d2e63');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian_produk`
--

CREATE TABLE `pembelian_produk` (
  `id_pembelian_produk` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `subberat` int(11) NOT NULL,
  `subharga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembelian_produk`
--

INSERT INTO `pembelian_produk` (`id_pembelian_produk`, `id_pembelian`, `id_produk`, `jumlah`, `nama`, `harga`, `berat`, `subberat`, `subharga`) VALUES
(72, 60, 1, 1, 'DELUX M136', 80000, 100, 100, 80000),
(73, 61, 1, 1, 'DELUX M136', 80000, 100, 100, 80000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ping`
--

CREATE TABLE `ping` (
  `id_ping` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `ping` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ping`
--

INSERT INTO `ping` (`id_ping`, `id_pelanggan`, `ping`) VALUES
(1, 1, 'gan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_kategori` int(5) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `berat_produk` int(11) NOT NULL,
  `foto_produk` varchar(100) NOT NULL,
  `deskripsi_produk` text NOT NULL,
  `stok_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `nama_produk`, `harga_produk`, `berat_produk`, `foto_produk`, `deskripsi_produk`, `stok_produk`) VALUES
(1, 4, 'DELUX M136', 80000, 100, '60954858ae3ad.png', 'Mouse Wireless Murah                                                                         ', 1),
(2, 4, 'Anne Pro 6 Mechanincal  rgb wirelesskeyboard', 300000, 1200, '60953dcca608b.png', 'Keyboard Mechanical wireless dengan warna rgb akan memperindah ruangan dan mudah dibawa kemana-mana!                                ', 3),
(10, 1, 'Stiker mini gambar PHP', 5000, 20, '6093aa7126b00.png', 'Stiker bagus untuk laptop ataupun benda lain                                                                                                                                                ', 3),
(11, 1, 'OTODIDAK PROGRAMMING PYTHON', 50000, 1000, '60954b13a4784.png', 'Buku yang akan membantu untuk belajar bahasa python secara otodidak dirumah anda!                                            ', 0),
(12, 1, 'T-SHIRT PYTHON', 150000, 145, '6095378e24080.png', 'T-SHIRT yang bagus untuk programmer zaman kini!                ', 5),
(26, 1, 'HOODIE PYTHON', 175000, 250, '609538cbb2404.png', 'HOODIE keren untuk programmer PYTHON dan untuk dipakai setiap kondisi juga ok                ', 5),
(27, 1, 'Topi Snapback PYTHON', 80000, 180, '609539d8cdb03.png', 'Topi yang cocok untuk identitas programmer PYTHON!                ', 5),
(28, 1, 'PYTHON BACKPACKS', 130000, 350, '60953c165bd32.png', 'BACKPACK yang bagus dan dengan warna yang cerah untuk digunakan!                ', 3),
(140, 1, 'Merchandise Python', 250000, 800, '6099e46fbfb8b.jpg', 'Merchandise hoodie dan tshirt                                ', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk_foto`
--

CREATE TABLE `produk_foto` (
  `id_produk_foto` int(11) NOT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `nama_produk_foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk_foto`
--

INSERT INTO `produk_foto` (`id_produk_foto`, `id_produk`, `nama_produk_foto`) VALUES
(25, 140, '6099e46fbfb8b.jpg'),
(29, 140, '60a490363bc52.png'),
(30, 140, '60a49053554c5.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `reply`
--

CREATE TABLE `reply` (
  `id_reply` int(11) NOT NULL,
  `id_komen` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `yang_balas` varchar(100) NOT NULL,
  `reply_komentar` text NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `reply`
--

INSERT INTO `reply` (`id_reply`, `id_komen`, `id_pelanggan`, `yang_balas`, `reply_komentar`, `tanggal`) VALUES
(1, 0, 7, '0', 'Ya betul itu!', '2021-05-12'),
(2, 6, 7, '0', 'Sepertinya masukan anda benar!', '2021-05-12'),
(3, 6, 7, '0', 'harus up', '2021-05-12'),
(4, 7, 1, '0', 'Harus banget, soalnya saya suka paket lengkap ini!', '2021-05-12'),
(6, 12, 7, 'Muhammad Rizki', 'bener banget bund', '2021-05-12'),
(12, 18, 9, 'Udin Sarudin', 'Betul kali itu!', '2021-05-13');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `bintang`
--
ALTER TABLE `bintang`
  ADD PRIMARY KEY (`id_bintang`);

--
-- Indeks untuk tabel `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id_chat_user`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id_komen`);

--
-- Indeks untuk tabel `konfirmasi`
--
ALTER TABLE `konfirmasi`
  ADD PRIMARY KEY (`id_konfirmasi`);

--
-- Indeks untuk tabel `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id_message`);

--
-- Indeks untuk tabel `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indeks untuk tabel `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  ADD PRIMARY KEY (`id_pembelian_produk`);

--
-- Indeks untuk tabel `ping`
--
ALTER TABLE `ping`
  ADD PRIMARY KEY (`id_ping`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `produk_foto`
--
ALTER TABLE `produk_foto`
  ADD PRIMARY KEY (`id_produk_foto`);

--
-- Indeks untuk tabel `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`id_reply`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `bintang`
--
ALTER TABLE `bintang`
  MODIFY `id_bintang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT untuk tabel `chat`
--
ALTER TABLE `chat`
  MODIFY `id_chat_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id_komen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `konfirmasi`
--
ALTER TABLE `konfirmasi`
  MODIFY `id_konfirmasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `message`
--
ALTER TABLE `message`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT untuk tabel `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  MODIFY `id_pembelian_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT untuk tabel `ping`
--
ALTER TABLE `ping`
  MODIFY `id_ping` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT untuk tabel `produk_foto`
--
ALTER TABLE `produk_foto`
  MODIFY `id_produk_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `reply`
--
ALTER TABLE `reply`
  MODIFY `id_reply` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
