-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 22-07-2012 a las 23:15:03
-- Versión del servidor: 5.5.24
-- Versión de PHP: 5.3.10-1ubuntu3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `julieta`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Articulo`
--

CREATE TABLE IF NOT EXISTS `Articulo` (
  `idArticulo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idArticulo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Articulo_Factura`
--

CREATE TABLE IF NOT EXISTS `Articulo_Factura` (
  `fkArticulo` int(11) NOT NULL,
  `fkFactura` int(11) NOT NULL,
  `precioUnitario` double NOT NULL,
  `cantidad` int(11) NOT NULL,
  KEY `fk_Articulo_has_Factura_Factura1` (`fkFactura`),
  KEY `fk_Articulo_has_Factura_Articulo1` (`fkArticulo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Banco`
--

CREATE TABLE IF NOT EXISTS `Banco` (
  `idBanco` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `fkFundacion` int(11) NOT NULL,
  PRIMARY KEY (`idBanco`),
  KEY `fk_Banco_Fundacion1` (`fkFundacion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cheque`
--

CREATE TABLE IF NOT EXISTS `Cheque` (
  `idCheque` int(11) NOT NULL AUTO_INCREMENT,
  `monto` double NOT NULL,
  `beneficiario` varchar(45) NOT NULL,
  `fechaEmision` date NOT NULL,
  `fkBanco` int(11) NOT NULL,
  `fkPersona` int(11) NOT NULL,
  PRIMARY KEY (`idCheque`),
  KEY `fk_Cheque_Cuenta1` (`fkBanco`),
  KEY `fk_Cheque_Persona1` (`fkPersona`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cuenta`
--

CREATE TABLE IF NOT EXISTS `Cuenta` (
  `idCuenta` int(11) NOT NULL AUTO_INCREMENT,
  `codigoCliente` varchar(45) NOT NULL,
  `titular` varchar(45) NOT NULL,
  `fkBanco` int(11) NOT NULL,
  PRIMARY KEY (`idCuenta`),
  KEY `fk_Cuenta_Banco1` (`fkBanco`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Egreso`
--

CREATE TABLE IF NOT EXISTS `Egreso` (
  `idEgreso` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `estatus` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `fkPersona` int(11) NOT NULL,
  PRIMARY KEY (`idEgreso`),
  KEY `fk_Egreso_Persona1` (`fkPersona`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Factura`
--

CREATE TABLE IF NOT EXISTS `Factura` (
  `idFactura` int(11) NOT NULL AUTO_INCREMENT,
  `noFactura` varchar(45) NOT NULL,
  `noControl` varchar(45) NOT NULL,
  `razonSocial` varchar(45) NOT NULL,
  `fechaEmision` date NOT NULL,
  `comprador` varchar(45) NOT NULL,
  `descripcionVenta` varchar(45) NOT NULL,
  `estatus` int(11) NOT NULL,
  `totalFactura` double NOT NULL,
  `fkPersona` int(11) NOT NULL,
  `ajuste` double DEFAULT NULL,
  `baseImponible` float DEFAULT NULL,
  `iva` float DEFAULT NULL,
  `fkEgreso` int(11) DEFAULT NULL,
  PRIMARY KEY (`idFactura`),
  KEY `fk_Factura_Proyecto_Programa1` (`fkEgreso`),
  KEY `fk_Factura_Persona1` (`fkPersona`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Fundacion`
--

CREATE TABLE IF NOT EXISTS `Fundacion` (
  `idFundacion` int(11) NOT NULL AUTO_INCREMENT,
  `rif` varchar(30) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  PRIMARY KEY (`idFundacion`),
  UNIQUE KEY `rif` (`rif`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `Fundacion`
--

INSERT INTO `Fundacion` (`idFundacion`, `rif`, `nombre`, `telefono`, `direccion`, `email`) VALUES
(1, '12', 'Paso a Paso', '333-333-33', 'Caracas', 'pasoapaso@mail.co'),
(2, '12FA', 'Fundacion Dos', '23 23 21', 'Valencia', 'funda@email.com'),
(3, '1', 'a', '1', '1', '1@email.com'),
(4, '2', 'a', '1', '1', '2@email.com'),
(5, '3', 'a', '1', '1', '3@email.com'),
(6, '4', 'a', '1', '1', '4@email.com'),
(7, '5', 'a', '1', '1', '5@email.com'),
(8, '6', 'a', '1', '1', '6@email.com'),
(9, '7', 'a', '1', '1', '7@email.com'),
(10, '8', 'a', '1', '1', '9@email.com'),
(11, '9', 'a', '1', '1', '10@email.com'),
(12, 'F-h1234', 'Caridad para Renier', '555', 'El 5to CoÃ±o', 'fundaRenier@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Pago`
--

CREATE TABLE IF NOT EXISTS `Pago` (
  `fkCheque` int(11) NOT NULL,
  `fkFactura` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  PRIMARY KEY (`fkFactura`,`fkCheque`),
  KEY `fk_Pago_Cheque1` (`fkCheque`),
  KEY `fk_Pago_Factura1` (`fkFactura`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Persona`
--

CREATE TABLE IF NOT EXISTS `Persona` (
  `idPersona` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `cedula` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `userName` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `rol` int(11) NOT NULL,
  `fkFundacion` int(11) NOT NULL,
  PRIMARY KEY (`idPersona`),
  UNIQUE KEY `userName_UNIQUE` (`userName`),
  KEY `fk_Persona_Fundacion1` (`fkFundacion`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `Persona`
--

INSERT INTO `Persona` (`idPersona`, `nombre`, `apellido`, `cedula`, `email`, `userName`, `password`, `telefono`, `rol`, `fkFundacion`) VALUES
(1, 'Lawrence', 'Cermeno', '1', 'anthony.salcedo20@gmail.com', 'law', '1234', '55 55 55', -1, 1),
(2, 'anthony', 'Cermeno', '2', 'anthony.salcedo21@gmail.com', 'law1', '1234', '55 55 55', 0, 1),
(3, 'law', 'law', '5', 'a@gmail.com', 'law5', '1234', '12', 0, 1),
(4, 'Renier', 'Chico', '10', 'renier@gmail.com', 'renier', '1234', '0212-55-55', -1, 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Articulo_Factura`
--
ALTER TABLE `Articulo_Factura`
  ADD CONSTRAINT `fk_Articulo_has_Factura_Articulo1` FOREIGN KEY (`fkArticulo`) REFERENCES `Articulo` (`idArticulo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Articulo_has_Factura_Factura1` FOREIGN KEY (`fkFactura`) REFERENCES `Factura` (`idFactura`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Banco`
--
ALTER TABLE `Banco`
  ADD CONSTRAINT `fk_Banco_Fundacion1` FOREIGN KEY (`fkFundacion`) REFERENCES `Fundacion` (`idFundacion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Cheque`
--
ALTER TABLE `Cheque`
  ADD CONSTRAINT `fk_Cheque_Cuenta1` FOREIGN KEY (`fkBanco`) REFERENCES `Cuenta` (`fkBanco`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Cheque_Persona1` FOREIGN KEY (`fkPersona`) REFERENCES `Persona` (`idPersona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Cuenta`
--
ALTER TABLE `Cuenta`
  ADD CONSTRAINT `fk_Cuenta_Banco1` FOREIGN KEY (`fkBanco`) REFERENCES `Banco` (`idBanco`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Egreso`
--
ALTER TABLE `Egreso`
  ADD CONSTRAINT `fk_Egreso_Persona1` FOREIGN KEY (`fkPersona`) REFERENCES `Persona` (`idPersona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Factura`
--
ALTER TABLE `Factura`
  ADD CONSTRAINT `fk_Factura_Persona1` FOREIGN KEY (`fkPersona`) REFERENCES `Persona` (`idPersona`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Factura_Proyecto_Programa1` FOREIGN KEY (`fkEgreso`) REFERENCES `Egreso` (`idEgreso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Pago`
--
ALTER TABLE `Pago`
  ADD CONSTRAINT `fk_Pago_Cheque1` FOREIGN KEY (`fkCheque`) REFERENCES `Cheque` (`idCheque`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Pago_Factura1` FOREIGN KEY (`fkFactura`) REFERENCES `Factura` (`idFactura`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Persona`
--
ALTER TABLE `Persona`
  ADD CONSTRAINT `fk_Persona_Fundacion1` FOREIGN KEY (`fkFundacion`) REFERENCES `Fundacion` (`idFundacion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
