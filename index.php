<?php

$page = $_GET['page'] ?? 'home';

require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/HomeController.php';
require_once __DIR__ . '/controllers/AdminController.php';
require_once __DIR__ . '/controllers/MusicController.php';
require_once __DIR__ . '/controllers/CatalogController.php';

switch ($page) {

    case 'home':
        $controller = new HomeController();
        $controller->showHome();
        break;

    case 'register':
        $controller = new AuthController();
        $controller->register();
        break;

    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;

    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;

    case 'admin':
        $controller = new AdminController();
        $controller->dashboard();
        break;

    case 'store-music':
        $controller = new AdminController();
        $controller->storeMusic();
        break;

    case 'catalogue':
        $controller = new CatalogController();
        $controller->catalog();
        break;

    case 'add-to-cart':
        $controller = new MusicController();
        $controller->addToCart();
        break;

    default:
        $controller = new HomeController();
        $controller->showHome();
        break;
}