-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-09-2020 a las 07:00:18
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.7

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

--
-- Volcado de datos para la tabla `tblclientes`
--

INSERT INTO `tblclientes` (`idCliente`, `nombresCliente`, `apellidosClientes`, `telefono`, `correoCliente`, `direccionCliente`, `dui`, `password`, `estado`) VALUES
(1, 'Andres Roberto', 'Reinaldi', '2222-2222', 'akslasklfds@gmail.com', 'San Miguel', '0000000-0', '12345687', 'noVerificado'),
(3, 'Fidel', 'García', '72740495', 'matinezfidel@gmail.com', 'Ruta SAM10N, Caserio Chispa contiguo a Resd. River Side North', '0000000-3', 'FIDEL12', 'No Verificado');

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
  `cantidad` int(11) DEFAULT NULL,
  `descripcion` varchar(250) NOT NULL,
  `estado` int(11) NOT NULL,
  `justificacion` varchar(250) DEFAULT NULL,
  `otros` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tblcupones`
--

INSERT INTO `tblcupones` (`idCupon`, `tituloOferta`, `IdSucursal`, `precioRegular`, `precioOferta`, `fechaInicio`, `fechaFin`, `fechaLimite`, `cantidad`, `descripcion`, `estado`, `justificacion`, `otros`) VALUES
(1, 'Camisas - 25', 2, '100.00', '75.00', '2020-09-30', '2020-11-25', '2020-11-30', 10, ' Por la compra de camisas aplica un 25% de Descuento', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblempresas`
--

CREATE TABLE `tblempresas` (
  `idEmpresa` int(11) NOT NULL,
  `nombreEmpresa` varchar(50) NOT NULL,
  `codigoEmpresa` char(6) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `clave` varchar(15) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `idRubro` int(11) NOT NULL,
  `porcentajeComision` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tblempresas`
--

INSERT INTO `tblempresas` (`idEmpresa`, `nombreEmpresa`, `codigoEmpresa`, `direccion`, `correo`, `clave`, `telefono`, `idRubro`, `porcentajeComision`) VALUES
(1, 'Texti Telas', 'ZC2469', 'San Salvador, corredor central', '', '', '6624-8695', 1, '5.00'),
(2, 'Toyota', 'qjomu1', 'San Miguel', 'toyota.sm@gmail.com', 'Mtuy1Adr7Q ', '2222-2222', 1, '1.00'),
(3, 'Toyota', 'qras2h', 'San Miguel', 'toyota.sm@gmail.com', 'vYyHV8iAt6 ', '2222-2222', 1, '1.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblestadoscupon`
--

CREATE TABLE `tblestadoscupon` (
  `idEstadoCupon` int(11) NOT NULL,
  `definirEstado` varchar(25) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tblestadoscupon`
--

INSERT INTO `tblestadoscupon` (`idEstadoCupon`, `definirEstado`, `descripcion`) VALUES
(1, 'Espera Aprobación', 'Oferta en espera de aprobación'),
(2, 'Aprobada', ''),
(3, 'Rechazada', 'La oferta fue rechazada, no cumple con los requisitos establecidos, puede modificarla y volver a env'),
(4, 'Descartada', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblrubros`
--

CREATE TABLE `tblrubros` (
  `idRubro` int(11) NOT NULL,
  `nombreRubro` varchar(50) NOT NULL,
  `descripcion` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tblrubros`
--

INSERT INTO `tblrubros` (`idRubro`, `nombreRubro`, `descripcion`) VALUES
(1, 'Textil', 'Generacion de productos textiles y mas');

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
-- Volcado de datos para la tabla `tblsucursales`
--

INSERT INTO `tblsucursales` (`idSucursal`, `nombreSucursal`, `idEmpresa`, `nombreEncargadoSuc`, `password`, `correo`) VALUES
(2, 'Texti San Miguel', 1, 'Rina Robledo', '12345678', 'texti.sanmiguel@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblusuarios`
--

CREATE TABLE `tblusuarios` (
  `idUsuario` int(11) NOT NULL,
  `nombreUsuario` varchar(150) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `estado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tblusuarios`
--

INSERT INTO `tblusuarios` (`idUsuario`, `nombreUsuario`, `email`, `password`, `estado`) VALUES
(1, 'Fidel Martinez', 'matinezfidel@gmail.com', '12345678', '1');

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
  ADD KEY `IdSucursal` (`IdSucursal`),
  ADD KEY `estado` (`estado`);

--
-- Indices de la tabla `tblempresas`
--
ALTER TABLE `tblempresas`
  ADD PRIMARY KEY (`idEmpresa`),
  ADD KEY `idRubro` (`idRubro`);

--
-- Indices de la tabla `tblestadoscupon`
--
ALTER TABLE `tblestadoscupon`
  ADD PRIMARY KEY (`idEstadoCupon`);

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
-- Indices de la tabla `tblusuarios`
--
ALTER TABLE `tblusuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tblclientes`
--
ALTER TABLE `tblclientes`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tblcompracupon`
--
ALTER TABLE `tblcompracupon`
  MODIFY `idCompra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tblcupones`
--
ALTER TABLE `tblcupones`
  MODIFY `idCupon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tblempresas`
--
ALTER TABLE `tblempresas`
  MODIFY `idEmpresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tblestadoscupon`
--
ALTER TABLE `tblestadoscupon`
  MODIFY `idEstadoCupon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tblrubros`
--
ALTER TABLE `tblrubros`
  MODIFY `idRubro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tblsucursales`
--
ALTER TABLE `tblsucursales`
  MODIFY `idSucursal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tblusuarios`
--
ALTER TABLE `tblusuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  ADD CONSTRAINT `tblcupones_ibfk_1` FOREIGN KEY (`IdSucursal`) REFERENCES `tblsucursales` (`idSucursal`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tblcupones_ibfk_2` FOREIGN KEY (`estado`) REFERENCES `tblestadoscupon` (`idEstadoCupon`) ON UPDATE CASCADE;

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
