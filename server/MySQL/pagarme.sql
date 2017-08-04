-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 03-Ago-2017 às 22:58
-- Versão do servidor: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pagarme`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `fantasia`
--

CREATE TABLE `fantasia` (
  `id` int(11) NOT NULL,
  `fornecedor_id` int(11) DEFAULT NULL,
  `descricao` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `valor` decimal(5,2) NOT NULL,
  `imagem_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `fantasia`
--

INSERT INTO `fantasia` (`id`, `fornecedor_id`, `descricao`, `valor`, `imagem_id`) VALUES
(1, 1, 'Fantasia do Darth Vader', '125.00', 1),
(2, 2, 'Fantasia do Cafú', '100.00', 3),
(3, 4, 'Máscara de Cavalo', '150.00', 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor`
--

CREATE TABLE `fornecedor` (
  `id` int(11) NOT NULL,
  `nome` varchar(60) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `fornecedor`
--

INSERT INTO `fornecedor` (`id`, `nome`) VALUES
(1, 'Maria Barros'),
(2, 'João Thiago Samuel Cavalcanti'),
(4, 'César Anthony João Martins');

-- --------------------------------------------------------

--
-- Estrutura da tabela `imagem`
--

CREATE TABLE `imagem` (
  `id` int(11) NOT NULL,
  `uri` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `imagem`
--

INSERT INTO `imagem` (`id`, `uri`) VALUES
(1, 'http://www.universofantasias.com.br/imagens_produtos/1_gnd_darth_vader_luxo.jpg'),
(3, 'https://conteudo.imguol.com.br/c/entretenimento/2014/02/18/18fev2014---cafu-marca-presenca-no-evento-abre-alas-camarote-brahma-2014-no-maracana-no-rio-de-janeiro-1392769178849_300x200.jpg'),
(4, 'https://http2.mlstatic.com/D_Q_NP_956515-MLB25259047604_012017-Q.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fantasia`
--
ALTER TABLE `fantasia`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_3B6CDE6ED3EBB69D` (`fornecedor_id`),
  ADD UNIQUE KEY `UNIQ_3B6CDE6E64892549` (`imagem_id`);

--
-- Indexes for table `fornecedor`
--
ALTER TABLE `fornecedor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `imagem`
--
ALTER TABLE `imagem`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fantasia`
--
ALTER TABLE `fantasia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `fornecedor`
--
ALTER TABLE `fornecedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `imagem`
--
ALTER TABLE `imagem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `fantasia`
--
ALTER TABLE `fantasia`
  ADD CONSTRAINT `FK_3B6CDE6E64892549` FOREIGN KEY (`imagem_id`) REFERENCES `imagem` (`id`),
  ADD CONSTRAINT `FK_3B6CDE6ED3EBB69D` FOREIGN KEY (`fornecedor_id`) REFERENCES `fornecedor` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
