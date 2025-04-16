<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
//$routes->get('/test-db', 'TestDB::index');

$routes->add('/home', 'Pages::index');
$routes->add('/login', 'Pages::login');
$routes->add('/register', 'Pages::register');
//$routes->add('/shop', 'Pages::catalog');
$routes->add('/admin', 'Admin::index');
//$routes->add('/admin/add_product', 'Admin::add_product');

//$routes->add('/product_list', 'Admin::product_list');

$routes->add('/user_register', 'UserAccount::Create_Account');
$routes->add('/user_login', 'UserAccount::login_Account');

//$routes->add('/category_name', 'AdminProducts::category_name');
$routes->add('/adminp', 'AdminProducts::category_name');
$routes->add('/admin/add_product', 'AdminProducts::add_product');
$routes->add('/product_list2', 'AdminProducts::product_list');
$routes->get('admin/download_pdf', 'AdminProducts::download_pdf'); 


$routes->get('/productsShop', 'Shop::product_list');



  