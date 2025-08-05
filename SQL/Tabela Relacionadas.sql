CREATE TABLE `Usuarios`(
    `ID-usuario` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `Nome` VARCHAR(80) NOT NULL,
    `E-mail` VARCHAR(110) NOT NULL,
    `Senha` VARCHAR(30) NOT NULL
);
CREATE TABLE `Filmes`(
    `ID-Filme` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `Titulo` VARCHAR(255) NOT NULL,
    `Data-Lançamento` DATE NOT NULL,
    `Produtora` VARCHAR(80) NOT NULL,
    `Tempo-Duração` INT NOT NULL,
    `Sinopse` VARCHAR(255) NOT NULL
);
CREATE TABLE `Avalicoes`(
    `ID-Avaliacao` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `ID-Usuario` INT NOT NULL,
    `ID-Filme` INT NOT NULL,
    `Nota` FLOAT(10) NOT NULL,
    `Data-Avaliacao` DATE NOT NULL,
    `Comentario` VARCHAR(255) NOT NULL,
    PRIMARY KEY(`ID-Usuario`)
);
ALTER TABLE
    `Avalicoes` ADD PRIMARY KEY(`ID-Filme`);
ALTER TABLE
    `Avalicoes` ADD CONSTRAINT `avalicoes_id_filme_foreign` FOREIGN KEY(`ID-Filme`) REFERENCES `Filmes`(`ID-Filme`);
ALTER TABLE
    `Avalicoes` ADD CONSTRAINT `avalicoes_id_avaliacao_foreign` FOREIGN KEY(`ID-Avaliacao`) REFERENCES `Usuarios`(`ID-usuario`);