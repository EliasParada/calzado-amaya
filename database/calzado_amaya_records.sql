-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.7.33 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Volcando datos para la tabla calzado_amaya.administradores: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `administradores` DISABLE KEYS */;
INSERT INTO `administradores` (`usuario_id`) VALUES
	(1);
/*!40000 ALTER TABLE `administradores` ENABLE KEYS */;

-- Volcando datos para la tabla calzado_amaya.categorias: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` (`categoria_id`, `nombre`) VALUES
	(1, 'Sandalias Señorial'),
	(3, 'Tenis Deportivos'),
	(4, 'Zapato casual femenino'),
	(5, 'Zapato casual masculino'),
	(6, 'Tenis Casual'),
	(7, 'Sandalia Juvenil'),
	(8, 'Zapato de Trabajo Masculino'),
	(9, 'Yinas');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;

-- Volcando datos para la tabla calzado_amaya.compras: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `compras` DISABLE KEYS */;
INSERT INTO `compras` (`compra_id`, `usuario_id`, `factura_nombre`, `fecha_compra`, `fecha_retiro`, `fecha_envio`, `ubicacion_envio`, `descuento`, `precio_real`, `precio_total`, `precio_neto`, `comision_pagadito`, `estado`) VALUES
	(1, NULL, 'CA-FACTURA-20240425013341-229', '2024-04-25 01:33:41', NULL, NULL, 'Aqui', 0, 0, 39.5, 39.5, 2.225, 'COMPLETADO');
/*!40000 ALTER TABLE `compras` ENABLE KEYS */;

-- Volcando datos para la tabla calzado_amaya.detalle_compras: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `detalle_compras` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_compras` ENABLE KEYS */;

-- Volcando datos para la tabla calzado_amaya.productos: ~36 rows (aproximadamente)
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` (`producto_id`, `codigo`, `categoria_id`, `nombre`, `descripcion`, `colores`, `tallas`, `imagenes`, `precio_compra`, `precio_venta`, `existencia`) VALUES
	(5, '', 1, 'Tenis Gord7 para niñoa', 'hbuds d s d sd stos tenis deportivos de lona en negro con detalles naranjas son ideales para cualquier actividad física. Ofrecen resistencia y comodidad para un estilo dinámico', '["Verde","Azul"]', '["24","32"]', '["1713542365_Kumander.svg"]', 15, 18.75, 2),
	(6, '', 4, 'Kharfran Casual', 'Con su diseño artesanal y su acabado en gamuza, estos zapatos añaden un toque de distinción a cualquier conjunto.', NULL, NULL, '["1712985068_WhatsApp Image 2024-03-15 at 8.59.32 AM (2).jpeg"]', 18, 22.5, 16),
	(7, '', 3, 'Tenis negros Gord7 para niño', 'Con su diseño industrial, ofrecen el equilibrio perfecto entre funcionalidad y moda para los pequeños deportistas.', NULL, NULL, '["1712985278_WhatsApp Image 2024-03-15 at 8.59.32 AM.jpeg"]', 10, 12.5, 6),
	(8, '', 1, 'Tenis gris Gord7 para niño', 'Perfectos para jugar y explorar, estos tenis son una elección confiable para cualquier ocasión.', NULL, NULL, '["1712985441_WhatsApp Image 2024-03-15 at 8.59.33 AM (1).jpeg"]', 10, 12.5, 7),
	(9, '', 1, 'Sandalia Maribella', 'Estas elegantes sandalias señoriales son el complemento perfecto para lucir sofisticada y cómoda', NULL, NULL, '["1712985688_WhatsApp Image 2024-03-15 at 8.59.33 AM (2).jpeg"]', 25, 31.25, 4),
	(10, '', 1, 'Zapato artesanal negro', 'Confeccionados artesanalmente, estos zapatos son una elección ideal para quienes buscan distinción y confort en cada paso.', NULL, NULL, '["1712985867_WhatsApp Image 2024-03-15 at 8.59.33 AM (3).jpeg"]', 8, 10, 5),
	(11, '', 6, 'Tenis Nike Rosado y blanco para niña', 'Estos tenis casuales son una combinación perfecta de estilo y durabilidad.', NULL, NULL, '["1712986159_WhatsApp Image 2024-03-15 at 8.59.33 AM (4).jpeg"]', 18, 22.5, 8),
	(12, '', 6, 'Nike blanco unicef', 'Estos tenis casuales son la combinación perfecta de estilo y comodidad', NULL, NULL, '["1712986725_WhatsApp Image 2024-03-15 at 8.59.33 AM.jpeg"]', 18, 22.5, 3),
	(13, '', 4, 'Zapato artesanal tacón negro', 'Fabricados artesanalmente con gamuza de alta calidad en color negro, ofrecen una apariencia elegante y sofisticada.', NULL, NULL, '["1712986921_WhatsApp Image 2024-03-15 at 8.59.34 AM (1).jpeg"]', 18, 22.5, 6),
	(14, '', 1, 'Elegance tacón cerrado negro', 'Son una combinación de comodidad y estilo clásico. Fabricadas con gamuza en color negro, ofrecen un aspecto versátil y fácil de combinar.', NULL, NULL, '["1712987259_WhatsApp Image 2024-03-15 at 8.59.34 AM (2).jpeg"]', 24, 30, 10),
	(15, '', 4, 'Zapato artesanal Café', 'Estos zapatos casuales para mujeres son perfectos para un estilo cómodo y versátil.', NULL, NULL, '["1712987447_WhatsApp Image 2024-03-15 at 8.59.34 AM (3).jpeg"]', 12, 15, 4),
	(16, '', 7, 'Elegance sandalia blanca', 'Elaboradas artesanalmente con cuero sintético en color blanco, ofrecen comodidad y versatilidad para el día a día.', NULL, NULL, '["1712987628_WhatsApp Image 2024-03-15 at 8.59.34 AM (4).jpeg"]', 8, 10, 5),
	(17, '', 7, 'Sandalia artesanal beige', 'Elaboradas artesanalmente con cuero sintético en color blanco, ofrecen comodidad y versatilidad para el día a día.', NULL, NULL, '["1712987742_WhatsApp Image 2024-03-15 at 8.59.34 AM.jpeg"]', 8, 10, 13),
	(18, '', 8, 'Zapato artesanal Timberland', 'Elaborados con cuero en color café, ofrecen durabilidad y confort durante largas jornadas laborales.', NULL, NULL, '["1712987894_WhatsApp Image 2024-03-15 at 8.59.35 AM (1).jpeg"]', 28, 35, 10),
	(19, '', 6, 'All Start  Ocre', 'Con su diseño industrial, estos tenis son ideales para acompañar cualquier aventura urbana con estilo y comodidad.', NULL, NULL, '["1712988036_WhatsApp Image 2024-03-15 at 8.59.35 AM (2).jpeg"]', 12, 15, 4),
	(20, '', 1, 'Elegance negro con moño', 'Su diseño artesanal las hace una opción confiable para cualquier ocasión', NULL, NULL, '["1712988212_WhatsApp Image 2024-03-15 at 8.59.35 AM (3).jpeg"]', 16, 20, 13),
	(21, '', 3, 'Tenis kids con luces', 'Estos tenis deportivos son la opción perfecta para los más pequeños en movimiento', NULL, NULL, '["1712988350_WhatsApp Image 2024-03-15 at 8.59.35 AM (4).jpeg"]', 18, 22.5, 4),
	(22, '', 8, 'John 1000', 'Fabricados artesanalmente con cuero de alta calidad en color negro, ofrecen durabilidad y estilo en cada paso.', NULL, NULL, '["1712988526_WhatsApp Image 2024-03-15 at 8.59.35 AM.jpeg"]', 28, 35, 9),
	(23, '', 3, 'Nike azul y blanco para niños', 'Fabricados con lona resistente en una combinación de colores azul con blanco, ofrecen durabilidad y estilo', NULL, NULL, '["1712988670_WhatsApp Image 2024-03-15 at 8.59.36 AM (1).jpeg"]', 15, 18.75, 16),
	(24, '', 6, 'Jordan negro y blanco', 'Fabricados con gamuza en una combinación de colores negro con suela  blanca, ofrecen durabilidad y versatilidad en cada paso', NULL, NULL, '["1712988910_WhatsApp Image 2024-03-15 at 8.59.36 AM (2).jpeg"]', 15, 18.75, 4),
	(25, '', 1, 'Sandalia artesanal beige con decoración', 'Estas sandalias artesanales son sinónimo de elegancia y comodidad', NULL, NULL, '["1712989062_WhatsApp Image 2024-03-15 at 8.59.36 AM.jpeg"]', 24, 30, 14),
	(26, '', 6, 'Nike blanco para niño', 'Estos tenis casuales son una opción versátil y cómoda para el día a día', NULL, NULL, '["1712989253_WhatsApp Image 2024-03-15 at 8.59.37 AM.jpeg"]', 18, 22.5, 2),
	(27, '', 9, 'Yina Mobec negro y rojo', 'Las Yinas son la elección perfecta para quienes buscan comodidad y estilo en cada paso', NULL, NULL, '["1712989547_WhatsApp Image 2024-03-15 at 8.59.39 AM (1).jpeg"]', 7, 8.75, 15),
	(28, '', 9, 'Yina sapo morada normal', 'Hechas con goma resistente en un tono morado vibrante', NULL, NULL, '["1712989726_WhatsApp Image 2024-03-15 at 8.59.39 AM (2).jpeg"]', 6, 7.5, 10),
	(29, '', 1, 'Mobec color negro', 'Confeccionadas con goma resistente en un elegante color negro, estas yinas ofrecen durabilidad y comodidad incomparables.', NULL, NULL, '["1712989916_WhatsApp Image 2024-03-15 at 8.59.39 AM (3).jpeg"]', 7, 8.75, 4),
	(30, '', 9, 'Nike yina negra', 'Las yinas de Nike son la combinación perfecta de estilo y rendimiento', NULL, NULL, '["1712990090_WhatsApp Image 2024-03-15 at 8.59.39 AM (4).jpeg"]', 7.5, 9.4, 3),
	(31, '', 6, 'Vans negro y blanco', 'Con los tenis casuales de Vans, puedes lucir a la moda mientras mantienes la comodidad en tus pies', NULL, NULL, '["1712990290_WhatsApp Image 2024-03-15 at 8.59.39 AM.jpeg"]', 12, 15, 3),
	(32, '', 9, 'Puma yina rosada', 'Con las Yinas de Puma, puedes expresar tu estilo y confianza mientras te mantienes cómodo durante todo el día', NULL, NULL, '["1712990414_WhatsApp Image 2024-03-15 at 8.59.40 AM (1).jpeg"]', 6, 7.5, 6),
	(33, '', 9, 'Puerto Rico azul', 'Con las Yinas, puedes enfrentar cualquier desafío con confianza y estilo', NULL, NULL, '["1712990525_WhatsApp Image 2024-03-15 at 8.59.40 AM (2).jpeg"]', 7.5, 9.4, 11),
	(34, '', 9, 'Yinas tiburón gris', 'Con su diseño industrial, son una opción confiable para cualquier actividad.', NULL, NULL, '["1712990668_WhatsApp Image 2024-03-15 at 8.59.40 AM (3).jpeg"]', 12, 15, 6),
	(35, '', 5, 'Zapato artesanal cuero para niño', 'Este zapato casual masculino ofrece un estilo artesanal y duradero.', NULL, NULL, '["1712990975_WhatsApp Image 2024-03-15 at 8.59.40 AM (4).jpeg"]', 25, 31.25, 5),
	(36, '', 9, 'Mobec color azul y negro', '. Fabricadas con goma resistente para ofrecer durabilidad y comodidad en cada paso.', NULL, NULL, '["1712991114_WhatsApp Image 2024-03-15 at 8.59.40 AM.jpeg"]', 7, 8.75, 6),
	(37, '', 5, 'Zapato artesanal', 'Explora nuestro Zapato Casual Masculino, una pieza artesanalmente elaborada con cuero de alta calidad para brindarte estilo y durabilidad.', NULL, NULL, '["1712991255_WhatsApp Image 2024-03-15 at 8.59.41 AM (1).jpeg"]', 22, 27.5, 3),
	(38, '', 5, 'Zapato artesanal TRAFFIC', 'Descubre el Zapato Casual Masculino TRAFFIC, una verdadera obra artesanal elaborada con cuero de alta calidad para brindarte estilo y comodidad.', NULL, NULL, '["1712991388_WhatsApp Image 2024-03-15 at 8.59.41 AM (2).jpeg"]', 25, 31.25, 5),
	(39, '', 5, 'Zapato artesanal chato', 'Ya sea para una salida casual o una ocasión especial, este zapato te garantiza una apariencia elegante y un confort duradero', NULL, NULL, '["1712991551_WhatsApp Image 2024-03-15 at 8.59.41 AM (4).jpeg"]', 30, 37.5, 6),
	(40, '', 6, '22', '222', '["Verde","Azul"]', '["25","26","38","39"]', '["1713500455_Xero.svg","1713507687_BANNER EXP11.png","1713507687_Fedora.svg"]', 2, 2, 2);
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;

-- Volcando datos para la tabla calzado_amaya.puntos_usuarios: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `puntos_usuarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `puntos_usuarios` ENABLE KEYS */;

-- Volcando datos para la tabla calzado_amaya.usuarios: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`usuario_id`, `nombre`, `correo`, `password`) VALUES
	(1, 'Elias', 'elias@gmail.com', '$2y$12$hQhmrWfr98fS3eXn4oClOueepoTX50Sn2E1ukRvm5HhqYMHxl4XRG');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
