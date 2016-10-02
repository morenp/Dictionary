-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 02 Paź 2016, 22:35
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
(1, 'use', NULL),
(2, 'vastly', NULL),
(3, 'surpass', NULL);

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
(1, 'używać', NULL),
(2, 'znacznie', NULL),
(3, 'przewyższać', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `translation`
--

CREATE TABLE `translation` (
  `ID` int(11) NOT NULL,
  `ID_PL` int(11) NOT NULL,
  `ID_ENG` int(11) NOT NULL,
  `ID_TYPE` int(11) NOT NULL,
  `User_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_520_ci;

--
-- Zrzut danych tabeli `translation`
--

INSERT INTO `translation` (`ID`, `ID_PL`, `ID_ENG`, `ID_TYPE`, `User_ID`) VALUES
(1, 1, 1, 1, 1),
(2, 2, 2, 4, 1),
(3, 3, 3, 1, 1);

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
(1, 'czasownik'),
(2, 'rzeczownik'),
(3, 'przymiotnik'),
(4, 'przysłówek');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `ID` int(10) NOT NULL,
  `name` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `premium_days` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_520_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`ID`, `name`, `pass`, `email`, `premium_days`) VALUES
(1, 'MorenP', 'kkk', 'marcin2523@o2.pl', 30);

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
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_PL` (`ID_PL`),
  ADD KEY `ID_ENG` (`ID_PL`),
  ADD KEY `ID_TYPE` (`ID_TYPE`),
  ADD KEY `eng` (`ID_ENG`),
  ADD KEY `user_ID` (`User_ID`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`ID_TYPE`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `translation`
--
ALTER TABLE `translation`
  ADD CONSTRAINT `eng` FOREIGN KEY (`ID_ENG`) REFERENCES `eng` (`ID`),
  ADD CONSTRAINT `pl` FOREIGN KEY (`ID_PL`) REFERENCES `pl` (`ID`),
  ADD CONSTRAINT `translation_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `type` FOREIGN KEY (`ID_TYPE`) REFERENCES `type` (`ID_TYPE`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
