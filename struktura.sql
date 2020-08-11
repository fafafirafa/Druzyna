SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `druzyna`
--

CREATE TABLE `druzyna` (
  `Id` int(11) NOT NULL,
  `Zawodnik` text COLLATE utf8_polish_ci NOT NULL,
  `Rezerwa` char(1) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `druzyna_informacja`
--

CREATE TABLE `druzyna_informacja` (
  `Id` int(11) NOT NULL,
  `Informacja` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `druzyna_informacja`
--

INSERT INTO `druzyna_informacja` (`Id`, `Informacja`) VALUES
(0, 'Aktualni zawodnicy w zespole\r\n{%druzyna}');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `newsy`
--

CREATE TABLE `newsy` (
  `Id` int(11) NOT NULL,
  `Tytul` text COLLATE utf8_polish_ci NOT NULL,
  `Data` text COLLATE utf8_polish_ci NOT NULL,
  `Tresc` text COLLATE utf8_polish_ci NOT NULL,
  `Dodajacy` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `o_druzynie`
--

CREATE TABLE `o_druzynie` (
  `Id` int(11) NOT NULL,
  `Informacja` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `partnerzy`
--

CREATE TABLE `partnerzy` (
  `Id` int(11) NOT NULL,
  `Nazwa` mediumtext COLLATE utf8_polish_ci NOT NULL,
  `Strona` text COLLATE utf8_polish_ci NOT NULL,
  `Zdjecie` mediumtext COLLATE utf8_polish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `Id` int(11) NOT NULL,
  `User` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `Pass` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Indeksy dla tabeli `druzyna`
--
ALTER TABLE `druzyna`
  ADD PRIMARY KEY (`Id`);

--
-- Indeksy dla tabeli `newsy`
--
ALTER TABLE `newsy`
  ADD PRIMARY KEY (`Id`);

--
-- Indeksy dla tabeli `partnerzy`
--
ALTER TABLE `partnerzy`
  ADD PRIMARY KEY (`Id`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`Id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `druzyna`
--
ALTER TABLE `druzyna`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT dla tabeli `newsy`
--
ALTER TABLE `newsy`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT dla tabeli `partnerzy`
--
ALTER TABLE `partnerzy`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
