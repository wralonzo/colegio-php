

CREATE TABLE `bitacora` (
  `id` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idtask` int(11) NOT NULL,
  `accion` varchar(100) NOT NULL,
  `datecreated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bitacora`
--

INSERT INTO `bitacora` (`id`, `idusuario`, `idtask`, `accion`, `datecreated`) VALUES
(1, 1, 32, 'Actuailizo caso: ee', '2024-08-25 07:57:46'),
(2, 1, 33, 'Ingreso caso: ttr', '2024-08-25 07:58:09'),
(3, 1, 33, 'Subio adjunto al caso: 1724572690.pdf', '2024-08-25 07:58:09'),
(4, 1, 33, 'Elimino el caso no: 33', '2024-08-25 07:59:01'),
(5, 1, 34, 'Ingreso caso: test', '2024-08-25 08:44:18'),
(6, 1, 34, 'Subio adjunto al caso: 34', '2024-08-25 08:44:18'),
(7, 1, 35, 'Ingreso caso: 88', '2024-08-25 08:52:14'),
(8, 1, 35, 'Subio adjunto al caso: 35', '2024-08-25 08:52:14'),
(9, 1, 35, 'Elimino el caso no: 35', '2024-08-25 09:08:57'),
(10, 1, 36, 'Ingreso caso: test', '2024-08-25 09:09:14'),
(11, 1, 36, 'Subio adjunto al caso: 36', '2024-08-25 09:09:14'),
(12, 1, 36, 'Elimino el caso no: 36', '2024-08-25 17:20:18'),
(13, 1, 34, 'Elimino el caso no: 34', '2024-08-25 17:20:43'),
(14, 1, 37, 'Ingreso caso: test', '2024-08-25 17:20:59'),
(15, 1, 37, 'Subio adjunto al caso: 37', '2024-08-25 17:20:59'),
(16, 1, 38, 'Ingreso caso: iuuu', '2024-08-25 17:22:40'),
(17, 1, 38, 'Subio adjunto al caso: 38', '2024-08-25 17:22:40'),
(18, 1, 39, 'Ingreso caso: 888', '2024-08-25 17:23:53'),
(19, 1, 39, 'Subio adjunto al caso: 39', '2024-08-25 17:23:53'),
(20, 1, 40, 'Ingreso caso: 8909', '2024-08-25 17:24:17'),
(21, 1, 40, 'Subio adjunto al caso: 40', '2024-08-25 17:24:17'),
(22, 1, 37, 'Elimino el caso no: 37', '2024-08-25 17:24:45'),
(23, 1, 38, 'Elimino el caso no: 38', '2024-08-25 17:24:48'),
(24, 1, 40, 'Elimino el caso no: 40', '2024-08-25 17:24:50'),
(25, 1, 39, 'Elimino el caso no: 39', '2024-08-25 17:24:52'),
(26, 1, 41, 'Ingreso caso: tes', '2024-08-25 17:25:06'),
(27, 1, 41, 'Subio adjunto al caso: 41', '2024-08-25 17:25:06'),
(28, 1, 41, 'Elimino el caso no: 41', '2024-08-25 17:25:38'),
(29, 1, 42, 'Ingreso caso: 888', '2024-08-25 17:25:48'),
(30, 1, 42, 'Subio adjunto al caso: 42', '2024-08-25 17:25:48'),
(31, 1, 43, 'Ingreso caso: 888', '2024-08-25 17:27:00'),
(32, 1, 43, 'Subio adjunto al caso: 43', '2024-08-25 17:27:00'),
(33, 1, 44, 'Ingreso caso: 888', '2024-08-25 17:27:37'),
(34, 1, 44, 'Subio adjunto al caso: 44', '2024-08-25 17:27:37'),
(35, 1, 45, 'Ingreso caso: 88888', '2024-08-25 17:28:19'),
(36, 1, 46, 'Ingreso caso: 888', '2024-08-25 17:28:36'),
(37, 1, 46, 'Subio adjunto al caso: 46', '2024-08-25 17:28:36'),
(38, 1, 47, 'Ingreso caso: Caso de investigacion 10', '2024-08-25 17:32:41'),
(39, 1, 47, 'Subio adjunto al caso: 47', '2024-08-25 17:32:41'),
(40, 1, 48, 'Ingreso caso: Tes', '2024-08-25 17:40:47'),
(41, 1, 48, 'Elimino el caso no: 48', '2024-08-26 01:11:08'),
(42, 1, 47, 'Actuailizo caso: Caso de investigacion 10 test', '2024-08-26 01:11:32'),
(43, 1, 47, 'Subio adjunto al caso: 47', '2024-08-26 01:34:33'),
(44, 1, 47, 'Subio adjunto al caso: 47', '2024-08-26 01:35:21'),
(45, 12, 1, 'Ingreso caso: Mi caso', '2024-08-26 02:48:54'),
(46, 12, 1, 'Subio adjunto: 1724640535.png al caso: 1', '2024-08-26 02:48:54'),
(47, 1, 1, 'Subio adjunto: 1724736971.png al caso: 1', '2024-08-27 05:36:11');

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `eliminado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`, `eliminado`) VALUES
(1, 'Categoria 1', 1),
(2, 'Categoria 2', 1),
(3, 'Test de categoria', 1);

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `idtask` int(11) NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp(),
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `nombre`, `idtask`, `datecreated`, `estado`) VALUES
(1, '1724640535.png', 1, '2024-08-25 20:48:54', 1),
(2, '1724736971.png', 1, '2024-08-27 05:36:11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `permiso`
--

CREATE TABLE `permiso` (
  `idpermiso` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permiso`
--

INSERT INTO `permiso` (`idpermiso`, `nombre`, `estado`) VALUES
(1, 'Dashboard', 1),
(2, 'Casos', 1),
(3, 'Adjuntos', 1),
(4, 'Categorias', 1),
(5, 'Usuarios', 1),
(6, 'Historial', 1);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `idtask` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `usuario` int(11) NOT NULL,
  `localidad` varchar(200) NOT NULL,
  `secretaria` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `estado` enum('Pendiente','Completado','Progreso','Detenido','Ingresado') NOT NULL DEFAULT 'Ingresado',
  `fechavencimiento` date NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `eliminado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`idtask`, `nombre`, `descripcion`, `usuario`, `localidad`, `secretaria`, `tipo`, `estado`, `fechavencimiento`, `date_created`, `eliminado`) VALUES
(1, 'Mi caso', 'test de caso', 12, 'localidad', 11, 2, 'Ingresado', '2024-08-07', '2024-08-26 02:48:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(70) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `cargo` varchar(20) DEFAULT NULL,
  `login` varchar(20) NOT NULL,
  `clave` varchar(64) NOT NULL,
  `imagen` varchar(50) DEFAULT NULL,
  `rol` tinyint(4) NOT NULL DEFAULT 1,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre`, `direccion`, `telefono`, `email`, `cargo`, `login`, `clave`, `imagen`, `rol`, `date_created`, `estado`) VALUES
(1, 'admin', 'admin', 'admin', 'admin', 'admin', 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', NULL, 1, '2024-08-22 15:41:08', 1),
(11, 'Inve', NULL, '312312', 'soporte@informatica.com.gt', 'Investigador', 'inve', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', '1724639331.png', 3, '2024-08-26 02:28:51', 1),
(12, 'secre', NULL, '213213', '', 'test', 'secre', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', NULL, 2, '2024-08-26 02:48:22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usuario_permiso`
--

CREATE TABLE `usuario_permiso` (
  `idusuario_permiso` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idpermiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuario_permiso`
--

INSERT INTO `usuario_permiso` (`idusuario_permiso`, `idusuario`, `idpermiso`) VALUES
(42, 1, 1),
(43, 1, 2),
(44, 1, 3),
(45, 1, 4),
(46, 1, 5),
(47, 1, 6),
(50, 11, 1),
(51, 11, 2),
(52, 11, 3),
(53, 11, 6),
(54, 12, 1),
(55, 12, 2),
(56, 12, 3),
(57, 12, 4),
(58, 12, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bitacora`
--
ALTER TABLE `bitacora`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`idpermiso`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`idtask`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`);

--
-- Indexes for table `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  ADD PRIMARY KEY (`idusuario_permiso`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bitacora`
--
ALTER TABLE `bitacora`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permiso`
--
ALTER TABLE `permiso`
  MODIFY `idpermiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `idtask` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  MODIFY `idusuario_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
COMMIT;