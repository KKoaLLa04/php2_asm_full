<?php

use Phroute\Phroute\RouteCollector;

$url = !isset($_GET['url']) ? "/" : $_GET['url'];

$router = new RouteCollector();

// filter check đăng nhập
$router->filter('auth', function () {
    if (!isset($_SESSION['auth']) || empty($_SESSION['auth'])) {
        header('location: ' . BASE_URL . 'login');
        die;
    }
});

// khu vực cần quan tâm -----------
// bắt đầu định nghĩa ra các đường dẫn
$router->get('/', function () {
    return "trang chủ";
});
//định nghĩa đường dẫn trỏ đến Product Controller
$router->get('list-product', [App\Controllers\ProductController::class, 'index']);
$router->get('detail-product/{id}', [App\Controllers\ProductController::class, 'detail']);
$router->get('add-product', [App\Controllers\ProductController::class, 'addProduct']);
$router->post('post-product', [App\Controllers\ProductController::class, 'postProduct']);
$router->get('edit-product/{id}', [App\Controllers\ProductController::class, 'editProduct']);
$router->post('edit-post/{id}', [App\Controllers\ProductController::class, 'editPost']);
$router->get('delete-product/{id}', [App\Controllers\ProductController::class, 'deleteProduct']);


$router->get('list-cate', [App\Controllers\CategoryController::class, 'index']);
$router->get('detail-cate/{id}', [App\Controllers\CategoryController::class, 'detail']);
$router->get('add-cate', [App\Controllers\CategoryController::class, 'addCate']);
$router->post('post-cate', [App\Controllers\CategoryController::class, 'postCate']);
$router->get('edit-cate/{id}', [App\Controllers\CategoryController::class, 'editCate']);
$router->post('edit-cate/{id}', [App\Controllers\CategoryController::class, 'editPostCate']);
$router->get('delete-cate/{id}', [App\Controllers\CategoryController::class, 'deleteCate']);

$router->get('list-user', [App\Controllers\UserController::class, 'index']);
$router->get('add-user', [App\Controllers\UserController::class, 'addUser']);
$router->post('post-user', [App\Controllers\UserController::class, 'postUser']);
$router->get('edit-user/{id}', [App\Controllers\UserController::class, 'editUser']);
$router->post('edit-postuser/{id}', [App\Controllers\UserController::class, 'editPostUser']);

// khu vực cần quan tâm -----------
//$router->get('test', [App\Controllers\ProductController::class, 'index']);

# NB. You can cache the return value from $router->getData() so you don't have to create the routes each request - massive speed gains
$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());

$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $url);

// Print out the value returned from the dispatched function
echo $response;