    <?php
defined('BASEPATH') OR exit('No direct script access allowed');
$route['start_match_live'] = 'start_match/start_match_live';
$route['login'] = 'authentication/login';
$route['logout'] = 'dashboard/logout';
$route['default_controller'] = 'authentication';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
