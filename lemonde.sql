-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jun 21, 2025 at 10:39 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lemonde`
--

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ime` varchar(50) NOT NULL,
  `prezime` varchar(50) NOT NULL,
  `admin` tinyint(1) DEFAULT 0,
  `datum_registracije` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `username`, `email`, `password`, `ime`, `prezime`, `admin`, `datum_registracije`) VALUES
(3, 'admin', 'admin@lemonde.hr', '$2y$10$V9VpfZF9ZPfYZXYnWwBbj.sYYJfbDrwAj.HRz0xFb5A1y8HLq.tYq', 'Admin', 'Korisnik', 1, '2025-06-19 14:17:58'),
(4, 'ivanich', 'ivanjurjevic03@gmail.com', '$2y$10$ZKeyvX0UavCm3eem/04za.QyAolr4zOP6nmANRskvkZYKyRAoDz2a', 'ivan', 'jurjević', 1, '2025-06-19 14:19:18'),
(5, 'testuser', 'test@testiram.hr', '$2y$10$djNWJM5nwPVbNkzaFYPB6.yvjcYrkaivnNajJpSuqkHSFJHi5uss2', 'korisnik', 'korisnik', 1, '2025-06-20 12:06:07');

-- --------------------------------------------------------

--
-- Table structure for table `vijesti`
--

CREATE TABLE `vijesti` (
  `id` int(11) NOT NULL,
  `datum` varchar(32) DEFAULT NULL,
  `naslov` varchar(64) DEFAULT NULL,
  `sadrzaj` text DEFAULT NULL,
  `tekst` text DEFAULT NULL,
  `slika` varchar(64) DEFAULT NULL,
  `kategorija` varchar(64) DEFAULT NULL,
  `arhiva` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `vijesti`
--

INSERT INTO `vijesti` (`id`, `datum`, `naslov`, `sadrzaj`, `tekst`, `slika`, `kategorija`, `arhiva`) VALUES
(1, '2024-03-15', 'Dinamo Zagreb pobijedio Hajduk 2-1', 'Uzbudljiva utakmica na Maksimiru završila je pobjedom domaće momčadi.', 'Dinamo Zagreb je u derbiju 28. kola HNL-a pobijedio Hajduk rezultatom 2-1. Golove za Dinamo postigli su Petković u 23. i Ivanušec u 67. minuti, dok je za Hajduk pogodak postigao Kalinić u 45. minuti.', 'child-613199_640.jpg', 'sport', 0),
(2, '2024-03-12', 'Janica Kostelić završila trenersku karijeru', 'Bivša olimpijska prvakinja objavila je završetak rada s mladim skijašima.', 'Janica Kostelić je nakon 15 godina trenerskog rada objavila da se povlači iz aktivnog treniranja. U svojoj izjavi istaknula je da želi više vremena posvetiti obitelji i novim projektima.', 'test.jpg', 'sport', 1),
(3, '2024-03-10', 'Rukometaši Hrvatske u polufinalu SP-a', 'Fantastična pobjeda protiv Danske dovela je Hrvatsku u polufinale.', 'Hrvatska rukometna reprezentacija je u četvrtfinalu Svjetskog prvenstva pobijedila Dansku 28-26 i plasirala se u polufinale. Najbolji strijelac bio je Šipić s 8 golova.', 'images.jpg', 'sport', 0),
(4, '2024-03-08', 'Osijek potpisao novi ugovor s Bočkajem', 'Mladi veznjak produžio je ugovor do 2026. godine.', 'NK Osijek je objavio da je Ante Bočkaj produžio ugovor s klubom do ljeta 2026. godine. 22-godišnji veznjak je ove sezone postigao 6 golova u 25 nastupa.', 'soccer stock.jpeg', 'sport', 0),
(5, '2024-03-05', 'Težak poraz košarkaša Cibone', 'Gubici se nastavljaju za zagrebački klub u ABA ligi.', 'KK Cibona je u 20. kolu ABA lige poražena od Partizana rezultatom 89-67. Ovo je bio sedmi uzastopni poraz za zagrebški klub koji se bori protiv ispadanja iz lige.', 'test.jpg', 'sport', 1),
(6, '2024-03-18', 'Sabor raspravlja o novom Zakonu o radu', 'Saborski zastupnici raspravljaju o izmjenama radnog zakonodavstva.', 'Hrvatski sabor je danas u prvom čitanju raspravljao o Prijedlogu zakona o izmjenama Zakona o radu. Glavne izmjene odnose se na fleksibilnije radno vrijeme i veća prava radnika na rad od kuće.', 'Sabor-2024.webp', 'politika', 0),
(7, '2024-03-16', 'Premijer najavio nova ulaganja u zdravstvo', 'Vlada planira povećati proračun za zdravstvo za 15 posto.', 'Premijer Andrej Plenković najavio je na konferenciji za medije da će Vlada u 2025. godini povećati izdvajanja za zdravstvo za 15 posto. Sredstva će biti usmjerena na nabavu nove medicinske opreme.', 'zdravstvo.jpg', 'politika', 0),
(8, '2024-03-14', 'Oporba traži hitnu raspravu o korupciji', 'SDP i Možemo! podnijeli su zahtjev za hitnu sjednicu Sabora.', 'Oporba je podnijela zahtjev za održavanje hitne sjednice Sabora na temu korupcijskih afera u javnim poduzećima. Zahtjev je potpisan od strane 40 zastupnika iz redova opozicije.', 'test.jpg', 'politika', 1),
(9, '2024-03-11', 'Novi most u Zagrebu otvoren za promet', 'Most preko Save završen je nakon tri godine gradnje.', 'Zagrebački gradonačelnik Tomislav Tomašević svečano je otvorio novi most preko Save koji povezuje Novi Zagreb s Trešnjevkom. Investicija je koštala 120 milijuna kuna.', 'most-1-e1442399851190.jpg', 'politika', 0),
(10, '2024-03-09', 'Europarlamentarci raspravljaju o fondu obnove', 'Hrvatska eurozastupnica izvijestila je o napretku projekata.', 'Hrvatska eurozastupnica Biljana Borzan izvijestila je Europski parlament o napretku u realizaciji projekata financiranih iz EU fonda obnove. Do sada je realizirano 60 posto planiranih projekata.', 'test.jpg', 'politika', 1),
(11, '17.06.2025.', 'Thompson na hipodromu', 'Thompson nadmašio sva očekivanja i slomio rekorde!', '\"U tijeku su razgovori s predstavnicima menadžmenta o mogućnosti zakupa prostora na Bundeku za datume 4. i 5. srpnja 2025. godine. Detalji još nisu definirani s obzirom na to da su razgovori još u tijeku\", poručili su iz Ustanove za upravljanje sportskim objektima.\r\n\r\nPripreme za koncert već su počele. Na Hipodromu je započelo postavljanje tribina, čime se Thompson nedavno pohvalio i na svojem profilu na Facebooku.\r\n\r\nOsim koncerta u Zagrebu, Thompson je za ljeto najavio još jedan koncert. Ovog puta u Sinju, dan prije Oluje – 4. kolovoza 2025.', '03f4ddec-f52b-4d37-8077-030ded348ad0.jpg', 'politika', 0),
(12, '20.06.2025.', 'Marin Čilić novi prvak', 'Marin Čilić novi je prvak europe!', 'Čilić, kojemu je nastup u Nottinghamu priprema za Wimbledon, u polufinalu će za suparnika imati Španjolca Martina Landalucea.\r\n\r\nNažalost, 21-godišnji Luka Mikrut nije bio uspješan u četvrtfinalu \"challengera\" na zemljanoj podlozi u francuskom Royanu, bolji od njega je nakon velike borbe u četvrtfinalu bio Francuz Titouan Droguet sa 7-6 (1), 6-7 (7), 6-4.', '1740669277-1059312448-750x500.jpg', 'sport', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `vijesti`
--
ALTER TABLE `vijesti`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vijesti`
--
ALTER TABLE `vijesti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
