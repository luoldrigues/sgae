-- phpMyAdmin SQL Dump
-- version 3.5.8.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 19, 2014 at 01:01 AM
-- Server version: 5.5.34-0ubuntu0.13.04.1
-- PHP Version: 5.4.9-4ubuntu2.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sgae`
--

CREATE SCHEMA IF NOT EXISTS `sgae` DEFAULT CHARACTER SET utf8;
USE `sgae` ;

-- --------------------------------------------------------

--
-- Table structure for table `aluno`
--

DROP TABLE IF EXISTS `aluno`;
CREATE TABLE IF NOT EXISTS `aluno` (
  `idAluno` int(11) NOT NULL AUTO_INCREMENT,
  `idCurso` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `ra` bigint(20) NOT NULL,
  `senha` varchar(255) NOT NULL,
  PRIMARY KEY (`idAluno`),
  KEY `fk_Aluno_Curso_idx` (`idCurso`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `atividade`
--

DROP TABLE IF EXISTS `atividade`;
CREATE TABLE IF NOT EXISTS `atividade` (
  `idAtividade` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `carga_horaria` int(11) NOT NULL,
  `data_atividade` date DEFAULT NULL,
  `descricao` text,
  PRIMARY KEY (`idAtividade`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `atividade_has_aluno`
--

DROP TABLE IF EXISTS `atividade_has_aluno`;
CREATE TABLE IF NOT EXISTS `atividade_has_aluno` (
  `idAtividadeAluno` int(11) NOT NULL AUTO_INCREMENT,
  `idAtividade` int(11) NOT NULL,
  `idAluno` int(11) NOT NULL,
  `carga_horaria` int(11) NOT NULL DEFAULT '1',
  `data` date DEFAULT NULL,
  `descricao` text,
  PRIMARY KEY (`idAtividadeAluno`),
  KEY `fk_Atividade_has_Aluno_Aluno1_idx` (`idAluno`),
  KEY `fk_Atividade_has_Aluno_Atividade1_idx` (`idAtividade`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `curso`
--

DROP TABLE IF EXISTS `curso`;
CREATE TABLE IF NOT EXISTS `curso` (
  `idCurso` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `carga_horaria` int(11) NOT NULL,
  PRIMARY KEY (`idCurso`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `curso_has_atividade`
--

DROP TABLE IF EXISTS `curso_has_atividade`;
CREATE TABLE IF NOT EXISTS `curso_has_atividade` (
  `idCurso` int(11) NOT NULL,
  `idAtividade` int(11) NOT NULL,
  PRIMARY KEY (`idCurso`,`idAtividade`),
  KEY `fk_Curso_has_Atividade_Atividade1_idx` (`idAtividade`),
  KEY `fk_Curso_has_Atividade_Curso1_idx` (`idCurso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `fk_Aluno_Curso` FOREIGN KEY (`idCurso`) REFERENCES `curso` (`idCurso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `atividade_has_aluno`
--
ALTER TABLE `atividade_has_aluno`
  ADD CONSTRAINT `fk_Atividade_has_Aluno_Aluno1` FOREIGN KEY (`idAluno`) REFERENCES `aluno` (`idAluno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Atividade_has_Aluno_Atividade1` FOREIGN KEY (`idAtividade`) REFERENCES `atividade` (`idAtividade`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `curso_has_atividade`
--
ALTER TABLE `curso_has_atividade`
  ADD CONSTRAINT `curso_has_atividade_ibfk_1` FOREIGN KEY (`idAtividade`) REFERENCES `atividade` (`idAtividade`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Curso_has_Atividade_Curso1` FOREIGN KEY (`idCurso`) REFERENCES `curso` (`idCurso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
