<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] 		 = 'catalog/index';
$route['404_override'] 				 = '';
// $route['(:any)'] = 'catalog/$1';
$route['index'] 					 = 'catalog/index';
$route['about'] 					 = 'catalog/about';
$route['history'] 					 = 'catalog/history';
$route['news'] 					 	 = 'catalog/news';
$route['crc'] 					 	 = 'catalog/crc';
$route['contact'] 					 = 'catalog/contact';
$route['news/(:any)'] 				 = 'catalog/news/detail/$1';
$route['model/(:any)'] 				 = 'catalog/model/index/$1';
$route['translate_uri_dashes'] 		 = FALSE;