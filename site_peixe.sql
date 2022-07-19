-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 03-Nov-2021 às 18:29
-- Versão do servidor: 5.7.31
-- versão do PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `site peixe`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidade`
--

DROP TABLE IF EXISTS `cidade`;
CREATE TABLE IF NOT EXISTS `cidade` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(45) NOT NULL,
  `Estado` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_EstadoCidade` (`Estado`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cidade`
--

INSERT INTO `cidade` (`Id`, `Nome`, `Estado`) VALUES
(1, 'Marataízes', 1),
(2, 'Cachoeiro de Itapemirim', 1),
(3, 'Vitória', 1),
(4, 'Belo Horizonte', 2),
(5, 'Nova Resende', 2),
(6, 'Jacuí', 2),
(7, 'Porto Seguro', 3),
(8, 'Alagoinhas', 3),
(9, 'Valença', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `estado`
--

DROP TABLE IF EXISTS `estado`;
CREATE TABLE IF NOT EXISTS `estado` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(20) NOT NULL,
  `Sigla` varchar(2) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `estado`
--

INSERT INTO `estado` (`Id`, `Nome`, `Sigla`) VALUES
(1, 'Espírito Santo', 'ES'),
(2, 'Minas Gerais', 'MG'),
(3, 'Bahia', 'BA');

-- --------------------------------------------------------

--
-- Estrutura da tabela `local_entrega`
--

DROP TABLE IF EXISTS `local_entrega`;
CREATE TABLE IF NOT EXISTS `local_entrega` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Endereço` varchar(75) NOT NULL,
  `Numero` int(11) NOT NULL,
  `Estado` int(11) NOT NULL,
  `Cidade` int(11) NOT NULL,
  `CEP` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_EstadoLocal_Entrega` (`Estado`) USING BTREE,
  KEY `FK_CidadeLocal_Entrega` (`Cidade`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pagamento`
--

DROP TABLE IF EXISTS `pagamento`;
CREATE TABLE IF NOT EXISTS `pagamento` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pagamento_cartao`
--

DROP TABLE IF EXISTS `pagamento_cartao`;
CREATE TABLE IF NOT EXISTS `pagamento_cartao` (
  `Id` int(11) NOT NULL,
  `Nome` varchar(30) NOT NULL,
  `Numero` int(11) NOT NULL,
  `Validade` date NOT NULL,
  `CVV` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_PagementoPagamento_Cartao` (`Id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pagina`
--

DROP TABLE IF EXISTS `pagina`;
CREATE TABLE IF NOT EXISTS `pagina` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Controlador` varchar(50) NOT NULL,
  `Metodo` varchar(50) NOT NULL,
  `Titulo` varchar(30) NOT NULL,
  `Tipo` varchar(15) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pagina`
--

INSERT INTO `pagina` (`Id`, `Controlador`, `Metodo`, `Titulo`, `Tipo`) VALUES
(1, 'Inicio', 'index', 'Site Peixe', 'site'),
(2, 'Loja', 'principal', 'Loja Principal', 'site'),
(3, 'Loja', 'detalhe', 'Loja - ', 'site'),
(4, 'Loja', 'carrinho', 'Carrinho de Compras', 'site'),
(6, 'Informacao', 'contato', 'Contato', 'site'),
(5, 'Loja', 'checkout', 'Checkout', 'site'),
(7, 'Usuario', 'perfil', 'Meu Perfil', 'site');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

DROP TABLE IF EXISTS `pedido`;
CREATE TABLE IF NOT EXISTS `pedido` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `PrecoPedido` float NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

DROP TABLE IF EXISTS `produto`;
CREATE TABLE IF NOT EXISTS `produto` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(50) NOT NULL,
  `Descricao` varchar(1200) NOT NULL,
  `Estoque` decimal(5,2) NOT NULL,
  `EstoqueEEstmd` tinyint(1) NOT NULL,
  `Preco` decimal(5,2) NOT NULL,
  `Unidade` int(11) NOT NULL DEFAULT '6',
  `Tipo` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`Id`),
  KEY `FK_UnidadeProduto` (`Unidade`),
  KEY `FK_Tipo_ProdutoProduto` (`Tipo`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`Id`, `Nome`, `Descricao`, `Estoque`, `EstoqueEEstmd`, `Preco`, `Unidade`, `Tipo`) VALUES
(1, 'Bacalháu', 'Ut aliquet nibh in nulla convallis, sit amet lobortis urna commodo. Fusce id euismod odio. Interdum et malesuada fames ac ante ipsum primis in faucibus. Phasellus ac neque pellentesque tortor ultricies aliquam. Phasellus ultrices, metus eu placerat lobortis, felis felis dictum lectus, sit amet porttitor ligula nisl in neque. Proin non tempus quam, nec placerat urna. Donec maximus condimentum erat, tincidunt iaculis turpis fermentum eget. In metus lorem, ultrices quis ullamcorper vel, ultrices sit amet turpis. Aliquam tincidunt mi nisl, luctus vehicula leo varius non. Vivamus non justo convallis, sodales tellus ac, ultrices nibh. Cras non justo nec massa tincidunt.', '645.00', 1, '25.00', 3, 1),
(2, 'Pacu', 'In in urna pulvinar, pharetra ex nec, aliquam tellus. In consectetur ullamcorper dignissim. Curabitur eros purus, vulputate ac ultrices hendrerit, interdum in velit. Quisque ut fringilla risus. Vivamus aliquam dolor vel tortor fringilla, non cursus leo consectetur. Nam blandit blandit finibus. Morbi viverra bibendum ante eu consectetur. Duis id volutpat tortor, vel suscipit sapien. Quisque ut felis vitae orci placerat aliquet. In hac habitasse platea dictumst. Praesent quam arcu, posuere venenatis purus at, pulvinar interdum purus.  Praesent in purus tincidunt, accumsan orci a, tristique turpis. In consectetur cursus justo, ac convallis lorem vehicula sit amet. Proin viverra egestas ornare. Nam.', '507.00', 1, '15.00', 2, 1),
(3, 'Bagre', 'Quisque eget leo ac dolor placerat ullamcorper. In hac habitasse platea dictumst. Aenean luctus urna quis dui viverra vestibulum. Cras id nibh facilisis, volutpat ex non, elementum justo. Suspendisse euismod risus massa, ac sodales nunc fermentum eu. Nullam risus ligula, tristique at tincidunt a, finibus id diam. Etiam pellentesque enim consequat ante maximus, vitae pharetra urna pulvinar. Pellentesque vehicula orci non neque condimentum gravida sit amet suscipit nibh. Vestibulum fermentum dictum elit, id dapibus metus. Nam et erat eu lacus auctor efficitur. Mauris dolor magna, efficitur et pulvinar eget, luctus non nibh. Donec vel enim eleifend, interdum sem eget, fringilla.', '800.00', 1, '30.00', 3, 1),
(4, 'Carpa', 'Interdum et malesuada fames ac ante ipsum primis in faucibus. Cras sed leo sollicitudin, ultrices urna ut, scelerisque eros. Duis tincidunt, risus vel condimentum rhoncus, nibh magna sodales tellus, et feugiat felis elit non elit. Aliquam vulputate dictum erat, eget aliquam elit tempus a. Nullam turpis nisi, fringilla id condimentum sed, lobortis ac leo. Curabitur ut turpis eu dui accumsan tincidunt lobortis consectetur justo. Maecenas eget ex nulla. Praesent varius velit lobortis purus aliquet pellentesque. Suspendisse ullamcorper lectus vitae lobortis mattis. Donec blandit lacus vitae elit vulputate elementum. Phasellus in ex nisl. Sed eget metus in arcu tristique convallis eget.', '773.00', 0, '20.00', 3, 1),
(5, 'Salmão', 'Vestibulum et orci nunc. Vivamus ipsum massa, blandit id arcu in, facilisis gravida lacus. Aliquam sollicitudin nibh ac convallis iaculis. Donec quam purus, dapibus non mi non, condimentum egestas nulla. Nam rhoncus commodo aliquam. Ut quis urna suscipit, mollis sem eget, laoreet diam. Ut non leo a eros suscipit feugiat quis eu urna. Quisque at bibendum leo. Quisque dui ex, rhoncus dapibus tempor et, vestibulum sed mauris. Pellentesque aliquam dignissim semper. Phasellus quis iaculis metus. Maecenas scelerisque pharetra nunc, egestas scelerisque nisi venenatis ut. Integer vitae velit vel arcu fringilla fringilla. Aenean nec lacinia arcu. Aliquam sit amet lectus id.', '71.00', 1, '12.50', 2, 1),
(6, 'Camarão', 'Suspendisse malesuada eget massa in consectetur. Praesent vulputate sem ex, tincidunt commodo sem molestie ac. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Mauris sed orci tempor, tincidunt orci ut, porttitor libero. Nunc quis erat bibendum lectus sagittis venenatis eget id quam. Quisque auctor nibh nec magna molestie bibendum. Sed interdum quam et diam viverra, vel efficitur diam consectetur. Ut tincidunt consequat libero ut euismod. Quisque ultrices nunc nec vehicula laoreet. Suspendisse eu convallis ipsum, at rutrum mauris. Vestibulum eget elit sed enim vehicula porttitor vel sed augue. Sed tincidunt sem at leo placerat vehicula. Pellentesque.', '383.00', 0, '29.99', 1, 2),
(7, 'Caranguejo', ' Duis ultricies lacus ut blandit lobortis. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse euismod ex eu efficitur tempor. Mauris nec eros molestie, porttitor est sed, mattis mi. Quisque id orci ultricies, sollicitudin lacus non, feugiat lacus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Cras pellentesque risus in dapibus placerat. Pellentesque suscipit at mi mollis tristique. Pellentesque vitae leo eget nisi fermentum lobortis in nec neque. Aliquam at egestas ex. Nulla mattis et nisl tempor varius. Phasellus lobortis augue at nulla ornare malesuada. Curabitur a mattis risus, quis iaculis.', '63.00', 1, '19.99', 1, 2),
(8, 'Polvo', 'Ut egestas vitae ex a tempor. Morbi quis convallis ante, at rutrum dui. Maecenas suscipit ante in dolor ornare aliquam. Pellentesque sapien mauris, placerat non erat sed, varius elementum erat. Quisque finibus nisi orci, vel suscipit dolor lacinia id. Nam fringilla magna sem, et hendrerit mauris commodo a. Quisque congue erat erat, euismod elementum risus efficitur eu. Suspendisse nibh nulla, laoreet sit amet augue ac, faucibus feugiat sapien. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque ut sapien venenatis, malesuada ante in, elementum augue. Donec at tellus ante. Ut vel sapien ultrices, vestibulum urna.', '399.00', 1, '50.00', 3, 2),
(9, 'Lula', ' Pellentesque non mauris id massa rutrum porttitor. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nunc pellentesque lobortis hendrerit. In at pretium felis. Nunc ac tortor facilisis, lacinia sapien in, tincidunt est. Pellentesque nec justo eget velit molestie auctor. Nam egestas tempor eros, sed dignissim dolor rhoncus id.  Mauris vehicula finibus lorem, sed feugiat tortor venenatis nec. Maecenas pellentesque nisl in magna euismod faucibus. Sed tincidunt lacus odio, vel aliquet diam placerat eget. Sed in augue pulvinar dui aliquet pellentesque nec quis odio. Proin volutpat metus eu elit consectetur, ac cursus lacus fringilla. Duis vitae mauris leo. Curabitur.', '400.00', 0, '17.50', 3, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos_por_pedido`
--

DROP TABLE IF EXISTS `produtos_por_pedido`;
CREATE TABLE IF NOT EXISTS `produtos_por_pedido` (
  `IdPedido` int(11) NOT NULL,
  `IdProduto` int(11) NOT NULL,
  `QtdCmprd` int(11) NOT NULL,
  PRIMARY KEY (`IdPedido`,`IdProduto`),
  KEY `FK_IdProduto` (`IdProduto`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `teste`
--

DROP TABLE IF EXISTS `teste`;
CREATE TABLE IF NOT EXISTS `teste` (
  `Nome` varchar(50) NOT NULL,
  `Numero` int(11) NOT NULL AUTO_INCREMENT,
  `Data` date NOT NULL,
  `Descrição` text NOT NULL,
  `Outro Numero` int(11) DEFAULT NULL,
  PRIMARY KEY (`Numero`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `teste`
--

INSERT INTO `teste` (`Nome`, `Numero`, `Data`, `Descrição`, `Outro Numero`) VALUES
('Vanderson', 1, '2000-07-12', 'O ser humano responsável por este teste.', NULL),
('Alguém', 2, '2003-05-24', 'Você sabe aquele cara lá, que a gente encontrou naquele lugar, com aquelas pessoas. É esse mesmo!', NULL),
('Joãozinha', 3, '1983-04-11', 'Não pergunte sobre o nome dela...', NULL),
('Pessoa', 4, '2020-06-24', 'Uma pessoa qualquer.', 45);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_produto`
--

DROP TABLE IF EXISTS `tipo_produto`;
CREATE TABLE IF NOT EXISTS `tipo_produto` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Tipo` varchar(25) NOT NULL,
  `Grupo` varchar(25) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tipo_produto`
--

INSERT INTO `tipo_produto` (`Id`, `Tipo`, `Grupo`) VALUES
(1, 'Peixe', 'Pescado Congelado'),
(2, 'Fruto do Mar', 'Pescado Congelado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `unidade`
--

DROP TABLE IF EXISTS `unidade`;
CREATE TABLE IF NOT EXISTS `unidade` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `UnidadeVenda` varchar(20) NOT NULL,
  `UnidadeEstoque` varchar(20) NOT NULL,
  `TipoUnidade` varchar(25) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `unidade`
--

INSERT INTO `unidade` (`Id`, `UnidadeVenda`, `UnidadeEstoque`, `TipoUnidade`) VALUES
(1, 'g', 'g', 'Peso'),
(2, 'g', 'Kg', 'Peso'),
(3, 'Kg', 'Kg', 'Peso'),
(4, 'mg', 'g', 'Peso'),
(5, 'mg', 'mg', 'Peso'),
(6, 'ml', 'ml', 'Volume'),
(7, 'ml', 'L', 'Volume'),
(8, 'Caixas', 'Caixas', 'Objeto'),
(9, 'Pacotes', 'Pacotes', 'Objeto');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `PrmrNome` varchar(20) NOT NULL,
  `Sobrenome` varchar(45) NOT NULL,
  `Email` varchar(50) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
