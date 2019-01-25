-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2019 at 01:58 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `slum`
--

-- --------------------------------------------------------

--
-- Table structure for table `text`
--

CREATE TABLE `text` (
  `id` int(6) UNSIGNED NOT NULL,
  `author` int(6) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci,
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `text`
--

INSERT INTO `text` (`id`, `author`, `title`, `body`, `post_date`) VALUES
(1, 1, 'Vábnička (pastička??) na myši', 'Za starých časů už mechanismus vyráběný, \r\nz dřevěné patičky a kusu drátku,\r\ndo temné díry lstivě nastražený\r\nlapá po myším pařátku.\r\nTohle je ale pastička, ne vábnička.\r\nSpějeme do rozuzlení.\r\nVábnička je v našem případě sýr.\r\nAni camembert, ani gouda, ani skyr,\r\nAle úplně obyčejný a hnusný eidam.\r\nVlk se nažere a koza zůstane celá.\r\nPřítomnost eidemu v domácnosti rozzuří požitkáře do běla.\r\nAle myš ne, myš je ráda.\r\nDo té doby, než jí prasknou záda. \r\n', '2018-11-05 23:02:19'),
(2, 1, 'Etýdy z Křemencárny', 'Na základní škole \r\npan učitel Josef si hověl ve svém panelovém soukromém dole.\r\nS dětmi na hodině o aldehydech dneska povídal si.\r\nByl mezi nimi hodně oblíbený,\r\npři podpálení lavice vždy na sebe vzal kus viny.\r\nKdyž hodina skončila, bývalá žačka se za dveřmi choulila.\r\nAhoj Pájo, jak to jde,\r\nna chemické střední průmyslové škole?\r\nPane učiteli, mají mě tam rádi, mám nové kamarády.\r\nLavice jsou pohodlné a v jídelně nám dneska dali cukrové homole.\r\nTé chemii ale kurva nerozumím.\r\n', '2018-11-06 18:16:38'),
(3, 1, 'Básník', 'Životabudiči! Kurviči!\r\nPijí a pak se zbijí do němoty.\r\nNevidíš rozdíl mezi nimi a šroty.\r\nMouka je jako louka,\r\nživotodárný kvásek jsou včelky.\r\nNa louce rostou kmínky, \r\nkmínek se do chleba zabalí jako do plínky.\r\nBídné žebračí ruce se pnoucně vztahují,\r\nSukně povětrničky se vzdouvají.\r\nPo vlhkých kočičích hlavách klepou podpatky barda.¨\r\nNa loutnu rád tklivě hrává,\r\nskrz noční okno do místnůstky chce vlézt,\r\na sevřít dívčí ňadra. \r\n\r\nJeho básně sice rvou srdce, lítostí se celý chvěješ,\r\nchceš znovu držet v dlaních tu bytost pro tebe nejkrásnější.\r\nSám se ale básník příliš bojí.\r\nNechce ženu, která kojí.\r\nChce splynout s někýmj dalším,\r\nChce docílit nejvyššího souznění duší.\r\nNedostane ale do zad znovu kuší?\r\n\r\nRadši by si odřezal uši a schnil.\r\n', '2018-11-06 20:21:14'),
(4, 1, 'Balada o kališníkovi Ovčákovi', 'Kališník Ovčák zčistajasna zřídkakdy\r\nocitne se v černém dni.\r\nJako by ho roupi sužovali,\r\nzapomíná na své dobré mravy,\r\nkteré mu otec Jindřich při službě vštěpoval.\r\nJeho rodiče tohle nikdy neudělali.\r\nJeden z důvodů může být, že zemřeli velmi mládi,\r\ndruhý že kolem jejich společného jednoosobového lůžka krysy poletovaly,\r\na to se slušným lidem nestává.\r\n\r\nProžívá nadpozemské stavy zimnice a třasu,\r\nzmítá se ve víru chutí z nichž ta nejjemnější je,\r\nže někomu vytáhne střeva uchem.\r\n\r\nSám neví, proč se mu to děje.\r\nKdyby žil dnes, byl by případ psychiatrie.\r\nV jeho době byl prostě jenom bláznivý podivín.\r\nAle lidi nejsou tak hloupí jak se zdá!\r\nDali byste snad někomu takovému požehnat váš kravín?\r\nOdpověď je ne a taky z toho pro Ovčáka plynuly následky.\r\n\r\nNejlepší večeří mu byly chlebové hrudky.\r\nI když měl pyj jak kyj, ženy s ním do lože nešly.\r\nSkutečně jste si mysleli, že Ovčák je jeho pravé jméno?\r\n\r\nVedl bídnou existenci ve zdejším kostele,\r\nnikdy neviděl nic honosnějšího než morový sloup\r\nna náměstí, bandy kluků zaháněl kameny jako starý dědek,\r\ni když mu bylo jen pětadvacet.\r\nByl zkrátka na odepsání.\r\n\r\nJednoho dne se v jeho malé hlavě zrodila ušlechtilá myšlenka.\r\nJe to tajnůstkář, nepustí nás dovnitř a nepočtem si.\r\nJediné co si pomyslel je, udělám to a tamto a budu se mít jako král.\r\nVíte, co udělal?\r\nOvázal si oprátku a věčně se uspal.\r\n', '2018-11-18 11:16:15'),
(5, 1, 'Requiem For a World', 'Necítím nic a zároveň cítím všechno.\r\nToužím posadit se na ráhno dubové loďky,\r\nneřešit nic a zároveň prozkoumávat všechno.\r\nNa nebi slunce vystoupalo nahoru a já sedím na přídi,\r\ns dalšími pozorujeme hvězdy a večer necháváme ohně plát..\r\nHedvábné oblečení necháváme na sobě volně vát.\r\nZa provedené hříchy chodíme se kát.\r\nA celý svět začíná být náš.\r\n\r\nVlastníme jen jednu naší dubovou loďku,\r\nkdekdo by řekl že máme málo.\r\nNám stačí přítomnost vln a co víc,\r\nspolečné sdílení fascinace světem.\r\nVše jsme nechali na břehu a nic nás netrápí.\r\nNic nemá smysl a rozum se vytrácí.\r\nKoráb čeří moře jak myšlenky čeří prostor uvnitř hlavy.\r\nNemáme stavy.\r\nV celé své lidskosti naplňujem veškeré definice,\r\nspojení jsme, povrchní je blýskavice.\r\n\r\nLáska je všechno a zároveň nic, láska pro svět dovádí nás blíž.\r\nBlíž k vykoupení z neuspokojivého bytí.\r\nProtkává nás pomalu nití, co dále sledujem.\r\nStarat se o svět je náš rekviem.\r\n', '2018-12-05 19:13:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(6) UNSIGNED NOT NULL,
  `username` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstname`, `lastname`, `email`, `password`, `reg_date`) VALUES
(1, 'Horala', 'Adéla', 'Mládková', 'horala@nakejemail.xd', '0cc175b9c0f1b6a831c399e269772661 ', '2018-12-13 23:49:55'),
(38, 'Jopatam', 'Jakub', 'Mann', 'jakub.h.mann@gmail.com', '3281673556c535f978aa65675127c804', '2018-12-13 21:51:37'),
(39, 'lkl', 'klkl', 'klklk', 'k@k.com', '78d1fe0f0064cf6654940c87d99d4456', '2018-12-14 15:35:43'),
(40, 'aaaaaaaa', 'aaaaaaaa', 'aaaaaaaa', 'aaaaaaaa@aaaaaaaa.com', '3dbe00a167653a1aaee01d93e77e730e', '2018-12-18 16:05:00'),
(420, 'aaa', 'aaa', 'aaa', 'aaa', 'aaa', '2019-01-06 16:05:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `text`
--
ALTER TABLE `text`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author` (`author`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `text`
--
ALTER TABLE `text`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=421;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `text`
--
ALTER TABLE `text`
  ADD CONSTRAINT `text_ibfk_1` FOREIGN KEY (`author`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
