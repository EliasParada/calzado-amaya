<p align="center"><a href="https://calzadoamaya.com" target="_blank"><img src="public\img\calzado-amaya-color.svg" width="400" alt="Calzado Amaya Logo"></a></p>

## Calzado Amaya

Calzado Amaya es un E-Commerce orientado en la venta online de zapatos artesanales.

### Documentación:

#### Base de datos

A continuación se presentan las tablas utilizadas en la base de datos:

| Nombre de la Tabla | Descripción |
|--------------------|-------------|
| administradores    | Tabla que almacena información sobre los administradores del sistema. |
| compras            | Tabla que registra información sobre las compras realizadas por los usuarios. |
| detalle_compras    | Tabla que almacena detalles de las compras, como productos y cantidades. |
| productos          | Tabla que contiene información sobre los productos disponibles para la venta. |
| puntos_usuarios    | Tabla que registra la acumulación de puntos por parte de los usuarios. |
| usuarios           | Tabla que almacena información sobre los usuarios registrados en el sistema. |

Para más detalles sobre la estructura de cada tabla, consulta el esquema SQL proporcionado.

#### Esquema de Tablas:

A continuación se presenta el esquema de las tablas:

#### Tablas SQL:

```sql
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
```

#### Primeros pasos

1. Mediante `Composer` podremos crear el proyecto con el siguiente comando:

```bash
composer create-project --prefer-dist laravel/laravel calzado-amaya
```

2. Regenerar clave de aplicación:

```bash
php artisan key:generate
```

3. Para quen el registro funcione debe configurarse de la siguiente manera:

 1. En el archivo `config/auth.php` debemos configurar que modelo servira de principal.

```php
'providers' => [
    'users' => [
        'driver' => 'eloquent',
        'model' => App\Models\usuarios::class,
    ],
],
```

 2. En el model se importa la libreria User como Authenticatable y la clase sera una extension de dicha librería.

```php
use Illuminate\Foundation\Auth\User as Authenticatable;

class usuarios extends Authenticatable
```

 3. El campo de contraseña debe ser siempre `password`.

 4. En el archivo `config/session.php` debemos configurar que modelo servira de principal.

```php
'driver' => env('SESSION_DRIVER', 'cookie'),
```

4. Registrar `categorias` como proveedor y poder usarlo como un recurso compartido por medio de `AppServiceProvider`

```php
public function boot(): void
{
    View::share('categorias', categorias::all());
}
```

## Lisensia

Proyeto basado en Laravel, [Licensia MIT](https://opensource.org/licenses/MIT).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**