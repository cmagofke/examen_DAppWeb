SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `importadora_db` ;
CREATE SCHEMA IF NOT EXISTS `importadora_db` DEFAULT CHARACTER SET latin7 ;
USE `importadora_db` ;



-- -----------------------------------------------------
-- Table `importadora_db`.`perfil`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `importadora_db`.`perfil` ;

CREATE  TABLE IF NOT EXISTS `importadora_db`.`perfil` (
  `id_perfil` INT NOT NULL AUTO_INCREMENT ,
  `descripcion_perfil` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id_perfil`) )
ENGINE = InnoDB;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id_perfil`, `descripcion_perfil`) VALUES
(1, 'administrador'),
(2, 'consulta'),
(3, 'vendedor');
-- -----------------------------------------------------
-- Table `importadora_db`.`usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `importadora_db`.`usuarios` ;

CREATE  TABLE IF NOT EXISTS `importadora_db`.`usuarios` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT ,
  `login_usuario` VARCHAR(45) NOT NULL ,
  `pass_usuario` VARCHAR(45) NOT NULL ,
  `nombre_usuario` VARCHAR(45) NOT NULL ,
  `apellido_usuario` VARCHAR(45) NULL ,
  `correo_usuario` VARCHAR(45) NULL ,
  `edad_usuario` INT NULL ,
  `id_perfil` INT NOT NULL ,
  `fechaNacimiento_usuario` DATE NULL ,
  `perfil_id_perfil` INT NOT NULL ,
  PRIMARY KEY (`id_usuario`, `perfil_id_perfil`) ,
  INDEX `fk_usuarios_perfil1_idx` (`perfil_id_perfil` ASC) ,
  CONSTRAINT `fk_usuarios_perfil1`
    FOREIGN KEY (`perfil_id_perfil` )
    REFERENCES `importadora_db`.`perfil` (`id_perfil` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `login_usuario`, `pass_usuario`, `nombre_usuario`, `apellido_usuario`, `correo_usuario`, `edad_usuario`, `id_perfil`, `fechaNacimiento_usuario`, `perfil_id_perfil`) VALUES
(2, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 'admin importadora','adminimport', 'admin@lotenemostodo.cl', 27, 1, '1987-09-23', 1);

--
-- -----------------------------------------------------
-- Table `importadora_db`.`orden_compras`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `importadora_db`.`orden_compras` ;

CREATE  TABLE IF NOT EXISTS `importadora_db`.`orden_compras` (
  `id_oc` INT NOT NULL AUTO_INCREMENT ,
  `fecha_emision` DATE NULL ,
  `total_oc` INT NULL ,
  `estado` VARCHAR(45) NOT NULL ,
  `id_usuario` INT NOT NULL ,
  `usuarios_id_usuario` INT NOT NULL ,
  PRIMARY KEY (`id_oc`, `usuarios_id_usuario`) ,
  INDEX `fk_orden_compras_usuarios_idx` (`usuarios_id_usuario` ASC) ,
  CONSTRAINT `fk_orden_compras_usuarios`
    FOREIGN KEY (`usuarios_id_usuario` )
    REFERENCES `importadora_db`.`usuarios` (`id_usuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `importadora_db`.`tipo_producto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `importadora_db`.`tipo_producto` ;

CREATE  TABLE IF NOT EXISTS `importadora_db`.`tipo_producto` (
  `id_tipoProducto` INT NOT NULL AUTO_INCREMENT ,
  `descripcion_tipo` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id_tipoProducto`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `importadora_db`.`productos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `importadora_db`.`productos` ;

CREATE  TABLE IF NOT EXISTS `importadora_db`.`productos` (
  `id_producto` INT NOT NULL AUTO_INCREMENT ,
  `descripcion` VARCHAR(45) NOT NULL ,
  `precio` INT NULL ,
  `unidad` INT NULL ,
  `id_tipoProducto` INT NOT NULL ,
  `tipo_producto_id_tipoProducto` INT NOT NULL ,
  PRIMARY KEY (`id_producto`, `tipo_producto_id_tipoProducto`) ,
  INDEX `fk_productos_tipo_producto1_idx` (`tipo_producto_id_tipoProducto` ASC) ,
  CONSTRAINT `fk_productos_tipo_producto1`
    FOREIGN KEY (`tipo_producto_id_tipoProducto` )
    REFERENCES `importadora_db`.`tipo_producto` (`id_tipoProducto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `importadora_db`.`detalle_oc`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `importadora_db`.`detalle_oc` ;

CREATE  TABLE IF NOT EXISTS `importadora_db`.`detalle_oc` (
  `id_oc` INT NOT NULL ,
  `id_producto` INT NOT NULL ,
  `cantidad` INT NOT NULL ,
  `sub_total` INT NOT NULL ,
  `orden_compras_id_oc` INT NOT NULL ,
  `orden_compras_usuarios_id_usuario` INT NOT NULL ,
  `productos_id_producto` INT NOT NULL ,
  PRIMARY KEY (`id_oc`, `id_producto`, `orden_compras_id_oc`, `orden_compras_usuarios_id_usuario`, `productos_id_producto`) ,
  INDEX `fk_detalle_oc_orden_compras1_idx` (`orden_compras_id_oc` ASC, `orden_compras_usuarios_id_usuario` ASC) ,
  INDEX `fk_detalle_oc_productos1_idx` (`productos_id_producto` ASC) ,
  CONSTRAINT `fk_detalle_oc_orden_compras1`
    FOREIGN KEY (`orden_compras_id_oc` , `orden_compras_usuarios_id_usuario` )
    REFERENCES `importadora_db`.`orden_compras` (`id_oc` , `usuarios_id_usuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalle_oc_productos1`
    FOREIGN KEY (`productos_id_producto` )
    REFERENCES `importadora_db`.`productos` (`id_producto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `importadora_db`.`menu`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `importadora_db`.`menu` ;

CREATE  TABLE IF NOT EXISTS `importadora_db`.`menu` (
  `id_menu` INT NOT NULL AUTO_INCREMENT ,
  `nombre_menu` VARCHAR(45) NULL ,
  `destino_menu` VARCHAR(45) NULL ,
  `id_perfil` INT NOT NULL ,
  `perfil_id_perfil` INT NOT NULL ,
  PRIMARY KEY (`id_menu`, `perfil_id_perfil`) ,
  INDEX `fk_menu_perfil1_idx` (`perfil_id_perfil` ASC) ,
  CONSTRAINT `fk_menu_perfil1`
    FOREIGN KEY (`perfil_id_perfil` )
    REFERENCES `importadora_db`.`perfil` (`id_perfil` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


USE `importadora_db` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
