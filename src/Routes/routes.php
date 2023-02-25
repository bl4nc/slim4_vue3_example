<?php
namespace App\Routes;

use App\Controllers\AuthController;
use App\Frontend\Controllers\HomeController;
use App\Frontend\Controllers\LoginController;
use App\Middleware\AuthMiddlewareFront;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;

$app = AppFactory::create();
//Frontend
$app->get('/', new LoginController);

$app->group('/auth', function (RouteCollectorProxy $group) {
    $group->get('/home',new HomeController);
})->add(new AuthMiddlewareFront);

//Backend
$app->post('/auth', AuthController::class . ':Auth');



$app->run();