SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

CREATE SCHEMA IF NOT EXISTS `venda_ingressos_show` DEFAULT CHARACTER SET utf8mb4;
USE `venda_ingressos_show`;

CREATE TABLE IF NOT EXISTS `venda_ingressos_show`.`shows` (
  `id_show` INT NOT NULL AUTO_INCREMENT,
  `nome_show` VARCHAR(150) NOT NULL,
  `data_show` DATE NOT NULL,
  `hora_show` TIME NULL,
  `local_show` VARCHAR(150) NULL,
  `descricao` TEXT NULL,
  PRIMARY KEY (`id_show`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `venda_ingressos_show`.`tipos_ingresso` (
  `id_tipo` INT NOT NULL AUTO_INCREMENT,
  `nome_tipo` VARCHAR(50) NOT NULL,
  `descricao_tipo` VARCHAR(150) NULL,
  PRIMARY KEY (`id_tipo`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `venda_ingressos_show`.`ingressos` (
  `id_ingresso` INT NOT NULL AUTO_INCREMENT,
  `show_id_show` INT NOT NULL,
  `tipo_ingresso_id_tipo` INT NOT NULL,
  `preco` DECIMAL(10,2) NOT NULL,
  `quantidade_total` INT NOT NULL,
  `quantidade_disponivel` INT NOT NULL,
  PRIMARY KEY (`id_ingresso`),
  INDEX `fk_show_idx` (`show_id_show` ASC),
  INDEX `fk_tipo_idx` (`tipo_ingresso_id_tipo` ASC),
  CONSTRAINT `fk_ingressos_show`
    FOREIGN KEY (`show_id_show`)
    REFERENCES `venda_ingressos_show`.`shows` (`id_show`)
    ON DELETE CASCADE,
  CONSTRAINT `fk_ingressos_tipo`
    FOREIGN KEY (`tipo_ingresso_id_tipo`)
    REFERENCES `venda_ingressos_show`.`tipos_ingresso` (`id_tipo`)
    ON DELETE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `venda_ingressos_show`.`clientes` (
  `id_cliente` INT NOT NULL AUTO_INCREMENT,
  `nome_cliente` VARCHAR(100) NOT NULL,
  `email_cliente` VARCHAR(100) NULL,
  `telefone_cliente` VARCHAR(20) NULL,
  PRIMARY KEY (`id_cliente`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `venda_ingressos_show`.`vendas` (
  `id_venda` INT NOT NULL AUTO_INCREMENT,
  `cliente_id_cliente` INT NOT NULL,
  `ingresso_id_ingresso` INT NOT NULL,
  `quantidade` INT NOT NULL,
  `valor_total` DECIMAL(10,2) NOT NULL,
  `data_venda` DATE NOT NULL,
  PRIMARY KEY (`id_venda`),
  INDEX `fk_venda_cliente_idx` (`cliente_id_cliente` ASC),
  INDEX `fk_venda_ingresso_idx` (`ingresso_id_ingresso` ASC),
  CONSTRAINT `fk_vendas_cliente`
    FOREIGN KEY (`cliente_id_cliente`)
    REFERENCES `venda_ingressos_show`.`clientes` (`id_cliente`)
    ON DELETE NO ACTION,
  CONSTRAINT `fk_vendas_ingresso`
    FOREIGN KEY (`ingresso_id_ingresso`)
    REFERENCES `venda_ingressos_show`.`ingressos` (`id_ingresso`)
    ON DELETE NO ACTION)
ENGINE = InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
