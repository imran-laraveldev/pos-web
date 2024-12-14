/*
Navicat MySQL Data Transfer

Source Server         : maria-db
Source Server Version : 80027
Source Host           : localhost:3306
Source Database       : db_pos_web

Target Server Type    : MYSQL
Target Server Version : 80027
File Encoding         : 65001

Date: 2024-12-14 17:38:34
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `budget_types`
-- ----------------------------
DROP TABLE IF EXISTS `budget_types`;
CREATE TABLE `budget_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sector` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_sector` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_idfk` int NOT NULL,
  `created_by` bigint unsigned NOT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `budget_types_title_unique` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of budget_types
-- ----------------------------

-- ----------------------------
-- Table structure for `classes`
-- ----------------------------
DROP TABLE IF EXISTS `classes`;
CREATE TABLE `classes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class` int NOT NULL,
  `created_by` int NOT NULL,
  `updated_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of classes
-- ----------------------------

-- ----------------------------
-- Table structure for `departments`
-- ----------------------------
DROP TABLE IF EXISTS `departments`;
CREATE TABLE `departments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ur` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_idfk` int NOT NULL DEFAULT '0',
  `created_by` bigint unsigned NOT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `departments_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of departments
-- ----------------------------
INSERT INTO `departments` VALUES ('1', 'SCM', 'Sales', 'scm', '0', '0', null, '2024-12-14 06:57:56', '2024-12-14 06:57:56', null);
INSERT INTO `departments` VALUES ('2', 'PITB', 'Punjab IT Board', 'pitb', '0', '0', null, '2024-12-14 06:57:56', '2024-12-14 06:57:56', null);

-- ----------------------------
-- Table structure for `districts`
-- ----------------------------
DROP TABLE IF EXISTS `districts`;
CREATE TABLE `districts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ur` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `division_idfk` bigint unsigned NOT NULL,
  `created_by` bigint unsigned NOT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `districts_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of districts
-- ----------------------------
INSERT INTO `districts` VALUES ('1', 'Bahawalnagar', 'بھاولنگر', 'bahawalnagar', '1', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `districts` VALUES ('2', 'Bahawalpur', 'بہاولپور', 'bahawalpur', '1', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `districts` VALUES ('3', 'Rahimyar khan', 'رحیم یار خان', 'rahimyar-khan', '1', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `districts` VALUES ('4', 'Dera Ghazi Khan', 'ڈیرہ غازی خان', 'dera-ghazi-khan', '2', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `districts` VALUES ('5', 'Layyah', 'لیہ', 'layyah', '2', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `districts` VALUES ('6', 'Muzaffargarh', 'مظفر گڑھ', 'muzaffargarh', '2', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `districts` VALUES ('7', 'Rajanpur', 'راجن پور', 'rajanpur', '2', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `districts` VALUES ('8', 'Kasur', 'قصور', 'kasur', '3', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `districts` VALUES ('9', 'Lahore', 'لاہور', 'lahore', '3', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `districts` VALUES ('10', 'Nankana sahib', 'ننکانہ صاحب', 'nankana-sahib', '3', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `districts` VALUES ('11', 'Sheikhupura', '', 'sheikhupura', '3', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `districts` VALUES ('12', 'Gujranwala', 'گوجرانوالہ', 'gujranwala', '4', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `districts` VALUES ('13', 'Gujrat', 'گجرات', 'gujrat', '4', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `districts` VALUES ('14', 'Hafizabad', 'حافظ آباد', 'hafizabad', '4', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `districts` VALUES ('15', 'Mandi baha ud din', 'منڈی بہاوالدین', 'mandi-baha-ud-din', '4', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `districts` VALUES ('16', 'Narowal', 'نارووال', 'narowal', '4', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `districts` VALUES ('17', 'Sialkot', 'سيالكوٹ', 'sialkot', '4', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `districts` VALUES ('18', 'Khanewal', 'خانیوال', 'khanewal', '5', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `districts` VALUES ('19', 'Lodhran', 'لودھراں', 'lodhran', '5', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `districts` VALUES ('20', 'Multan', 'ملتان', 'multan', '5', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `districts` VALUES ('21', 'Vehari', '‬وہاڑی', 'vehari', '5', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `districts` VALUES ('22', 'Okara', 'اوکاڑا', 'okara', '6', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `districts` VALUES ('23', 'Pakpattan', 'پاکپتن', 'pakpattan', '6', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `districts` VALUES ('24', 'Sahiwal', 'ساہیوال', 'sahiwal', '6', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `districts` VALUES ('25', 'Bhakkar', 'بھکر', 'bhakkar', '7', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `districts` VALUES ('26', 'Khushab', 'خوشاب', 'khushab', '7', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `districts` VALUES ('27', 'Mianwali', 'میانوالی', 'mianwali', '7', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `districts` VALUES ('28', 'Sargodha', 'سرگودھا', 'sargodha', '7', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `districts` VALUES ('29', 'Attock', 'اٹک', 'attock', '8', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `districts` VALUES ('30', 'Chakwal', 'چکوال', 'chakwal', '8', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `districts` VALUES ('31', 'Jhelum', 'جہلم', 'jhelum', '8', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `districts` VALUES ('32', 'Rawalpindi', 'راولپنڈی', 'rawalpindi', '8', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `districts` VALUES ('33', 'Chiniot', 'چنیوٹ', 'chiniot', '9', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `districts` VALUES ('34', 'Faisalabad', 'فیصل آباد', 'faisalabad', '9', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `districts` VALUES ('35', 'Jhang', '‪جھنگ‬', 'jhang', '9', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `districts` VALUES ('36', 'Toba tek singh', 'ٹوبہ ٹیک سنگھ', 'toba-tek-singh', '9', '1', null, '2024-12-14 06:58:00', null, null);

-- ----------------------------
-- Table structure for `divisions`
-- ----------------------------
DROP TABLE IF EXISTS `divisions`;
CREATE TABLE `divisions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ur` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province_idfk` bigint unsigned NOT NULL,
  `created_by` bigint unsigned NOT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `divisions_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of divisions
-- ----------------------------
INSERT INTO `divisions` VALUES ('1', 'Bahawalpur', null, 'bahawalpur', '6', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `divisions` VALUES ('2', 'Dera Ghazi Khan', null, 'dera-ghazi-khan', '6', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `divisions` VALUES ('3', 'Lahore', null, 'lahore', '6', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `divisions` VALUES ('4', 'Gujranwala', null, 'gujranwala', '6', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `divisions` VALUES ('5', 'Multan', null, 'multan', '6', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `divisions` VALUES ('6', 'Sahiwal', null, 'sahiwal', '6', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `divisions` VALUES ('7', 'Sargodha', null, 'sargodha', '6', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `divisions` VALUES ('8', 'Rawalpindi', null, 'rawalpindi', '6', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `divisions` VALUES ('9', 'Faisalabad', null, 'faisalabad', '6', '1', null, '2024-12-14 06:58:00', null, null);

-- ----------------------------
-- Table structure for `dynamic_forms`
-- ----------------------------
DROP TABLE IF EXISTS `dynamic_forms`;
CREATE TABLE `dynamic_forms` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `navigation_id` int NOT NULL,
  `node_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `node_sort_order` tinyint unsigned NOT NULL,
  `form_type` tinyint NOT NULL DEFAULT '1' COMMENT '1: listing,2:dropdowns',
  `schema_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `allowed_operations` enum('view','create','update','delete','all') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'all',
  `migrate` tinyint(1) NOT NULL DEFAULT '0',
  `pagination` tinyint(1) NOT NULL DEFAULT '1',
  `activate_workflow` tinyint(1) NOT NULL DEFAULT '0',
  `soft_delete` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int NOT NULL,
  `updated_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of dynamic_forms
-- ----------------------------
INSERT INTO `dynamic_forms` VALUES ('1', '5', 'Students', '1', '1', 'students', 'all', '1', '1', '0', '0', '1', '0', '2024-03-03 15:00:32', '2024-03-12 18:33:27');
INSERT INTO `dynamic_forms` VALUES ('2', '5', 'Classes', '1', '1', 'classes', 'view', '1', '1', '0', '0', '0', '0', '2024-03-03 17:06:04', '2024-03-15 17:09:20');
INSERT INTO `dynamic_forms` VALUES ('3', '3', 'Tutions', '2', '1', 'tutions', 'all', '1', '1', '0', '0', '3', '0', '2024-03-03 17:18:19', '2024-03-03 17:18:19');
INSERT INTO `dynamic_forms` VALUES ('4', '4', 'Districts', '4', '2', 'districts', 'all', '0', '1', '0', '0', '3', '0', '2024-03-17 08:27:15', '2024-03-17 08:27:15');
INSERT INTO `dynamic_forms` VALUES ('5', '4', 'Provinces', '5', '2', 'provinces', 'all', '0', '1', '0', '0', '3', '0', '2024-03-17 09:04:00', '2024-03-17 09:05:42');
INSERT INTO `dynamic_forms` VALUES ('8', '5', 'Products', '1', '1', 'products', 'all', '0', '1', '0', '0', '3', '0', '2024-03-17 11:54:25', '2024-03-17 11:54:25');

-- ----------------------------
-- Table structure for `dynamic_form_entries`
-- ----------------------------
DROP TABLE IF EXISTS `dynamic_form_entries`;
CREATE TABLE `dynamic_form_entries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `dynamic_form_id` bigint unsigned NOT NULL,
  `field_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `field_type` enum('integer','float','varchar','text','boolean','date','datetime') COLLATE utf8mb4_unicode_ci NOT NULL,
  `field_length` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `default_value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `control_type` enum('text','numeric','select','textarea','checkbox','radio','date','datetime') COLLATE utf8mb4_unicode_ci NOT NULL,
  `select_options` json DEFAULT NULL,
  `checklist` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `control_class` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_required` tinyint(1) NOT NULL DEFAULT '1',
  `is_filter` tinyint(1) NOT NULL DEFAULT '1',
  `visible_list` tinyint(1) NOT NULL DEFAULT '1',
  `total_numeric_field` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int NOT NULL,
  `updated_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dynamic_form_entries_dynamic_form_id_foreign` (`dynamic_form_id`),
  CONSTRAINT `dynamic_form_entries_dynamic_form_id_foreign` FOREIGN KEY (`dynamic_form_id`) REFERENCES `dynamic_forms` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of dynamic_form_entries
-- ----------------------------
INSERT INTO `dynamic_form_entries` VALUES ('1', '3', 'name', 'varchar', '150', '', 'Name', 'text', null, null, '', '1', '1', '1', '0', '3', '3', '2024-03-08 06:11:02');
INSERT INTO `dynamic_form_entries` VALUES ('2', '3', 'father_name', 'varchar', '200', '', 'Father', 'text', null, null, '', '1', '1', '1', '0', '3', '3', '2024-03-08 06:11:02');
INSERT INTO `dynamic_form_entries` VALUES ('7', '3', 'address', 'varchar', '500', '', 'Address', 'textarea', null, null, '', '0', '1', '1', '0', '3', '3', '2024-03-08 11:12:57');
INSERT INTO `dynamic_form_entries` VALUES ('8', '3', 'phone_number', 'varchar', '200', '', 'Phone #', 'numeric', null, null, '', '0', '1', '1', '0', '3', '3', '2024-03-08 11:12:57');
INSERT INTO `dynamic_form_entries` VALUES ('9', '3', 'contact_no', 'varchar', '15', '', 'Contact Number', 'text', null, null, '', '0', '1', '1', '0', '3', '3', '2024-03-08 11:12:57');
INSERT INTO `dynamic_form_entries` VALUES ('10', '3', 'subjects', 'varchar', '255', '', 'Gender', 'checkbox', null, 'male,female', '', '1', '1', '1', '0', '3', '3', '2024-03-12 15:52:15');
INSERT INTO `dynamic_form_entries` VALUES ('11', '1', 'name', 'varchar', '100', '', 'Name', 'text', null, null, '', '1', '1', '1', '0', '3', '3', '2024-03-12 16:26:25');
INSERT INTO `dynamic_form_entries` VALUES ('12', '1', 'contact_number', 'varchar', '15', '', 'Contact #', 'text', null, null, '', '1', '1', '1', '0', '3', '3', '2024-03-12 16:26:26');
INSERT INTO `dynamic_form_entries` VALUES ('13', '1', 'city', 'varchar', '100', '', 'City', 'text', null, null, '', '1', '1', '1', '0', '3', '3', '2024-03-12 16:26:26');
INSERT INTO `dynamic_form_entries` VALUES ('14', '1', 'country', 'varchar', '200', '', 'Country', 'text', null, null, '', '1', '1', '1', '0', '3', '0', '2024-03-12 16:27:20');
INSERT INTO `dynamic_form_entries` VALUES ('15', '2', 'name', 'varchar', '100', '', 'Name', 'text', null, null, '', '1', '1', '1', '0', '3', '3', '2024-03-12 18:37:03');
INSERT INTO `dynamic_form_entries` VALUES ('16', '2', 'class', 'integer', '10', '', 'District', 'select', null, 'districts', '', '1', '1', '1', '0', '3', '3', '2024-03-12 18:37:04');
INSERT INTO `dynamic_form_entries` VALUES ('17', '4', 'name', 'varchar', '100', '', 'Name', 'text', null, null, '', '1', '1', '1', '0', '3', '0', '2024-03-17 08:28:01');
INSERT INTO `dynamic_form_entries` VALUES ('18', '4', 'name_ur', 'varchar', '255', '', 'Urdu Name', 'text', null, null, '', '1', '1', '1', '0', '3', '0', '2024-03-17 08:28:01');
INSERT INTO `dynamic_form_entries` VALUES ('19', '5', 'name', 'varchar', '100', '', 'Name', 'text', null, null, '', '1', '1', '1', '0', '3', '0', '2024-03-17 09:04:32');
INSERT INTO `dynamic_form_entries` VALUES ('20', '5', 'slug', 'varchar', '255', '', 'Slug', 'text', null, null, '', '1', '1', '1', '0', '3', '0', '2024-03-17 09:04:32');

-- ----------------------------
-- Table structure for `employee`
-- ----------------------------
DROP TABLE IF EXISTS `employee`;
CREATE TABLE `employee` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `updated_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of employee
-- ----------------------------

-- ----------------------------
-- Table structure for `failed_jobs`
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('3', '2019_08_19_000000_create_failed_jobs_table', '1');
INSERT INTO `migrations` VALUES ('4', '2019_12_14_000001_create_personal_access_tokens_table', '1');
INSERT INTO `migrations` VALUES ('5', '2023_02_09_061334_create_navigations_table', '1');
INSERT INTO `migrations` VALUES ('6', '2023_02_09_061516_create_province_division_district_tehsil_tables', '1');
INSERT INTO `migrations` VALUES ('7', '2023_02_09_063659_alter_users_table_add_locality', '1');
INSERT INTO `migrations` VALUES ('8', '2023_02_10_073232_create_budget_types_table', '1');
INSERT INTO `migrations` VALUES ('9', '2023_04_01_044132_create_permission_tables', '1');
INSERT INTO `migrations` VALUES ('10', '2023_07_20_134641_create_products_table', '2');
INSERT INTO `migrations` VALUES ('11', '2024_03_03_130722_create_dynamic_forms_tables', '2');
INSERT INTO `migrations` VALUES ('12', '2024_03_12_161648_create_tutions_table', '2');
INSERT INTO `migrations` VALUES ('13', '2024_03_12_183114_create_students_table', '2');
INSERT INTO `migrations` VALUES ('14', '2024_03_15_165729_create_classes_table', '2');
INSERT INTO `migrations` VALUES ('15', '2024_03_17_092325_create_provinces_table', '2');
INSERT INTO `migrations` VALUES ('16', '2024_03_20_093822_create_employee_table', '3');

-- ----------------------------
-- Table structure for `model_has_permissions`
-- ----------------------------
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of model_has_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for `model_has_roles`
-- ----------------------------
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of model_has_roles
-- ----------------------------
INSERT INTO `model_has_roles` VALUES ('2', 'App\\Models\\User', '1');
INSERT INTO `model_has_roles` VALUES ('2', 'App\\Models\\User', '2');
INSERT INTO `model_has_roles` VALUES ('2', 'App\\Models\\User', '3');
INSERT INTO `model_has_roles` VALUES ('3', 'App\\Models\\User', '4');
INSERT INTO `model_has_roles` VALUES ('4', 'App\\Models\\User', '5');

-- ----------------------------
-- Table structure for `navigations`
-- ----------------------------
DROP TABLE IF EXISTS `navigations`;
CREATE TABLE `navigations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int NOT NULL DEFAULT '0',
  `block` int NOT NULL DEFAULT '0',
  `type` enum('view-only','all','none') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'all',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `sort_id` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `navigations_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of navigations
-- ----------------------------
INSERT INTO `navigations` VALUES ('1', 'Dashboard', 'dashboard', null, '0', '1', 'all', 'active', '0', '2024-12-14 06:58:00', '2024-12-14 06:58:00', null);
INSERT INTO `navigations` VALUES ('2', 'Inventory', 'inventory', null, '0', '1', 'all', 'active', '0', '2024-12-14 06:58:00', '2024-12-14 06:58:00', null);
INSERT INTO `navigations` VALUES ('3', 'Sales', 'sales', null, '0', '1', 'all', 'active', '0', '2024-12-14 06:58:00', '2024-12-14 06:58:00', null);
INSERT INTO `navigations` VALUES ('4', 'Settings', 'settings', null, '0', '1', 'all', 'active', '0', '2024-12-14 06:58:00', '2024-12-14 06:58:00', null);
INSERT INTO `navigations` VALUES ('5', 'Reports', 'reports', null, '0', '1', 'all', 'active', '0', '2024-12-14 06:58:00', '2024-12-14 06:58:00', null);
INSERT INTO `navigations` VALUES ('6', 'Users', 'users', null, '0', '1', 'all', 'active', '0', '2024-12-14 06:58:00', '2024-12-14 06:58:00', null);

-- ----------------------------
-- Table structure for `password_resets`
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for `permissions`
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES ('1', 'dashboard-view', 'web', '2024-12-14 06:57:59', '2024-12-14 06:57:59');
INSERT INTO `permissions` VALUES ('2', 'dashboard-create', 'web', '2024-12-14 06:57:59', '2024-12-14 06:57:59');
INSERT INTO `permissions` VALUES ('3', 'dashboard-edit', 'web', '2024-12-14 06:57:59', '2024-12-14 06:57:59');
INSERT INTO `permissions` VALUES ('4', 'dashboard-del', 'web', '2024-12-14 06:57:59', '2024-12-14 06:57:59');
INSERT INTO `permissions` VALUES ('5', 'inventory-view', 'web', '2024-12-14 06:57:59', '2024-12-14 06:57:59');
INSERT INTO `permissions` VALUES ('6', 'inventory-create', 'web', '2024-12-14 06:57:59', '2024-12-14 06:57:59');
INSERT INTO `permissions` VALUES ('7', 'inventory-edit', 'web', '2024-12-14 06:58:00', '2024-12-14 06:58:00');
INSERT INTO `permissions` VALUES ('8', 'inventory-del', 'web', '2024-12-14 06:58:00', '2024-12-14 06:58:00');
INSERT INTO `permissions` VALUES ('9', 'sales-view', 'web', '2024-12-14 06:58:00', '2024-12-14 06:58:00');
INSERT INTO `permissions` VALUES ('10', 'sales-create', 'web', '2024-12-14 06:58:00', '2024-12-14 06:58:00');
INSERT INTO `permissions` VALUES ('11', 'sales-edit', 'web', '2024-12-14 06:58:00', '2024-12-14 06:58:00');
INSERT INTO `permissions` VALUES ('12', 'sales-del', 'web', '2024-12-14 06:58:00', '2024-12-14 06:58:00');
INSERT INTO `permissions` VALUES ('13', 'settings-view', 'web', '2024-12-14 06:58:00', '2024-12-14 06:58:00');
INSERT INTO `permissions` VALUES ('14', 'settings-create', 'web', '2024-12-14 06:58:00', '2024-12-14 06:58:00');
INSERT INTO `permissions` VALUES ('15', 'settings-edit', 'web', '2024-12-14 06:58:00', '2024-12-14 06:58:00');
INSERT INTO `permissions` VALUES ('16', 'settings-del', 'web', '2024-12-14 06:58:00', '2024-12-14 06:58:00');
INSERT INTO `permissions` VALUES ('17', 'reports-view', 'web', '2024-12-14 06:58:00', '2024-12-14 06:58:00');
INSERT INTO `permissions` VALUES ('18', 'reports-create', 'web', '2024-12-14 06:58:00', '2024-12-14 06:58:00');
INSERT INTO `permissions` VALUES ('19', 'reports-edit', 'web', '2024-12-14 06:58:00', '2024-12-14 06:58:00');
INSERT INTO `permissions` VALUES ('20', 'reports-del', 'web', '2024-12-14 06:58:00', '2024-12-14 06:58:00');
INSERT INTO `permissions` VALUES ('21', 'users-view', 'web', '2024-12-14 06:58:00', '2024-12-14 06:58:00');
INSERT INTO `permissions` VALUES ('22', 'users-create', 'web', '2024-12-14 06:58:00', '2024-12-14 06:58:00');
INSERT INTO `permissions` VALUES ('23', 'users-edit', 'web', '2024-12-14 06:58:00', '2024-12-14 06:58:00');
INSERT INTO `permissions` VALUES ('24', 'users-del', 'web', '2024-12-14 06:58:00', '2024-12-14 06:58:00');

-- ----------------------------
-- Table structure for `personal_access_tokens`
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for `products`
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `department_id` int NOT NULL,
  `code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sale_price` double(8,2) NOT NULL,
  `cost_price` double(8,2) NOT NULL,
  `discount_rate` double(2,2) NOT NULL,
  `vendor_id` bigint unsigned NOT NULL,
  `created_by` bigint unsigned NOT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of products
-- ----------------------------

-- ----------------------------
-- Table structure for `product_categories`
-- ----------------------------
DROP TABLE IF EXISTS `product_categories`;
CREATE TABLE `product_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint unsigned NOT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of product_categories
-- ----------------------------

-- ----------------------------
-- Table structure for `product_sizes`
-- ----------------------------
DROP TABLE IF EXISTS `product_sizes`;
CREATE TABLE `product_sizes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sale_price` double(8,2) NOT NULL,
  `cost_price` double(8,2) NOT NULL,
  `discount_rate` double(2,2) NOT NULL,
  `created_by` bigint unsigned NOT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of product_sizes
-- ----------------------------

-- ----------------------------
-- Table structure for `provinces`
-- ----------------------------
DROP TABLE IF EXISTS `provinces`;
CREATE TABLE `provinces` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint unsigned NOT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `provinces_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of provinces
-- ----------------------------
INSERT INTO `provinces` VALUES ('1', 'Azad Jammu and Kashmir', 'azad-jammu-and-kashmir', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `provinces` VALUES ('2', 'Balochistan', 'balochistan', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `provinces` VALUES ('3', 'Gilgit-Baltistan', 'gilgit-baltistan', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `provinces` VALUES ('4', 'Islamabad Capital Territory', 'islamabad-capital-territory', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `provinces` VALUES ('5', 'Khyber Pakhtunkhwa', 'khyber-pakhtunkhwa', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `provinces` VALUES ('6', 'Punjab', 'punjab', '1', null, '2024-12-14 06:58:00', null, null);
INSERT INTO `provinces` VALUES ('7', 'Sindh', 'sindh', '1', null, '2024-12-14 06:58:00', null, null);

-- ----------------------------
-- Table structure for `roles`
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', 'SuperAdmin', 'web', '2024-12-14 06:57:56', '2024-12-14 06:57:56');
INSERT INTO `roles` VALUES ('2', 'Admin', 'web', '2024-12-14 06:57:56', '2024-12-14 06:57:56');
INSERT INTO `roles` VALUES ('3', 'Manager', 'web', '2024-12-14 06:58:00', '2024-12-14 06:58:00');
INSERT INTO `roles` VALUES ('4', 'Sales', 'web', '2024-12-14 06:58:00', '2024-12-14 06:58:00');

-- ----------------------------
-- Table structure for `role_has_permissions`
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of role_has_permissions
-- ----------------------------
INSERT INTO `role_has_permissions` VALUES ('1', '2');
INSERT INTO `role_has_permissions` VALUES ('2', '2');
INSERT INTO `role_has_permissions` VALUES ('3', '2');
INSERT INTO `role_has_permissions` VALUES ('4', '2');
INSERT INTO `role_has_permissions` VALUES ('5', '2');
INSERT INTO `role_has_permissions` VALUES ('6', '2');
INSERT INTO `role_has_permissions` VALUES ('7', '2');
INSERT INTO `role_has_permissions` VALUES ('8', '2');
INSERT INTO `role_has_permissions` VALUES ('9', '2');
INSERT INTO `role_has_permissions` VALUES ('10', '2');
INSERT INTO `role_has_permissions` VALUES ('11', '2');
INSERT INTO `role_has_permissions` VALUES ('12', '2');
INSERT INTO `role_has_permissions` VALUES ('13', '2');
INSERT INTO `role_has_permissions` VALUES ('14', '2');
INSERT INTO `role_has_permissions` VALUES ('15', '2');
INSERT INTO `role_has_permissions` VALUES ('16', '2');
INSERT INTO `role_has_permissions` VALUES ('17', '2');
INSERT INTO `role_has_permissions` VALUES ('18', '2');
INSERT INTO `role_has_permissions` VALUES ('19', '2');
INSERT INTO `role_has_permissions` VALUES ('20', '2');
INSERT INTO `role_has_permissions` VALUES ('21', '2');
INSERT INTO `role_has_permissions` VALUES ('22', '2');
INSERT INTO `role_has_permissions` VALUES ('23', '2');
INSERT INTO `role_has_permissions` VALUES ('24', '2');
INSERT INTO `role_has_permissions` VALUES ('1', '3');
INSERT INTO `role_has_permissions` VALUES ('2', '3');
INSERT INTO `role_has_permissions` VALUES ('3', '3');
INSERT INTO `role_has_permissions` VALUES ('4', '3');
INSERT INTO `role_has_permissions` VALUES ('5', '3');
INSERT INTO `role_has_permissions` VALUES ('6', '3');
INSERT INTO `role_has_permissions` VALUES ('7', '3');
INSERT INTO `role_has_permissions` VALUES ('8', '3');
INSERT INTO `role_has_permissions` VALUES ('9', '3');
INSERT INTO `role_has_permissions` VALUES ('10', '3');
INSERT INTO `role_has_permissions` VALUES ('11', '3');
INSERT INTO `role_has_permissions` VALUES ('12', '3');
INSERT INTO `role_has_permissions` VALUES ('13', '3');
INSERT INTO `role_has_permissions` VALUES ('14', '3');
INSERT INTO `role_has_permissions` VALUES ('15', '3');
INSERT INTO `role_has_permissions` VALUES ('16', '3');
INSERT INTO `role_has_permissions` VALUES ('17', '3');
INSERT INTO `role_has_permissions` VALUES ('18', '3');
INSERT INTO `role_has_permissions` VALUES ('19', '3');
INSERT INTO `role_has_permissions` VALUES ('20', '3');
INSERT INTO `role_has_permissions` VALUES ('21', '3');
INSERT INTO `role_has_permissions` VALUES ('22', '3');
INSERT INTO `role_has_permissions` VALUES ('23', '3');
INSERT INTO `role_has_permissions` VALUES ('24', '3');
INSERT INTO `role_has_permissions` VALUES ('1', '4');
INSERT INTO `role_has_permissions` VALUES ('2', '4');
INSERT INTO `role_has_permissions` VALUES ('3', '4');
INSERT INTO `role_has_permissions` VALUES ('4', '4');
INSERT INTO `role_has_permissions` VALUES ('5', '4');
INSERT INTO `role_has_permissions` VALUES ('6', '4');
INSERT INTO `role_has_permissions` VALUES ('7', '4');
INSERT INTO `role_has_permissions` VALUES ('8', '4');
INSERT INTO `role_has_permissions` VALUES ('9', '4');
INSERT INTO `role_has_permissions` VALUES ('10', '4');
INSERT INTO `role_has_permissions` VALUES ('11', '4');
INSERT INTO `role_has_permissions` VALUES ('12', '4');
INSERT INTO `role_has_permissions` VALUES ('13', '4');
INSERT INTO `role_has_permissions` VALUES ('14', '4');
INSERT INTO `role_has_permissions` VALUES ('15', '4');
INSERT INTO `role_has_permissions` VALUES ('16', '4');
INSERT INTO `role_has_permissions` VALUES ('17', '4');
INSERT INTO `role_has_permissions` VALUES ('18', '4');
INSERT INTO `role_has_permissions` VALUES ('19', '4');
INSERT INTO `role_has_permissions` VALUES ('20', '4');
INSERT INTO `role_has_permissions` VALUES ('21', '4');
INSERT INTO `role_has_permissions` VALUES ('22', '4');
INSERT INTO `role_has_permissions` VALUES ('23', '4');
INSERT INTO `role_has_permissions` VALUES ('24', '4');

-- ----------------------------
-- Table structure for `students`
-- ----------------------------
DROP TABLE IF EXISTS `students`;
CREATE TABLE `students` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `updated_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of students
-- ----------------------------

-- ----------------------------
-- Table structure for `tehsils`
-- ----------------------------
DROP TABLE IF EXISTS `tehsils`;
CREATE TABLE `tehsils` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ur` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district_idfk` bigint unsigned NOT NULL,
  `created_by` bigint unsigned NOT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tehsils_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=155 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tehsils
-- ----------------------------
INSERT INTO `tehsils` VALUES ('1', 'Attock', 'اٹک', 'attock', '29', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('2', 'Fatehjang', 'فتح جنگ', 'fatehjang', '29', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('3', 'Hassanabdal', 'حسن ابدال', 'hassanabdal', '29', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('4', 'Hazro', 'ہیزرو', 'hazro', '29', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('5', 'Jand', 'جنڈ', 'jand', '29', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('6', 'Pindigheb', 'پنڈی گھیب', 'pindigheb', '29', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('7', 'Bahawalnagar', 'بھاولنگر', 'bahawalnagar', '1', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('8', 'Chistian', 'چشتتیاں', 'chistian', '1', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('9', 'Fortabbass', 'فورٹ عباس', 'fortabbass', '1', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('10', 'Haroonabad', 'ھارون آباد', 'haroonabad', '1', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('11', 'Minchinabad', 'منچن آباد', 'minchinabad', '1', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('12', 'Ahmed pur east', 'احمد پور شرقیہ', 'ahmed-pur-east', '2', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('13', 'Bahawalpur city', 'بہاولپور سٹی', 'bahawalpur-city', '2', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('14', 'Hasilpur', 'حاصل پور', 'hasilpur', '2', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('15', 'Khairpur tamewali', 'خیرپور ٹامیوالی', 'khairpur-tamewali', '2', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('16', 'Yazman', 'یزمان', 'yazman', '2', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('17', 'Bahawalpur sadar', 'بہاولپور صدر', 'bahawalpur-sadar', '2', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('18', 'Tamewali', 'تمیوالی', 'tamewali', '2', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('19', 'Bhakkar', 'بھکر', 'bhakkar', '25', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('20', 'Darya khan', 'دریا‪ ‬خان', 'darya-khan', '25', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('21', 'Kallur kot', 'کلورکوٹ', 'kallur-kot', '25', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('22', 'Mankera', 'منکیرہ', 'mankera', '25', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('23', 'Chakwal', 'چکوال', 'chakwal', '30', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('24', 'Choa saidden shah', 'چوا سیدن شاہ', 'choa-saidden-shah', '30', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('25', 'Kalarkahar', 'کلرکہار', 'kalarkahar', '30', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('26', 'Talagang', 'تلہ گنگ', 'talagang', '30', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('27', 'Lawa', 'لاوہ', 'lawa', '30', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('28', 'Bhowana', 'بھوآ نہ', 'bhowana', '33', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('29', 'Chiniot', 'چنیوٹ', 'chiniot', '33', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('30', 'Lalian', 'لالیاں', 'lalian', '33', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('31', 'D.g.khan', 'ڈیرہ غازی خان', 'd.g.khan', '4', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('32', 'Taunsa', 'تونسہ', 'taunsa', '4', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('33', 'Kot chutta', 'کوٹ چھٹہ', 'kot-chutta', '4', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('34', 'Tribal area', 'ٹرائیبل ایریا', 'tribal-area', '4', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('35', 'Chak jhumra', 'چک جھمرہ', 'chak-jhumra', '34', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('36', 'Faisalabad city', 'فیصل آباد سٹی', 'faisalabad-city', '34', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('37', 'Faisalabad saddar', 'فیصل‪ ‬آباد‪ ‬صدر', 'faisalabad-saddar', '34', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('38', 'Jaranwala', 'جڑانوالہ', 'jaranwala', '34', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('39', 'Sammundri', '‬سمندری', 'sammundri', '34', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('40', 'Tandlianwala', 'تاندلیانوالہ', 'tandlianwala', '34', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('41', 'Gujranwala', 'گوجرانوالہ', 'gujranwala', '12', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('42', 'Kamoke', 'کامونکی', 'kamoke', '12', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('43', 'Nowshera virkan', 'نوشہرہ ورکاں', 'nowshera-virkan', '12', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('44', 'Wazirabad', 'وزیرآباد', 'wazirabad', '12', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('45', 'Qila didar singh', 'قلعہ دِيدار سِنگھ', 'qila-didar-singh', '12', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('46', 'Aroop', 'آروپ', 'aroop', '12', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('47', 'Khiali shahpur', 'کھیالی شاہ پور', 'khiali-shahpur', '12', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('48', 'Nandipur', 'نندی پور', 'nandipur', '12', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('49', 'Gujrat', 'گجرات', 'gujrat', '13', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('50', 'Kharian', 'کھاریاں', 'kharian', '13', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('51', 'Sarai alam gir', 'سرائے عالمگیر', 'sarai-alam-gir', '13', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('52', 'Hafizabad', 'حافظ آباد', 'hafizabad', '14', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('53', 'Pindi bhattian', 'پِنڈى بهٹياں', 'pindi-bhattian', '14', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('54', 'Ahmad pur sial', 'احمد پور سیال', 'ahmad-pur-sial', '35', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('55', 'Jhang', '‪جھنگ‬', 'jhang', '35', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('56', 'Shorkot', 'شورکوٹ', 'shorkot', '35', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('57', '18-hazari', '۱۸ ہزاری', '18-hazari', '35', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('58', 'Dina', 'دینہ', 'dina', '31', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('59', 'Jhelum', 'جہلم', 'jhelum', '31', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('60', 'P.d khan', 'پنڈ داد نخان', 'p.d-khan', '31', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('61', 'Sohawa', 'سوہاوہ', 'sohawa', '31', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('62', 'Chunian', 'چونیاں', 'chunian', '8', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('63', 'Kasur', 'قصور', 'kasur', '8', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('64', 'Kot radha kishan', 'کوٹ رادھا کشن', 'kot-radha-kishan', '8', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('65', 'Pattoki', 'پتوکی', 'pattoki', '8', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('66', 'Jahanian', 'جہانیاں', 'jahanian', '18', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('67', 'Kabirwala', 'کبیر والا', 'kabirwala', '18', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('68', 'Khanewal', 'خانیوال', 'khanewal', '18', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('69', 'Mian channu', 'میاں چنوں', 'mian-channu', '18', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('70', 'Khushab', 'خوشاب', 'khushab', '26', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('71', 'Noor purthal', 'نورپور', 'noor-purthal', '26', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('72', 'Qaid bad', 'قائد آباد', 'qaid-bad', '26', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('73', 'Naushera', 'نَوشہره', 'naushera', '26', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('74', 'Cantt', 'کینٹ', 'cantt', '9', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('75', 'Allama iqbal', 'علامہ اقبال', 'allama-iqbal', '9', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('76', 'Aziz bhatti', 'عزیز بھٹی', 'aziz-bhatti', '9', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('77', 'Data gunj buksh', 'داتا گنج بخش', 'data-gunj-buksh', '9', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('78', 'Gulberg', 'گلبرگ', 'gulberg', '9', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('79', 'Nishter', 'نشتر', 'nishter', '9', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('80', 'Ravi', 'راوی', 'ravi', '9', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('81', 'Shalimar', 'شالیمار', 'shalimar', '9', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('82', 'Samanabad', 'سمن آباد', 'samanabad', '9', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('83', 'Wahga', 'واہگا', 'wahga', '9', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('84', 'Chaubara', 'چوبارہ', 'chaubara', '5', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('85', 'Karor lalisan', 'کروڑلعل عیسن', 'karor-lalisan', '5', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('86', 'Layyah', 'لیہ', 'layyah', '5', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('87', 'Dunyapur', 'دنیا پور', 'dunyapur', '19', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('88', 'Karor pacca', 'کہروڑ پکا', 'karor-pacca', '19', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('89', 'Lodhran', 'لودھراں', 'lodhran', '19', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('90', 'Malikwal', 'ملکوال', 'malikwal', '15', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('91', 'Mandi bahuddin', 'منڈی بہاو الدین', 'mandi-bahuddin', '15', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('92', 'Phalia', 'پھالیہ', 'phalia', '15', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('93', 'Isa khel', 'عیسی خیل', 'isa-khel', '27', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('94', 'Mianwali', 'میانوالی', 'mianwali', '27', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('95', 'Piplan', 'پپلاں', 'piplan', '27', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('96', 'Jalalpur pirwala', 'جلالپور پیر والا', 'jalalpur-pirwala', '20', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('97', 'Multan city', 'ملتان', 'multan-city', '20', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('98', 'Multan sadar', 'ملتان صدر', 'multan-sadar', '20', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('99', 'Shujabad', 'شجاع آباد', 'shujabad', '20', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('100', 'Ali pur', 'علی پور', 'ali-pur', '6', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('101', 'Jataoi', 'جتوئی', 'jataoi', '6', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('102', 'Kot addu', 'کوٹ اد و', 'kot-addu', '6', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('103', 'Muzaffargarh', 'مظفر گڑھ', 'muzaffargarh', '6', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('104', 'Nankana sahib', 'ننکانہ صاحب', 'nankana-sahib', '10', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('105', 'Sangla hill', 'سانگلہ ہِل', 'sangla-hill', '10', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('106', 'Shahkot', 'شاہ کوٹ', 'shahkot', '10', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('107', 'Narowal', 'نارووال', 'narowal', '16', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('108', 'Shakargarh', 'شکَرگڑھ', 'shakargarh', '16', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('109', 'Zafarwal', 'ظفروال', 'zafarwal', '16', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('110', 'Depalpur', 'دیپالپور', 'depalpur', '22', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('111', 'Okara', 'اوکاڑہ', 'okara', '22', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('112', 'Renala khurd', 'رینالہ خورد', 'renala-khurd', '22', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('113', 'Arifwala', 'عارفوالا', 'arifwala', '23', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('114', 'Pakpattan', 'پاکپتن', 'pakpattan', '23', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('115', 'Khanpur', 'خان پور', 'khanpur', '3', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('116', 'Liaqatpur', 'لیاقت پور', 'liaqatpur', '3', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('117', 'Rahimyar khan', 'رحیم یار خان', 'rahimyar-khan', '3', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('118', 'Sadiqabad', 'صادق آباد', 'sadiqabad', '3', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('119', 'Jampur', 'جام پور', 'jampur', '7', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('120', 'Rajanpur', 'راجن پور', 'rajanpur', '7', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('121', 'Rojhan', 'روجھان', 'rojhan', '7', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('122', 'Gujar khan', 'گجر خان', 'gujar-khan', '32', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('123', 'Kahutta', 'کہوٹہ', 'kahutta', '32', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('124', 'Kaller syedan', 'کلر سیدان', 'kaller-syedan', '32', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('125', 'Kotli sattian', 'کوٹلی ستیان', 'kotli-sattian', '32', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('126', 'Muree', 'مری', 'muree', '32', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('127', 'Rawalpindi city', 'راولپنڈی سٹی', 'rawalpindi-city', '32', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('128', 'Taxila', 'ٹيکسلا', 'taxila', '32', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('129', 'Rawalpindi rural', 'راولپنڈی دیہی', 'rawalpindi-rural', '32', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('130', 'Rawalpindi cantt', 'راولپنڈی کینٹ', 'rawalpindi-cantt', '32', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('131', 'Chichawatani', 'چیچہ وطنی', 'chichawatani', '24', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('132', 'Sahiwal', 'ساہیوال', 'sahiwal', '24', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('133', 'Bhalwal', 'بھلوال', 'bhalwal', '28', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('134', 'Sargodha', 'سرگودھا', 'sargodha', '28', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('135', 'Shahpur', 'شاہ پور', 'shahpur', '28', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('136', 'Sillanwali', 'سلانوالی', 'sillanwali', '28', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('137', 'Kot momin', 'کوٹ مومن', 'kot-momin', '28', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('138', 'Bhera', 'بھیرہ', 'bhera', '28', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('139', 'Ferozewala', 'فیروزوالہ', 'ferozewala', '11', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('140', 'Muridke', 'مریدکے', 'muridke', '11', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('141', 'Safdar abad', 'صفدرآباد', 'safdar-abad', '11', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('142', 'Sharaqpur sharif', 'شرقپور', 'sharaqpur-sharif', '11', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('143', 'Sheikhupura', 'شیخوپورہ', 'sheikhupura', '11', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('144', 'Daska', 'ڈسکہ', 'daska', '17', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('145', 'Pasrur', 'پسرور', 'pasrur', '17', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('146', 'Sambrial', 'سمبڑيال', 'sambrial', '17', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('147', 'Sialkot', 'سيالكوٹ', 'sialkot', '17', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('148', 'Gojra', 'گوجرہ', 'gojra', '36', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('149', 'Kamalia', 'کمالیہ', 'kamalia', '36', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('150', 'Toba tek singh', 'ٹوبہ ٹیک سنگھ', 'toba-tek-singh', '36', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('151', 'Pir mahal', 'پیر محل', 'pir-mahal', '36', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('152', 'Burewala', '‬بوریوالہ', 'burewala', '21', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('153', 'Mailsi', '‬میلسی', 'mailsi', '21', '1', null, '2024-12-14 06:58:03', null, null);
INSERT INTO `tehsils` VALUES ('154', 'Vehari', '‬وہاڑی', 'vehari', '21', '1', null, '2024-12-14 06:58:03', null, null);

-- ----------------------------
-- Table structure for `tutions`
-- ----------------------------
DROP TABLE IF EXISTS `tutions`;
CREATE TABLE `tutions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subjects` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `updated_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tutions
-- ----------------------------
INSERT INTO `tutions` VALUES ('1', 'Imran saleem', 'shafi maqsood', '311 Madina Colony Haroonabad', '03184265392', '03337854174', '1', '1', '0', '2024-12-14 11:54:20', null);
INSERT INTO `tutions` VALUES ('2', 'May thirteen', 'ABDUL AZIZ', 'permanent addresss', '03184265392', '03184265392', '2', '1', '0', '2024-12-14 11:54:43', null);

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province_idfk` int NOT NULL,
  `division_idfk` int NOT NULL,
  `district_idfk` int NOT NULL,
  `tehsil_ids` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fund_center_idfk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost_center_idfk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ddo_idfk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'Super Admin', 'admin@gmail.com', '2024-12-14 06:58:00', '$2y$10$NDvlkkz7FF//DrlZtrXWxe1lqpr9C.ap214ATlxLt5JCT6OsxNBC2', '1', '1', '1', '1', '', '', '', null, '2024-12-14 06:58:00', '2024-12-14 06:58:00');
INSERT INTO `users` VALUES ('2', 'System User', 'system@webserve.com.pk', '2024-12-14 06:58:00', '$2y$10$pODVfDSgbNYavZSA2/p5suAzR1LK6fenS/mklt0WhnUw3wGw/XJDW', '1', '1', '1', '1', '', '', '', null, '2024-12-14 06:58:00', '2024-12-14 06:58:00');
INSERT INTO `users` VALUES ('3', 'Imran Saleem', 'imran@webserve.com.pk', '2024-12-14 06:58:00', '$2y$10$6U4wyZFjMagzE2TVWEDnv.0XFHWQ4pM/gGXleyVGSs78fLUVLIOZe', '1', '1', '1', '1', '', '', '', null, '2024-12-14 06:58:00', '2024-12-14 06:58:00');
INSERT INTO `users` VALUES ('4', 'manager', 'manager@webserve.com.pk', '2024-12-14 06:58:00', '$2y$10$TD3Tg4GP384OGu4q8f9K0eOQYmpxyxxCuGT26SfzcyRu.sPp7XC2u', '1', '1', '1', '1', '', '', '', null, '2024-12-14 06:58:00', '2024-12-14 06:58:00');
INSERT INTO `users` VALUES ('5', 'sales', 'sales@webserve.com.pk', '2024-12-14 06:58:00', '$2y$10$E.SEpAu5Dvl7LPN6wRq3z.4Fb67nNg2oEgrPAaRd0SuVAz8V5DiC.', '1', '1', '1', '1', '', '', '', null, '2024-12-14 06:58:00', '2024-12-14 06:58:00');
