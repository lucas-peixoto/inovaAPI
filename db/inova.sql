-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 03-Fev-2017 às 03:27
-- Versão do servidor: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inova`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `alunos`
--

CREATE TABLE `alunos` (
  `id` int(11) NOT NULL,
  `nome` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `cpf` varchar(14) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `telefone` varchar(16) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `curso_id` int(11) NOT NULL,
  `turno` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `endereco_id` int(11) NOT NULL,
  `data_cad` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `alunos`
--

INSERT INTO `alunos` (`id`, `nome`, `cpf`, `email`, `telefone`, `curso_id`, `turno`, `endereco_id`, `data_cad`) VALUES
(1, 'Lucas Peixoto', '039.188.293-75', 'lpeixoto2000@hotmail.com', '(88) 981293317', 2, 'tarde', 1, '2017-01-17 21:42:44'),
(2, 'Peixoto Lucas', '000.111.222-33', 'plucas2000@hotmail.com', '(88) 981293317', 2, 'noite', 2, '2017-01-18 19:26:39'),
(3, 'Xicara', '756.376.109-01', 'xica2k17@yahoo.com.br', '(88) 384635298', 3, 'manha', 3, '2017-01-20 18:24:02'),
(4, 'Alex', '555.000.109-01', 'alex2k17@yahoo.com.br', '(88) 111227564', 2, 'noite', 4, '2017-02-02 20:57:28'),
(5, 'Alexandra', '555.000.109-01', 'alexandra2k17@yahoo.com.br', '(88) 111227564', 3, 'noite', 5, '2017-02-02 20:59:39');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cursos`
--

CREATE TABLE `cursos` (
  `id` int(11) NOT NULL,
  `nome` varchar(250) CHARACTER SET latin1 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `cursos`
--

INSERT INTO `cursos` (`id`, `nome`) VALUES
(1, 'curso de abacate'),
(2, 'Engenharia Espacial'),
(3, 'Engenharia Aero-Espacial');

-- --------------------------------------------------------

--
-- Estrutura da tabela `enderecos`
--

CREATE TABLE `enderecos` (
  `id` int(11) NOT NULL,
  `rua` varchar(250) CHARACTER SET latin1 NOT NULL,
  `numero` varchar(15) CHARACTER SET latin1 NOT NULL,
  `bairro` varchar(250) CHARACTER SET latin1 NOT NULL,
  `cidade` varchar(150) CHARACTER SET latin1 NOT NULL,
  `estado` text CHARACTER SET latin1 NOT NULL,
  `cep` varchar(10) CHARACTER SET latin1 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `enderecos`
--

INSERT INTO `enderecos` (`id`, `rua`, `numero`, `bairro`, `cidade`, `estado`, `cep`) VALUES
(1, 'ruaa', 'nuksuc', 'barrasd', 'city', 'ES', '63180-000'),
(2, 'ruaa', 'nuksuc', 'barrasd', 'city', 'ES', '63180-000'),
(3, 'Beco Diagonal', '403', 'Biboca', 'Diagonal City', 'HG', '63180-000'),
(4, 'Beco Diagonal', '403', 'Centro', 'Diagonal City', 'HG', '63180-000'),
(5, 'Beco Diagonal', '403', 'Centro', 'Diagonal City', 'HG', '63180-000');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
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
-- Extraindo dados da tabela `usuarios`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `enderecos`
--
ALTER TABLE `enderecos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
