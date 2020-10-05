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
$route['default_controller'] = 'dashboard';

$route['forgot'] = 'admin/forgot';

$route['login'] = 'login';
$route['login/(:any)'] = 'login/$1';

$route['register'] = 'user/register';
$route['register/(:any)'] = 'user/register/$1';
$route['user/(:any)'] = 'user/register/$1';
$route['manage-staff'] = 'user/register/manageStaff';

$route['recover'] = 'admin/recover';
$route['recover/(:any)'] = 'admin/recover/$1';
$route['recover/(:any)/(:any)'] = 'admin/recover';
$route['logout'] = 'admin/logout';

$route['unit'] = 'units/unit';
$route['unit-add'] = 'units/unit/unitAdd';
$route['unit/(:any)'] = 'units/unit/$1';

$route['manage'] = 'manage/manage';
$route['manage/(:any)'] = 'manage/manage/$1';

$route['settings'] = 'settings/setting';
$route['settings/(:any)'] = 'settings/setting/$1';




$route['documentation'] = 'docs/docs';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


// NG
$route['admin/debug/(:any)/(:any)'] = 'admin/debug/index/$1/$2';

$route['reporting'] = 'reporting/reporting';
// $route['reporting/(:any)'] = 'reporting/reporting/index/$1';
$route['reporting/allocations/(:any)'] = 'reporting/reporting/allocations/$1';
$route['reporting/staffs/(:any)'] = 'reporting/reporting/staffs/$1';
$route['reporting/units/(:any)'] = 'reporting/reporting/units/$1';
$route['reporting/budgets/(:any)'] = 'reporting/reporting/budgets/$1';

$route['allocation'] = 'allocation/allocation';
$route['allocate-add/(:any)'] = 'allocation/allocation/allocateNew/$1';

$route['allocationupdate/(:any)'] = 'allocation/allocation/allocateupdate/$1';
$route['allocate-edit/(:any)'] = 'allocation/allocation/allocateEdit/$1';
$route['allocate-edit/(:any)/(:any)'] = 'allocation/allocation/allocateEdit/$1/$2';
$route['allocationcreate'] = 'allocation/allocation/allocateCreate';
$route['allocationcreate/(:any)'] = 'allocation/allocation/allocateCreate/$1';
$route['allocate_find_Activities'] = 'allocation/allocation/allocateFindActivities';
$route['allocation/(:any)'] = 'allocation/allocation/$1';
$route['allocation/allocate/(:any)'] = 'allocation/allocation/allocate/$1';
$route['allocate-delete/(:any)/(:any)'] = 'allocation/allocation/allocateDelete/$1/$2';

$route['metrics'] = 'metrics/metrics';
$route['metrics-add'] = 'metrics/metrics/addMetrics';
$route['metrics-edit'] = 'metrics/metrics/editMetrics';
$route['metrics-del'] = 'metrics/metrics/delMetrics';
$route['metrics/(:any)'] = 'metrics/metrics/$1';

$route['activities'] = 'activities/activities';
$route['activitiescreate'] = 'activities/activities/create';
$route['activitiesedit/(:any)'] = 'activities/activities/edit/$1';
$route['activitiesupdate/(:any)'] = 'activities/activities/update/$1';
$route['activitiesdelete/(:any)'] = 'activities/activities/delete/$1';

$route['error'] = 'error/error';