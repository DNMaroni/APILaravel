CREATE TABLE `pessoas` (
	`id` BIGINT UNIQUE NOT NULL AUTO_INCREMENT,
	`nome` TEXT(100) NOT NULL,
	`email` VARCHAR(50) NOT NULL,
	`telefone` VARCHAR(11) NOT NULL,
    `criacao` TIMESTAMP NOT NULL DEFAULT NOW(),
	`atualizacao` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`)
);

CREATE TABLE `atividades` (
	`id` BIGINT UNIQUE NOT NULL AUTO_INCREMENT,
	`data_inicio` TIMESTAMP NOT NULL,
	`data_prazo` TIMESTAMP NOT NULL,
	`data_conclusao` TIMESTAMP NOT NULL,
	`status` SMALLINT NOT NULL,
	`titulo` VARCHAR(150) NOT NULL,
	`descricao` TEXT(1000),
	`responsavel_id` BIGINT NOT NULL,
	PRIMARY KEY (`id`),
    FOREIGN KEY (status_id) REFERENCES atividades_status(id),
    FOREIGN KEY (responsavel_id) REFERENCES pessoas(id)
);

/* INSERTS */
INSERT INTO pessoas (nome, email, telefone) VALUES ('Maria S.', 'marias@gmail.com', '54999999999'),('João S.', 'joaos@gmail.com', '54999999999'),('Cláudio S.', 'claudios@gmail.com', '54999999999');


