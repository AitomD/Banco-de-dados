CREATE TABLE `usuario`(
    `id_usuario` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nome` VARCHAR(50) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `senha` VARCHAR(64) NOT NULL
);
CREATE TABLE `filme_serie`(
    `id_filmeserie` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `titulo` VARCHAR(80) NOT NULL,
    `dt_lancamento` DATE NOT NULL,
    `duracao` TIME NOT NULL,
    `url_imagem` VARCHAR(255) NOT NULL
);
CREATE TABLE `avaliacao`(
    `id_filmeserie` BIGINT NOT NULL,
    `nota` DECIMAL(10, 2) NOT NULL,
    `comentario` VARCHAR(255) NOT NULL,
    `dt_avaliacao` DATE NOT NULL,
    `id_usuario` BIGINT NOT NULL
);
ALTER TABLE
    `avaliacao` ADD INDEX `avaliacao_id_usuario_id_filmeserie_index`(`id_usuario`, `id_filmeserie`);
CREATE TABLE `genero`(
    `id_genero` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nm_genero` VARCHAR(50) NOT NULL
);
CREATE TABLE `filmeserie_genero`(
    `id_filmeserie` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `id_genero` BIGINT NOT NULL
);
ALTER TABLE
    `filmeserie_genero` ADD INDEX `filmeserie_genero_id_filmeserie_id_genero_index`(`id_filmeserie`, `id_genero`);
ALTER TABLE
    `avaliacao` ADD CONSTRAINT `avaliacao_id_usuario_foreign` FOREIGN KEY(`id_usuario`) REFERENCES `usuario`(`id_usuario`);
ALTER TABLE
    `filmeserie_genero` ADD CONSTRAINT `filmeserie_genero_id_genero_foreign` FOREIGN KEY(`id_genero`) REFERENCES `genero`(`id_genero`);
ALTER TABLE
    `filmeserie_genero` ADD CONSTRAINT `filmeserie_genero_id_filmeserie_foreign` FOREIGN KEY(`id_filmeserie`) REFERENCES `filme_serie`(`id_filmeserie`);
ALTER TABLE
    `avaliacao` ADD CONSTRAINT `avaliacao_id_filmeserie_foreign` FOREIGN KEY(`id_filmeserie`) REFERENCES `filme_serie`(`id_filmeserie`);