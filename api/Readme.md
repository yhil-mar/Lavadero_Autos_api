# PROYECTO LAVADERO AUTOS GO UP CLOUD
## Descripción

Este proyecto consiste en el desarrollo de una API en lenguaje PHP para administrar un lavadero de autos. Proporciona los endpoints necesarios para gestionar autos, trabajadores, servicios, pedidos, productos, usuarios y nóminas de pago.
##
## Estructura de archivos y carpetas
- autoload.php: Archivo que registra la función de autocarga de clases.
- config: Carpeta que contiene archivos de configuración.
- credentialsDb.php: Archivo que define las credenciales de la base de datos.
- src: Carpeta que contiene el código fuente de la aplicación.
- controllers: Carpeta que contiene los controladores de la API.
- creationTables: Carpeta que contiene archivos de creación de tablas de la base de datos.
- lib: Carpeta que contiene las clases y utilidades de la aplicación.
- Route.php: Clase que maneja el enrutamiento y los métodos HTTP.
- models: Carpeta que contiene los modelos de datos de la API.
- routes: Carpeta que contiene los archivos de definición de las rutas y controladores.
- index.php: Archivo de definición de las rutas y controladores.

## Configuración
Antes de ejecutar la API, se deben realizar las siguientes configuraciones:

Configurar un servidor web (por ejemplo, Apache) para que apunte al directorio raíz del proyecto.

Crear una base de datos en MySQL y configurar las credenciales de conexión en el archivo config/credentialsDb.php.

Definición de rutas y controladores

En el archivo src/routes/index.php, se definen las rutas y se asocian con los controladores correspondientes utilizando la clase Route del archivo src/lib/Route.php. 

Los controladores se encuentran en la carpeta src/controllers y contienen la lógica para manejar las solicitudes de la API.

## Enrutamiento y procesamiento de solicitudes

El archivo src/lib/Route.php contiene la clase Route, que se encarga del enrutamiento y el procesamiento de las solicitudes entrantes. El método principal es dispatch(), que se llama en el archivo index.php para manejar las solicitudes.

## CreationTables 

### CarsTable.php
Clase CarsTable: Crea la tabla "cars" en la base de datos. La tabla contiene los siguientes campos:

licensePlate: Patente del vehículo (clave primaria)

vehicleType: Tipo de vehículo

client: Cliente asociado al vehículo

whatsapp: Número de WhatsApp del cliente

brand: Marca del vehículo

model: Modelo del vehículo

color: Color del vehículo

### OrdersTable.php
Clase OrdersTable: Crea la tabla "orders" en la base de datos. La tabla contiene los siguientes campos:

id: Identificador único de la orden (clave primaria)

orderService: Servicio de la orden

carId: ID del vehículo asociado a la orden

serviceId: ID del servicio asociado a la orden

workerId: ID del trabajador asociado a la orden

fractionalCost: Costo fraccionado de la orden

totalCost: Costo total de la orden

discountDay: Descuento del día de la orden

tip: Propina de la orden

orderYear: Año de la orden

orderMonth: Mes de la orden

orderDay: Día de la orden

orderHour: Hora de la orden

invoiced: Facturado (1) o no facturado (0)

orderStatus: Estado de la orden (pendiente, completada, cancelada)

cancelReason: Motivo de cancelación de la orden

Restricciones de clave externa para los campos carId, serviceId y workerId que se refieren a las tablas relacionadas.

### PayrollTable.php
Clase PayrollTable: Crea la tabla "payroll" en la base de datos. La tabla contiene los siguientes campos:

id: Identificador único de la nómina (clave primaria)

date: Fecha de la nómina

workerName: Nombre del trabajador

workerId: ID del trabajador

goal: Objetivo

profit: Ganancia

payment: Pago

tip: Propina

statusBill: Estado de la factura (pagada, pendiente)
###
### ProductsTable.php
Clase ProductsTable: Crea la tabla "products" en la base de datos. La tabla contiene los siguientes campos:

id: Identificador único del producto (clave primaria)

nameProduct: Nombre del producto

stock: Stock del producto

unit: Unidad del producto

purchaseDate: Fecha de compra del producto

ServicesTable.php

Clase ServicesTable: Crea la tabla "services" en la base de datos. La tabla contiene los siguientes campos:

id: Identificador único del servicio (clave primaria)

serviceName: Nombre del servicio

vehicleType: Tipo de vehículo asociado al servicio

cost: Costo del servicio

discountDay: Descuento del día del servicio

### UsersTable.php
Clase UsersTable: Crea la tabla "users" en la base de datos. La tabla contiene los siguientes campos:

user\_name: Nombre de usuario (clave primaria)

user\_password: Contraseña del usuario

user\_type: Tipo de usuario (admin, superadmin)

user\_status: Estado del usuario (activo, inactivo)

### WorkersTable.php
Clase WorkersTable: Crea la tabla "workers" en la base de datos. La tabla contiene los siguientes campos:

rut\_passport: Rut o pasaporte del trabajador (clave primaria)

name: Nombre del trabajador

address: Dirección del trabajador

profitPercentage: Porcentaje de ganancia del trabajador

percentageAfterGoal: Porcentaje después del objetivo del trabajador

goal: Objetivo del trabajador

branch: Sucursal del trabajador

statusWorker: Estado del trabajador (activo, vacaciones, inactivo)

##
## Models
##
## Model.php

### Clase Model:
\_\_construct(): El constructor de la clase Model establece la conexión a la base de datos.

query($sql): Ejecuta una consulta a la base de datos y devuelve el resultado.

first(): Devuelve el primer registro encontrado en la consulta.

get(): Devuelve todos los registros encontrados en la consulta.

all(): Realiza una consulta para obtener todos los registros de una tabla.

allTable($table): Realiza una consulta para obtener todos los registros de una tabla específica.

where($column, $operator, $value = null): Realiza una consulta con una cláusula WHERE en función de la columna, el operador y el valor proporcionados.

whereTable($columns, $table, $column, $operator, $value = null): Realiza una consulta con una cláusula WHERE en una tabla específica, seleccionando columnas específicas.

create($data): Crea un nuevo registro en el modelo con los datos proporcionados.

createTable($data, $table): Crea un nuevo registro en una tabla específica con los datos proporcionados.

update($id, $data): Actualiza un registro en el modelo con los datos proporcionados.

updateTable($id, $data, $table): Actualiza un registro en una tabla específica con los datos proporcionados.

delete($id, $column): Elimina un registro del modelo según el ID y la columna proporcionados.

### Car.php
Clase Car:

protected $table: Propiedad protegida que define la tabla "cars".
###
### Order.php
Clase Order:

protected $table: Propiedad protegida que define la tabla "orders".

createRelation($body): Crea una relación entre órdenes y vehículos, servicios y trabajadores, utilizando los datos proporcionados.

updateOrders($orderService, $body): Actualiza las órdenes según el servicio y los datos proporcionados.

findOrders($query): Busca órdenes que coincidan con la consulta proporcionada.

fixOrders($ordersArray): Ajusta los datos de las órdenes en un formato más legible y estructurado.
### payroll.php
Clase Payroll:

protected $table: Propiedad protegida que define la tabla "payroll".

createPayrolls($date): Crea nóminas utilizando la fecha proporcionada.

### product.php:
Clase Product:

getName(): Devuelve el nombre del producto.

getPrice(): Devuelve el precio del producto.

service.php:

Clase Service:

getName(): Devuelve el nombre del servicio.

getHourlyRate(): Devuelve la tarifa por hora del servicio.

worker.php:

Clase Worker:

getName(): Devuelve el nombre del trabajador.

getRole(): Devuelve el rol del trabajador.

### user.php:
Clase User:

getUsername(): Devuelve el nombre de usuario.

getEmail(): Devuelve el correo electrónico del usuario.


## Controllers

### DeleteOrders.php:
Elimina una orden creada indicando el id correspondiente.

### GetAllProducts.php
Trae todos los productos existentes en la base de datos.

### GetAllServices.php
Trae todos los servicios existentes en la base de datos.

### GetAllUsers.php
Trae todos los usuarios existentes en la base de datos.

### GetCarByLicense.php
Trae un vehiculo especificando la patente.

### GetOrders.php
Trae todas las ordenes existentes en la base de datos.

### GetOrdersByDate.php
Trae las ordenes entre fechas especificadas

### GetPayrollByDate.php
Trae lo comicionado por cada trabajador por un día especificado.

### GetPayrollChart.php
Trae el total de trabajadores y la comicion que se lleva hasta el momento entre fecha y fecha

### GetProductsById.php
Trae un producto en especifico por el id

### GetWorkers.php
Trae a todos los trabajadores registrados en la base de datos.

### PostCars.php
Permite crear los vehiculos

### PostOrders.php
Permite crear las ordenes de los servicios

### PostPayrolls.php
Permite crea la nomina de los trabajadores por día.

### PostProducts.php
Permite crear los productos.

### PostServices.php
Permite crear los servicios.

### PostUsers.php
Permite crear los usuarios.

### PostWorkers.php
Permite crear a los trabajadores.

### PutCars.php
Permite modificar las caracteristicas de los carros.

### PutOrders.php
Permite modificar las caracteristicas de las ordenes.

### PutPayrolls.php
Permite modificar las caracteristicas de la nomina.

### PutProducts.php
Permite modificar las caracteristicas de los productos.

### PutServices.php
Permite modificar las caracteristicas de los servicios.

### PutUsers.php
Permite modificar las caracteristicas de los usuarios.

### PutWorkers.php
Permite modificar las caracteristicas de los trabajadores.





















