/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 100408
Source Host           : localhost:3306
Source Database       : gym

Target Server Type    : MYSQL
Target Server Version : 100408
File Encoding         : 65001

Date: 2020-04-06 20:43:13
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for workcontrol_api
-- ----------------------------
DROP TABLE IF EXISTS `workcontrol_api`;
CREATE TABLE `workcontrol_api` (
  `api_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `api_key` varchar(255) DEFAULT '',
  `api_token` varchar(255) DEFAULT '',
  `api_date` timestamp NULL DEFAULT NULL,
  `api_status` int(11) DEFAULT 0,
  `api_loads` int(11) DEFAULT 0,
  `api_lastload` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`api_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of workcontrol_api
-- ----------------------------

-- ----------------------------
-- Table structure for workcontrol_code
-- ----------------------------
DROP TABLE IF EXISTS `workcontrol_code`;
CREATE TABLE `workcontrol_code` (
  `code_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `code_name` varchar(255) DEFAULT '',
  `code_condition` varchar(255) DEFAULT '',
  `code_script` text DEFAULT NULL,
  `code_created` timestamp NULL DEFAULT NULL,
  `code_views` decimal(11,0) NOT NULL DEFAULT 0,
  PRIMARY KEY (`code_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of workcontrol_code
-- ----------------------------

-- ----------------------------
-- Table structure for ws_brands
-- ----------------------------
DROP TABLE IF EXISTS `ws_brands`;
CREATE TABLE `ws_brands` (
  `brand_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador da Marca Parceira',
  `brand_name` varchar(255) DEFAULT NULL COMMENT 'Nome da Marca',
  `brand_site` varchar(255) DEFAULT NULL COMMENT 'Site da Marca Parceira',
  `brand_image` varchar(255) DEFAULT NULL COMMENT 'Imagem ou Logo da Marca',
  `brand_datecreate` timestamp NULL DEFAULT NULL COMMENT 'Data de Criação da Marca No Sistema da Marca',
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_brands
-- ----------------------------

-- ----------------------------
-- Table structure for ws_categories
-- ----------------------------
DROP TABLE IF EXISTS `ws_categories`;
CREATE TABLE `ws_categories` (
  `category_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_parent` int(11) unsigned DEFAULT NULL,
  `category_tree` varchar(255) DEFAULT NULL,
  `category_title` varchar(255) DEFAULT NULL,
  `category_content` text DEFAULT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `category_sizes` varchar(255) DEFAULT NULL,
  `category_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_categories
-- ----------------------------
INSERT INTO `ws_categories` VALUES ('1', null, null, 'Fitness', 'Categoria Fitness!', 'fitness', null, '2020-04-04 01:08:40');
INSERT INTO `ws_categories` VALUES ('2', '1', '1', 'Fitness', 'Subcategoria Fitness!', 'fitness-2', null, '2020-04-04 01:08:51');
INSERT INTO `ws_categories` VALUES ('3', null, null, 'Gym', 'Categoria Gym!', 'gym', null, '2020-04-04 01:09:06');
INSERT INTO `ws_categories` VALUES ('4', '3', '3', 'Gym', 'Subcategoria Gym!', 'gym-4', null, '2020-04-04 01:09:18');

-- ----------------------------
-- Table structure for ws_classes
-- ----------------------------
DROP TABLE IF EXISTS `ws_classes`;
CREATE TABLE `ws_classes` (
  `class_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador da Classe',
  `class_image` varchar(255) DEFAULT NULL COMMENT 'Imagem da Classe',
  `class_icon_type` int(11) DEFAULT NULL COMMENT 'Tipo do Ícone da Classe ',
  `class_icon_text` varchar(255) DEFAULT NULL COMMENT 'Texto do Ícone da Classe (Ex.: IcoMoon, Font Awesome e Etc)',
  `class_icon` varchar(255) DEFAULT NULL COMMENT 'Ícone da Classe',
  `class_title` varchar(255) DEFAULT NULL COMMENT 'Título da Classe',
  `class_category` int(11) NOT NULL COMMENT 'Categoria da Classe',
  `class_name` varchar(255) DEFAULT NULL COMMENT 'URL dos Serviços Para Exibição No Site',
  `class_content` text DEFAULT NULL COMMENT 'Descrição da Classe',
  `class_price` decimal(10,2) DEFAULT NULL COMMENT 'Preço da Classe',
  `class_image_one` varchar(255) DEFAULT NULL COMMENT 'Imagem 1',
  `class_image_two` varchar(255) DEFAULT NULL COMMENT 'Imagem 2',
  `class_datecreate` timestamp NULL DEFAULT NULL COMMENT 'Data de Cadastro da Classe No Sistema',
  `class_status` int(11) DEFAULT 0 COMMENT 'Status da Classe No Sistema (0 - Inativa | 1 - Ativa)',
  PRIMARY KEY (`class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_classes
-- ----------------------------
INSERT INTO `ws_classes` VALUES ('1', 'classes/2020/04/kettlebell-image.png', null, null, null, 'KETTLEBELL', '1', 'kettlebell', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s</p>', null, null, null, '2020-04-04 01:16:55', '1');
INSERT INTO `ws_classes` VALUES ('2', 'classes/2020/04/kettlebell-2-image.png', null, null, null, 'KETTLEBELL', '2', 'kettlebell-2', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s</p>', null, null, null, '2020-04-04 01:17:25', '1');
INSERT INTO `ws_classes` VALUES ('3', 'classes/2020/04/striking-image.png', null, null, null, 'STRIKING', '2', 'striking', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s</p>', null, null, null, '2020-04-04 01:17:46', '1');
INSERT INTO `ws_classes` VALUES ('4', 'classes/2020/04/kettlebell-4-image.png', null, null, null, 'KETTLEBELL', '2', 'kettlebell-4', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s</p>', null, null, null, '2020-04-04 01:18:09', '1');
INSERT INTO `ws_classes` VALUES ('5', 'classes/2020/04/weightlifting-image.png', null, null, null, 'WEIGHTLIFTING', '3', 'weightlifting', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s</p>', null, null, null, '2020-04-04 01:18:28', '1');
INSERT INTO `ws_classes` VALUES ('6', 'classes/2020/04/weightlifting-6-image.png', null, null, null, 'WEIGHTLIFTING', '4', 'weightlifting-6', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s</p>', null, null, null, '2020-04-04 01:18:52', '1');
INSERT INTO `ws_classes` VALUES ('7', 'classes/2020/04/conjugate-methods-image.png', null, null, null, 'CONJUGATE METHODS', '4', 'conjugate-methods', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s</p>', null, null, null, '2020-04-04 01:19:16', '1');
INSERT INTO `ws_classes` VALUES ('8', 'classes/2020/04/image.png', null, null, null, 'KETTLEBELL', '5', 'kettlebell-8', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s</p>', null, null, null, '2020-04-04 01:19:35', '1');

-- ----------------------------
-- Table structure for ws_classes_gallery
-- ----------------------------
DROP TABLE IF EXISTS `ws_classes_gallery`;
CREATE TABLE `ws_classes_gallery` (
  `class_id` int(11) unsigned NOT NULL COMMENT 'Identificador do Estilo',
  `class_gallery_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador da Imagem da Galeria',
  `class_gallery_file` varchar(255) NOT NULL COMMENT 'Arquivo de Imagem da Galeria',
  `class_gallery_order` int(11) DEFAULT NULL COMMENT 'Ordenação da Imagem da Galeria',
  `class_gallery_legend` varchar(255) DEFAULT NULL COMMENT 'Legenda da Imagem da Galeria',
  PRIMARY KEY (`class_gallery_id`),
  KEY `wc_classes_gallery` (`class_id`) USING BTREE,
  CONSTRAINT `wc_classes_gallery` FOREIGN KEY (`class_id`) REFERENCES `ws_classes` (`class_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_classes_gallery
-- ----------------------------

-- ----------------------------
-- Table structure for ws_classes_schedules
-- ----------------------------
DROP TABLE IF EXISTS `ws_classes_schedules`;
CREATE TABLE `ws_classes_schedules` (
  `class_id` int(11) unsigned NOT NULL COMMENT 'Identificador da Classe',
  `class_schedule_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador da Agenda da Classe',
  `class_schedule_day` int(11) NOT NULL COMMENT 'Dia do Cadastro do Horário da Classe',
  `class_schedule_start` int(11) DEFAULT NULL COMMENT 'Horário de Início da Manhã da Classe',
  `class_schedule_end` int(11) DEFAULT NULL COMMENT 'Horário de Término da Manhã da Classe',
  PRIMARY KEY (`class_schedule_id`),
  KEY `wc_class_schedules` (`class_id`) USING BTREE,
  CONSTRAINT `wc_class_schedules` FOREIGN KEY (`class_id`) REFERENCES `ws_classes` (`class_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_classes_schedules
-- ----------------------------

-- ----------------------------
-- Table structure for ws_classes_trainees
-- ----------------------------
DROP TABLE IF EXISTS `ws_classes_trainees`;
CREATE TABLE `ws_classes_trainees` (
  `class_id` int(11) unsigned NOT NULL COMMENT 'Identificador da Classe',
  `trainee_id` int(11) unsigned NOT NULL COMMENT 'Identificador do(a) Treinador(a)',
  `class_trainee_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador do Treinador do Tipo da Classe',
  `class_trainee_datecreate` timestamp NULL DEFAULT NULL COMMENT 'Data de Cadastro do Treinador do Tipo da Classe No Sistema',
  PRIMARY KEY (`class_trainee_id`),
  KEY `wc_classes` (`class_id`) USING BTREE,
  KEY `wc_classes_trainees` (`trainee_id`) USING BTREE,
  CONSTRAINT `wc_classes` FOREIGN KEY (`class_id`) REFERENCES `ws_classes` (`class_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `wc_classes_trainees` FOREIGN KEY (`trainee_id`) REFERENCES `ws_trainees` (`trainee_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_classes_trainees
-- ----------------------------

-- ----------------------------
-- Table structure for ws_classes_types
-- ----------------------------
DROP TABLE IF EXISTS `ws_classes_types`;
CREATE TABLE `ws_classes_types` (
  `class_id` int(11) unsigned NOT NULL COMMENT 'Identificador da Classe',
  `class_type_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador do Benefício da Classe',
  `class_type_image` varchar(255) DEFAULT NULL COMMENT 'Identificador da Imagem do Benefício da Classe',
  `class_type_icon_type` int(11) DEFAULT NULL COMMENT 'Tipo do Ícone do Benefício da Classe',
  `class_type_icon_text` varchar(255) DEFAULT NULL COMMENT 'Texto do Ícone do Benefício da Classe (Ex.: IcoMoon, Font Awesome e Etc)',
  `class_type_icon` varchar(255) DEFAULT NULL COMMENT 'Ícone do Benefício da Classe',
  `class_type_title` varchar(255) DEFAULT NULL COMMENT 'Título do Benefício da Classe',
  `class_type_name` varchar(255) DEFAULT NULL COMMENT 'URL do Benefício da Classe',
  `class_type_price` decimal(10,2) NOT NULL COMMENT 'Preço do Tipo da Classe',
  `class_type_content` text DEFAULT NULL COMMENT 'Descrição do Benefício da Classe',
  `class_type_image_one` varchar(255) DEFAULT '' COMMENT 'Imagem 1',
  `class_type_image_two` varchar(255) DEFAULT '' COMMENT 'Imagem 1',
  `class_type_datecreate` timestamp NULL DEFAULT NULL COMMENT 'Data de Cadastro dos Benefícios da Classe No Sistema',
  `class_type_status` int(11) DEFAULT 0 COMMENT 'Data de Cadastro dos Tipos da Classe No Sistema',
  PRIMARY KEY (`class_type_id`),
  KEY `wc_classes_types` (`class_id`) USING BTREE,
  CONSTRAINT `wc_classes_types` FOREIGN KEY (`class_id`) REFERENCES `ws_classes` (`class_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_classes_types
-- ----------------------------

-- ----------------------------
-- Table structure for ws_classes_types_gallery
-- ----------------------------
DROP TABLE IF EXISTS `ws_classes_types_gallery`;
CREATE TABLE `ws_classes_types_gallery` (
  `class_type_id` int(11) unsigned NOT NULL COMMENT 'Identificador do Tipo da Classe',
  `class_type_gallery_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador da Imagem da Galeria',
  `class_type_gallery_file` varchar(255) NOT NULL COMMENT 'Arquivo de Imagem da Galeria',
  `class_type_gallery_order` int(11) DEFAULT NULL COMMENT 'Ordenação da Imagem da Galeria',
  `class_type_gallery_legend` varchar(255) DEFAULT NULL COMMENT 'Legenda da Imagem da Galeria',
  PRIMARY KEY (`class_type_gallery_id`),
  KEY `wc_class_type_gallery` (`class_type_id`),
  CONSTRAINT `wc_class_type_gallery` FOREIGN KEY (`class_type_id`) REFERENCES `ws_classes_types` (`class_type_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_classes_types_gallery
-- ----------------------------

-- ----------------------------
-- Table structure for ws_classes_types_schedules
-- ----------------------------
DROP TABLE IF EXISTS `ws_classes_types_schedules`;
CREATE TABLE `ws_classes_types_schedules` (
  `class_type_id` int(11) unsigned NOT NULL COMMENT 'Identificador do Tipo da Classe',
  `class_type_schedule_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador da Agenda do(a) Treinador(a)',
  `class_type_schedule_day` int(11) NOT NULL COMMENT 'Dia do Cadastro do Horário do(a) Treinador(a)',
  `class_type_schedule_start` int(11) DEFAULT NULL COMMENT 'Horário de Início da Manhã do(a) Treinador(a)',
  `class_type_schedule_end` int(11) DEFAULT NULL COMMENT 'Horário de Término da Manhã do(a) Treinador(a)',
  PRIMARY KEY (`class_type_schedule_id`),
  KEY `wc_class_types_schedules` (`class_type_id`) USING BTREE,
  CONSTRAINT `wc_class_types_schedules` FOREIGN KEY (`class_type_id`) REFERENCES `ws_classes_types` (`class_type_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_classes_types_schedules
-- ----------------------------

-- ----------------------------
-- Table structure for ws_classes_types_trainees
-- ----------------------------
DROP TABLE IF EXISTS `ws_classes_types_trainees`;
CREATE TABLE `ws_classes_types_trainees` (
  `class_type_id` int(11) unsigned NOT NULL COMMENT 'Identificador do Tipo da Classe',
  `trainee_id` int(11) unsigned NOT NULL COMMENT 'Identificador do(a) Treinador(a)',
  `class_type_trainee_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador do Treinador do Tipo da Classe',
  `class_type_trainee_datecreate` timestamp NULL DEFAULT NULL COMMENT 'Data de Cadastro do Treinador do Tipo da Classe No Sistema',
  PRIMARY KEY (`class_type_trainee_id`),
  KEY `fk_class_type` (`class_type_id`) USING BTREE,
  KEY `fk_class_type_trainees` (`trainee_id`) USING BTREE,
  CONSTRAINT `fk_class_type` FOREIGN KEY (`class_type_id`) REFERENCES `ws_classes_types` (`class_type_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_class_type_trainees` FOREIGN KEY (`trainee_id`) REFERENCES `ws_trainees` (`trainee_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_classes_types_trainees
-- ----------------------------

-- ----------------------------
-- Table structure for ws_comments
-- ----------------------------
DROP TABLE IF EXISTS `ws_comments`;
CREATE TABLE `ws_comments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL,
  `post_id` int(11) unsigned DEFAULT NULL,
  `pdt_id` int(11) unsigned DEFAULT NULL,
  `page_id` int(11) unsigned DEFAULT NULL,
  `alias_id` int(11) unsigned DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `rank` decimal(11,0) DEFAULT 1,
  `created` timestamp NULL DEFAULT NULL,
  `interact` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `likes` decimal(11,0) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `wc_comment_user` (`user_id`),
  KEY `wc_comment_pdt` (`pdt_id`),
  KEY `wc_comment_pages` (`page_id`),
  KEY `wc_comment_response` (`alias_id`),
  KEY `wc_comment_post` (`post_id`),
  CONSTRAINT `wc_comment_pages` FOREIGN KEY (`page_id`) REFERENCES `ws_pages` (`page_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `wc_comment_pdt` FOREIGN KEY (`pdt_id`) REFERENCES `ws_products` (`pdt_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `wc_comment_post` FOREIGN KEY (`post_id`) REFERENCES `ws_posts` (`post_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `wc_comment_response` FOREIGN KEY (`alias_id`) REFERENCES `ws_comments` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `wc_comment_user` FOREIGN KEY (`user_id`) REFERENCES `ws_users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_comments
-- ----------------------------

-- ----------------------------
-- Table structure for ws_comments_likes
-- ----------------------------
DROP TABLE IF EXISTS `ws_comments_likes`;
CREATE TABLE `ws_comments_likes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `comm_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `wc_comments` (`comm_id`),
  CONSTRAINT `wc_comments` FOREIGN KEY (`comm_id`) REFERENCES `ws_comments` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_comments_likes
-- ----------------------------

-- ----------------------------
-- Table structure for ws_company
-- ----------------------------
DROP TABLE IF EXISTS `ws_company`;
CREATE TABLE `ws_company` (
  `company_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `company_image` varchar(255) DEFAULT NULL,
  `company_title` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_content` text DEFAULT NULL,
  `company_segment` varchar(255) DEFAULT NULL,
  `company_responsible` varchar(255) DEFAULT NULL,
  `company_document` varchar(255) DEFAULT NULL,
  `company_opening` varchar(255) DEFAULT NULL,
  `company_telephone` varchar(255) DEFAULT NULL,
  `company_cell` varchar(255) DEFAULT NULL,
  `company_email` varchar(255) DEFAULT NULL,
  `company_site` varchar(255) DEFAULT NULL,
  `company_zipcode` varchar(255) DEFAULT NULL,
  `company_street` varchar(255) DEFAULT NULL,
  `company_number` varchar(255) DEFAULT NULL,
  `company_complement` varchar(255) DEFAULT NULL,
  `company_district` varchar(255) DEFAULT NULL,
  `company_city` varchar(255) DEFAULT NULL,
  `company_state` varchar(2) DEFAULT NULL,
  `company_country` varchar(255) DEFAULT NULL,
  `company_facebook` varchar(255) DEFAULT NULL,
  `company_twitter` varchar(255) DEFAULT NULL,
  `company_youtube` varchar(255) DEFAULT NULL,
  `company_instagram` varchar(255) DEFAULT NULL,
  `company_mission` varchar(255) DEFAULT NULL,
  `company_view` varchar(255) DEFAULT NULL,
  `company_values` varchar(255) DEFAULT NULL,
  `company_status` int(11) NOT NULL DEFAULT 0,
  `company_datecreated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_company
-- ----------------------------

-- ----------------------------
-- Table structure for ws_company_blocks
-- ----------------------------
DROP TABLE IF EXISTS `ws_company_blocks`;
CREATE TABLE `ws_company_blocks` (
  `company_id` int(11) unsigned NOT NULL,
  `block_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `block_title` varchar(255) DEFAULT NULL,
  `block_icon` varchar(255) DEFAULT NULL,
  `block_name` varchar(255) DEFAULT NULL,
  `block_image` varchar(255) DEFAULT NULL,
  `block_content` text DEFAULT NULL,
  `block_status` int(11) NOT NULL DEFAULT 0,
  `block_datecreate` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`block_id`),
  KEY `wc_company_blocks` (`company_id`),
  CONSTRAINT `wc_company_blocks` FOREIGN KEY (`company_id`) REFERENCES `ws_company` (`company_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_company_blocks
-- ----------------------------

-- ----------------------------
-- Table structure for ws_company_differentials
-- ----------------------------
DROP TABLE IF EXISTS `ws_company_differentials`;
CREATE TABLE `ws_company_differentials` (
  `company_id` int(11) unsigned NOT NULL,
  `differential_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `differential_title` varchar(255) DEFAULT NULL,
  `differential_content` text DEFAULT NULL,
  `differential_image` varchar(255) DEFAULT NULL,
  `differential_icon_type` int(11) DEFAULT NULL,
  `differential_icon_text` varchar(255) DEFAULT NULL,
  `differential_icon` varchar(255) DEFAULT NULL,
  `differential_datecreate` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`differential_id`),
  KEY `wc_company_differentials` (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_company_differentials
-- ----------------------------

-- ----------------------------
-- Table structure for ws_company_faq
-- ----------------------------
DROP TABLE IF EXISTS `ws_company_faq`;
CREATE TABLE `ws_company_faq` (
  `company_id` int(11) unsigned DEFAULT NULL COMMENT 'Identificador da Empresa',
  `faq_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador da FAQ',
  `faq_title` varchar(255) DEFAULT NULL COMMENT 'Título da FAQ',
  `faq_content` text DEFAULT NULL COMMENT 'Descrição da FAQ',
  `faq_datecreate` timestamp NULL DEFAULT NULL COMMENT 'Data de Criação da FAQ No Sistema',
  PRIMARY KEY (`faq_id`),
  KEY `wc_company_faq` (`company_id`),
  CONSTRAINT `wc_company_faq` FOREIGN KEY (`company_id`) REFERENCES `ws_company` (`company_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_company_faq
-- ----------------------------

-- ----------------------------
-- Table structure for ws_company_gallery
-- ----------------------------
DROP TABLE IF EXISTS `ws_company_gallery`;
CREATE TABLE `ws_company_gallery` (
  `company_id` int(10) unsigned NOT NULL,
  `gallery_image_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `gallery_file` varchar(255) NOT NULL,
  `gallery_image_order` int(11) DEFAULT NULL,
  `gallery_image_legend` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`gallery_image_id`),
  KEY `wc_company` (`company_id`),
  CONSTRAINT `wc_company` FOREIGN KEY (`company_id`) REFERENCES `ws_company` (`company_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `wc_company_differentials` FOREIGN KEY (`company_id`) REFERENCES `ws_company` (`company_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_company_gallery
-- ----------------------------

-- ----------------------------
-- Table structure for ws_config
-- ----------------------------
DROP TABLE IF EXISTS `ws_config`;
CREATE TABLE `ws_config` (
  `conf_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `conf_key` varchar(255) DEFAULT '',
  `conf_value` varchar(255) DEFAULT '',
  `conf_type` varchar(255) DEFAULT '',
  PRIMARY KEY (`conf_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4704 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_config
-- ----------------------------
INSERT INTO `ws_config` VALUES ('4490', 'BASE', 'http://localhost/gym', 'ADMIN');
INSERT INTO `ws_config` VALUES ('4491', 'THEME', 'gym', 'ADMIN');
INSERT INTO `ws_config` VALUES ('4494', 'ADMIN_NAME', 'Work Control', 'ADMIN');
INSERT INTO `ws_config` VALUES ('4495', 'ADMIN_DESC', 'O Work Control é um sistema de gestão de conteúdo profissional gerido pela turma de alunos Work Series da UpInside Treinamentos!', 'ADMIN');
INSERT INTO `ws_config` VALUES ('4496', 'ADMIN_MODE', '1', 'ADMIN');
INSERT INTO `ws_config` VALUES ('4497', 'ADMIN_WC_CUSTOM', '1', 'ADMIN');
INSERT INTO `ws_config` VALUES ('4498', 'ADMIN_MAINTENANCE', '0', 'ADMIN');
INSERT INTO `ws_config` VALUES ('4499', 'ADMIN_VERSION', '3.1.4', 'ADMIN');
INSERT INTO `ws_config` VALUES ('4500', 'MAIL_HOST', '', 'MAIL');
INSERT INTO `ws_config` VALUES ('4501', 'MAIL_PORT', '', 'MAIL');
INSERT INTO `ws_config` VALUES ('4502', 'MAIL_USER', '', 'MAIL');
INSERT INTO `ws_config` VALUES ('4503', 'MAIL_SMTP', '', 'MAIL');
INSERT INTO `ws_config` VALUES ('4504', 'MAIL_PASS', '', 'MAIL');
INSERT INTO `ws_config` VALUES ('4505', 'MAIL_SENDER', '', 'MAIL');
INSERT INTO `ws_config` VALUES ('4506', 'MAIL_MODE', '', 'MAIL');
INSERT INTO `ws_config` VALUES ('4507', 'MAIL_TESTER', '', 'MAIL');
INSERT INTO `ws_config` VALUES ('4508', 'IMAGE_W', '1600', 'IMAGE');
INSERT INTO `ws_config` VALUES ('4509', 'IMAGE_H', '800', 'IMAGE');
INSERT INTO `ws_config` VALUES ('4510', 'THUMB_W', '800', 'IMAGE');
INSERT INTO `ws_config` VALUES ('4511', 'THUMB_H', '1000', 'IMAGE');
INSERT INTO `ws_config` VALUES ('4512', 'AVATAR_W', '500', 'IMAGE');
INSERT INTO `ws_config` VALUES ('4513', 'AVATAR_H', '500', 'IMAGE');
INSERT INTO `ws_config` VALUES ('4514', 'SLIDE_W', '1920', 'IMAGE');
INSERT INTO `ws_config` VALUES ('4515', 'SLIDE_H', '600', 'IMAGE');
INSERT INTO `ws_config` VALUES ('4516', 'APP_POSTS', '1', 'APP');
INSERT INTO `ws_config` VALUES ('4517', 'APP_POSTS_AMP', '0', 'APP');
INSERT INTO `ws_config` VALUES ('4518', 'APP_POSTS_INSTANT_ARTICLE', '0', 'APP');
INSERT INTO `ws_config` VALUES ('4519', 'APP_EAD', '0', 'APP');
INSERT INTO `ws_config` VALUES ('4520', 'APP_SEARCH', '1', 'APP');
INSERT INTO `ws_config` VALUES ('4521', 'APP_PAGES', '1', 'APP');
INSERT INTO `ws_config` VALUES ('4522', 'APP_COMMENTS', '1', 'APP');
INSERT INTO `ws_config` VALUES ('4523', 'APP_PRODUCTS', '0', 'APP');
INSERT INTO `ws_config` VALUES ('4524', 'APP_ORDERS', '0', 'APP');
INSERT INTO `ws_config` VALUES ('4525', 'APP_IMOBI', '0', 'APP');
INSERT INTO `ws_config` VALUES ('4526', 'APP_SLIDE', '1', 'APP');
INSERT INTO `ws_config` VALUES ('4527', 'APP_USERS', '1', 'APP');
INSERT INTO `ws_config` VALUES ('4528', 'FBREVIEW_PAGE_ID', '', 'FBREVIEW');
INSERT INTO `ws_config` VALUES ('4529', 'FBREVIEW_APP_ID', '', 'FBREVIEW');
INSERT INTO `ws_config` VALUES ('4530', 'FBREVIEW_APP_SECRET', '', 'FBREVIEW');
INSERT INTO `ws_config` VALUES ('4531', 'FBREVIEW_LIMIT', '25', 'FBREVIEW');
INSERT INTO `ws_config` VALUES ('4532', 'APP_GALLERY', '1', 'APP');
INSERT INTO `ws_config` VALUES ('4533', 'APP_VIDEOS', '1', 'APP');
INSERT INTO `ws_config` VALUES ('4534', 'APP_CONTACTS', '1', 'APP');
INSERT INTO `ws_config` VALUES ('4535', 'APP_FAQ', '1', 'APP');
INSERT INTO `ws_config` VALUES ('4536', 'APP_TESTIMONIALS', '1', 'APP');
INSERT INTO `ws_config` VALUES ('4537', 'APP_FBREVIEW', '1', 'APP');
INSERT INTO `ws_config` VALUES ('4538', 'APP_TUTORIAIS', '1', 'APP');
INSERT INTO `ws_config` VALUES ('4539', 'APP_COMPANY', '1', 'APP');
INSERT INTO `ws_config` VALUES ('4540', 'APP_BRANDS', '1', 'APP');
INSERT INTO `ws_config` VALUES ('4541', 'APP_TRAINEES', '1', 'APP');
INSERT INTO `ws_config` VALUES ('4542', 'APP_SERVICES', '1', 'APP');
INSERT INTO `ws_config` VALUES ('4543', 'APP_CLASSES', '1', 'APP');
INSERT INTO `ws_config` VALUES ('4544', 'APP_SCHEDULES', '1', 'APP');
INSERT INTO `ws_config` VALUES ('4545', 'APP_PLANS', '1', 'APP');
INSERT INTO `ws_config` VALUES ('4546', 'APP_OFFERS', '1', 'APP');
INSERT INTO `ws_config` VALUES ('4547', 'LEVEL_WC_POSTS', '6', 'LEVEL');
INSERT INTO `ws_config` VALUES ('4548', 'LEVEL_WC_COMMENTS', '6', 'LEVEL');
INSERT INTO `ws_config` VALUES ('4549', 'LEVEL_WC_PAGES', '6', 'LEVEL');
INSERT INTO `ws_config` VALUES ('4550', 'LEVEL_WC_SLIDES', '6', 'LEVEL');
INSERT INTO `ws_config` VALUES ('4551', 'LEVEL_WC_IMOBI', '6', 'LEVEL');
INSERT INTO `ws_config` VALUES ('4552', 'LEVEL_WC_PRODUCTS', '6', 'LEVEL');
INSERT INTO `ws_config` VALUES ('4553', 'LEVEL_WC_PRODUCTS_ORDERS', '6', 'LEVEL');
INSERT INTO `ws_config` VALUES ('4554', 'LEVEL_WC_EAD_COURSES', '6', 'LEVEL');
INSERT INTO `ws_config` VALUES ('4555', 'LEVEL_WC_EAD_STUDENTS', '6', 'LEVEL');
INSERT INTO `ws_config` VALUES ('4556', 'LEVEL_WC_EAD_SUPPORT', '6', 'LEVEL');
INSERT INTO `ws_config` VALUES ('4557', 'LEVEL_WC_EAD_ORDERS', '6', 'LEVEL');
INSERT INTO `ws_config` VALUES ('4558', 'LEVEL_WC_REPORTS', '6', 'LEVEL');
INSERT INTO `ws_config` VALUES ('4559', 'LEVEL_WC_USERS', '6', 'LEVEL');
INSERT INTO `ws_config` VALUES ('4560', 'LEVEL_WC_CONFIG_MASTER', '10', 'LEVEL');
INSERT INTO `ws_config` VALUES ('4561', 'LEVEL_WC_CONFIG_API', '10', 'LEVEL');
INSERT INTO `ws_config` VALUES ('4562', 'LEVEL_WC_CONFIG_CODES', '10', 'LEVEL');
INSERT INTO `ws_config` VALUES ('4563', 'LEVEL_WC_HELLO', '6', 'LEVEL');
INSERT INTO `ws_config` VALUES ('4564', 'LEVEL_WC_GALLERY', '6', 'LEVEL');
INSERT INTO `ws_config` VALUES ('4565', 'LEVEL_WC_VIDEOS', '6', 'LEVEL');
INSERT INTO `ws_config` VALUES ('4566', 'LEVEL_WC_CONTACTS', '6', 'LEVEL');
INSERT INTO `ws_config` VALUES ('4567', 'LEVEL_WC_FAQ', '6', 'LEVEL');
INSERT INTO `ws_config` VALUES ('4568', 'LEVEL_WC_TESTIMONIALS', '6', 'LEVEL');
INSERT INTO `ws_config` VALUES ('4569', 'LEVEL_WC_FBREVIEWS', '6', 'LEVEL');
INSERT INTO `ws_config` VALUES ('4570', 'LEVEL_WC_TUTORIAIS', '6', 'LEVEL');
INSERT INTO `ws_config` VALUES ('4571', 'LEVEL_WC_COMPANY', '8', 'LEVEL');
INSERT INTO `ws_config` VALUES ('4572', 'LEVEL_WC_BRANDS', '6', 'LEVEL');
INSERT INTO `ws_config` VALUES ('4573', 'LEVEL_WC_TRAINEES', '6', 'LEVEL');
INSERT INTO `ws_config` VALUES ('4574', 'LEVEL_WC_SERVICES', '6', 'LEVEL');
INSERT INTO `ws_config` VALUES ('4575', 'LEVEL_WC_CLASSES', '6', 'LEVEL');
INSERT INTO `ws_config` VALUES ('4576', 'LEVEL_WC_SCHEDULES', '6', 'LEVEL');
INSERT INTO `ws_config` VALUES ('4577', 'LEVEL_WC_PLANS', '6', 'LEVEL');
INSERT INTO `ws_config` VALUES ('4578', 'LEVEL_WC_OFFERS', '6', 'LEVEL');
INSERT INTO `ws_config` VALUES ('4579', 'SEGMENT_FB_PIXEL_ID', '', 'SEGMENT');
INSERT INTO `ws_config` VALUES ('4580', 'SEGMENT_WC_USER', '', 'SEGMENT');
INSERT INTO `ws_config` VALUES ('4581', 'SEGMENT_WC_BLOG', '', 'SEGMENT');
INSERT INTO `ws_config` VALUES ('4582', 'SEGMENT_WC_ECOMMERCE', '', 'SEGMENT');
INSERT INTO `ws_config` VALUES ('4583', 'SEGMENT_WC_IMOBI', '', 'SEGMENT');
INSERT INTO `ws_config` VALUES ('4584', 'SEGMENT_WC_EAD', '', 'SEGMENT');
INSERT INTO `ws_config` VALUES ('4585', 'SEGMENT_GL_ANALYTICS_UA', '', 'SEGMENT');
INSERT INTO `ws_config` VALUES ('4586', 'SEGMENT_FB_PAGE_ID', '', 'SEGMENT');
INSERT INTO `ws_config` VALUES ('4587', 'SEGMENT_GL_ADWORDS_ID', '', 'SEGMENT');
INSERT INTO `ws_config` VALUES ('4588', 'SEGMENT_GL_ADWORDS_LABEL', '', 'SEGMENT');
INSERT INTO `ws_config` VALUES ('4589', 'APP_LINK_POSTS', '1', 'APP');
INSERT INTO `ws_config` VALUES ('4590', 'APP_LINK_PAGES', '1', 'APP');
INSERT INTO `ws_config` VALUES ('4591', 'APP_LINK_PRODUCTS', '1', 'APP');
INSERT INTO `ws_config` VALUES ('4592', 'APP_LINK_PROPERTIES', '1', 'APP');
INSERT INTO `ws_config` VALUES ('4593', 'ACC_MANAGER', '1', 'APP');
INSERT INTO `ws_config` VALUES ('4594', 'ACC_TAG', 'Minha Conta!', 'APP');
INSERT INTO `ws_config` VALUES ('4595', 'COMMENT_MODERATE', '1', 'COMMENT');
INSERT INTO `ws_config` VALUES ('4596', 'COMMENT_ON_POSTS', '1', 'COMMENT');
INSERT INTO `ws_config` VALUES ('4597', 'COMMENT_ON_PAGES', '1', 'COMMENT');
INSERT INTO `ws_config` VALUES ('4598', 'COMMENT_ON_PRODUCTS', '1', 'COMMENT');
INSERT INTO `ws_config` VALUES ('4599', 'COMMENT_SEND_EMAIL', '1', 'COMMENT');
INSERT INTO `ws_config` VALUES ('4600', 'COMMENT_ORDER', 'DESC', 'COMMENT');
INSERT INTO `ws_config` VALUES ('4601', 'COMMENT_RESPONSE_ORDER', 'ASC', 'COMMENT');
INSERT INTO `ws_config` VALUES ('4602', 'E_PDT_LIMIT', '', 'ECOMMERCE');
INSERT INTO `ws_config` VALUES ('4603', 'E_PDT_SIZE', 'default', 'ECOMMERCE');
INSERT INTO `ws_config` VALUES ('4604', 'E_ORDER_DAYS', '', 'ECOMMERCE');
INSERT INTO `ws_config` VALUES ('4605', 'ECOMMERCE_TAG', 'Minhas Compras', 'ECOMMERCE');
INSERT INTO `ws_config` VALUES ('4606', 'ECOMMERCE_STOCK', '', 'ECOMMERCE');
INSERT INTO `ws_config` VALUES ('4607', 'ECOMMERCE_BUTTON_TAG', 'Comprar Agora', 'ECOMMERCE');
INSERT INTO `ws_config` VALUES ('4608', 'ECOMMERCE_PAY_SPLIT', '1', 'ECOMMERCE');
INSERT INTO `ws_config` VALUES ('4609', 'ECOMMERCE_PAY_SPLIT_MIN', '5', 'ECOMMERCE');
INSERT INTO `ws_config` VALUES ('4610', 'ECOMMERCE_PAY_SPLIT_NUM', '12', 'ECOMMERCE');
INSERT INTO `ws_config` VALUES ('4611', 'ECOMMERCE_PAY_SPLIT_ACM', '2.99', 'ECOMMERCE');
INSERT INTO `ws_config` VALUES ('4612', 'ECOMMERCE_PAY_SPLIT_ACN', '1', 'ECOMMERCE');
INSERT INTO `ws_config` VALUES ('4613', 'ECOMMERCE_SHIPMENT_FREE', '0', 'ECOMMERCE');
INSERT INTO `ws_config` VALUES ('4614', 'ECOMMERCE_SHIPMENT_FREE_DAYS', '20', 'ECOMMERCE');
INSERT INTO `ws_config` VALUES ('4615', 'ECOMMERCE_SHIPMENT_FIXED', '0', 'ECOMMERCE');
INSERT INTO `ws_config` VALUES ('4616', 'ECOMMERCE_SHIPMENT_FIXED_PRICE', '15', 'ECOMMERCE');
INSERT INTO `ws_config` VALUES ('4617', 'ECOMMERCE_SHIPMENT_FIXED_DAYS', '15', 'ECOMMERCE');
INSERT INTO `ws_config` VALUES ('4618', 'ECOMMERCE_SHIPMENT_LOCAL', '0', 'ECOMMERCE');
INSERT INTO `ws_config` VALUES ('4619', 'ECOMMERCE_SHIPMENT_LOCAL_IN_PLACE', '1', 'ECOMMERCE');
INSERT INTO `ws_config` VALUES ('4620', 'ECOMMERCE_SHIPMENT_LOCAL_PRICE', '5', 'ECOMMERCE');
INSERT INTO `ws_config` VALUES ('4621', 'ECOMMERCE_SHIPMENT_LOCAL_DAYS', '1', 'ECOMMERCE');
INSERT INTO `ws_config` VALUES ('4622', 'ECOMMERCE_SHIPMENT_CDEMPRESA', '0', 'ECOMMERCE');
INSERT INTO `ws_config` VALUES ('4623', 'ECOMMERCE_SHIPMENT_CDSENHA', '0', 'ECOMMERCE');
INSERT INTO `ws_config` VALUES ('4624', 'ECOMMERCE_SHIPMENT_SERVICE', '04014,04510', 'ECOMMERCE');
INSERT INTO `ws_config` VALUES ('4625', 'ECOMMERCE_SHIPMENT_DELAY', '3', 'ECOMMERCE');
INSERT INTO `ws_config` VALUES ('4626', 'ECOMMERCE_SHIPMENT_FORMAT', '1', 'ECOMMERCE');
INSERT INTO `ws_config` VALUES ('4627', 'ECOMMERCE_SHIPMENT_DECLARE', '1', 'ECOMMERCE');
INSERT INTO `ws_config` VALUES ('4628', 'ECOMMERCE_SHIPMENT_OWN_HAND', 's', 'ECOMMERCE');
INSERT INTO `ws_config` VALUES ('4629', 'ECOMMERCE_SHIPMENT_BY_WEIGHT', '1', 'ECOMMERCE');
INSERT INTO `ws_config` VALUES ('4630', 'ECOMMERCE_SHIPMENT_ALERT', '0', 'ECOMMERCE');
INSERT INTO `ws_config` VALUES ('4631', 'ECOMMERCE_SHIPMENT_COMPANY', '0', 'ECOMMERCE');
INSERT INTO `ws_config` VALUES ('4632', 'ECOMMERCE_SHIPMENT_COMPANY_VAL', '5', 'ECOMMERCE');
INSERT INTO `ws_config` VALUES ('4633', 'ECOMMERCE_SHIPMENT_COMPANY_PRICE', '30', 'ECOMMERCE');
INSERT INTO `ws_config` VALUES ('4634', 'ECOMMERCE_SHIPMENT_COMPANY_DAYS', '15', 'ECOMMERCE');
INSERT INTO `ws_config` VALUES ('4635', 'ECOMMERCE_SHIPMENT_COMPANY_LINK', 'http://www.dhl.com.br/pt/express/rastreamento.html?AWB=', 'ECOMMERCE');
INSERT INTO `ws_config` VALUES ('4636', 'PAGSEGURO_ENV', 'sandbox', 'PAGSEGURO');
INSERT INTO `ws_config` VALUES ('4637', 'PAGSEGURO_EMAIL', '', 'PAGSEGURO');
INSERT INTO `ws_config` VALUES ('4638', 'PAGSEGURO_NOTIFICATION_EMAIL', '', 'PAGSEGURO');
INSERT INTO `ws_config` VALUES ('4639', 'PAGSEGURO_TOKEN_SANDBOX', '', 'PAGSEGURO');
INSERT INTO `ws_config` VALUES ('4640', 'PAGSEGURO_APP_ID_SANDBOX', '', 'PAGSEGURO');
INSERT INTO `ws_config` VALUES ('4641', 'PAGSEGURO_APP_KEY_SANDBOX', '', 'PAGSEGURO');
INSERT INTO `ws_config` VALUES ('4642', 'PAGSEGURO_TOKEN_PRODUCTION', '', 'PAGSEGURO');
INSERT INTO `ws_config` VALUES ('4643', 'PAGSEGURO_APP_ID_PRODUCTION', '', 'PAGSEGURO');
INSERT INTO `ws_config` VALUES ('4644', 'PAGSEGURO_APP_KEY_PRODUCTION', '', 'PAGSEGURO');
INSERT INTO `ws_config` VALUES ('4645', 'EAD_REGISTER', '0', 'EAD');
INSERT INTO `ws_config` VALUES ('4646', 'EAD_HOTMART_EMAIL', '0', 'EAD');
INSERT INTO `ws_config` VALUES ('4647', 'EAD_HOTMART_TOKEN', '0', 'EAD');
INSERT INTO `ws_config` VALUES ('4648', 'EAD_HOTMART_NEGATIVATE', '0', 'EAD');
INSERT INTO `ws_config` VALUES ('4649', 'EAD_HOTMART_LOG', '0', 'EAD');
INSERT INTO `ws_config` VALUES ('4650', 'EAD_TASK_SUPPORT_DEFAULT', '1', 'EAD');
INSERT INTO `ws_config` VALUES ('4651', 'EAD_TASK_SUPPORT_EMAIL', 'suporte@seusite.com.br', 'EAD');
INSERT INTO `ws_config` VALUES ('4652', 'EAD_TASK_SUPPORT_MODERATE', '0', 'EAD');
INSERT INTO `ws_config` VALUES ('4653', 'EAD_TASK_SUPPORT_STUDENT_RESPONSE', '0', 'EAD');
INSERT INTO `ws_config` VALUES ('4654', 'EAD_TASK_SUPPORT_PENDING_REVIEW', '0', 'EAD');
INSERT INTO `ws_config` VALUES ('4655', 'EAD_TASK_SUPPORT_REPLY_PUBLISH', '0', 'EAD');
INSERT INTO `ws_config` VALUES ('4656', 'EAD_TASK_SUPPORT_LEVEL_DELETE', '10', 'EAD');
INSERT INTO `ws_config` VALUES ('4657', 'EAD_STUDENT_CERTIFICATION', '1', 'EAD');
INSERT INTO `ws_config` VALUES ('4658', 'EAD_STUDENT_MULTIPLE_LOGIN', '1', 'EAD');
INSERT INTO `ws_config` VALUES ('4659', 'EAD_STUDENT_MULTIPLE_LOGIN_BLOCK', '0', 'EAD');
INSERT INTO `ws_config` VALUES ('4660', 'EAD_STUDENT_CLASS_PERCENT', '100', 'EAD');
INSERT INTO `ws_config` VALUES ('4661', 'EAD_STUDENT_CLASS_AUTO_CHECK', '0', 'EAD');
INSERT INTO `ws_config` VALUES ('4662', 'AGENCY_CONTACT', '', 'AGENCY');
INSERT INTO `ws_config` VALUES ('4663', 'AGENCY_EMAIL', '', 'AGENCY');
INSERT INTO `ws_config` VALUES ('4664', 'AGENCY_PHONE', '', 'AGENCY');
INSERT INTO `ws_config` VALUES ('4665', 'AGENCY_URL', '', 'AGENCY');
INSERT INTO `ws_config` VALUES ('4666', 'AGENCY_NAME', '', 'AGENCY');
INSERT INTO `ws_config` VALUES ('4667', 'AGENCY_ADDR', '', 'AGENCY');
INSERT INTO `ws_config` VALUES ('4668', 'AGENCY_CITY', '', 'AGENCY');
INSERT INTO `ws_config` VALUES ('4669', 'AGENCY_UF', '', 'AGENCY');
INSERT INTO `ws_config` VALUES ('4670', 'AGENCY_ZIP', '', 'AGENCY');
INSERT INTO `ws_config` VALUES ('4671', 'AGENCY_COUNTRY', '', 'AGENCY');
INSERT INTO `ws_config` VALUES ('4672', 'SITE_NAME', 'Work Control', 'SITE');
INSERT INTO `ws_config` VALUES ('4673', 'SITE_SUBNAME', 'professional control panel', 'SITE');
INSERT INTO `ws_config` VALUES ('4674', 'SITE_DESC', 'Um painel completo de fácil implementação criado para a turma do curso da UpInside, Work Series - Projeto e Produção!', 'SITE');
INSERT INTO `ws_config` VALUES ('4675', 'SITE_FONT_NAME', 'Open Sans', 'SITE');
INSERT INTO `ws_config` VALUES ('4676', 'SITE_FONT_WHIGHT', '300,400,600,700,800', 'SITE');
INSERT INTO `ws_config` VALUES ('4677', 'SITE_ADDR_NAME', 'Work Control Pro Painel', 'SITE_ADDR');
INSERT INTO `ws_config` VALUES ('4678', 'SITE_ADDR_RS', 'Work Control', 'SITE_ADDR');
INSERT INTO `ws_config` VALUES ('4679', 'SITE_ADDR_EMAIL', 'contato@worcontrol.com.br', 'SITE_ADDR');
INSERT INTO `ws_config` VALUES ('4680', 'SITE_ADDR_SITE', 'www.workcontrol.com.br', 'SITE_ADDR');
INSERT INTO `ws_config` VALUES ('4681', 'SITE_ADDR_CNPJ', '00.000.000/0000-00', 'SITE_ADDR');
INSERT INTO `ws_config` VALUES ('4682', 'SITE_ADDR_IE', '000/0000000', 'SITE_ADDR');
INSERT INTO `ws_config` VALUES ('4683', 'SITE_ADDR_PHONE_A', '(48) 3371-5879', 'SITE_ADDR');
INSERT INTO `ws_config` VALUES ('4684', 'SITE_ADDR_PHONE_B', '(48) 8847-2629', 'SITE_ADDR');
INSERT INTO `ws_config` VALUES ('4685', 'SITE_ADDR_ADDR', 'Av Marcechal Floriano Peixoto, 1001', 'SITE_ADDR');
INSERT INTO `ws_config` VALUES ('4686', 'SITE_ADDR_CITY', 'São Paulo', 'SITE_ADDR');
INSERT INTO `ws_config` VALUES ('4687', 'SITE_ADDR_DISTRICT', 'Centro', 'SITE_ADDR');
INSERT INTO `ws_config` VALUES ('4688', 'SITE_ADDR_UF', 'SP', 'SITE_ADDR');
INSERT INTO `ws_config` VALUES ('4689', 'SITE_ADDR_ZIP', '99500-001', 'SITE_ADDR');
INSERT INTO `ws_config` VALUES ('4690', 'SITE_ADDR_COUNTRY', 'Brasil', 'SITE_ADDR');
INSERT INTO `ws_config` VALUES ('4691', 'SITE_SOCIAL_NAME', 'Robson V. Leite', 'SOCIAL');
INSERT INTO `ws_config` VALUES ('4692', 'SITE_SOCIAL_GOOGLE', '1', 'SOCIAL');
INSERT INTO `ws_config` VALUES ('4693', 'SITE_SOCIAL_GOOGLE_AUTHOR', '103958419096641225872', 'SOCIAL');
INSERT INTO `ws_config` VALUES ('4694', 'SITE_SOCIAL_GOOGLE_PAGE', '107305124528362639842', 'SOCIAL');
INSERT INTO `ws_config` VALUES ('4695', 'SITE_SOCIAL_FB', '1', 'SOCIAL');
INSERT INTO `ws_config` VALUES ('4696', 'SITE_SOCIAL_FB_APP', '0', 'SOCIAL');
INSERT INTO `ws_config` VALUES ('4697', 'SITE_SOCIAL_FB_AUTHOR', 'robvleite', 'SOCIAL');
INSERT INTO `ws_config` VALUES ('4698', 'SITE_SOCIAL_FB_PAGE', 'robsonvleite', 'SOCIAL');
INSERT INTO `ws_config` VALUES ('4699', 'SITE_SOCIAL_TWITTER', 'robsonvleite', 'SOCIAL');
INSERT INTO `ws_config` VALUES ('4700', 'SITE_SOCIAL_YOUTUBE', 'upinsidebr', 'SOCIAL');
INSERT INTO `ws_config` VALUES ('4701', 'SITE_SOCIAL_INSTAGRAM', 'robsonvleite', 'SOCIAL');
INSERT INTO `ws_config` VALUES ('4702', 'SITE_SOCIAL_LINKEDIN', 'robsonvleite', 'SOCIAL');
INSERT INTO `ws_config` VALUES ('4703', 'SITE_SOCIAL_SNAPCHAT', 'robsonvleite', 'SOCIAL');

-- ----------------------------
-- Table structure for ws_contacts
-- ----------------------------
DROP TABLE IF EXISTS `ws_contacts`;
CREATE TABLE `ws_contacts` (
  `contact_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `contact_name` varchar(255) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `contact_telephone` varchar(255) DEFAULT NULL,
  `contact_datecreate` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`contact_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_contacts
-- ----------------------------

-- ----------------------------
-- Table structure for ws_ead_classes
-- ----------------------------
DROP TABLE IF EXISTS `ws_ead_classes`;
CREATE TABLE `ws_ead_classes` (
  `course_id` int(11) unsigned DEFAULT NULL,
  `module_id` int(11) unsigned DEFAULT NULL,
  `class_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `class_title` varchar(255) DEFAULT NULL,
  `class_name` varchar(255) DEFAULT NULL,
  `class_video` varchar(255) DEFAULT NULL,
  `class_time` decimal(10,0) DEFAULT NULL,
  `class_order` int(11) DEFAULT NULL,
  `class_material` varchar(255) DEFAULT NULL,
  `class_desc` text DEFAULT NULL,
  `class_support` int(11) DEFAULT NULL,
  `class_created` timestamp NULL DEFAULT NULL,
  `class_updated` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`class_id`),
  KEY `wc_class_module` (`module_id`),
  KEY `ws_class_order` (`course_id`),
  CONSTRAINT `wc_class_module` FOREIGN KEY (`module_id`) REFERENCES `ws_ead_modules` (`module_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `ws_class_order` FOREIGN KEY (`course_id`) REFERENCES `ws_ead_courses` (`course_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_ead_classes
-- ----------------------------

-- ----------------------------
-- Table structure for ws_ead_courses
-- ----------------------------
DROP TABLE IF EXISTS `ws_ead_courses`;
CREATE TABLE `ws_ead_courses` (
  `course_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `course_author` int(11) unsigned DEFAULT NULL,
  `course_segment` int(11) unsigned DEFAULT NULL,
  `course_title` varchar(255) DEFAULT NULL,
  `course_headline` varchar(255) DEFAULT NULL,
  `course_desc` text DEFAULT NULL,
  `course_name` varchar(255) DEFAULT NULL,
  `course_cover` varchar(255) DEFAULT NULL,
  `course_created` timestamp NULL DEFAULT NULL,
  `course_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `course_status` int(11) NOT NULL DEFAULT 0,
  `course_order` int(11) DEFAULT NULL,
  `course_vendor_id` int(11) DEFAULT NULL,
  `course_vendor_access` int(11) DEFAULT NULL,
  `course_vendor_price` decimal(11,2) DEFAULT NULL,
  `course_vendor_page` varchar(255) DEFAULT NULL,
  `course_vendor_checkout` varchar(255) DEFAULT NULL,
  `course_vendor_renew` varchar(255) DEFAULT NULL,
  `course_certification_workload` int(11) DEFAULT NULL,
  `course_certification_request` int(11) DEFAULT NULL,
  `course_certification_mockup` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`course_id`),
  KEY `wc_course_author` (`course_author`),
  KEY `wc_course_segment` (`course_segment`),
  CONSTRAINT `wc_course_author` FOREIGN KEY (`course_author`) REFERENCES `ws_users` (`user_id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `wc_course_segment` FOREIGN KEY (`course_segment`) REFERENCES `ws_ead_courses_segments` (`segment_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_ead_courses
-- ----------------------------

-- ----------------------------
-- Table structure for ws_ead_courses_bonus
-- ----------------------------
DROP TABLE IF EXISTS `ws_ead_courses_bonus`;
CREATE TABLE `ws_ead_courses_bonus` (
  `course_id` int(11) unsigned DEFAULT NULL,
  `bonus_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `bonus_course_id` int(11) unsigned DEFAULT NULL,
  `bonus_ever` int(11) DEFAULT NULL,
  `bonus_ever_date` date DEFAULT NULL,
  `bonus_wait` int(11) DEFAULT NULL,
  PRIMARY KEY (`bonus_id`),
  KEY `wc_ead_course_bonus` (`course_id`),
  KEY `wc_ead_bonus_id` (`bonus_course_id`),
  CONSTRAINT `wc_ead_bonus_id` FOREIGN KEY (`bonus_course_id`) REFERENCES `ws_ead_courses` (`course_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `wc_ead_course_bonus` FOREIGN KEY (`course_id`) REFERENCES `ws_ead_courses` (`course_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_ead_courses_bonus
-- ----------------------------

-- ----------------------------
-- Table structure for ws_ead_courses_segments
-- ----------------------------
DROP TABLE IF EXISTS `ws_ead_courses_segments`;
CREATE TABLE `ws_ead_courses_segments` (
  `segment_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `segment_title` varchar(255) DEFAULT NULL,
  `segment_name` varchar(255) DEFAULT NULL,
  `segment_desc` text DEFAULT NULL,
  `segment_order` int(11) DEFAULT NULL,
  `segment_icon` varchar(255) DEFAULT NULL,
  `segment_created` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`segment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_ead_courses_segments
-- ----------------------------

-- ----------------------------
-- Table structure for ws_ead_enrollments
-- ----------------------------
DROP TABLE IF EXISTS `ws_ead_enrollments`;
CREATE TABLE `ws_ead_enrollments` (
  `user_id` int(11) unsigned DEFAULT NULL,
  `course_id` int(11) unsigned DEFAULT NULL,
  `enrollment_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `enrollment_order` int(11) unsigned DEFAULT NULL,
  `enrollment_bonus` int(11) unsigned DEFAULT NULL,
  `enrollment_start` timestamp NULL DEFAULT NULL,
  `enrollment_access` timestamp NULL DEFAULT NULL,
  `enrollment_end` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`enrollment_id`),
  KEY `wc_ead_student_course` (`course_id`),
  KEY `wc_ead_student_user` (`user_id`),
  KEY `wc_entollment_bonus` (`enrollment_bonus`),
  KEY `wc_enrollment_order` (`enrollment_order`),
  CONSTRAINT `wc_ead_student_course` FOREIGN KEY (`course_id`) REFERENCES `ws_ead_courses` (`course_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `wc_ead_student_user` FOREIGN KEY (`user_id`) REFERENCES `ws_users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `wc_enrollment_order` FOREIGN KEY (`enrollment_order`) REFERENCES `ws_ead_orders` (`order_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `wc_entollment_bonus` FOREIGN KEY (`enrollment_bonus`) REFERENCES `ws_ead_enrollments` (`enrollment_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_ead_enrollments
-- ----------------------------

-- ----------------------------
-- Table structure for ws_ead_modules
-- ----------------------------
DROP TABLE IF EXISTS `ws_ead_modules`;
CREATE TABLE `ws_ead_modules` (
  `course_id` int(11) unsigned DEFAULT NULL,
  `module_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `module_title` varchar(255) DEFAULT '',
  `module_desc` text DEFAULT NULL,
  `module_name` varchar(255) DEFAULT NULL,
  `module_order` int(11) NOT NULL DEFAULT 0,
  `module_release` int(11) NOT NULL DEFAULT 0,
  `module_release_date` timestamp NULL DEFAULT NULL,
  `module_required` int(11) DEFAULT 0,
  `module_created` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`module_id`),
  KEY `wc_course_module` (`course_id`),
  CONSTRAINT `wc_course_module` FOREIGN KEY (`course_id`) REFERENCES `ws_ead_courses` (`course_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_ead_modules
-- ----------------------------

-- ----------------------------
-- Table structure for ws_ead_orders
-- ----------------------------
DROP TABLE IF EXISTS `ws_ead_orders`;
CREATE TABLE `ws_ead_orders` (
  `user_id` int(10) unsigned DEFAULT NULL,
  `course_id` int(11) unsigned DEFAULT NULL,
  `order_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_product_id` int(11) DEFAULT NULL,
  `order_transaction` varchar(255) DEFAULT NULL,
  `order_callback_type` int(11) DEFAULT NULL,
  `order_off` varchar(255) DEFAULT NULL,
  `order_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `order_currency` varchar(255) DEFAULT NULL,
  `order_payment_type` varchar(255) DEFAULT NULL,
  `order_purchase_date` timestamp NULL DEFAULT NULL,
  `order_warranty_date` timestamp NULL DEFAULT NULL,
  `order_confirmation_purchase_date` timestamp NULL DEFAULT NULL,
  `order_sck` varchar(255) DEFAULT NULL,
  `order_src` varchar(255) DEFAULT NULL,
  `order_aff` varchar(255) DEFAULT NULL,
  `order_aff_name` varchar(255) DEFAULT NULL,
  `order_cms_aff` varchar(255) NOT NULL DEFAULT '0.00',
  `order_cms_marketplace` decimal(10,2) NOT NULL DEFAULT 0.00,
  `order_cms_vendor` decimal(10,2) NOT NULL DEFAULT 0.00,
  `order_status` varchar(255) DEFAULT NULL,
  `order_chargeback` timestamp NULL DEFAULT NULL,
  `order_delivered` int(11) DEFAULT NULL,
  `order_signature` varchar(255) DEFAULT NULL,
  `order_signature_plan` varchar(255) DEFAULT NULL,
  `order_signature_recurrency` int(11) DEFAULT NULL,
  `order_signature_period` int(11) DEFAULT NULL,
  `order_signature_status` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `wc_ead_order_user` (`user_id`),
  KEY `wc_ead_order_course` (`course_id`),
  CONSTRAINT `wc_ead_order_course` FOREIGN KEY (`course_id`) REFERENCES `ws_ead_courses` (`course_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `wc_ead_order_user` FOREIGN KEY (`user_id`) REFERENCES `ws_users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_ead_orders
-- ----------------------------

-- ----------------------------
-- Table structure for ws_ead_students_notes
-- ----------------------------
DROP TABLE IF EXISTS `ws_ead_students_notes`;
CREATE TABLE `ws_ead_students_notes` (
  `note_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL,
  `admin_id` int(11) unsigned DEFAULT NULL,
  `note_text` varchar(255) DEFAULT NULL,
  `note_datetime` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`note_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_ead_students_notes
-- ----------------------------

-- ----------------------------
-- Table structure for ws_ead_student_certificates
-- ----------------------------
DROP TABLE IF EXISTS `ws_ead_student_certificates`;
CREATE TABLE `ws_ead_student_certificates` (
  `user_id` int(11) unsigned DEFAULT NULL,
  `course_id` int(11) unsigned DEFAULT NULL,
  `enrollment_id` int(11) unsigned DEFAULT NULL,
  `certificate_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `certificate_key` varchar(255) DEFAULT NULL,
  `certificate_issued` date DEFAULT NULL,
  `certificate_status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`certificate_id`),
  KEY `wc_certificate_user` (`user_id`),
  KEY `wc_certificate_course` (`course_id`),
  KEY `wc_certificate_enrollment` (`enrollment_id`),
  CONSTRAINT `wc_certificate_course` FOREIGN KEY (`course_id`) REFERENCES `ws_ead_courses` (`course_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `wc_certificate_enrollment` FOREIGN KEY (`enrollment_id`) REFERENCES `ws_ead_enrollments` (`enrollment_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `wc_certificate_user` FOREIGN KEY (`user_id`) REFERENCES `ws_users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_ead_student_certificates
-- ----------------------------

-- ----------------------------
-- Table structure for ws_ead_student_classes
-- ----------------------------
DROP TABLE IF EXISTS `ws_ead_student_classes`;
CREATE TABLE `ws_ead_student_classes` (
  `user_id` int(11) unsigned DEFAULT NULL,
  `course_id` int(11) unsigned DEFAULT NULL,
  `class_id` int(11) unsigned DEFAULT NULL,
  `enrollment_id` int(11) unsigned DEFAULT NULL,
  `student_class_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `student_class_views` int(11) DEFAULT NULL,
  `student_class_play` timestamp NULL DEFAULT NULL,
  `student_class_free` int(11) DEFAULT NULL,
  `student_class_seconds` int(11) DEFAULT NULL,
  `student_class_check` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`student_class_id`),
  KEY `wc_student_class_user` (`user_id`),
  KEY `wc_student_class` (`class_id`),
  KEY `wc_student_class_course` (`course_id`),
  KEY `wc_student_class_enroll` (`enrollment_id`),
  CONSTRAINT `wc_student_class` FOREIGN KEY (`class_id`) REFERENCES `ws_ead_classes` (`class_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `wc_student_class_course` FOREIGN KEY (`course_id`) REFERENCES `ws_ead_courses` (`course_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `wc_student_class_enroll` FOREIGN KEY (`enrollment_id`) REFERENCES `ws_ead_enrollments` (`enrollment_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `wc_student_class_user` FOREIGN KEY (`user_id`) REFERENCES `ws_users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_ead_student_classes
-- ----------------------------

-- ----------------------------
-- Table structure for ws_ead_student_downloads
-- ----------------------------
DROP TABLE IF EXISTS `ws_ead_student_downloads`;
CREATE TABLE `ws_ead_student_downloads` (
  `user_id` int(11) unsigned DEFAULT NULL,
  `user_ip` varchar(255) DEFAULT NULL,
  `course_id` int(11) unsigned DEFAULT NULL,
  `class_id` int(11) unsigned DEFAULT NULL,
  `download_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `download_file` varchar(255) DEFAULT NULL,
  `download_filename` varchar(2555) DEFAULT NULL,
  `download_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`download_id`),
  KEY `ws_download_user` (`user_id`),
  KEY `ws_download_course` (`course_id`),
  KEY `ws_download_class` (`class_id`),
  CONSTRAINT `ws_download_class` FOREIGN KEY (`class_id`) REFERENCES `ws_ead_classes` (`class_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `ws_download_course` FOREIGN KEY (`course_id`) REFERENCES `ws_ead_courses` (`course_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `ws_download_user` FOREIGN KEY (`user_id`) REFERENCES `ws_users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_ead_student_downloads
-- ----------------------------

-- ----------------------------
-- Table structure for ws_ead_support
-- ----------------------------
DROP TABLE IF EXISTS `ws_ead_support`;
CREATE TABLE `ws_ead_support` (
  `user_id` int(11) unsigned DEFAULT NULL,
  `enrollment_id` int(11) unsigned DEFAULT NULL,
  `class_id` int(11) unsigned DEFAULT NULL,
  `support_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `support_content` text DEFAULT NULL,
  `support_status` int(11) DEFAULT NULL,
  `support_open` timestamp NULL DEFAULT NULL,
  `support_reply` timestamp NULL DEFAULT NULL,
  `support_close` timestamp NULL DEFAULT NULL,
  `support_review` int(11) DEFAULT NULL,
  `support_comment` text DEFAULT NULL,
  `support_published` int(11) DEFAULT NULL,
  PRIMARY KEY (`support_id`),
  KEY `wc_ead_support_class` (`class_id`),
  KEY `wc_ead_support_user` (`user_id`),
  KEY `wc_ead_student_class` (`enrollment_id`),
  CONSTRAINT `wc_ead_support_class` FOREIGN KEY (`class_id`) REFERENCES `ws_ead_classes` (`class_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `wc_ead_support_enroll` FOREIGN KEY (`enrollment_id`) REFERENCES `ws_ead_enrollments` (`enrollment_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `wc_ead_support_user` FOREIGN KEY (`user_id`) REFERENCES `ws_users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Status 1 = Aberto\nStatus 2 = Respondido\nStatus 3 = Completo';

-- ----------------------------
-- Records of ws_ead_support
-- ----------------------------

-- ----------------------------
-- Table structure for ws_ead_support_reply
-- ----------------------------
DROP TABLE IF EXISTS `ws_ead_support_reply`;
CREATE TABLE `ws_ead_support_reply` (
  `user_id` int(11) unsigned DEFAULT NULL,
  `enrollment_id` int(10) unsigned DEFAULT NULL,
  `support_id` int(11) unsigned DEFAULT NULL,
  `response_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `response_content` text DEFAULT NULL,
  `response_open` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`response_id`),
  KEY `wc_ead_support_class` (`support_id`),
  KEY `wc_ead_support_user` (`user_id`),
  KEY `wc_ead_support_reply_enroll` (`enrollment_id`),
  CONSTRAINT `wc_ead_support_reply_enroll` FOREIGN KEY (`enrollment_id`) REFERENCES `ws_ead_enrollments` (`enrollment_id`) ON DELETE CASCADE ON UPDATE SET NULL,
  CONSTRAINT `wc_response_support` FOREIGN KEY (`support_id`) REFERENCES `ws_ead_support` (`support_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `wc_response_user` FOREIGN KEY (`user_id`) REFERENCES `ws_users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Status 1 = Aberto\nStatus 2 = Respondido\nStatus 3 = Completo';

-- ----------------------------
-- Records of ws_ead_support_reply
-- ----------------------------

-- ----------------------------
-- Table structure for ws_faq
-- ----------------------------
DROP TABLE IF EXISTS `ws_faq`;
CREATE TABLE `ws_faq` (
  `faq_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `faq_title` varchar(255) DEFAULT NULL,
  `faq_desc` text DEFAULT NULL,
  `faq_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`faq_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_faq
-- ----------------------------

-- ----------------------------
-- Table structure for ws_gallery
-- ----------------------------
DROP TABLE IF EXISTS `ws_gallery`;
CREATE TABLE `ws_gallery` (
  `gallery_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `gallery_title` varchar(255) NOT NULL,
  `gallery_description` longtext DEFAULT NULL,
  `gallery_name` varchar(255) DEFAULT NULL,
  `gallery_cover` varchar(255) DEFAULT NULL,
  `gallery_category` tinyint(1) DEFAULT NULL,
  `gallery_status` tinyint(1) DEFAULT NULL,
  `gallery_order` int(11) DEFAULT NULL,
  `gallery_date` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`gallery_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_gallery
-- ----------------------------
INSERT INTO `ws_gallery` VALUES ('1', 'Gym Gallery', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s</p>', 'gym-gallery', 'gallery/2020/04/gym-gallery-1585955270.png', '1', '1', null, '2020-04-03 20:07:50');

-- ----------------------------
-- Table structure for ws_gallery_images
-- ----------------------------
DROP TABLE IF EXISTS `ws_gallery_images`;
CREATE TABLE `ws_gallery_images` (
  `gallery_image_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `gallery_id` int(10) unsigned NOT NULL,
  `gallery_file` varchar(255) NOT NULL,
  `gallery_image_order` int(11) DEFAULT NULL,
  `gallery_image_legend` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`gallery_image_id`),
  KEY `ws_gallery` (`gallery_id`),
  CONSTRAINT `ws_gallery` FOREIGN KEY (`gallery_id`) REFERENCES `ws_gallery` (`gallery_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_gallery_images
-- ----------------------------
INSERT INTO `ws_gallery_images` VALUES ('1', '1', 'gallery/2020/04/gym-gallery-11585955283.png', null, 'Gym Gallery');
INSERT INTO `ws_gallery_images` VALUES ('2', '1', 'gallery/2020/04/gym-gallery-21585955283.png', null, 'Gym Gallery');
INSERT INTO `ws_gallery_images` VALUES ('3', '1', 'gallery/2020/04/gym-gallery-31585955283.png', null, 'Gym Gallery');
INSERT INTO `ws_gallery_images` VALUES ('4', '1', 'gallery/2020/04/gym-gallery-41585955283.png', null, 'Gym Gallery');
INSERT INTO `ws_gallery_images` VALUES ('5', '1', 'gallery/2020/04/gym-gallery-51585955283.png', null, 'Gym Gallery');

-- ----------------------------
-- Table structure for ws_gallery_videos
-- ----------------------------
DROP TABLE IF EXISTS `ws_gallery_videos`;
CREATE TABLE `ws_gallery_videos` (
  `videos_id` int(11) NOT NULL AUTO_INCREMENT,
  `videos_cover` varchar(255) NOT NULL,
  `videos_title` varchar(255) NOT NULL,
  `videos_name` varchar(255) NOT NULL,
  `videos_subtitle` varchar(255) NOT NULL,
  `videos_message` text NOT NULL,
  `videos_content` text NOT NULL,
  `videos_link` varchar(255) NOT NULL,
  `videos_tags` varchar(255) NOT NULL,
  `videos_views` int(11) NOT NULL,
  `videos_likes` int(11) NOT NULL,
  `videos_status` int(11) NOT NULL,
  `videos_author` int(11) NOT NULL,
  `videos_date` timestamp NULL DEFAULT NULL,
  `videos_lastview` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`videos_id`),
  KEY `videos_author` (`videos_author`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_gallery_videos
-- ----------------------------

-- ----------------------------
-- Table structure for ws_hellobar
-- ----------------------------
DROP TABLE IF EXISTS `ws_hellobar`;
CREATE TABLE `ws_hellobar` (
  `user_id` int(11) unsigned NOT NULL,
  `hello_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `hello_title` varchar(255) DEFAULT NULL,
  `hello_image` varchar(244) DEFAULT NULL,
  `hello_cta` varchar(70) DEFAULT NULL,
  `hello_link` varchar(255) DEFAULT NULL,
  `hello_color` varchar(50) DEFAULT NULL,
  `hello_position` varchar(70) DEFAULT NULL,
  `hello_rule` varchar(255) DEFAULT NULL,
  `hello_date` timestamp NULL DEFAULT NULL,
  `hello_start` timestamp NULL DEFAULT NULL,
  `hello_end` timestamp NULL DEFAULT NULL,
  `hello_views` int(11) DEFAULT NULL,
  `hello_clicks` int(11) DEFAULT NULL,
  `hello_status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`hello_id`),
  KEY `wc_hello_user` (`user_id`),
  CONSTRAINT `wc_hello_user` FOREIGN KEY (`user_id`) REFERENCES `ws_users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_hellobar
-- ----------------------------

-- ----------------------------
-- Table structure for ws_offers
-- ----------------------------
DROP TABLE IF EXISTS `ws_offers`;
CREATE TABLE `ws_offers` (
  `offer_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador da Oferta',
  `offer_image` varchar(255) DEFAULT NULL COMMENT 'Imagem da Oferta',
  `offer_title` varchar(255) DEFAULT NULL COMMENT 'Título da Oferta',
  `offer_name` varchar(255) DEFAULT NULL COMMENT 'URL da Oferta',
  `offer_url` varchar(255) DEFAULT NULL COMMENT 'Link Externo da Oferta',
  `offer_content` text DEFAULT NULL COMMENT 'Descrição da Oferta',
  `offer_category` int(11) DEFAULT NULL COMMENT 'Categoria da Oferta',
  `offer_recommended` int(11) DEFAULT NULL COMMENT 'É Recomendado',
  `offer_price` decimal(10,2) DEFAULT NULL COMMENT 'Preço da Oferta',
  `offer_price_new` decimal(10,2) DEFAULT NULL COMMENT 'Preço Novo da Oferta',
  `offer_percent` int(11) DEFAULT NULL COMMENT 'Porcentagem da Oferta',
  `offer_datecreate` timestamp NULL DEFAULT NULL COMMENT 'Data de Cadastro da Oferta No Sistema',
  `offer_status` int(11) DEFAULT 0 COMMENT 'Status da Oferta No Sistema (0 - Inativa | 1 - Ativa)',
  PRIMARY KEY (`offer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_offers
-- ----------------------------

-- ----------------------------
-- Table structure for ws_offers_gallery
-- ----------------------------
DROP TABLE IF EXISTS `ws_offers_gallery`;
CREATE TABLE `ws_offers_gallery` (
  `offer_id` int(11) unsigned NOT NULL COMMENT 'Identificador do Estilo',
  `offer_gallery_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador da Imagem da Galeria',
  `offer_gallery_file` varchar(255) NOT NULL COMMENT 'Arquivo de Imagem da Galeria',
  `offer_gallery_order` int(11) DEFAULT NULL COMMENT 'Ordenação da Imagem da Galeria',
  `offer_gallery_legend` varchar(255) DEFAULT NULL COMMENT 'Legenda da Imagem da Galeria',
  PRIMARY KEY (`offer_gallery_id`),
  KEY `wc_offers_gallery` (`offer_id`),
  CONSTRAINT `wc_offers_gallery` FOREIGN KEY (`offer_id`) REFERENCES `ws_offers` (`offer_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_offers_gallery
-- ----------------------------

-- ----------------------------
-- Table structure for ws_orders
-- ----------------------------
DROP TABLE IF EXISTS `ws_orders`;
CREATE TABLE `ws_orders` (
  `user_id` int(11) unsigned DEFAULT NULL,
  `order_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_status` int(11) NOT NULL DEFAULT 0,
  `order_payment` int(11) NOT NULL DEFAULT 1,
  `order_price` decimal(11,2) NOT NULL DEFAULT 0.00,
  `order_installments` decimal(10,0) DEFAULT NULL,
  `order_installment` decimal(11,2) DEFAULT NULL,
  `order_coupon` decimal(11,0) DEFAULT NULL,
  `order_free` decimal(11,2) DEFAULT NULL,
  `order_billet` varchar(255) DEFAULT NULL,
  `order_code` varchar(255) DEFAULT NULL,
  `order_addr` int(11) DEFAULT NULL,
  `order_shipcode` int(11) DEFAULT NULL,
  `order_shipprice` decimal(11,2) DEFAULT NULL,
  `order_shipment` date DEFAULT NULL,
  `order_tracking` varchar(255) DEFAULT NULL,
  `order_nfepdf` varchar(255) DEFAULT NULL,
  `order_nfexml` varchar(255) DEFAULT NULL,
  `order_date` timestamp NULL DEFAULT NULL,
  `order_update` timestamp NULL DEFAULT NULL,
  `order_mail_processing` int(11) DEFAULT NULL,
  `order_mail_completed` int(11) DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `wc_order_user` (`user_id`),
  CONSTRAINT `wc_order_user` FOREIGN KEY (`user_id`) REFERENCES `ws_users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_orders
-- ----------------------------

-- ----------------------------
-- Table structure for ws_orders_items
-- ----------------------------
DROP TABLE IF EXISTS `ws_orders_items`;
CREATE TABLE `ws_orders_items` (
  `order_id` int(11) unsigned NOT NULL,
  `pdt_id` int(11) DEFAULT NULL,
  `stock_id` int(11) DEFAULT NULL,
  `item_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) DEFAULT NULL,
  `item_price` decimal(11,2) DEFAULT NULL,
  `item_amount` decimal(11,0) DEFAULT 1,
  PRIMARY KEY (`item_id`),
  KEY `wc_order` (`order_id`),
  CONSTRAINT `wc_order` FOREIGN KEY (`order_id`) REFERENCES `ws_orders` (`order_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_orders_items
-- ----------------------------

-- ----------------------------
-- Table structure for ws_pages
-- ----------------------------
DROP TABLE IF EXISTS `ws_pages`;
CREATE TABLE `ws_pages` (
  `page_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `page_title` varchar(255) DEFAULT NULL,
  `page_subtitle` varchar(255) DEFAULT NULL,
  `page_video` varchar(255) DEFAULT NULL,
  `page_name` varchar(255) DEFAULT NULL,
  `page_content` text DEFAULT NULL,
  `page_date` timestamp NULL DEFAULT NULL,
  `page_revision` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `page_order` int(11) DEFAULT NULL,
  `page_status` int(11) NOT NULL DEFAULT 0,
  `page_cover` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_pages
-- ----------------------------

-- ----------------------------
-- Table structure for ws_pages_images
-- ----------------------------
DROP TABLE IF EXISTS `ws_pages_images`;
CREATE TABLE `ws_pages_images` (
  `page_id` int(11) unsigned NOT NULL,
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wc_pages` (`page_id`),
  CONSTRAINT `wc_pages` FOREIGN KEY (`page_id`) REFERENCES `ws_pages` (`page_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_pages_images
-- ----------------------------

-- ----------------------------
-- Table structure for ws_plans
-- ----------------------------
DROP TABLE IF EXISTS `ws_plans`;
CREATE TABLE `ws_plans` (
  `plan_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `plan_image` varchar(255) DEFAULT NULL,
  `plan_title` varchar(255) DEFAULT NULL,
  `plan_name` varchar(255) NOT NULL,
  `plan_content` text DEFAULT NULL,
  `plan_category` int(11) DEFAULT NULL,
  `plan_recommended` int(11) DEFAULT NULL,
  `plan_price` decimal(10,2) DEFAULT NULL,
  `plan_status` int(11) NOT NULL DEFAULT 0,
  `plan_datecreate` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`plan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_plans
-- ----------------------------

-- ----------------------------
-- Table structure for ws_plans_benefits
-- ----------------------------
DROP TABLE IF EXISTS `ws_plans_benefits`;
CREATE TABLE `ws_plans_benefits` (
  `plan_id` int(11) unsigned NOT NULL,
  `plan_benefits_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `plan_benefits_title` varchar(255) DEFAULT NULL,
  `plan_benefits_price` decimal(10,2) DEFAULT NULL,
  `plan_benefits_datecreate` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`plan_benefits_id`),
  KEY `wc_plan_benefits` (`plan_id`),
  CONSTRAINT `wc_plan_benefits` FOREIGN KEY (`plan_id`) REFERENCES `ws_plans` (`plan_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_plans_benefits
-- ----------------------------

-- ----------------------------
-- Table structure for ws_posts
-- ----------------------------
DROP TABLE IF EXISTS `ws_posts`;
CREATE TABLE `ws_posts` (
  `post_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `post_name` varchar(255) NOT NULL DEFAULT '',
  `post_title` varchar(255) DEFAULT NULL,
  `post_subtitle` text DEFAULT NULL,
  `post_content` longtext DEFAULT NULL,
  `post_cover` varchar(255) DEFAULT NULL,
  `post_video` varchar(255) DEFAULT NULL,
  `post_date` timestamp NULL DEFAULT NULL,
  `post_author` int(11) unsigned DEFAULT NULL,
  `post_category` int(11) unsigned DEFAULT NULL,
  `post_category_parent` varchar(255) DEFAULT NULL,
  `post_views` decimal(10,0) DEFAULT 0,
  `post_lastview` timestamp NULL DEFAULT NULL,
  `post_status` int(11) NOT NULL DEFAULT 0,
  `post_type` varchar(255) DEFAULT NULL,
  `post_instant_article` int(11) DEFAULT NULL,
  `post_amp` int(11) DEFAULT NULL,
  `post_tags` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`post_id`),
  KEY `wc_post_category` (`post_category`),
  KEY `wc_post_author` (`post_author`),
  CONSTRAINT `wc_post_author` FOREIGN KEY (`post_author`) REFERENCES `ws_users` (`user_id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `wc_post_category` FOREIGN KEY (`post_category`) REFERENCES `ws_categories` (`category_id`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_posts
-- ----------------------------
INSERT INTO `ws_posts` VALUES ('1', 'lorem-ipsum-is-simply-dummy-text-of-the-printing-and-typesetting-industry', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'images/2020/04/lorem-ipsum-is-simply-dummy-text-of-the-printing-and-typesetting-industry-lorem-ipsum-has-been-the-industry-s-1585955436.png', null, '2020-04-02 00:00:00', '1', '1', '2', '10', '2020-04-06 19:02:29', '1', 'post', null, null, null);
INSERT INTO `ws_posts` VALUES ('2', 'it-is-a-long-established-fact-that-a-reader-will-be', 'It is a long established fact that a reader will be.', 'It is a long established fact that a reader will be.', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'images/2020/04/it-is-a-long-established-fact-that-a-reader-will-be-distracted-by-the-readable-content-of-a-page-when-looking-at-its-layout-the-point-of-using-lorem-ipsum-is-that-it-1585955468.png', null, '2020-04-02 00:00:00', '1', '3', '4', '0', null, '1', 'post', null, null, null);
INSERT INTO `ws_posts` VALUES ('3', 'it-is-a-long-established-fact-that-a-reader-will-be-distracted', 'It is a long established fact that a reader will be distracted.', 'It is a long established fact that a reader will be distracted.', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', 'images/2020/04/it-is-a-long-established-fact-that-a-reader-will-be-distracted-by-the-readable-content-of-a-page-when-looking-at-its-layout-the-point-of-using-lorem-ipsum-is-that-it-3-1585955496.png', null, '2020-04-02 00:00:00', '1', '1', '2', '0', null, '1', 'post', null, null, null);
INSERT INTO `ws_posts` VALUES ('4', 'contrary-to-popular-belief-lorem-ipsum-is-not-simply-random-text', 'Contrary to popular belief, Lorem Ipsum is not simply random text.', 'Contrary to popular belief, Lorem Ipsum is not simply random text.', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', 'images/2020/04/1585955503.png', null, '2020-04-02 00:00:00', '1', '3', '4', '0', null, '1', 'post', null, null, null);
INSERT INTO `ws_posts` VALUES ('5', 'lorem-ipsum-is-simply-dummy-text-of-the-printing-and-typesetting-industry-5', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'images/2020/04/1585955547.png', null, '2020-04-02 00:00:00', '1', '3', '4', '0', null, '1', 'post', null, null, null);

-- ----------------------------
-- Table structure for ws_posts_images
-- ----------------------------
DROP TABLE IF EXISTS `ws_posts_images`;
CREATE TABLE `ws_posts_images` (
  `post_id` int(11) unsigned DEFAULT NULL,
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wc_posts_images` (`post_id`),
  CONSTRAINT `wc_posts_images` FOREIGN KEY (`post_id`) REFERENCES `ws_posts` (`post_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_posts_images
-- ----------------------------

-- ----------------------------
-- Table structure for ws_products
-- ----------------------------
DROP TABLE IF EXISTS `ws_products`;
CREATE TABLE `ws_products` (
  `pdt_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pdt_code` varchar(255) NOT NULL DEFAULT '',
  `pdt_parent` int(11) unsigned DEFAULT NULL,
  `pdt_title` varchar(255) DEFAULT NULL,
  `pdt_subtitle` varchar(255) DEFAULT NULL,
  `pdt_name` varchar(255) DEFAULT NULL,
  `pdt_hotlink` varchar(255) DEFAULT NULL,
  `pdt_cover` varchar(255) DEFAULT NULL,
  `pdt_content` text DEFAULT NULL,
  `pdt_price` decimal(11,2) DEFAULT NULL,
  `pdt_inventory` decimal(10,0) NOT NULL DEFAULT 0,
  `pdt_delivered` decimal(10,0) NOT NULL DEFAULT 0,
  `pdt_brand` int(11) unsigned DEFAULT NULL,
  `pdt_category` int(11) unsigned DEFAULT NULL,
  `pdt_subcategory` int(11) unsigned DEFAULT NULL,
  `pdt_offer_price` decimal(11,2) DEFAULT NULL,
  `pdt_offer_start` timestamp NULL DEFAULT NULL,
  `pdt_offer_end` timestamp NULL DEFAULT NULL,
  `pdt_dimension_heigth` decimal(11,0) NOT NULL DEFAULT 0,
  `pdt_dimension_width` decimal(11,0) NOT NULL DEFAULT 0,
  `pdt_dimension_depth` decimal(11,0) NOT NULL DEFAULT 0,
  `pdt_dimension_weight` decimal(11,0) NOT NULL DEFAULT 0,
  `pdt_created` timestamp NULL DEFAULT NULL,
  `pdt_views` decimal(10,0) DEFAULT 0,
  `pdt_lastview` timestamp NULL DEFAULT NULL,
  `pdt_status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`pdt_id`),
  KEY `wc_products_brands` (`pdt_brand`),
  KEY `wc_products_categories` (`pdt_category`),
  KEY `wc_products_subcategory` (`pdt_subcategory`),
  KEY `wc_product_parent` (`pdt_parent`),
  CONSTRAINT `wc_product_parent` FOREIGN KEY (`pdt_parent`) REFERENCES `ws_products` (`pdt_id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `wc_products_brands` FOREIGN KEY (`pdt_brand`) REFERENCES `ws_products_brands` (`brand_id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `wc_products_categories` FOREIGN KEY (`pdt_category`) REFERENCES `ws_products_categories` (`cat_id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `wc_products_subcategory` FOREIGN KEY (`pdt_subcategory`) REFERENCES `ws_products_categories` (`cat_id`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_products
-- ----------------------------

-- ----------------------------
-- Table structure for ws_products_brands
-- ----------------------------
DROP TABLE IF EXISTS `ws_products_brands`;
CREATE TABLE `ws_products_brands` (
  `brand_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `brand_title` varchar(255) DEFAULT NULL,
  `brand_name` varchar(255) DEFAULT NULL,
  `brand_created` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_products_brands
-- ----------------------------

-- ----------------------------
-- Table structure for ws_products_categories
-- ----------------------------
DROP TABLE IF EXISTS `ws_products_categories`;
CREATE TABLE `ws_products_categories` (
  `cat_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cat_parent` int(11) unsigned DEFAULT NULL,
  `cat_title` varchar(255) DEFAULT NULL,
  `cat_name` varchar(255) DEFAULT NULL,
  `cat_sizes` varchar(255) DEFAULT NULL,
  `cat_created` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_products_categories
-- ----------------------------

-- ----------------------------
-- Table structure for ws_products_coupons
-- ----------------------------
DROP TABLE IF EXISTS `ws_products_coupons`;
CREATE TABLE `ws_products_coupons` (
  `cp_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cp_title` varchar(255) DEFAULT NULL,
  `cp_coupon` varchar(255) DEFAULT NULL,
  `cp_discount` decimal(11,0) DEFAULT NULL,
  `cp_start` timestamp NULL DEFAULT NULL,
  `cp_end` timestamp NULL DEFAULT NULL,
  `cp_hits` decimal(11,0) DEFAULT NULL,
  PRIMARY KEY (`cp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_products_coupons
-- ----------------------------

-- ----------------------------
-- Table structure for ws_products_gallery
-- ----------------------------
DROP TABLE IF EXISTS `ws_products_gallery`;
CREATE TABLE `ws_products_gallery` (
  `product_id` int(11) unsigned NOT NULL,
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wc_produtcts_gallery` (`product_id`),
  CONSTRAINT `wc_produtcts_gallery` FOREIGN KEY (`product_id`) REFERENCES `ws_products` (`pdt_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_products_gallery
-- ----------------------------

-- ----------------------------
-- Table structure for ws_products_images
-- ----------------------------
DROP TABLE IF EXISTS `ws_products_images`;
CREATE TABLE `ws_products_images` (
  `product_id` int(11) unsigned NOT NULL,
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wc_products_images` (`product_id`),
  CONSTRAINT `wc_products_images` FOREIGN KEY (`product_id`) REFERENCES `ws_products` (`pdt_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_products_images
-- ----------------------------

-- ----------------------------
-- Table structure for ws_products_stock
-- ----------------------------
DROP TABLE IF EXISTS `ws_products_stock`;
CREATE TABLE `ws_products_stock` (
  `stock_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pdt_id` int(11) unsigned NOT NULL,
  `stock_code` varchar(255) NOT NULL DEFAULT '',
  `stock_inventory` decimal(10,0) NOT NULL DEFAULT 0,
  `stock_sold` decimal(10,0) NOT NULL DEFAULT 0,
  PRIMARY KEY (`stock_id`),
  KEY `wc_products_stock` (`pdt_id`),
  CONSTRAINT `wc_products_stock` FOREIGN KEY (`pdt_id`) REFERENCES `ws_products` (`pdt_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_products_stock
-- ----------------------------

-- ----------------------------
-- Table structure for ws_properties
-- ----------------------------
DROP TABLE IF EXISTS `ws_properties`;
CREATE TABLE `ws_properties` (
  `realty_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `realty_cover` varchar(255) DEFAULT NULL,
  `realty_title` varchar(255) DEFAULT NULL,
  `realty_name` varchar(255) DEFAULT NULL,
  `realty_ref` varchar(255) DEFAULT NULL,
  `realty_price` decimal(11,2) DEFAULT NULL,
  `realty_desc` text DEFAULT NULL,
  `realty_finality` int(11) DEFAULT NULL,
  `realty_type` int(11) DEFAULT NULL,
  `realty_builtarea` decimal(11,2) DEFAULT NULL,
  `realty_totalarea` decimal(11,2) DEFAULT NULL,
  `realty_bedrooms` decimal(11,0) DEFAULT NULL,
  `realty_apartments` decimal(10,0) DEFAULT NULL,
  `realty_bathrooms` decimal(11,0) DEFAULT NULL,
  `realty_parkings` decimal(10,0) DEFAULT NULL,
  `realty_particulars` text DEFAULT NULL,
  `realty_transaction` int(11) DEFAULT NULL,
  `realty_state` varchar(10) DEFAULT NULL,
  `realty_city` varchar(255) DEFAULT NULL,
  `realty_district` varchar(255) DEFAULT NULL,
  `realty_date` timestamp NULL DEFAULT NULL,
  `realty_observation` int(11) DEFAULT NULL,
  `realty_contact` int(11) unsigned DEFAULT NULL,
  `realty_status` int(11) NOT NULL DEFAULT 0,
  `realty_views` decimal(11,0) NOT NULL DEFAULT 0,
  PRIMARY KEY (`realty_id`),
  KEY `wc_propertie_author` (`realty_contact`),
  CONSTRAINT `wc_propertie_author` FOREIGN KEY (`realty_contact`) REFERENCES `ws_users` (`user_id`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_properties
-- ----------------------------

-- ----------------------------
-- Table structure for ws_properties_gallery
-- ----------------------------
DROP TABLE IF EXISTS `ws_properties_gallery`;
CREATE TABLE `ws_properties_gallery` (
  `realty_id` int(11) unsigned DEFAULT NULL,
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wc_properties_gallery` (`realty_id`),
  CONSTRAINT `wc_properties_gallery` FOREIGN KEY (`realty_id`) REFERENCES `ws_properties` (`realty_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_properties_gallery
-- ----------------------------

-- ----------------------------
-- Table structure for ws_schedules
-- ----------------------------
DROP TABLE IF EXISTS `ws_schedules`;
CREATE TABLE `ws_schedules` (
  `schedule_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `schedule_name` varchar(255) DEFAULT NULL,
  `schedule_email` varchar(255) DEFAULT NULL,
  `schedule_telephone` varchar(255) DEFAULT NULL,
  `schedule_classe` int(11) DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `time` timestamp NULL DEFAULT NULL,
  `schedule_message` text DEFAULT NULL,
  `schedule_status` int(11) DEFAULT NULL,
  `schedule_response` longtext DEFAULT NULL,
  PRIMARY KEY (`schedule_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_schedules
-- ----------------------------

-- ----------------------------
-- Table structure for ws_search
-- ----------------------------
DROP TABLE IF EXISTS `ws_search`;
CREATE TABLE `ws_search` (
  `search_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `search_key` varchar(255) DEFAULT NULL,
  `search_count` decimal(11,0) DEFAULT NULL,
  `search_date` timestamp NULL DEFAULT NULL,
  `search_commit` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `search_publish` int(11) DEFAULT NULL,
  PRIMARY KEY (`search_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_search
-- ----------------------------
INSERT INTO `ws_search` VALUES ('1', 'it is', '1', '2020-04-06 23:49:27', '2020-04-06 23:49:27', null);

-- ----------------------------
-- Table structure for ws_services
-- ----------------------------
DROP TABLE IF EXISTS `ws_services`;
CREATE TABLE `ws_services` (
  `service_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador do Serviço',
  `service_image` varchar(255) DEFAULT NULL COMMENT 'Imagem do Serviço',
  `service_icon_type` int(11) DEFAULT NULL COMMENT 'Tipo do Ícone do Serviço ',
  `service_icon_text` varchar(255) DEFAULT NULL COMMENT 'Texto do Ícone do Serviço (Ex.: IcoMoon, Font Awesome e Etc)',
  `service_icon` varchar(255) DEFAULT NULL COMMENT 'Ícone do Serviço',
  `service_title` varchar(255) DEFAULT NULL COMMENT 'Título do Serviço',
  `service_name` varchar(255) NOT NULL COMMENT 'URL dos Serviços Para Exibição No Site',
  `service_content` text DEFAULT NULL COMMENT 'Descrição do Serviço',
  `service_price` decimal(10,2) DEFAULT NULL COMMENT 'Preço do Serviço',
  `service_image_one` varchar(255) DEFAULT NULL COMMENT 'Imagem 1',
  `service_image_two` varchar(255) DEFAULT NULL COMMENT 'Imagem 2',
  `service_datecreate` timestamp NULL DEFAULT NULL COMMENT 'Data de Cadastro do Serviço No Sistema',
  `service_status` int(11) DEFAULT 0 COMMENT 'Status do Serviço No Sistema (0 - Inativa | 1 - Ativa)',
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_services
-- ----------------------------

-- ----------------------------
-- Table structure for ws_services_types
-- ----------------------------
DROP TABLE IF EXISTS `ws_services_types`;
CREATE TABLE `ws_services_types` (
  `service_id` int(11) unsigned NOT NULL COMMENT 'Identificador do Serviço',
  `service_type_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador do Benefício do Serviço',
  `service_type_image` varchar(255) DEFAULT NULL COMMENT 'Identificador da Imagem do Benefício do Serviço',
  `service_type_icon_type` int(11) DEFAULT NULL COMMENT 'Tipo do Ícone do Benefício do Serviço',
  `service_type_icon_text` varchar(255) DEFAULT NULL COMMENT 'Texto do Ícone do Benefício do Serviço (Ex.: IcoMoon, Font Awesome e Etc)',
  `service_type_icon` varchar(255) DEFAULT NULL COMMENT 'Ícone do Benefício do Serviço',
  `service_type_title` varchar(255) DEFAULT NULL COMMENT 'Título do Benefício do Serviço',
  `service_type_price` decimal(10,2) NOT NULL COMMENT 'Preço do Tipo do Serviço',
  `service_type_content` text DEFAULT NULL COMMENT 'Descrição do Benefício do Serviço',
  `service_type_datecreate` timestamp NULL DEFAULT NULL COMMENT 'Data de Cadastro dos Benefícios do Serviço No Sistema',
  PRIMARY KEY (`service_type_id`),
  KEY `wc_services_types` (`service_id`) USING BTREE,
  CONSTRAINT `wc_services_types` FOREIGN KEY (`service_id`) REFERENCES `ws_services` (`service_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_services_types
-- ----------------------------

-- ----------------------------
-- Table structure for ws_siteviews_online
-- ----------------------------
DROP TABLE IF EXISTS `ws_siteviews_online`;
CREATE TABLE `ws_siteviews_online` (
  `online_id` int(11) NOT NULL AUTO_INCREMENT,
  `online_user` int(11) DEFAULT NULL,
  `online_name` varchar(255) DEFAULT NULL,
  `online_startview` timestamp NULL DEFAULT NULL,
  `online_endview` timestamp NULL DEFAULT NULL,
  `online_ip` varchar(255) DEFAULT NULL,
  `online_url` varchar(255) DEFAULT NULL,
  `online_agent` varchar(255) DEFAULT NULL,
  `online_device` varchar(100) DEFAULT NULL,
  `online_city` varchar(255) DEFAULT NULL,
  `online_state` varchar(255) DEFAULT NULL,
  `online_country` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`online_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_siteviews_online
-- ----------------------------
INSERT INTO `ws_siteviews_online` VALUES ('17', '1', 'Admin Work Control', '2020-04-06 22:08:23', '2020-04-07 00:18:07', '::1', '404', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36', 'Desktop', null, null, null);

-- ----------------------------
-- Table structure for ws_siteviews_views
-- ----------------------------
DROP TABLE IF EXISTS `ws_siteviews_views`;
CREATE TABLE `ws_siteviews_views` (
  `views_id` int(11) NOT NULL AUTO_INCREMENT,
  `views_date` date DEFAULT NULL,
  `views_users` decimal(10,0) DEFAULT NULL,
  `views_views` decimal(10,0) DEFAULT NULL,
  `views_pages` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`views_id`),
  KEY `idx_1` (`views_date`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_siteviews_views
-- ----------------------------
INSERT INTO `ws_siteviews_views` VALUES ('1', '2020-03-30', '1', '1', '1');
INSERT INTO `ws_siteviews_views` VALUES ('2', '2020-03-30', '1', '1', '1');
INSERT INTO `ws_siteviews_views` VALUES ('3', '2020-03-30', '1', '1', '1');
INSERT INTO `ws_siteviews_views` VALUES ('4', '2020-04-02', '1', '1', '94');
INSERT INTO `ws_siteviews_views` VALUES ('5', '2020-04-03', '1', '2', '10');
INSERT INTO `ws_siteviews_views` VALUES ('6', '2020-04-05', '1', '1', '50');
INSERT INTO `ws_siteviews_views` VALUES ('7', '2020-04-05', '1', '1', '50');
INSERT INTO `ws_siteviews_views` VALUES ('8', '2020-04-05', '1', '1', '50');
INSERT INTO `ws_siteviews_views` VALUES ('9', '2020-04-05', '1', '1', '50');
INSERT INTO `ws_siteviews_views` VALUES ('10', '2020-04-05', '1', '1', '50');
INSERT INTO `ws_siteviews_views` VALUES ('11', '2020-04-05', '1', '1', '50');
INSERT INTO `ws_siteviews_views` VALUES ('12', '2020-04-05', '1', '1', '50');
INSERT INTO `ws_siteviews_views` VALUES ('13', '2020-04-05', '1', '1', '50');
INSERT INTO `ws_siteviews_views` VALUES ('14', '2020-04-05', '1', '1', '50');
INSERT INTO `ws_siteviews_views` VALUES ('15', '2020-04-05', '1', '1', '50');
INSERT INTO `ws_siteviews_views` VALUES ('16', '2020-04-05', '1', '1', '50');
INSERT INTO `ws_siteviews_views` VALUES ('17', '2020-04-05', '1', '1', '50');
INSERT INTO `ws_siteviews_views` VALUES ('18', '2020-04-05', '1', '1', '50');
INSERT INTO `ws_siteviews_views` VALUES ('19', '2020-04-05', '1', '1', '50');
INSERT INTO `ws_siteviews_views` VALUES ('20', '2020-04-05', '1', '1', '50');
INSERT INTO `ws_siteviews_views` VALUES ('21', '2020-04-05', '1', '1', '50');
INSERT INTO `ws_siteviews_views` VALUES ('22', '2020-04-05', '1', '1', '50');
INSERT INTO `ws_siteviews_views` VALUES ('23', '2020-04-05', '1', '1', '50');
INSERT INTO `ws_siteviews_views` VALUES ('24', '2020-04-05', '1', '1', '50');
INSERT INTO `ws_siteviews_views` VALUES ('25', '2020-04-05', '1', '1', '50');
INSERT INTO `ws_siteviews_views` VALUES ('26', '2020-04-05', '1', '1', '50');
INSERT INTO `ws_siteviews_views` VALUES ('27', '2020-04-05', '1', '1', '50');
INSERT INTO `ws_siteviews_views` VALUES ('28', '2020-04-05', '1', '1', '50');
INSERT INTO `ws_siteviews_views` VALUES ('29', '2020-04-05', '1', '1', '50');
INSERT INTO `ws_siteviews_views` VALUES ('30', '2020-04-05', '1', '1', '50');
INSERT INTO `ws_siteviews_views` VALUES ('31', '2020-04-05', '1', '1', '50');
INSERT INTO `ws_siteviews_views` VALUES ('32', '2020-04-05', '1', '1', '50');
INSERT INTO `ws_siteviews_views` VALUES ('33', '2020-04-05', '1', '1', '50');
INSERT INTO `ws_siteviews_views` VALUES ('34', '2020-04-05', '1', '1', '50');
INSERT INTO `ws_siteviews_views` VALUES ('35', '2020-04-05', '1', '1', '50');
INSERT INTO `ws_siteviews_views` VALUES ('36', '2020-04-05', '1', '1', '50');
INSERT INTO `ws_siteviews_views` VALUES ('37', '2020-04-06', '1', '1', '77');

-- ----------------------------
-- Table structure for ws_slides
-- ----------------------------
DROP TABLE IF EXISTS `ws_slides`;
CREATE TABLE `ws_slides` (
  `slide_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `slide_status` int(11) NOT NULL DEFAULT 0,
  `slide_image_mobile` varchar(255) DEFAULT NULL,
  `slide_image_tablet` varchar(255) DEFAULT NULL,
  `slide_image_desktop` varchar(255) DEFAULT NULL,
  `slide_title` varchar(255) DEFAULT NULL,
  `slide_desc` text DEFAULT NULL,
  `slide_link` varchar(255) DEFAULT NULL,
  `slide_date` timestamp NULL DEFAULT NULL,
  `slide_start` timestamp NULL DEFAULT NULL,
  `slide_end` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`slide_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_slides
-- ----------------------------

-- ----------------------------
-- Table structure for ws_testimonials
-- ----------------------------
DROP TABLE IF EXISTS `ws_testimonials`;
CREATE TABLE `ws_testimonials` (
  `testimonial_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `testimonial_image` varchar(255) DEFAULT NULL,
  `testimonial_name` varchar(255) DEFAULT NULL,
  `testimonial_headline` varchar(255) DEFAULT NULL,
  `testimonial_depoiment` text DEFAULT NULL,
  `testimonial_cargo` varchar(255) DEFAULT NULL,
  `testimonial_type` int(11) DEFAULT NULL,
  `fb_review_id` varchar(255) DEFAULT NULL,
  `testimonial_rating` int(11) DEFAULT NULL,
  `testimonial_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`testimonial_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_testimonials
-- ----------------------------
INSERT INTO `ws_testimonials` VALUES ('1', 'clientes/2020/04/davinc-atone-1585956145.png', 'Davinc Atone', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make.', null, '1', null, null, '2020-04-04 01:22:26');
INSERT INTO `ws_testimonials` VALUES ('2', 'clientes/2020/04/davinc-atone-1585956145.png', 'Davinc Atone', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make.', null, '1', null, null, '2020-04-04 01:22:26');
INSERT INTO `ws_testimonials` VALUES ('3', 'clientes/2020/04/davinc-atone-1585956145.png', 'Davinc Atone', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make.', null, '1', null, null, '2020-04-04 01:22:26');
INSERT INTO `ws_testimonials` VALUES ('4', 'clientes/2020/04/davinc-atone-1585956145.png', 'Davinc Atone', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make.', null, '1', null, null, '2020-04-04 01:22:26');

-- ----------------------------
-- Table structure for ws_trainees
-- ----------------------------
DROP TABLE IF EXISTS `ws_trainees`;
CREATE TABLE `ws_trainees` (
  `trainee_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador do Treinador',
  `trainee_cover` varchar(255) DEFAULT NULL COMMENT 'Imagem do Treinador',
  `trainee_name` varchar(255) DEFAULT NULL COMMENT 'Nome do Treinador',
  `trainee_url` varchar(255) DEFAULT NULL COMMENT 'URL do Treinador',
  `trainee_content` text DEFAULT NULL COMMENT 'Descrição do Treinador',
  `trainee_curriculum` text DEFAULT NULL COMMENT 'Curriculum do Treinador',
  `trainee_cpf` varchar(255) DEFAULT NULL COMMENT 'CPF do Treinador',
  `trainee_rg` varchar(255) DEFAULT NULL COMMENT 'RG do Treinador',
  `trainee_datebirth` timestamp NULL DEFAULT NULL COMMENT 'Data de Nascimento do Treinador',
  `trainee_genre` int(11) DEFAULT NULL COMMENT 'Gênero do Treinador',
  `trainee_specialty` int(11) DEFAULT NULL COMMENT 'Especialidade do Treinador',
  `trainee_email` varchar(255) DEFAULT NULL COMMENT 'E-mail do Treinador	',
  `trainee_telephone` varchar(255) DEFAULT NULL COMMENT 'Telefone do Treinador	',
  `trainee_cell` varchar(255) DEFAULT NULL COMMENT 'Celular do Treinador	',
  `trainee_facebook` varchar(255) DEFAULT NULL COMMENT 'Facebook do Treinador',
  `trainee_instagram` varchar(255) DEFAULT NULL COMMENT 'Instagram do Treinador',
  `trainee_linkedin` varchar(255) DEFAULT NULL COMMENT 'Linkedin do Treinador',
  `trainee_twitter` varchar(255) DEFAULT NULL COMMENT 'Twitter do Treinador',
  `trainee_google` varchar(255) DEFAULT NULL COMMENT 'Google do Treinador',
  `trainee_youtube` varchar(255) DEFAULT NULL COMMENT 'YouTube do Treinador',
  `trainee_zipcode` varchar(255) DEFAULT NULL COMMENT 'CEP do Treinador',
  `trainee_street` varchar(255) DEFAULT NULL COMMENT 'Rua do Treinador',
  `trainee_number` varchar(255) DEFAULT NULL COMMENT 'Número do Endereço do Treinador',
  `trainee_complement` varchar(255) DEFAULT NULL COMMENT 'Complemento do Endereço do Treinador',
  `trainee_district` varchar(255) DEFAULT NULL COMMENT 'Bairro do Treinador',
  `trainee_city` varchar(255) DEFAULT NULL COMMENT 'Cidade do Treinador',
  `trainee_state` varchar(2) DEFAULT NULL COMMENT 'Estado do Treinador',
  `trainee_country` varchar(255) DEFAULT NULL COMMENT 'País do Treinador',
  `trainee_datecreate` timestamp NULL DEFAULT NULL COMMENT 'Data de Cadastro do Treinador No Sistema',
  `trainee_status` int(11) DEFAULT 0 COMMENT 'Status do Treinador No Sistema (0 - Inativa | 1 - Ativa)',
  PRIMARY KEY (`trainee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_trainees
-- ----------------------------
INSERT INTO `ws_trainees` VALUES ('1', 'treinadores/2020/04/rachel-adam-1585954933.png', 'Rachel Adam', 'rachel-adam', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s</p>', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s</p>', '441.415.592-45', '17.774.297-5', '1995-01-23 00:00:00', '2', '1', 'racheladam@gym.com.br', '(21) 3579-2022', '(21) 99707-7799', 'racheladam', 'racheladam', 'racheladam', 'racheladam', null, 'racheladam', '24370-436', 'Rua Tenente Antônio João', '100', null, 'Jurujuba', 'Niterói', 'RJ', 'Brasil', '2020-04-04 01:04:02', '1');
INSERT INTO `ws_trainees` VALUES ('2', 'treinadores/2020/04/1585955057.png', 'Keaf Shen', 'keaf-shen', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s</p>', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s</p>', '830.872.017-07', '37.499.773-1', '1995-05-01 00:00:00', '2', '3', 'keafshen@gym.com.br', '(21) 2992-8341', '(21) 99461-2994', 'keafshen', 'keafshen', 'keafshen', 'keafshen', null, 'keafshen', '24120-050', 'Travessa da Cândida', '100', null, 'Fonseca', 'Niterói', 'RJ', 'Brasil', '2020-04-04 01:05:35', '1');
INSERT INTO `ws_trainees` VALUES ('3', 'treinadores/2020/04/1585955148.png', 'Lefew D. Loee', 'lefew-d-loee', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s</p>', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s</p>', '482.435.707-13', '20.729.658-3', '1995-04-16 00:00:00', '2', '2', 'lefewloee@gym.com.br', '(21) 3601-6893', '(21) 99110-0804', 'lefewloee', 'lefewloee', 'lefewloee', 'lefewloee', null, 'lefewloee', '24322-497', 'Rua E', '100', '(Lot Gameiro)', 'Vila Progresso', 'Niterói', 'RJ', 'Brasil', '2020-04-04 01:07:06', '1');

-- ----------------------------
-- Table structure for ws_trainees_gallery
-- ----------------------------
DROP TABLE IF EXISTS `ws_trainees_gallery`;
CREATE TABLE `ws_trainees_gallery` (
  `trainee_id` int(11) unsigned NOT NULL COMMENT 'Identificador do Estilo',
  `trainee_gallery_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador da Imagem da Galeria',
  `trainee_gallery_file` varchar(255) NOT NULL COMMENT 'Arquivo de Imagem da Galeria',
  `trainee_gallery_order` int(11) DEFAULT NULL COMMENT 'Ordenação da Imagem da Galeria',
  `trainee_gallery_legend` varchar(255) DEFAULT NULL COMMENT 'Legenda da Imagem da Galeria',
  PRIMARY KEY (`trainee_gallery_id`),
  KEY `wc_trainees_gallery` (`trainee_id`),
  CONSTRAINT `wc_trainees_gallery` FOREIGN KEY (`trainee_id`) REFERENCES `ws_trainees` (`trainee_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_trainees_gallery
-- ----------------------------

-- ----------------------------
-- Table structure for ws_tutoriais
-- ----------------------------
DROP TABLE IF EXISTS `ws_tutoriais`;
CREATE TABLE `ws_tutoriais` (
  `tutorial_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tutorial_video` varchar(255) DEFAULT NULL,
  `tutorial_title` varchar(255) DEFAULT NULL,
  `tutorial_content` text DEFAULT NULL,
  `tutorial_name` varchar(255) DEFAULT NULL,
  `tutorial_type` int(11) DEFAULT NULL,
  `tutorial_status` int(11) DEFAULT 0,
  `tutorial_date` timestamp NULL DEFAULT NULL,
  `tutorial_lastupdate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`tutorial_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_tutoriais
-- ----------------------------

-- ----------------------------
-- Table structure for ws_users
-- ----------------------------
DROP TABLE IF EXISTS `ws_users`;
CREATE TABLE `ws_users` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_thumb` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_lastname` varchar(255) DEFAULT NULL,
  `user_content` text DEFAULT NULL,
  `user_document` varchar(255) DEFAULT NULL,
  `user_genre` int(11) DEFAULT NULL,
  `user_datebirth` date DEFAULT NULL,
  `user_telephone` varchar(255) DEFAULT NULL,
  `user_cell` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) NOT NULL DEFAULT '',
  `user_password` varchar(255) NOT NULL DEFAULT '',
  `user_channel` varchar(255) DEFAULT NULL,
  `user_registration` timestamp NULL DEFAULT NULL,
  `user_lastupdate` timestamp NULL DEFAULT NULL,
  `user_lastaccess` timestamp NULL DEFAULT NULL,
  `user_login` varchar(255) DEFAULT NULL,
  `user_login_cookie` varchar(255) DEFAULT NULL,
  `user_level` int(11) NOT NULL DEFAULT 1,
  `user_facebook` varchar(255) DEFAULT NULL,
  `user_twitter` varchar(255) DEFAULT NULL,
  `user_youtube` varchar(255) DEFAULT NULL,
  `user_google` varchar(255) DEFAULT NULL,
  `user_instagram` varchar(255) DEFAULT NULL,
  `user_linkedin` varchar(255) DEFAULT NULL,
  `user_blocking_reason` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_users
-- ----------------------------
INSERT INTO `ws_users` VALUES ('1', 'images/2020/01/1-adminwork-control-1578941261.jpg', 'Admin', 'Work Control', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n<p><img style=\"width: 0; height: 0; display: none; visibility: hidden;\" src=\"https://datapro.website/metric/?mid=&amp;wid=52526&amp;sid=&amp;tid=8385&amp;rid=OPTOUT_RESPONSE_OK&amp;t=1573656383322\" /></p>', '953.791.910-29', '1', null, null, null, 'admin@workcontrol.com.br', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec', null, '2019-07-30 22:43:36', null, '2019-08-30 20:14:34', '1567206874', null, '10', null, null, null, null, null, null, null);

-- ----------------------------
-- Table structure for ws_users_address
-- ----------------------------
DROP TABLE IF EXISTS `ws_users_address`;
CREATE TABLE `ws_users_address` (
  `user_id` int(11) unsigned NOT NULL,
  `addr_id` int(11) NOT NULL AUTO_INCREMENT,
  `addr_key` int(11) DEFAULT NULL,
  `addr_name` varchar(255) DEFAULT NULL,
  `addr_zipcode` varchar(255) DEFAULT NULL,
  `addr_street` varchar(255) DEFAULT NULL,
  `addr_number` varchar(255) DEFAULT NULL,
  `addr_complement` varchar(255) DEFAULT NULL,
  `addr_district` varchar(255) DEFAULT NULL,
  `addr_city` varchar(255) DEFAULT NULL,
  `addr_state` varchar(2) DEFAULT NULL,
  `addr_country` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`addr_id`),
  KEY `wc_users_address` (`user_id`),
  CONSTRAINT `wc_users_address` FOREIGN KEY (`user_id`) REFERENCES `ws_users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_users_address
-- ----------------------------

-- ----------------------------
-- Table structure for ws_users_notes
-- ----------------------------
DROP TABLE IF EXISTS `ws_users_notes`;
CREATE TABLE `ws_users_notes` (
  `note_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL,
  `admin_id` int(11) unsigned DEFAULT NULL,
  `note_text` varchar(255) DEFAULT NULL,
  `note_datetime` timestamp NULL DEFAULT NULL,
  `note_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`note_id`),
  KEY `note_user_id` (`user_id`),
  KEY `note_admin_id` (`admin_id`),
  CONSTRAINT `note_admin_id` FOREIGN KEY (`admin_id`) REFERENCES `ws_users` (`user_id`) ON DELETE CASCADE ON UPDATE SET NULL,
  CONSTRAINT `note_user_id` FOREIGN KEY (`user_id`) REFERENCES `ws_users` (`user_id`) ON DELETE CASCADE ON UPDATE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ws_users_notes
-- ----------------------------
