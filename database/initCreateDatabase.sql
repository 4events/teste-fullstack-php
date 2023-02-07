--
-- Database: `veiculos`
--
DROP DATABASE IF EXISTS `veiculos`;
CREATE DATABASE IF NOT EXISTS `veiculos` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

USE `veiculos`;

--
-- Table structure for table `marca`
--

DROP TABLE IF EXISTS `marca`;
CREATE TABLE IF NOT EXISTS `marca` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `marca` varchar(50) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `veiculo`
--

DROP TABLE IF EXISTS `veiculos`;
CREATE TABLE IF NOT EXISTS `veiculos` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_marca` int(11) NOT NULL,
  `veiculo` varchar(255) NOT NULL,
  `ano` int(4) NOT NULL,
  `descricao` text,
  `vendido` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime  NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime  NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_marca` (`id_marca`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for table `veiculo`
--
ALTER TABLE `veiculos`
  ADD CONSTRAINT `veiculo_ibfk_1` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;


--
-- Dumping data for table `marca`
--
INSERT INTO `marca` (`id`, `marca`, `created`) VALUES 
(1, 'FIAT', CURRENT_TIMESTAMP), 
(2, 'CHEVROLET', CURRENT_TIMESTAMP);
--
-- Dumping data for table `veiculos`
--

INSERT INTO `veiculos` (`id`, `id_marca`, `veiculo`, `ano`, `descricao`, `vendido`, `created`, `updated`) VALUES
(1, 1, 'Fiat Palio', 2010, 'E um carro bem robusto, bonito e confiavel. E possivel achar peças com facilidade, assim tambem qualquer mecanico consegue mexer nele. Particularmente, o Palio e o popular mais bonito da epoca.', 0, '2023-01-29 17:22:09', '2023-01-29 17:22:09'),
(2, 1, 'Fiat Uno', 2008, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ', 0, '2023-01-29 17:22:09', '2023-01-29 17:22:09'),
(3, 2, 'Corsa', 2012, 'O Corsa e um modelo de automovel fabricado pela Chevrolet e comercializado na America Latina e em alguns paises da Asia, entre 1994 e 2015.', 0, '2023-01-29 17:23:29', '2023-01-29 17:23:29'),
(4, 2, 'Celta', 2002, 'O Celta e um hatchback e no final de 2006 e inicio de 2007 foi lançada a versao sedan do carro, chamada Prisma. Foi concebido e desenvolvido integralmente no Brasil. ', 0, '2023-01-29 17:24:59', '2023-01-29 17:24:59');
