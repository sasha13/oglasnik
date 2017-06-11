# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.01 (MySQL 5.7.15)
# Database: oglasnik
# Generation Time: 2017-06-10 00:55:57 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table ads
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ads`;

CREATE TABLE `ads` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `category_id` int(11) unsigned DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `text` text,
  `created_at` date DEFAULT NULL,
  `expires_on` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `ads_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ads_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `ads` WRITE;
/*!40000 ALTER TABLE `ads` DISABLE KEYS */;

INSERT INTO `ads` (`id`, `user_id`, `category_id`, `title`, `text`, `created_at`, `expires_on`)
VALUES
	(1,1,3,'prodajem traktor','                            Citroen Nemo 1.4 HDI 50 kw. 2009 god. Kao nov. Tek ocarinjen . Na ime kupca svi troskovi placeni , vasa je samo registracija ne treba da placate prevod jer je carinjen na firmu. . Motor, limarija, ...                                                                                                                                                ','2017-01-09','2017-02-09'),
	(3,9,4,'Prodajem sokovnik marke Tristar','Prodajem sokovnik marke Tristar, u perfektnom stanju, kao nov, korišten možda jednom, dva puta. Potpuno rasklopiv, lagan za rukovanje i održavanje, može se prati u mašini za suđe. ','2017-11-09','2017-11-09'),
	(4,2,1,'Lux trosoban stan','Lux trosoban stan u urbanoj vili extra kvaliteta, marazzi keramika, blind vrata, grohhe sanitarije, tarkett, video nadzor. Mogucnost kupovine na kredit. Cena je sa PDV-om, za kupce prvog stana','2017-11-09','2017-11-09'),
	(5,2,3,'Dvorisni stan','Dvorisni stan na par minuta peske od glavnog ulaza na festival. Internet, ktv, dva bracna lezaja plus singl kreveti po potrebi. Maksimum 10 osoba. Imam dva stana u istom dvoristu.','2016-11-09','2016-11-09'),
	(6,3,4,'TROSOBAN STAN 84m²','TROSOBAN STAN 84m² – 90.640€ BULEVAR KRALJA PETRA. NOVOGRADNJA. TREĆI SPRAT. LIFT. TERASA. DVA MOKRA ČVORA. STAN UKNJIŽEN, RENOVIRAN, USELJIV. BEZ ULAGANJA','2017-11-09','2017-11-09'),
	(8,5,1,'DROBILICA za led','Ispravna DROBILICA za led nemacke proizvodnje. Kockice leda melje i pretvara u komadice kao u supermarketima na kojima stoji riba. Idealan za sejkove, koktele i ostala osvezavajuca pica','2017-11-09','2017-11-09'),
	(9,7,1,'Pegla za putovanje','Pegla za putovanje, odlicna par puta koriscena, original PHILIPS','2017-11-09','2017-11-09'),
	(10,7,3,'Trosoban stan','Trosoban stan u urbanoj vili extra kvaliteta, marazzi keramika, blind vrata, grohhe sanitarije, tarkett, video nadzor. Mogucnost kupovine na kredit. Cena je sa PDV-om, za kupce prvog stana','2017-11-09','2017-11-09'),
	(11,9,4,'PRODAJEM KLAVIR','PRODAJEM KLAVIR Antikvitet: vrlo redak pianino nemačke marke ’’Ferdinand Manthey’’ proizveden u Mađarskoj 1942. godine, po licenci navedene firme iz Berlina.','2017-11-09','2017-11-09'),
	(14,9,4,'Kupujem kisele macice','Kupujem kisele macice, elektricne gitare,bas gitare, pojacala,miksete,klavijature, studijsku opremu,procesore,pedale... Dolazim, Isplata odmah.                                                ','2017-11-09','2017-11-09'),
	(16,1,3,'PRODAJEM CAMAC SA MATOROM','Prodajem 1,5g star metalni dunavski čamac ali od pre dva dana kompletno ispeskiran ,3 puta premazan osnovnom i zaštitnom farbom i izgleda kao nov,registrovan i motor Honda 8(četvorotakni)','2017-06-10','2017-07-10');

/*!40000 ALTER TABLE `ads` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;

INSERT INTO `categories` (`id`, `name`)
VALUES
	(1,'racunari'),
	(2,'nekretnine'),
	(3,'vozila'),
	(4,'turizam'),
	(5,'usluge');

/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table profiles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `profiles`;

CREATE TABLE `profiles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(64) DEFAULT NULL,
  `last_name` varchar(64) DEFAULT NULL,
  `city` varchar(64) DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `phone` varchar(24) NOT NULL DEFAULT '',
  `user_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `profiles` WRITE;
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;

INSERT INTO `profiles` (`id`, `first_name`, `last_name`, `city`, `age`, `phone`, `user_id`)
VALUES
	(1,'Pera','Peric','Novi Sad',34,'0787636826387',1),
	(2,'Mika','Peric','Beograd',55,'87657766887',2),
	(3,'Zika','Zikic','Babusnica',22,'576567665',3),
	(4,'Voja','Zikic','Kragujevac',44,'765675658787',4),
	(5,'Sergej','Matic','Novi Sad',58,'12435657',5),
	(6,'Vule','Vulic','Negotin',33,'876876868767686',6),
	(7,'Dzej','Ramadanovski','Beograd',73,'76587876868',7),
	(8,'Zoran','Vasic','Zrenjanin',35,'8758768876',8),
	(9,'Mile','Lojpur','Sombor',28,'72872287827',9),
	(10,'Steva','Sinovac','Apatin',39,'1232313111',10);

/*!40000 ALTER TABLE `profiles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(64) NOT NULL DEFAULT '',
  `password` varchar(64) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `email`, `password`)
VALUES
	(1,'pera@example.com','pera'),
	(2,'mika@example.com','zika'),
	(3,'zika@example.com','zika'),
	(4,'voja@example.com','voja'),
	(5,'sergej@example.com','sergej'),
	(6,'vule@example.com','vule'),
	(7,'dzej@example.com','dzej'),
	(8,'zoki@example.com','zoki'),
	(9,'mile@example.com','mile'),
	(10,'steva@example.com','steva');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
