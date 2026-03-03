-- 26 Labs Database Schema

CREATE TABLE IF NOT EXISTS `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `email` VARCHAR(255) UNIQUE NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `name` VARCHAR(255),
  `remember_token` VARCHAR(255),
  `remember_token_expiry` DATETIME,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `case_studies` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) UNIQUE NOT NULL,
  `client_name` VARCHAR(255) NOT NULL,
  `description` LONGTEXT,
  `tags` VARCHAR(255),
  `hero_image` VARCHAR(255),
  `gallery_images` LONGTEXT,
  `services_provided` VARCHAR(255),
  `year` INT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` TIMESTAMP NULL,
  KEY `created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `posts` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) UNIQUE NOT NULL,
  `content` LONGTEXT,
  `featured_image` VARCHAR(255),
  `publish_date` DATETIME,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` TIMESTAMP NULL,
  KEY `publish_date` (`publish_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `services` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) UNIQUE NOT NULL,
  `description` LONGTEXT,
  `short_description` VARCHAR(500),
  `icon` VARCHAR(50),
  `bullets` LONGTEXT,
  `deliverables` LONGTEXT,
  `who_for` LONGTEXT,
  `engagement_types` LONGTEXT,
  `order_index` INT DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` TIMESTAMP NULL,
  KEY `order_index` (`order_index`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `stats` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `label` VARCHAR(255) NOT NULL,
  `value` VARCHAR(255),
  `order_index` INT DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` TIMESTAMP NULL,
  KEY `order_index` (`order_index`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `inquiries` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `company` VARCHAR(255),
  `email` VARCHAR(255) NOT NULL,
  `message` LONGTEXT NOT NULL,
  `services` VARCHAR(255),
  `budget` VARCHAR(255),
  `ip_address` VARCHAR(45),
  `user_agent` TEXT,
  `read_at` TIMESTAMP NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  KEY `email` (`email`),
  KEY `created_at` (`created_at`),
  KEY `read_at` (`read_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert Case Study Labs services
INSERT IGNORE INTO `services` (`title`, `slug`, `description`, `short_description`, `order_index`) VALUES
  ('Brand Strategy', 'brand-strategy', 'The foundation everything else is built on.', 'Market research, positioning, messaging architecture, verbal identity, and naming.', 1),
  ('Branding & Production', 'branding-production', 'Visual identity built to command attention and stand the test of time.', 'Logotype, typography, visual language, motion, brand guidelines, and brand applications.', 2),
  ('Web Design', 'web-design', 'Websites that convert and don\'t embarrass you.', 'UX strategy, custom WordPress development, e-commerce, editorial CMS, motion, and performance.', 3),
  ('Media Buying', 'media-buying', '$2M+ deployed. Zero wasted in decks.', 'High-risk category strategy, paid social, performance creative, cannabis networks, attribution, and retargeting.', 4),
  ('Content & Social', 'content-social', 'Content that builds culture, not just a following.', 'Content strategy, editorial production, campaign creative, social management, influencer strategy, and visual production.', 5),
  ('Lifecycle Marketing', 'lifecycle-marketing', 'The money is in the list. We help you keep it.', 'Email programs, segmentation, automation, CRM setup, retention campaigns, and reporting.', 6);

-- Insert default stats
INSERT IGNORE INTO `stats` (`label`, `value`, `order_index`) VALUES
  ('Projects Completed', '150+', 1),
  ('Years of Experience', '12+', 2),
  ('Team Members', '25+', 3),
  ('Happy Clients', '200+', 4);
