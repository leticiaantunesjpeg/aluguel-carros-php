-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15/05/2024 às 00:45
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `aluguel-carros-php`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `reserva`
--

CREATE TABLE `reserva` (
  `id` int(11) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  `id_veiculo` int(11) NOT NULL,
  `nome_cliente` varchar(255) NOT NULL,
  `doc_cliente` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(100) DEFAULT NULL,
  `data_de_nascimento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `veiculo`
--

CREATE TABLE `veiculo` (
  `id` int(11) NOT NULL,
  `marca` varchar(50) DEFAULT NULL,
  `modelo` varchar(50) DEFAULT NULL,
  `placa` varchar(20) DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `disponibilidade` tinyint(1) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `veiculo`
--

INSERT INTO `veiculo` (`id`, `marca`, `modelo`, `placa`, `valor`, `disponibilidade`, `imagem`) VALUES
(0, 'Chevrolet', 'camaro', 'ABC1234', 150.00, 1, 'chevrolet_camaro'),
(1, 'Chevrolet', 'Chevette', 'CBA1234', 140.00, 1, 'chevrolet_chevette'),
(2, 'Chevrolet', 'Corvette', 'BCA1234', 130.00, 1, 'chevrolet_corvette'),
(3, 'Chevrolet', 'S10', 'ASD1234', 120.00, 1, 'chevrolet_s10'),
(4, 'Dodge', 'Dart', 'QWE1234', 150.00, 1, 'dodge_dart'),
(5, 'Dodge', 'Fargo', 'ERT1234', 160.00, 1, 'dodge_fargo'),
(6, 'Fiat', '147', 'GHJ1234', 60.00, 1, 'fiat_147'),
(7, 'Fiat', 'Marea', 'KLÇ1234', 90.00, 1, 'fiat_marea'),
(8, 'Ford', 'Mustang', 'CVB1234', 190.00, 1, 'ford_mustang'),
(9, 'Chevrolet', 'Impala', 'UIO1234', 190.00, 1, 'chevrolet_impala'),
(10, 'Jaguar', 'M30', 'KJH1234', 180.00, 1, 'jaguar'),
(11, 'Chevrolet', 'Opala', 'KCT1234', 200.00, 1, 'chevrolet_opala'),
(12, 'Volkswagen', 'Puma', 'MAG1234', 210.00, 1, 'wv_puma'),
(13, 'volkswagen', 'Brasilia', 'BRA1234', 80.00, 1, 'wv_brasilia'),
(14, 'Volkswagen', 'Kombi', 'BRI1234', 80.00, 1, 'wv_kombi'),
(15, 'Subaru', 'Legado', 'BCV1234', 180.00, 1, 'subaru_legado');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_veiculo` (`id_veiculo`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `veiculo`
--
ALTER TABLE `veiculo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`id_veiculo`) REFERENCES `veiculo` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
