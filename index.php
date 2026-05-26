<?php



$page = $_GET['page'] ?? 'home';

require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/HomeController.php';

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

    default:
        $controller = new HomeController();
        $controller->showHome();
        break;
}