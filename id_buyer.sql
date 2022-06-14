-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Jun 2022 pada 14.00
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id_buyer`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `idAdmin` int(10) NOT NULL,
  `namaAdmin` varchar(250) NOT NULL,
  `usernameAdmin` varchar(250) NOT NULL,
  `passwordAdmin` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`idAdmin`, `namaAdmin`, `usernameAdmin`, `passwordAdmin`) VALUES
(1, 'Admin Default', 'admin', 'c93ccd78b2076528346216b3b2f701e6'),
(2, 'Rifan Setiadi', 'rifanstd', '3252ee5e44ad3a2d44d1d2abc0562814');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `idBarang` int(10) NOT NULL,
  `namaBarang` varchar(250) NOT NULL,
  `stokBarang` int(10) NOT NULL,
  `hargaBarang` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`idBarang`, `namaBarang`, `stokBarang`, `hargaBarang`) VALUES
(2, 'Baju Koko Adira Anak', 20, 100000),
(3, 'Gamis Srikandi Wanita', 19, 200000),
(4, 'Batik Jogja', 24, 250000),
(5, 'Baju Koko Pria Dewasa Nurmala', 70, 90000),
(6, 'Batik Solo', 60, 110000),
(8, 'Gamis Pria Sukadamai', 50, 120000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `idDetailTransaksi` int(10) NOT NULL,
  `idTransaksi` int(10) NOT NULL,
  `idBarang` int(10) NOT NULL,
  `namaBarang` varchar(250) NOT NULL,
  `jumlahBarang` int(10) NOT NULL,
  `hargaBarang` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`idDetailTransaksi`, `idTransaksi`, `idBarang`, `namaBarang`, `jumlahBarang`, `hargaBarang`) VALUES
(1, 1, 4, 'Batik Jogja', 1, 250000),
(2, 2, 5, 'Baju Koko Pria Dewasa Nurmala', 1, 90000),
(3, 3, 4, 'Batik Jogja', 12, 3000000),
(4, 4, 5, 'Baju Koko Pria Dewasa Nurmala', 12, 1080000),
(5, 5, 2, 'Baju Koko Adira Anak', 3, 300000),
(6, 5, 3, 'Gamis Srikandi Wanita', 1, 200000),
(7, 5, 4, 'Batik Jogja', 1, 250000),
(8, 5, 5, 'Baju Koko Pria Dewasa Nurmala', 1, 90000),
(9, 5, 6, 'Batik Solo', 1, 110000),
(11, 6, 4, 'Batik Jogja', 12, 3000000),
(12, 7, 4, 'Batik Jogja', 1, 250000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kasir`
--

CREATE TABLE `kasir` (
  `idKasir` int(10) NOT NULL,
  `namaKasir` varchar(250) NOT NULL,
  `usernameKasir` varchar(250) NOT NULL,
  `passwordKasir` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kasir`
--

INSERT INTO `kasir` (`idKasir`, `namaKasir`, `usernameKasir`, `passwordKasir`) VALUES
(1, 'Annisa Urbaningrum', 'annisa_urbaningrum', '9c8fd0dbc977cfe7c220df917d402e9d'),
(2, 'Alif Akbar', 'alifakbar', 'cc381ce13dd0bd2f5dd3ec67aac562ce'),
(3, 'Daffa Putra', 'daffa', '42cf60b1b952d5d6c6ceeb1781af0a91');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `idTransaksi` int(10) NOT NULL,
  `idKasir` int(10) NOT NULL,
  `tanggalTransaksi` varchar(250) NOT NULL,
  `jumlahBarang` int(10) NOT NULL,
  `totalHarga` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`idTransaksi`, `idKasir`, `tanggalTransaksi`, `jumlahBarang`, `totalHarga`) VALUES
(1, 1, '2022-06-01', 1, 250000),
(2, 1, '2022-06-01', 1, 90000),
(3, 1, '2022-06-01', 12, 3000000),
(4, 1, '2022-06-01', 12, 1080000),
(5, 1, '2022-06-01', 7, 950000),
(6, 1, '2022-06-02', 12, 3000000),
(7, 1, '2022-06-14', 1, 250000);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idAdmin`);

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`idBarang`);

--
-- Indeks untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`idDetailTransaksi`);

--
-- Indeks untuk tabel `kasir`
--
ALTER TABLE `kasir`
  ADD PRIMARY KEY (`idKasir`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`idTransaksi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `idAdmin` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `idBarang` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `idDetailTransaksi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `kasir`
--
ALTER TABLE `kasir`
  MODIFY `idKasir` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `idTransaksi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
