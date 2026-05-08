-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09/05/2026 às 01:30
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ecocalc`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `calculos`
--

CREATE TABLE `calculos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `calculado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  `emissao_transporte` float DEFAULT NULL,
  `emissao_energia` float DEFAULT NULL,
  `emissao_total` float DEFAULT NULL,
  `tipo_transporte` varchar(50) DEFAULT NULL,
  `combustivel` varchar(50) DEFAULT NULL,
  `km_dia` float DEFAULT NULL,
  `dias_semana` int(11) DEFAULT NULL,
  `valor_conta` float DEFAULT NULL,
  `usa_led` varchar(10) DEFAULT NULL,
  `usa_renovavel` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `calculos`
--

INSERT INTO `calculos` (`id`, `usuario_id`, `calculado_em`, `emissao_transporte`, `emissao_energia`, `emissao_total`, `tipo_transporte`, `combustivel`, `km_dia`, `dias_semana`, `valor_conta`, `usa_led`, `usa_renovavel`) VALUES
(1, 1, '2026-05-08 23:15:39', 17.2, 0, 17.2, 'Carro', 'Gasolina', 4, 5, 4, 'Sim', 'Sim'),
(2, 1, '2026-05-08 23:16:30', 0, 0, 0, 'Bicicleta', 'Nenhum', 4, 4, 4, 'Sim', 'Sim'),
(3, 1, '2026-05-08 23:22:48', 0, 1.66667, 1.66667, 'A pé', 'Nenhum', 3, 5, 10, 'Não', 'Não');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha_hash` varchar(255) NOT NULL,
  `foto_perfil` varchar(255) DEFAULT 'default.png',
  `nivel_acesso` int(11) DEFAULT 1,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha_hash`, `foto_perfil`, `nivel_acesso`, `criado_em`) VALUES
(1, 'marcelo', 'marcelo@gmail.com', '$2y$10$aucG.5AkGqmY3.q0B27qKO4Ad3v7/0TylVSv.K0x5.GJv45LBqOBm', 'default.png', 1, '2026-05-08 23:15:08');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `calculos`
--
ALTER TABLE `calculos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `calculos`
--
ALTER TABLE `calculos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `calculos`
--
ALTER TABLE `calculos`
  ADD CONSTRAINT `calculos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
