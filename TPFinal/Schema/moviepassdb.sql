-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 14-11-2020 a las 19:35:52
-- Versión del servidor: 8.0.21
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `moviepassdb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actors`
--

DROP TABLE IF EXISTS `actors`;
CREATE TABLE IF NOT EXISTS `actors` (
  `IdActor` int NOT NULL AUTO_INCREMENT,
  `ActorFirstName` varchar(30) NOT NULL,
  `ActorLastName` varchar(30) NOT NULL,
  `BirthDate` date DEFAULT NULL,
  `Photo` text,
  `IdCountry` int DEFAULT NULL,
  `IdGender` int NOT NULL,
  PRIMARY KEY (`IdActor`),
  KEY `Fk_Country` (`IdCountry`),
  KEY `Fk_Gender` (`IdGender`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `addresses`
--

DROP TABLE IF EXISTS `addresses`;
CREATE TABLE IF NOT EXISTS `addresses` (
  `IdAddress` int NOT NULL AUTO_INCREMENT,
  `Street` varchar(100) NOT NULL,
  `NumberStreet` int NOT NULL,
  PRIMARY KEY (`IdAddress`)
) ENGINE=MyISAM AUTO_INCREMENT=114 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `addresses`
--

INSERT INTO `addresses` (`IdAddress`, `Street`, `NumberStreet`) VALUES
(1, 'Viamonte', 123),
(2, 'Castelli', 234),
(113, 'Viamonte', 2964),
(112, 'santa fe', 123455),
(111, 'Chascomus', 100),
(110, '', 0),
(109, '12340ifwe[08y', 33333),
(108, 'lkjasbdn;kjnaf;', 12345),
(107, 'lkjasbdn;kjnaf;', 12345),
(106, 'oiuhwp', 213123),
(105, 'Masnguh', 1234),
(104, 'ASdasdda', 12454),
(103, 'echo', 3355),
(102, 'echo', 3355),
(101, 'Lacosta', 1334455),
(100, 'Santa fe', 2339),
(99, '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cinemas`
--

DROP TABLE IF EXISTS `cinemas`;
CREATE TABLE IF NOT EXISTS `cinemas` (
  `IdCinema` int NOT NULL AUTO_INCREMENT,
  `CinemaName` varchar(50) NOT NULL,
  `Address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`IdCinema`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `cinemas`
--

INSERT INTO `cinemas` (`IdCinema`, `CinemaName`, `Address`) VALUES
(9, 'CineNazuti', 'Viamonte 2964'),
(3, 'Pepe', 'Garay 231'),
(10, 'CineCinefa', 'Viamonte 2043');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clasifications`
--

DROP TABLE IF EXISTS `clasifications`;
CREATE TABLE IF NOT EXISTS `clasifications` (
  `IdClasification` int NOT NULL AUTO_INCREMENT,
  `ClasificationCode` varchar(20) DEFAULT NULL,
  `Description` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`IdClasification`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `directors`
--

DROP TABLE IF EXISTS `directors`;
CREATE TABLE IF NOT EXISTS `directors` (
  `IdDirector` int NOT NULL,
  `DirectorName` varchar(50) NOT NULL,
  `BirthDate` date NOT NULL,
  `IdCountry` int NOT NULL,
  PRIMARY KEY (`IdDirector`),
  KEY `Fk_Country` (`IdCountry`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genders`
--

DROP TABLE IF EXISTS `genders`;
CREATE TABLE IF NOT EXISTS `genders` (
  `IdGender` int NOT NULL AUTO_INCREMENT,
  `GenderName` varchar(50) NOT NULL,
  PRIMARY KEY (`IdGender`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movies`
--

DROP TABLE IF EXISTS `movies`;
CREATE TABLE IF NOT EXISTS `movies` (
  `IdMovie` int NOT NULL AUTO_INCREMENT,
  `IdMovieIMDB` int DEFAULT NULL,
  `MovieName` varchar(250) NOT NULL,
  `Duration` varchar(20) DEFAULT NULL,
  `Synopsis` varchar(800) DEFAULT NULL,
  `ReleaseDate` date DEFAULT NULL,
  `Photo` varchar(200) DEFAULT NULL,
  `Earnings` decimal(15,2) DEFAULT NULL,
  `Budget` decimal(15,2) DEFAULT NULL,
  `OriginalLanguage` varchar(30) DEFAULT NULL,
  `IsPlaying` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`IdMovie`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `movies`
--

INSERT INTO `movies` (`IdMovie`, `IdMovieIMDB`, `MovieName`, `Duration`, `Synopsis`, `ReleaseDate`, `Photo`, `Earnings`, `Budget`, `OriginalLanguage`, `IsPlaying`) VALUES
(48, 337401, 'Mulan', '115', 'When the Emperor of China issues a decree that one man per family must serve in the Imperial Chinese Army to defend the country from Huns, Hua Mulan, the eldest daughter of an honored warrior, steps in to take the place of her ailing father. She is spirited, determined and quick on her feet. Disguised as a man by the name of Hua Jun, she is tested every step of the way and must harness her innermost strength and embrace her true potential.', '2020-09-04', 'https://image.tmdb.org/t/p/w500/aKx1ARwG55zZ0GpRvU2WrGrCG9o.jpg', '57000000.00', '200000000.00', 'en', 1),
(49, 635302, 'Demon Slayer: Kimetsu no Yaiba - The Movie: Mugen Train', '117', 'Tanjirō Kamado, joined with Inosuke Hashibira, a boy raised by boars who wears a boar\'s head, and Zenitsu Agatsuma, a scared boy who reveals his true power when he sleeps, boards the Infinity Train on a new mission with the Fire Hashira, Kyōjurō Rengoku, to defeat a demon who has been tormenting the people and killing the demon slayers who oppose it!', '2020-10-16', 'https://image.tmdb.org/t/p/w500/h8Rb9gBr48ODIwYUttZNYeMWeUU.jpg', '150026845.00', '0.00', 'ja', 1),
(50, 560050, 'Over the Moon', '100', 'A girl builds a rocket to travel to the moon in hopes of meeting the legendary Moon Goddess.', '2020-10-16', 'https://image.tmdb.org/t/p/w500/lQfdytwN7eh0tXWjIiMceFdBBvD.jpg', '0.00', '0.00', 'en', 1),
(51, 694919, 'Money Plane', '82', 'A professional thief with $40 million in debt and his family\'s life on the line must commit one final heist - rob a futuristic airborne casino filled with the world\'s most dangerous criminals.', '2020-09-29', 'https://image.tmdb.org/t/p/w500/6CoRTJTmijhBLJTUNoVSUNxZMEI.jpg', '0.00', '0.00', 'en', 1),
(44, 724989, 'Hard Kill', '98', 'The work of billionaire tech CEO Donovan Chalmers is so valuable that he hires mercenaries to protect it, and a terrorist group kidnaps his daughter just to get it.', '2020-10-23', 'https://image.tmdb.org/t/p/w500/ugZW8ocsrfgI95pnQ7wrmKDxIe.jpg', '0.00', '0.00', 'en', 1),
(45, 528085, '2067', '114', 'A lowly utility worker is called to the future by a mysterious radio signal, he must leave his dying wife to embark on a journey that will force him to face his deepest fears in an attempt to change the fabric of reality and save humankind from its greatest environmental crisis yet.', '2020-10-01', 'https://image.tmdb.org/t/p/w500/7D430eqZj8y3oVkLFfsWXGRcpEG.jpg', '0.00', '0.00', 'en', 1),
(46, 531219, 'Roald Dahl\'s The Witches', '106', 'In late 1967, a young orphaned boy goes to live with his loving grandma in the rural Alabama town of Demopolis. As the boy and his grandmother encounter some deceptively glamorous but thoroughly diabolical witches, she wisely whisks him away to a seaside resort. Regrettably, they arrive at precisely the same time that the world\'s Grand High Witch has gathered.', '2020-10-26', 'https://image.tmdb.org/t/p/w500/betExZlgK0l7CZ9CsCBVcwO1OjL.jpg', '0.00', '0.00', 'en', 1),
(47, 446893, 'Trolls World Tour', '91', 'Queen Poppy and Branch make a surprising discovery — there are other Troll worlds beyond their own, and their distinct differences create big clashes between these various tribes. When a mysterious threat puts all of the Trolls across the land in danger, Poppy, Branch, and their band of friends must embark on an epic quest to create harmony among the feuding Trolls to unite them against certain doom.', '2020-03-12', 'https://image.tmdb.org/t/p/w500/7W0G3YECgDAfnuiHG91r8WqgIOe.jpg', '1946164.00', '0.00', 'en', 1),
(52, 539885, 'Ava', '96', 'A black ops assassin is forced to fight for her own survival after a job goes dangerously wrong.', '2020-07-02', 'https://image.tmdb.org/t/p/w500/qzA87Wf4jo1h8JMk9GilyIYvwsA.jpg', '2987741.00', '0.00', 'en', 1),
(53, 671039, 'Rogue City', '116', 'Caught in the crosshairs of police corruption and Marseille’s warring gangs, a loyal cop must protect his squad by taking matters into his own hands.', '2020-10-30', 'https://image.tmdb.org/t/p/w500/9HT9982bzgN5on1sLRmc1GMn6ZC.jpg', '0.00', '0.00', 'fr', 1),
(54, 718444, 'Rogue', '106', 'Battle-hardened O’Hara leads a lively mercenary team of soldiers on a daring mission: rescue hostages from their captors in remote Africa. But as the mission goes awry and the team is stranded, O’Hara’s squad must face a bloody, brutal encounter with a gang of rebels.', '2020-08-20', 'https://image.tmdb.org/t/p/w500/uOw5JD8IlD546feZ6oxbIjvN66P.jpg', '139757.00', '0.00', 'en', 1),
(55, 581392, 'Peninsula', '114', 'A soldier and his team battle hordes of post-apocalyptic zombies in the wastelands of the Korean Peninsula.', '2020-07-15', 'https://image.tmdb.org/t/p/w500/sy6DvAu72kjoseZEjocnm2ZZ09i.jpg', '35878266.00', '17000000.00', 'ko', 1),
(56, 531499, 'The Tax Collector', '95', 'David Cuevas is a family man who works as a gangland tax collector for high ranking Los Angeles gang members. He makes collections across the city with his partner Creeper making sure people pay up or will see retaliation. An old threat returns to Los Angeles that puts everything David loves in harm’s way.', '2020-08-07', 'https://image.tmdb.org/t/p/w500/3eg0kGC2Xh0vhydJHO37Sp4cmMt.jpg', '942666.00', '30000000.00', 'en', 1),
(57, 741074, 'Once Upon a Snowman', '12', 'The previously untold origins of Olaf, the innocent and insightful, summer-loving snowman are revealed as we follow Olaf’s first steps as he comes to life and searches for his identity in the snowy mountains outside Arendelle.', '2020-10-23', 'https://image.tmdb.org/t/p/w500/hddzYJtfYYeMDOQVcH58n8m1W3A.jpg', '0.00', '0.00', 'en', 1),
(58, 613504, 'After We Collided', '105', 'Tessa finds herself struggling with her complicated relationship with Hardin; she faces a dilemma that could change their lives forever.', '2020-09-02', 'https://image.tmdb.org/t/p/w500/kiX7UYfOpYrMFSAGbI6j1pFkLzQ.jpg', '0.00', '0.00', 'en', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `moviesxactor`
--

DROP TABLE IF EXISTS `moviesxactor`;
CREATE TABLE IF NOT EXISTS `moviesxactor` (
  `IdMovie` int NOT NULL,
  `IdActor` int NOT NULL,
  PRIMARY KEY (`IdMovie`,`IdActor`),
  KEY `Fk_Actor` (`IdActor`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `moviesxgender`
--

DROP TABLE IF EXISTS `moviesxgender`;
CREATE TABLE IF NOT EXISTS `moviesxgender` (
  `IdMovie` int NOT NULL,
  `IdGender` int NOT NULL,
  PRIMARY KEY (`IdMovie`,`IdGender`),
  KEY `Fk_Gender` (`IdGender`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nonworkdays`
--

DROP TABLE IF EXISTS `nonworkdays`;
CREATE TABLE IF NOT EXISTS `nonworkdays` (
  `IdNonWorkDay` int NOT NULL AUTO_INCREMENT,
  `DateNonWorkDay` date NOT NULL,
  `Reason` varchar(300) NOT NULL,
  PRIMARY KEY (`IdNonWorkDay`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nonworkdaysxcinemas`
--

DROP TABLE IF EXISTS `nonworkdaysxcinemas`;
CREATE TABLE IF NOT EXISTS `nonworkdaysxcinemas` (
  `IdNonWorkDay` int NOT NULL,
  `IdCinema` int NOT NULL,
  PRIMARY KEY (`IdNonWorkDay`,`IdCinema`),
  KEY `Fk_Cinema` (`IdCinema`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rooms`
--

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE IF NOT EXISTS `rooms` (
  `IdRoom` int NOT NULL AUTO_INCREMENT,
  `RoomNumber` int NOT NULL,
  `Seats` int NOT NULL,
  `Price` int NOT NULL,
  `CinemaId` int NOT NULL,
  PRIMARY KEY (`IdRoom`),
  KEY `Fk_Cinema` (`CinemaId`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `rooms`
--

INSERT INTO `rooms` (`IdRoom`, `RoomNumber`, `Seats`, `Price`, `CinemaId`) VALUES
(12, 0, 0, 0, 1),
(11, 12, 3443, 100, 10),
(10, 1, 234, 69, 9),
(9, 3, 123, 41356, 8),
(8, 1, 2323, 3030, 3),
(7, 1996, 420, 69, 1),
(13, 0, 0, 0, 9),
(14, 0, 0, 0, 1),
(15, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `screenings`
--

DROP TABLE IF EXISTS `screenings`;
CREATE TABLE IF NOT EXISTS `screenings` (
  `IdScreening` int NOT NULL AUTO_INCREMENT,
  `IdMovieIMDB` int NOT NULL,
  `IdMovie` int DEFAULT NULL,
  `StartDate` date NOT NULL,
  `LastDate` date NOT NULL,
  `StartHour` varchar(10) NOT NULL,
  `FinishHour` varchar(10) NOT NULL,
  `Price` decimal(10,0) DEFAULT NULL,
  `IdRoom` int NOT NULL,
  `IdCinema` int NOT NULL,
  `Subtitles` int DEFAULT NULL,
  `Audio` int NOT NULL,
  `Dimension` int NOT NULL,
  PRIMARY KEY (`IdScreening`),
  KEY `Fk_Movie` (`IdMovieIMDB`),
  KEY `Fk_Room` (`IdRoom`),
  KEY `Fk_Cinema` (`IdCinema`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `screenings`
--

INSERT INTO `screenings` (`IdScreening`, `IdMovieIMDB`, `IdMovie`, `StartDate`, `LastDate`, `StartHour`, `FinishHour`, `Price`, `IdRoom`, `IdCinema`, `Subtitles`, `Audio`, `Dimension`) VALUES
(15, 724989, 44, '2020-12-20', '2020-12-21', '12:30', '0000-00-00', '123455', 10, 9, NULL, 0, 3),
(14, 724989, 44, '2020-12-01', '2020-12-02', '12:30', '0000-00-00', '3', 8, 9, NULL, 0, 3),
(13, 531219, 46, '2020-12-20', '2020-12-21', '18:30', '0000-00-00', '90090', 11, 10, NULL, 0, 3),
(16, 724989, 44, '2020-12-20', '2020-12-21', '22:30', '2', '300', 7, 10, NULL, 0, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `IdUser` int NOT NULL AUTO_INCREMENT,
  `UserName` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `UserPassword` varchar(50) NOT NULL,
  `IdGender` int NOT NULL,
  `Photo` varchar(250) DEFAULT NULL,
  `Birthdate` date DEFAULT NULL,
  `IsAdmin` bit(1) DEFAULT NULL,
  `ChangedPassword` bit(1) DEFAULT NULL,
  PRIMARY KEY (`IdUser`),
  UNIQUE KEY `Email` (`Email`),
  KEY `Fk_UsersxGender` (`IdGender`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`IdUser`, `UserName`, `Email`, `UserPassword`, `IdGender`, `Photo`, `Birthdate`, `IsAdmin`, `ChangedPassword`) VALUES
(1, 'Admin', 'admin@gmail.com', '12', 2, '/MoviePass/Views/man-1.png', '1995-01-29', b'1', b'0'),
(6, 'tomas', 'tomas@conchudop', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 3, '/TPFinal/Views/img/other.png', '2020-12-31', b'0', b'0'),
(5, 'tomyhot', 'tomas@hot.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 2, '/TPFinal/Views/img/man-2.png', '2018-11-29', b'0', b'0');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
