-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 01 Oca 2019, 18:08:27
-- Sunucu sürümü: 5.7.24-0ubuntu0.18.04.1
-- PHP Sürümü: 7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `kurskayit`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `acilankurslar`
--

CREATE TABLE `acilankurslar` (
  `id` int(11) NOT NULL,
  `kursid` int(11) NOT NULL,
  `donemid` int(11) NOT NULL,
  `seviyeid` int(11) NOT NULL,
  `oturumid` int(11) NOT NULL,
  `kontenjanSayisi` int(11) NOT NULL,
  `olusturmaTarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `bolum`
--

CREATE TABLE `bolum` (
  `id` int(11) NOT NULL,
  `bolum` varchar(255) NOT NULL,
  `olusturmaTarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `bolum`
--

INSERT INTO `bolum` (`id`, `bolum`, `olusturmaTarihi`) VALUES
(11, 'Bilgisayar MÃ¼h.', '2018-12-22 20:37:07'),
(12, 'MimarlÄ±k', '2018-12-22 20:37:16'),
(13, 'Grafik TasarÄ±m', '2018-12-22 20:37:21'),
(14, 'Psikoloji', '2018-12-22 20:37:30'),
(15, 'Ä°nÅŸaat MÃ¼hendisliÄŸi', '2018-12-29 14:39:38');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `donem`
--

CREATE TABLE `donem` (
  `id` int(11) NOT NULL,
  `donem` varchar(255) NOT NULL,
  `olusturmaTarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `guncellemeTarihi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `donem`
--

INSERT INTO `donem` (`id`, `donem`, `olusturmaTarihi`, `guncellemeTarihi`) VALUES
(13, '2018 GÃ¼z', '2018-12-22 20:41:08', ''),
(14, '2019 Bahar', '2018-12-22 20:41:16', ''),
(15, '2019 GÃ¼z', '2018-12-22 20:41:23', ''),
(16, '2020 GÃ¼z', '2018-12-29 14:39:26', '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `giriskayitlari`
--

CREATE TABLE `giriskayitlari` (
  `id` int(11) NOT NULL,
  `ogrenciNo` varchar(255) NOT NULL,
  `kullaniciIP` binary(16) NOT NULL,
  `girisZamani` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cikisZamani` varchar(255) NOT NULL,
  `durumBilgisi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kayitlikurslar`
--

CREATE TABLE `kayitlikurslar` (
  `id` int(11) NOT NULL,
  `ogrenciNo` varchar(255) NOT NULL,
  `pinKodu` varchar(255) NOT NULL,
  `acilankursid` int(11) NOT NULL,
  `kayitTarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kurs`
--

CREATE TABLE `kurs` (
  `id` int(11) NOT NULL,
  `bolumid` int(11) NOT NULL,
  `kursKodu` varchar(255) NOT NULL,
  `kursAdi` varchar(255) NOT NULL,
  `olusturmaTarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `guncellemeTarihi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ogrenciler`
--

CREATE TABLE `ogrenciler` (
  `ogrenciNo` varchar(255) NOT NULL,
  `parola` varchar(255) NOT NULL,
  `ogrenciAdi` varchar(255) NOT NULL,
  `pinKodu` varchar(255) NOT NULL,
  `akts` decimal(10,2) NOT NULL,
  `olusturmaTarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `guncellemeTarihi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `ogrenciler`
--

INSERT INTO `ogrenciler` (`ogrenciNo`, `parola`, `ogrenciAdi`, `pinKodu`, `akts`, `olusturmaTarihi`, `guncellemeTarihi`) VALUES
('1', '785fcd6fb525282980fce84679f8c6d2', 'Mithat', '928916', '0.00', '2018-12-14 18:42:52', ''),
('2', '8f10d078b2799206cfe914b32cc6a5e9', 'Temel', '979319', '3.20', '2018-12-14 18:43:00', '21-12-2018 04:51:12 PM'),
('3', '8f10d078b2799206cfe914b32cc6a5e9', 'Dursun', '188737', '0.00', '2018-12-14 18:43:06', '24-12-2018 11:36:43 PM'),
('30116010', '8f10d078b2799206cfe914b32cc6a5e9', 'Muhammed Ã–ztÃ¼rk', '582027', '4.00', '2018-12-04 09:48:34', ''),
('30116069', '8f10d078b2799206cfe914b32cc6a5e9', 'Artan Skorra', '957704', '0.00', '2018-12-20 11:32:04', ''),
('4', '8f10d078b2799206cfe914b32cc6a5e9', 'Ahmet', '171754', '0.00', '2018-12-24 20:03:12', ''),
('5', '8f10d078b2799206cfe914b32cc6a5e9', 'TÃ¼tÃ¼n Sabri', '651788', '0.00', '2018-12-24 20:42:58', '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `oturum`
--

CREATE TABLE `oturum` (
  `id` int(11) NOT NULL,
  `oturum` varchar(255) NOT NULL,
  `olusturmaTarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `oturum`
--

INSERT INTO `oturum` (`id`, `oturum`, `olusturmaTarihi`) VALUES
(14, 'AkÅŸam (15.30-17.30)', '2018-12-25 20:06:07'),
(15, 'Sabah (9.30-11.30)', '2018-12-25 20:06:23'),
(17, 'Ã–ÄŸle (13.30-15.30)', '2018-12-25 20:07:02');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `seviye`
--

CREATE TABLE `seviye` (
  `id` int(11) NOT NULL,
  `seviye` varchar(255) NOT NULL,
  `olusturmaTarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `seviye`
--

INSERT INTO `seviye` (`id`, `seviye`, `olusturmaTarihi`) VALUES
(13, 'Orta', '2018-12-25 19:40:58'),
(14, 'Profesyonel', '2018-12-25 19:41:07'),
(16, 'BaÅŸlangÄ±Ã§', '2018-12-25 19:41:20');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `soruncozumleri`
--

CREATE TABLE `soruncozumleri` (
  `id` int(11) NOT NULL,
  `sorunid` int(11) NOT NULL,
  `yoneticiid` int(11) NOT NULL,
  `cozumaciklamasi` text NOT NULL,
  `eklemeTarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sorunlar`
--

CREATE TABLE `sorunlar` (
  `id` int(11) NOT NULL,
  `ogrenciNo` varchar(255) NOT NULL,
  `sorun` text NOT NULL,
  `durum` tinyint(1) NOT NULL,
  `eklemeTarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `sorunlar`
--

INSERT INTO `sorunlar` (`id`, `ogrenciNo`, `sorun`, `durum`, `eklemeTarihi`) VALUES
(8, '5', 'Sorun var sorun', 0, '2019-01-01 17:18:59'),
(10, '5', 'Hocam kurs kayÄ±t kÄ±smÄ±nda ufak bir problem var ilgilenebilir misiniz?', 0, '2019-01-01 17:19:05'),
(11, '5', 'Hayale AldandÄ±m BoÅŸuna YandÄ±m', 0, '2019-01-01 17:19:08'),
(12, '5', 'Yapma hoca yanarÄ±zzzz', 0, '2019-01-01 17:19:15');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yonetici`
--

CREATE TABLE `yonetici` (
  `id` int(11) NOT NULL,
  `kullaniciadi` varchar(255) NOT NULL,
  `parola` varchar(255) NOT NULL,
  `olusturmaTarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `guncellemeTarihi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `yonetici`
--

INSERT INTO `yonetici` (`id`, `kullaniciadi`, `parola`, `olusturmaTarihi`, `guncellemeTarihi`) VALUES
(1, 'deneme', '8f10d078b2799206cfe914b32cc6a5e9', '2017-01-24 16:21:18', '30-12-2018 11:58:15 AM');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `acilankurslar`
--
ALTER TABLE `acilankurslar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_donemkursdonemleri` (`donemid`),
  ADD KEY `fk_kurskursdonemleri` (`kursid`),
  ADD KEY `fk_seviyekursdonemleri` (`seviyeid`),
  ADD KEY `fk_oturumkursdonemleri` (`oturumid`);

--
-- Tablo için indeksler `bolum`
--
ALTER TABLE `bolum`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `donem`
--
ALTER TABLE `donem`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `giriskayitlari`
--
ALTER TABLE `giriskayitlari`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ogrencilergiriskayitlari` (`ogrenciNo`);

--
-- Tablo için indeksler `kayitlikurslar`
--
ALTER TABLE `kayitlikurslar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ogrencigiriskayitlari` (`ogrenciNo`),
  ADD KEY `fk_acilankurslarkayitlikurslar` (`acilankursid`);

--
-- Tablo için indeksler `kurs`
--
ALTER TABLE `kurs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_bolumkurs` (`bolumid`);

--
-- Tablo için indeksler `ogrenciler`
--
ALTER TABLE `ogrenciler`
  ADD PRIMARY KEY (`ogrenciNo`);

--
-- Tablo için indeksler `oturum`
--
ALTER TABLE `oturum`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `seviye`
--
ALTER TABLE `seviye`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `soruncozumleri`
--
ALTER TABLE `soruncozumleri`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_yoneticisoruncozumleri` (`yoneticiid`),
  ADD KEY `fk_sorunlarsoruncozumleri` (`sorunid`);

--
-- Tablo için indeksler `sorunlar`
--
ALTER TABLE `sorunlar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ogrencilersorunlar` (`ogrenciNo`);

--
-- Tablo için indeksler `yonetici`
--
ALTER TABLE `yonetici`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `acilankurslar`
--
ALTER TABLE `acilankurslar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Tablo için AUTO_INCREMENT değeri `bolum`
--
ALTER TABLE `bolum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Tablo için AUTO_INCREMENT değeri `donem`
--
ALTER TABLE `donem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- Tablo için AUTO_INCREMENT değeri `giriskayitlari`
--
ALTER TABLE `giriskayitlari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `kayitlikurslar`
--
ALTER TABLE `kayitlikurslar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- Tablo için AUTO_INCREMENT değeri `kurs`
--
ALTER TABLE `kurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- Tablo için AUTO_INCREMENT değeri `oturum`
--
ALTER TABLE `oturum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- Tablo için AUTO_INCREMENT değeri `seviye`
--
ALTER TABLE `seviye`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- Tablo için AUTO_INCREMENT değeri `soruncozumleri`
--
ALTER TABLE `soruncozumleri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Tablo için AUTO_INCREMENT değeri `sorunlar`
--
ALTER TABLE `sorunlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Tablo için AUTO_INCREMENT değeri `yonetici`
--
ALTER TABLE `yonetici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `acilankurslar`
--
ALTER TABLE `acilankurslar`
  ADD CONSTRAINT `fk_donemkursdonemleri` FOREIGN KEY (`donemid`) REFERENCES `donem` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_kurskursdonemleri` FOREIGN KEY (`kursid`) REFERENCES `kurs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_oturumkursdonemleri` FOREIGN KEY (`oturumid`) REFERENCES `oturum` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_seviyekursdonemleri` FOREIGN KEY (`seviyeid`) REFERENCES `seviye` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `giriskayitlari`
--
ALTER TABLE `giriskayitlari`
  ADD CONSTRAINT `fk_ogrencilergiriskayitlari` FOREIGN KEY (`ogrenciNo`) REFERENCES `ogrenciler` (`ogrenciNo`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `kayitlikurslar`
--
ALTER TABLE `kayitlikurslar`
  ADD CONSTRAINT `fk_acilankurslarkayitlikurslar` FOREIGN KEY (`acilankursid`) REFERENCES `acilankurslar` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_ogrencikayitlikurslar` FOREIGN KEY (`ogrenciNo`) REFERENCES `ogrenciler` (`ogrenciNo`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `kurs`
--
ALTER TABLE `kurs`
  ADD CONSTRAINT `fk_bolumkurs` FOREIGN KEY (`bolumid`) REFERENCES `bolum` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `soruncozumleri`
--
ALTER TABLE `soruncozumleri`
  ADD CONSTRAINT `fk_sorunlarsoruncozumleri` FOREIGN KEY (`sorunid`) REFERENCES `sorunlar` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_yoneticisoruncozumleri` FOREIGN KEY (`yoneticiid`) REFERENCES `yonetici` (`id`);

--
-- Tablo kısıtlamaları `sorunlar`
--
ALTER TABLE `sorunlar`
  ADD CONSTRAINT `fk_ogrencilersorunlar` FOREIGN KEY (`ogrenciNo`) REFERENCES `ogrenciler` (`ogrenciNo`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
