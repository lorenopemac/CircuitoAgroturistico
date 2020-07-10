
# Proyecto CircuitoAgroturistico

Sistema web para la articulación e integración de la oferta del circuito como producto, difusión de la oferta de productos, servicios y actividades del circuito, que centralice la información de los feriantes, productos, servicios y actividades de las cinco ferias de productores y artesanos y los establecimientos productivos.


## Prerrequisitos

Es necesario contar con los siguientes componentes

----------------------------------------------------------------------------------------------------------------------------------------------------------------------
 
 Versión minima de PHP: 5.4 (https://www.php.net/)
 
----------------------------------------------------------------------------------------------------------------------------------------------------------------------
 
 Composer (https://getcomposer.org/)
 
----------------------------------------------------------------------------------------------------------------------------------------------------------------------
 
 Yii2(https://www.yiiframework.com/) 
 
----------------------------------------------------------------------------------------------------------------------------------------------------------------------

## Instalación

Pasos a seguir para la instalación del proyecto

### 1. Instalar Composer

```
 curl -sS https://getcomposer.org/installer | php
 sudo mv composer.phar /usr/local/bin/composer
```

### 2. Instalar Yii2 - Descargando template básico

```
 composer create-project --prefer-dist yiisoft/yii2-app-basic basic
```

### 3. Crear Archivo db.php

```
 Descargar proyecto
 En la carpeta CircuitoAgroturistico/config crear archivo de conexión con la base de datos.
```

```php
<?php
return [
	//Conexion a Base de Datos
    'class' => 'yii\db\Connection',

    'dsn' => 'mysql:host='dirección':'puerto';dbname=nombreBD',

    'username' => 'usuario',

    'password' => 'contraseña',

    'charset' => 'utf8'
];

```

