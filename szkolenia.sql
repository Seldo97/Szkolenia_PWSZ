-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 28 Gru 2019, 17:32
-- Wersja serwera: 10.4.8-MariaDB
-- Wersja PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `szkolenia`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `certyfikat`
--

CREATE TABLE `certyfikat` (
  `id_certyfikat` int(11) NOT NULL,
  `id_szkolenie_uczestnik` int(11) NOT NULL,
  `data_wystawienia` date NOT NULL,
  `opis` varchar(100) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `certyfikat`
--

INSERT INTO `certyfikat` (`id_certyfikat`, `id_szkolenie_uczestnik`, `data_wystawienia`, `opis`) VALUES
(1, 1, '2020-01-07', 'jakis opis'),
(2, 2, '2020-01-07', NULL),
(3, 3, '2020-01-07', NULL),
(4, 4, '2020-01-07', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kierownik`
--

CREATE TABLE `kierownik` (
  `id_kierownik` int(11) NOT NULL,
  `imie` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `drugie_imie` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  `nazwisko` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `data_urodzenia` date NOT NULL,
  `email` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `telefon` varchar(9) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `kierownik`
--

INSERT INTO `kierownik` (`id_kierownik`, `imie`, `drugie_imie`, `nazwisko`, `data_urodzenia`, `email`, `telefon`) VALUES
(1, 'Filip', 'Andrzej', 'Zamoński', '1987-04-11', 'Filip@wp.pl', '555444333'),
(2, 'Zenon', 'Dariusz', 'Ewik', '1985-05-21', 'Zenon@wp.pl', '456234678'),
(3, 'Augustyn', '', 'Nosacz', '1983-01-04', 'Augustyn@wp.pl', '345712346');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `platnosc`
--

CREATE TABLE `platnosc` (
  `id_platnosc` int(11) NOT NULL,
  `id_szkolenie_uczestnik` int(11) NOT NULL,
  `termin_platnosci` date NOT NULL,
  `kwota` varchar(10) COLLATE utf8_polish_ci NOT NULL,
  `zaksiegowano` bit(1) DEFAULT NULL,
  `data_zaksiegowania` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `platnosc`
--

INSERT INTO `platnosc` (`id_platnosc`, `id_szkolenie_uczestnik`, `termin_platnosci`, `kwota`, `zaksiegowano`, `data_zaksiegowania`) VALUES
(1, 1, '2020-01-10', '350', b'1', '2019-12-28'),
(2, 2, '2020-01-10', '200', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sala`
--

CREATE TABLE `sala` (
  `nr_sali` int(11) NOT NULL,
  `ilosc_miejsc` int(11) NOT NULL,
  `uwagi` varchar(100) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `sala`
--

INSERT INTO `sala` (`nr_sali`, `ilosc_miejsc`, `uwagi`) VALUES
(100, 60, 'sala wykładowa'),
(104, 15, 'rzutnik interaktywny'),
(106, 20, 'sala komputerowa'),
(108, 10, 'sala komputerowa'),
(109, 10, 'sala konferencyjna'),
(200, 10, 'sala konferencyjna'),
(201, 17, '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sekretarka`
--

CREATE TABLE `sekretarka` (
  `id_sekretarka` int(11) NOT NULL,
  `imie` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `drugie_imie` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  `nazwisko` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `data_urodzenia` date NOT NULL,
  `email` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `telefon` varchar(9) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `sekretarka`
--

INSERT INTO `sekretarka` (`id_sekretarka`, `imie`, `drugie_imie`, `nazwisko`, `data_urodzenia`, `email`, `telefon`) VALUES
(1, 'Anna', '', 'Zamońska', '1987-04-11', 'Anna@wp.pl', '555444333'),
(2, 'Paulina', '', 'Milan', '1985-05-21', 'Paulina@wp.pl', '456234678'),
(3, 'Joanna', '', 'Lewacka', '1983-01-04', 'Joanna@wp.pl', '345712346');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `status`
--

CREATE TABLE `status` (
  `id_status` int(11) NOT NULL,
  `nazwa` varchar(10) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `status`
--

INSERT INTO `status` (`id_status`, `nazwa`) VALUES
(1, 'dostępne'),
(2, 'odwołane'),
(3, 'zakończone');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `szkolenie`
--

CREATE TABLE `szkolenie` (
  `id_szkolenie` int(11) NOT NULL,
  `nazwa` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `data` date NOT NULL,
  `godzina` time NOT NULL,
  `nr_sali` int(11) NOT NULL,
  `id_trener` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `cena` varchar(10) COLLATE utf8_polish_ci NOT NULL,
  `opis` varchar(500) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `szkolenie`
--

INSERT INTO `szkolenie` (`id_szkolenie`, `nazwa`, `data`, `godzina`, `nr_sali`, `id_trener`, `id_status`, `cena`, `opis`) VALUES
(1, 'Obsługa Excela', '2020-01-05', '13:30:00', 106, 1, 1, '350', ''),
(2, 'Obsługa Worda', '2020-02-05', '15:30:00', 106, 1, 1, '200', ''),
(3, 'Testowanie oprogramowania', '2020-01-15', '16:30:00', 108, 2, 1, '300', ''),
(4, 'Szkolenie BHP', '2020-02-10', '19:30:00', 100, 3, 1, '500', ''),
(5, 'Podstawowa obsługa komputera', '2020-01-20', '17:30:00', 108, 6, 1, '450', ''),
(6, 'Bezpieczeństwo w sieci', '2020-03-05', '19:30:00', 100, 6, 1, '150', ''),
(7, 'Zarządzanie kadrami', '2020-03-11', '15:30:00', 200, 7, 1, '350', ''),
(8, 'Trening skuteczności osobistej', '2020-03-15', '17:30:00', 100, 8, 1, '300', ''),
(9, 'Kaizen personalny', '2020-03-17', '18:30:00', 100, 8, 1, '300', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `szkolenie_uczestnik`
--

CREATE TABLE `szkolenie_uczestnik` (
  `id_szkolenie_uczestnik` int(11) NOT NULL,
  `id_uczestnik` int(11) NOT NULL,
  `id_szkolenie` int(11) NOT NULL,
  `obecnosc` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `szkolenie_uczestnik`
--

INSERT INTO `szkolenie_uczestnik` (`id_szkolenie_uczestnik`, `id_uczestnik`, `id_szkolenie`, `obecnosc`) VALUES
(1, 1, 1, b'1'),
(2, 2, 1, b'1'),
(3, 3, 1, b'1'),
(4, 4, 1, b'1'),
(5, 5, 1, b'0'),
(6, 5, 1, b'0'),
(7, 6, 2, b'1'),
(8, 7, 2, b'0'),
(9, 8, 2, b'1'),
(10, 1, 3, b'0'),
(11, 2, 3, b'1'),
(12, 9, 3, b'1'),
(13, 10, 3, b'1'),
(14, 9, 4, b'1'),
(15, 2, 5, b'1'),
(16, 5, 6, b'0'),
(17, 7, 7, b'1'),
(18, 10, 8, b'1'),
(19, 9, 9, b'0');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `trener`
--

CREATE TABLE `trener` (
  `id_trener` int(11) NOT NULL,
  `imie` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `drugie_imie` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  `nazwisko` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `data_urodzenia` date NOT NULL,
  `email` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `telefon` varchar(9) COLLATE utf8_polish_ci NOT NULL,
  `opis` varchar(100) COLLATE utf8_polish_ci DEFAULT NULL,
  `id_kierownik` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `trener`
--

INSERT INTO `trener` (`id_trener`, `imie`, `drugie_imie`, `nazwisko`, `data_urodzenia`, `email`, `telefon`, `opis`, `id_kierownik`) VALUES
(1, 'Andrzej', 'Filip', 'Filipiak', '1987-04-11', 'Andrzej@wp.pl', '555444333', '', 1),
(2, 'Daniel', 'Dariusz', 'Manik', '1985-05-21', 'Daniel@wp.pl', '456234678', '', 1),
(3, 'Marian', '', 'Kosecki', '1983-01-04', 'Marian@wp.pl', '345712346', '', 1),
(4, 'Dariusz', '', 'Nowacki', '1989-09-06', 'Dariusz@wp.pl', '123456789', '', 1),
(5, 'Eugeniusz', '', 'Kowalski', '1980-06-14', 'Eugeniusz@wp.pl', '123454678', '', 2),
(6, 'Mirosław', 'Krzysztof', 'Hantke', '1985-02-13', 'Mirosław@wp.pl', '134723458', '', 2),
(7, 'Elżbieta', '', 'Nowakowski', '1981-03-17', 'Elżbieta@wp.pl', '679345625', '', 2),
(8, 'Eustachy', 'Rawiczniak', 'Niezawistna', '1989-08-10', 'Eustachy@wp.pl', '264784563', '', 3),
(9, 'Filip', '', 'Tołwiński', '1983-03-12', 'Filip@wp.pl', '256347345', '', 3),
(10, 'Krzysztof', 'Marek', 'Dudek', '1987-05-19', 'Krzysztof@wp.pl', '123569223', '', 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uczestnik`
--

CREATE TABLE `uczestnik` (
  `id_uczestnik` int(11) NOT NULL,
  `imie` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `drugie_imie` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  `nazwisko` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `data_urodzenia` date NOT NULL,
  `email` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `telefon` varchar(9) COLLATE utf8_polish_ci NOT NULL,
  `id_wyksztalcenie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `uczestnik`
--

INSERT INTO `uczestnik` (`id_uczestnik`, `imie`, `drugie_imie`, `nazwisko`, `data_urodzenia`, `email`, `telefon`, `id_wyksztalcenie`) VALUES
(1, 'Artur', 'Janusz', 'Majchrzak', '1997-04-11', 'Artur@wp.pl', '555444333', 1),
(2, 'Marcin', 'Adam', 'Olek', '1995-05-21', 'Marcin@wp.pl', '456234678', 2),
(3, 'Rafał', '', 'Cekan', '1993-01-04', 'Rafał@wp.pl', '345712346', 3),
(4, 'Janusz', '', 'Pawlacz', '1999-09-06', 'Janusz@wp.pl', '123456789', 4),
(5, 'Piotr', '', 'Kroppop', '1990-06-14', 'Piotr@wp.pl', '123454678', 5),
(6, 'Bartosz', 'Śmiglowicz', 'Majchrzak', '1985-02-13', 'Bartosz@wp.pl', '134723458', 1),
(7, 'Adam', '', 'Stolecki', '1991-03-17', 'Adam@wp.pl', '679345625', 2),
(8, 'Patrycja', 'Julita', 'Niezawistna', '1989-08-10', 'Patrycja@wp.pl', '264784563', 3),
(9, 'Walerian', '', 'Urbaniak', '1993-03-12', 'Walerian@wp.pl', '256347345', 4),
(10, 'Lilith', 'Ewa', 'Mentzen', '1997-05-19', 'Lilith@wp.pl', '123569223', 5),
(11, 'Artur', 'Janusz', 'Majchrzak', '1997-04-11', 'Artur@wp.pl', '555444333', 1),
(12, 'Marcin', 'Adam', 'Olek', '1995-05-21', 'Marcin@wp.pl', '456234678', 2),
(13, 'Rafał', '', 'Cekan', '1993-01-04', 'Rafał@wp.pl', '345712346', 3),
(14, 'Janusz', '', 'Pawlacz', '1999-09-06', 'Janusz@wp.pl', '123456789', 4),
(15, 'Piotr', '', 'Kroppop', '1990-06-14', 'Piotr@wp.pl', '123454678', 5),
(16, 'Bartosz', 'Śmiglowicz', 'Majchrzak', '1985-02-13', 'Bartosz@wp.pl', '134723458', 1),
(17, 'Adam', '', 'Stolecki', '1991-03-17', 'Adam@wp.pl', '679345625', 2),
(18, 'Patrycja', 'Julita', 'Niezawistna', '1989-08-10', 'Patrycja@wp.pl', '264784563', 3),
(19, 'Walerian', '', 'Urbaniak', '1993-03-12', 'Walerian@wp.pl', '256347345', 4),
(20, 'Lilith', 'Ewa', 'Mentzen', '1997-05-19', 'Lilith@wp.pl', '123569223', 5),
(41, 'crypt', 'crypt', 'crypt', '2019-12-28', 'crypted@proton.org', '123465798', 9);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uprawnienia`
--

CREATE TABLE `uprawnienia` (
  `id_uprawnienia` int(11) NOT NULL,
  `nazwa` varchar(50) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `uprawnienia`
--

INSERT INTO `uprawnienia` (`id_uprawnienia`, `nazwa`) VALUES
(1, 'Uczestnik');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownik`
--

CREATE TABLE `uzytkownik` (
  `id_uzytkownik` int(11) NOT NULL,
  `login` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `haslo` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `id_uprawnienia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `uzytkownik`
--

INSERT INTO `uzytkownik` (`id_uzytkownik`, `login`, `haslo`, `email`, `id_uprawnienia`) VALUES
(34, 'crypt', '$2y$10$V8RqEPbWoipjIxUNP.2HpeDUwu1kC8gI0ZkIGQkqpauh1rafZtDWO', 'crypted@proton.org', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wyksztalcenie`
--

CREATE TABLE `wyksztalcenie` (
  `id_wyksztalcenie` int(11) NOT NULL,
  `nazwa` varchar(50) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `wyksztalcenie`
--

INSERT INTO `wyksztalcenie` (`id_wyksztalcenie`, `nazwa`) VALUES
(1, 'brak'),
(2, 'podstawowe'),
(3, 'średnie'),
(4, 'wyższe'),
(5, 'podyplomowe'),
(6, 'brak'),
(7, 'podstawowe'),
(8, 'średnie'),
(9, 'wyższe'),
(10, 'podyplomowe');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `certyfikat`
--
ALTER TABLE `certyfikat`
  ADD PRIMARY KEY (`id_certyfikat`),
  ADD KEY `FK_CertyfikatSzkolenieUczestnik` (`id_szkolenie_uczestnik`);

--
-- Indeksy dla tabeli `kierownik`
--
ALTER TABLE `kierownik`
  ADD PRIMARY KEY (`id_kierownik`);

--
-- Indeksy dla tabeli `platnosc`
--
ALTER TABLE `platnosc`
  ADD PRIMARY KEY (`id_platnosc`),
  ADD KEY `FK_PlatnoscSzkolenieUczestnik` (`id_szkolenie_uczestnik`);

--
-- Indeksy dla tabeli `sala`
--
ALTER TABLE `sala`
  ADD PRIMARY KEY (`nr_sali`);

--
-- Indeksy dla tabeli `sekretarka`
--
ALTER TABLE `sekretarka`
  ADD PRIMARY KEY (`id_sekretarka`);

--
-- Indeksy dla tabeli `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indeksy dla tabeli `szkolenie`
--
ALTER TABLE `szkolenie`
  ADD PRIMARY KEY (`id_szkolenie`),
  ADD KEY `FK_SzkolenieSala` (`nr_sali`),
  ADD KEY `FK_SzkolenieTrener` (`id_trener`),
  ADD KEY `FK_SzkolenieStatus` (`id_status`);

--
-- Indeksy dla tabeli `szkolenie_uczestnik`
--
ALTER TABLE `szkolenie_uczestnik`
  ADD PRIMARY KEY (`id_szkolenie_uczestnik`),
  ADD KEY `FK_Szkol_Ucz_Uczestnik` (`id_uczestnik`),
  ADD KEY `FK_Szkol_Ucz_Szkolenie` (`id_szkolenie`);

--
-- Indeksy dla tabeli `trener`
--
ALTER TABLE `trener`
  ADD PRIMARY KEY (`id_trener`),
  ADD KEY `FK_TrenerKierownik` (`id_kierownik`);

--
-- Indeksy dla tabeli `uczestnik`
--
ALTER TABLE `uczestnik`
  ADD PRIMARY KEY (`id_uczestnik`),
  ADD KEY `FK_UczestnikWyksztalcenie` (`id_wyksztalcenie`);

--
-- Indeksy dla tabeli `uprawnienia`
--
ALTER TABLE `uprawnienia`
  ADD PRIMARY KEY (`id_uprawnienia`);

--
-- Indeksy dla tabeli `uzytkownik`
--
ALTER TABLE `uzytkownik`
  ADD PRIMARY KEY (`id_uzytkownik`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `FK_UzytkownikUprawnienia` (`id_uprawnienia`);

--
-- Indeksy dla tabeli `wyksztalcenie`
--
ALTER TABLE `wyksztalcenie`
  ADD PRIMARY KEY (`id_wyksztalcenie`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `certyfikat`
--
ALTER TABLE `certyfikat`
  MODIFY `id_certyfikat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `kierownik`
--
ALTER TABLE `kierownik`
  MODIFY `id_kierownik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `platnosc`
--
ALTER TABLE `platnosc`
  MODIFY `id_platnosc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `sekretarka`
--
ALTER TABLE `sekretarka`
  MODIFY `id_sekretarka` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `szkolenie`
--
ALTER TABLE `szkolenie`
  MODIFY `id_szkolenie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `szkolenie_uczestnik`
--
ALTER TABLE `szkolenie_uczestnik`
  MODIFY `id_szkolenie_uczestnik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT dla tabeli `trener`
--
ALTER TABLE `trener`
  MODIFY `id_trener` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `uczestnik`
--
ALTER TABLE `uczestnik`
  MODIFY `id_uczestnik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT dla tabeli `uprawnienia`
--
ALTER TABLE `uprawnienia`
  MODIFY `id_uprawnienia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `uzytkownik`
--
ALTER TABLE `uzytkownik`
  MODIFY `id_uzytkownik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT dla tabeli `wyksztalcenie`
--
ALTER TABLE `wyksztalcenie`
  MODIFY `id_wyksztalcenie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `certyfikat`
--
ALTER TABLE `certyfikat`
  ADD CONSTRAINT `FK_CertyfikatSzkolenieUczestnik` FOREIGN KEY (`id_szkolenie_uczestnik`) REFERENCES `szkolenie_uczestnik` (`id_szkolenie_uczestnik`);

--
-- Ograniczenia dla tabeli `platnosc`
--
ALTER TABLE `platnosc`
  ADD CONSTRAINT `FK_PlatnoscSzkolenieUczestnik` FOREIGN KEY (`id_szkolenie_uczestnik`) REFERENCES `szkolenie_uczestnik` (`id_szkolenie_uczestnik`);

--
-- Ograniczenia dla tabeli `szkolenie`
--
ALTER TABLE `szkolenie`
  ADD CONSTRAINT `FK_SzkolenieSala` FOREIGN KEY (`nr_sali`) REFERENCES `sala` (`nr_sali`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_SzkolenieStatus` FOREIGN KEY (`id_status`) REFERENCES `status` (`id_status`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_SzkolenieTrener` FOREIGN KEY (`id_trener`) REFERENCES `trener` (`id_trener`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `szkolenie_uczestnik`
--
ALTER TABLE `szkolenie_uczestnik`
  ADD CONSTRAINT `FK_Szkol_Ucz_Szkolenie` FOREIGN KEY (`id_szkolenie`) REFERENCES `szkolenie` (`id_szkolenie`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Szkol_Ucz_Uczestnik` FOREIGN KEY (`id_uczestnik`) REFERENCES `uczestnik` (`id_uczestnik`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `trener`
--
ALTER TABLE `trener`
  ADD CONSTRAINT `FK_TrenerKierownik` FOREIGN KEY (`id_kierownik`) REFERENCES `kierownik` (`id_kierownik`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `uczestnik`
--
ALTER TABLE `uczestnik`
  ADD CONSTRAINT `FK_UczestnikWyksztalcenie` FOREIGN KEY (`id_wyksztalcenie`) REFERENCES `wyksztalcenie` (`id_wyksztalcenie`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `uzytkownik`
--
ALTER TABLE `uzytkownik`
  ADD CONSTRAINT `FK_UzytkownikUprawnienia` FOREIGN KEY (`id_uprawnienia`) REFERENCES `uprawnienia` (`id_uprawnienia`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
