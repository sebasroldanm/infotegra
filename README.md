# Prueba Técnica Infotegra

## Descripción

Se desarrolló una aplicación que consume la API de **Rick and Morty** para realizar las siguientes funcionalidades:

- Consulta vía API.
- Listar y paginar datos de la API.
- Ver detalle de un personaje de la API.
- Almacenar datos en una base de datos local.
- Listar datos almacenados y paginar.
- Editar registros.

## Detalles Técnicos

El desarrollo se realizó utilizando **Laravel** en su última versión (12.x), junto con **Livewire** y **Tailwind CSS**.

### Requisitos

- GIT
- PHP 8.2
- MySQL 8.0
- Composer 2.x

---

## Pasos para Desplegar

### 1. Clonar el Repositorio

```bash
git clone https://github.com/sebasroldanm/infotegra.git
cd infotegra
```
### 2. Instalar Dependencias

```bash
composer install
```

### 3. Configurar el Archivo `.env`
Copiar el archivo `.env.example` a `.env` y configura las variables de entorno necesarias:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=<NAME_DB>
DB_USERNAME=<USER_DB>
DB_PASSWORD=<PASS_DB>
```

### 4. Generar la Clave de Aplicación

```bash
php artisan key:generate
```

### 5. Crear la Base de Datos
Se debe tener una base de datos creada en MySQL y que esta se pueda conectar desde Laravel.
Para este caso, existen dos formas:
- Migraciones:
  Ejecutar el comando para crear las tablas de acuerdo a las migraciones creadas, este proyecto no contiene Seeders.
```bash
php artisan migrate
```
- Desde archivo:
  Se debe realizar la ejecución de la SQL en la base de datos previamente creada. 
  _Nota: El archivo será compartido fuera del repositorio_

### 5. Crear directorio simbólico

_(Opcional)_

```bash
php artisan storage:link
```

### 6.Iniciar el Servidor Local

Usando el server que ofrece artisan

```bash
php artisan serve
```

O desde el WebServer _(Apache o Nginx)_
