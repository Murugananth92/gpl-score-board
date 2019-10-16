    <?php
defined('BASEPATH') OR exit('No direct script access allowed');
$route['login'] = 'authentication/login';
$route['logout'] = 'dashboard/logout';
$route['default_controller'] = 'authentication';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

