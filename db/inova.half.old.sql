-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 11, 2017 at 01:38 PM
-- Server version: 10.1.20-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `id688535_inovadb`
--

-- --------------------------------------------------------

--
-- Table structure for table `alunos`
--

CREATE TABLE `alunos` (
  `id` int(11) NOT NULL,
  `nome` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `cpf` varchar(14) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `telefone` varchar(18) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `curso_id` int(11) NOT NULL,
  `turno` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `endereco_id` int(11) NOT NULL,
  `data_cad` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alunos`
--

INSERT INTO `alunos` (`id`, `nome`, `cpf`, `email`, `telefone`, `curso_id`, `turno`, `endereco_id`, `data_cad`) VALUES
(1, 'Lucas Peixoto', '039.188.293-75', 'lpeixoto2000@hotmail.com', '(88) 981293317', 2, 'tarde', 1, '2017-01-17 21:42:44'),
(2, 'Peixoto Lucas', '000.111.222-33', 'plucas2000@hotmail.com', '(88) 981293317', 2, 'noite', 2, '2017-01-18 19:26:39'),
(3, 'Xicara', '756.376.109-01', 'xica2k17@yahoo.com.br', '(88) 384635298', 3, 'manha', 3, '2017-01-20 18:24:02'),
(4, 'Alex', '555.000.109-01', 'alex2k17@yahoo.com.br', '(88) 111227564', 2, 'noite', 4, '2017-02-02 20:57:28'),
(5, 'Alexandra', '555.000.109-01', 'alexandra2k17@yahoo.com.br', '(88) 111227564', 3, 'noite', 5, '2017-02-02 20:59:39'),
(6, 'Lucas Peixoto', '090.840.935-93', 'mail@mail.com', '', 1, 'manha', 6, '2017-02-06 23:22:13'),
(7, 'Meu nome', '389.753.897-59', 'asads@ghj.ocs', '', 4, 'manha', 7, '2017-02-07 00:04:49'),
(8, 'astro', '786.543.546-56', 'astro@nauta.nasa', '', 5, 'noite', 8, '2017-02-07 00:08:08'),
(9, 'asdf', '342.534.645-64', 'dfdf@ef.jkl', '', 6, 'manha', 9, '2017-02-07 00:09:40'),
(10, 'qweqwe', '958.673.890-67', 'loiiii@fghj.dssd', '', 6, 'noite', 10, '2017-02-07 00:13:58'),
(11, 'meu name', '789.505.423-43', 'skbfsukeg', '', 1, 'manha', 11, '2017-02-07 22:16:23'),
(12, 'Sucesso', '980.923.084-75', 'jsfsjkdfsj', '', 1, 'manha', 12, '2017-02-07 22:18:13'),
(13, 'abacate', '353.876.525-84', 'jyhgjkl', '', 1, 'tarde', 13, '2017-02-07 22:21:16'),
(14, 'sdsfsiofios', '293.048.098-35', 'lkjadfigj', '', 5, 'noite', 14, '2017-02-07 22:25:53'),
(15, 'engenheiro', '948.358.374-69', 'ewfndsf@sdf.cfb', '', 2, 'noite', 15, '2017-02-07 22:34:09'),
(16, 'super', '329.874.398-75', 'sddg', '', 4, 'noite', 16, '2017-02-08 00:06:11'),
(17, 'hsdfsdfsf', '589.674.967-89', 'sdfkxchvkx@sddfg.vcb', '', 2, 'tarde', 17, '2017-02-08 00:08:22'),
(19, 'the chosen one', '789.046.545-42', 'sdd', '(34) 5 4543 - 5345', 5, 'manha', 19, '2017-02-17 00:38:29'),
(20, '0001', '758.937.593-48', 'lucas.peixoto.14@gmail.com', '(73) 4 8943 - 7589', 7, 'noite', 20, '2017-02-18 00:30:25'),
(21, 'sdfghjk', '043.854.860-93', 'slkdfj@sfdsdf.sdfs', '(90) 8 0943 - 8539', 4, 'tarde', 21, '2017-02-20 22:46:53'),
(22, 'ellllll', '923.843.904-83', 'kajfs@sddf.df', '(03) 9 3450 - 4904', 2, 'noite', 22, '2017-02-20 23:03:58');

-- --------------------------------------------------------

--
-- Table structure for table `cursos`
--

CREATE TABLE `cursos` (
  `id` int(11) NOT NULL,
  `nome` varchar(250) CHARACTER SET latin1 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cursos`
--

INSERT INTO `cursos` (`id`, `nome`) VALUES
(1, 'curso de abacate'),
(2, 'Engenharia Espacial'),
(3, 'Engenharia Aero-Espacial'),
(4, 'Novo Curso'),
(5, 'astronautica'),
(6, 'astronautica espacial'),
(7, 'email test');

-- --------------------------------------------------------

--
-- Table structure for table `enderecos`
--

CREATE TABLE `enderecos` (
  `id` int(11) NOT NULL,
  `rua` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'S/N',
  `bairro` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cidade` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `cep` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enderecos`
--

INSERT INTO `enderecos` (`id`, `rua`, `numero`, `bairro`, `cidade`, `estado`, `cep`) VALUES
(1, 'ruaa', 'nuksuc', 'barrasd', 'city', 'ES', '63180-000'),
(2, 'ruaa', 'nuksuc', 'barrasd', 'city', 'ES', '63180-000'),
(3, 'Beco Diagonal', '403', 'Biboca', 'Diagonal City', 'HG', '63180-000'),
(4, 'Beco Diagonal', '403', 'Centro', 'Diagonal City', 'HG', '63180-000'),
(5, 'Beco Diagonal', '403', 'Centro', 'Diagonal City', 'HG', '63180-000'),
(6, 'Maria Ang?lica', 'null', 'Centro', 'Salvador', 'Bahia 	BA 	 ', '98.787-897'),
(7, 'snsjdfhsief', 'null', 'ksdjlsd', 'klsndlksdv', 'Acre 	AC 	 ', '67.846-348'),
(8, 'The Moon', 'null', 'Centro', 'Cratera 2', 'Acre 	AC 	 ', '00.000-000'),
(9, 'dsdhfdh dgdfg', 'null', 'cascas', 'ashasf', 'Acre 	AC 	 ', '39.590-348'),
(10, 'asdas', 'null', 'ihgjhgvyuhvgyuh', 'uyyvujhfvy', 'Acre 	AC 	 ', '72.365-289'),
(11, 'bfksefhkjr', 'null', 'skfbueirg', 'immeofhuseirg', 'Cear? 	CE 	 ', '56.089-350'),
(12, 'asldhfsn s', 'null', 'andflsdngdlr ', 'jLKSFIRG', 'Rio de Janeiro 	RJ 	 ', '87.648-604'),
(13, 'sdjfhs', 'null', 'snf oserhfiwoejf', 'lwefeiof', 'Distrito Federal 	DF 	 ', '58.734-086'),
(14, 'kfjdneirngri tierugido', 'null', 'ksldfeiro', 'aj fpi jr idgdirjgidrj', 'Par? 	PA 	 ', '83.476-845'),
(15, 'sy ywg fiweiufhsef', 'null', 'skjdf', 'lsnforehteorwejr', 'Rio Grande do Norte 	RN 	 ', '33.437-554'),
(16, 'rbhdfhfgh', 'null', 'tfhdfthdfthdth', 'dthfghfh', 'Santa Catarina 	SC 	 ', '86.578-678'),
(17, 'sgdgff', 'null', 'dfgdfhgfgh', 'fdghfgh', 'Santa Catarina 	SC 	 ', '43.554-657'),
(18, 'skjfhsdf', 'null', 'sdjfsd', 'lkfnlkdfb', 'Acre 	AC 	 ', '83.475-436'),
(19, 'ijkl?dfg', 'null', 'kjbkb', 'kb', 'Mato Grosso 	MT 	 ', '93.850-498'),
(20, 'sldjfsgsg', 'null', 'jkjhkjhk', 'lhlno', 'Bahia BA', '34.539-484'),
(21, 'sdfsdfsdf', 'null', 'kjhkjhkj', 'hkjh', 'Bahia BA', '09.348-540'),
(22, 's?asdkj', 'null', 'kljkljkj', 'kljlkjklj', 'Para?ba PB', '23.838-493');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nivel` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `nivel`, `username`, `password`, `token`) VALUES
(1, 'João Gerente', 4, 'jgerente', '81dc9bdb52d04dc20036dbd8313ed055', 'd41d8cd98f00b204e9800998ecf8427e');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enderecos`
--
ALTER TABLE `enderecos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alunos`
--
ALTER TABLE `alunos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `enderecos`
--
ALTER TABLE `enderecos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;
