<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

//Route to test database connection
$routes->get('/test-db', 'TestDB::index');

//Route to customer home page
$routes->add('/home', 'Pages::index');

//Route to login and register pages
$routes->add('/login', 'Pages::login');
$routes->add('/register', 'Pages::register');

//Route to send user data to the database when user registers or logs in
$routes->add('/user_register', 'UserAccount::Create_Account');
$routes->add('/user_login', 'UserAccount::login_Account');

$routes->get('/logout', 'UserAccount::logout');
$routes->get('/profile', 'UserAccount::profile');


//Route to admin login page
$routes->add('/admin', 'Admin::index');
//$routes->add('/admin/add_product', 'Admin::add_product');
$routes->post('/admin/login', 'Admin::login');
$routes->get('/admin/logout', 'Admin::logout');

//$routes->add('/product_list', 'Admin::product_list');



//$routes->add('/adminp', 'AdminProducts::category_name');
$routes->add('/admin/add_product', 'AdminProducts::add_product');
$routes->add('/product_list2', 'AdminProducts::product_list');
$routes->get('admin/download_pdf', 'AdminProducts::download_pdf'); 



$routes->get('/productsShop', 'Shop::product_list');

$routes->get('/', 'Pages::index');

$routes->add('/manageProducts', 'Pages::manageProducts');

$routes->get('/top-selling', 'OrderController::showTopSelling');

$routes->post('/cart/add', 'Cart::add_cart');


$routes->get('admin/get_product_details/(:num)', 'AdminProducts::get_product_details/$1');

$routes->match(['get', 'post'], 'admin/update_product', 'AdminProducts::update_product');

$routes->post('admin/delete_product', 'AdminProducts::delete_product');

$routes->get('cart', 'Cart::view_cart');
$routes->post('cart/remove/(:num)', 'Cart::remove/$1');



$routes->get('/category', 'Category::ViewCategory');
//add category
$routes->post('/add_category', 'Category::AddCategory');

$routes->get('/add_specification', 'Specification::viewAddSpecification');
$routes->post('/add_specification', 'Specification::addSpecification');

$routes->get('/assign_specifications', 'Specification::viewAssignSpecifications');
$routes->post('/assign_specifications', 'Specification::assignSpecifications');

$routes->post('/add_category_ajax', 'Specification::addCategoryAjax');
$routes->post('/add_specification_ajax', 'Specification::addSpecificationAjax');

$routes->get('/manage_sc', 'Specification::manageCategorySpecifications');

$routes->get('admin/getCategorySpecifications/(:num)', 'AdminProducts::getCategorySpecifications/$1');


$routes->post('cart/buy-selected', 'Cart::checkout');   
$routes->post('cart/place-order', 'Cart::place_order'); 
$routes->get('order-success/(:segment)', 'Cart::order_success/$1'); 

$routes->get('order-success/(:segment)', 'Cart::order_success/$1');


// User routes for order management
$routes->get('/my-orders', 'OrderController::my_orders');
$routes->get('/order-detail/(:segment)', 'OrderController::order_detail/$1');
$routes->get('/track-order', 'OrderController::track_order');
$routes->post('/track-order', 'OrderController::track_order_result');

// Admin routes for order management
$routes->get('/admin/orders', 'OrderManageAdmin::index');
$routes->get('/admin/order/(:segment)', 'OrderManageAdmin::view/$1');
$routes->post('/admin/order/update-status/(:segment)', 'OrderManageAdmin::update_status/$1');
$routes->get('/admin/order/invoice/(:segment)', 'OrderManageAdmin::invoice/$1');
