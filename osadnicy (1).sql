-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 07 Gru 2015, 18:50
-- Wersja serwera: 10.0.17-MariaDB
-- Wersja PHP: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `osadnicy`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` int(11) NOT NULL,
  `user` text COLLATE utf8_polish_ci NOT NULL,
  `pass` text COLLATE utf8_polish_ci NOT NULL,
  `email` text COLLATE utf8_polish_ci NOT NULL,
  `drewno` int(11) NOT NULL,
  `kamien` int(11) NOT NULL,
  `zboze` int(11) NOT NULL,
  `kwadrat` int(11) NOT NULL,
  `trojkat` int(11) NOT NULL,
  `sinus` int(11) NOT NULL,
  `dnipremium` int(11) NOT NULL,
  `wioska` tinyint(1) NOT NULL,
  `ostatnielogowanie` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `user`, `pass`, `email`, `drewno`, `kamien`, `zboze`, `kwadrat`, `trojkat`, `sinus`, `dnipremium`, `wioska`, `ostatnielogowanie`) VALUES
(49, 'Bobi', '1', '1', 16687, 16687, 16687, 0, 0, 0, 100, 1, '2015-12-07 18:36:12'),
(48, 'Andrzej', '1', '1', 100, 100, 100, 0, 0, 0, 100, 1, '2015-12-05 20:31:26'),
(46, '1', '1', '1', 822050, 169146, 90885, 66, 98, 118, 100, 1, '2015-12-07 18:50:07'),
(47, '4', '4', '4', 100, 100, 100, 0, 0, 0, 100, 1, '2015-12-05 19:56:42'),
(50, 'NaprawdeSeksownyMurzyn', '1', '1', 100, 100, 100, 0, 0, 10, 100, 1, '2015-12-06 20:44:49'),
(58, '&#039; OR id=7 -- ', '1', '1', 100, 100, 100, 0, 0, 10, 100, 0, '2015-12-06 22:10:11'),
(52, 'MartwaSroka', '1', '1', 100, 100, 100, 0, 0, 10, 100, 0, '2015-12-06 22:06:47'),
(53, 'Kot', '1', '1', 100, 100, 100, 0, 0, 10, 100, 0, '2015-12-06 22:07:03'),
(54, 'Szredrixon', '1', '1', 100, 100, 100, 0, 0, 10, 100, 0, '2015-12-06 22:07:14'),
(55, 'BoberCraft', '1', '1', 100, 100, 100, 0, 0, 10, 100, 0, '2015-12-06 22:07:22'),
(56, 'Muszyna', '1', '1', 100, 100, 100, 0, 0, 10, 100, 0, '2015-12-06 22:07:31'),
(57, '( Í¡&deg; ÍœÊ– Í¡&deg;)', '1', '1', 100, 100, 100, 0, 0, 10, 100, 1, '2015-12-06 22:07:46');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wioska`
--

CREATE TABLE `wioska` (
  `id` int(11) NOT NULL,
  `idgracza` int(11) NOT NULL,
  `kamien` int(11) NOT NULL,
  `zboze` int(11) NOT NULL,
  `drewno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `wioska`
--

INSERT INTO `wioska` (`id`, `idgracza`, `kamien`, `zboze`, `drewno`) VALUES
(25, 46, 11, 7, 49),
(26, 48, 1, 1, 1),
(27, 49, 1, 1, 1),
(28, 47, 1, 1, 1),
(29, 50, 1, 1, 1),
(30, 57, 1, 1, 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `wioska`
--
ALTER TABLE `wioska`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT dla tabeli `wioska`
--
ALTER TABLE `wioska`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
