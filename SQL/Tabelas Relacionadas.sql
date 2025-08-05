CREATE TABLE `Usuarios`(
    `ID-Usuários` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `Nome` VARCHAR(80) NOT NULL,
    `E-mail` VARCHAR(110) NOT NULL,
    `Senha` VARCHAR(30) NOT NULL
);
CREATE TABLE `Filmes`(
    `ID-Filmes` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `Titulo` VARCHAR(255) NOT NULL,
    `Data-Lançamento` DATE NOT NULL,
    `Produtora` VARCHAR(80) NOT NULL,
    `Tempo-Duração` INT NOT NULL,
    `Sinopse` VARCHAR(255) NOT NULL
);
CREATE TABLE `Avalições`(
    `ID-Avaliação` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `ID-Usuario` INT NOT NULL,
    `ID-Filme` INT NOT NULL,
    `Nota` FLOAT(10) NOT NULL,
    `Data-Avaliacao` DATE NOT NULL,
    `Comentario` VARCHAR(255) NOT NULL
);
ALTER TABLE
    `Avalições` ADD INDEX `avalições_id_usuario_id_filme_index`(`ID-Usuario`, `ID-Filme`);
ALTER TABLE
    `Avalições` ADD CONSTRAINT `avalições_id_filme_foreign` FOREIGN KEY(`ID-Filme`) REFERENCES `Filmes`(`ID-Filmes`);
ALTER TABLE
    `Avalições` ADD CONSTRAINT `avalições_id_avaliação_foreign` FOREIGN KEY(`ID-Avaliação`) REFERENCES `Usuarios`(`ID-Usuários`);