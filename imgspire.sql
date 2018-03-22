-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 22 mrt 2018 om 16:01
-- Serverversie: 10.1.19-MariaDB
-- PHP-versie: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `imgspire`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES
(1, 'Arne', '$2y$12$BMJZljNo3DTa0xvSlwt.gOudrd7JW8Dg88.351OmPF.WPUpNsEG86', 'arneberckmans@telenet.be'),
(4, 'Arne2', '$2y$12$D09Sj9LlDuO4uGbxCyMhNOLP..ROHzZACs8W1efQoow/MoSG/Lp8S', 'test@telenet.be'),
(6, 'Arne3', '$2y$12$cy3tHVH/zgP18.Tu1pMg.Ov/whyU6HeGdDmRHpuAQr54N5BgjjUvS', 'joris.hens@thomasmore.be'),
(7, 'test3', '$2y$12$M0VKlEp/rBSu6BWzDXV5yOxmNT0lNdUcLe4H1Y3TLTtjVGde5EZtG', 'test3@telenet.be'),
(8, 'test4', '$2y$12$khAzG7il9VnyNbDzOeVDaOCLY.yjCP6T8zZ9nInCBUUF2oLeIOfd2', 'test4@telenet.be');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
