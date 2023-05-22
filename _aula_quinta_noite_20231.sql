-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22/05/2023 às 05:17
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
-- Banco de dados: `_aula_quinta_noite_20231`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `historico`
--

CREATE TABLE `historico` (
  `id` int(11) NOT NULL,
  `id_carro_placa` varchar(12) NOT NULL,
  `data_servico` varchar(20) NOT NULL,
  `valor_cobrado` varchar(24) NOT NULL,
  `validade_garantia` varchar(24) NOT NULL,
  `mecanico_responsavel` varchar(40) NOT NULL,
  `pecas_compradas` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `historico`
--

INSERT INTO `historico` (`id`, `id_carro_placa`, `data_servico`, `valor_cobrado`, `validade_garantia`, `mecanico_responsavel`, `pecas_compradas`) VALUES
(6, '9876222', 'asd', 'asd', 'asd', '123', 'asd'),
(15, '92234', 'ontem', '2000', 'amanhã', 'jailton', 'cambio'),
(24, '123', 'ontem', '200', 'asd', 'asda', 'asd'),
(27, '9876222', 'teste', 'asd', 'asd', 'asd', 'tesst');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`) VALUES
(9, 'Roni', 'pontes014@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(14, 'novo', 'example@example.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(16, 'tatiane', 'tatiolive2002@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

-- --------------------------------------------------------

--
-- Estrutura para tabela `veiculos`
--

CREATE TABLE `veiculos` (
  `placa` varchar(11) NOT NULL,
  `id_proprietario` int(11) DEFAULT NULL,
  `fabricante` varchar(50) DEFAULT NULL,
  `modelo` varchar(50) DEFAULT NULL,
  `tipo` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `veiculos`
--

INSERT INTO `veiculos` (`placa`, `id_proprietario`, `fabricante`, `modelo`, `tipo`) VALUES
('123', 9, '123', '123', '123'),
('92234', 9, 'volks', 'voyage', 'carro'),
('9471', 16, 'bmw', 'x1', 'carro'),
('9876222', 14, 'teste', 'modelo teste', 'carro');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `historico`
--
ALTER TABLE `historico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_carro_placa` (`id_carro_placa`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `veiculos`
--
ALTER TABLE `veiculos`
  ADD PRIMARY KEY (`placa`),
  ADD KEY `fk_id_proprietario` (`id_proprietario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `historico`
--
ALTER TABLE `historico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `historico`
--
ALTER TABLE `historico`
  ADD CONSTRAINT `fk_id_carro_placa` FOREIGN KEY (`id_carro_placa`) REFERENCES `veiculos` (`placa`) ON DELETE CASCADE,
  ADD CONSTRAINT `historico_ibfk_1` FOREIGN KEY (`id_carro_placa`) REFERENCES `veiculos` (`placa`),
  ADD CONSTRAINT `historico_ibfk_2` FOREIGN KEY (`id_carro_placa`) REFERENCES `veiculos` (`placa`) ON DELETE CASCADE;

--
-- Restrições para tabelas `veiculos`
--
ALTER TABLE `veiculos`
  ADD CONSTRAINT `fk_id_proprietario` FOREIGN KEY (`id_proprietario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `veiculos_ibfk_1` FOREIGN KEY (`id_proprietario`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `veiculos_ibfk_2` FOREIGN KEY (`id_proprietario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
