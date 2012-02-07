-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 05-02-2012 a las 08:28:41
-- Versión del servidor: 5.1.44
-- Versión de PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `muucms`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_ads`
--

CREATE TABLE IF NOT EXISTS `muu_ads` (
  `ID_Ad` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(100) NOT NULL,
  `Position` varchar(15) NOT NULL DEFAULT 'Right',
  `Banner` varchar(250) NOT NULL,
  `URL` varchar(250) NOT NULL,
  `Code` text NOT NULL,
  `Clicks` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Start_Date` int(11) NOT NULL DEFAULT '0',
  `End_Date` int(11) NOT NULL DEFAULT '0',
  `Time` mediumint(8) NOT NULL DEFAULT '5000',
  `Principal` tinyint(1) NOT NULL DEFAULT '0',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Ad`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Volcar la base de datos para la tabla `muu_ads`
--

INSERT INTO `muu_ads` (`ID_Ad`, `ID_User`, `Title`, `Position`, `Banner`, `URL`, `Code`, `Clicks`, `Start_Date`, `End_Date`, `Time`, `Principal`, `Situation`) VALUES
(1, 1, 'Anuncio 1', 'Top', 'www/lib/files/images/ads/8c4f7_minilogo.png', 'http://www.codejobs.biz', '', 0, 1327865212, 1330284412, 5000, 1, 'Active'),
(2, 1, 'Anuncio 2', 'Top', 'www/lib/files/images/ads/28410_nuevo-logo.png', 'http://www.zanphp.com', '', 0, 1327866501, 1330285701, 5000, 0, 'Active'),
(3, 1, 'Anuncio 2', 'Top', 'www/lib/files/images/ads/bd705_nuevo-logo.png', 'http://www.zanphp.com', '', 0, 1327866533, 1330285733, 5000, 0, 'Active'),
(4, 1, 'Anuncio 2', 'Top', 'www/lib/files/images/ads/a4049_nuevo-logo.png', 'http://www.zanphp.com', '', 0, 1327866639, 1330285839, 5000, 0, 'Active'),
(5, 1, 'Anuncio 2', 'Top', 'www/lib/files/images/ads/0a080_nuevo-logo.png', 'http://www.zanphp.com', '', 0, 1327866655, 1330285855, 5000, 0, 'Active'),
(6, 1, 'Anuncio 2', 'Top', 'www/lib/files/images/ads/ae6ad_nuevo-logo.png', 'http://www.zanphp.com', '', 0, 1327866697, 1330285897, 5000, 0, 'Active'),
(7, 1, 'Anuncio 2', 'Top', 'www/lib/files/images/ads/0f894_nuevo-logo.png', 'http://www.zanphp.com', '', 0, 1327866716, 1330285916, 5000, 0, 'Active'),
(8, 1, 'Anuncio 2', 'Top', 'www/lib/files/images/ads/45d04_nuevo-logo.png', 'http://www.zanphp.com', '', 0, 1327866733, 1330285933, 5000, 0, 'Active');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_applications`
--

CREATE TABLE IF NOT EXISTS `muu_applications` (
  `ID_Application` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Title` varchar(45) NOT NULL,
  `Slug` varchar(45) NOT NULL,
  `CPanel` tinyint(1) NOT NULL DEFAULT '1',
  `Adding` tinyint(1) NOT NULL,
  `BeDefault` tinyint(1) NOT NULL DEFAULT '1',
  `Comments` tinyint(1) NOT NULL DEFAULT '0',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Application`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Volcar la base de datos para la tabla `muu_applications`
--

INSERT INTO `muu_applications` (`ID_Application`, `Title`, `Slug`, `CPanel`, `Adding`, `BeDefault`, `Comments`, `Situation`) VALUES
(1, 'Ads', 'ads', 1, 1, 0, 0, 'Active'),
(2, 'Applications', 'applications', 1, 1, 0, 0, 'Inactive'),
(3, 'Blog', 'blog', 1, 1, 1, 1, 'Active'),
(4, 'Categories', 'categories', 1, 1, 0, 0, 'Active'),
(5, 'Comments', 'comments', 1, 0, 0, 1, 'Active'),
(6, 'Configuration', 'configuration', 1, 0, 0, 0, 'Active'),
(7, 'Feedback', 'feedback', 1, 0, 0, 0, 'Active'),
(8, 'Forums', 'forums', 1, 1, 1, 0, 'Active'),
(9, 'Gallery', 'gallery', 1, 1, 1, 1, 'Active'),
(10, 'Links', 'links', 1, 1, 1, 0, 'Active'),
(11, 'Messages', 'messages', 1, 1, 0, 0, 'Inactive'),
(12, 'Pages', 'pages', 1, 1, 1, 0, 'Active'),
(13, 'Polls', 'polls', 1, 1, 0, 0, 'Active'),
(14, 'Support', 'support', 1, 1, 0, 0, 'Inactive'),
(15, 'Tags', 'tags', 1, 1, 0, 0, 'Active'),
(16, 'URL', 'url', 1, 1, 0, 0, 'Inactive'),
(17, 'Users', 'users', 1, 1, 0, 0, 'Active'),
(18, 'Videos', 'videos', 1, 1, 1, 0, 'Active'),
(19, 'Works', 'works', 1, 1, 1, 0, 'Active'),
(20, 'Hotels', 'hotels', 1, 1, 1, 0, 'Inactive');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_blog`
--

CREATE TABLE IF NOT EXISTS `muu_blog` (
  `ID_Post` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_URL` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(250) NOT NULL,
  `Slug` varchar(250) NOT NULL,
  `Content` text NOT NULL,
  `Author` varchar(50) NOT NULL,
  `Start_Date` int(11) NOT NULL DEFAULT '0',
  `Text_Date` varchar(40) NOT NULL,
  `Year` varchar(4) NOT NULL,
  `Month` varchar(2) NOT NULL,
  `Day` varchar(2) NOT NULL,
  `Views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Image_Small` varchar(250) DEFAULT NULL,
  `Image_Medium` varchar(250) NOT NULL,
  `Comments` mediumint(8) NOT NULL DEFAULT '0',
  `Enable_Comments` tinyint(1) NOT NULL DEFAULT '0',
  `Language` varchar(20) NOT NULL DEFAULT 'Spanish',
  `Pwd` varchar(40) NOT NULL,
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Post`),
  KEY `ID_User` (`ID_User`),
  KEY `ID_URL` (`ID_URL`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Volcar la base de datos para la tabla `muu_blog`
--

INSERT INTO `muu_blog` (`ID_Post`, `ID_User`, `ID_URL`, `Title`, `Slug`, `Content`, `Author`, `Start_Date`, `Text_Date`, `Year`, `Month`, `Day`, `Views`, `Image_Small`, `Image_Medium`, `Comments`, `Enable_Comments`, `Language`, `Pwd`, `Situation`) VALUES
(1, 1, 1, 'Villa Panamericana abre sus puertas en Guadalajara', 'villa-panamericana-abre-sus-puertas-en-guadalajara', '<p>Las chicas del equipo mexicano de balonmano bromean afuera del comedor. Al fondo, el edificio 4 de la Villa Panamericana ya est&aacute; adornado con banderas nacionales. Ah&iacute; estar&aacute;n todos los deportistas de este pa&iacute;s durante Guadalajara 2011.</p>\r\n<p><!-- pagebreak -->En una de las vialidades, frente a los departamentos que albergar&aacute;n a los deportistas mexicanos, la selecci&oacute;n nacional de judo estalla en una carcajada. Vanessa Zambotti reparti&oacute; chicles entre sus compa&ntilde;eros. Eran de picante. Cayeron en su trampa. No puede parar de re&iacute;r.</p>\r\n<p>Es el buen ambiente que se vive en la Villa Panamericana, que desde ayer se convirti&oacute; oficialmente en la casa de aproximadamente seis mil atletas que competir&aacute;n en Guadalajara 2011, luego de un acto protocolario en que fue entregado el complejo habitacional a la Organizaci&oacute;n Deportiva Panamericana.</p>\r\n<p>En la Plaza de las Banderas, el gobernador de Jalisco y presidente del Comit&eacute; Organizador de los Juegos Panamericanos (Copag), Emilio Gonz&aacute;lez M&aacute;rquez, hizo la entrega formal de la Villa. "Los problemas se han solucionado, los obst&aacute;culos se han resuelto, todos los contratiempos han quedado atr&aacute;s y queda ahora s&oacute;lo el entusiasmo de estos juegos que est&aacute;n ya muy cerca de dar inicio", dijo el mandatario estatal.</p>\r\n<p>"En este lugar, atletas de 42 pa&iacute;ses forjar&aacute;n esa ilusi&oacute;n de llevar triunfos deportivos a sus respectivos pa&iacute;ses. En este lugar es donde se dar&aacute; esa convivencia, reconoci&eacute;ndonos como iguales, como hermanos", a&ntilde;adi&oacute; Gonz&aacute;lez M&aacute;rquez, visiblemente emocionado ante la cercan&iacute;a de la justa continental, que arranca el 14 de octubre.</p>\r\n<p>Mario V&aacute;zquez Ra&ntilde;a, presidente de la Organizaci&oacute;n Deportiva Panamericana (Odepa), fue el encargado de recibir la casa que ya abri&oacute; sus puertas a los atletas de todo el continente. Reconoci&oacute; que tuvo dudas durante el proceso, pero ahora est&aacute; satisfecho de lo que ha encontrado.</p>\r\n<p>"Hicimos un recorrido (por distintas instalaciones panamericanas) y sin duda tuve que decir que es una categor&iacute;a que supera los Juegos Ol&iacute;mpicos. Les puedo decir que me siento satisfecho de todo lo que se ha hecho, porque cuando venimos aqu&iacute; y vimos el terreno (para la Villa), la situaci&oacute;n era como para ponerse a llorar, los d&iacute;as se ven&iacute;an encima y nunca hubiera so&ntilde;ado que hoy tuvi&eacute;ramos esto terminado", admiti&oacute;.</p>\r\n<p>Enseguida, cadetes del Colegio del Aire izaron las primeras banderas de la Villa Panamericana: la de los Juegos de Guadalajara 2011, la del Comit&eacute; Ol&iacute;mpico Internacional y la de la Organizaci&oacute;n Deportiva Panamericana. Las tres ondean ya y en los pr&oacute;ximos d&iacute;as se les unir&aacute;n las de 42 pa&iacute;ses que luchar&aacute;n desde el 14 de octubre por alcanzar la gloria.</p>', 'Carlos Santana', 1317791460, 'Miércoles, 05 de Octubre de 2011', '2011', '10', '05', 7, 'www/lib/files/images/blog/small_b50bb_villac.jpg', 'www/lib/files/images/blog/medium_b50bb_villac.jpg', 0, 1, 'Spanish', '', 'Active'),
(2, 1, 1, 'Un muerto tras choques en Arizona por tormenta de arena', 'un-muerto-tras-choques-en-arizona-por-tormenta-de-arena', '<p><span id="contentNote">Una cegadora tormenta de arena caus&oacute; el martes <strong>tres colisiones m&uacute;ltiples</strong> en una transitada carrera de Arizona que dejaron al menos un muerto y 15 lesionados, informaron las autoridades.<br /> <br /> El Departamento de Seguridad P&uacute;blica de Arizona dijo que 24 veh&iacute;culos participaron en los tres choques sobre la Interestatal 10.Las dos primeras colisiones ocurrieron poco despu&eacute;s del mediod&iacute;a cerca de la localidad de Picacho, casi a la mitad del tramo entre Phoenix y Tucson. <br /> <br /> En esos incidentes hubo 16 unidades involucradas, incluyendo camiones con remolque.El vocero de Seguridad P&uacute;blica, Bart Graves, indic&oacute; que dos personas lesionadas en esos choques estaban en situaci&oacute;n "muy cr&iacute;tica" . <br /> <br /> La densa concentraci&oacute;n de arena en la atm&oacute;sfera impidi&oacute; que las autoridades utilizasen helic&oacute;pteros para llevarlas al hospital.<br /> <br /> La tercera colisi&oacute;n tuvo lugar entre ocho veh&iacute;culos casi dos horas despu&eacute;s al norte de la poblaci&oacute;n de Casa Grande. Graves dijo que no hubo muertos en este caso pero que dos personas sufrieron lesiones graves, pero sin riesgo mortal.</span></p>', 'Carlos Santana', 1317792224, 'Miércoles, 05 de Octubre de 2011', '2011', '10', '05', 1, 'www/lib/files/images/blog/small_df352_trailersarena.jpg', 'www/lib/files/images/blog/medium_df352_trailersarena.jpg', 0, 1, 'Spanish', '', 'Active'),
(3, 1, 1, 'Helicóptero se estrella en río Este de Nueva York', 'helicoptero-se-estrella-en-rio-este-de-nueva-york', '<p>Un helic&oacute;ptero se estrell&oacute; hoy en el r&iacute;o Este de Nueva York con cinco personas a bordo, de las que ya han sido rescatadas cuatro de ellas, y que ha ocasionado un fuerte despliegue de seguridad en la zona.</p>\r\n<p>Un portavoz policial confirm&oacute; a el accidente ocurri&oacute; en el helipuerto, que se ubica a la altura de la calle 34, y que por el momento no est&aacute;n claras las causas del incidente, que seg&uacute;n diversos medios estar&iacute;a relacionado con el despegue de la aeronave.</p>\r\n<p>Por su parte, un portavoz del Departamento de Bomberos de Nueva York confirm&oacute; que dos de las v&iacute;ctimas del accidente han sido trasladadas al cercano Hospital Bellevue, mientras que una tercera contin&uacute;a en el lugar del suceso, aunque se desconoce el estado de todas ellas.</p>\r\n<p>La operaci&oacute;n de rescate ha hecho que se trasladaran hasta la zona m&aacute;s de una docena de embarcaciones del servicio de guardacostas y de la Polic&iacute;a de Nueva York.</p>\r\n<p>La aeronave ha quedado completamente sumergida en aguas del r&iacute;o Este de Nueva York y varios equipos de submarinistas buscan a la quinta v&iacute;ctima.<br /> El portavoz de la Polic&iacute;a de Nueva York, Paul Browne, se&ntilde;al&oacute; a la prensa que la nave siniestrada es un helic&oacute;ptero comercial del tipo Bell 206.</p>\r\n<p>Las escenas que muestran las cadenas de televisi&oacute;n estadounidenses, con numerosas embarcaciones de rescate, recuerdan a la operaci&oacute;n que desplegaron el 15 de enero de 2009, cuando un avi&oacute;n de la aerol&iacute;nea US Airways se precipit&oacute; sobre las aguas del r&iacute;o Hudson (en el oeste de Nueva York) y la pericia de su piloto, el capit&aacute;n Chesley Sullenberger, salv&oacute; a las 155 personas a bordo.</p>', 'Carlos Santana', 1317792293, 'Miércoles, 05 de Octubre de 2011', '2011', '10', '05', 4, 'www/lib/files/images/blog/small_2df72_rescateheli.jpg', 'www/lib/files/images/blog/medium_2df72_rescateheli.jpg', 0, 1, 'Spanish', '', 'Active'),
(4, 1, 1, 'Europa, fuente de estrés financiero: Bernanke', 'europa-fuente-de-estres-financiero-bernanke', '<p>El presidente de la <strong>Reserva Federal</strong> de EU, <strong>Ben Bernanke</strong>, se&ntilde;al&oacute; hoy en una comparecencia ante el Congreso que la crisis de la deuda en <strong>Europa</strong> ha sido una "significativa" <strong>fuente de estr&eacute;s</strong> en "los mercados globales financieros".</p>\r\n<p><img style="float: right;" src="http://www.eluniversal.com.mx/img/2011/10/Fin/bernanke_incierto.JPG" alt="" width="302" height="380" /></p>\r\n<p>"Los l&iacute;deres europeos est&aacute;n fuertemente comprometidos para encarar estos problemas, pero necesitan obtener un acuerdo entre un amplio n&uacute;mero de pa&iacute;ses para poner en marcha mecanismos de defensa y la b&uacute;squeda de las causas de los problemas fiscales han ralentizado la puesta en pr&aacute;ctica de soluciones" , afirm&oacute; Bernanke.</p>\r\n<p>El presidente de la FED asegur&oacute; que "no hay duda de que estas tensiones han da&ntilde;ado la confianza de las empresas y los hogares, y que suponen riesgos continuados sobre el crecimiento".</p>', 'Carlos Santana', 1317792440, 'Miércoles, 05 de Octubre de 2011', '2011', '10', '05', 6, 'www/lib/files/images/blog/small_a675c_010jefe-reserva1a.jpg', 'www/lib/files/images/blog/medium_a675c_010jefe-reserva1a.jpg', 0, 1, 'Spanish', '', 'Active'),
(5, 1, 1, 'Columna de Pedro', 'columna-de-pedro', '<p>Esta columna es de Pedro, bla bla bla blalalalalalalalal</p>\r\n<p>adasdasdasdasd</p>\r\n<p>asdasdasdasdasd</p>', 'Carlos Santana', 1318457550, 'Miércoles, 12 de Octubre de 2011', '2011', '10', '12', 0, '', '', 0, 1, 'Spanish', '', 'Active'),
(6, 1, 1, 'Video', 'video', '<p style="text-align: center;">[Video: http://www.youtube.com/watch?v=ml86k17mtJg]</p>', 'Carlos Santana', 1318980020, 'Martes, 18 de Octubre de 2011', '2011', '10', '18', 2, 'www/lib/files/images/blog/small_b1f89_273629-100002559760317-69636310-n.jpg', 'www/lib/files/images/blog/medium_b1f89_273629-100002559760317-69636310-n.jpg', 0, 1, 'Spanish', '', 'Active');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_categories`
--

CREATE TABLE IF NOT EXISTS `muu_categories` (
  `ID_Category` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Parent` tinyint(4) DEFAULT '0',
  `Title` varchar(90) DEFAULT NULL,
  `Slug` varchar(90) DEFAULT NULL,
  `Language` varchar(10) DEFAULT NULL,
  `Situation` varchar(15) DEFAULT 'Active',
  PRIMARY KEY (`ID_Category`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Volcar la base de datos para la tabla `muu_categories`
--

INSERT INTO `muu_categories` (`ID_Category`, `ID_Parent`, `Title`, `Slug`, `Language`, `Situation`) VALUES
(1, 0, 'Noticias Internacionales', 'noticias-internacionales', 'Spanish', 'Active'),
(2, 0, 'Noticias Nacionales', 'noticias-nacionales', 'Spanish', 'Active'),
(3, 0, 'Noticias Estatales', 'noticias-estatales', 'Spanish', 'Active'),
(4, 0, 'Noticias Locales', 'noticias-locales', 'Spanish', 'Active'),
(5, 0, 'Deportes Extremos', 'deportes-extremos', 'Spanish', 'Active'),
(6, 0, 'Baloncesto', 'baloncesto', 'Spanish', 'Active'),
(7, 0, 'Box', 'box', 'Spanish', 'Active'),
(8, 0, 'Lucha Libre', 'lucha-libre', 'Spanish', 'Active'),
(9, 0, 'Fútbol', 'futbol', 'Spanish', 'Active'),
(10, 0, 'Muay Thai', 'muay-thai', 'Spanish', 'Active'),
(11, 0, 'Surfing', 'surfing', 'Spanish', 'Active'),
(12, 0, 'Voleyball', 'voleyball', 'Spanish', 'Active'),
(13, 0, 'Espectáculos', 'espectaculos', 'Spanish', 'Active'),
(14, 0, 'Ellas', 'ellas', 'Spanish', 'Active'),
(15, 0, 'Ellos', 'ellos', 'Spanish', 'Active'),
(16, 0, 'Antros', 'antros', 'Spanish', 'Active'),
(17, 0, 'Cumpleaños', 'cumpleanos', 'Spanish', 'Active'),
(18, 0, 'Bautizos', 'bautizos', 'Spanish', 'Active'),
(19, 0, 'XV Años', 'xv-anos', 'Spanish', 'Active'),
(20, 0, 'Bodas', 'bodas', 'Spanish', 'Active'),
(21, 0, 'Infantil', 'infantil', 'Spanish', 'Active'),
(22, 0, 'Cúpido', 'cupido', 'Spanish', 'Active'),
(23, 0, 'Playas', 'playas', 'Spanish', 'Active'),
(24, 0, 'La Grilla', 'la-grilla', 'Spanish', 'Active');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_comments`
--

CREATE TABLE IF NOT EXISTS `muu_comments` (
  `ID_Comment` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Comment` text NOT NULL,
  `Start_Date` int(11) NOT NULL,
  `Text_Date` varchar(40) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Email` varchar(60) NOT NULL,
  `Website` varchar(80) NOT NULL,
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Comment`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_comments`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_configuration`
--

CREATE TABLE IF NOT EXISTS `muu_configuration` (
  `ID_Configuration` tinyint(1) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Slogan_English` varchar(100) NOT NULL,
  `Slogan_Spanish` varchar(100) NOT NULL,
  `Slogan_French` varchar(100) NOT NULL,
  `Slogan_Portuguese` varchar(100) NOT NULL,
  `URL` varchar(60) NOT NULL,
  `Lang` varchar(2) NOT NULL DEFAULT 'en',
  `Language` varchar(25) NOT NULL DEFAULT 'English',
  `Theme` varchar(25) NOT NULL DEFAULT 'ZanPHP',
  `Gallery` varchar(30) NOT NULL DEFAULT 'Basic',
  `Validation` varchar(15) NOT NULL DEFAULT 'Super Admin',
  `Application` varchar(30) NOT NULL DEFAULT 'Blog',
  `Message` text NOT NULL,
  `Activation` varchar(10) NOT NULL DEFAULT 'Nobody',
  `Email_Recieve` varchar(50) NOT NULL,
  `Email_Send` varchar(50) NOT NULL DEFAULT '@domain.com',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Configuration`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `muu_configuration`
--

INSERT INTO `muu_configuration` (`ID_Configuration`, `Name`, `Slogan_English`, `Slogan_Spanish`, `Slogan_French`, `Slogan_Portuguese`, `URL`, `Lang`, `Language`, `Theme`, `Gallery`, `Validation`, `Application`, `Message`, `Activation`, `Email_Recieve`, `Email_Send`, `Situation`) VALUES
(1, 'Visión 7', 'Vision Seven', 'Visión 7', 'Vision Zeven', 'Vision Xeven', 'http://127.0.0.1/MuuCMS', 'es', 'Spanish', 'zanphp', '1', 'Inactive', 'blog', '<p>Regresamos pronto2222</p>', 'Admin', 'carlos@milkzoft.com', 'webmaster@milkzoft.com', 'Active');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_feedback`
--

CREATE TABLE IF NOT EXISTS `muu_feedback` (
  `ID_Feedback` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(60) NOT NULL,
  `Company` varchar(50) NOT NULL,
  `Phone` varchar(16) NOT NULL,
  `City` varchar(50) NOT NULL,
  `Subject` varchar(200) NOT NULL,
  `Message` text NOT NULL,
  `Start_Date` int(11) NOT NULL,
  `Text_Date` varchar(60) NOT NULL,
  `Situation` varchar(15) NOT NULL DEFAULT 'Inactive',
  PRIMARY KEY (`ID_Feedback`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `muu_feedback`
--

INSERT INTO `muu_feedback` (`ID_Feedback`, `Name`, `Email`, `Company`, `Phone`, `City`, `Subject`, `Message`, `Start_Date`, `Text_Date`, `Situation`) VALUES
(1, 'asdasdasd', 'azapedia@gmail.com', 'sadsad', 'asdsad', '', 'asdsad', 'pasdsadsad/p', 1318460076, 'Miércoles, 12 de Octubre de 2011', 'Inactive');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_forums`
--

CREATE TABLE IF NOT EXISTS `muu_forums` (
  `ID_Forum` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Title` varchar(120) NOT NULL,
  `Slug` varchar(120) NOT NULL,
  `Description` varchar(250) NOT NULL,
  `Topics` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Last_Reply` int(11) unsigned NOT NULL DEFAULT '0',
  `Last_Date` varchar(50) NOT NULL,
  `Language` varchar(20) NOT NULL DEFAULT 'Spanish',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Forum`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `muu_forums`
--

INSERT INTO `muu_forums` (`ID_Forum`, `Title`, `Slug`, `Description`, `Topics`, `Replies`, `Last_Reply`, `Last_Date`, `Language`, `Situation`) VALUES
(1, 'Programación', 'programación', 'asdasaasñdlqwleñ3423$%$&$/&%YW$"#R!!""""''''''addsadasd', 0, 0, 0, '', 'Spanish', 'Active'),
(2, 'New Forum', 'new-forum', 'asdsadasdasd', 1, 1, 2, '', 'English', 'Active');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_forums_posts`
--

CREATE TABLE IF NOT EXISTS `muu_forums_posts` (
  `ID_Post` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Forum` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Parent` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(150) NOT NULL,
  `Slug` varchar(150) NOT NULL,
  `Content` text NOT NULL,
  `Author` varchar(50) NOT NULL,
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `Text_Date` varchar(50) NOT NULL,
  `Hour` varchar(15) NOT NULL DEFAULT '00:00:00',
  `Visits` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Topic` tinyint(1) NOT NULL DEFAULT '0',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Post`),
  KEY `ID_User` (`ID_User`),
  KEY `ID_Forum` (`ID_Forum`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `muu_forums_posts`
--

INSERT INTO `muu_forums_posts` (`ID_Post`, `ID_User`, `ID_Forum`, `ID_Parent`, `Title`, `Slug`, `Content`, `Author`, `Start_Date`, `Text_Date`, `Hour`, `Visits`, `Topic`, `Situation`) VALUES
(1, 1, 2, 0, 'sadasdasdasd', 'sadasdasdasd', '<p>lkasdkasjdkasjdaksd</p>', 'Carlos Santana', 1314834397, 'Thursday, September 01, 2011', '01:46:37', 5, 1, '1'),
(2, 1, 2, 1, 'Re: sadasdasdasd', 're-sadasdasdasd', '<p>sadsadasdasd</p>', 'Carlos Santana', 1314834408, 'Thursday, September 01, 2011', '01:46:48', 0, 0, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_gallery`
--

CREATE TABLE IF NOT EXISTS `muu_gallery` (
  `ID_Image` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(100) NOT NULL,
  `Slug` varchar(100) NOT NULL,
  `Description` varchar(250) NOT NULL,
  `Small` varchar(255) NOT NULL,
  `Medium` varchar(255) NOT NULL,
  `Original` varchar(255) NOT NULL,
  `Album` varchar(50) NOT NULL DEFAULT 'None',
  `Album_Slug` varchar(150) NOT NULL DEFAULT 'None',
  `Start_Date` int(11) NOT NULL,
  `Text_Date` varchar(50) NOT NULL,
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Image`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_gallery`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_gallery_themes`
--

CREATE TABLE IF NOT EXISTS `muu_gallery_themes` (
  `ID_Gallery_Theme` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Title` varchar(50) NOT NULL,
  `Slug` varchar(50) NOT NULL,
  `Description` varchar(200) NOT NULL,
  PRIMARY KEY (`ID_Gallery_Theme`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_gallery_themes`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_hotels`
--

CREATE TABLE IF NOT EXISTS `muu_hotels` (
  `ID_Hotel` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Parent` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Name` varchar(255) NOT NULL,
  `Slug` varchar(255) NOT NULL,
  `Category` varchar(45) DEFAULT '5 Estrellas',
  `Emails_Reservation` varchar(250) DEFAULT NULL,
  `Address` varchar(255) NOT NULL,
  `Country` varchar(100) NOT NULL,
  `District` varchar(100) NOT NULL,
  `Town` varchar(100) NOT NULL,
  `City` varchar(100) DEFAULT NULL,
  `Zip_Code` varchar(10) DEFAULT NULL,
  `Telephone` varchar(45) NOT NULL,
  `Area` varchar(10) DEFAULT NULL,
  `Views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Website` varchar(255) DEFAULT NULL,
  `Author` varchar(50) NOT NULL,
  `Start_Date` int(11) NOT NULL,
  `Text_Date` varchar(40) NOT NULL,
  `Language` varchar(20) NOT NULL DEFAULT 'Spanish',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Hotel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_hotels`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_hotels_amenities`
--

CREATE TABLE IF NOT EXISTS `muu_hotels_amenities` (
  `ID_Amenity` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(250) NOT NULL,
  `Slug` varchar(250) NOT NULL,
  `Image` varchar(250) NOT NULL,
  `Language` varchar(20) NOT NULL DEFAULT 'Spanish',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Amenity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_hotels_amenities`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_hotels_contacts`
--

CREATE TABLE IF NOT EXISTS `muu_hotels_contacts` (
  `ID_Contact` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Hotel` mediumint(8) unsigned NOT NULL,
  `Contact_Manager` text,
  `Contact_Principal` text,
  `Contact_Accounting` text,
  `Contact_Reservation` text,
  `Contact_Property` text,
  PRIMARY KEY (`ID_Contact`),
  KEY `fk_muu_hotels_contacts_1` (`ID_Hotel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_hotels_contacts`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_hotels_information`
--

CREATE TABLE IF NOT EXISTS `muu_hotels_information` (
  `ID_Hotel_Information` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Hotel` mediumint(8) unsigned NOT NULL,
  `Room_Number` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Year_Construction` varchar(5) DEFAULT NULL,
  `Year_Remodelation` varchar(5) DEFAULT NULL,
  `Agency_Commision` varchar(5) DEFAULT NULL,
  `In_Time` varchar(10) DEFAULT NULL,
  `Out_Time` varchar(10) DEFAULT NULL,
  `Max_Year_Children` tinyint(1) DEFAULT NULL,
  `Min_Days_Reservation` tinyint(1) DEFAULT NULL,
  `Days_Prev_Reservation` tinyint(1) DEFAULT NULL,
  `Days_Prev_Cancelation` tinyint(1) DEFAULT NULL,
  `Airport` text,
  `Near_Citys` text,
  `City_Activities` text,
  `Hotel_Activities` text,
  `Hotel_Near_Activities` text,
  `Restaurants_Bar` text,
  `Rooms_Information` text,
  `Hotel_Ubication` text,
  `Rates_Information` text,
  PRIMARY KEY (`ID_Hotel_Information`),
  KEY `fk_muu_hotels_information_1` (`ID_Hotel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_hotels_information`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_hotels_policy`
--

CREATE TABLE IF NOT EXISTS `muu_hotels_policy` (
  `ID_Policy` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Hotel` mediumint(8) unsigned NOT NULL,
  `Cancellation_Policy` text,
  `No_Arrival_Policy` text,
  `Extra_Person_Policy` text,
  `Childrens_Policy` text,
  `Pets_Policy` text,
  `Pre_Policy` text,
  PRIMARY KEY (`ID_Policy`),
  KEY `fk_muu_hotels_policy_1` (`ID_Hotel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_hotels_policy`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_hotels_rates`
--

CREATE TABLE IF NOT EXISTS `muu_hotels_rates` (
  `ID_Rate` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Start_Date` int(11) NOT NULL,
  `End_Date` int(11) NOT NULL,
  `Start_Date_Text` varchar(45) NOT NULL,
  `End_Date_Text` varchar(45) NOT NULL,
  `Name` varchar(150) NOT NULL,
  `Cost` varchar(10) NOT NULL,
  `Language` varchar(20) NOT NULL DEFAULT 'Spanish',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Rate`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_hotels_rates`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_hotels_rooms`
--

CREATE TABLE IF NOT EXISTS `muu_hotels_rooms` (
  `ID_Room` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(250) NOT NULL,
  `Slug` varchar(250) NOT NULL,
  `Bed_Type` varchar(250) NOT NULL,
  `Max_Occupation` tinyint(1) NOT NULL,
  `Number_Rooms` varchar(5) NOT NULL,
  `Description` text NOT NULL,
  `Language` varchar(20) NOT NULL DEFAULT 'Spanish',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Room`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_hotels_rooms`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_links`
--

CREATE TABLE IF NOT EXISTS `muu_links` (
  `ID_Link` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(50) NOT NULL,
  `URL` varchar(100) NOT NULL,
  `Description` varchar(100) NOT NULL,
  `Follow` tinyint(1) NOT NULL DEFAULT '1',
  `Position` varchar(10) NOT NULL DEFAULT 'Web Friend',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Link`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Volcar la base de datos para la tabla `muu_links`
--

INSERT INTO `muu_links` (`ID_Link`, `ID_User`, `Title`, `URL`, `Description`, `Follow`, `Position`, `Situation`) VALUES
(4, 1, 'ZanPHP', 'http://www.zanphp.com', 'Framework', 1, '1', 'Active'),
(5, 1, 'MilkZoft', 'http://www.milkzoft.com', 'asdasdasd', 1, 'Web Friend', 'Active'),
(6, 1, 'MilkZoft', 'http://www.milkzoft.com', 'asdasdasd', 1, 'Web Friend', 'Inactive');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_logs`
--

CREATE TABLE IF NOT EXISTS `muu_logs` (
  `ID_Log` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Record` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Table_Name` varchar(50) NOT NULL,
  `Activity` varchar(100) NOT NULL,
  `Query` text NOT NULL,
  `Start_Date` datetime NOT NULL,
  PRIMARY KEY (`ID_Log`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_logs`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_messages`
--

CREATE TABLE IF NOT EXISTS `muu_messages` (
  `ID_Message` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Parent` mediumint(8) unsigned NOT NULL,
  `ID_From_User` mediumint(8) unsigned NOT NULL,
  `ID_To_User` mediumint(8) unsigned NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Slug` varchar(150) NOT NULL,
  `Message` text NOT NULL,
  `Start_Date` int(11) NOT NULL,
  `Text_Date` varchar(60) NOT NULL,
  `Situation` varchar(15) NOT NULL DEFAULT 'Unread',
  PRIMARY KEY (`ID_Message`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_messages`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_mural`
--

CREATE TABLE IF NOT EXISTS `muu_mural` (
  `ID_Mural` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Post` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(200) NOT NULL,
  `URL` varchar(250) NOT NULL,
  `Image` varchar(250) NOT NULL,
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Mural`),
  KEY `ID_Post` (`ID_Post`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `muu_mural`
--

INSERT INTO `muu_mural` (`ID_Mural`, `ID_Post`, `Title`, `URL`, `Image`, `Situation`) VALUES
(1, 1, 'Villa Panamericana abre sus puertas en Guadalajara', 'http://localhost/muucms/index.php/es/blog/2011/10/05/villa-panamericana-abre-sus-puertas-en-guadalajara', 'www/lib/files/images/mural/b50bb_85f3d-casas.jpg', 'Active'),
(2, 2, 'Un muerto tras choques en Arizona por tormenta de arena', 'http://localhost/muucms/index.php/es/blog/2011/10/05/un-muerto-tras-choques-en-arizona-por-tormenta-de-arena', 'www/lib/files/images/mural/df352_muralillo.png', 'Active');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_pages`
--

CREATE TABLE IF NOT EXISTS `muu_pages` (
  `ID_Page` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Translation` mediumint(8) NOT NULL DEFAULT '0',
  `Title` varchar(100) NOT NULL,
  `Slug` varchar(100) NOT NULL,
  `Content` text NOT NULL,
  `Views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Language` varchar(20) NOT NULL,
  `Principal` tinyint(1) NOT NULL DEFAULT '0',
  `Start_Date` int(11) NOT NULL,
  `Text_Date` varchar(40) NOT NULL,
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Page`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_pages`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_polls`
--

CREATE TABLE IF NOT EXISTS `muu_polls` (
  `ID_Poll` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(255) NOT NULL,
  `Type` varchar(10) DEFAULT 'Simple',
  `Start_Date` int(11) NOT NULL,
  `Text_Date` varchar(40) NOT NULL,
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Poll`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `muu_polls`
--

INSERT INTO `muu_polls` (`ID_Poll`, `ID_User`, `Title`, `Type`, `Start_Date`, `Text_Date`, `Situation`) VALUES
(1, 1, '¿Qué pedo?', 'Simple', 1317848411, 'Miércoles, 05 de Octubre de 2011', 'Active');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_polls_answers`
--

CREATE TABLE IF NOT EXISTS `muu_polls_answers` (
  `ID_Answer` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Poll` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Answer` varchar(100) NOT NULL,
  `Votes` mediumint(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_Answer`),
  KEY `ID_Poll` (`ID_Poll`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `muu_polls_answers`
--

INSERT INTO `muu_polls_answers` (`ID_Answer`, `ID_Poll`, `Answer`, `Votes`) VALUES
(1, 1, 'Que paso', 3),
(2, 1, 'Quien sabe', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_polls_ips`
--

CREATE TABLE IF NOT EXISTS `muu_polls_ips` (
  `ID_Poll` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `IP` varchar(15) NOT NULL,
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `End_Date` int(11) unsigned NOT NULL DEFAULT '0',
  KEY `ID_Poll` (`ID_Poll`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `muu_polls_ips`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_privileges`
--

CREATE TABLE IF NOT EXISTS `muu_privileges` (
  `ID_Privilege` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Privilege` varchar(25) NOT NULL DEFAULT 'Member',
  PRIMARY KEY (`ID_Privilege`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcar la base de datos para la tabla `muu_privileges`
--

INSERT INTO `muu_privileges` (`ID_Privilege`, `Privilege`) VALUES
(1, 'Super Admin'),
(2, 'Admin'),
(3, 'Moderator'),
(4, 'Member');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_re_categories_applications`
--

CREATE TABLE IF NOT EXISTS `muu_re_categories_applications` (
  `ID_Category2Application` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Application` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Category` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_Category2Application`),
  KEY `ID_Application` (`ID_Application`),
  KEY `ID_Category` (`ID_Category`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Volcar la base de datos para la tabla `muu_re_categories_applications`
--

INSERT INTO `muu_re_categories_applications` (`ID_Category2Application`, `ID_Application`, `ID_Category`) VALUES
(1, 3, 1),
(2, 3, 2),
(3, 3, 3),
(4, 3, 4),
(5, 3, 5),
(6, 3, 6),
(7, 3, 7),
(8, 3, 8),
(9, 3, 9),
(10, 3, 10),
(11, 3, 11),
(12, 3, 12),
(13, 3, 13),
(14, 3, 14),
(15, 3, 15),
(16, 3, 16),
(17, 3, 17),
(18, 3, 18),
(19, 3, 19),
(20, 3, 20),
(21, 3, 21),
(22, 3, 22),
(23, 3, 23),
(24, 3, 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_re_categories_records`
--

CREATE TABLE IF NOT EXISTS `muu_re_categories_records` (
  `ID_Category2Application` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Record` mediumint(8) unsigned NOT NULL DEFAULT '0',
  KEY `ID_Category2Application` (`ID_Category2Application`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `muu_re_categories_records`
--

INSERT INTO `muu_re_categories_records` (`ID_Category2Application`, `ID_Record`) VALUES
(2, 1),
(1, 2),
(5, 3),
(1, 4),
(24, 5),
(23, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_re_comments_applications`
--

CREATE TABLE IF NOT EXISTS `muu_re_comments_applications` (
  `ID_Comment2Application` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Application` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Comment` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_Comment2Application`),
  KEY `ID_Application` (`ID_Application`),
  KEY `ID_Comment` (`ID_Comment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_re_comments_applications`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_re_comments_records`
--

CREATE TABLE IF NOT EXISTS `muu_re_comments_records` (
  `ID_Comment2Application` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Record` mediumint(8) unsigned NOT NULL DEFAULT '0',
  KEY `ID_Comment2Application` (`ID_Comment2Application`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `muu_re_comments_records`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_re_hotels_amenities`
--

CREATE TABLE IF NOT EXISTS `muu_re_hotels_amenities` (
  `ID_Amenity` mediumint(8) unsigned NOT NULL,
  `ID_Hotel` mediumint(8) unsigned NOT NULL,
  KEY `fk_muu_re_hotels_amenities_1` (`ID_Amenity`),
  KEY `fk_muu_re_hotels_amenities_2` (`ID_Hotel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `muu_re_hotels_amenities`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_re_hotels_rates`
--

CREATE TABLE IF NOT EXISTS `muu_re_hotels_rates` (
  `ID_Rate` mediumint(8) unsigned NOT NULL,
  `ID_Hotel` mediumint(8) unsigned NOT NULL,
  KEY `fk_muu_re_hotels_rates_1` (`ID_Rate`),
  KEY `fk_muu_re_hotels_rates_2` (`ID_Hotel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `muu_re_hotels_rates`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_re_hotels_rooms`
--

CREATE TABLE IF NOT EXISTS `muu_re_hotels_rooms` (
  `ID_Room` mediumint(8) unsigned NOT NULL,
  `ID_Hotel` mediumint(8) unsigned NOT NULL,
  KEY `fk_muu_re_hotels_rooms_1` (`ID_Room`),
  KEY `fk_muu_re_hotels_rooms_2` (`ID_Hotel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `muu_re_hotels_rooms`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_re_permissions_privileges`
--

CREATE TABLE IF NOT EXISTS `muu_re_permissions_privileges` (
  `ID_Privilege` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Application` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Adding` tinyint(1) NOT NULL DEFAULT '0',
  `Deleting` tinyint(1) NOT NULL DEFAULT '0',
  `Editing` tinyint(1) NOT NULL DEFAULT '0',
  `Viewing` tinyint(1) NOT NULL DEFAULT '0',
  KEY `ID_Privilege` (`ID_Privilege`),
  KEY `ID_Application` (`ID_Application`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `muu_re_permissions_privileges`
--

INSERT INTO `muu_re_permissions_privileges` (`ID_Privilege`, `ID_Application`, `Adding`, `Deleting`, `Editing`, `Viewing`) VALUES
(1, 1, 1, 1, 1, 1),
(1, 2, 1, 1, 1, 1),
(1, 3, 1, 1, 1, 1),
(1, 4, 1, 1, 1, 1),
(1, 5, 1, 1, 1, 1),
(1, 6, 1, 1, 1, 1),
(1, 7, 1, 1, 1, 1),
(1, 8, 1, 1, 1, 1),
(1, 9, 1, 1, 1, 1),
(1, 10, 1, 1, 1, 1),
(1, 11, 1, 1, 1, 1),
(1, 12, 1, 1, 1, 1),
(1, 13, 1, 1, 1, 1),
(1, 14, 1, 1, 1, 1),
(1, 15, 1, 1, 1, 1),
(1, 16, 1, 1, 1, 1),
(1, 17, 1, 1, 1, 1),
(1, 18, 1, 1, 1, 1),
(1, 19, 1, 1, 1, 1),
(2, 1, 1, 1, 1, 1),
(2, 2, 0, 0, 0, 0),
(2, 3, 1, 1, 1, 1),
(2, 4, 1, 1, 1, 1),
(2, 5, 0, 0, 0, 0),
(2, 6, 0, 0, 0, 0),
(2, 7, 0, 0, 0, 1),
(2, 8, 1, 1, 1, 1),
(2, 9, 1, 1, 1, 1),
(2, 10, 1, 1, 1, 1),
(2, 11, 1, 0, 1, 1),
(2, 12, 1, 1, 1, 1),
(2, 13, 1, 0, 0, 0),
(2, 14, 1, 1, 1, 1),
(2, 15, 1, 1, 1, 1),
(2, 16, 1, 1, 1, 1),
(2, 17, 1, 1, 1, 1),
(2, 18, 1, 1, 1, 1),
(2, 19, 1, 1, 1, 1),
(3, 1, 0, 0, 0, 0),
(3, 2, 0, 0, 0, 0),
(3, 3, 1, 0, 0, 1),
(3, 4, 1, 0, 0, 0),
(3, 5, 0, 0, 0, 0),
(3, 6, 0, 0, 0, 0),
(3, 7, 0, 0, 0, 0),
(3, 8, 1, 0, 0, 1),
(3, 9, 0, 0, 0, 0),
(3, 10, 0, 0, 0, 0),
(3, 11, 1, 0, 0, 1),
(3, 12, 0, 0, 0, 0),
(3, 13, 0, 0, 0, 0),
(3, 14, 0, 0, 0, 0),
(3, 15, 1, 0, 0, 1),
(3, 16, 1, 0, 0, 1),
(3, 17, 0, 0, 0, 0),
(3, 18, 1, 0, 0, 1),
(3, 19, 0, 0, 0, 0),
(4, 1, 0, 0, 0, 0),
(4, 2, 0, 0, 0, 0),
(4, 3, 0, 0, 0, 0),
(4, 4, 0, 0, 0, 0),
(4, 5, 0, 0, 0, 0),
(4, 6, 0, 0, 0, 0),
(4, 7, 0, 0, 0, 0),
(4, 8, 0, 0, 0, 0),
(4, 9, 0, 0, 0, 0),
(4, 10, 0, 0, 0, 0),
(4, 11, 0, 0, 0, 0),
(4, 12, 0, 0, 0, 0),
(4, 13, 0, 0, 0, 0),
(4, 14, 0, 0, 0, 0),
(4, 15, 0, 0, 0, 0),
(4, 16, 0, 0, 0, 0),
(4, 17, 0, 0, 0, 0),
(4, 18, 0, 0, 0, 0),
(4, 19, 0, 0, 0, 0),
(1, 20, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_re_privileges_users`
--

CREATE TABLE IF NOT EXISTS `muu_re_privileges_users` (
  `ID_Privilege` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  KEY `ID_Privilege` (`ID_Privilege`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `muu_re_privileges_users`
--

INSERT INTO `muu_re_privileges_users` (`ID_Privilege`, `ID_User`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_re_tags_applications`
--

CREATE TABLE IF NOT EXISTS `muu_re_tags_applications` (
  `ID_Tag2Application` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Application` mediumint(8) unsigned NOT NULL,
  `ID_Tag` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`ID_Tag2Application`),
  KEY `ID_Application` (`ID_Application`),
  KEY `ID_Tag` (`ID_Tag`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcar la base de datos para la tabla `muu_re_tags_applications`
--

INSERT INTO `muu_re_tags_applications` (`ID_Tag2Application`, `ID_Application`, `ID_Tag`) VALUES
(1, 3, 1),
(2, 3, 2),
(3, 3, 3),
(4, 3, 4),
(5, 3, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_re_tags_records`
--

CREATE TABLE IF NOT EXISTS `muu_re_tags_records` (
  `ID_Tag2Application` mediumint(8) unsigned NOT NULL,
  `ID_Record` mediumint(8) unsigned NOT NULL,
  KEY `ID_Tag2Application` (`ID_Tag2Application`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `muu_re_tags_records`
--

INSERT INTO `muu_re_tags_records` (`ID_Tag2Application`, `ID_Record`) VALUES
(1, 1),
(2, 1),
(3, 2),
(4, 2),
(5, 3),
(3, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_support`
--

CREATE TABLE IF NOT EXISTS `muu_support` (
  `ID_Ticket` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Parent` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(250) NOT NULL,
  `Slug` varchar(250) NOT NULL,
  `Content` text NOT NULL,
  `Image` varchar(255) NOT NULL,
  `Code` varchar(10) NOT NULL,
  `Start_Date` int(11) NOT NULL DEFAULT '0',
  `Text_Date` varchar(40) NOT NULL,
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Ticket`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_support`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_tags`
--

CREATE TABLE IF NOT EXISTS `muu_tags` (
  `ID_Tag` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Title` varchar(255) NOT NULL,
  `Slug` varchar(255) NOT NULL,
  `Situation` varchar(15) NOT NULL DEFAULT 'Acitve',
  PRIMARY KEY (`ID_Tag`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcar la base de datos para la tabla `muu_tags`
--

INSERT INTO `muu_tags` (`ID_Tag`, `Title`, `Slug`, `Situation`) VALUES
(1, 'Panamericanos', 'panamericanos', 'Acitve'),
(2, 'Guadalajara', 'guadalajara', 'Acitve'),
(3, 'Accidentes', 'accidentes', 'Acitve'),
(4, 'Aviones', 'aviones', 'Acitve'),
(5, 'Helicopteros', 'helicopteros', 'Acitve');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_tokens`
--

CREATE TABLE IF NOT EXISTS `muu_tokens` (
  `ID_Token` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Token` varchar(40) NOT NULL,
  `Action` varchar(50) NOT NULL,
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `End_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `Situation` varchar(10) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Token`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_tokens`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_url`
--

CREATE TABLE IF NOT EXISTS `muu_url` (
  `ID_URL` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `URL` varchar(255) NOT NULL,
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_URL`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Volcar la base de datos para la tabla `muu_url`
--

INSERT INTO `muu_url` (`ID_URL`, `URL`, `Situation`) VALUES
(1, 'http://localhost/tudestino/index.php/es/blog/2011/09/30/publicacion-1', 'Active'),
(2, 'http://127.0.0.1/tudestino/index.php/es/blog/2011/10/02/se-estrello-un-avion', 'Active'),
(3, 'http://127.0.0.1/tudestino/index.php/es/blog/2011/10/02/una-noticia-de-espectaculos', 'Active'),
(4, 'http://127.0.0.1/tudestino/index.php/es/blog/2011/10/02/nueva-publicacion', 'Active'),
(5, 'http://127.0.0.1/tudestino/index.php/es/blog/2011/10/02/publicacion-1', 'Active'),
(6, 'http://127.0.0.1/tudestino/index.php/es/blog/2011/10/02/publicacion-2', 'Active'),
(7, 'http://127.0.0.1/tudestino/index.php/es/blog/2011/10/02/publicacion-3a', 'Active'),
(8, 'http://127.0.0.1/tudestino/index.php/es/blog/2011/10/02/publicacion-4', 'Active'),
(9, 'http://127.0.0.1/tudestino/index.php/es/blog/2011/10/02/otra-mas', 'Active'),
(10, 'http://127.0.0.1/tudestino/index.php/es/blog/2011/10/02/sdsadsadsad', 'Active'),
(11, 'http://127.0.0.1/tudestino/index.php/es/blog/2011/10/02/esta-noticia-tiene-un-titulo-bastante-largo-he-dicho-senores', 'Active'),
(12, 'http://127.0.0.1/tudestino/index.php/es/blog/2011/10/02/esta-noticia-tiene-un-titulo-bastante-largo-he-dicho-senores2', 'Active'),
(13, 'http://127.0.0.1/tudestino/index.php/es/blog/2011/10/02/esta-noticia-tiene-un-titulo-bastante-largo-he-dicho-senores3', 'Active'),
(14, 'http://127.0.0.1/tudestino/index.php/es/blog/2011/10/02/la-ultima-y-nos-vamos', 'Active'),
(15, 'http://127.0.0.1/tudestino/index.php/es/blog/2011/10/03/dsadasdasd', 'Active'),
(16, 'http://localhost/muucms/index.php/es/blog/2011/10/05/villa-panamericana-abre-sus-puertas-en-guadalajara', 'Active'),
(17, 'http://localhost/muucms/index.php/es/blog/2011/10/05/villa-panamericana-abre-sus-puertas-en-guadalajara', 'Active'),
(18, 'http://localhost/muucms/index.php/es/blog/2011/10/05/un-muerto-tras-choques-en-arizona-por-tormenta-de-arena', 'Active'),
(19, 'http://localhost/muucms/index.php/es/blog/2011/10/05/helicoptero-se-estrella-en-rio-este-de-nueva-york', 'Active'),
(20, 'http://localhost/muucms/index.php/es/blog/2011/10/05/europa-fuente-de-estres-financiero-bernanke', 'Active'),
(21, 'http://localhost/muucms/index.php/es/blog/2011/10/12/columna-de-pedro', 'Active'),
(22, 'http://localhost/muucms/index.php/es/blog/2011/10/18/video', 'Active');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_users`
--

CREATE TABLE IF NOT EXISTS `muu_users` (
  `ID_User` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Username` varchar(30) NOT NULL,
  `Pwd` varchar(40) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `Website` varchar(100) NOT NULL,
  `Avatar` varchar(200) NOT NULL,
  `Rank` varchar(30) NOT NULL DEFAULT 'Member',
  `Sign` text NOT NULL,
  `Messages` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Recieve_Messages` tinyint(1) NOT NULL DEFAULT '1',
  `Topics` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Visits` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Comments` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Subscribed` tinyint(1) NOT NULL DEFAULT '0',
  `Start_Date` int(11) NOT NULL,
  `Code` varchar(10) NOT NULL,
  `God` tinyint(1) NOT NULL DEFAULT '0',
  `Privilege` varchar(50) NOT NULL DEFAULT 'Member',
  `Type` varchar(30) NOT NULL DEFAULT 'Normal',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_User`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `muu_users`
--

INSERT INTO `muu_users` (`ID_User`, `Username`, `Pwd`, `Email`, `Website`, `Avatar`, `Rank`, `Sign`, `Messages`, `Recieve_Messages`, `Topics`, `Replies`, `Visits`, `Comments`, `Subscribed`, `Start_Date`, `Code`, `God`, `Privilege`, `Type`, `Situation`) VALUES
(1, 'Carlos Santana', '99b94460aa941d668e60262be137c7187045ed45', 'carlos@milkzoft.com', 'www.facebook.com', 'lib/files/images/users/mini_6c2e9_tumblr_lhzl83rr8r1qho0hpo1_500.jpg', 'Administrator', '<p><em><strong>qweqleqwkeqwkneqwe</strong></em></p>\r\n<p><em><strong>qweqweqwe<br /></strong></em></p>', 0, 1, 9, 1, 92, 0, 0, 1304740493, '3628FB9CC0', 0, 'Super Admin', 'Normal', 'Active');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_users_information`
--

CREATE TABLE IF NOT EXISTS `muu_users_information` (
  `ID_User_Information` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Name` varchar(60) NOT NULL,
  `Phone` varchar(15) NOT NULL,
  `Company` varchar(50) NOT NULL,
  `Gender` varchar(20) NOT NULL,
  `Birthday` varchar(20) NOT NULL,
  `Country` varchar(50) NOT NULL,
  `District` varchar(50) NOT NULL,
  `Town` varchar(50) NOT NULL,
  `Facebook` varchar(100) NOT NULL,
  `Twitter` varchar(100) NOT NULL,
  `Linkedin` varchar(150) NOT NULL,
  `Google` varchar(150) NOT NULL,
  PRIMARY KEY (`ID_User_Information`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `muu_users_information`
--

INSERT INTO `muu_users_information` (`ID_User_Information`, `ID_User`, `Name`, `Phone`, `Company`, `Gender`, `Birthday`, `Country`, `District`, `Town`, `Facebook`, `Twitter`, `Linkedin`, `Google`) VALUES
(1, 1, 'Carlos Santana Roldan', '', 'MilkZoft', 'Male', '11/09/1991', 'México', 'Colima', 'Colima', 'czantany', 'czantany', 'dasdadsa', '1241241241241241');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_users_online`
--

CREATE TABLE IF NOT EXISTS `muu_users_online` (
  `User` varchar(20) NOT NULL DEFAULT '',
  `Start_Date` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`User`),
  KEY `Date_Start` (`Start_Date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `muu_users_online`
--

INSERT INTO `muu_users_online` (`User`, `Start_Date`) VALUES
('Carlos Santana', 1314834244);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_users_online_anonymous`
--

CREATE TABLE IF NOT EXISTS `muu_users_online_anonymous` (
  `IP` varchar(20) NOT NULL DEFAULT '',
  `Start_Date` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`IP`),
  KEY `Date_Start` (`Start_Date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `muu_users_online_anonymous`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_videos`
--

CREATE TABLE IF NOT EXISTS `muu_videos` (
  `ID_Video` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_YouTube` varchar(20) NOT NULL,
  `Title` varchar(150) NOT NULL,
  `Slug` varchar(150) NOT NULL,
  `Description` varchar(250) NOT NULL,
  `URL` varchar(250) NOT NULL,
  `Server` varchar(25) NOT NULL DEFAULT 'YouTube',
  `Duration` varchar(10) NOT NULL,
  `Views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Start_Date` int(11) NOT NULL,
  `Text_Date` varchar(40) NOT NULL,
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Video`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Volcar la base de datos para la tabla `muu_videos`
--

INSERT INTO `muu_videos` (`ID_Video`, `ID_User`, `ID_YouTube`, `Title`, `Slug`, `Description`, `URL`, `Server`, `Duration`, `Views`, `Start_Date`, `Text_Date`, `Situation`) VALUES
(1, 1, 'ibvuhCoBkZo', 'Danny Don''t Know', 'danny-don-t-know', 'Danny Kass tried his hand at baseball, football, basketball and hockey in this Nike Snowboarding tribute to the iconic Nike Bo Know''s campaign. Snowboarder Magazine editor Pat Bridges makes a cameo and narrates as Danny fails to succeed at just about', '', 'YouTube', '', 0, 1318366023, 'Martes, 11 de Octubre de 2011', 'Active'),
(2, 1, 'mrncemuUbC8', 'The Nike MAG', 'the-nike-mag', 'Introducing the future of Nike Footwear. The 2011 Nike MAG shoes have arrived. 1500 of the famous, LED-electroluminescent shoes will be auctioned on eBay, Sept 8th - Sept 18th. All net proceeds from the auction sales will go directly to The Michael J', '', 'YouTube', '', 0, 1318366023, 'Martes, 11 de Octubre de 2011', 'Active'),
(3, 1, '57IrhtYSi60', 'Nike Chosen Crew Contest Final Recap', 'nike-chosen-crew-contest-final-recap', 'Throughout the summer thousands of crews in the Nike Chosen crew video contest brought their creativity to the world stage. After Nike selected 9 crews from 12 countries to advance into Round 2, the worldwide community narrowed the field to three fin', '', 'YouTube', '', 0, 1318366023, 'Martes, 11 de Octubre de 2011', 'Active'),
(4, 1, 'io6dJr5UyDc', 'Nike Chosen: Behind the scenes athlete choice teaser', 'nike-chosen-behind-the-scenes-athlete-choice-teaser', 'Today is the moment of truth. The world has spoken and we are down to our Top 3 finalist. Now it''s up to the athletes to decide.\r\n\r\nTune into http://www.usopenofsurfing.com/live.cfm as p-rod and friends announce which crew has been Chosen. The select', '', 'YouTube', '', 0, 1318481701, 'Jueves, 13 de Octubre de 2011', 'Active'),
(5, 1, 'qIm5BbcB7UI', 'Nike Chosen: Live from the US Open Round 2 Update Ep. 3', 'nike-chosen-live-from-the-us-open-round-2-update-ep-3', 'Checking in live from the US Open to see the current Round 2 leaders of the Nike Chosen crew video contest.\r\n\r\nTo vote for your favorites crew go to http://www.nike.com/chosen', '', 'YouTube', '', 0, 1318481701, 'Jueves, 13 de Octubre de 2011', 'Active'),
(6, 1, 'jiVHz9mx8Qg', 'Nike Chosen: Live from the US Open Round 2 Update Ep. 2', 'nike-chosen-live-from-the-us-open-round-2-update-ep-2', 'Checking in live from the US Open to see the current Round 2 leaders of the Nike Chosen crew video contest.\r\n\r\nTo vote for your favorites crew go to http://www.nike.com/chosen', '', 'YouTube', '', 0, 1318481701, 'Jueves, 13 de Octubre de 2011', 'Active'),
(7, 1, 'i4pr-hAypLs', 'Nike Chosen: Live from the US Open Round 2 Update Ep. 1', 'nike-chosen-live-from-the-us-open-round-2-update-ep-1', 'Checking in live from the US Open to see the current Round 2 leaders of the Nike Chosen crew video contest.', '', 'YouTube', '', 0, 1318481701, 'Jueves, 13 de Octubre de 2011', 'Active'),
(8, 1, 's-_2Hrh_v-E', 'Nike CHOSEN crew contest: Round 1 Recap', 'nike-chosen-crew-contest-round-1-recap', 'During the past 8 weeks we''ve seen over 1,800 crews in 12 countries who submitted videos for the world to see.\r\n\r\nWe saw creativity and we saw style, we saw originality and we saw progression. Many thanks to all the crews who took the time to share t', '', 'YouTube', '', 0, 1318481701, 'Jueves, 13 de Octubre de 2011', 'Active'),
(9, 1, '22unJBq5jIE', 'Nike CHOSEN: Noticed! episode 6 feat. a JUSTanDO ITinerÃƒÂ¡rio', 'nike-chosen-noticed-episode-6-feat-a-justando-itiner-rio', 'A Justando Itinerario has been Noticed! These guys have been catching the eyes of a lot of people throughout this entire campaign with their creative videos and unique crew personality. Check out what these Florianopolis, Brasil surfers have to say a', '', 'YouTube', '', 0, 1318481701, 'Jueves, 13 de Octubre de 2011', 'Active'),
(10, 1, 'DEa_OVsZcDQ', 'Nike CHOSEN: Week 6 Recap', 'nike-chosen-week-6-recap', 'With only one week left in the first round, the crews have come out firing on all cylinders. Watch the week 6 recap as we take you across the globe to highlight some of the best and most creative videos that caught our eye this week.\n\nSee more and fi', '', 'YouTube', '', 0, 1318481701, 'Jueves, 13 de Octubre de 2011', 'Active'),
(11, 1, 'PHB4OEsHCDQ', 'Nike Chosen: Noticed! Episode 5 feat. Eastside', 'nike-chosen-noticed-episode-5-feat-eastside', 'Each week, we''ll show you the top crews from around the world that are bringing fresh and unexpected creativity to the Chosen crew video contest or creating buzz in Facebook.\r\n\r\nThe 5th episode finds us in Germany, where the Eastside crew took their ', '', 'YouTube', '', 0, 1318481701, 'Jueves, 13 de Octubre de 2011', 'Active'),
(12, 1, 'CC40tFUWtqo', 'Carissa Moore 2011 ASP Women''s World Champion', 'carissa-moore-2011-asp-women-s-world-champion', 'Greatness never comes easy, it takes time, the time to learn, have fun and commit. Carissa Moore has clearly made the most of her time, becoming the youngest World Champion surfing has ever seen. \r\n\r\nJUST DO IT.', '', 'YouTube', '', 0, 1318481701, 'Jueves, 13 de Octubre de 2011', 'Active'),
(13, 1, 'oe91waJOcy8', 'Nike CHOSEN: Week 5 Recap', 'nike-chosen-week-5-recap', 'Check out our fifth weekly recap.  It''s turning into a fireworks show, folks.  Don''t miss the crews and videos that have put the rest of the crews in the contest on notice.\r\n\r\nThis week saw the Brasilians join the party in a big way and our first wom', '', 'YouTube', '', 0, 1318481701, 'Jueves, 13 de Octubre de 2011', 'Active'),
(14, 1, 'KRGyG-hLkls', 'Nike Chosen: Week 4 Recap', 'nike-chosen-week-4-recap', 'Each week, we''ll show you the top crews from around the world that are bringing fresh and unexpected creativity to the Chosen crew video contest or creating buzz in Facebook.\r\n\r\nSee more and find out how your crew could be chosen to live like a pro a', '', 'YouTube', '', 0, 1318481701, 'Jueves, 13 de Octubre de 2011', 'Active'),
(15, 1, 'StONoQiUAgU', 'Nike Chosen: Noticed! Episode 4 feat. FAMILIA CREW', 'nike-chosen-noticed-episode-4-feat-familia-crew', 'Each week, we''ll show you the top crews from around the world that are bringing fresh and unexpected creativity to the Chosen crew video contest or creating buzz in Facebook.\r\n\r\nThe 4th episode finds us in Minnesota, USA where "Familia" has been Noti', '', 'YouTube', '', 0, 1318481701, 'Jueves, 13 de Octubre de 2011', 'Active'),
(16, 1, 'BLGQbxwER9s', 'Nike Chosen: Week 3 Recap', 'nike-chosen-week-3-recap', 'Each week, we''ll show you the top crews from around the world that are bringing fresh and unexpected creativity to the Chosen crew video contest or creating buzz in Facebook.\r\n\r\nSee more and find out how your crew could be chosen to live like a pro a', '', 'YouTube', '', 0, 1318481701, 'Jueves, 13 de Octubre de 2011', 'Active'),
(17, 1, '3osb4IYOw2Q', 'Nike BetterWorld - History featuring Phil Knight', 'nike-betterworld-history-featuring-phil-knight', 'Learn about the history of Nike Better World from Nike Chairman and co-founder Phil Knight.', '', 'YouTube', '', 0, 1318481701, 'Jueves, 13 de Octubre de 2011', 'Active'),
(18, 1, '-csUyhptv-o', 'Nike Chosen: Week 2 Recap', 'nike-chosen-week-2-recap', 'Each week, we''ll show you the top crews from around the world that are either bringing fresh and unexpected creativity to the Chosen crew video contest or creating a ton of buzz for themselves in Facebook.\r\n\r\nSee more and find out how your crew could', '', 'YouTube', '', 0, 1318481701, 'Jueves, 13 de Octubre de 2011', 'Active'),
(19, 1, 'G_FltasM3c8', 'Hurricane Jova slammed into Mexico''s Pacific coast as a Category 2 storm', 'hurricane-jova-slammed-into-mexico-s-pacific-coast-as-a-category-2-storm', 'A man wades through a flooded street in Manzanillo, Colima State, Mexico. Jova lost its hurricane status but remained a deadly threat as a huge storm system, dumping torrential rain across much of Mexico''s Pacific coast and triggering flooding and po', '', 'YouTube', '', 0, 1318980161, 'Martes, 18 de Octubre de 2011', 'Active'),
(20, 1, '7rR41R3zNPM', 'Hurricane Jova Barra de Navidad 2011', 'hurricane-jova-barra-de-navidad-2011', 'Barra de Navidad Jalisco, Mexico was spared a direct hit from hurricane Jova, but did not survive without any wounds. The beach structures took most of the beating. \nJova came by at a category 2 hurricane.\nOne person reported 15 inches of rain.', '', 'YouTube', '', 0, 1318980161, 'Martes, 18 de Octubre de 2011', 'Active'),
(21, 1, 'qQEVmNqIYNw', 'Hurricane Jova In The Eastern Pacific Ocean Threatens Mexico Coast Region -- Report', 'hurricane-jova-in-the-eastern-pacific-ocean-threatens-mexico-coast-region-report', 'UPDATE II (10.11.11 at 7:00am ET): \r\n\r\n"Hurricane Jova -- Projected Path And Satellite Imagery"\r\nhttp://bit.ly/pPCle2\r\n\r\n*\r\n\r\nUPDATE:\r\n\r\n"Hurricane warning issued as Jova approaches Mexico" (includes map of the projected cone of the Hurricane as it a', '', 'YouTube', '', 0, 1318980161, 'Martes, 18 de Octubre de 2011', 'Active');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_works`
--

CREATE TABLE IF NOT EXISTS `muu_works` (
  `ID_Work` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Title` varchar(100) NOT NULL,
  `Slug` varchar(100) NOT NULL,
  `Preview1` varchar(200) NOT NULL,
  `Preview2` varchar(200) NOT NULL,
  `Image` varchar(200) NOT NULL,
  `URL` varchar(100) NOT NULL,
  `Description` text NOT NULL,
  `Situation` varchar(10) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Work`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_works`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_world`
--

CREATE TABLE IF NOT EXISTS `muu_world` (
  `Continent` varchar(20) NOT NULL,
  `Code` varchar(5) NOT NULL,
  `Country` varchar(100) NOT NULL,
  `District` varchar(100) NOT NULL,
  `Town` varchar(100) NOT NULL,
  KEY `District` (`District`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `muu_world`
--

INSERT INTO `muu_world` (`Continent`, `Code`, `Country`, `District`, `Town`) VALUES
('America', 'ARG', 'Argentina', 'Buenos Aires', ''),
('America', 'ARG', 'Argentina', 'Catamarca', ''),
('America', 'ARG', 'Argentina', 'Chaco', ''),
('America', 'ARG', 'Argentina', 'Chubut', ''),
('America', 'ARG', 'Argentina', 'C', ''),
('America', 'ARG', 'Argentina', 'Corrientes', ''),
('America', 'ARG', 'Argentina', 'Distrito Federal', ''),
('America', 'ARG', 'Argentina', 'Entre Rios', ''),
('America', 'ARG', 'Argentina', 'Formosa', ''),
('America', 'ARG', 'Argentina', 'Jujuy', ''),
('America', 'ARG', 'Argentina', 'La Rioja', ''),
('America', 'ARG', 'Argentina', 'Mendoza', ''),
('America', 'ARG', 'Argentina', 'Misiones', ''),
('America', 'ARG', 'Argentina', 'Neuqu', ''),
('America', 'ARG', 'Argentina', 'Salta', ''),
('America', 'ARG', 'Argentina', 'San Juan', ''),
('America', 'ARG', 'Argentina', 'San Luis', ''),
('America', 'ARG', 'Argentina', 'Santa F', ''),
('America', 'ARG', 'Argentina', 'Santiago del Estero', ''),
('America', 'ARG', 'Argentina', 'Tucum', ''),
('America', 'BLZ', 'Belize', 'Belize City', ''),
('America', 'BLZ', 'Belize', 'Cayo', ''),
('America', 'BOL', 'Bolivia', 'Chuquisaca', ''),
('America', 'BOL', 'Bolivia', 'Cochabamba', ''),
('America', 'BOL', 'Bolivia', 'La Paz', ''),
('America', 'BOL', 'Bolivia', 'Oruro', ''),
('America', 'BOL', 'Bolivia', 'Potos', ''),
('America', 'BOL', 'Bolivia', 'Santa Cruz', ''),
('America', 'BOL', 'Bolivia', 'Tarija', ''),
('America', 'BRA', 'Brazil', 'Acre', ''),
('America', 'BRA', 'Brazil', 'Alagoas', ''),
('America', 'BRA', 'Brazil', 'Amap', ''),
('America', 'BRA', 'Brazil', 'Amazonas', ''),
('America', 'BRA', 'Brazil', 'Bahia', ''),
('America', 'BRA', 'Brazil', 'Cear', ''),
('America', 'BRA', 'Brazil', 'Distrito Federal', ''),
('America', 'BRA', 'Brazil', 'Esp', ''),
('America', 'BRA', 'Brazil', 'Goi', ''),
('America', 'BRA', 'Brazil', 'Maranh', ''),
('America', 'BRA', 'Brazil', 'Mato Grosso', ''),
('America', 'BRA', 'Brazil', 'Mato Grosso do Sul', ''),
('America', 'BRA', 'Brazil', 'Minas Gerais', ''),
('America', 'BRA', 'Brazil', 'Par', ''),
('America', 'BRA', 'Brazil', 'Para', ''),
('America', 'BRA', 'Brazil', 'Paran', ''),
('America', 'BRA', 'Brazil', 'Pernambuco', ''),
('America', 'BRA', 'Brazil', 'Piau', ''),
('America', 'BRA', 'Brazil', 'Rio de Janeiro', ''),
('America', 'BRA', 'Brazil', 'Rio Grande do Norte', ''),
('America', 'BRA', 'Brazil', 'Rio Grande do Sul', ''),
('America', 'BRA', 'Brazil', 'Rond', ''),
('America', 'BRA', 'Brazil', 'Roraima', ''),
('America', 'BRA', 'Brazil', 'Santa Catarina', ''),
('America', 'BRA', 'Brazil', 'S', ''),
('America', 'BRA', 'Brazil', 'Sergipe', ''),
('America', 'BRA', 'Brazil', 'Tocantins', ''),
('America', 'CAN', 'Canada', 'Alberta', ''),
('America', 'CAN', 'Canada', 'British Colombia', ''),
('America', 'CAN', 'Canada', 'Manitoba', ''),
('America', 'CAN', 'Canada', 'Newfoundland', ''),
('America', 'CAN', 'Canada', 'Nova Scotia', ''),
('America', 'CAN', 'Canada', 'Ontario', ''),
('America', 'CAN', 'Canada', 'Qu', ''),
('America', 'CAN', 'Canada', 'Saskatchewan', ''),
('America', 'CHL', 'Chile', 'Antofagasta', ''),
('America', 'CHL', 'Chile', 'Atacama', ''),
('America', 'CHL', 'Chile', 'B', ''),
('America', 'CHL', 'Chile', 'Coquimbo', ''),
('America', 'CHL', 'Chile', 'La Araucan', ''),
('America', 'CHL', 'Chile', 'Los Lagos', ''),
('America', 'CHL', 'Chile', 'Magallanes', ''),
('America', 'CHL', 'Chile', 'Maule', ''),
('America', 'CHL', 'Chile', 'Santiago', ''),
('America', 'CHL', 'Chile', 'Tarapac', ''),
('America', 'CHL', 'Chile', 'Valpara', ''),
('America', 'COL', 'Colombia', 'Antioquia', ''),
('America', 'COL', 'Colombia', 'Atl', ''),
('America', 'COL', 'Colombia', 'Bol', ''),
('America', 'COL', 'Colombia', 'Boyac', ''),
('America', 'COL', 'Colombia', 'Caldas', ''),
('America', 'COL', 'Colombia', 'Caquet', ''),
('America', 'COL', 'Colombia', 'Cauca', ''),
('America', 'COL', 'Colombia', 'Cesar', ''),
('America', 'COL', 'Colombia', 'C', ''),
('America', 'COL', 'Colombia', 'Cundinamarca', ''),
('America', 'COL', 'Colombia', 'Huila', ''),
('America', 'COL', 'Colombia', 'La Guajira', ''),
('America', 'COL', 'Colombia', 'Magdalena', ''),
('America', 'COL', 'Colombia', 'Meta', ''),
('America', 'COL', 'Colombia', 'Norte de Santander', ''),
('America', 'COL', 'Colombia', 'Quind', ''),
('America', 'COL', 'Colombia', 'Risaralda', ''),
('America', 'COL', 'Colombia', 'Santaf', ''),
('America', 'COL', 'Colombia', 'Santander', ''),
('America', 'COL', 'Colombia', 'Sucre', ''),
('America', 'COL', 'Colombia', 'Tolima', ''),
('America', 'COL', 'Colombia', 'Valle', ''),
('America', 'CRI', 'Costa Rica', 'San Jos', ''),
('America', 'CUB', 'Cuba', 'Ciego de ', ''),
('America', 'CUB', 'Cuba', 'Cienfuegos', ''),
('America', 'CUB', 'Cuba', 'Granma', ''),
('America', 'CUB', 'Cuba', 'Guant', ''),
('America', 'CUB', 'Cuba', 'Holgu', ''),
('America', 'CUB', 'Cuba', 'La Habana', ''),
('America', 'CUB', 'Cuba', 'Las Tunas', ''),
('America', 'CUB', 'Cuba', 'Matanzas', ''),
('America', 'CUB', 'Cuba', 'Pinar del R', ''),
('America', 'CUB', 'Cuba', 'Santiago de Cuba', ''),
('America', 'CUB', 'Cuba', 'Villa Clara', ''),
('America', 'CYM', 'Cayman Islands', 'Grand Cayman', ''),
('America', 'DMA', 'Dominica', 'St George', ''),
('America', 'DOM', 'Dominican Republic', 'Distrito Nacional', ''),
('America', 'DOM', 'Dominican Republic', 'Duarte', ''),
('America', 'DOM', 'Dominican Republic', 'La Romana', ''),
('America', 'DOM', 'Dominican Republic', 'Puerto Plata', ''),
('America', 'DOM', 'Dominican Republic', 'San Pedro de Macor', ''),
('America', 'DOM', 'Dominican Republic', 'Santiago', ''),
('America', 'ECU', 'Ecuador', 'Azuay', ''),
('America', 'ECU', 'Ecuador', 'Chimborazo', ''),
('America', 'ECU', 'Ecuador', 'El Oro', ''),
('America', 'ECU', 'Ecuador', 'Esmeraldas', ''),
('America', 'ECU', 'Ecuador', 'Guayas', ''),
('America', 'ECU', 'Ecuador', 'Imbabura', ''),
('America', 'ECU', 'Ecuador', 'Loja', ''),
('America', 'ECU', 'Ecuador', 'Los R', ''),
('America', 'ECU', 'Ecuador', 'Manab', ''),
('America', 'ECU', 'Ecuador', 'Pichincha', ''),
('America', 'ECU', 'Ecuador', 'Tungurahua', ''),
('America', 'SLV', 'El Salvador', 'La Libertad', ''),
('America', 'SLV', 'El Salvador', 'San Miguel', ''),
('America', 'SLV', 'El Salvador', 'San Salvador', ''),
('America', 'SLV', 'El Salvador', 'Santa Ana', ''),
('America', 'GTM', 'Guatemala', 'Guatemala', ''),
('America', 'GTM', 'Guatemala', 'Quetzaltenango', ''),
('America', 'HND', 'Honduras', 'Atl', ''),
('America', 'HND', 'Honduras', 'Cort', ''),
('America', 'HND', 'Honduras', 'Distrito Central', ''),
('America', 'MEX', 'Mexico', 'Aguascalientes', ''),
('America', 'MEX', 'Mexico', 'Baja California', ''),
('America', 'MEX', 'Mexico', 'Baja California Sur', ''),
('America', 'MEX', 'Mexico', 'Campeche', ''),
('America', 'MEX', 'Mexico', 'Chiapas', ''),
('America', 'MEX', 'Mexico', 'Chihuahua', ''),
('America', 'MEX', 'Mexico', 'Coahuila de Zaragoza', ''),
('America', 'MEX', 'Mexico', 'Colima', ''),
('America', 'MEX', 'Mexico', 'Colima', 'Armer'),
('America', 'MEX', 'Mexico', 'Colima', 'Colima'),
('America', 'MEX', 'Mexico', 'Colima', 'Comala'),
('America', 'MEX', 'Mexico', 'Colima', 'Coquimatl'),
('America', 'MEX', 'Mexico', 'Colima', 'Cuauht'),
('America', 'MEX', 'Mexico', 'Colima', 'Ixtlahuac'),
('America', 'MEX', 'Mexico', 'Colima', 'Manzanillo'),
('America', 'MEX', 'Mexico', 'Colima', 'Minatitl'),
('America', 'MEX', 'Mexico', 'Colima', 'Tecom'),
('America', 'MEX', 'Mexico', 'Colima', 'Villa de '),
('America', 'MEX', 'Mexico', 'Distrito Federal', ''),
('America', 'MEX', 'Mexico', 'Durango', ''),
('America', 'MEX', 'Mexico', 'Guanajuato', ''),
('America', 'MEX', 'Mexico', 'Guerrero', ''),
('America', 'MEX', 'Mexico', 'Hidalgo', ''),
('America', 'MEX', 'Mexico', 'Jalisco', ''),
('America', 'MEX', 'Mexico', 'M', ''),
('America', 'MEX', 'Mexico', 'Michoac', ''),
('America', 'MEX', 'Mexico', 'Morelos', ''),
('America', 'MEX', 'Mexico', 'Nayarit', ''),
('America', 'MEX', 'Mexico', 'Nuevo Le', ''),
('America', 'MEX', 'Mexico', 'Oaxaca', ''),
('America', 'MEX', 'Mexico', 'Puebla', ''),
('America', 'MEX', 'Mexico', 'Quer', ''),
('America', 'MEX', 'Mexico', 'Quer', ''),
('America', 'MEX', 'Mexico', 'Quintana Roo', ''),
('America', 'MEX', 'Mexico', 'San Luis Potos', ''),
('America', 'MEX', 'Mexico', 'Sinaloa', ''),
('America', 'MEX', 'Mexico', 'Sonora', ''),
('America', 'MEX', 'Mexico', 'Tabasco', ''),
('America', 'MEX', 'Mexico', 'Tamaulipas', ''),
('America', 'MEX', 'Mexico', 'Veracruz', ''),
('America', 'MEX', 'Mexico', 'Yucat', ''),
('America', 'MEX', 'Mexico', 'Zacatecas', ''),
('America', 'NIC', 'Nicaragua', 'Chinandega', ''),
('America', 'NIC', 'Nicaragua', 'Le', ''),
('America', 'NIC', 'Nicaragua', 'Managua', ''),
('America', 'NIC', 'Nicaragua', 'Masaya', ''),
('America', 'PAN', 'Panama', 'Panam', ''),
('America', 'PAN', 'Panama', 'San Miguelito', ''),
('America', 'PER', 'Peru', 'Ancash', ''),
('America', 'PER', 'Peru', 'Arequipa', ''),
('America', 'PER', 'Peru', 'Ayacucho', ''),
('America', 'PER', 'Peru', 'Cajamarca', ''),
('America', 'PER', 'Peru', 'Callao', ''),
('America', 'PER', 'Peru', 'Cusco', ''),
('America', 'PER', 'Peru', 'Huanuco', ''),
('America', 'PER', 'Peru', 'Ica', ''),
('America', 'PER', 'Peru', 'Jun', ''),
('America', 'PER', 'Peru', 'La Libertad', ''),
('America', 'PER', 'Peru', 'Lambayeque', ''),
('America', 'PER', 'Peru', 'Lima', ''),
('America', 'PER', 'Peru', 'Loreto', ''),
('America', 'PER', 'Peru', 'Piura', ''),
('America', 'PER', 'Peru', 'Puno', ''),
('America', 'PER', 'Peru', 'Tacna', ''),
('America', 'PER', 'Peru', 'Ucayali', ''),
('America', 'PRI', 'Puerto Rico', 'Arecibo', ''),
('America', 'PRI', 'Puerto Rico', 'Bayam', ''),
('America', 'PRI', 'Puerto Rico', 'Caguas', ''),
('America', 'PRI', 'Puerto Rico', 'Carolina', ''),
('America', 'PRI', 'Puerto Rico', 'Guaynabo', ''),
('America', 'PRI', 'Puerto Rico', 'Ponce', ''),
('America', 'PRI', 'Puerto Rico', 'San Juan', ''),
('America', 'PRI', 'Puerto Rico', 'Toa Baja', ''),
('America', 'PRY', 'Paraguay', 'Alto Paran', ''),
('America', 'PRY', 'Paraguay', 'Asunci', ''),
('America', 'PRY', 'Paraguay', 'Central', ''),
('America', 'URY', 'Uruguay', 'Montevideo', ''),
('America', 'USA', 'United Situations', 'Alabama', ''),
('America', 'USA', 'United Situations', 'Alaska', ''),
('America', 'USA', 'United Situations', 'Arizona', ''),
('America', 'USA', 'United Situations', 'Arkansas', ''),
('America', 'USA', 'United Situations', 'California', ''),
('America', 'USA', 'United Situations', 'Colorado', ''),
('America', 'USA', 'United Situations', 'Connecticut', ''),
('America', 'USA', 'United Situations', 'District of Columbia', ''),
('America', 'USA', 'United Situations', 'Florida', ''),
('America', 'USA', 'United Situations', 'Georgia', ''),
('America', 'USA', 'United Situations', 'Hawaii', ''),
('America', 'USA', 'United Situations', 'Idaho', ''),
('America', 'USA', 'United Situations', 'Illinois', ''),
('America', 'USA', 'United Situations', 'Indiana', ''),
('America', 'USA', 'United Situations', 'Iowa', ''),
('America', 'USA', 'United Situations', 'Kansas', ''),
('America', 'USA', 'United Situations', 'Kentucky', ''),
('America', 'USA', 'United Situations', 'Louisiana', ''),
('America', 'USA', 'United Situations', 'Maryland', ''),
('America', 'USA', 'United Situations', 'Massachusetts', ''),
('America', 'USA', 'United Situations', 'Michigan', ''),
('America', 'USA', 'United Situations', 'Minnesota', ''),
('America', 'USA', 'United Situations', 'Mississippi', ''),
('America', 'USA', 'United Situations', 'Missouri', ''),
('America', 'USA', 'United Situations', 'Montana', ''),
('America', 'USA', 'United Situations', 'Nebraska', ''),
('America', 'USA', 'United Situations', 'Nevada', ''),
('America', 'USA', 'United Situations', 'New Hampshire', ''),
('America', 'USA', 'United Situations', 'New Jersey', ''),
('America', 'USA', 'United Situations', 'New Mexico', ''),
('America', 'USA', 'United Situations', 'New York', ''),
('America', 'USA', 'United Situations', 'North Carolina', ''),
('America', 'USA', 'United Situations', 'Ohio', ''),
('America', 'USA', 'United Situations', 'Oklahoma', ''),
('America', 'USA', 'United Situations', 'Oregon', ''),
('America', 'USA', 'United Situations', 'Pennsylvania', ''),
('America', 'USA', 'United Situations', 'Rhode Island', ''),
('America', 'USA', 'United Situations', 'South Carolina', ''),
('America', 'USA', 'United Situations', 'South Dakota', ''),
('America', 'USA', 'United Situations', 'Tennessee', ''),
('America', 'USA', 'United Situations', 'Texas', ''),
('America', 'USA', 'United Situations', 'Utah', ''),
('America', 'USA', 'United Situations', 'Virginia', ''),
('America', 'USA', 'United Situations', 'Washington', ''),
('America', 'USA', 'United Situations', 'Wisconsin', ''),
('America', 'VEN', 'Venezuela', 'Anzo', ''),
('America', 'VEN', 'Venezuela', 'Apure', ''),
('America', 'VEN', 'Venezuela', 'Aragua', ''),
('America', 'VEN', 'Venezuela', 'Barinas', ''),
('America', 'VEN', 'Venezuela', 'Bol', ''),
('America', 'VEN', 'Venezuela', 'Carabobo', ''),
('America', 'VEN', 'Venezuela', 'Distrito Federal', ''),
('America', 'VEN', 'Venezuela', 'Falc', ''),
('America', 'VEN', 'Venezuela', 'Gu', ''),
('America', 'VEN', 'Venezuela', 'Lara', ''),
('America', 'VEN', 'Venezuela', 'M', ''),
('America', 'VEN', 'Venezuela', 'Miranda', ''),
('America', 'VEN', 'Venezuela', 'Monagas', ''),
('America', 'VEN', 'Venezuela', 'Portuguesa', ''),
('America', 'VEN', 'Venezuela', 'Sucre', ''),
('America', 'VEN', 'Venezuela', 'T', ''),
('America', 'VEN', 'Venezuela', 'Trujillo', ''),
('America', 'VEN', 'Venezuela', 'Yaracuy', ''),
('America', 'VEN', 'Venezuela', 'Zulia', ''),
('Europe', 'BEL', 'Belgium', 'Antwerpen', ''),
('Europe', 'BEL', 'Belgium', 'Bryssel', ''),
('Europe', 'BEL', 'Belgium', 'East Flanderi', ''),
('Europe', 'BEL', 'Belgium', 'Hainaut', ''),
('Europe', 'BEL', 'Belgium', 'Namur', ''),
('Europe', 'BEL', 'Belgium', 'West Flanderi', ''),
('Europe', 'FRA', 'France', 'Alsace', ''),
('Europe', 'FRA', 'France', 'Aquitaine', ''),
('Europe', 'FRA', 'France', 'Auvergne', ''),
('Europe', 'FRA', 'France', 'Basse-Normandie', ''),
('Europe', 'FRA', 'France', 'Bourgogne', ''),
('Europe', 'FRA', 'France', 'Bretagne', ''),
('Europe', 'FRA', 'France', 'Centre', ''),
('Europe', 'FRA', 'France', 'Limousin', ''),
('Europe', 'FRA', 'France', 'Lorraine', ''),
('Europe', 'FRA', 'France', 'Pays de la Loire', ''),
('Europe', 'FRA', 'France', 'Picardie', ''),
('Europe', 'FRA', 'France', 'Rh', ''),
('Europe', 'DEU', 'Germany', 'Anhalt Sachsen', ''),
('Europe', 'DEU', 'Germany', 'Baijeri', ''),
('Europe', 'DEU', 'Germany', 'Berliini', ''),
('Europe', 'DEU', 'Germany', 'Brandenburg', ''),
('Europe', 'DEU', 'Germany', 'Bremen', ''),
('Europe', 'DEU', 'Germany', 'Hamburg', ''),
('Europe', 'DEU', 'Germany', 'Hessen', ''),
('Europe', 'DEU', 'Germany', 'Mecklenburg-Vorpomme', ''),
('Europe', 'DEU', 'Germany', 'Niedersachsen', ''),
('Europe', 'DEU', 'Germany', 'Nordrhein-Westfalen', ''),
('Europe', 'DEU', 'Germany', 'Rheinland-Pfalz', ''),
('Europe', 'DEU', 'Germany', 'Saarland', ''),
('Europe', 'DEU', 'Germany', 'Saksi', ''),
('Europe', 'DEU', 'Germany', 'Schleswig-Holstein', ''),
('Europe', 'ITA', 'Italy', 'Abruzzit', ''),
('Europe', 'ITA', 'Italy', 'Apulia', ''),
('Europe', 'ITA', 'Italy', 'Calabria', ''),
('Europe', 'ITA', 'Italy', 'Campania', ''),
('Europe', 'ITA', 'Italy', 'Emilia-Romagna', ''),
('Europe', 'ITA', 'Italy', 'Friuli-Venezia Giuli', ''),
('Europe', 'ITA', 'Italy', 'Latium', ''),
('Europe', 'ITA', 'Italy', 'Liguria', ''),
('Europe', 'ITA', 'Italy', 'Lombardia', ''),
('Europe', 'ITA', 'Italy', 'Marche', ''),
('Europe', 'ITA', 'Italy', 'Piemonte', ''),
('Europe', 'ITA', 'Italy', 'Sardinia', ''),
('Europe', 'ITA', 'Italy', 'Sisilia', ''),
('Europe', 'ITA', 'Italy', 'Toscana', ''),
('Europe', 'ITA', 'Italy', 'Umbria', ''),
('Europe', 'ITA', 'Italy', 'Veneto', ''),
('Europe', 'PRT', 'Portugal', 'Braga', ''),
('Europe', 'PRT', 'Portugal', 'Co', ''),
('Europe', 'PRT', 'Portugal', 'Lisboa', ''),
('Europe', 'PRT', 'Portugal', 'Porto', ''),
('Europe', 'ESP', 'Spain', 'Andalusia', ''),
('Europe', 'ESP', 'Spain', 'Aragonia', ''),
('Europe', 'ESP', 'Spain', 'Asturia', ''),
('Europe', 'ESP', 'Spain', 'Balears', ''),
('Europe', 'ESP', 'Spain', 'Baskimaa', ''),
('Europe', 'ESP', 'Spain', 'Canary Islands', ''),
('Europe', 'ESP', 'Spain', 'Cantabria', ''),
('Europe', 'ESP', 'Spain', 'Castilla and Le', ''),
('Europe', 'ESP', 'Spain', 'Extremadura', ''),
('Europe', 'ESP', 'Spain', 'Galicia', ''),
('Europe', 'ESP', 'Spain', 'Katalonia', ''),
('Europe', 'ESP', 'Spain', 'La Rioja', ''),
('Europe', 'ESP', 'Spain', 'Madrid', ''),
('Europe', 'ESP', 'Spain', 'Murcia', ''),
('Europe', 'ESP', 'Spain', 'Navarra', ''),
('Europe', 'ESP', 'Spain', 'Valencia', ''),
('Europe', 'CHE', 'Switzerland', 'Bern', ''),
('Europe', 'CHE', 'Switzerland', 'Geneve', ''),
('Europe', 'CHE', 'Switzerland', 'Vaud', ''),
('Europe', 'GBR', 'United Kingdom', 'England', ''),
('Europe', 'GBR', 'United Kingdom', 'Jersey', ''),
('Europe', 'GBR', 'United Kingdom', 'North Ireland', ''),
('Europe', 'GBR', 'United Kingdom', 'Scotland', ''),
('Europe', 'GBR', 'United Kingdom', 'Wales', ''),
('Oceania', 'AUS', 'Australia', 'Capital Region', ''),
('Oceania', 'AUS', 'Australia', 'New South Wales', ''),
('Oceania', 'AUS', 'Australia', 'Queensland', ''),
('Oceania', 'AUS', 'Australia', 'South Australia', ''),
('Oceania', 'AUS', 'Australia', 'Tasmania', ''),
('Oceania', 'AUS', 'Australia', 'Victoria', ''),
('Oceania', 'AUS', 'Australia', 'West Australia', ''),
('Oceania', 'NZL', 'New Zealand', 'Auckland', ''),
('Oceania', 'NZL', 'New Zealand', 'Canterbury', ''),
('Oceania', 'NZL', 'New Zealand', 'Dunedin', ''),
('Oceania', 'NZL', 'New Zealand', 'Hamilton', ''),
('Oceania', 'NZL', 'New Zealand', 'Wellington', '');

--
-- Filtros para las tablas descargadas (dump)
--

--
-- Filtros para la tabla `muu_ads`
--
ALTER TABLE `muu_ads`
  ADD CONSTRAINT `muu_ads_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_blog`
--
ALTER TABLE `muu_blog`
  ADD CONSTRAINT `muu_blog_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `muu_blog_ibfk_2` FOREIGN KEY (`ID_URL`) REFERENCES `muu_url` (`ID_URL`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_forums_posts`
--
ALTER TABLE `muu_forums_posts`
  ADD CONSTRAINT `muu_forums_posts_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_gallery`
--
ALTER TABLE `muu_gallery`
  ADD CONSTRAINT `muu_gallery_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_hotels_contacts`
--
ALTER TABLE `muu_hotels_contacts`
  ADD CONSTRAINT `fk_muu_hotels_contacts_1` FOREIGN KEY (`ID_Hotel`) REFERENCES `muu_hotels` (`ID_Hotel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_hotels_information`
--
ALTER TABLE `muu_hotels_information`
  ADD CONSTRAINT `fk_muu_hotels_information_1` FOREIGN KEY (`ID_Hotel`) REFERENCES `muu_hotels` (`ID_Hotel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_hotels_policy`
--
ALTER TABLE `muu_hotels_policy`
  ADD CONSTRAINT `fk_muu_hotels_policy_1` FOREIGN KEY (`ID_Hotel`) REFERENCES `muu_hotels` (`ID_Hotel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_links`
--
ALTER TABLE `muu_links`
  ADD CONSTRAINT `muu_links_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_logs`
--
ALTER TABLE `muu_logs`
  ADD CONSTRAINT `muu_logs_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_pages`
--
ALTER TABLE `muu_pages`
  ADD CONSTRAINT `muu_pages_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_polls`
--
ALTER TABLE `muu_polls`
  ADD CONSTRAINT `muu_polls_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_polls_answers`
--
ALTER TABLE `muu_polls_answers`
  ADD CONSTRAINT `muu_polls_answers_ibfk_1` FOREIGN KEY (`ID_Poll`) REFERENCES `muu_polls` (`ID_Poll`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_polls_ips`
--
ALTER TABLE `muu_polls_ips`
  ADD CONSTRAINT `muu_polls_ips_ibfk_1` FOREIGN KEY (`ID_Poll`) REFERENCES `muu_polls` (`ID_Poll`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_re_categories_records`
--
ALTER TABLE `muu_re_categories_records`
  ADD CONSTRAINT `muu_re_categories_records_ibfk_1` FOREIGN KEY (`ID_Category2Application`) REFERENCES `muu_re_categories_applications` (`ID_Category2Application`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_re_comments_records`
--
ALTER TABLE `muu_re_comments_records`
  ADD CONSTRAINT `muu_re_comments_records_ibfk_1` FOREIGN KEY (`ID_Comment2Application`) REFERENCES `muu_re_comments_applications` (`ID_Comment2Application`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_re_hotels_amenities`
--
ALTER TABLE `muu_re_hotels_amenities`
  ADD CONSTRAINT `fk_muu_re_hotels_amenities_1` FOREIGN KEY (`ID_Amenity`) REFERENCES `muu_hotels_amenities` (`ID_Amenity`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_muu_re_hotels_amenities_2` FOREIGN KEY (`ID_Hotel`) REFERENCES `muu_hotels` (`ID_Hotel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_re_hotels_rates`
--
ALTER TABLE `muu_re_hotels_rates`
  ADD CONSTRAINT `fk_muu_re_hotels_rates_1` FOREIGN KEY (`ID_Rate`) REFERENCES `muu_hotels_rates` (`ID_Rate`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_muu_re_hotels_rates_2` FOREIGN KEY (`ID_Hotel`) REFERENCES `muu_hotels` (`ID_Hotel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_re_hotels_rooms`
--
ALTER TABLE `muu_re_hotels_rooms`
  ADD CONSTRAINT `fk_muu_re_hotels_rooms_1` FOREIGN KEY (`ID_Room`) REFERENCES `muu_hotels_rooms` (`ID_Room`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_muu_re_hotels_rooms_2` FOREIGN KEY (`ID_Hotel`) REFERENCES `muu_hotels` (`ID_Hotel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_re_permissions_privileges`
--
ALTER TABLE `muu_re_permissions_privileges`
  ADD CONSTRAINT `muu_re_permissions_privileges_ibfk_1` FOREIGN KEY (`ID_Privilege`) REFERENCES `muu_privileges` (`ID_Privilege`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `muu_re_permissions_privileges_ibfk_2` FOREIGN KEY (`ID_Application`) REFERENCES `muu_applications` (`ID_Application`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_re_privileges_users`
--
ALTER TABLE `muu_re_privileges_users`
  ADD CONSTRAINT `muu_re_privileges_users_ibfk_1` FOREIGN KEY (`ID_Privilege`) REFERENCES `muu_privileges` (`ID_Privilege`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `muu_re_privileges_users_ibfk_2` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_re_tags_applications`
--
ALTER TABLE `muu_re_tags_applications`
  ADD CONSTRAINT `muu_re_tags_applications_ibfk_2` FOREIGN KEY (`ID_Tag`) REFERENCES `muu_tags` (`ID_Tag`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_re_tags_records`
--
ALTER TABLE `muu_re_tags_records`
  ADD CONSTRAINT `muu_re_tags_records_ibfk_1` FOREIGN KEY (`ID_Tag2Application`) REFERENCES `muu_re_tags_applications` (`ID_Tag2Application`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_support`
--
ALTER TABLE `muu_support`
  ADD CONSTRAINT `muu_support_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_tokens`
--
ALTER TABLE `muu_tokens`
  ADD CONSTRAINT `muu_tokens_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_users_information`
--
ALTER TABLE `muu_users_information`
  ADD CONSTRAINT `muu_users_information_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_videos`
--
ALTER TABLE `muu_videos`
  ADD CONSTRAINT `muu_videos_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE;
