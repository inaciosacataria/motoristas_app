-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 03, 2026 at 03:29 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `motoristas`
--

-- --------------------------------------------------------

--
-- Table structure for table `anuncios`
--

CREATE TABLE `anuncios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(32) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `validade` date NOT NULL,
  `descricao` text NOT NULL,
  `estado_anuncio` varchar(255) NOT NULL,
  `forma_de_candidatura` varchar(255) NOT NULL,
  `categoria_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `anuncios`
--

INSERT INTO `anuncios` (`id`, `slug`, `user_id`, `titulo`, `validade`, `descricao`, `estado_anuncio`, `forma_de_candidatura`, `categoria_id`, `created_at`, `updated_at`) VALUES
(1, 'CTotXTxto2ssjVj3', 5, 'Taxi B', '2026-03-03', 'Abcsfeef', 'Publicado', 'online', 1, '2026-03-03 11:09:06', '2026-03-03 11:12:39');

-- --------------------------------------------------------

--
-- Table structure for table `anuncios_provincias`
--

CREATE TABLE `anuncios_provincias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `anuncio_id` bigint(20) UNSIGNED NOT NULL,
  `provincia_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `anuncios_provincias`
--

INSERT INTO `anuncios_provincias` (`id`, `anuncio_id`, `provincia_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2026-03-03 11:09:06', '2026-03-03 11:09:06'),
(2, 1, 1, '2026-03-03 11:09:54', '2026-03-03 11:09:54'),
(3, 1, 1, '2026-03-03 11:12:39', '2026-03-03 11:12:39');

-- --------------------------------------------------------

--
-- Table structure for table `candidatos`
--

CREATE TABLE `candidatos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `datanascimento` date NOT NULL,
  `telefone_alt` varchar(255) DEFAULT NULL,
  `endereco` varchar(255) NOT NULL,
  `provincia_id` bigint(20) UNSIGNED NOT NULL,
  `sexo` varchar(255) NOT NULL,
  `categoria_id` bigint(20) UNSIGNED NOT NULL,
  `numero_carta_conducao` varchar(255) DEFAULT NULL,
  `validade_conducao` varchar(255) DEFAULT NULL,
  `inibicao_anterior` varchar(255) DEFAULT NULL,
  `inibicao_motivo` text DEFAULT NULL,
  `envolvimento_acidente` varchar(255) DEFAULT NULL,
  `acidente_descricao` text DEFAULT NULL,
  `grau_academico` varchar(255) DEFAULT NULL,
  `nacionalidade` varchar(255) DEFAULT NULL,
  `cv` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `candidatos`
--

INSERT INTO `candidatos` (`id`, `user_id`, `datanascimento`, `telefone_alt`, `endereco`, `provincia_id`, `sexo`, `categoria_id`, `numero_carta_conducao`, `validade_conducao`, `inibicao_anterior`, `inibicao_motivo`, `envolvimento_acidente`, `acidente_descricao`, `grau_academico`, `nacionalidade`, `cv`, `created_at`, `updated_at`) VALUES
(1, 6, '1998-08-25', NULL, 'Av. malhangalene', 1, 'Masculino', 1, NULL, 'Sim', 'Não', NULL, NULL, NULL, '11ª à 12ª Classe', 'Mozambique', 'uploads/1772544987-CNH.pdf', '2026-03-03 11:15:16', '2026-03-03 11:36:27');

-- --------------------------------------------------------

--
-- Table structure for table `candidaturas_anuncios`
--

CREATE TABLE `candidaturas_anuncios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `anuncio_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `candidaturas_anuncios`
--

INSERT INTO `candidaturas_anuncios` (`id`, `user_id`, `anuncio_id`, `created_at`, `updated_at`) VALUES
(1, 6, 1, '2026-03-03 11:41:01', '2026-03-03 11:41:01');

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`, `url`, `created_at`, `updated_at`) VALUES
(1, 'A-Motociclo', 'a-motociclo', '2026-03-03 09:14:15', '2026-03-03 09:14:15'),
(2, 'B-Ligeiro', 'b-ligeiro', '2026-03-03 09:14:15', '2026-03-03 09:14:15'),
(3, 'C-Pesado', 'c-pesado', '2026-03-03 09:14:15', '2026-03-03 09:14:15'),
(4, 'D-Transporte de passageiros', 'd-passageiros', '2026-03-03 09:14:15', '2026-03-03 09:14:15'),
(5, 'C+E-Reboque', 'c-e-reboque', '2026-03-03 09:14:15', '2026-03-03 09:14:15');

-- --------------------------------------------------------

--
-- Table structure for table `central_de_riscos`
--

CREATE TABLE `central_de_riscos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empregador_id` bigint(20) UNSIGNED NOT NULL,
  `nome_motorista` varchar(255) NOT NULL,
  `datanascismento_motorista` date DEFAULT NULL,
  `celular_motorista` int(11) DEFAULT NULL,
  `endereco_motorista` varchar(255) DEFAULT NULL,
  `provincia_motorista` varchar(255) DEFAULT NULL,
  `Categoria_motorista` varchar(255) DEFAULT NULL,
  `cartadeconducao_motorista` varchar(255) DEFAULT NULL,
  `nacionalidade_motorista` varchar(255) DEFAULT NULL,
  `funcoes_do_candidato` varchar(255) DEFAULT NULL,
  `infracao` text DEFAULT NULL,
  `merece_portunidade` varchar(255) DEFAULT NULL,
  `versao_motorista` text DEFAULT NULL,
  `estado_denuncia` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `conhecimentos`
--

CREATE TABLE `conhecimentos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `candidato_id` bigint(20) UNSIGNED NOT NULL,
  `conhecimento` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `documentos`
--

CREATE TABLE `documentos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `candidato_id` bigint(20) UNSIGNED NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `ficheiro` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documentos`
--

INSERT INTO `documentos` (`id`, `candidato_id`, `tipo`, `ficheiro`, `created_at`, `updated_at`) VALUES
(1, 1, 'CNH', 'uploads/1772544987-CNH.pdf', '2026-03-03 11:36:27', '2026-03-03 11:36:27');

-- --------------------------------------------------------

--
-- Table structure for table `documents_empregadors`
--

CREATE TABLE `documents_empregadors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empregador_id` bigint(20) UNSIGNED NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `ficheiro` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documents_empregadors`
--

INSERT INTO `documents_empregadors` (`id`, `empregador_id`, `tipo`, `ficheiro`, `created_at`, `updated_at`) VALUES
(1, 4, 'pdf', 'uploads/5-documento_nuit-1772537903.pdf', '2026-03-03 09:38:23', '2026-03-03 09:38:23'),
(2, 4, 'pdf', 'uploads/5-documento_certidao-1772537903.pdf', '2026-03-03 09:38:23', '2026-03-03 09:38:23'),
(3, 4, 'pdf', 'uploads/5-documento_inicio_actividade-1772537903.pdf', '2026-03-03 09:38:23', '2026-03-03 09:38:23');

-- --------------------------------------------------------

--
-- Table structure for table `empregadors`
--

CREATE TABLE `empregadors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `telefone` varchar(255) NOT NULL,
  `telefone_alt` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `endereco` varchar(255) NOT NULL,
  `sector_actividade` varchar(255) NOT NULL,
  `sector_especificado` varchar(255) DEFAULT NULL,
  `provincia_id` bigint(20) UNSIGNED NOT NULL,
  `sobre` text DEFAULT NULL,
  `empresa` text NOT NULL,
  `nuit` varchar(50) DEFAULT NULL,
  `logotipo` varchar(255) DEFAULT NULL,
  `representante` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `documento_nuit` varchar(255) DEFAULT NULL,
  `documento_certidao` varchar(255) DEFAULT NULL,
  `documento_inicio_actividade` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `empregadors`
--

INSERT INTO `empregadors` (`id`, `user_id`, `telefone`, `telefone_alt`, `website`, `endereco`, `sector_actividade`, `sector_especificado`, `provincia_id`, `sobre`, `empresa`, `nuit`, `logotipo`, `representante`, `estado`, `documento_nuit`, `documento_certidao`, `documento_inicio_actividade`, `created_at`, `updated_at`) VALUES
(4, 5, '846411171', NULL, NULL, 'Av. 24 de julho', 'transporte', NULL, 1, NULL, 'decode', NULL, 'uploads/foto-5-1772543498.png', 'inacio sacataria', 'Aprovado', 'uploads/5-documento_nuit-1772537903.pdf', 'uploads/5-documento_certidao-1772537903.pdf', 'uploads/5-documento_inicio_actividade-1772537903.pdf', '2026-03-03 09:37:59', '2026-03-03 11:11:38');

-- --------------------------------------------------------

--
-- Table structure for table `experiencias`
--

CREATE TABLE `experiencias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `candidato_id` bigint(20) UNSIGNED NOT NULL,
  `empresa` varchar(255) NOT NULL,
  `cargo` varchar(255) NOT NULL,
  `actividades_exercidas` text DEFAULT NULL,
  `pais` varchar(255) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `inicio` date DEFAULT NULL,
  `fim` date DEFAULT NULL,
  `trabalha_ate_agora` varchar(255) DEFAULT NULL,
  `tipo_de_contrato` varchar(255) DEFAULT NULL,
  `ultimo_salario` varchar(255) DEFAULT NULL,
  `motivo_de_saida` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `experiencias`
--

INSERT INTO `experiencias` (`id`, `candidato_id`, `empresa`, `cargo`, `actividades_exercidas`, `pais`, `cidade`, `inicio`, `fim`, `trabalha_ate_agora`, `tipo_de_contrato`, `ultimo_salario`, `motivo_de_saida`, `created_at`, `updated_at`) VALUES
(1, 1, 'Tablu Tech', 'Motorista', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-03 11:25:21', '2026-03-03 11:25:21'),
(2, 1, 'Decode', 'Motorista APP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-03 11:30:06', '2026-03-03 11:30:06'),
(3, 1, 'Petromoc', 'Maa', 'basa', NULL, NULL, '2025-11-06', '2026-03-02', NULL, NULL, NULL, NULL, '2026-03-03 11:37:00', '2026-03-03 11:37:00');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `formacoes`
--

CREATE TABLE `formacoes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `candidato_id` bigint(20) UNSIGNED NOT NULL,
  `nivel_de_ensino` varchar(255) NOT NULL,
  `grau_de_ensino` varchar(255) NOT NULL,
  `instituicao` varchar(255) NOT NULL,
  `curso` varchar(255) NOT NULL,
  `situacao` varchar(255) NOT NULL,
  `inicio` date NOT NULL,
  `fim` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `foto_urls`
--

CREATE TABLE `foto_urls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `ficheiro` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `foto_urls`
--

INSERT INTO `foto_urls` (`id`, `user_id`, `tipo`, `ficheiro`, `created_at`, `updated_at`) VALUES
(1, 5, 'png', 'uploads/foto-5-1772543498.png', '2026-03-03 11:11:38', '2026-03-03 11:11:38');

-- --------------------------------------------------------

--
-- Table structure for table `idiomas`
--

CREATE TABLE `idiomas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `candidato_id` bigint(20) UNSIGNED NOT NULL,
  `idioma` varchar(255) NOT NULL,
  `nivel` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `idiomas`
--

INSERT INTO `idiomas` (`id`, `candidato_id`, `idioma`, `nivel`, `created_at`, `updated_at`) VALUES
(1, 1, 'portugues', 'Básico', '2026-03-03 11:34:32', '2026-03-03 11:34:32');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_09_23_091250_provincias', 1),
(6, '2022_09_23_091706_categorias', 1),
(7, '2022_09_23_092018_anuncios', 1),
(8, '2022_09_27_091238_canditado', 1),
(9, '2022_09_27_092303_formacoes', 1),
(10, '2022_09_27_092457_experiencias', 1),
(11, '2022_09_27_092639_conhecimento', 1),
(12, '2022_09_27_092800_idioma', 1),
(13, '2022_09_27_092841_documentos', 1),
(14, '2022_09_30_080833_anuncios_provincias', 1),
(15, '2022_10_05_154531_create_candidaturas_anuncios_table', 1),
(16, '2022_10_06_092737_central_de_risco', 1),
(17, '2022_10_10_092609_empregadores', 1),
(18, '2022_10_13_121001_create_foto_urls_table', 1),
(19, '2022_11_16_083934_documents_empregador', 1),
(20, '2024_09_21_090124_create_smart_ads_table', 1),
(21, '2024_09_21_090125_create_smart_ads_tracking_table', 1),
(22, '2025_10_18_162656_add_indexes_to_tables', 1),
(23, '2026_02_06_113229_add_logotipo_to_empregadors_table', 2),
(24, '2025_10_18_162706_create_notifications_table', 3),
(25, '2026_02_16_000000_add_slug_to_anuncios_table', 3),
(26, '2026_03_03_000001_add_nuit_to_empregadors_table', 3),
(27, '2026_03_03_000002_make_actividades_exercidas_nullable_on_experiencias_table', 4),
(28, '2026_03_03_000003_make_pais_and_cidade_nullable_on_experiencias_table', 5),
(29, '2026_03_03_000004_make_inicio_and_contract_fields_nullable_on_experiencias_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('inaciosacataria@gmail.com', '$2y$10$9Eoufw0GgtZ8/ieVUXWIrOVnDoD8at1eWI4InYMCuNs2Y0EH.2YIO', '2026-03-03 11:45:02');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `provincias`
--

CREATE TABLE `provincias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provincias`
--

INSERT INTO `provincias` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Maputo', '2026-03-03 09:14:15', '2026-03-03 09:14:15'),
(2, 'Gaza', '2026-03-03 09:14:15', '2026-03-03 09:14:15'),
(3, 'Inhambane', '2026-03-03 09:14:15', '2026-03-03 09:14:15'),
(4, 'Sofala', '2026-03-03 09:14:15', '2026-03-03 09:14:15'),
(5, 'Manica', '2026-03-03 09:14:15', '2026-03-03 09:14:15'),
(6, 'Tete', '2026-03-03 09:14:15', '2026-03-03 09:14:15'),
(7, 'Zambézia', '2026-03-03 09:14:15', '2026-03-03 09:14:15'),
(8, 'Nampula', '2026-03-03 09:14:15', '2026-03-03 09:14:15'),
(9, 'Cabo Delgado', '2026-03-03 09:14:15', '2026-03-03 09:14:15'),
(10, 'Niassa', '2026-03-03 09:14:15', '2026-03-03 09:14:15'),
(11, 'Maputo Cidade', '2026-03-03 09:14:15', '2026-03-03 09:14:15');

-- --------------------------------------------------------

--
-- Table structure for table `smart_ads`
--

CREATE TABLE `smart_ads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `body` text DEFAULT NULL,
  `adType` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `imageUrl` varchar(255) DEFAULT NULL,
  `imageAlt` varchar(255) DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `clicks` int(11) NOT NULL DEFAULT 0,
  `enabled` tinyint(1) NOT NULL DEFAULT 1,
  `placements` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`placements`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `smart_ads`
--

INSERT INTO `smart_ads` (`id`, `name`, `slug`, `body`, `adType`, `image`, `imageUrl`, `imageAlt`, `views`, `clicks`, `enabled`, `placements`, `created_at`, `updated_at`) VALUES
(3, 'abc', 'abcd', NULL, 'IMAGE', 'smart-ads/BdEkorOVUyDYwggc4YNFiYUrGFEYIm2qImiK62Tp.png', 'http://google.com', NULL, 0, 0, 1, NULL, '2026-03-03 11:59:55', '2026-03-03 12:00:23');

-- --------------------------------------------------------

--
-- Table structure for table `smart_ads_tracking`
--

CREATE TABLE `smart_ads_tracking` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ad_clicks` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`ad_clicks`)),
  `totalClicks` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `celular` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `active` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_premium` varchar(255) NOT NULL,
  `premium_count` int(11) DEFAULT NULL,
  `premium_date` datetime DEFAULT NULL,
  `privilegio` varchar(255) NOT NULL,
  `foto_url` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `celular`, `email_verified_at`, `active`, `password`, `is_premium`, `premium_count`, `premium_date`, `privilegio`, `foto_url`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrador Sistema', 'admin@motoristas.co.mz', '840000001', NULL, 'Activo', '$2y$10$kI3eP2yKbvAzWE90/pwwJOfSBaRPQObrL/ujypa6HLOVovngY0ErW', 'no', NULL, NULL, 'admin', 'none', NULL, '2026-03-03 09:14:15', '2026-03-03 09:14:15'),
(5, 'decode', 'inaciosacataria@gmail.com', '846411171', NULL, 'activo', '$2y$10$WGlIU8jZXIDMpzYbeazYhecZIH5urxx370ujqgHi2cNIq4FrqvBH2', 'no', 0, NULL, 'empregador', 'uploads/foto-5-1772543498.png', NULL, '2026-03-03 09:37:59', '2026-03-03 11:11:38'),
(6, 'Manuel da Silva', '846311171@motoristas.co.mz', '846311171', NULL, 'Activo', '$2y$10$cliBPI7lHX7kFgDhrpeZVOaVa5egYpeYKnrl2Z/oG/qOar8Em8tPy', 'no', NULL, NULL, 'candidato', NULL, NULL, '2026-03-03 11:15:16', '2026-03-03 11:15:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anuncios`
--
ALTER TABLE `anuncios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `anuncios_slug_unique` (`slug`),
  ADD KEY `anuncios_user_id_index` (`user_id`),
  ADD KEY `anuncios_categoria_id_index` (`categoria_id`),
  ADD KEY `anuncios_estado_anuncio_index` (`estado_anuncio`),
  ADD KEY `anuncios_validade_index` (`validade`),
  ADD KEY `anuncios_estado_anuncio_validade_index` (`estado_anuncio`,`validade`),
  ADD KEY `anuncios_created_at_index` (`created_at`);

--
-- Indexes for table `anuncios_provincias`
--
ALTER TABLE `anuncios_provincias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `anuncios_provincias_anuncio_id_index` (`anuncio_id`),
  ADD KEY `anuncios_provincias_provincia_id_index` (`provincia_id`),
  ADD KEY `anuncios_provincias_anuncio_id_provincia_id_index` (`anuncio_id`,`provincia_id`);

--
-- Indexes for table `candidatos`
--
ALTER TABLE `candidatos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `candidatos_user_id_index` (`user_id`),
  ADD KEY `candidatos_provincia_id_index` (`provincia_id`),
  ADD KEY `candidatos_categoria_id_index` (`categoria_id`),
  ADD KEY `candidatos_provincia_id_categoria_id_index` (`provincia_id`,`categoria_id`);

--
-- Indexes for table `candidaturas_anuncios`
--
ALTER TABLE `candidaturas_anuncios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `candidaturas_anuncios_user_id_anuncio_id_unique` (`user_id`,`anuncio_id`),
  ADD KEY `candidaturas_anuncios_user_id_index` (`user_id`),
  ADD KEY `candidaturas_anuncios_anuncio_id_index` (`anuncio_id`),
  ADD KEY `candidaturas_anuncios_created_at_index` (`created_at`);

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `central_de_riscos`
--
ALTER TABLE `central_de_riscos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `central_de_riscos_empregador_id_foreign` (`empregador_id`);

--
-- Indexes for table `conhecimentos`
--
ALTER TABLE `conhecimentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conhecimentos_candidato_id_foreign` (`candidato_id`);

--
-- Indexes for table `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `documentos_candidato_id_index` (`candidato_id`);

--
-- Indexes for table `documents_empregadors`
--
ALTER TABLE `documents_empregadors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `documents_empregadors_empregador_id_foreign` (`empregador_id`);

--
-- Indexes for table `empregadors`
--
ALTER TABLE `empregadors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `empregadors_user_id_index` (`user_id`),
  ADD KEY `empregadors_provincia_id_index` (`provincia_id`);

--
-- Indexes for table `experiencias`
--
ALTER TABLE `experiencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `experiencias_candidato_id_index` (`candidato_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `formacoes`
--
ALTER TABLE `formacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `formacoes_candidato_id_foreign` (`candidato_id`);

--
-- Indexes for table `foto_urls`
--
ALTER TABLE `foto_urls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foto_urls_user_id_foreign` (`user_id`);

--
-- Indexes for table `idiomas`
--
ALTER TABLE `idiomas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idiomas_candidato_id_index` (`candidato_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smart_ads`
--
ALTER TABLE `smart_ads`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `smart_ads_name_unique` (`name`);

--
-- Indexes for table `smart_ads_tracking`
--
ALTER TABLE `smart_ads_tracking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_celular_unique` (`celular`),
  ADD KEY `users_celular_index` (`celular`),
  ADD KEY `users_privilegio_index` (`privilegio`),
  ADD KEY `users_active_index` (`active`),
  ADD KEY `users_is_premium_index` (`is_premium`),
  ADD KEY `users_privilegio_active_index` (`privilegio`,`active`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anuncios`
--
ALTER TABLE `anuncios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `anuncios_provincias`
--
ALTER TABLE `anuncios_provincias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `candidatos`
--
ALTER TABLE `candidatos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `candidaturas_anuncios`
--
ALTER TABLE `candidaturas_anuncios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `central_de_riscos`
--
ALTER TABLE `central_de_riscos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `conhecimentos`
--
ALTER TABLE `conhecimentos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `documents_empregadors`
--
ALTER TABLE `documents_empregadors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `empregadors`
--
ALTER TABLE `empregadors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `experiencias`
--
ALTER TABLE `experiencias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `formacoes`
--
ALTER TABLE `formacoes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `foto_urls`
--
ALTER TABLE `foto_urls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `idiomas`
--
ALTER TABLE `idiomas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `provincias`
--
ALTER TABLE `provincias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `smart_ads`
--
ALTER TABLE `smart_ads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `smart_ads_tracking`
--
ALTER TABLE `smart_ads_tracking`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anuncios`
--
ALTER TABLE `anuncios`
  ADD CONSTRAINT `anuncios_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `anuncios_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `anuncios_provincias`
--
ALTER TABLE `anuncios_provincias`
  ADD CONSTRAINT `anuncios_provincias_anuncio_id_foreign` FOREIGN KEY (`anuncio_id`) REFERENCES `anuncios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `anuncios_provincias_provincia_id_foreign` FOREIGN KEY (`provincia_id`) REFERENCES `provincias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `candidatos`
--
ALTER TABLE `candidatos`
  ADD CONSTRAINT `candidatos_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `candidatos_provincia_id_foreign` FOREIGN KEY (`provincia_id`) REFERENCES `provincias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `candidatos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `candidaturas_anuncios`
--
ALTER TABLE `candidaturas_anuncios`
  ADD CONSTRAINT `candidaturas_anuncios_anuncio_id_foreign` FOREIGN KEY (`anuncio_id`) REFERENCES `anuncios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `candidaturas_anuncios_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `central_de_riscos`
--
ALTER TABLE `central_de_riscos`
  ADD CONSTRAINT `central_de_riscos_empregador_id_foreign` FOREIGN KEY (`empregador_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `conhecimentos`
--
ALTER TABLE `conhecimentos`
  ADD CONSTRAINT `conhecimentos_candidato_id_foreign` FOREIGN KEY (`candidato_id`) REFERENCES `candidatos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `documentos`
--
ALTER TABLE `documentos`
  ADD CONSTRAINT `documentos_candidato_id_foreign` FOREIGN KEY (`candidato_id`) REFERENCES `candidatos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `documents_empregadors`
--
ALTER TABLE `documents_empregadors`
  ADD CONSTRAINT `documents_empregadors_empregador_id_foreign` FOREIGN KEY (`empregador_id`) REFERENCES `empregadors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `empregadors`
--
ALTER TABLE `empregadors`
  ADD CONSTRAINT `empregadors_provincia_id_foreign` FOREIGN KEY (`provincia_id`) REFERENCES `provincias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `empregadors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `experiencias`
--
ALTER TABLE `experiencias`
  ADD CONSTRAINT `experiencias_candidato_id_foreign` FOREIGN KEY (`candidato_id`) REFERENCES `candidatos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `formacoes`
--
ALTER TABLE `formacoes`
  ADD CONSTRAINT `formacoes_candidato_id_foreign` FOREIGN KEY (`candidato_id`) REFERENCES `candidatos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `foto_urls`
--
ALTER TABLE `foto_urls`
  ADD CONSTRAINT `foto_urls_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `idiomas`
--
ALTER TABLE `idiomas`
  ADD CONSTRAINT `idiomas_candidato_id_foreign` FOREIGN KEY (`candidato_id`) REFERENCES `candidatos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
