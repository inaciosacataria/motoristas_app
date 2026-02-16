-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 16, 2026 at 05:42 PM
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

INSERT INTO `anuncios` (`id`, `user_id`, `titulo`, `validade`, `descricao`, `estado_anuncio`, `forma_de_candidatura`, `categoria_id`, `created_at`, `updated_at`) VALUES
(23, 25, 'dscds', '2024-10-24', 'c c', 'Publicado', 'Portal', 1, '2024-10-02 16:28:50', '2024-10-02 16:28:50'),
(24, 26, 'Motorista de Táxi Executivo - Salário Competitivo', '2025-11-17', 'Procuramos motorista profissional para serviço de táxi executivo. Requisitos: Carta de condução Categoria B válida, experiência mínima de 2 anos, conhecimento da cidade de Maputo, boa apresentação, pontualidade e responsabilidade. Oferecemos: Salário fixo + comissões, seguro de trabalho, uniformes, apoio com combustível. Horário flexível disponível.', 'Publicado', 'online', 2, '2025-10-15 14:45:38', '2025-10-18 14:45:38'),
(25, 26, 'Motorista de Camião Pesado (Cat. C+E) - Transporte Nacional', '2025-12-02', 'Empresa de logística procura motorista experiente para transporte de mercadorias em rotas nacionais. Requisitos: Carta Categoria C+E, mínimo 3 anos de experiência, disponibilidade para viagens longas, conhecimento de manutenção básica de veículos. Oferecemos: Salário atrativo, subsídios de alimentação e dormida, seguro completo, manutenção do veículo garantida. Contrato de longo prazo.', 'Publicado', 'online', 1, '2025-10-09 14:45:38', '2025-10-18 14:45:38'),
(26, 26, 'Motorista Particular para Família - Tempo Integral', '2025-11-07', 'Família residente em Maputo procura motorista confiável para transporte diário. Responsabilidades: Transporte de crianças para escola, fazer compras, manutenção do veículo. Requisitos: Carta Categoria B, experiência comprovada, referências obrigatórias, residente em Maputo ou arredores. Oferecemos: Salário mensal fixo, refeições, folgas semanais, ambiente familiar agradável.', 'Publicado', 'online', 2, '2025-10-14 14:45:38', '2025-10-18 14:45:38'),
(27, 26, 'Motorista de Ambulância - Urgente (Cat. B)', '2025-11-02', 'Hospital privado contrata motorista de ambulância para serviços de emergência. Requisitos: Carta Categoria B válida, curso de primeiros socorros (preferencial), disponibilidade para turnos rotativos incluindo fins de semana, calma sob pressão, boa comunicação. Oferecemos: Salário competitivo, formação contínua, seguro de saúde, subsídio de risco, possibilidade de crescimento na instituição.', 'Publicado', 'online', 2, '2025-10-11 14:45:38', '2025-10-18 14:45:38'),
(28, 26, 'Motorista de Autocarro Urbano (Cat. D) - Maputo', '2025-11-12', 'Empresa de transportes públicos recruta motoristas de autocarro. Requisitos: Carta Categoria D válida, experiência mínima de 1 ano em transporte de passageiros, conhecimento das rotas urbanas de Maputo, bom relacionamento interpessoal. Oferecemos: Salário base + bónus de desempenho, seguro completo, formação inicial paga, uniformes, possibilidade de horas extras remuneradas.', 'Publicado', 'online', 3, '2025-10-17 14:45:38', '2025-10-18 14:45:38'),
(29, 26, 'Motorista de Entregas Delivery - Motas e Carros Ligeiros', '2025-12-17', 'Plataforma de delivery em expansão contrata motoristas. Requisitos: Carta Categoria A ou B, smartphone com internet, veículo próprio ou fornecido pela empresa, disponibilidade imediata. Oferecemos: Horários flexíveis, pagamento por entrega + bónus, aplicativo fácil de usar, suporte técnico 24h, seguro de acidentes pessoais. Ideal para quem busca renda extra ou tempo integral.', 'Publicado', 'online', 1, '2025-10-10 14:45:38', '2025-10-18 14:45:38'),
(30, 26, 'Motorista de Transporte Escolar - Manhãs e Tardes', '2025-10-28', 'Escola internacional procura motorista responsável para transporte de alunos. Requisitos: Carta Categoria D ou superior, experiência com crianças, registo criminal limpo (obrigatório), paciência e responsabilidade. Oferecemos: Horário part-time (manhã e tarde), salário fixo mensal, folgas durante férias escolares, ambiente de trabalho estável e respeitoso. Início imediato.', 'Publicado', 'online', 3, '2025-10-14 14:45:38', '2025-10-18 14:45:38'),
(31, 26, 'Motorista de Grua/Reboque - Experiência Necessária', '2025-11-22', 'Oficina mecânica procura motorista de grua para reboque de veículos. Requisitos: Carta Categoria C, experiência com operação de grua, conhecimento mecânico básico, disponibilidade 24h (sistema de turnos). Oferecemos: Salário atrativo, subsídio de disponibilidade, formação especializada, equipamentos de segurança, ambiente de equipa dinâmica.', 'Publicado', 'online', 1, '2025-10-15 14:45:38', '2025-10-18 14:45:38'),
(32, 26, 'Motorista de Viaturas de Turismo (Cat. B) - Hotel 5 Estrelas', '2025-11-27', 'Resort de luxo contrata motorista para transporte de hóspedes. Requisitos: Carta Categoria B, fluência em Inglês (obrigatório), Português (nativo), experiência em hotelaria (preferencial), excelente apresentação pessoal, cordialidade e profissionalismo. Oferecemos: Salário competitivo, gorjetas, uniforme fornecido, refeições durante turno, possibilidade de crescimento profissional.', 'Publicado', 'online', 2, '2025-10-16 14:45:38', '2025-10-18 14:45:38'),
(33, 26, 'Motorista de Transporte de Valores - Segurança Máxima', '2025-12-07', 'Empresa de segurança contrata motorista para transporte de valores. Requisitos: Carta Categoria B, curso de segurança (fornecido), registo criminal limpo (verificação obrigatória), discrição absoluta, disponibilidade para treino intensivo. Oferecemos: Salário elevado, subsídio de risco significativo, seguro de vida, formação especializada paga, equipamento de proteção completo, contrato de trabalho estável.', 'Publicado', 'online', 2, '2025-10-17 14:45:38', '2025-10-18 14:45:38'),
(34, 28, 'Taxi', '2015-10-25', 'Abdbasdbaj', 'Publicado', 'online', 2, '2025-10-22 15:59:50', '2025-10-22 15:59:50'),
(35, 26, 'abc', '2026-02-20', 'sdsdsdasdasdsa', 'Publicado', 'presencial', 1, '2026-02-06 09:37:50', '2026-02-06 09:37:50');

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
(31, 23, 1, '2024-10-02 16:28:50', '2024-10-02 16:28:50'),
(32, 24, 1, '2025-10-18 14:45:38', '2025-10-18 14:45:38'),
(33, 25, 1, '2025-10-18 14:45:38', '2025-10-18 14:45:38'),
(34, 25, 4, '2025-10-18 14:45:38', '2025-10-18 14:45:38'),
(35, 26, 1, '2025-10-18 14:45:38', '2025-10-18 14:45:38'),
(36, 27, 4, '2025-10-18 14:45:38', '2025-10-18 14:45:38'),
(37, 28, 1, '2025-10-18 14:45:38', '2025-10-18 14:45:38'),
(38, 29, 1, '2025-10-18 14:45:38', '2025-10-18 14:45:38'),
(39, 29, 4, '2025-10-18 14:45:38', '2025-10-18 14:45:38'),
(40, 29, 8, '2025-10-18 14:45:38', '2025-10-18 14:45:38'),
(41, 30, 1, '2025-10-18 14:45:38', '2025-10-18 14:45:38'),
(42, 31, 1, '2025-10-18 14:45:38', '2025-10-18 14:45:38'),
(43, 31, 4, '2025-10-18 14:45:38', '2025-10-18 14:45:38'),
(44, 32, 1, '2025-10-18 14:45:38', '2025-10-18 14:45:38'),
(45, 33, 1, '2025-10-18 14:45:38', '2025-10-18 14:45:38'),
(46, 33, 4, '2025-10-18 14:45:38', '2025-10-18 14:45:38'),
(47, 34, 1, '2025-10-22 15:59:50', '2025-10-22 15:59:50'),
(48, 35, 1, '2026-02-06 09:37:50', '2026-02-06 09:37:50'),
(49, 35, 3, '2026-02-06 09:37:50', '2026-02-06 09:37:50');

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
(2, 27, '1990-05-15', '841234568', 'Bairro Central, Maputo', 1, 'Masculino', 1, '12345678', 'Sim', 'Não', NULL, NULL, NULL, '11ª à 12ª Classe', 'Moçambicana', 'none', '2025-10-18 15:11:22', '2025-10-18 15:11:22');

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
(10, 27, 28, '2025-10-22 15:56:27', '2025-10-22 15:56:27');

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
(1, 'A-Motociclo', '', NULL, NULL),
(2, 'B-Ligeiro', '', NULL, NULL),
(3, 'C-Pesado', '', NULL, NULL),
(4, 'G-Profissional', '', NULL, NULL),
(5, 'P-Servicos Publicos', '', NULL, NULL),
(6, 'D-Carga Perigosa', '', NULL, NULL);

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
(101, 18, 'pdf', 'uploads/18-documento_nuit.pdf', '2024-10-02 16:25:39', '2024-10-02 16:25:39'),
(102, 18, 'pdf', 'uploads/18-documento_certidao.pdf', '2024-10-02 16:25:39', '2024-10-02 16:25:39'),
(103, 18, 'pdf', 'uploads/18-documento_inicio_actividade.pdf', '2024-10-02 16:25:39', '2024-10-02 16:25:39');

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

INSERT INTO `empregadors` (`id`, `user_id`, `telefone`, `telefone_alt`, `website`, `endereco`, `sector_actividade`, `sector_especificado`, `provincia_id`, `sobre`, `empresa`, `logotipo`, `representante`, `estado`, `documento_nuit`, `documento_certidao`, `documento_inicio_actividade`, `created_at`, `updated_at`) VALUES
(18, 25, '5453445345', NULL, 'vbdfbdf', 'efber', 'comercio', NULL, 2, 'rgvr', 'dscsd', NULL, 'dvds', 'Aberto', 'uploads/18-documento_nuit.pdf', 'uploads/18-documento_certidao.pdf', 'uploads/18-documento_inicio_actividade.pdf', '2024-10-02 16:25:04', '2024-10-02 16:25:39'),
(19, 28, '842345678', '842345679', 'https://transportes.co.mz', 'Av. Julius Nyerere, 1234', 'transporte', NULL, 1, 'Empresa líder em transportes e logística em Moçambique, com mais de 10 anos de experiência no mercado.', 'Transportes Moçambique Lda', NULL, 'Maria Santos', NULL, NULL, NULL, NULL, '2025-10-18 15:11:32', '2025-10-18 15:11:32');

-- --------------------------------------------------------

--
-- Table structure for table `experiencias`
--

CREATE TABLE `experiencias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `candidato_id` bigint(20) UNSIGNED NOT NULL,
  `empresa` varchar(255) NOT NULL,
  `cargo` varchar(255) NOT NULL,
  `actividades_exercidas` text NOT NULL,
  `pais` varchar(255) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `inicio` date NOT NULL,
  `fim` date DEFAULT NULL,
  `trabalha_ate_agora` varchar(255) NOT NULL,
  `tipo_de_contrato` varchar(255) NOT NULL,
  `ultimo_salario` varchar(255) DEFAULT NULL,
  `motivo_de_saida` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(2, 26, 'png', 'uploads/foto-26-1770378576.png', '2026-02-06 09:49:36', '2026-02-06 09:49:36'),
(3, 26, 'png', 'uploads/foto-26-1770378652.png', '2026-02-06 09:50:52', '2026-02-06 09:50:52');

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
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_09_23_091250_provincias', 1),
(6, '2022_09_23_091706_categorias', 1),
(10, '2022_09_27_092303_formacoes', 1),
(11, '2022_09_27_092457_experiencias', 1),
(12, '2022_09_27_092639_conhecimento', 1),
(13, '2022_09_27_092800_idioma', 1),
(14, '2022_09_27_092841_documentos', 1),
(16, '2022_09_23_092018_anuncios', 2),
(17, '2022_09_30_080833_anuncios_provincias', 3),
(24, '2022_10_05_154531_create_candidaturas_anuncios_table', 6),
(46, '2022_10_06_092737_central_de_risco', 9),
(48, '2022_10_13_121001_create_foto_urls_table', 10),
(55, '2022_11_16_083934_documents_empregador', 15),
(57, '2022_09_27_091238_canditado', 16),
(58, '2022_10_10_092609_empregadores', 16),
(59, '2014_10_12_000000_create_users_table', 17),
(60, '2024_09_21_111026_create_smart_ads_table', 18),
(61, '2024_09_21_111027_create_smart_ads_tracking_table', 19),
(62, '2026_02_06_113229_add_logotipo_to_empregadors_table', 20),
(63, '2025_10_18_162656_add_indexes_to_tables', 21),
(64, '2014_10_12_100000_create_password_resets_table', 22),
(65, '2014_10_12_100000_create_password_resets_table', 23),
(66, '2024_09_21_090124_create_smart_ads_table', 24),
(67, '2024_09_21_090125_create_smart_ads_tracking_table', 25),
(68, '2025_10_18_162706_create_notifications_table', 26);

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
(1, 'Maputo', NULL, NULL),
(2, 'Gaza', NULL, NULL),
(3, 'Inhambane', NULL, NULL),
(4, 'Sofala', NULL, NULL),
(5, 'Manica', NULL, NULL),
(6, 'Tete', NULL, NULL),
(7, 'Zambezia', NULL, NULL),
(8, 'Nampula', NULL, NULL),
(9, 'Niassa', NULL, NULL),
(10, 'Cabo Delgado', NULL, NULL),
(11, 'Maputo cidade', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `smart_ads`
--

CREATE TABLE `smart_ads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `side` text DEFAULT NULL,
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

INSERT INTO `smart_ads` (`id`, `name`, `slug`, `side`, `body`, `adType`, `image`, `imageUrl`, `imageAlt`, `views`, `clicks`, `enabled`, `placements`, `created_at`, `updated_at`) VALUES
(6, 'abc', 'abc', 'left', NULL, 'IMAGE', 'image/xqhAMaxwOLyLjKUEOKx48OHzBmduZyMjKz2VXW4f.jpg', 'https://google.com', 'dcdcvd', 0, 0, 1, '[{\"position\":\"\",\"selector\":\"\",\"style\":\"\"}]', '2024-10-02 15:53:34', '2024-10-03 09:40:35'),
(7, 'schhol', 'schhol', 'bottom', NULL, 'IMAGE', 'image/iZTSD1lviWWzLGXILLnJvdmMp3lmQyUqPBImcWLD.jpg', 'https://google.com', 'dfvd', 0, 0, 1, '[{\"position\":\"\",\"selector\":\"\",\"style\":\"\"}]', '2024-10-02 16:36:16', '2024-10-03 09:30:47'),
(8, 'deus', 'deus', 'top', NULL, 'IMAGE', 'image/N5l8IluplLbAlWgGGBm4HFpNhzKWbSXSah4pC3sR.png', 'https://yango.com/pt_mz/', 'vsdcv', 0, 0, 1, '[{\"position\":\"\",\"selector\":\"\",\"style\":\"\"}]', '2024-10-03 03:11:02', '2024-10-03 09:43:06'),
(9, 'left', 'left', 'right', NULL, 'IMAGE', 'image/LuAFLW5nRgLHif9Ob30IFodq8jsprl99hqIWy4JP.jpg', NULL, NULL, 0, 0, 1, '[{\"position\":\"\",\"selector\":\"\",\"style\":\"\"}]', '2024-10-03 08:52:16', '2024-10-03 08:56:52');

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
(25, 'dscsd', 'isacataria@roscas.co.mz', '5453445345', NULL, 'desativado', '$2y$10$pY.ce.DzhkJp9Dl9hnEyeO4qFbktV5Vm285dOO9R76K9MOfW4P.N6', 'no', 0, NULL, 'admin', 'none', NULL, '2024-10-02 16:25:04', '2025-10-22 15:42:04'),
(26, 'Empresa de Transportes Teste', 'empresa@teste.com', '840000000', NULL, 'Activo', '$2y$10$6/3JXfGPtfsluAnnr1mHjeuYn3n/RFXqSJT/DfMwKLIk6YRD2/9au', 'no', NULL, NULL, 'empregador', 'uploads/foto-26-1770378652.png', NULL, '2025-10-18 14:45:11', '2026-02-06 09:50:52'),
(27, 'João Silva', 'joao@motoristas.co.mz', '841234567', NULL, 'Activo', '$2y$10$UEpBncqQPyDZUwPOj3gCxOIRv/wSYpliw2xKxEYKfcO2I4r2wUsRu', 'no', NULL, NULL, 'candidato', 'none', NULL, '2025-10-18 15:11:22', '2025-10-18 15:11:22'),
(28, 'Transportes Moçambique Lda', 'empresa@transportes.co.mz', '842345678', NULL, 'Activo', '$2y$10$9JSQGN39DcU/Xn62eKRGW.D1xurF6Oo2mv6LXEpzd/KLT66nElvZK', 'yes', NULL, NULL, 'empregador', 'none', 'ETfuLl1iPockReyDQsf1KMqLFjv6Dljpi7jQX6ZSRvSvkL8jYPMgFidDaJHA', '2025-10-18 15:11:32', '2025-10-18 15:11:32'),
(29, 'Administrador Sistema', 'admin@motoristas.co.mz', '843456789', NULL, 'Activo', '$2y$10$auhD6r3soE1fwktD7oEYPeUNUZUpt/kZ5bG8lsbVjYZuC3IdT7xeW', 'yes', NULL, NULL, 'admin', 'none', 'OWOE4vfT1L4bRlRW14b9oyXyRUiBU8iZCUd8mpURJoN2wNJh1iSoBFAW9HGd', '2025-10-18 15:11:37', '2025-10-18 15:11:37'),
(30, 'João Motorista Teste', '840000002@motoristas.co.mz', '840000002', NULL, 'Activo', '$2y$10$Flkh6ZQ4OcT818wxo.NCmOYCij5AZC8jXCXoYj8p5W/0.PhSk1SSe', 'no', NULL, NULL, 'candidato', NULL, NULL, '2025-11-30 06:21:08', '2025-11-30 06:21:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anuncios`
--
ALTER TABLE `anuncios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `anuncios_categoria_id_foreign` (`categoria_id`),
  ADD KEY `anuncios_user_id_foreign` (`user_id`),
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
  ADD KEY `anuncios_provincias_anuncio_id_foreign` (`anuncio_id`),
  ADD KEY `anuncios_provincias_provincia_id_foreign` (`provincia_id`),
  ADD KEY `anuncios_provincias_anuncio_id_index` (`anuncio_id`),
  ADD KEY `anuncios_provincias_provincia_id_index` (`provincia_id`),
  ADD KEY `anuncios_provincias_anuncio_id_provincia_id_index` (`anuncio_id`,`provincia_id`);

--
-- Indexes for table `candidatos`
--
ALTER TABLE `candidatos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `candidatos_user_id_foreign` (`user_id`),
  ADD KEY `candidatos_provincia_id_foreign` (`provincia_id`),
  ADD KEY `candidatos_categoria_id_foreign` (`categoria_id`),
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
  ADD KEY `candidaturas_anuncios_user_id_foreign` (`user_id`),
  ADD KEY `candidaturas_anuncios_anuncio_id_foreign` (`anuncio_id`),
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
  ADD KEY `documentos_candidato_id_foreign` (`candidato_id`),
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
  ADD KEY `empregadors_provincia_id_foreign` (`provincia_id`),
  ADD KEY `empregadors_user_id_foreign` (`user_id`),
  ADD KEY `empregadors_user_id_index` (`user_id`),
  ADD KEY `empregadors_provincia_id_index` (`provincia_id`);

--
-- Indexes for table `experiencias`
--
ALTER TABLE `experiencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `experiencias_candidato_id_foreign` (`candidato_id`),
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
  ADD KEY `idiomas_candidato_id_foreign` (`candidato_id`),
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `anuncios_provincias`
--
ALTER TABLE `anuncios_provincias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `candidatos`
--
ALTER TABLE `candidatos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `candidaturas_anuncios`
--
ALTER TABLE `candidaturas_anuncios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `central_de_riscos`
--
ALTER TABLE `central_de_riscos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `conhecimentos`
--
ALTER TABLE `conhecimentos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `documents_empregadors`
--
ALTER TABLE `documents_empregadors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `empregadors`
--
ALTER TABLE `empregadors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `experiencias`
--
ALTER TABLE `experiencias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `idiomas`
--
ALTER TABLE `idiomas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `smart_ads_tracking`
--
ALTER TABLE `smart_ads_tracking`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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
