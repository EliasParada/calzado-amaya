-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Volcando datos para la tabla calzado_amaya.categorias: ~8 rows (aproximadamente)
INSERT INTO `categorias` (`categoria_id`, `nombre`) VALUES
	(1, 'Sandalias Señorial'),
	(3, 'Tenis Deportivos'),
	(4, 'Zapato casual femenino'),
	(5, 'Zapato casual masculino'),
	(6, 'Tenis Casual'),
	(7, 'Sandalia Juvenil'),
	(8, 'Zapato de Trabajo Masculino'),
	(9, 'Yinas');

-- Volcando datos para la tabla calzado_amaya.productos: ~30 rows (aproximadamente)
INSERT INTO `productos` (`producto_id`, `categoria_id`, `imagenes`, `nombre`, `descripcion`, `precio_compra`, `precio_venta`, `existencia`, `colores`, `tallas`) VALUES
	(6, 4, '["1712985068_WhatsApp Image 2024-03-15 at 8.59.32 AM (2).jpeg","1713580664_1713551738017.png","1713580664_1713551753962.png","1713580664_1713551780655.png","1713580664_1713551797906.png"]', 'Kharfran Casual', 'Con su diseño artesanal y su acabado en gamuza, estos zapatos añaden un toque de distinción a cualquier conjunto.', 18, 22.5, 6, '["Negro"]', '["35","36","37","38","39"]'),
	(7, 3, '["1713581114_1713545766415.png","1713581114_1713545785044.png","1713581114_1713545808192.png","1713581114_1713545829010.png"]', 'Tenis gris Puma para niño', 'Con su diseño industrial, ofrecen el equilibrio perfecto entre funcionalidad y moda para los pequeños deportistas.', 10, 12.5, 6, '["Gris"]', '["27","28","29","30","31","32"]'),
	(9, 1, '["1712985688_WhatsApp Image 2024-03-15 at 8.59.33 AM (2).jpeg","1713581661_1713552171689.png","1713581661_1713552187376.png","1713581661_1713552209801.png","1713581661_1713552231300.png"]', 'Sandalia Maribella', 'Estas elegantes sandalias señoriales son el complemento perfecto para lucir sofisticada y cómoda', 25, 31.25, 6, '["Negro"]', '["35","36","37","38","39","40"]'),
	(11, 6, '["1713581916_1713544598321.png","1713581916_1713544924407.png","1713581916_1713544951277.png","1713581916_1713545029350.png"]', 'Tenis Nike gris y blanco', 'Estos tenis casuales son una combinación perfecta de estilo y durabilidad.', 18, 22.5, 6, '["Gris","Rosado","Negro"]', '["35","36","37","38","39"]'),
	(12, 6, '["1712986725_WhatsApp Image 2024-03-15 at 8.59.33 AM.jpeg","1713581325_1713541735958.png","1713581325_1713543205201.png","1713581325_1713543282013.png","1713581325_1713543416492.png"]', 'Nike blanco unicef', 'Estos tenis casuales son la combinación perfecta de estilo y comodidad', 18, 22.5, 6, '["Blanco"]', '["27","28","29","30","31","32"]'),
	(13, 4, '["1712986921_WhatsApp Image 2024-03-15 at 8.59.34 AM (1).jpeg","1713581992_1713551893297.png","1713581992_1713552005637.png","1713581992_1713552030053.png","1713581992_1713552060535.png"]', 'Zapato artesanal tacón negro', 'Fabricados artesanalmente con gamuza de alta calidad en color negro, ofrecen una apariencia elegante y sofisticada.', 18, 22.5, 6, '["Negro"]', '["35","36","37","38","39"]'),
	(14, 1, '["1712987259_WhatsApp Image 2024-03-15 at 8.59.34 AM (2).jpeg","1713582069_1713552082592.png","1713582069_1713552105420.png","1713582069_1713552120733.png","1713582069_1713552143797.png"]', 'Elegance tacón cerrado negro', 'Son una combinación de comodidad y estilo clásico. Fabricadas con gamuza en color negro, ofrecen un aspecto versátil y fácil de combinar.', 24, 30, 6, '["Negro"]', '["35","36","37","38","39"]'),
	(15, 4, '["1713582180_1713552252256.png","1713582180_1713552268348.png","1713582180_1713552286795.png","1713582180_1713552319316.png"]', 'Zapato artesanal Café', 'Estos zapatos casuales para mujeres son perfectos para un estilo cómodo y versátil.', 12, 15, 6, '["Caf\\u00e9"]', '["35","36","37","38","39"]'),
	(16, 7, '["1713582252_1713551816257.png","1713582252_1713551828246.png","1713582252_1713551849231.png","1713582252_1713551866144.png"]', 'Elegance sandalia café', 'Elaboradas artesanalmente con cuero sintético en color blanco, ofrecen comodidad y versatilidad para el día a día.', 8, 10, 6, '["Caf\\u00e9"]', '["35","36","37","38","39"]'),
	(17, 7, '["1712987742_WhatsApp Image 2024-03-15 at 8.59.34 AM.jpeg","1713582390_1713551573026.png","1713582390_1713551594335.png","1713582390_1713551611420.png","1713582390_1713551626953.png"]', 'Sandalia artesanal beige', 'Elaboradas artesanalmente con cuero sintético en color blanco, ofrecen comodidad y versatilidad para el día a día.', 8, 10, 6, '["Beige"]', '["35","36","37","38","39"]'),
	(18, 8, '["1712987894_WhatsApp Image 2024-03-15 at 8.59.35 AM (1).jpeg","1713582443_1713552914772.png","1713582443_1713552931284.png","1713582443_1713552947128.png","1713582443_1713553080153.png"]', 'Zapato artesanal Timberland', 'Elaborados con cuero en color café, ofrecen durabilidad y confort durante largas jornadas laborales.', 28, 35, 6, '["Caf\\u00e9"]', '["38","39","40","41","42","43"]'),
	(19, 6, '["1713582548_1713547135453.png","1713582548_1713547157622.png","1713582548_1713547524399.png","1713582548_1713547173820.png"]', 'All Start  Ocre', 'Con su diseño industrial, estos tenis son ideales para acompañar cualquier aventura urbana con estilo y comodidad.', 12, 15, 6, '["Ocre"]', '["35","36","37","38","39"]'),
	(20, 1, '["1712988212_WhatsApp Image 2024-03-15 at 8.59.35 AM (3).jpeg","1713582624_1713551488333.png","1713582624_1713551507509.png","1713582624_1713551526550.png","1713582624_1713551555322.png"]', 'Elegance negro con moño', 'Su diseño artesanal las hace una opción confiable para cualquier ocasión', 16, 20, 6, '["Negro"]', '["35","36","37","38","39"]'),
	(21, 3, '["1713582683_1713551328474.png","1713582683_1713551355671.png","1713582683_1713551376589.png","1713582683_1713551402022.png"]', 'Tenis kids con luces', 'Estos tenis deportivos son la opción perfecta para los más pequeños en movimiento', 18, 22.5, 6, '["Rosado","Negro"]', '["27","28","29","30","31","32"]'),
	(22, 8, '["1712988526_WhatsApp Image 2024-03-15 at 8.59.35 AM.jpeg"]', 'John 1000', 'Fabricados artesanalmente con cuero de alta calidad en color negro, ofrecen durabilidad y estilo en cada paso.', 28, 35, 1, '["Negro"]', '["42"]'),
	(23, 3, '["1712988670_WhatsApp Image 2024-03-15 at 8.59.36 AM (1).jpeg","1713578581_023b858b-8244-4fa9-9a7f-0145e9064aa4.png","1713578581_24a9c966-cdb3-4b9b-bb73-07d628cb30e4.png","1713578581_40f55845-3568-45b3-ad30-f3bed2b0e1d8.png","1713578581_Zapato blanco azul para ni\\u00f1os.png"]', 'Nike azul y blanco para niños', 'Fabricados con lona resistente en una combinación de colores azul con blanco, ofrecen durabilidad y estilo', 15, 18.75, 16, '["Azul"]', '["28","32"]'),
	(24, 6, '["1713583038_1713551111566.png","1713583038_1713551150904.png","1713583038_1713551169334.png","1713583038_1713551199976.png"]', 'Jordan negro y blanco', 'Fabricados con gamuza en una combinación de colores negro con suela  blanca, ofrecen durabilidad y versatilidad en cada paso', 15, 18.75, 6, '["Blanco","Negro"]', '["36","37","38","39"]'),
	(25, 1, '["1712989062_WhatsApp Image 2024-03-15 at 8.59.36 AM.jpeg","1713583092_1713551649635.png","1713583092_1713551673169.png","1713583092_1713551692868.png","1713583092_1713551715438.png"]', 'Sandalia artesanal beige con decoración', 'Estas sandalias artesanales son sinónimo de elegancia y comodidad', 24, 30, 6, '["Beige"]', '["35","36","37","38","39"]'),
	(26, 6, '["1712989253_WhatsApp Image 2024-03-15 at 8.59.37 AM.jpeg","1713583167_1713545466854.png","1713583167_1713545494378.png","1713583167_1713545519311.png","1713583167_1713545542470.png"]', 'Nike blanco Air', 'Estos tenis casuales son una opción versátil y cómoda para el día a día', 18, 22.5, 6, '["Blanco"]', '["35","36","37","38","39"]'),
	(27, 9, '["1713583828_1713553128397.png","1713583828_1713553151652.png","1713583828_1713553175747.png","1713583828_1713553200549.png"]', 'Yina Mobec negro y rosado', 'Las Yinas son la elección perfecta para quienes buscan comodidad y estilo en cada paso', 7, 8.75, 6, '["Rosado","Negro"]', '["35","36","37","38","39"]'),
	(28, 9, '["1713583635_1713553298915.png","1713583635_1713553312337.png","1713583635_1713553328361.png","1713583635_1713553345342.png"]', 'Yina sapo  normal', 'Hechas con goma resistente en diferentes tonos vibrantes', 6, 7.5, 16, '["Azul","Rosado","Negro"]', '["35","36","37","38","39","40","41","42"]'),
	(29, 1, '["1713583776_1713553224838.png","1713583776_1713553253665.png","1713583776_1713553268088.png","1713583776_1713553281840.png"]', 'Mobec color negro', 'Confeccionadas con goma resistente en un elegante color negro, estas yinas ofrecen durabilidad y comodidad incomparables.', 7, 8.75, 6, '["Rosado","Negro"]', '["35","36","37","38","39","40"]'),
	(30, 9, '["1712990090_WhatsApp Image 2024-03-15 at 8.59.39 AM (4).jpeg","1713584122_1713553384228.png","1713584122_1713553414394.png","1713584122_1713553433447.png"]', 'Nike yina negra', 'Las yinas de Nike son la combinación perfecta de estilo y rendimiento', 7.5, 9.4, 13, '["Negro"]', '["35","36","37","38","39","40","41","42","43"]'),
	(31, 6, '["1713583896_1713545571132.png","1713583896_1713545620315.png","1713583896_1713545641956.png","1713583896_1713545710600.png"]', 'Vans negro y blanco', 'Con los tenis casuales de Vans, puedes lucir a la moda mientras mantienes la comodidad en tus pies', 12, 15, 6, '["Negro"]', '["35","36","37","38","39"]'),
	(32, 9, '["1713583980_1713553560093.png","1713583980_1713553585397.png","1713583980_1713553606186.png","1713583980_1713553628113.png"]', 'Puma yina', 'Con las Yinas de Puma, puedes expresar tu estilo y confianza mientras te mantienes cómodo durante todo el día', 6, 7.5, 6, '["Morado"]', '["35","36","37","38","39"]'),
	(33, 9, '["1712990525_WhatsApp Image 2024-03-15 at 8.59.40 AM (2).jpeg","1713584273_1713553645844.png","1713584273_1713553662513.png","1713584273_1713553688388.png"]', 'Puerto Rico azul', 'Con las Yinas, puedes enfrentar cualquier desafío con confianza y estilo', 7.5, 9.4, 20, '["Azul"]', '["36","37","38","39","40","41","42","43"]'),
	(35, 5, '["1712990975_WhatsApp Image 2024-03-15 at 8.59.40 AM (4).jpeg","1713584486_1713552506422.png","1713584486_1713552521493.png","1713584486_1713552537111.png","1713584486_1713552563066.png"]', 'Zapato artesanal cuero para niño', 'Este zapato casual masculino ofrece un estilo artesanal y duradero.', 25, 31.25, 8, '["Negro"]', '["26","27","28","29","30","31","32"]'),
	(37, 5, '["1712991255_WhatsApp Image 2024-03-15 at 8.59.41 AM (1).jpeg","1713584614_1713552836062.png","1713584614_1713552852382.png","1713584614_1713552870627.png","1713584614_1713552892100.png"]', 'Zapato artesanal', 'Explora nuestro Zapato Casual Masculino, una pieza artesanalmente elaborada con cuero de alta calidad para brindarte estilo y durabilidad.', 22, 27.5, 8, '["Negro"]', '["36","37","38","39","40","41","42"]'),
	(38, 5, '["1712991388_WhatsApp Image 2024-03-15 at 8.59.41 AM (2).jpeg","1713584666_1713552700045.png","1713584666_1713552728410.png","1713584666_1713552753995.png","1713584666_1713552820230.png"]', 'Zapato artesanal TRAFFIC', 'Descubre el Zapato Casual Masculino TRAFFIC, una verdadera obra artesanal elaborada con cuero de alta calidad para brindarte estilo y comodidad.', 25, 31.25, 10, '["Negro"]', '["36","37","38","39","40","41","42"]'),
	(39, 5, '["1712991551_WhatsApp Image 2024-03-15 at 8.59.41 AM (4).jpeg","1713584726_1713552603188.png","1713584726_1713552624546.png","1713584726_1713552643381.png","1713584726_1713552669814.png"]', 'Zapato artesanal chato', 'Ya sea para una salida casual o una ocasión especial, este zapato te garantiza una apariencia elegante y un confort duradero', 30, 37.5, 8, '["Negro"]', '["36","37","38","39","40","41","42"]');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
