-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 19 Gru 2020, 14:34
-- Wersja serwera: 10.4.14-MariaDB
-- Wersja PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `ai_lab10`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `parent_category` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `contractors`
--

CREATE TABLE `contractors` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `vat_id` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `contractors`
--

INSERT INTO `contractors` (`id`, `name`, `vat_id`) VALUES
(1, 'Osek Corporation', 'NIP123'),
(3, 'test1', ''),
(4, 'test2', ''),
(5, 'test3', ''),
(6, 'test4', ''),
(7, 'test5', ''),
(8, 'test6', ''),
(9, 'test7', ''),
(10, 'test8', 'NIP15213'),
(11, 'Test9', ''),
(12, 'TEST10', ''),
(13, 'TEST11', ''),
(14, 'TEST12', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `added_at` datetime NOT NULL DEFAULT current_timestamp(),
  `description` text DEFAULT NULL,
  `invoice_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `equipement`
--

CREATE TABLE `equipement` (
  `id` int(11) NOT NULL,
  `sku` varchar(32) DEFAULT NULL,
  `name` varchar(64) NOT NULL,
  `description` text DEFAULT NULL,
  `serial_number` varchar(32) DEFAULT NULL,
  `buy_date` date DEFAULT NULL,
  `warranty_to` date DEFAULT NULL,
  `price_netto` decimal(10,2) NOT NULL,
  `vat` tinyint(4) NOT NULL DEFAULT 0,
  `price_brutto` decimal(10,2) NOT NULL,
  `who_uses` varchar(128) DEFAULT NULL,
  `invoice_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `invoice_number` varchar(32) DEFAULT NULL,
  `sum_netto` decimal(10,2) NOT NULL,
  `sum_vat` tinyint(4) NOT NULL DEFAULT 0,
  `sum_brutto` decimal(10,2) NOT NULL,
  `date_of_invoice` date NOT NULL,
  `dirpath` varchar(32) DEFAULT NULL,
  `type` enum('sale','buy') NOT NULL,
  `contractor_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_number`, `sum_netto`, `sum_vat`, `sum_brutto`, `date_of_invoice`, `dirpath`, `type`, `contractor_id`, `category_id`) VALUES
(1, 'INV1142', '400.00', 24, '501.00', '2020-12-18', NULL, 'sale', 1, NULL),
(3, 'inv1', '0.00', 0, '0.00', '0000-00-00', NULL, '', 3, NULL),
(4, 'FAKTURA2', '0.00', 0, '0.00', '0000-00-00', NULL, '', 3, NULL),
(5, 'FAKTURA3', '0.00', 0, '0.00', '0000-00-00', NULL, '', 3, NULL),
(6, 'FAKTURA4', '0.00', 0, '0.00', '0000-00-00', NULL, '', 3, NULL),
(7, 'FAKTURA5', '0.00', 0, '0.00', '0000-00-00', NULL, '', 3, NULL),
(8, 'FAKTURA6', '0.00', 0, '0.00', '0000-00-00', NULL, '', 3, NULL),
(9, 'FAKTURA7', '0.00', 0, '0.00', '0000-00-00', NULL, '', 3, NULL),
(10, 'FAKTURA8', '0.00', 0, '0.00', '0000-00-00', NULL, '', 10, NULL),
(11, 'INV9', '0.00', 0, '0.00', '0000-00-00', NULL, '', 3, NULL),
(12, 'INV10', '0.00', 0, '0.00', '0000-00-00', NULL, '', 3, NULL),
(13, 'INV11', '0.00', 0, '0.00', '0000-00-00', NULL, '', 3, NULL),
(14, 'INV12', '0.00', 0, '0.00', '0000-00-00', NULL, '', 3, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `invoice_in_category`
--

CREATE TABLE `invoice_in_category` (
  `category_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `licences`
--

CREATE TABLE `licences` (
  `id` int(11) NOT NULL,
  `sku` varchar(32) DEFAULT NULL,
  `name` varchar(64) NOT NULL,
  `description` text DEFAULT NULL,
  `serial_number` varchar(32) DEFAULT NULL,
  `buy_date` date DEFAULT NULL,
  `warranty_to` date DEFAULT NULL,
  `valid_to` date DEFAULT NULL,
  `price_netto` decimal(10,2) NOT NULL,
  `vat` tinyint(4) NOT NULL DEFAULT 0,
  `price_brutto` decimal(10,2) NOT NULL,
  `who_uses` varchar(128) DEFAULT NULL,
  `invoice_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `licences`
--

INSERT INTO `licences` (`id`, `sku`, `name`, `description`, `serial_number`, `buy_date`, `warranty_to`, `valid_to`, `price_netto`, `vat`, `price_brutto`, `who_uses`, `invoice_id`) VALUES
(1, '1', 'Windows 10', 'Licencja do windowsa 10', 'serial123Key', '2020-12-18', '2020-12-18', '2020-12-18', '100.00', 23, '200.00', 'Cris', 1),
(3, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', '0.00', 0, '0.00', '', 3),
(4, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', '0.00', 0, '0.00', '', 4),
(5, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', '0.00', 0, '0.00', '', 5),
(6, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', '0.00', 0, '0.00', '', 6),
(7, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', '0.00', 0, '0.00', '', 7),
(8, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', '0.00', 0, '0.00', '', 8),
(9, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', '0.00', 0, '0.00', '', 9),
(10, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', '0.00', 0, '0.00', '', 10),
(11, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', '0.00', 0, '0.00', '', 11),
(12, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', '0.00', 0, '0.00', '', 12),
(13, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', '0.00', 0, '0.00', '', 13),
(14, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', '0.00', 0, '0.00', '', 14);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(128) DEFAULT NULL,
  `login` varchar(64) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role` enum('admin','user','auditor') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `email`, `login`, `password`, `role`) VALUES
(1, NULL, 'admin', 'admin123', 'admin'),
(2, 'kowal@kowal.pl', 'kowal', 'kowal123', 'user'),
(3, 'test@test.pl', 'osek', 'osek123', 'auditor');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_category` (`parent_category`);

--
-- Indeksy dla tabeli `contractors`
--
ALTER TABLE `contractors`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_id` (`invoice_id`);

--
-- Indeksy dla tabeli `equipement`
--
ALTER TABLE `equipement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_id` (`invoice_id`);

--
-- Indeksy dla tabeli `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contractor_id` (`contractor_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indeksy dla tabeli `invoice_in_category`
--
ALTER TABLE `invoice_in_category`
  ADD PRIMARY KEY (`category_id`,`invoice_id`),
  ADD KEY `invoice_id` (`invoice_id`);

--
-- Indeksy dla tabeli `licences`
--
ALTER TABLE `licences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_id` (`invoice_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `contractors`
--
ALTER TABLE `contractors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT dla tabeli `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `equipement`
--
ALTER TABLE `equipement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT dla tabeli `licences`
--
ALTER TABLE `licences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`parent_category`) REFERENCES `categories` (`id`);

--
-- Ograniczenia dla tabeli `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`);

--
-- Ograniczenia dla tabeli `equipement`
--
ALTER TABLE `equipement`
  ADD CONSTRAINT `equipement_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`);

--
-- Ograniczenia dla tabeli `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`contractor_id`) REFERENCES `contractors` (`id`),
  ADD CONSTRAINT `invoices_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Ograniczenia dla tabeli `invoice_in_category`
--
ALTER TABLE `invoice_in_category`
  ADD CONSTRAINT `invoice_in_category_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `invoice_in_category_ibfk_2` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`);

--
-- Ograniczenia dla tabeli `licences`
--
ALTER TABLE `licences`
  ADD CONSTRAINT `licences_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
