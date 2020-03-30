<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'AuthenticationController';
$route['404_override'] = 'Error404Controller';
$route['login'] = 'AuthenticationController/index/';
$route['logout'] = 'AuthenticationController/logout/';
$route['usuarios/(:num)'] = 'UsuariosController/index/$1';
$route['perfiles/(:num)'] = 'PerfilesController/index/$1';
$route['miPerfil/(:num)'] = 'MiPerfilController/index/$1';
$route['acciones/(:num)'] = 'AccionesPersonalController/index/$1';
$route['manuales_adm/(:num)'] = 'ManualesController/administrativos/$1';
$route['manuales_adm_download/(:any)'] = 'ManualesController/downloadAdministrativos/$1';
$route['manuales_adm_remove/(:any)'] = 'ManualesController/removeAdministrativos/$1';
$route['manuales_out/(:num)'] = 'ManualesController/outsoursing/$1';
$route['manuales_out_download/(:any)'] = 'ManualesController/downloadOutsoursing/$1';
$route['manuales_out_remove/(:any)'] = 'ManualesController/removeOutsoursing/$1';
$route['translate_uri_dashes'] = FALSE;
