-- agenda.pessoas definition

CREATE TABLE `pessoas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nome` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- agenda.atividades definition
CREATE TABLE `atividades` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `data_inicio` timestamp NOT NULL,
  `data_prazo` timestamp NOT NULL,
  `data_conclusao` timestamp NOT NULL,
  `status` smallint NOT NULL COMMENT '1: Aguardando, 2: Realizado, 3: Não realizado',
  `titulo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `responsavel_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `atividades_responsavel_id_foreign` (`responsavel_id`),
  CONSTRAINT `atividades_responsavel_id_foreign` FOREIGN KEY (`responsavel_id`) REFERENCES `pessoas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

