CREATE DATABASE calzado_amaya;

CREATE TABLE usuarios (
    usuario_id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    nombre CHAR(100) NOT NULL,
    correo CHAR(100) NOT NULL,
    contrasena CHAR(100) NOT NULL,
    PRIMARY KEY (usuario_id)
);

CREATE TABLE administradores (
    usuario_id INT(10) UNSIGNED NULL DEFAULT NULL,
    INDEX fk_administrador_usuario (usuario_id),
    CONSTRAINT fk_administrador_usuario FOREIGN KEY (usuario_id) REFERENCES usuarios (usuario_id) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE puntos_usuarios (
    usuario_id INT(10) UNSIGNED NOT NULL,
    puntos INT(10) UNSIGNED NOT NULL,
    INDEX fk_puntos_usuario (usuario_id),
    CONSTRAINT fk_puntos_usuario FOREIGN KEY (usuario_id) REFERENCES usuarios (usuario_id) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE categorias (
    categoria_id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    nombre CHAR(100) NOT NULL,
    PRIMARY KEY (`categoria_id`)
);

CREATE TABLE productos (
    producto_id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    categoria_id INT(10) UNSIGNED NOT NULL,
    nombre CHAR(100) NOT NULL,
    descripcion CHAR(100) NOT NULL,
    precio_compra FLOAT NOT NULL DEFAULT '0',
    precio_venta FLOAT NOT NULL DEFAULT '0',
    existencia INT(10) NOT NULL DEFAULT '0',
    PRIMARY KEY (producto_id),
    INDEX fk_producto_categoria (categoria_id),
    CONSTRAINT fk_producto_categoria FOREIGN KEY (categoria_id) REFERENCES categorias (categoria_id) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE compras (
    compra_id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    usuario_id INT(10) UNSIGNED DEFAULT NULL,
    fecha_compra TIMESTAMP NOT NULL,
    fecha_retiro TIMESTAMP NULL DEFAULT NULL,
    fecha_entrega TIMESTAMP NULL DEFAULT NULL,
    ubicacion_entrega CHAR(100) NOT NULL,
    descuento_procentaje FLOAT NOT NULL DEFAULT '0',
    precio_real FLOAT NOT NULL DEFAULT '0',
    precio_envio FLOAT NOT NULL DEFAULT '0',
    precio_total FLOAT NOT NULL DEFAULT '0',
    estado INT(10) NOT NULL DEFAULT '0',
    PRIMARY KEY (compra_id),
    INDEX fk_compra_usuario (usuario_id),
    CONSTRAINT fk_compra_usuario FOREIGN KEY (usuario_id) REFERENCES usuarios (usuario_id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE detalle_compras (
    compra_id INT(10) UNSIGNED NOT NULL,
    producto_id INT(10) UNSIGNED NOT NULL,
    cantidad INT(10) NOT NULL,
    INDEX fk_detalle_compra (compra_id),
    INDEX fk_detalle_producto (producto_id),
    CONSTRAINT fk_detalle_compra FOREIGN KEY (compra_id) REFERENCES compras (compra_id) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT fk_detalle_producto FOREIGN KEY (producto_id) REFERENCES productos (producto_id) ON UPDATE NO ACTION ON DELETE RESTRICT
);