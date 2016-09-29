-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 29 Wrz 2016, 18:00
-- Wersja serwera: 10.1.16-MariaDB
-- Wersja PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `dictionary`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `eng`
--

CREATE TABLE `eng` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `EXAMPLE` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_520_ci;

--
-- Zrzut danych tabeli `eng`
--

INSERT INTO `eng` (`ID`, `NAME`, `EXAMPLE`) VALUES
(1, 'use', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pl`
--

CREATE TABLE `pl` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `EXAMPLE` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_520_ci;

--
-- Zrzut danych tabeli `pl`
--

INSERT INTO `pl` (`ID`, `NAME`, `EXAMPLE`) VALUES
(1, 'używać', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `translation`
--

CREATE TABLE `translation` (
  `ID_PL` int(11) NOT NULL,
  `ID_ENG` int(11) NOT NULL,
  `ID_TYPE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_520_ci;

--
-- Zrzut danych tabeli `translation`
--

INSERT INTO `translation` (`ID_PL`, `ID_ENG`, `ID_TYPE`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `type`
--

CREATE TABLE `type` (
  `ID_TYPE` int(11) NOT NULL,
  `TYPE` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `type`
--

INSERT INTO `type` (`ID_TYPE`, `TYPE`) VALUES
(1, 'czasownik');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `eng`
--
ALTER TABLE `eng`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `pl`
--
ALTER TABLE `pl`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `translation`
--
ALTER TABLE `translation`
  ADD KEY `ID_PL` (`ID_PL`),
  ADD KEY `ID_ENG` (`ID_PL`),
  ADD KEY `ID_TYPE` (`ID_TYPE`),
  ADD KEY `eng` (`ID_ENG`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`ID_TYPE`);

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `translation`
--
ALTER TABLE `translation`
  ADD CONSTRAINT `eng` FOREIGN KEY (`ID_ENG`) REFERENCES `eng` (`ID`),
  ADD CONSTRAINT `pl` FOREIGN KEY (`ID_PL`) REFERENCES `pl` (`ID`),
  ADD CONSTRAINT `type` FOREIGN KEY (`ID_TYPE`) REFERENCES `type` (`ID_TYPE`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
