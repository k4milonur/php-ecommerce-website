-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 12 May 2020, 18:29:05
-- Sunucu sürümü: 10.3.16-MariaDB
-- PHP Sürümü: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `id13531857_ceng`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kategoriler`
--

CREATE TABLE `kategoriler` (
  `id` int(11) NOT NULL,
  `kategori` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `aciklama` varchar(99) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Kategori Açıklaması'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `kategoriler`
--

INSERT INTO `kategoriler` (`id`, `kategori`, `aciklama`) VALUES
(1, 'Genel', 'Genel Ürünler'),
(3, 'Donanım', 'İşlemci, RAM, Ekran Kartı vb. Ürünler'),
(5, 'Çevre Birimleri', 'Klavye Mouse Kulaklık Ürünleri'),
(6, 'Yazılım', 'Yazılım Ürünleri');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urunler`
--

CREATE TABLE `urunler` (
  `id` int(11) NOT NULL,
  `title` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(99) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(100) COLLATE utf8_unicode_ci DEFAULT 'default.jpg',
  `kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `urunler`
--

INSERT INTO `urunler` (`id`, `title`, `description`, `price`, `image`, `kategori`) VALUES
(31, 'Ürün 1', 'Ürün 1 Ürün 1 Ürün 1 Ürün 1 ', 11, 'default.jpg', 1),
(34, 'Kaspersky', 'Anti Virüs Yazılımı', 300, '418eb17b2d0ec8be101011542a8e246b.jpeg', 6),
(36, 'Akıllı Saat', 'Android Akıllı Saat', 199, 'akillisaat.jpg', 1),
(37, 'Akıllı Bileklik', 'Genel Kullanım Akıllı Bileklik', 99, 'bileklik.jpg', 1),
(38, 'Akıllı Çocuk Saati', 'Pembe Akıllı Çocuk Saati', 149, 'cocuksaati.jpg', 1),
(39, 'Nem Ölçer', 'Xiaomi Nem ve Sıcaklık Ölçer', 59, 'nemolcer.jpg', 1),
(40, 'Self Tracker', 'Bluetooth Özellikli Takip Cihazı', 119, 'takipcihazi.jpg', 1),
(41, 'Sandisk SSD', '480 Gigabyte Sandisk SSD', 500, 'ssdsandisk480gb.jpg', 3),
(42, 'AMD R3 İşlemci', 'AMD Ryzen 3 Serisi İşlemci', 999, 'amd-ryzen-3.jpg', 3),
(43, 'GSKILL 16GB RAM', 'Gskill 16GB Ram 2x8', 700, 'gskill16gbram.jpg', 3),
(44, 'EVGA Sıvı Soğutma', 'EVGA Sıvı Soğutma Kiti', 700, 'evgasivisogutma.jpg', 3),
(45, 'Intel i3 9100', '9. Nesi Intel i3 İşlemci', 900, 'i3-9100.jpg', 3),
(46, 'RTX 2080Ti', 'Asus RTX2080Ti Ekran Kartı', 5999, 'rtx2080ti.jpg', 3),
(47, 'Radeon 5700XT', 'AMD Radeon 5700XT Grafik Kartı', 3000, 'radeon5700xt.jpg', 3),
(48, 'Arctis3', 'SteelSeries Arctis Kulaklık', 499, 'kulaklik1.jpg', 5),
(49, 'MSI GK30', 'MSI Marka GK30 Klavye', 499, 'klavye1.jpg', 5),
(50, 'Logitech G403', 'Logitech Kablolu Oyuncu Faresi', 499, 'mouse2.jpg', 5),
(51, 'Corsair Elite', 'Corsair Elite Kablolu Kulaklık', 799, 'kulaklik2.jpg', 5),
(52, 'HyperX Mouse', 'HyperX RGB Işıklı Mouse', 459, 'mouse.jpg', 5),
(53, 'SteelSeries Apex', 'SteelSeries Gaming Keyboard', 999, 'klavye2.jpg', 5),
(54, 'KasperSky Lab.', 'Kaspersky Lab Antivirüs', 199, 'kaspersky-antiv-logo.png', 6),
(55, 'Norton AntiVirüs', 'Norton AntiVirüs 1 Yıllık Kullanım', 99, 'norton.jpg', 6),
(56, 'Eset Antivirüs', 'Eset Nod32 Antivirüs', 300, 'eset.jpg', 6),
(57, 'Bit Defender', 'Bit Defendir AntiVirüs', 250, 'bitdefendrlogo.png', 6);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `kullanici_adi` varchar(21) COLLATE utf8_unicode_ci NOT NULL,
  `isim_soyisim` varchar(49) COLLATE utf8_unicode_ci NOT NULL,
  `sifre` varchar(21) COLLATE utf8_unicode_ci NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 1,
  `telefon` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adres` varchar(99) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(49) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook` varchar(99) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter` varchar(99) COLLATE utf8_unicode_ci DEFAULT NULL,
  `instagram` varchar(99) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(99) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `kullanici_adi`, `isim_soyisim`, `sifre`, `admin`, `telefon`, `adres`, `email`, `facebook`, `twitter`, `instagram`, `website`) VALUES
(1, 'k4milonur', 'Kamil Onur Algan', 'admin', 0, '05321363048', 'Muğla Sıtkı Koçman Üniversitesi Biyoinformatik Anabilim Dalı', 'k4milonur@gmail.com', 'k4milonur', 'k4milonur', 'k4milonur', 'https://k4milonur.com'),
(2, 'yeniuser', 'Yeni User İsim', '123456', 1, '', '', '', '', '', '', ''),
(3, 'dyalcin', 'Dilara Yalcin', '123456', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'dilarayalcin', 'Dilara Yalçın', '1234', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'gurhan', 'gurhan gunduz', '123456', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'Topalpanda', 'Doğan Çiğnaklı', 'Aslanmax26!', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `kategoriler`
--
ALTER TABLE `kategoriler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `urunler`
--
ALTER TABLE `urunler`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategori` (`kategori`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kullanici_adi` (`kullanici_adi`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `kategoriler`
--
ALTER TABLE `kategoriler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Tablo için AUTO_INCREMENT değeri `urunler`
--
ALTER TABLE `urunler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `urunler`
--
ALTER TABLE `urunler`
  ADD CONSTRAINT `kategori_iliski` FOREIGN KEY (`kategori`) REFERENCES `kategoriler` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
