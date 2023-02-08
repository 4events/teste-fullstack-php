-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06-Fev-2023 às 22:47
-- Versão do servidor: 10.4.25-MariaDB
-- versão do PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `api`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `veiculo`
--

CREATE TABLE `veiculo` (
  `id` int(11) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `marca` varchar(40) NOT NULL,
  `ano` int(11) NOT NULL,
  `descricao` varchar(300) NOT NULL,
  `vendido` int(1) NOT NULL,
  `criacao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `veiculo`
--

INSERT INTO `veiculo` (`id`, `nome`, `marca`, `ano`, `descricao`, `vendido`, `criacao`) VALUES
(2, 'Palio J6 1.6', 'FIAT', 2015, '2- Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce et ligula id felis pretium maximus. Curabitur blandit rutrum nulla.', 0, '2023-02-04 16:42:49'),
(6, 'Civic 2.0', 'Honda', 2022, '3- Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fermentum, ante sed placerat bibendum, eros eros molestie elit, id tincidunt nisi nulla a odio. Duis lorem tortor, maximus eget rhoncus ac, convallis eget turpis. Praesent ultrices libero ut hendrerit malesuada. 3- Pellentesque pretium ', 0, '2023-02-05 19:29:18'),
(7, 'Civic Sport 2.0', 'Honda', 2021, '4-Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fermentum, ante sed placerat bibendum, eros eros molestie elit, id tincidunt nisi nulla a odio. Duis lorem tortor, maximus eget rhoncus ac, convallis eget turpis. Praesent ultrices libero ut hendrerit malesuada. Pellentesque pretium ultr', 0, '2023-02-05 19:31:09'),
(8, 'Civic Sport 2.2', 'Honda', 2022, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fermentum, ante sed placerat bibendum, eros eros molestie elit, id tincidunt nisi nulla a odio. Duis lorem tortor, maximus eget rhoncus ac, convallis eget turpis. Praesent ultrices libero ut hendrerit malesuada. 5-Pellentesque pretium ultr', 0, '2023-02-05 19:32:11'),
(9, 'Siena 2.0', 'FIAT', 2022, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sed turpis justo. Aliquam mattis est id arcu hendrerit, quis congue dui euismod. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum ullamcorper pulvinar elit pulvinar mollis. Nulla mattis,', 0, '2023-02-05 19:33:45'),
(12, 'Hilux 1.6', 'Toyota', 2020, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque felis nulla, accumsan sagittis arcu eu, porttitor mollis massa. Sed nibh risus, faucibus sit amet dui eu, porttitor viverra mi. ', 1, '2023-02-05 19:52:08'),
(13, 'Corolla 1.8', 'Toyota', 2007, 'asdsa d asd asd as d asd as dsad ads asd asd asd as d asd as d asd as d sad as dsa d sa das d asd asd ', 0, '2023-02-06 18:46:26'),
(14, 'Argo 1.0', 'FIAT', 2019, 'asdsasdas asd sadas dasda sdsa d asd ada sd asd sad asd as da sd asdasdas asd asd asda da sdasdas das dasd asd asda sdasd asd ', 1, '2023-02-06 20:08:59');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `veiculo`
--
ALTER TABLE `veiculo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `veiculo`
--
ALTER TABLE `veiculo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
