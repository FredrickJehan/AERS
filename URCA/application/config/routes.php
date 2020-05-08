<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
$route['default_controller'] = 'main/index';
// $route['edit/:num'] = 'research/research_detail';
$route['publication'] ="research/publication_table";     
$route['unsubmit'] = 'main/unsubmit';
$route['rank'] = 'main/rank';
$route['detailed'] = 'main/detailed';
$route['guestform'] = 'main/guestform';

//RESEARCH
$route['research/add'] = 'research/research_form';
$route['research'] = 'research/research_table';
$route['publication'] = 'research/publication';
$route['research/view/:num'] = 'research/research_view';
$route['research/edit/:num'] = 'research/edit';

//GUEST
//$route['home'] = 'guest/index';
$route['about'] = 'main/about';
$route['home'] = 'research/homepage'; 
$route['detail'] = 'main/detailed_view';  
$route['search'] = 'main/search';

//LOGIN/SESSION
$route['login'] = 'welcome/login';
$route['registration'] = 'welcome/registration_form';
$route['dashboard'] ="welcome/user_login";
$route['logout'] = 'welcome/logout';

//ADMIN CONTROLLER
$route['admin'] = 'admin/index';
$route['manage'] = 'admin/manage_submissions';
$route['export'] = 'admin/export';
// $route['view/:num'] = 'admin/view_submissions';
// $route['approve/:num'] = 'admin/approve_submissions';

//Previous work, Guest Routes
//$route['(:any)'] = 'main/views/$1'
$route['404_override'] = '';

