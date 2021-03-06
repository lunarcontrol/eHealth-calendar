<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Pages::index');

$routes->match(['get', 'post'], '/heatmap', 'Heatmap::index', ['filter' => 'auth']);
$routes->get('/heatmap/api/new/(:segment)/(:segment)','Heatmap::new/$1/$2');
$routes->get('/heatmap/api/new-date/(:segment)/(:segment)/(:segment)','Heatmap::newDate/$1/$2/$3');
// $routes->get('/heatmap/api/view','Heatmap::view');
$routes->get('/heatmap/api.json', 'Heatmap::api');
$routes->get('/heatmap/api/view', 'Heatmap::api_view');
$routes->get('/heatmap/info.json', 'Heatmap::api_info');

$routes->get('/dashboard', 'Dashboard::index',['filter' => 'auth']);




//$routes->get('(:any)', 'Pages::view/$1');

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
