-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09-Set-2025 às 20:21
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bancoleitura`
--

DELIMITER $$
--
-- Procedimentos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `validamacthiago` (IN `$macthiago` VARCHAR(17), OUT `$ativo` BOOLEAN)   BEGIN

SELECT ativo INTO $ativo FROM macthiago
WHERE idmacthiago = $macthiago;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `leiturathiago`
--

CREATE TABLE `leiturathiago` (
  `idleiturathiago` int(10) UNSIGNED NOT NULL,
  `macthiago_idmacthiago` varchar(17) NOT NULL,
  `dataleitura` date DEFAULT NULL,
  `horaleitura` time DEFAULT NULL,
  `umidade` double DEFAULT NULL,
  `temperatura` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `leiturathiago`
--

INSERT INTO `leiturathiago` (`idleiturathiago`, `macthiago_idmacthiago`, `dataleitura`, `horaleitura`, `umidade`, `temperatura`) VALUES
(1, '94:B9:7E:15:FB:FD', '2025-09-09', '15:15:52', 93, 20);

--
-- Acionadores `leiturathiago`
--
DELIMITER $$
CREATE TRIGGER `  tginsertleiturathiago` AFTER INSERT ON `leiturathiago` FOR EACH ROW BEGIN

UPDATE macthiago
SET contador = contador+1
WHERE idmacthiago = new.macthiago_idmacthiago;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tgdeleteleiturathiago` AFTER DELETE ON `leiturathiago` FOR EACH ROW BEGIN
UPDATE macthiago
SET contador = contador-1
WHERE idmacthiago = old.macthiago_idmacthiago;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tgverificaativothiago` BEFORE INSERT ON `leiturathiago` FOR EACH ROW BEGIN
CALL validamacthiago(new.macthiago_idmacthiago, @$ativo);

if @ativo = 0
	THEN SIGNAL SQLSTATE '45000' SET
    MESSAGE_TEXT = 'Placa inativa';
    END if;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `macthiago`
--

CREATE TABLE `macthiago` (
  `idmacthiago` varchar(17) NOT NULL,
  `nome` varchar(25) NOT NULL,
  `contador` int(10) UNSIGNED DEFAULT 0,
  `ativo` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `macthiago`
--

INSERT INTO `macthiago` (`idmacthiago`, `nome`, `contador`, `ativo`) VALUES
('94:B9:7E:15:FB:FD', 'Placa dia 09/09', 1, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `leiturathiago`
--
ALTER TABLE `leiturathiago`
  ADD PRIMARY KEY (`idleiturathiago`),
  ADD KEY `leiturathiago_FKIndex1` (`macthiago_idmacthiago`);

--
-- Índices para tabela `macthiago`
--
ALTER TABLE `macthiago`
  ADD PRIMARY KEY (`idmacthiago`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `leiturathiago`
--
ALTER TABLE `leiturathiago`
  MODIFY `idleiturathiago` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `leiturathiago`
--
ALTER TABLE `leiturathiago`
  ADD CONSTRAINT `leiturathiago_ibfk_1` FOREIGN KEY (`macthiago_idmacthiago`) REFERENCES `macthiago` (`idmacthiago`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
