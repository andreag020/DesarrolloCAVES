<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'inventario';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['inventario/vue'] = 'inventario/vue';
$route['inventario/api/productos'] = 'inventario/apiProductos';
$route['inventario/api/guardar'] = 'inventario/apiGuardar';
$route['inventario/api/actualizar/(:num)'] = 'inventario/apiActualizar/$1';
$route['inventario/api/eliminar/(:num)'] = 'inventario/apiEliminar/$1';
