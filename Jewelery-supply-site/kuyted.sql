-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 07 May 2024, 21:40:22
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `kuyted`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `bank`
--

CREATE TABLE `bank` (
  `id` int(25) NOT NULL,
  `user_id` int(25) NOT NULL,
  `currency_type` varchar(255) NOT NULL,
  `amount` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `bank`
--

INSERT INTO `bank` (`id`, `user_id`, `currency_type`, `amount`) VALUES
(2, 1, 'USD', 134),
(3, 2, 'USD', 60),
(9, 1, 'gram-altin', 14);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `islemler`
--

CREATE TABLE `islemler` (
  `id` int(25) NOT NULL,
  `user_id` int(25) DEFAULT NULL,
  `currency_type` varchar(50) NOT NULL,
  `sale_price` decimal(10,2) NOT NULL,
  `quantity` int(25) NOT NULL,
  `transaction_date` datetime DEFAULT current_timestamp(),
  `api_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `islemler`
--

INSERT INTO `islemler` (`id`, `user_id`, `currency_type`, `sale_price`, `quantity`, `transaction_date`, `api_price`) VALUES
(13, 1, 'gram-altin', 2450.00, 2, '2024-05-05 22:40:00', 2390.00),
(14, 1, '22-ayar-bilezik', 2250.00, 3, '2024-05-06 22:35:05', 2222.00),
(15, 1, 'USD', 35.00, 10, '2024-05-07 21:21:23', 32.00),
(19, 1, 'USD', 35.00, 10, '2024-05-07 21:54:30', 32.00);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar`
--

CREATE TABLE `kullanicilar` (
  `id` int(25) NOT NULL,
  `name` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kullanicilar`
--

INSERT INTO `kullanicilar` (`id`, `name`, `mail`, `password`) VALUES
(1, 'Irmak', 'irmak@hotmail.com', '827ccb0eea8a706c4c34a16891f84e7b'),
(2, 'Damla', 'damla@hotmail.com', '827ccb0eea8a706c4c34a16891f84e7b'),
(3, 'bartın', 'irmak@hotmail.com', 'f2a82b680211fbd592ccec421366d4d0'),
(4, 'ırmak', 'irmak@hotmail.com', 'd447ddfe50dbaeea98e9be267e2375c2'),
(5, 'ırmak', 'irmak@hotmail.com', '6b4017c4c626882acb363d25dbb6f3c0');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `islemler`
--
ALTER TABLE `islemler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kullanicilar`
--
ALTER TABLE `kullanicilar`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `islemler`
--
ALTER TABLE `islemler`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar`
--
ALTER TABLE `kullanicilar`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
