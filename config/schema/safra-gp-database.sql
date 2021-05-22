-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22-Maio-2021 às 15:48
-- Versão do servidor: 10.4.10-MariaDB
-- versão do PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `safra-gp`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `application_seasons`
--

CREATE TABLE `application_seasons` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `application_seasons`
--

INSERT INTO `application_seasons` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Dessecação', '2020-08-23 12:21:23', '2020-08-23 12:21:23'),
(2, 'Pós-emergente', '2020-08-23 12:21:30', '2020-08-23 12:21:30'),
(3, 'Pós-emergente', '2020-08-23 12:21:44', '2020-08-23 12:21:44');

-- --------------------------------------------------------

--
-- Estrutura da tabela `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `transaction` char(36) NOT NULL,
  `type` varchar(7) NOT NULL,
  `primary_key` int(10) UNSIGNED DEFAULT NULL,
  `source` varchar(255) NOT NULL,
  `parent_source` varchar(255) DEFAULT NULL,
  `original` mediumtext DEFAULT NULL,
  `changed` mediumtext DEFAULT NULL,
  `meta` mediumtext DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `audit_stash_phinxlog`
--

CREATE TABLE `audit_stash_phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `tenant_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `banners`
--

INSERT INTO `banners` (`id`, `name`, `tenant_id`) VALUES
(1, 'Home', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `banner_images`
--

CREATE TABLE `banner_images` (
  `id` int(11) NOT NULL,
  `banner_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `link` varchar(45) DEFAULT NULL,
  `file_name` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `chemicals`
--

CREATE TABLE `chemicals` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `chemical_note_id` int(11) NOT NULL,
  `chemical_class_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `dose` decimal(10,2) NOT NULL,
  `chemical_measure_unit_id` int(11) NOT NULL,
  `chemical_target_id` int(11) NOT NULL,
  `incompatibility` text DEFAULT NULL,
  `observation` text DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `chemicals`
--

INSERT INTO `chemicals` (`id`, `name`, `chemical_note_id`, `chemical_class_id`, `supplier_id`, `dose`, `chemical_measure_unit_id`, `chemical_target_id`, `incompatibility`, `observation`, `created`, `modified`) VALUES
(1, 'Aminol', 1, 5, 2, '12.34', 2, 1, 'Et qui reprehenderit', 'Quis corrupti quam ', '2020-08-23 12:29:43', '2020-08-23 12:30:00'),
(2, 'Glizmax Prime', 2, 1, 2, '123.45', 2, 2, 'Dolore aut consequat', 'Qui vel est numquam ', '2020-08-23 12:30:18', '2020-08-23 12:30:18'),
(3, 'Astral', 2, 4, 2, '3.21', 1, 1, 'Quaerat ipsum fugia', 'Dolore cum possimus', '2020-08-23 12:30:32', '2020-08-23 12:30:32'),
(4, 'Glyphotal', 3, 4, 2, '32.33', 2, 2, 'Voluptas temporibus ', 'Et sed ut id et off', '2020-08-23 12:33:03', '2020-08-23 12:33:03'),
(5, 'Preciso', 4, 4, 2, '321.24', 2, 1, 'Qui non ut excepturi', 'Velit dolore atque e', '2020-08-23 12:33:25', '2020-08-23 12:33:25'),
(6, 'Zapp QI', 3, 2, 2, '54.45', 2, 2, 'Soluta cumque vitae ', 'Ea in ea ullamco tot', '2020-08-23 12:33:38', '2020-08-23 12:33:38'),
(7, 'Zavit', 2, 4, 2, '54.54', 2, 1, 'Voluptate culpa nes', 'Et quia dolorem ut t', '2020-08-23 12:33:58', '2020-08-23 12:33:58'),
(8, 'Glifosato WG', 2, 5, 2, '213.43', 2, 2, 'Sed est minus minim ', 'Sit veritatis laboru', '2020-08-23 12:34:12', '2020-08-23 12:34:12'),
(9, 'Roundup Ultra', 1, 2, 2, '33.45', 1, 1, 'Minus nesciunt anim', 'Sunt sit in consequ', '2020-08-23 12:34:31', '2020-08-23 12:34:31'),
(10, 'Roundup WG', 1, 4, 2, '66.76', 2, 1, 'Ut dolor autem provi', 'Dolorem rerum conseq', '2020-08-23 12:35:04', '2020-08-23 12:35:04');

-- --------------------------------------------------------

--
-- Estrutura da tabela `chemicals_application_seasons`
--

CREATE TABLE `chemicals_application_seasons` (
  `id` int(11) NOT NULL,
  `chemical_id` int(11) NOT NULL,
  `application_season_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `chemicals_application_seasons`
--

INSERT INTO `chemicals_application_seasons` (`id`, `chemical_id`, `application_season_id`) VALUES
(1, 1, 2),
(2, 2, 2),
(3, 2, 3),
(4, 3, 3),
(5, 4, 3),
(6, 5, 2),
(7, 6, 3),
(8, 7, 2),
(9, 7, 3),
(10, 8, 2),
(11, 8, 3),
(12, 9, 2),
(13, 9, 3),
(14, 10, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `chemicals_chemical_action_modes`
--

CREATE TABLE `chemicals_chemical_action_modes` (
  `id` int(11) NOT NULL,
  `chemical_id` int(11) NOT NULL,
  `chemical_action_mode_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `chemicals_chemical_action_modes`
--

INSERT INTO `chemicals_chemical_action_modes` (`id`, `chemical_id`, `chemical_action_mode_id`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 1, 4),
(4, 2, 3),
(5, 3, 3),
(6, 4, 1),
(7, 4, 4),
(8, 5, 1),
(9, 5, 4),
(10, 6, 4),
(11, 7, 4),
(12, 8, 3),
(13, 8, 4),
(14, 9, 3),
(15, 9, 4),
(16, 10, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `chemicals_chemical_groups`
--

CREATE TABLE `chemicals_chemical_groups` (
  `id` int(11) NOT NULL,
  `chemical_id` int(11) NOT NULL,
  `chemical_group_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `chemicals_chemical_groups`
--

INSERT INTO `chemicals_chemical_groups` (`id`, `chemical_id`, `chemical_group_id`) VALUES
(1, 1, 2),
(2, 2, 3),
(3, 3, 3),
(4, 4, 2),
(5, 5, 2),
(6, 6, 2),
(7, 6, 3),
(8, 7, 3),
(9, 8, 2),
(10, 9, 3),
(11, 10, 2),
(12, 10, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `chemicals_cultures`
--

CREATE TABLE `chemicals_cultures` (
  `id` int(11) NOT NULL,
  `chemical_id` int(11) NOT NULL,
  `culture_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `chemicals_cultures`
--

INSERT INTO `chemicals_cultures` (`id`, `chemical_id`, `culture_id`) VALUES
(1, 1, 3),
(2, 1, 4),
(3, 2, 1),
(4, 2, 3),
(5, 2, 4),
(6, 3, 1),
(7, 3, 3),
(8, 3, 4),
(9, 4, 1),
(10, 4, 3),
(11, 4, 4),
(12, 5, 1),
(13, 6, 4),
(14, 7, 1),
(15, 8, 1),
(16, 8, 3),
(17, 8, 4),
(18, 9, 3),
(19, 10, 1),
(20, 10, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `chemical_action_modes`
--

CREATE TABLE `chemical_action_modes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `chemical_action_modes`
--

INSERT INTO `chemical_action_modes` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Sistêmico', '2020-08-23 12:20:37', '2020-08-23 12:20:37'),
(2, 'Contato', '2020-08-23 12:20:46', '2020-08-23 12:20:46'),
(3, 'Ingestão', '2020-08-23 12:20:57', '2020-08-23 12:20:57'),
(4, 'Protetor', '2020-08-23 12:21:02', '2020-08-23 12:21:02');

-- --------------------------------------------------------

--
-- Estrutura da tabela `chemical_classes`
--

CREATE TABLE `chemical_classes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `chemical_classes`
--

INSERT INTO `chemical_classes` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Herbicida', '2020-08-23 12:19:46', '2020-08-23 12:19:46'),
(2, 'TS', '2020-08-23 12:19:55', '2020-08-23 12:19:55'),
(3, 'Inseticida', '2020-08-23 12:20:02', '2020-08-23 12:20:02'),
(4, 'Fungicida', '2020-08-23 12:20:10', '2020-08-23 12:20:10'),
(5, 'Foliar', '2020-08-23 12:20:16', '2020-08-23 12:20:16'),
(6, 'Adjuvantes', '2020-08-23 12:20:22', '2020-08-23 12:20:22');

-- --------------------------------------------------------

--
-- Estrutura da tabela `chemical_groups`
--

CREATE TABLE `chemical_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `chemical_groups`
--

INSERT INTO `chemical_groups` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Ácido Ariloxialcanóico', '2020-08-23 12:16:47', '2020-08-23 12:16:47'),
(2, 'Glicina Substituída', '2020-08-23 12:16:54', '2020-08-23 12:16:54'),
(3, 'Oxima Ciclohexanodiona', '2020-08-23 12:17:07', '2020-08-23 12:17:07');

-- --------------------------------------------------------

--
-- Estrutura da tabela `chemical_measure_units`
--

CREATE TABLE `chemical_measure_units` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `initial` varchar(45) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `chemical_measure_units`
--

INSERT INTO `chemical_measure_units` (`id`, `name`, `initial`, `created`, `modified`) VALUES
(1, 'Litro por Hectare', 'l/há', '2020-08-23 12:19:00', '2020-08-23 12:19:00'),
(2, 'Quilo por Hectare', 'kg/há', '2020-08-23 12:19:17', '2020-08-23 12:19:17');

-- --------------------------------------------------------

--
-- Estrutura da tabela `chemical_notes`
--

CREATE TABLE `chemical_notes` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `class` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `chemical_notes`
--

INSERT INTO `chemical_notes` (`id`, `name`, `class`) VALUES
(1, 'Recomendável', 'success'),
(2, 'Mediana', 'warning'),
(3, 'Não Recomendável', 'danger'),
(4, 'A confirmar', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `chemical_targets`
--

CREATE TABLE `chemical_targets` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `chemical_targets`
--

INSERT INTO `chemical_targets` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Buva/Trapoeraba/Corda Viola/Leitero/outros', '2020-08-23 12:17:38', '2020-08-23 12:31:03'),
(2, 'Capim Brachiária/ Capim colchão/ Capim colonião/ amendoim bravo', '2020-08-23 12:17:45', '2020-08-23 12:31:13'),
(3, 'Agriãozinho/Alfafa/ Beldroega/Apaga fogo', '2020-08-23 12:17:51', '2020-08-23 12:31:20');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cities`
--

INSERT INTO `cities` (`id`, `state_id`, `name`, `created`, `modified`) VALUES
(1, 1, 'Silvânia', '2020-06-13 15:31:36', '2020-06-13 15:31:36');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `message` text NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `email_return` varchar(255) DEFAULT NULL,
  `tenant_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cultivation_systems`
--

CREATE TABLE `cultivation_systems` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cultivation_systems`
--

INSERT INTO `cultivation_systems` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Sequeiro', '2020-06-22 10:30:04', '2020-06-22 10:30:04'),
(2, 'Irrigado', '2020-06-22 10:30:12', '2020-06-22 10:30:12');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cultures`
--

CREATE TABLE `cultures` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cultures`
--

INSERT INTO `cultures` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Milho Verão', '2020-06-22 10:29:33', '2020-06-22 10:29:33'),
(2, 'Milho Safrinha', '2020-06-22 10:29:38', '2020-06-22 10:29:38'),
(3, 'Soja', '2020-06-22 10:29:44', '2020-06-22 10:29:44'),
(4, 'Sorgo', '2020-06-22 10:29:49', '2020-06-22 10:29:49');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cycles`
--

CREATE TABLE `cycles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `start` int(11) NOT NULL,
  `end` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cycles`
--

INSERT INTO `cycles` (`id`, `name`, `start`, `end`, `created`, `modified`) VALUES
(1, 'Precoce', 95, 110, '2020-06-22 20:00:32', '2020-07-07 15:45:52'),
(2, 'Médio', 111, 120, '2020-06-22 20:01:03', '2020-06-22 20:01:03'),
(3, 'Tardio', 121, 140, '2020-06-22 20:01:38', '2020-06-22 20:01:38');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fertilities`
--

CREATE TABLE `fertilities` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `fertilities`
--

INSERT INTO `fertilities` (`id`, `name`, `supplier_id`, `created`, `modified`) VALUES
(1, 'Alta', 0, '2020-06-22 10:29:06', '2020-06-22 10:29:06'),
(2, 'Média', 0, '2020-06-22 10:29:11', '2020-06-22 10:29:11'),
(3, 'Baixa', 0, '2020-06-22 10:29:16', '2020-06-22 10:29:16'),
(4, 'Baixa/Média', 0, '2020-07-07 15:44:40', '2020-07-07 15:44:40'),
(5, 'Média/Alta', 0, '2020-07-07 15:44:57', '2020-07-07 15:45:12');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fertilities_seeds`
--

CREATE TABLE `fertilities_seeds` (
  `id` int(11) NOT NULL,
  `seed_id` int(11) NOT NULL,
  `fertility_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `fertilities_seeds`
--

INSERT INTO `fertilities_seeds` (`id`, `seed_id`, `fertility_id`) VALUES
(1, 1, 3),
(2, 2, 2),
(3, 2, 3),
(4, 2, 4),
(5, 2, 5),
(6, 3, 2),
(7, 4, 2),
(8, 4, 4),
(9, 5, 2),
(10, 5, 5),
(11, 6, 4),
(12, 7, 2),
(13, 7, 3),
(14, 7, 4),
(15, 8, 3),
(16, 8, 4),
(17, 9, 3),
(18, 9, 4),
(19, 9, 5),
(20, 10, 4),
(21, 11, 3),
(22, 11, 4),
(23, 11, 5),
(24, 12, 3),
(25, 13, 5),
(26, 14, 2),
(27, 14, 5),
(28, 15, 2),
(29, 15, 3),
(30, 16, 3),
(31, 16, 4),
(32, 16, 5),
(33, 17, 2),
(34, 17, 4),
(35, 18, 4),
(36, 18, 5),
(37, 19, 2),
(38, 19, 3),
(39, 19, 5),
(40, 20, 2),
(41, 20, 5),
(42, 21, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `fertilizers`
--

CREATE TABLE `fertilizers` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `formula` varchar(45) NOT NULL,
  `increment` varchar(45) DEFAULT NULL,
  `fertilizer_measure_unit_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fertilizer_measure_units`
--

CREATE TABLE `fertilizer_measure_units` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `initial` varchar(45) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fields`
--

CREATE TABLE `fields` (
  `id` int(11) NOT NULL,
  `immobile_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_area` decimal(10,2) NOT NULL,
  `measure_unit_id` int(11) NOT NULL,
  `cultivation_system_id` int(11) NOT NULL,
  `fertility_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `observations` text DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `fields`
--

INSERT INTO `fields` (`id`, `immobile_id`, `name`, `total_area`, `measure_unit_id`, `cultivation_system_id`, `fertility_id`, `city_id`, `observations`, `created`, `modified`) VALUES
(1, 1, 'Talhão Teste 1', '150.50', 1, 1, 2, 1, 'teste-teste1', '2020-07-07 15:21:03', '2020-07-07 15:21:03'),
(2, 2, 'TA 01', '50.00', 1, 1, 3, 1, 'Ut consequatur sed ', '2020-07-13 19:40:07', '2020-07-13 19:40:07'),
(3, 2, 'TA 02', '9.99', 1, 2, 4, 1, 'Ut nulla est illum ', '2020-07-13 19:40:31', '2020-07-13 20:05:08');

-- --------------------------------------------------------

--
-- Estrutura da tabela `field_details`
--

CREATE TABLE `field_details` (
  `id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `culture_id` int(11) NOT NULL,
  `fertility_id` int(11) NOT NULL,
  `area` decimal(10,2) NOT NULL,
  `measure_unit_id` int(11) NOT NULL,
  `observations` text DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `field_details`
--

INSERT INTO `field_details` (`id`, `field_id`, `culture_id`, `fertility_id`, `area`, `measure_unit_id`, `observations`, `created`, `modified`) VALUES
(1, 1, 3, 2, '100.00', 1, 'xxxx', '2020-07-07 15:27:30', '2020-07-07 15:27:30'),
(2, 2, 1, 5, '38.00', 1, 'Sit iusto veniam qu', '2020-07-13 19:40:52', '2020-07-13 19:42:00'),
(3, 2, 2, 3, '2.99', 1, 'Irure ullam animi p', '2020-07-13 19:41:13', '2020-07-13 19:42:09'),
(4, 2, 3, 3, '9.01', 1, 'Quidem fugiat quia r', '2020-07-13 19:41:44', '2020-07-13 19:41:44'),
(5, 3, 1, 5, '9.00', 1, 'Accusamus enim minim', '2020-07-13 19:42:29', '2020-07-13 19:42:29'),
(6, 3, 4, 2, '0.99', 1, 'Esse animi eum anim', '2020-07-13 19:42:36', '2020-07-13 19:42:36');

-- --------------------------------------------------------

--
-- Estrutura da tabela `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `sketch_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `type` varchar(45) NOT NULL,
  `extension` varchar(45) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `immobiles`
--

CREATE TABLE `immobiles` (
  `id` int(11) NOT NULL,
  `producer_id` int(11) NOT NULL,
  `harvest` varchar(45) NOT NULL,
  `city_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `observations` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `immobiles`
--

INSERT INTO `immobiles` (`id`, `producer_id`, `harvest`, `city_id`, `name`, `observations`) VALUES
(1, 1, '2020/2021', 1, 'Faz. Fred Teste 1', 'Iniciando teste 1.'),
(2, 3, '2020 / 2021', 1, 'Fazenda Delfino', 'Teste.\r\nEste é um teste.');

-- --------------------------------------------------------

--
-- Estrutura da tabela `measure_units`
--

CREATE TABLE `measure_units` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `initial` varchar(45) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `measure_units`
--

INSERT INTO `measure_units` (`id`, `name`, `initial`, `created`, `modified`) VALUES
(1, 'Hectares', 'Ha', '2020-06-22 10:27:47', '2020-07-07 15:42:51'),
(2, 'Alqueire Goiano', 'Alq/GO', '2020-07-07 15:42:06', '2020-07-07 15:42:06');

-- --------------------------------------------------------

--
-- Estrutura da tabela `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `viewed` int(11) DEFAULT 0,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `action` varchar(45) NOT NULL,
  `page_status_id` int(11) NOT NULL,
  `tenant_id` int(11) NOT NULL,
  `order` int(11) NOT NULL DEFAULT 99,
  `content` text DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pages`
--

INSERT INTO `pages` (`id`, `name`, `action`, `page_status_id`, `tenant_id`, `order`, `content`, `created`, `modified`) VALUES
(1, 'Home', 'home', 1, 2, 1, '<h1 style=\"margin: 1em 0px 0.3em; padding: 0px; color: #3f3f3f; font-variant-numeric: normal; font-variant-east-asian: normal; font-weight: 300; font-stretch: normal; font-size: 2.462em; line-height: 1.2em; font-family: Signika, sans-serif; background-color: #ffffff;\"><span style=\"margin: 0px; padding: 0px; color: #bc8c53;\">GE-AGRO</span>, insumos agr&iacute;colas</h1>\r\n<p style=\"margin: 1em 0px; padding: 0px; color: #747474; font-family: Arial, sans-serif; font-size: 13.008px; background-color: #ffffff;\">Facilitar o trabalho do produtor: &eacute; por isso que n&oacute;s, da Ge-Agro, estamos aqui.</p>\r\n<p style=\"margin: 1em 0px; padding: 0px; color: #747474; font-family: Arial, sans-serif; font-size: 13.008px; background-color: #ffffff;\">Nossa miss&atilde;o: melhorar a compra e a aquisi&ccedil;&atilde;o de insumos, buscando os melhores pre&ccedil;os; organizar e planejar a safra de cada cliente.</p>\r\n<p style=\"margin: 1em 0px; padding: 0px; color: #747474; font-family: Arial, sans-serif; font-size: 13.008px; background-color: #ffffff;\">Nossa vis&atilde;o: reunir tudo que o produtor precisa, todos os dias, em um s&oacute; lugar.</p>', '2020-10-25 00:12:13', '2021-05-16 09:47:59'),
(2, 'Contato', 'contato', 1, 2, 9, '<div>Envie-nos uma mensagem e logo entraremos em contato!</div>', '2020-10-25 00:12:36', '2021-04-02 12:09:11'),
(3, 'Serviços', 'servicos', 1, 2, 3, '<p>- Gest&atilde;o de compra de insumos</p>\r\n<p>- Planejamento de safra</p>\r\n<p>- Not&iacute;cias e informa&ccedil;&otilde;es sobre o mercado, clima, novas tecnologias</p>', '2020-10-25 00:12:52', '2021-03-04 08:35:56'),
(4, 'Empresa', 'empresa', 1, 2, 2, '<p>Facilitar o trabalho do produtor: &eacute; por isso que n&oacute;s, da Ge-Agro, estamos aqui.</p>\r\n<p>Nossa miss&atilde;o: melhorar a compra e a aquisi&ccedil;&atilde;o de insumos, buscando os melhores pre&ccedil;os, organizar e planejar a safra de cada cliente.</p>\r\n<p><strong>Nossa vis&atilde;o</strong>: reunir tudo que o produtor precisa, todos os dias, em um s&oacute; lugar.</p>\r\n<p style=\"text-align: center;\">..jhgjkhgjkhg</p>', '2020-10-25 00:12:13', '2021-04-02 12:57:11'),
(5, 'Notícias', 'noticias', 1, 2, 4, 'Em desenvolvimento', '2020-10-25 00:12:13', '2021-03-21 10:45:25'),
(6, 'Eventos', 'eventos', 2, 2, 5, 'Em desenvolvimento', '2020-10-25 00:12:13', '2021-03-04 08:37:02'),
(7, 'Links Úteis', 'links-uteis', 1, 2, 6, 'Em desenvolvimento', '2020-10-25 00:12:13', '2021-03-04 08:35:21'),
(8, 'Cursos', 'cursos', 2, 2, 7, 'Em desenvolvimento', '2020-10-25 00:12:13', '2021-03-04 08:37:10'),
(9, 'Cadastro', 'cadastro', 2, 2, 8, 'Em desenvolvimento', '2020-10-25 00:12:13', '2021-03-04 08:35:44'),
(10, 'Classificados', 'classificados', 1, 2, 5, 'Em desenvolvimento', '2021-02-21 10:34:43', '2021-03-04 08:37:13');

-- --------------------------------------------------------

--
-- Estrutura da tabela `page_statuses`
--

CREATE TABLE `page_statuses` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `page_statuses`
--

INSERT INTO `page_statuses` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Ativa', '2020-10-24 20:04:30', '2020-10-24 20:04:30'),
(2, 'Inativa', '2020-10-24 20:06:31', '2020-10-24 20:06:31');

-- --------------------------------------------------------

--
-- Estrutura da tabela `plans`
--

CREATE TABLE `plans` (
  `id` int(11) NOT NULL,
  `immobile_id` int(11) NOT NULL,
  `plan_status_id` int(11) NOT NULL DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `plans`
--

INSERT INTO `plans` (`id`, `immobile_id`, `plan_status_id`, `created`, `modified`) VALUES
(1, 2, 1, '2020-07-13 19:42:49', '2020-07-13 19:42:49');

-- --------------------------------------------------------

--
-- Estrutura da tabela `plan_field_details`
--

CREATE TABLE `plan_field_details` (
  `id` int(11) NOT NULL,
  `field_detail_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `selected_seed_id` int(11) DEFAULT NULL,
  `sequence` int(11) NOT NULL DEFAULT 0,
  `population` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `plan_field_details`
--

INSERT INTO `plan_field_details` (`id`, `field_detail_id`, `plan_id`, `selected_seed_id`, `sequence`, `population`, `created`, `modified`) VALUES
(1, 2, 1, 4, 1, 'Nam officiis non ut vel rerum culpa error qui', '2020-07-13 19:42:51', '2020-07-20 13:15:06'),
(2, 3, 1, 2, 5, 'teste 2', '2020-07-13 19:42:51', '2020-07-20 13:14:21'),
(3, 4, 1, NULL, 2, '', '2020-07-13 19:42:51', '2020-07-20 13:14:14'),
(4, 5, 1, 3, 3, 'teste 3', '2020-07-13 19:42:51', '2020-07-20 13:14:18'),
(5, 6, 1, NULL, 4, NULL, '2020-07-13 19:42:51', '2020-07-20 13:14:21');

-- --------------------------------------------------------

--
-- Estrutura da tabela `plan_statuses`
--

CREATE TABLE `plan_statuses` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `plan_statuses`
--

INSERT INTO `plan_statuses` (`id`, `name`) VALUES
(1, 'Vigente'),
(2, 'Finalizado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `producers`
--

CREATE TABLE `producers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `document` varchar(45) NOT NULL,
  `phone_cel` varchar(45) DEFAULT NULL,
  `phone_fix` varchar(45) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `producers`
--

INSERT INTO `producers` (`id`, `name`, `document`, `phone_cel`, `phone_fix`, `city_id`, `created`, `modified`) VALUES
(1, 'Frederico Teste 1', '1', NULL, NULL, NULL, '2020-07-07 15:11:30', '2020-07-07 15:11:30'),
(3, 'Gustavo César de Melo', '017.436.701-50', '(62) 99831-6669', '(12) 34567-8999', 1, '2020-07-13 19:38:50', '2020-07-13 19:38:50');

-- --------------------------------------------------------

--
-- Estrutura da tabela `productive_potencials`
--

CREATE TABLE `productive_potencials` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `productive_potencials`
--

INSERT INTO `productive_potencials` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Alto', '2020-06-22 10:28:23', '2020-06-22 10:28:23'),
(2, 'Médio', '2020-06-22 10:28:30', '2020-06-22 10:28:30'),
(3, 'Baixo', '2020-06-22 10:28:33', '2020-06-22 10:28:33');

-- --------------------------------------------------------

--
-- Estrutura da tabela `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `roles`
--

INSERT INTO `roles` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Administrador', '2020-06-10 13:24:16', '2020-06-10 13:24:16'),
(2, 'Consultor', '2020-06-13 15:27:11', '2020-06-13 15:27:11');

-- --------------------------------------------------------

--
-- Estrutura da tabela `seeds`
--

CREATE TABLE `seeds` (
  `id` int(11) NOT NULL,
  `seed_note_id` int(11) NOT NULL,
  `culture_id` int(11) NOT NULL,
  `variety_id` int(11) NOT NULL,
  `technology_id` int(11) NOT NULL,
  `maturation_group` decimal(10,2) NOT NULL,
  `cycle_days` int(11) NOT NULL,
  `cycle_id` int(11) NOT NULL,
  `zoning_region_id` int(11) NOT NULL,
  `productive_potencial_id` int(11) DEFAULT NULL,
  `resistency` varchar(45) DEFAULT NULL,
  `population` varchar(45) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `observations` text DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `seeds`
--

INSERT INTO `seeds` (`id`, `seed_note_id`, `culture_id`, `variety_id`, `technology_id`, `maturation_group`, `cycle_days`, `cycle_id`, `zoning_region_id`, `productive_potencial_id`, `resistency`, `population`, `city_id`, `supplier_id`, `observations`, `created`, `modified`) VALUES
(1, 4, 3, 4, 2, '111.11', 110, 1, 2, 2, 'Quia est amet in voluptatibus est tempor off', 'Et ut non culpa laudantium voluptatibus ex ', 1, 1, 'Quas autem animi id', '2020-07-13 19:44:38', '2020-07-13 19:44:38'),
(2, 3, 4, 3, 4, '22.22', 140, 3, 2, 3, 'Dicta aliquam quos porro sint vel illum sun', 'Et voluptas qui sed nesciunt temporibus cons', 1, 1, 'Et autem reiciendis ', '2020-07-13 19:46:29', '2020-07-13 19:46:29'),
(3, 2, 4, 2, 2, '3.33', 100, 1, 2, 1, 'Velit ex amet autem molestias dolores ratio', 'Harum unde error harum culpa dolore expedita', 1, 1, 'Impedit dolore aut ', '2020-07-13 19:47:20', '2020-07-13 19:47:20'),
(4, 1, 1, 4, 3, '23.45', 115, 2, 2, 2, 'In doloribus voluptate necessitatibus recusan', 'Est maxime id fugiat minima molestiae eu dol', 1, 1, 'Excepturi qui maxime', '2020-07-13 19:47:36', '2020-07-13 19:54:53'),
(5, 2, 1, 4, 1, '6.66', 110, 1, 2, 3, 'Aut fuga Nihil proident dicta eveniet temp', 'Eligendi exercitation non mollit ut alias', 1, 1, 'Molestiae sunt qui i', '2020-07-13 19:49:43', '2020-07-13 19:49:43'),
(6, 2, 1, 4, 1, '87.89', 114, 2, 2, 3, 'Distinctio Ullam nisi voluptatum aspernatur ', 'Sit velit nihil cillum natus enim consequat', 1, 1, 'Quidem et nostrud ac', '2020-07-13 19:49:59', '2020-07-13 19:49:59'),
(7, 3, 4, 3, 4, '135.89', 124, 3, 2, 2, 'Quasi ipsum delectus praesentium aut hic ad', 'Nesciunt rerum ullamco nobis et ut amet mag', 1, 1, 'Soluta quisquam volu', '2020-07-13 19:50:01', '2020-07-13 19:50:01'),
(8, 1, 1, 3, 1, '98.73', 115, 2, 2, 3, 'Aut doloremque nesciunt veritatis dolore del', 'Qui et duis dolor id ipsum quod saepe vitae', 1, 1, 'Nemo reprehenderit a', '2020-07-13 19:50:11', '2020-07-13 19:53:23'),
(9, 2, 3, 2, 4, '44.04', 108, 1, 2, 1, 'Reiciendis ad sapiente nihil pariatur Ex ali', 'Nisi proident dolor accusantium earum nisi p', 1, 1, 'Lorem ullamco omnis ', '2020-07-13 19:50:12', '2020-07-13 19:50:12'),
(10, 4, 4, 3, 2, '12.34', 121, 3, 2, 3, 'Nostrum consectetur mollit facere autem labor', 'Dolores ad ad expedita quidem magna consequat', 1, 1, 'Eiusmod omnis aut do', '2020-07-13 19:50:12', '2020-07-13 19:50:12'),
(11, 2, 4, 3, 1, '1.04', 99, 1, 2, 2, 'Sint in dolor aut laborum Sit labore dolore', 'Dolorum tempor officia elit commodo et', 1, 1, 'Qui repudiandae vel ', '2020-07-13 19:50:12', '2020-07-13 19:50:12'),
(12, 3, 1, 4, 3, '65.42', 113, 2, 2, 3, 'Fugiat debitis et unde velit', 'Tenetur non animi et dolore', 1, 1, 'Irure ut aut debitis', '2020-07-13 19:50:14', '2020-07-13 19:54:04'),
(13, 2, 1, 3, 5, '878.54', 131, 3, 2, 3, 'Illo aliqua Doloribus sit aut debitis occae', 'Nam officiis non ut vel rerum culpa error qui', 1, 1, 'Et voluptas deserunt', '2020-07-13 19:50:14', '2020-07-13 19:54:09'),
(14, 4, 3, 4, 2, '685.79', 98, 1, 2, 2, 'Dolore optio irure id consectetur cumque su', 'Non porro sequi ratione impedit ipsam perspi', 1, 1, 'Soluta exercitatione', '2020-07-13 19:51:25', '2020-07-13 19:51:25'),
(15, 2, 4, 4, 2, '21.01', 110, 1, 2, 1, 'Voluptates enim sed fugit ratione fugiat id ', 'Pariatur Consequatur ea possimus molestias', 1, 1, 'Est sed est nisi a', '2020-07-13 19:51:26', '2020-07-13 19:51:26'),
(16, 2, 1, 2, 5, '131.00', 123, 3, 2, 1, 'Dolore id ut consequatur Consectetur', 'Dolorum similique exercitation neque quis odi', 1, 1, 'Et vel qui fugiat mo', '2020-07-13 19:51:27', '2020-07-13 19:51:27'),
(17, 3, 4, 2, 1, '67.98', 110, 1, 2, 2, 'Esse accusantium est aute consequatur ducimus', 'Impedit expedita ea aut rem dolorem culpa ul', 1, 1, 'Amet voluptatem num', '2020-07-13 19:51:27', '2020-07-13 19:51:27'),
(18, 3, 3, 2, 4, '321.35', 110, 1, 2, 1, 'Reiciendis tempore suscipit in non delectus', 'Eiusmod Nam officia doloremque inventore sint', 1, 1, 'Corrupti proident ', '2020-07-13 19:51:28', '2020-07-13 19:51:28'),
(19, 4, 3, 3, 5, '321.58', 129, 3, 2, 2, 'Dolore dolore quo deserunt aut necessitatibus', 'Soluta enim do labore laborum accusantium', 1, 1, 'Facilis ad dignissim', '2020-07-13 19:51:29', '2020-07-13 19:51:29'),
(20, 3, 1, 3, 5, '85.79', 97, 1, 2, 1, 'Magna pariatur Sed omnis sed nulla velit sed', 'Fuga Voluptas quam sed esse quis quia', 1, 1, 'Explicabo Laborum d', '2020-07-13 19:51:30', '2020-07-13 19:51:30'),
(21, 2, 1, 2, 3, '32.15', 95, 1, 2, 3, 'Architecto quae sed amet neque et nemo deser', 'Eveniet iure molestiae amet aut omnis', 1, 1, 'Do eveniet nisi in ', '2020-07-13 19:51:31', '2020-07-13 19:51:31');

-- --------------------------------------------------------

--
-- Estrutura da tabela `seed_notes`
--

CREATE TABLE `seed_notes` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `class` varchar(45) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `seed_notes`
--

INSERT INTO `seed_notes` (`id`, `name`, `class`) VALUES
(1, 'Recomendável', 'success'),
(2, 'Mediana', 'warning'),
(3, 'Não Recomendável', 'danger'),
(4, 'A confirmar', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `selected_chemicals`
--

CREATE TABLE `selected_chemicals` (
  `id` int(11) NOT NULL,
  `chemical_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `selected_chemicals`
--

INSERT INTO `selected_chemicals` (`id`, `chemical_id`, `plan_id`, `created`, `modified`) VALUES
(1, 2, 1, '2020-08-23 12:36:19', '2020-08-23 12:36:19'),
(5, 3, 1, '2020-08-23 12:36:49', '2020-08-23 12:36:49');

-- --------------------------------------------------------

--
-- Estrutura da tabela `selected_fertilizers`
--

CREATE TABLE `selected_fertilizers` (
  `id` int(11) NOT NULL,
  `fertilizer_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `selected_seeds`
--

CREATE TABLE `selected_seeds` (
  `id` int(11) NOT NULL,
  `seed_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `selected_seeds`
--

INSERT INTO `selected_seeds` (`id`, `seed_id`, `plan_id`, `created`, `modified`) VALUES
(1, 4, 1, '2020-07-13 19:55:18', '2020-07-13 19:55:18'),
(2, 6, 1, '2020-07-13 19:55:18', '2020-07-13 19:55:18'),
(3, 8, 1, '2020-07-13 19:55:19', '2020-07-13 19:55:19'),
(4, 13, 1, '2020-07-13 19:55:21', '2020-07-13 19:55:21');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sketches`
--

CREATE TABLE `sketches` (
  `id` int(11) NOT NULL,
  `field_id` int(11) DEFAULT NULL,
  `observations` text DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `sketches`
--

INSERT INTO `sketches` (`id`, `field_id`, `observations`, `created`, `modified`) VALUES
(1, 2, NULL, '2020-07-15 23:47:39', '2020-07-15 23:47:39'),
(2, 1, NULL, '2020-07-21 16:13:48', '2020-07-21 16:13:48'),
(3, 3, NULL, '2020-07-21 16:14:14', '2020-07-21 16:14:14');

-- --------------------------------------------------------

--
-- Estrutura da tabela `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `initial` varchar(2) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `states`
--

INSERT INTO `states` (`id`, `name`, `initial`, `created`, `modified`) VALUES
(1, 'Goiás', 'GO', '2020-06-13 15:26:08', '2020-06-13 15:26:08');

-- --------------------------------------------------------

--
-- Estrutura da tabela `subpages`
--

CREATE TABLE `subpages` (
  `id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `page_status_id` int(11) NOT NULL,
  `tenant_id` int(11) NOT NULL,
  `content` text DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `resale` varchar(255) NOT NULL,
  `city_id` int(11) NOT NULL,
  `representative` varchar(255) DEFAULT NULL,
  `representative_phone` varchar(45) DEFAULT NULL,
  `resale_phone` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `resale`, `city_id`, `representative`, `representative_phone`, `resale_phone`, `created`, `modified`) VALUES
(1, 'Revenda Teste 1', 'Revenda', 1, 'Fulano ', '(62) 99995-3117', '(62) 3332-2511', '2020-07-07 15:35:42', '2020-08-23 12:28:42'),
(2, 'Revenda Teste 2 (quimicos)', 'teste', 1, 'Quasi recusandae Ipsum et provident', '(16) 84617-6632', '(14) 92596-1242', '2020-08-23 12:28:17', '2020-08-23 12:28:27');

-- --------------------------------------------------------

--
-- Estrutura da tabela `suppliers_supplier_types`
--

CREATE TABLE `suppliers_supplier_types` (
  `id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `supplier_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `suppliers_supplier_types`
--

INSERT INTO `suppliers_supplier_types` (`id`, `supplier_id`, `supplier_type_id`) VALUES
(1, 1, 1),
(2, 2, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `supplier_types`
--

CREATE TABLE `supplier_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `supplier_types`
--

INSERT INTO `supplier_types` (`id`, `name`) VALUES
(3, 'Adubos'),
(2, 'Químicos'),
(1, 'Sementes');

-- --------------------------------------------------------

--
-- Estrutura da tabela `technologies`
--

CREATE TABLE `technologies` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `technologies`
--

INSERT INTO `technologies` (`id`, `name`, `created`, `modified`) VALUES
(1, 'RR', '2020-07-07 15:47:08', '2020-07-07 15:47:08'),
(2, 'RG', '2020-07-07 15:47:24', '2020-07-07 15:47:24'),
(3, 'INTACTA', '2020-07-07 15:50:44', '2020-07-07 15:50:44'),
(4, 'IPRO', '2020-07-07 15:51:00', '2020-07-07 15:51:00'),
(5, 'INTACTA RR2 PRO', '2020-07-07 15:52:03', '2020-07-07 15:52:03'),
(6, 'Convencional', '2020-07-07 15:53:41', '2020-07-07 15:53:41');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tenants`
--

CREATE TABLE `tenants` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `site` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tenants`
--

INSERT INTO `tenants` (`id`, `name`, `site`) VALUES
(1, 'Safra GP', 'safragp.com.br'),
(2, 'Ge-Agro', 'ge-agro.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_status_id` int(11) NOT NULL DEFAULT 1,
  `tenant_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `role_id`, `user_status_id`, `tenant_id`, `name`, `email`, `password`, `created`, `modified`) VALUES
(1, 1, 1, 1, 'Gustavo César', 'delfino.cesar@gmail.com', '$2y$10$EN/lBdxFb/uq7ztMW12ifuJQvQFotwlQF00CV.l0ubtzOy/RDhOKq', '2020-06-13 14:42:48', '2020-10-12 20:50:49'),
(2, 1, 1, 1, 'Frederico Rodrigues e Silva', 'jfsafra@yahoo.com.br', '$2y$10$8F.Wkd5FVT4yqbSm8CZwy.BKQKr85eB89ggwCpJM5KH/KCU.RuUQi', '2020-06-13 15:53:06', '2020-10-04 14:44:54');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_statuses`
--

CREATE TABLE `user_statuses` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `class` varchar(45) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `user_statuses`
--

INSERT INTO `user_statuses` (`id`, `name`, `class`) VALUES
(1, 'Ativo', 'primary'),
(2, 'Inativo', 'danger');

-- --------------------------------------------------------

--
-- Estrutura da tabela `varieties`
--

CREATE TABLE `varieties` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `varieties`
--

INSERT INTO `varieties` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Bônus', '2020-07-07 15:54:36', '2020-07-07 15:54:36'),
(2, 'Foco', '2020-07-07 15:54:58', '2020-07-07 15:54:58'),
(3, 'Extrema', '2020-07-07 15:55:07', '2020-07-07 15:55:07'),
(4, 'LG 60177', '2020-07-07 15:55:31', '2020-07-07 15:55:31');

-- --------------------------------------------------------

--
-- Estrutura da tabela `zoning_regions`
--

CREATE TABLE `zoning_regions` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `zoning_regions`
--

INSERT INTO `zoning_regions` (`id`, `name`) VALUES
(1, 'Sim'),
(2, 'Não');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `application_seasons`
--
ALTER TABLE `application_seasons`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction` (`transaction`),
  ADD KEY `type` (`type`),
  ADD KEY `primary_key` (`primary_key`),
  ADD KEY `source` (`source`),
  ADD KEY `parent_source` (`parent_source`),
  ADD KEY `created` (`created`);

--
-- Índices para tabela `audit_stash_phinxlog`
--
ALTER TABLE `audit_stash_phinxlog`
  ADD PRIMARY KEY (`version`);

--
-- Índices para tabela `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Índices para tabela `banner_images`
--
ALTER TABLE `banner_images`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hash_UNIQUE` (`hash`);

--
-- Índices para tabela `chemicals`
--
ALTER TABLE `chemicals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `commercial_name_UNIQUE` (`name`);

--
-- Índices para tabela `chemicals_application_seasons`
--
ALTER TABLE `chemicals_application_seasons`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `chemicals_chemical_action_modes`
--
ALTER TABLE `chemicals_chemical_action_modes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `chemicals_chemical_groups`
--
ALTER TABLE `chemicals_chemical_groups`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `chemicals_cultures`
--
ALTER TABLE `chemicals_cultures`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `chemical_action_modes`
--
ALTER TABLE `chemical_action_modes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Índices para tabela `chemical_classes`
--
ALTER TABLE `chemical_classes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Índices para tabela `chemical_groups`
--
ALTER TABLE `chemical_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Índices para tabela `chemical_measure_units`
--
ALTER TABLE `chemical_measure_units`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD UNIQUE KEY `initial_UNIQUE` (`initial`);

--
-- Índices para tabela `chemical_notes`
--
ALTER TABLE `chemical_notes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `chemical_targets`
--
ALTER TABLE `chemical_targets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Índices para tabela `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk-cities-states` (`state_id`,`name`);

--
-- Índices para tabela `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `cultivation_systems`
--
ALTER TABLE `cultivation_systems`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Índices para tabela `cultures`
--
ALTER TABLE `cultures`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Índices para tabela `cycles`
--
ALTER TABLE `cycles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Índices para tabela `fertilities`
--
ALTER TABLE `fertilities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Índices para tabela `fertilities_seeds`
--
ALTER TABLE `fertilities_seeds`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `fertilizers`
--
ALTER TABLE `fertilizers`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `fertilizer_measure_units`
--
ALTER TABLE `fertilizer_measure_units`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD UNIQUE KEY `initial_UNIQUE` (`initial`);

--
-- Índices para tabela `fields`
--
ALTER TABLE `fields`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `field_details`
--
ALTER TABLE `field_details`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `immobiles`
--
ALTER TABLE `immobiles`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `measure_units`
--
ALTER TABLE `measure_units`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD UNIQUE KEY `initial_UNIQUE` (`initial`);

--
-- Índices para tabela `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Índices para tabela `page_statuses`
--
ALTER TABLE `page_statuses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Índices para tabela `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `plan_field_details`
--
ALTER TABLE `plan_field_details`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `plan_statuses`
--
ALTER TABLE `plan_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `producers`
--
ALTER TABLE `producers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD UNIQUE KEY `document_UNIQUE` (`document`);

--
-- Índices para tabela `productive_potencials`
--
ALTER TABLE `productive_potencials`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Índices para tabela `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Índices para tabela `seeds`
--
ALTER TABLE `seeds`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `seed_notes`
--
ALTER TABLE `seed_notes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Índices para tabela `selected_chemicals`
--
ALTER TABLE `selected_chemicals`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `selected_fertilizers`
--
ALTER TABLE `selected_fertilizers`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `selected_seeds`
--
ALTER TABLE `selected_seeds`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `sketches`
--
ALTER TABLE `sketches`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD UNIQUE KEY `initial_UNIQUE` (`initial`);

--
-- Índices para tabela `subpages`
--
ALTER TABLE `subpages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Índices para tabela `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Índices para tabela `suppliers_supplier_types`
--
ALTER TABLE `suppliers_supplier_types`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `supplier_types`
--
ALTER TABLE `supplier_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Índices para tabela `technologies`
--
ALTER TABLE `technologies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Índices para tabela `tenants`
--
ALTER TABLE `tenants`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- Índices para tabela `user_statuses`
--
ALTER TABLE `user_statuses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Índices para tabela `varieties`
--
ALTER TABLE `varieties`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Índices para tabela `zoning_regions`
--
ALTER TABLE `zoning_regions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `application_seasons`
--
ALTER TABLE `application_seasons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=254;

--
-- AUTO_INCREMENT de tabela `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `banner_images`
--
ALTER TABLE `banner_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `chemicals`
--
ALTER TABLE `chemicals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `chemicals_application_seasons`
--
ALTER TABLE `chemicals_application_seasons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `page_statuses`
--
ALTER TABLE `page_statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `subpages`
--
ALTER TABLE `subpages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tenants`
--
ALTER TABLE `tenants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
