-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-09-2020 a las 06:28:42
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbcuponera`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblclientes`
--

CREATE TABLE `tblclientes` (
  `idCliente` int(11) NOT NULL,
  `nombresCliente` varchar(150) NOT NULL,
  `apellidosClientes` varchar(150) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `correoCliente` varchar(75) NOT NULL,
  `direccionCliente` varchar(150) DEFAULT NULL,
  `dui` varchar(9) NOT NULL,
  `password` varchar(25) NOT NULL,
  `estado` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcompracupon`
--

CREATE TABLE `tblcompracupon` (
  `idCompra` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `idCupon` int(11) NOT NULL,
  `codigoCompra` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcupones`
--

CREATE TABLE `tblcupones` (
  `idCupon` int(11) NOT NULL,
  `tituloOferta` varchar(50) NOT NULL,
  `IdSucursal` int(11) NOT NULL,
  `precioRegular` decimal(8,2) NOT NULL,
  `precioOferta` decimal(8,2) NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFin` date NOT NULL,
  `fechaLimite` date NOT NULL,
  `cantidad` int(11) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `justificacion` varchar(250) DEFAULT NULL,
  `otros` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblempresas`
--

CREATE TABLE `tblempresas` (
  `idEmpresa` int(11) NOT NULL,
  `nombreEmpresa` varchar(50) NOT NULL,
  `codigoEmpresa` char(6) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `idRubro` int(11) NOT NULL,
  `porcentajeComision` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblrubros`
--

CREATE TABLE `tblrubros` (
  `idRubro` int(11) NOT NULL,
  `nombreRubro` varchar(50) NOT NULL,
  `descripcion` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblsucursales`
--

CREATE TABLE `tblsucursales` (
  `idSucursal` int(11) NOT NULL,
  `nombreSucursal` varchar(50) NOT NULL,
  `idEmpresa` int(11) NOT NULL,
  `nombreEncargadoSuc` varchar(150) NOT NULL,
  `password` varchar(25) NOT NULL,
  `correo` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tblclientes`
--
ALTER TABLE `tblclientes`
  ADD PRIMARY KEY (`idCliente`);

--
-- Indices de la tabla `tblcompracupon`
--
ALTER TABLE `tblcompracupon`
  ADD PRIMARY KEY (`idCompra`),
  ADD KEY `idCliente` (`idCliente`),
  ADD KEY `idCliente_2` (`idCliente`),
  ADD KEY `idCupon` (`idCupon`);

--
-- Indices de la tabla `tblcupones`
--
ALTER TABLE `tblcupones`
  ADD PRIMARY KEY (`idCupon`),
  ADD KEY `IdSucursal` (`IdSucursal`);

--
-- Indices de la tabla `tblempresas`
--
ALTER TABLE `tblempresas`
  ADD PRIMARY KEY (`idEmpresa`),
  ADD KEY `idRubro` (`idRubro`);

--
-- Indices de la tabla `tblrubros`
--
ALTER TABLE `tblrubros`
  ADD PRIMARY KEY (`idRubro`);

--
-- Indices de la tabla `tblsucursales`
--
ALTER TABLE `tblsucursales`
  ADD PRIMARY KEY (`idSucursal`),
  ADD KEY `idEmpresa` (`idEmpresa`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tblclientes`
--
ALTER TABLE `tblclientes`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tblcompracupon`
--
ALTER TABLE `tblcompracupon`
  MODIFY `idCompra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tblcupones`
--
ALTER TABLE `tblcupones`
  MODIFY `idCupon` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tblempresas`
--
ALTER TABLE `tblempresas`
  MODIFY `idEmpresa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tblrubros`
--
ALTER TABLE `tblrubros`
  MODIFY `idRubro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tblsucursales`
--
ALTER TABLE `tblsucursales`
  MODIFY `idSucursal` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tblcompracupon`
--
ALTER TABLE `tblcompracupon`
  ADD CONSTRAINT `tblcompracupon_ibfk_1` FOREIGN KEY (`idCliente`) REFERENCES `tblclientes` (`idCliente`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tblcompracupon_ibfk_2` FOREIGN KEY (`idCupon`) REFERENCES `tblcupones` (`idCupon`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `tblcupones`
--
ALTER TABLE `tblcupones`
  ADD CONSTRAINT `tblcupones_ibfk_1` FOREIGN KEY (`IdSucursal`) REFERENCES `tblsucursales` (`idSucursal`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `tblempresas`
--
ALTER TABLE `tblempresas`
  ADD CONSTRAINT `tblempresas_ibfk_1` FOREIGN KEY (`idRubro`) REFERENCES `tblrubros` (`idRubro`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `tblsucursales`
--
ALTER TABLE `tblsucursales`
  ADD CONSTRAINT `tblsucursales_ibfk_1` FOREIGN KEY (`idEmpresa`) REFERENCES `tblempresas` (`idEmpresa`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
