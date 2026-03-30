-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 13-Maio-2025 às 15:53
-- Versão do servidor: 9.1.0
-- versão do PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `unifiedtransform`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `academic_settings`
--

DROP TABLE IF EXISTS `academic_settings`;
CREATE TABLE IF NOT EXISTS `academic_settings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `attendance_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'section',
  `marks_submission_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'off',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `assigned_teachers`
--

DROP TABLE IF EXISTS `assigned_teachers`;
CREATE TABLE IF NOT EXISTS `assigned_teachers` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `teacher_id` int UNSIGNED NOT NULL,
  `semester_id` int UNSIGNED NOT NULL,
  `class_id` int UNSIGNED NOT NULL,
  `section_id` int UNSIGNED NOT NULL,
  `course_id` int UNSIGNED NOT NULL,
  `session_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `assignments`
--

DROP TABLE IF EXISTS `assignments`;
CREATE TABLE IF NOT EXISTS `assignments` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `teacher_id` int UNSIGNED NOT NULL,
  `semester_id` int UNSIGNED NOT NULL,
  `class_id` int UNSIGNED NOT NULL,
  `section_id` int UNSIGNED NOT NULL,
  `course_id` int UNSIGNED NOT NULL,
  `session_id` int UNSIGNED NOT NULL,
  `assignment_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `assignment_file_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `attendances`
--

DROP TABLE IF EXISTS `attendances`;
CREATE TABLE IF NOT EXISTS `attendances` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `course_id` int UNSIGNED NOT NULL DEFAULT '0',
  `class_id` int UNSIGNED NOT NULL DEFAULT '0',
  `section_id` int UNSIGNED NOT NULL DEFAULT '0',
  `student_id` int UNSIGNED NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `course_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_id` int UNSIGNED NOT NULL,
  `semester_id` int UNSIGNED NOT NULL,
  `session_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `session_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `exams`
--

DROP TABLE IF EXISTS `exams`;
CREATE TABLE IF NOT EXISTS `exams` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `exam_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `class_id` int UNSIGNED NOT NULL,
  `course_id` int UNSIGNED NOT NULL,
  `semester_id` int UNSIGNED NOT NULL,
  `session_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `exam_rules`
--

DROP TABLE IF EXISTS `exam_rules`;
CREATE TABLE IF NOT EXISTS `exam_rules` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `total_marks` double(8,2) NOT NULL,
  `pass_marks` double(8,2) NOT NULL,
  `marks_distribution_note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `exam_id` int UNSIGNED NOT NULL,
  `session_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `final_marks`
--

DROP TABLE IF EXISTS `final_marks`;
CREATE TABLE IF NOT EXISTS `final_marks` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `calculated_marks` double(8,2) NOT NULL DEFAULT '0.00',
  `final_marks` double(8,2) NOT NULL DEFAULT '0.00',
  `note` text COLLATE utf8mb4_unicode_ci,
  `student_id` int UNSIGNED NOT NULL,
  `class_id` int UNSIGNED NOT NULL,
  `section_id` int UNSIGNED NOT NULL,
  `course_id` int UNSIGNED NOT NULL,
  `semester_id` int UNSIGNED NOT NULL,
  `session_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `grade_rules`
--

DROP TABLE IF EXISTS `grade_rules`;
CREATE TABLE IF NOT EXISTS `grade_rules` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `point` double(8,2) NOT NULL,
  `grade` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_at` double(8,2) NOT NULL,
  `end_at` double(8,2) NOT NULL,
  `grading_system_id` int UNSIGNED NOT NULL,
  `session_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `grading_systems`
--

DROP TABLE IF EXISTS `grading_systems`;
CREATE TABLE IF NOT EXISTS `grading_systems` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `system_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_id` int UNSIGNED NOT NULL,
  `semester_id` int UNSIGNED NOT NULL,
  `session_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `marks`
--

DROP TABLE IF EXISTS `marks`;
CREATE TABLE IF NOT EXISTS `marks` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `marks` double(8,2) NOT NULL DEFAULT '0.00',
  `student_id` int UNSIGNED NOT NULL,
  `class_id` int UNSIGNED NOT NULL,
  `section_id` int UNSIGNED NOT NULL,
  `course_id` int UNSIGNED NOT NULL,
  `exam_id` int UNSIGNED NOT NULL,
  `session_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_08_14_063609_create_permission_tables', 1),
(5, '2021_08_29_082638_create_school_sessions_table', 1),
(6, '2021_08_29_082900_create_semesters_table', 1),
(7, '2021_08_29_082956_create_school_classes_table', 1),
(8, '2021_08_29_083021_create_sections_table', 1),
(9, '2021_08_29_083216_create_courses_table', 1),
(10, '2021_08_29_083346_create_academic_settings_table', 1),
(11, '2021_08_29_083429_create_promotions_table', 1),
(12, '2021_08_29_083504_create_exam_rules_table', 1),
(13, '2021_08_29_083523_create_grade_rules_table', 1),
(14, '2021_08_29_083603_create_marks_table', 1),
(15, '2021_08_29_083628_create_exams_table', 1),
(16, '2021_08_29_083730_create_student_parent_infos_table', 1),
(17, '2021_08_29_083742_create_student_academic_infos_table', 1),
(18, '2021_08_29_083934_create_attendances_table', 1),
(19, '2021_08_29_084019_create_notices_table', 1),
(20, '2021_08_29_084030_create_events_table', 1),
(21, '2021_08_29_084041_create_syllabi_table', 1),
(22, '2021_08_29_084056_create_routines_table', 1),
(23, '2021_10_07_134023_create_assigned_teachers_table', 1),
(24, '2021_10_09_061039_create_grading_systems_table', 1),
(25, '2021_10_16_123559_create_final_marks_table', 1),
(26, '2021_11_26_040801_create_assignments_table', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `notices`
--

DROP TABLE IF EXISTS `notices`;
CREATE TABLE IF NOT EXISTS `notices` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `notice` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `promotions`
--

DROP TABLE IF EXISTS `promotions`;
CREATE TABLE IF NOT EXISTS `promotions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `student_id` int UNSIGNED NOT NULL,
  `class_id` int UNSIGNED NOT NULL,
  `section_id` int UNSIGNED NOT NULL,
  `session_id` int UNSIGNED NOT NULL,
  `id_card_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `routines`
--

DROP TABLE IF EXISTS `routines`;
CREATE TABLE IF NOT EXISTS `routines` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `start` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weekday` int NOT NULL,
  `class_id` int UNSIGNED NOT NULL,
  `section_id` int UNSIGNED NOT NULL,
  `course_id` int UNSIGNED NOT NULL,
  `session_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `school_classes`
--

DROP TABLE IF EXISTS `school_classes`;
CREATE TABLE IF NOT EXISTS `school_classes` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `class_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `school_sessions`
--

DROP TABLE IF EXISTS `school_sessions`;
CREATE TABLE IF NOT EXISTS `school_sessions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `session_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `sections`
--

DROP TABLE IF EXISTS `sections`;
CREATE TABLE IF NOT EXISTS `sections` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `section_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_id` int UNSIGNED NOT NULL,
  `session_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `semesters`
--

DROP TABLE IF EXISTS `semesters`;
CREATE TABLE IF NOT EXISTS `semesters` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `semester_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `session_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `student_academic_infos`
--

DROP TABLE IF EXISTS `student_academic_infos`;
CREATE TABLE IF NOT EXISTS `student_academic_infos` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `board_reg_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `student_parent_infos`
--

DROP TABLE IF EXISTS `student_parent_infos`;
CREATE TABLE IF NOT EXISTS `student_parent_infos` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `student_id` int UNSIGNED NOT NULL,
  `father_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `syllabi`
--

DROP TABLE IF EXISTS `syllabi`;
CREATE TABLE IF NOT EXISTS `syllabi` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `syllabus_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `syllabus_file_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_id` int UNSIGNED NOT NULL,
  `course_id` int UNSIGNED NOT NULL,
  `session_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationality` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address2` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blood_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `religion` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
